<?php

namespace Camino\Http\Controllers\Api;

use Illuminate\Http\Request;
use Camino\Http\Controllers\Controller;
use Camino\Alquiler;
use Camino\Cliente;
use Carbon\Carbon;
use DB;

class AlquilerController extends Controller
{
    public function index(Request $request) {
        $alquileres = (new Alquiler)->newQuery();
        $alquileres
            ->select('id','cliente_id','vehiculo_id','fecha_entrega','fecha_devolucion','lugar_devolucion','nro_factura')
            ->with('cliente:id,nombre,apellido')
            ->with('vehiculo:id,marca_id,modelo,patente,anio,foto')
            ->orderBy('created_at', 'DESC');

        if($request->has('cliente') ) 
            $alquileres->where('cliente_id',($request->cliente));
        
        if($request->has('vehiculo') ) 
            $alquileres->where('vehiculo_id',($request->vehiculo));

        if($request->has('estado')){
            if($request->estado=='terminado'){
                $alquileres->where('fecha_devolucion','<',Carbon::today());
            }
            if($request->estado=='proximo'){
                $alquileres->where('fecha_entrega','>',Carbon::today());
            }
            if($request->estado=='actual'){
                $alquileres
                    ->where('fecha_entrega','<=',Carbon::today())
                    ->where('fecha_devolucion','>=',Carbon::today());
            }
        }

        if($request->has('date') ) {
            if($request->date!=null){
                // dd($request->date.'-01');
                $from = Carbon::parse($request->date.'-01')->startOfMonth();
                $to   = Carbon::parse($request->date.'-01')->endOfMonth();
                $alquileres
                ->whereBetween('fecha_entrega',[ $from, $to ])
                ->orWhere('fecha_devolucion'  ,[ $from, $to ]);
            }
        }
        
        if($request->has('page') ) 
            return response()->json($alquileres->paginate(20));
        else 
            return response()->json($alquileres->get());
        
            // ->where('fecha_entrega','>',  Carbon::today()->startOfMonth()->subMonth() )
            
        // return response()->json($alquileres);
    }

    public function show($id) {
        $alquiler = Alquiler::
            select('id','cliente_id','vehiculo_id','fecha_entrega','fecha_devolucion','lugar_devolucion','lugar_entrega','hora_entrega','hora_devolucion','nro_factura','observaciones','descuento','cotizacion','servicio','forma_pago')
            ->where('id',$id)
            ->with('cliente:id,nombre,apellido,dni,domicilio,celular,email,vip','vehiculo:id,modelo,clase,patente,puertas,ciudad,marca_id,anio,foto')
            ->get();
        return response()->json($alquiler);
    }

    public function store(Request $request) {
        
        $alquiler = new Alquiler;

        if ($request->cliente_nuevo['nombre'] == null || $request->cliente_nuevo['apellido'] == null) {
            $alquiler->cliente_id = $request->cliente_id;
            // asigna la empresa del cliente al alquiler
            $cliente = Cliente::findOrFail($request->cliente_id);
            if ($cliente->empresa_id !=  null   ) $alquiler->empresa_id = $cliente->empresa_id;
        } else {
            $cliente = new Cliente;
            $cliente->nombre = $request->cliente_nuevo['nombre'];    
            $cliente->apellido = $request->cliente_nuevo['apellido'];    
            $cliente->save();
            $alquiler->cliente_id = $cliente->id;
        }
        $alquiler->fill($request->all());
        $alquiler->save();
        return response()->json($alquiler);
    }

    public function update(Request $request, $id) {
        $alquiler = Alquiler::findOrFail($id);
        if ($request->cliente_nuevo['nombre'] == null || $request->cliente_nuevo['apellido'] == null) {
            $alquiler->cliente_id = $request->cliente_id;
            // asigna la empresa del cliente al alquiler
            $cliente = Cliente::findOrFail($request->cliente_id);
            if ($cliente->empresa_id !=  null   ) $alquiler->empresa_id = $cliente->empresa_id;
        }
        $alquiler->fill($request->all());
        $alquiler->save();
        return response()->json($alquiler);
    }

    public function destroy($id) {
        $alquiler = Alquiler::findOrFail($id);
        $alquiler->delete();
        return response('Alquiler '.$id.' eliminado', 200);
    }

    public function data(){
        $data = []; //declaramos un array principal que va contener los datos
        $alquileres = Alquiler::
            select('id','cliente_id','vehiculo_id','fecha_entrega','fecha_devolucion')
            ->with('vehiculo:id,patente,ciudad')
            ->with('cliente:id,apellido')
            ->get(); //listamos todos los id de los eventos
        $colores = ['#007bff', '#6610f2', '#6f42c1', '#e83e8c', '#dc3545', '#fd7e14', '#ffc107', '#28a745', '#20c997', '#17a2b8',  '#6c757d', '#343a40', '#007bff', '#6c757d', '#28a745', '#17a2b8', '#ffc107', '#dc3545', '#343a40'];
        foreach ($alquileres as $alquiler) {
            $titulo_evento = $alquiler->cliente->apellido;
            $tooltip = $alquiler->fecha_entrega . ' -> ' . $alquiler->fecha_devolucion . '  |  ' . strtoupper($alquiler->vehiculo->patente).' '.$alquiler->cliente->apellido;

            $data[] = [
                "title"=>$titulo_evento, 
                'description'   =>  $tooltip,
                'ciudad'  =>  $alquiler->vehiculo->ciudad,
                "start"=>\Carbon\Carbon::parse($alquiler->fecha_entrega)->format('Y-m-d'), 
                "end"=>\Carbon\Carbon::parse($alquiler->fecha_devolucion)->addDay()->format('Y-m-d'), 
                "color"=>$colores[array_rand($colores,1)], 
                "url"=>'#/alquileres/'.$alquiler->id,
                "resourceId"    => $alquiler->vehiculo->id
            ];
        }
        // json_encode($data); //convertimos el array principal $data a un objeto Json
        return response()->json($data); //para luego retornarlo y estar listo para consumirlo
    }

    public function stats() {
        $diario = DB::table('alquileres')
            ->select(DB::raw('count(*) as count, DAY(created_at) as dia '))
            ->groupBy('dia')
            ->get();
        $mensual = DB::table('alquileres')
            ->select(DB::raw('count(*) as count, MONTH(created_at) as mes '))
            ->groupBy('mes')
            ->get();
        $anual = DB::table('alquileres')
            ->select(DB::raw('count(*) as count, YEAR(created_at) as anio '))
            ->groupBy('anio')
            ->get();
        $lugar_entrega = DB::table('alquileres')
            ->select(DB::raw('count(*) as count, lugar_entrega '))
            ->groupBy('lugar_entrega')
            ->orderBy('count','DESC')
            ->get();
        $lugar_devolucion = DB::table('alquileres')
            ->select(DB::raw('count(*) as count, lugar_devolucion '))
            ->groupBy('lugar_devolucion')
            ->orderBy('count','DESC')
            ->get();
        $servicio = DB::table('alquileres')
            ->select(DB::raw('count(*) as count, servicio '))
            ->groupBy('servicio')
            ->orderBy('count','DESC')
            ->get();
        $forma_pago = DB::table('alquileres')
            ->select(DB::raw('count(*) as count, forma_pago '))
            ->groupBy('forma_pago')
            ->orderBy('count','DESC')
            ->get();
        $clientes = DB::table('alquileres')
            ->select(DB::raw('cliente_id , count(*) as count, concat(clientes.nombre ," ", clientes.apellido ) AS cliente'))
            ->orderBy('count','DESC')
            ->join('clientes','alquileres.cliente_id', '=', 'clientes.id')
            ->groupBy('cliente_id')
            ->limit(10)
            ->get();


        $vehiculos = DB::table('alquileres')
            ->select(DB::raw('
                count(*) as count, 
                alquileres.vehiculo_id as vehiculo_id ,
                marcas.nombre as marca_nombre,
                vehiculos.modelo as modelo,
                vehiculos.patente as patente,
                vehiculos.marca_id as marca_id
            '))
            ->join('vehiculos', 'alquileres.vehiculo_id', '=', 'vehiculos.id')
            ->join('marcas', 'vehiculos.marca_id', '=', 'marcas.id')
            
            ->groupBy('vehiculo_id')
            ->orderBy('count','DESC')
            ->limit(10)
            ->get();
        return response()->json(['vehiculos'=>$vehiculos,'clientes'=>$clientes,'forma_pago'=>$forma_pago,'servicio'=>$servicio,'lugar_entrega'=> $lugar_entrega,'lugar_devolucion'=> $lugar_devolucion, 'diario'=>$diario,'mensual'=>$mensual, 'anual'=>$anual],200);

        
    }
}
