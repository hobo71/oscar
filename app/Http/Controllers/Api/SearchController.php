<?php

namespace Camino\Http\Controllers\Api;

use Illuminate\Http\Request;
use Camino\Http\Controllers\Controller;

use Camino\Cliente;
use Camino\Vehiculo;
use Camino\Alquiler;
use Camino\Empresa;
use Camino\Service;

use DB;

class SearchController extends Controller
{
    public function search($query) {
        $alquileres = Alquiler::
            select('id','cliente_id','vehiculo_id','fecha_entrega','fecha_devolucion','lugar_devolucion','nro_factura','observaciones')
            ->with('cliente:id,nombre,apellido')
            ->with('vehiculo:id,marca_id,modelo,patente,anio,foto')
            ->where('nro_factura','like','%'.$query.'%')
            ->orWhere('observaciones','like','%'.$query.'%')
            ->orWhere('id','like','%'.$query.'%')
            ->orderBy('id','ASC')
            ->orderBy('nro_factura','ASC')
            ->get();
        $clientes = Cliente::
            select('id','apellido','nombre','dni','email','empresa_id','observaciones')
            ->with('empresa:id,nombre')
            ->where('nombre','like','%'.$query.'%')
            ->orWhere('apellido','like','%'.$query.'%')
            ->orWhere('dni','like','%'.$query.'%')
            ->orWhere('observaciones','like','%'.$query.'%')
            ->orderBy('apellido','ASC')
            ->orderBy('nombre','ASC')
            ->get();
        $vehiculos = Vehiculo::
            select('id','marca_id', 'modelo','ciudad', 'patente',  'anio', 'clase','foto','observaciones')
            ->where('modelo','like','%'.$query.'%')
            ->orWhere('patente','like','%'.$query.'%')
            ->orWhere('observaciones','like','%'.$query.'%')
            ->orderBy('marca_id','ASC')
            ->get();
        $empresas = Empresa::
            select('id','nombre','cuit','email','observaciones')
            ->where('nombre','like','%'.$query.'%')
            ->orWhere('cuit','like','%'.$query.'%')
            ->orWhere('observaciones','like','%'.$query.'%')
            ->orderBy('nombre','ASC')
            ->get();
        $services = Service::
            select('id','vehiculo_id','fecha','titulo','vigencia','detalle','importe')
            ->with('vehiculo:id,marca_id,modelo,patente,foto')
            ->where('titulo','like','%'.$query.'%')
            ->orWhere('detalle','like','%'.$query.'%')
            ->orderBy('titulo','ASC')
            ->get();
                            
        return response()->json([
            'query'=>$query,
            'alquileres'=>$alquileres,
            'clientes'=>$clientes,
            'vehiculos'=>$vehiculos,
            'empresas'=>$empresas,
            'services'=>$services
        ]);
                            
    }
}
