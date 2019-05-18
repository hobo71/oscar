@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h2>{!! $empresa->nombre !!} </h2>
                </div>
                <div class="card-header text-center">
                    <div class="btn-group">
                        <a href="{{ action('EmpresaController@edit',$empresa->id) }}" class="btn btn-outline-warning btn-sm"><i class="fa fa-btn fa-pencil"></i> Editar</a>
                        <a href="mailto:{{ $empresa->email }}" class="btn btn-secondary btn-sm"><i class="fa fa-btn fa-envelope"></i> Enviar Email</a>
                    </div>
                </div>
                <table class="table  ">
                    <tbody>
                        <tr >
                            <td class="">CUIT/CUIL : {{ $empresa->cuit }} <br><hr>
                            {{ $empresa->domicilio }}<br> <hr>
                            {{ $empresa->celular }} <br>{{ $empresa->telefono }} <br>
                        </tr>
                    </tbody>
                </table>
            </div>
        
        </div><!-- /.col -->

       <div class="col-md-9">

       <div class="card">
                <div class="card-body pb-2">
                    <h4><i class="fa fa-btn fa-users"></i> Empleados registrados</h4>
                </div>


            <table class="table  ">
                <thead >
                    <tr>
                        <th>nombre</th>
                        <th>celular</th>
                        <th class="text-right">Acciones</th>
                        {{-- <th>foto</th> --}}
                        {{-- <th width="15%">observaciones</th> --}}
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr >
                        {{-- <td>{{ $cliente->foto }}</td> --}}
                        <td>{!! $cliente->badge() !!}</td>
                        <td class="small">{{ $cliente->celular }} <br>{{ $cliente->telefono }} </td>
                        <td class="text-right">
                            <div class="btn-group">
                                
                                <a href="mailto:{{ $cliente->email }}" class="btn btn-secondary btn-sm"><i class="fa fa-btn fa-envelope"></i> Enviar Email</a>
                                <a class="btn btn-sm btn-outline-warning" href="{{ action('ClienteController@edit',$cliente->id) }}"><i class="fa fa-btn fa-pencil"></i> Editar</a>
                                <a class="btn btn-sm btn-outline-primary" href="{{ action('ClienteController@show',$cliente->id) }}"><i class="fa fa-btn fa-arrow-right"></i> Ver</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            
        
            </table>
        </div>

        <hr />
            <div class="card">
                <div class="card-body pb-2">
                    <h4><i class="fa fa-btn fa-history"></i> Historial de Alquileres</h4>
                </div>


            <table class="table ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Vehiculo</th>
                        <th>Itinerario</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alquileres as $alquiler)
                    <tr style="opacity : {{ $alquiler->estadoClass() }}"  >
                        <td>{!! $alquiler->badge() !!}</td>
                        <td> {!! $alquiler->vehiculo->badge() !!} </td>
                        <td class="small">{!! $alquiler->itinerario() !!}</td>
                        {{-- <td><strong>${{ $alquiler->cotizacion }}</strong></td> --}}
                        <td>{!! $alquiler->estado() !!}</td>
                        <td class="text-right"><a class="btn btn-sm btn-secondary" href="{{ action('AlquilerController@show',$alquiler->id) }}"><i class="fa fa-arrow-right"></i></a></td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        
    </div><!-- /.col -->
</div><!-- /.row -->

</div>
@endsection
