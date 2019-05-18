@extends('layouts.app')

@section('content')
	
	
			<div class="col-6 mx-auto">
				
				<div class="card ">
					<div class="card-body">
						<h4 class="card-title">Valores actuales</h4>
					</div>
					<table class="table ">
						<tbody>
							<tr>
								<th>Auto Chico</th>
								<td  width="50%">${{ $options->valor_auto_chico}}</td>
							</tr>
							<tr>
								<th>Auto Grande</th>
								<td  width="50%">${{ $options->valor_auto_grande}}</td>
							</tr>
							<tr>
								<th>Auto Camioneta</th>
								<td  width="50%">${{ $options->valor_camioneta}}</td>
							</tr>
							<tr>
								<th>Descuento</th>
								<td  width="50%">${{ $options->descuento}} %</td>
							</tr>
							<tr>
								<th>Descuento VIP</th>
								<td  width="50%">${{ $options->descuento_vip}} %</td>
							</tr>
						</tbody>
					</table>

					<div class="card-footer text-center">
						<a class="btn btn-primary" href="{{ url('option/1/edit') }}" role="button"><i class="fa fa-edit"></i> Actualizar Valores</a>
					</div>
				</div>
			</div>
	
@stop