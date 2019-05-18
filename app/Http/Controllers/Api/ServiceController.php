<?php

namespace Camino\Http\Controllers\Api;

use Illuminate\Http\Request;
use Camino\Http\Controllers\Controller;
use Camino\Service;

class ServiceController extends Controller
{
    public function index(Request $request) {
        $services = Service::
        with('vehiculo')
        ->orderBy('fecha','DESC');
        if($request->has('page') ) 
            return response()->json($services->paginate(12));

        return response()->json($services->get());
    }

    public function store(Request $request) {
        $service = new Service;
        $service->fill($request->all());
        $service->save();
        return response()->json($service);
    }

    public function show($id) {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }

    public function update(Request $request, $id) {
        $service = Service::findOrFail($id);
        $service->fill($request->all());
        $service->save();
        return response()->json($service);
    }

    public function destroy($id) {
        $service = Service::findOrFail($id);
        $service->delete();
        return response('Service '.$id.' eliminado', 200);
    }
}
