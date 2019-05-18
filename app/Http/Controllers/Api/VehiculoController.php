<?php

namespace Camino\Http\Controllers\Api;

use Illuminate\Http\Request;
use Camino\Http\Controllers\Controller;
use Camino\Service;
use Camino\Vehiculo;
use Image;
use DB;

class VehiculoController extends Controller {
   
    public function index() {
        $vehiculos = Vehiculo::
        select('id','marca_id', 'modelo','ciudad', 'patente',  'anio', 'clase','foto')
        ->orderBy('marca_id')
        ->orderBy('modelo')
        ->orderBy('anio')
        ->get();
        return response()->json($vehiculos);
    }

    public function services(Request $request) {
        $services = Service::
            where('vehiculo_id','=',$request->vehiculo_id)
            ->get();
        return response()->json($services);


    }

    public function alquilados(){
        $vehiculos = 
        // \Camino\Alquiler::
        DB::table('alquileres')
            ->select(DB::raw('DISTINCT(vehiculo_id) as id'))
            ->where('fecha_entrega','<=',\Carbon\Carbon::today())
            ->where('fecha_devolucion','>=',\Carbon\Carbon::today())
            ->get();
    //    $vars = get_object_vars($vehiculos);
        // print_r ( (array) $vehiculos );

        return response()->json($vehiculos);
        //SELECT DISTINCT(vehiculo_id)  FROM alquileres WHERE fecha_entrega <= NOW() AND fecha_devolucion >= NOW()
    }

    public function show($id) {
        $vehiculo = Vehiculo::findOrFail($id);
        return response()->json($vehiculo);
    }

    public function store(Request $request) {
        $vehiculo = new Vehiculo;
        $vehiculo->fill($request->all());

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = $request->input('marca').'_'.$request->input('modelo').'_'.$request->input('patente').'.'.$foto->getClientOriginalExtension();
            Image::make($foto)->fit(500,300)->encode('jpg', 10)->save( public_path('/uploads/vehiculos/' . $filename ) );
            $vehiculo->foto = $filename;
        } else {
            $vehiculo->foto = "";
        }
        $vehiculo->save();
        return response()->json($vehiculo);
    }

    public function update(Request $request, $id) {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->fill($request->all());
        $vehiculo->save();
        return response()->json($vehiculo);
    }

    public function destroy($id) {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->delete();
        return response('Vehiculo '.$id.' eliminado', 200);
    }
}
