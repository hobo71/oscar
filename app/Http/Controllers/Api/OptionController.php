<?php

namespace Camino\Http\Controllers\Api;

use Illuminate\Http\Request;
use Camino\Http\Controllers\Controller;
use Camino\Option;

class OptionController extends Controller
{
    public function index() {
        $options = Option::first();
        return response()->json($options);
    }

    public function store(Request $request) {
        $option = Option::first();
        $option->fill($request->all());
        $option->save();
        return response()->json($option);
    }

    public function show($id) {
        $option = Option::first();
        return response()->json($option);
    }

    public function update(Request $request, $id) {
        $option = Option::first();
        $option->fill($request->all());
        $option->save();
        return response()->json($option);
    }

    public function destroy($id) {
        $option = Option::first();
        $option->delete();
        return response('Opciones eliminadas', 200);
    }
}
