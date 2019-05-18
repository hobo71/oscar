<?php

namespace Camino\Http\Controllers\Api;

use Illuminate\Http\Request;
use Camino\Http\Controllers\Controller;

class DataController extends Controller
{
    public function index(){

        $ciudades = [
            0=>'Rio Grande',
            1=>'Ushuaia',
            2=>'Tolhuin',
            3=>'Otra',
        ];
        $servicios = [
            0=>'Senda',
            1=>'Despegar',
            2=>'Otro',
            3=>'Pagina Web'
        ];
        $formas_pago = [
            0=>'Efectivo',
            1=>'Tarjeta',
            2=>'Cheque', 
            3=>'Transferencia',
            4=>'Deposito',
            5=>'A Credito',
            6=>'PayU',
        ];
        $vehiculo_clases = [
            0=>'Chico',
            1=>'Mediano',
            2=>'Grande'
        ];
        return response()->json([
            'lugares'=> \Camino\Lugares::LIST,
            'servicios'=>$servicios,
            'formas_pago'=>$formas_pago,
            'vehiculo_clases'=>$vehiculo_clases,
            'ciudades'=>$ciudades,
        ],200);
    }
}
