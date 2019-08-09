@extends('layouts.layout2')
@section('content2')

<style type="text/css">
	.jumbotron{
		background-color: #ffffff;
background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='119' height='119' viewBox='0 0 200 200'%3E%3Cpolygon fill='%23DCEFFA' points='100 0 0 100 100 100 100 200 200 100 200 0'/%3E%3C/svg%3E");
background-size: cover;
	}

</style>



<div class="container" style="padding-top: 50px;">


    <div class="jumbotron jumbo-estatus my-4">
      <h3 >Mis solicitudes</h3>
      <p class="lead">Puedes verificar estatus de tus solicitudes en esta sección, cada vez que tu solicitud cambie de estatus, recibirás un email con la notificación correspondiente
      </p>
      
    </div>
	<body>

<table class="table table-striped table-hover">
	<thead>
				<tr>
					<th><p>Nombre</p></th>
					 <th><p>Voucher</p></th>
					<th><p>Documento</p></th>
					<th><p>Nro. Servicio</p></th>
					<th><p>Monto solicitado</p></th>
					<th><p>Fecha de solicitud</p></th>                       
                    <th><p>Estatus</p></th>
					<th><p>Estado</p></th>
				</tr>
	</thead>
	<tbody>
		@if($listadoRegistros->count())
		@foreach($listadoRegistros as $afiliadoData)
		        <tr>
		        	<td>{{$afiliadoData->nombre}}</td>
		        	<td>{{$afiliadoData->voucher}}</td>
		        	<td>{{$afiliadoData->documento}}</td>
		        	<td>{{$afiliadoData->servicio}}</td>
		        	<td>{{$afiliadoData->monto_solicitado}}</td>
		        	<td>{{$afiliadoData->fecha_solicitud}}</td>
		        	<td>
		        		@if($afiliadoData->estatus_solicitud == 2)
                        
                        <span class="badge badge-success">Recibido</span>

		        		@elseif($afiliadoData->estatus_solicitud == 3)
 
                        <span class="badge badge-info">En análisis</span>

		        		@elseif($afiliadoData->estatus_solicitud == 4)

                         <span class="badge badge-success">Aprobado</span>

		        		@elseif($afiliadoData->estatus_solicitud == 5)

                         <span class="badge badge-danger">Negado</span>

		        		@elseif($afiliadoData->estatus_solicitud == 6)

                        <span class="badge badge-warning">Aprobado parcial</span>

		        		@elseif($afiliadoData->estatus_solicitud == 7)

                          <span class="badge badge-warning">Documentación faltante</span>

		        		@endif
		        	</td>
		        	<td>
		        		@if($afiliadoData->estado == 0)

		        		<span class="badge badge-success">Por verificar</span>

		        		@elseif($afiliadoData->estado == 1)

		        		<span class="badge badge-success">Abierto</span>

		        		@elseif($afiliadoData->estado == 2)

		        		<span class="badge badge-danger">Cerrado / Pagado</span>

		        		@elseif($afiliadoData->estado == 3)

		        		<span class="badge badge-danger">Cerrado</span>


		        		@endif
		        	</td>
		        	
		        </tr>

		        @endforeach
		         @else
		         <tr>

		        <td>No hay datos</td>
		        <td></td>
		        <td></td>
		        <td></td>
		        <td></td>
                <td></td>
                <td></td>
		        <td></td>
		        </tr>
		        @endif
	</tbody>			
				
			</table>

			
                </div>



@endsection