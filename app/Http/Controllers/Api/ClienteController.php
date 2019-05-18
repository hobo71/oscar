<?php

namespace Camino\Http\Controllers\Api;

use Illuminate\Http\Request;
use Camino\Http\Controllers\Controller;
use Camino\Cliente;
use DB;

class ClienteController extends Controller
{
    public function index(Request $request) {
        $clientes = DB::table('clientes')
            ->select('clientes.id','clientes.apellido','clientes.nombre','clientes.dni','clientes.email','empresas.nombre as empresa','empresas.id AS empresa_id',DB::raw('count(alquileres.id) as cantidad'))
            ->leftJoin('alquileres','alquileres.cliente_id','=','clientes.id')
            ->leftJoin('empresas','empresas.id','=','clientes.empresa_id')
            ->orderBy('apellido')
            ->groupBy('clientes.id');

        if($request->has('page') ) 
            return response()->json($clientes->paginate(12));
        else 
            return response()->json($clientes->get());
    }
    
    public function min() {
        $clientes = Cliente::
            select('id',DB::raw('CONCAT(apellido," ",nombre) as nombre'))
            ->orderBy('apellido')->get();
            return response()->json($clientes);
    }

    public function merge(Request $request) {
        $ids =$request->selected;
        // $ids = explode(',',$request->selected);
        $cliente_nuevo = Cliente::find($ids[0])->replicate();
        $cliente_nuevo->save();

        $clientes = Cliente::whereIn('id',$ids)->get();
        foreach ($clientes as $cliente) {
            foreach ($cliente->alquileres as $alquiler) {
                $alquiler->cliente_id = $cliente_nuevo->id;
                $alquiler->save();
            }
        };
        foreach ($clientes as $cliente) {$cliente->delete();}
            
        
        return response()->json([
            'nuevo id' =>$cliente_nuevo->id,
            'nuevo cliente' => $cliente_nuevo, 
            // 'alquileres nuevos' => $cliente_nuevo->alquileres
        ],200);
    }

    public function show($id) {
        $cliente = Cliente::
        select('id','nombre','apellido','dni','email','domicilio','empresa_id','celular','telefono','foto','vip','observaciones')
        ->with('empresa:id,nombre')
        ->findOrFail($id);
        return response()->json($cliente);
    }

    public function store(Request $request) {
        $cliente = new Cliente;
        $cliente->fill($request->all());

        if ($request->empresa_id == 0) {
            $cliente->empresa_id = null;
        } else {
            $cliente->empresa_id = $request->empresa_id;
        }
        $cliente->save();
        return response()->json($cliente);
    }

    public function update(Request $request, $id) {
        $cliente = Cliente::findOrFail($id);
        $cliente->fill($request->all());

        if ($request->empresa_id == 0) {
            $cliente->empresa_id = null;
        } else {
            $cliente->empresa_id = $request->empresa_id;
        }
        
        $cliente->save();
        return response()->json($cliente);
    }

    public function destroy($id) {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return response('Cliente '.$id.' eliminado', 200);
    }
}
