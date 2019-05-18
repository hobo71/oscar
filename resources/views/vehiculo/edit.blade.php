@extends('layouts.app')

@section('content')

{!! Form::model($vehiculo,['action'=>['VehiculoController@update',$vehiculo->id],'files'=>true, 'method' => 'PATCH']) !!}
{!! Form::token() !!}

<div class="container-fluid">
    <div class="row">
        <div class="col">
        	<div class="card">
        		<div class="card-body">
        			<div class="row mb-3">
        				<div class="col">
							<h2>Editar Vehiculo</h2>
        				</div>
        				<div class="col text-right">
        					<div class="btn-group btn-group-justified" role="group" aria-label="...">
								<div class="btn-group" role="group">
									<a href="{{ url()->previous() }}" class="btn btn-lg btn-outline-secondary">Cancelar</a>
								</div>
								<div class="btn-group" role="group">
								    <button type="submit" class="btn btn-lg btn-primary "><i class="fa fa-save fa-btn"></i> Actualizar</button>
								</div>
							</div>
        				</div>
        			</div>
		        		
						<div class="form-group row">
							<div class="col-md-3">
							{!! Form::label('marca_id') !!}
								<select class="form-control form-control-lg" name="marca_id" id="marca_id">
									@foreach ($marcas as $marca)
										<option @if($marca->id == $vehiculo->marca_id) selected="" @endif value="{{ $marca->id }}">{{ $marca->nombre }}</option>
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
								<input type="color" class="form-control" name="color" id="color" value="{{ $vehiculo->color }}" style="height: 40px;">
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
								{!! Form::date('vto_seguro',$vehiculo->vto_seguro, ['class'=>'form-control']) !!}
							</div><!-- /.col-md-3 -->
							<div class="col-md-3">
								{!! Form::label('vto_rto') !!}
								{!! Form::date('vto_rto',$vehiculo->vto_rto, ['class'=>'form-control']) !!}
							</div><!-- /.col-md-3 -->
							<div class="col-md-3">
								{!! Form::label('vto_habilitacion') !!}
								{!! Form::date('vto_habilitacion',$vehiculo->vto_habilitacion, ['class'=>'form-control']) !!}
							</div><!-- /.col-md-3 -->
							<div class="col-md-3">
							{!! Form::label('ciudad') !!}
								<select class="form-control " name="ciudad" id="ciudad">
									@foreach ($ciudades as $ciudad=>$key)
										<option value="{{ $ciudad }}" @if( $key == $vehiculo->ciudad) selected="selected" @endif>{{ $key }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col">
								{!! Form::label('observaciones') !!}
								{!! Form::textarea('observaciones', $vehiculo->observaciones, ['class'=>'form-control','rows'=>'5','placeholder'=>'Escriba aqui las observaciones o comentarios']) !!}
							</div><!-- /.col -->
						</div><!-- /.form-group -->

					
			</form>
				</div> {{-- fin card-body --}}
        	</div> {{-- fin card --}}
		</div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.row -->
@endsection
