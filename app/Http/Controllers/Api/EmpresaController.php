<?php

namespace Camino\Http\Controllers\Api;

use Illuminate\Http\Request;
use Camino\Http\Controllers\Controller;
use Camino\Empresa;
use Camino\Cliente;
use Image;
use DB;

class EmpresaController extends Controller
{
    public function index() {
        $empresas = Empresa::
        select('id','nombre','cuit','email')
        ->orderBy('nombre')
        ->get();
        return response()->json($empresas);
    }


    public function show($id) {
        $empresa = Empresa::with('cliente:id,nombre,apellido,dni,email,vip,empresa_id')->findOrFail($id);
        
        // $clientes = \Camino\Cliente::where('empresa_id',$id)->orderBy('nombre','ASC')->get();
        // select * from alquileres where cliente_id in (select id from clientes where empresa_id= 1048)
        $alquileres = \Camino\Alquiler::
            select('id','cliente_id','vehiculo_id','fecha_entrega','fecha_devolucion')
            ->whereIn('cliente_id' , Cliente::select('id')->where('empresa_id','=',$id))
            ->with('vehiculo:id,patente,foto,marca_id,modelo','cliente:id,apellido,nombre')
            ->orderBy('fecha_entrega','DESC')
            ->get();


        return response()->json(['alquileres'=>$alquileres,'empresa'=>$empresa],200);
    }
    
    public function store(Request $request) {
        $empresa = new Empresa;
        $empresa->fill($request->all());

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = $request->nombre.'.'.$foto->getClientOriginalExtension();
            Image::make($foto)->fit(500,500)->encode('jpg', 10)->save( public_path('/uploads/empresas/' . $filename ) );
            $empresa->foto = $filename;
        } else {
            $empresa->foto = "";
        }

        $empresa->save();
        return response()->json($empresa);
    }


    public function update(Request $request, $id) {
        $empresa = Empresa::findOrFail($id);
        $empresa->fill($request->all());
        $empresa->save();
        return response()->json($empresa);
    }

    public function destroy($id) {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();
        return response('Empresa '.$id.' eliminada', 200);
    }
}
