@extends('layouts.app') 
@section('content')
<form enctype="multipart/form-data" action="{{ action('EmpresaController@store') }}" method="POST" role="form">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body">
						<div class="row mb-3">
							<div class="col-md-6">
								<h2>Nueva Empresa</h2>
							</div>
							<div class="col-md-6 text-right">
								<div class="btn-group btn-group-justified" role="group" aria-label="...">
									<div class="btn-group" role="group">
										<a href="{{ url()->previous() }}" class="btn btn-lg btn-outline-secondary">Cancelar</a>
										<button type="submit" class="btn btn-lg btn-primary "><i class="fa fa-plus fa-btn"></i> Agregar</button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-4">
								{!! Form::label('nombre') !!} {!! Form::text('nombre', null, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-4">
								{!! Form::label('cuit') !!} {!! Form::text('cuit', null, ['class'=>'form-control']) !!}
							</div>
							{{--
							<div class="col-md-4">
								{!! Form::label('dni') !!} {!! Form::text('dni', null, ['class'=>'form-control']) !!}
							</div> --}}
							<div class="col-md-4">
								{!! Form::label('domicilio') !!} {!! Form::text('domicilio', null, ['class'=>'form-control']) !!}
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-4">
								{!! Form::label('celular') !!} {!! Form::text('celular', null, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-4">
								{!! Form::label('telefono') !!} {!! Form::text('telefono', null, ['class'=>'form-control']) !!}
							</div>
							<div class="col-md-4">
								{!! Form::label('email') !!} {!! Form::email('email', null, ['class'=>'form-control']) !!}
							</div>

						</div>
						<!-- /.form-group -->
						<div class="form-group row">
							<div class="col">
								{!! Form::label('observaciones') !!} {!! Form::text('observaciones',null,['class'=>'form-control']) !!}
							</div>
							<!-- /.col -->
						</div>
						<!-- /.form-group -->

</form>
</div> {{-- fin card-body --}}
</div> {{-- fin card --}}
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.row -->
@endsection