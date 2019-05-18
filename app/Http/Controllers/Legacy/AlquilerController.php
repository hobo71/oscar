<?php

namespace Camino\Http\Controllers;

use Illuminate\Http\Request;

use Camino\Http\Requests;
use Camino\Alquiler;
use Camino\Vehiculo;
use Camino\Cliente;
use Camino\Option;

use Carbon\Carbon;
use Session;
use Redirect;

class AlquilerController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->carbon_ahora = Carbon::now();
        $this->carbon_hoy = Carbon::today();
        $this->lugares = ['Aeropuerto RG' , 'Aeropuerto USH', 'Vicente Lopez 225', 'RGA Parking','Senda Renting','Centro Rio Grande','Centro Ushuaia','Terminal RG','Terminal USH'];
        $this->servicios = ['Senda','Despegar','Otro'];
        $this->pagos = ['Efectivo','Tarjeta','Cheque', 'Transferencia','Deposito','A Credito'];

    }


    public function store(Request $request) {
       

        $alquiler = new Alquiler;

        // cliente ID
        if ($request->cliente_toggle != null) {
            $alquiler->cliente_id = $request->cliente_id;
        } else {
            $cliente = new Cliente;
            $cliente->nombre = $request->cliente_nombre;    
            $cliente->apellido = $request->cliente_apellido;    
            $cliente->foto = "default.jpg";
            $cliente->save();

            $pid = $cliente->id;
            $alquiler->cliente_id = $pid;
        }

        $desde = Carbon::parse($request->fecha_entrega);
        $hasta = Carbon::parse($request->fecha_devolucion);
        

        $alquiler->fill($request->all());
        
        $dias = $desde->diffInDays($hasta);


        // get vehiculo ID and tipo
        $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);


        // get empresa
        $cliente = Cliente::findOrFail($request->cliente_id);
            if ($cliente->empresa_id !=  null   ) {
                $alquiler->empresa_id = $cliente->empresa_id;
            }
        

        $alquiler->save();

        // redirect
        Session::flash('message', 'Alquiler creado!');
        return Redirect::to('alquiler');
    }

    public function update(Request $request, $id) {

        $alquiler = Alquiler::findOrFail($id);

        // cliente ID
        if ($request->cliente_toggle != null) {
            $alquiler->cliente_id = $request->cliente_id;
        } else {
            $cliente = new Cliente;
            $cliente->nombre = $request->cliente_nombre;    
            $cliente->apellido = $request->cliente_apellido;    
            $cliente->foto = "default.jpg";
            $cliente->save();

            $pid = $cliente->id;
            $alquiler->cliente_id = $pid;
        }

        $alquiler->cotizacion = $cotizacion;

        // get empresa
        $cliente = Cliente::findOrFail($request->cliente_id);
            if ($cliente->empresa_id !=  null   ) {
                $alquiler->empresa_id = $cliente->empresa_id;
            }
        
        $alquiler->save();

        // redirect
        Session::flash('message', 'Alquiler actualizado correctamente!');
        return redirect('alquiler');
    }

    public function data()
    {
        $data = array(); //declaramos un array principal que va contener los datos
        $alquileres = Alquiler::with('vehiculo')->with('cliente')->get(); //listamos todos los id de los eventos
 
        foreach ($alquileres as $alquiler) {
            $titulo_evento = strtoupper($alquiler->vehiculo->patente).' '.$alquiler->cliente->apellido;
            $data[] = array(
                "title"=>$titulo_evento, 
                "start"=>$alquiler->fecha_entrega->format('Y-m-d'), 
                "end"=>$alquiler->fecha_devolucion->addDay()->format('Y-m-d'), 
                "color"=>$alquiler->vehiculo->color, 
                "url"=>"alquiler/".$alquiler->id
            );
        }
 
        json_encode($data); //convertimos el array principal $data a un objeto Json
 
        return response()->json($data); //para luego retornarlo y estar listo para consumirlo
    }

    public function dataResource()
    {
        $data = array(); //declaramos un array principal que va contener los datos
        $alquileres = Alquiler::with('vehiculo')->with('cliente')->get(); //listamos todos los id de los eventos
 
        foreach ($alquileres as $alquiler) {
            $titulo_evento = $alquiler->cliente->apellido;
            $tooltip = strtoupper($alquiler->vehiculo->patente).' '.$alquiler->cliente->apellido;
            $textColor = ($alquiler->vehiculo->color == "#ffffff") ? "#000000" : "#ffffff";
            $data[] = array(
                "title"=>$titulo_evento, 
                'description'   =>  $tooltip,
                "start"=>$alquiler->fecha_entrega->format('Y-m-d'), 
                "end"=>$alquiler->fecha_devolucion->addDay()->format('Y-m-d'), 
                "color"=>$alquiler->vehiculo->color, 
                "textColor"=>$textColor, 
                "eventBorderColor"=>$textColor, 
                "url"=>$alquiler->id,
                "resourceId"    => $alquiler->vehiculo->id
            );
        }
 
        json_encode($data); //convertimos el array principal $data a un objeto Json
 
        return response()->json($data); //para luego retornarlo y estar listo para consumirlo
    }

    public function stats() {
        return view('alquiler.stats');
    }


}
