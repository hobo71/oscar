@extends('layouts.app')

@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-6 mx-auto">
				
				<div class="card ">
					<div class="card-body">
						<h4 class="card-title">Valores actuales</h4>
					</div>

					{!! Form::model($options,['action'=>['OptionController@update',$options->id],'files'=>'false','method'=>'PUT']) !!}
					{!! Form::token() !!}
					<table class="table ">
						<tbody>
							<tr>
								<th>Auto Chico</th>
								<td width="50%">{!! Form::number('valor_auto_chico', null, ['class'=>'form-control ']) !!}</td>
							</tr>
							<tr>
								<th>Auto Grande</th>
								<td width="50%">{!! Form::number('valor_auto_grande', null, ['class'=>'form-control ']) !!}</td>
							</tr>
							<tr>
								<th>Auto Camioneta</th>
								<td width="50%">{!! Form::number('valor_camioneta', null, ['class'=>'form-control ']) !!}</td>
							</tr>
							<tr>
								<th>Descuento</th>
								<td width="50%">{!! Form::number('descuento', null, ['class'=>'form-control ']) !!}</td>
							</tr>
							<tr>
								<th>Descuento VIP</th>
								<td width="50%">{!! Form::number('descuento_vip', null, ['class'=>'form-control ']) !!}</td>
							</tr>
						</tbody>
					</table>


					<div class="card-footer text-center">
						<button type="submit" class="btn btn-primary" role="button"><i class="fa fa-save fa-btn"></i> Guardar Valores</button>
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div><!-- /.row -->
	</div>

@stop