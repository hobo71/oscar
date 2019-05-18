@extends('layouts.app')

@section('content')

<form enctype="multipart/form-data" action="{{ action('VehiculoController@store') }}" method="POST" role="form">
<input type="hidden" name="_token" value="{{ csrf_token() }}">



<div class="container">
    <div class="row">
        <div class="col">
        	<div class="card">
        		<div class="card-body">
        			<div class="row mb-3">
        				<div class="col-md-6">
							<h2>Nuevo Vehiculo</h2>
        				</div>
        				<div class="col-md-6 text-right">
        					<div class="btn-group btn-group-justified" role="group" aria-label="...">
								<div class="btn-group" role="group">
								    <button type="cancel" class="btn btn-lg btn-outline-secondary">Cancelar</button>
								</div>
								<div class="btn-group" role="group">
								    <button type="submit" class="btn btn-lg btn-outline-danger ">Guardar</button>
								</div>
							</div>
        				</div>
        			</div>
		        		
						<div class="form-group row">
							<div class="col-md-3">
							{!! Form::label('marca_id') !!}
								<select class="form-control form-control-lg" name="marca_id" id="marca_id">
									@foreach ($marcas as $marca)
										<option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-3">
								{!! Form::label('modelo') !!}
								{!! Form::text('modelo', null, ['class'=>'form-control form-control-lg','placeholder'=>'Uno, March, Corsa, etc']) !!}
							</div>
							<div class="col-md-2">
								{!! Form::label('patente') !!}
								{!! Form::text('patente', null, ['class'=>'form-control form-control-lg']) !!}
							</div>
							<div class="col-md-2">
								{!! Form::label('anio') !!}
								{!! Form::text('anio', null, ['class'=>'form-control form-control-lg','maxlength'=>'4']) !!}
							</div>
							<div class="col-md-2">
								{!! Form::label('color') !!}
								<input type="color" maxlength="4" class="form-control" name="color" id="color" placeholder="2010" style="height: 40px;">
								
							</div>
						</div>
						

						<div class="form-group row">
							<div class="col-md-2">
						        {!! Form::label('clase') !!}
						        {!! Form::select('clase', $clases, null, ['class'=>'form-control ']) !!}
							</div>
							<div class="col-md-2">
								{!! Form::label('puertas') !!}
								{!! Form::text('puertas', null, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-2">
								{!! Form::label('cubiertas') !!}
								{!! Form::text('cubiertas', null, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-3">
								{!! Form::label('kilometros') !!}
								{!! Form::text('kilometros', null, ['class'=>'form-control']) !!}
							</div><!-- /.col -->
							<div class="col-md-3">
								{!! Form::label('foto') !!}
								{!! Form::file('foto', ['class'=>'form-control']) !!}
							</div>
						</div><!-- /.form-group -->
						<div class="form-group row">
							<div class="col-md-3">
								{!! Form::label('vto_seguro') !!}
								{!! Form::date('vto_seguro',null, ['class'=>'form-control']) !!}
							</div><!-- /.col-md-3 -->
							<div class="col-md-3">
								{!! Form::label('vto_rto') !!}
								{!! Form::date('vto_rto',null, ['class'=>'form-control']) !!}
							</div><!-- /.col-md-3 -->
							<div class="col-md-3">
								{!! Form::label('vto_habilitacion') !!}
								{!! Form::date('vto_habilitacion',null, ['class'=>'form-control']) !!}
							</div><!-- /.col-md-3 -->
							<div class="col-md-3">
							{!! Form::label('ciudad') !!}
								<select class="form-control " name="ciudad" id="ciudad">
									@foreach ($ciudades as $ciudad=>$key)
										<option value="{{ $ciudad }}">{{ $key }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col">
								{!! Form::label('observaciones') !!}
								{!! Form::textarea('observaciones', null, ['class'=>'form-control','rows'=>'5','placeholder'=>'Escriba aqui las observaciones o comentarios']) !!}
							</div><!-- /.col -->
						</div><!-- /.form-group -->

					
			</form>
				</div> {{-- fin card-body --}}
        	</div> {{-- fin card --}}
		</div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.row -->
@endsection
