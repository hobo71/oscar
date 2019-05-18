@extends('layouts.app')

@section('content')


{!! Form::model($cliente, ['action'=>['ClienteController@update',$cliente->id], 'method'=>'PATCH']) !!}
{!! Form::token() !!}

<div class="container">
    <div class="row">
        <div class="col">
        	<div class="card">
        		<div class="card-body">
        			<div class="row mb-3">
        				<div class="col-md-6">
							<h2>Editar Cliente</h2>
        				</div>
        				<div class="col-md-6 text-right">
        					<div class="btn-group btn-group-justified" role="group" aria-label="...">
								<div class="btn-group" role="group">
									<a href="{{ url()->previous() }}" class="btn btn-lg btn-outline-secondary">Cancelar</a>
								    <button type="submit" class="btn btn-lg btn-outline-danger ">Actualizar</button>
								</div>
							</div>
        				</div>
        			</div>
		        		
						<div class="form-group row">

							<div class="col-md-3">
								{!! Form::label('nombre') !!}
								{!! Form::text('nombre', null, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-3">
								{!! Form::label('apellido') !!}
								{!! Form::text('apellido', null, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-3">
								{!! Form::label('dni') !!}
								{!! Form::text('dni', null, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-3">
							{!! Form::label('empresa_id','Empresa') !!}
							<select name="empresa_id" class="form-control">
								<option value="0">Ninguna</option>
								@foreach( $empresas as $id => $empresa )
									<option value="{{ $id }}">{{ $empresa }}</option> 
								@endforeach
							</select>
							</div>
						</div>
						

						<div class="form-group row">
							<div class="col-md-2">
						        {!! Form::label('domicilio') !!}
						        {!! Form::text('domicilio', null, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-2">
						        {!! Form::label('domicilio_temporal') !!}
						        {!! Form::text('domicilio_temporal', null, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-2">
						        {!! Form::label('celular') !!}
						        {!! Form::text('celular', null, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-2">
						        {!! Form::label('telefono') !!}
						        {!! Form::text('telefono', null, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-4">
						        {!! Form::label('email') !!}
						        {!! Form::email('email', null, ['class'=>'form-control']) !!}
							</div>
							
							
						</div><!-- /.form-group -->
						<div class="form-group row">
							<div class="col-md-1">
								{!! Form::label('vip') !!}
								{!! Form::checkbox('vip', null, null, ['class'=>'form-control']) !!}
							</div><!-- /.col-md-4 -->
							
							<div class="col-md-11">
								{!! Form::label('observaciones') !!}
								{!! Form::text('observaciones',null,['class'=>'form-control']) !!}
							</div><!-- /.col -->
						</div><!-- /.form-group -->

					
			</form>
				</div> {{-- fin card-body --}}
        	</div> {{-- fin card --}}
		</div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.row -->
@endsection
