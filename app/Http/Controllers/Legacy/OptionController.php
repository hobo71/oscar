<?php

namespace Camino\Http\Controllers;

use Illuminate\Http\Request;

use Camino\Http\Requests;
use Camino\Option;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::first();
        return view('options.index')->with([
                'options'=>$options
            ]);
    }  

    public function edit($id)
    {
        $options = Option::first();
        return view('options.edit')->with([
                'options'=>$options
            ]);
    }

    public function create() {}

    public function store(Request $request) {}

    public function show($id) {}

    public function update(Request $request, $id)
    {
        $options = Option::first();
        $options->fill($request->all());
        $options->save();

        return redirect('option');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
