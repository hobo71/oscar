<?php

namespace Camino\Http\Controllers;

use Illuminate\Http\Request;

use Camino\Vehiculo;
use Camino\Empresa;
use Camino\Cliente;
use Camino\Alquiler;

use Camino\Http\Requests;

class MainController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        return view('home');
    }

    public function slide() {
        $vehiculos = Vehiculo::all();
        return view('vehiculo.slide') ->with('vehiculos',$vehiculos);
    }

   
}
