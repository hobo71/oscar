@extends('layouts.app')

@section('content')
{!! Form::model($empresa,['action'=>['EmpresaController@update',$empresa->id],'files'=>true, 'method' => 'PATCH']) !!}

<input type="hidden" name="_token" value="{{ csrf_token() }}">



<div class="container">
    <div class="row">
        <div class="col">
        	<div class="card">
        		<div class="card-body">
        			<div class="row mb-3">
        				<div class="col-md-6">
							<h2>Actualizar Empresa</h2>
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
							<div class="col-md-4">
								{!! Form::label('nombre') !!}
								{!! Form::text('nombre', $empresa->nombre, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-4">
								{!! Form::label('cuit') !!}
								{!! Form::text('cuit', $empresa->cuit, ['class'=>'form-control']) !!}
							</div>
							{{-- <div class="col-md-4">
								{!! Form::label('dni') !!}
								{!! Form::text('dni', null, ['class'=>'form-control']) !!}
							</div> --}}
							<div class="col-md-4">
						        {!! Form::label('domicilio') !!}
						        {!! Form::text('domicilio', $empresa->domicilio, ['class'=>'form-control']) !!}
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-md-4">
						        {!! Form::label('celular') !!}
						        {!! Form::text('celular', $empresa->celular, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-4">
						        {!! Form::label('telefono') !!}
						        {!! Form::text('telefono', $empresa->telefono, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-4">
						        {!! Form::label('email') !!}
						        {!! Form::email('email', $empresa->email, ['class'=>'form-control']) !!}
							</div>
							
							
						</div><!-- /.form-group -->
						<div class="form-group row">
							<div class="col">
								{!! Form::label('observaciones') !!}
								{!! Form::text('observaciones',$empresa->observaciones,['class'=>'form-control']) !!}
							</div><!-- /.col -->
						</div><!-- /.form-group -->

					
			</form>
				</div> {{-- fin card-body --}}
        	</div> {{-- fin card --}}
		</div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.row -->
@endsection
