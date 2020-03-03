@extends('layouts.layout3')

@section('content3')
<style type="text/css">
	.modal-lg {
    min-width: 50% !important;
}
  th{
    font-weight: bold !important;
}
</style>
<script type="text/javascript">


function AgregarArchivos() {
    $(".attachment-row:last").clone().insertAfter(".attachment-row:last");
    $(".attachment-row:last").find("input").val("");
}
</script>
<script type="text/javascript">


function AgregarCC() {
    $(".attachment-row2:last").clone().insertAfter(".attachment-row2:last");
    $(".attachment-row2:last").find("input").val("");
}
</script>
<style type="text/css">
	.attachment-form-container {
    background: #F0F0F0;
    border: #e0dfdf 1px solid;
    padding: 20px;
    border-radius: 2px;
}

.input-row {
    margin-bottom: 20px;
    width: 95%;
}

.attachment-row {
    margin-bottom: 20px;
    width: 95%;
    float: left;
}

.attachment-row2 {
    margin-bottom: 20px;
    width: 95%;
    float: left;
}

.icon-add-more-attachemnt {
    float: right;
    margin-top: 10px;
    cursor: pointer;
}

.attachment-row .input-field {
    border: #a8b0bd 1px solid;
}
.input-field {
    width: 100%;
    border-radius: 2px;
    padding: 10px;
    border: #e0dfdf 1px solid;
    box-sizing: border-box;
}

.span-field {
    font: Arial;
    font-size: small;
    text-decoration: none;
}
</style>
<hr>

<br>
<br>

@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    	<p>Corrige los siguientes errores:</p>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    </div>
@endif

@if(Session::has('formulario_info_fallida2'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {!! session('formulario_info_fallida2') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(Session::has('formulario_info_fallida'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {!! session('formulario_info_fallida') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(Session::has('ficha_actualizada'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {!! session('ficha_actualizada') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


@if(Session::has('estado_actualizado'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {!! session('estado_actualizado') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(Session::has('formulario_info'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {!! session('formulario_info') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(Session::has('estado_actualizado2'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {!! session('estado_actualizado2') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(Session::has('evento_insertado'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {!! session('evento_insertado') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(Session::has('info_adm'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {!! session('info_adm') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif



<div class="d-flex">

  <div class="p-2"><h5>Ficha Informativa</h5></div>
 
  <div class="ml-auto p-2"><a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cambioEstatus">Modificar Estatus</a></div>
  <div class="ml-auto p-2"><a href="#" class="btn btn-sm btn-secondary " data-toggle="modal" data-target="#bitacora">Bitacora del caso</a></div>
</div>



<table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
				<tr>
					<th width="30%">Cliente</th>
					<td><span class="badge badge-info">{{$cliente}}</span></td>
				</tr>
				<tr>
					<th width="30%">Caso</th>
					<td><span>{{$caso}}</span></td>
                 
				</tr>
				<tr>
					<th width="30%">Servicio</th>
					<td><span>{{$servicio}}</span></td>
                 
				</tr>
				<tr>
					<th width="30%">Voucher</th>
					<td><span>{{$voucher}}</span></td>
                 
				</tr>
				<tr>
					<th width="30%">Nombre del pasajero</th>
					<td><span>{{$nombrePasajero}}</span></td>
                 
				</tr>
				<tr>
					<th width="30%">Documento</th>
					<td><span>{{$documento}}</span></td>
				</tr>
				<tr>
					<th width="30%">Plan</th>
					<td><span>{{$planNombre}}</span></td>
				</tr>
				<tr>
					<th width="30%">Cobertura</th>
					<td><span>{{$nombreSubservicio}}</span></td>
				</tr>
				<tr>
					<th width="30%">Fecha de solicitud</th>
					<td><span>{{$fechaSolicitud}}</span></td>
				</tr>
				<tr>
					<th width="30%">Dirección de ocurrencia</th>
					<td><span>{{$direccionEvento}}</span></td>
				</tr>
				<tr>
					<th width="30%">Aerolinea</th>
					<td><span>
          @if($aerolinea == NULL)
          -
          @else
          {{$aerolinea}}
          @endif
        </span></td>
				</tr>
				<tr>
					<th width="30%">PIR</th>
					<td>
            @if($pir == NULL)
          -
          @else
          {{$pir}}
          @endif</td>
				</tr>
				<tr>
					<th width="30%">Monto del gasto según pasajero</th>
					<td><span>{{$montoSolicitado}}</span></td>
				</tr>
				<tr>
					<th width="30%">Moneda</th>
					<td><span>{{$moneda}} - {{$isoMoneda}}</span></td>
				</tr>
				<tr>
					<th width="30%">País incidencia</th>
					<td><span>{{$paisOcurrencia}}</span></td>
				</tr>
				<tr>
					<th width="30%">País residencia</th>
					<td><span>{{$paisResidencia}}</span></td>
				</tr>
				<tr>
					<th width="30%">Nacionalidad</th>
					<td><span>{{$paisNacionalidad}}</span></td>
				</tr>
				<tr>
					<th width="30%">Documentación enviada por el pasajero</th>
					<td><span class="badge badge-info"><a href="{{route('archivospax', $servicio)}}">
            Ver documentos <i class="fas fa-file-alt"></i></a>
          </span>
        </td>
				</tr>
				<tr>
					<th width="30%">Fecha de ocurrencia de gasto</th>
					<td><span>{{$fechaOcurrencia}}</span></td>
				</tr>
				<tr>
					<th width="30%">Estatus de la solicitud</th>
					<td><span class="badge badge-info">{{$nombreEstatus}}</span></td>
				</tr>
				<tr>
					<th width="30%">Aclaratorias del pasajero</th>
					<td><span>{{$observaciones}}</span></td>
				</tr>
				<tr>
					<th width="30%">Email</th>
					<td><span>{{$email}}</span></td>
				</tr>

				</table>


				<hr>
			<h5>Ficha administrativa <a style="padding: 3px;font-size: 12px;"  data-toggle="modal" data-target="#infoAdm"> Editar</a></h5>

			<table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
				<tr>
					<th width="30%">Estado Administrativo</th>
					<td>
            <span class="badge badge-info">{{$nombreEstado}}</span>
            <a href="#" style="padding: 3px; font-size: 12px;" data-toggle="modal" data-target="#estadoCaso"> Editar</a>
          </td>
				</tr>
				<tr>
					<th width="30%">Monto aprobado</th>
					@if($montoAprobado == NULL)

					<td><span>Por determinar</span></td>

					@else

                    <td><span>{{$montoAprobado}}</span></td>

					@endif
				</tr>
				<tr>
					<th width="30%">Moneda de pago</th>
					<td><span>{{$monedaPagoReal}}</span></td>
				</tr>
				<tr>
					<th width="30%">Fecha de envio del formulario</th>
					<td>
            <span>{{$fechaRealEnvio}}</span>
            <a href="#" data-toggle="modal" data-target="#formularioEnvio"><i class="fas fa-calendar">
          </td>

				</tr>
				<tr>
					<th width="30%">Fecha de recepción del formulario</th>
					<td>
            <span>{{$fechaRealRecepcion}}</span>
            <a href="#" data-toggle="modal" data-target="#formularioRecepcion"><i class="fas fa-calendar"></i></a>
          </td>
				</tr>
				<tr>
					<th width="30%">Medio de Pago</th>
					<td><span>{{$medioPago}}</span></td>
				</tr>
				<tr>
					<th width="30%">Documentos administrativos</th>
					<td><span class="badge badge-info"><a href="{{route('archivosAdm', $servicio)}}">Ver documentos <i class="fas fa-file-alt"></i></a></span></td>
				</tr>


			</table>

			<hr>
            
            <h5>Ficha de pago 
            	<span class="badge badge-info">
            		
                   {{$medioPago}}

            	</span>
              <a href="#" style="font-size: 14px" data-toggle="modal" data-target="#editarFicha" style="padding: 2px;"> Editar</a>

            </h5>

            @if($medioPagoId == 0)
                
                {!! $fichaMedio !!}

            @elseif($medioPagoId == 1)
                
             <table class="table table-striped table-bordered table-sm">
<tr>
	<th width="30%">Fecha para pago</th>

	<td>{{$fechaPagoReal}}</td>

</tr>
<tr>
	<th>Nombre Completo</th>

     <td>{{$titularReal}}</td>


</tr>
<tr>
	<th>País</th>
	
	<td>{{$paisPagoReal}}</td>
</tr>
<tr>
	<th>Estado ó Provincia</th>
	
	<td>{{$provinciaPagoReal}}</td>



</tr>

<tr>
	<th>Ciudad</th>
	
	<td>{{$ciudadPagoReal}}</td>


</tr>

<tr>
	<th>Enviar ficha de pago</th>
	<td><a href="#" data-toggle="modal" data-target="#modalEnvioadm"><span class="badge badge-info">Enviar</span></a></td>
</tr>

</table>

 @elseif($medioPagoId == 2)
                
            <table class="table table-striped table-bordered table-sm">
<tr>
  <th width="30%">Fecha para pago</th>
  <td>{{$fechaPagoReal}}</td>
</tr>
<tr>
  <th>Titular de la cuenta bancaria</th>
  <td>{{$titularReal}}</td>
</tr>
<tr>
  <th>N° de documento de identidad</th>
  <td>{{$documentoPagoReal}}</td>
</tr>
<tr>
  <th>Banco</th>

  <td>{{$bancoPagoReal}}</td>

</tr>

<tr>
  <th>N° de cuenta</th>
  <td>{{$cuentaPagoReal}}</td>
</tr>

<tr>
  <th>Tipo de cuenta</th>
  <td>{{$tipoCuentaReal}}</td>
</tr>
<tr>
  <th>Enviar ficha de pago</th>
  <td><a href="#" data-toggle="modal" data-target="#modalEnvioadm"><span class="badge badge-info">Enviar</span></a></td>
</tr>

</table>

@elseif($medioPagoId == 3)      


<table class="table table-striped table-bordered table-sm">
<tr>
  <th width="30%">Fecha para pago</th>

  <td>{{$fechaPagoReal}}</td>
  
 
</tr>
<tr>
  <th>Titular de la cuenta bancaria</th>

  <td>{{$titularReal}}</td>

</tr>
<tr>
  <th>N° de documento de identidad</th>

 <td>{{$documentoPagoReal}}</td> 
 
</tr>
<tr>
  <th>Banco</th>
  
  <td>{{$bancoPagoReal}}</td> 
 

</tr>

<tr>
  <th>N° de cuenta</th>
 <td>{{$cuentaPagoReal}}</td> 

</tr>

<tr>
  <th>Tipo de cuenta</th>
  <td>{{$tipoCuentaReal}}</td> 



</tr>

<tr>
  <th>Código Swift y/o Aba</th>
  <td>{{$swiftReal}}</td> 

  
</tr>

<tr>
  <th>Dirección del banco</th>
  <td>{{$direccionBancoReal}}</td>
</tr>

<tr>
  <th>Dirección domiciliada</th>
   <td>{{$direccionBancoDomiciladaReal}}</td>



<tr>
  <th>Enviar ficha de pago</th>
  <td><a href="#" data-toggle="modal" data-target="#modalEnvioadm"><span class="badge badge-info">Enviar</span></a></td>
</tr>

</table>     


    @elseif($medioPagoId == 4) 

<table class="table table-striped table-bordered table-sm">
<tr>
  <th width="30%">Fecha para pago</th>

  <td>{{$fechaPagoReal}}</td>
 
</tr>

<tr>
  <th>Observaciones</th>

 <td>{{$especificacionesEfectivo}}</td> 
 
</tr>

<tr>
  <th>Enviar ficha de pago</th>
  <td><a href="#" data-toggle="modal" data-target="#modalEnvioadm"><span class="badge badge-info">Enviar</span></a></td>
</tr>

</table>     




    @endif




    <div class="modal fade" id="modalEnvioadm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEnvioadm">Datos del envío</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" class="form-group" action="{{route('envioadm',$servicio)}}">
          {{@csrf_field()}}
          <p>No sé enviaran adjuntos los documentos que se encuentran en la carpeta administrativa, verifica que se encuentren todos los archvios necesarios para el pago, así el departamento administrativo pordrá verificar toda la información</p>
          <label for="aclaratorias">Observaciones: </label>
          <textarea id="ckeditor" class="form-control" name="aclaratorias"></textarea>
          <br>
          <label for="receptores">Enviar a:</label>
          <br>
          <br>
            <div class="attachment-row2 col-md-7">
            <input type="email" class="input-field form-control" name="receptores[]" required>
          </div>
          <div onClick="AgregarCC();" class="icon-add-more-attachemnt" title="Agregar más archivos"> <span class="badge badge-info"><i class="fas fa-plus"></i> </span>
          </div>

          

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>



            <!-- Modal Cambio de estatus -->
<div class="modal fade" id="cambioEstatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificación de <b>estado</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" method="POST" action="{{ route('cambioEstatus', $servicio) }}" enctype="multipart/form-data">
        	{{@csrf_field()}}
        	<label for="estatus_solicitud">Estado del caso</label>
        	<select class="form-control" name="estatus_solicitud">
        		<option selected disabled>Seleccionar</option>
        		@foreach($estatusSolicitudListado as $estatus)
                <option value="{{$estatus->codigo}}">{{$estatus->estatus}}</option>
        		@endforeach
        	</select>
<br>

  <div class="form-check">
 <input type="checkbox" name="check" class="form-check-input align-middle" id="check" onchange="javascript:showContent()">
    <label class="form-check-label" for="check">Notificar al pasajero</label>
  </div><br>
  <div id="content" style="display: none;">
  	     
         <p>Email del pasajero: <span class="badge badge-info">{{$email}}</span></p>



<label for="mensaje">Mensaje para el pasajero</label>
  <textarea name="mensaje" class="ckeditor form-control" maxlength="10000"></textarea>
<br>
 <div class="form-check">
 <input type="checkbox" name="check1" class="form-check-input align-middle" id="check1" onchange="javascript:showContent1()">
    <label class="form-check-label" for="check1">Email con copia</label>
  </div><br>
<div id="content1" style="display: none;">
	<label for="cc1"></label>
	<input type="email" class="form-control" name="cc1">
	<label for="cc2"></label>
	<input type="email" class="form-control" name="cc2">
	<label for="cc3"></label>
	<input type="email" class="form-control" name="cc3">
	<label for="cc4"></label>
	<input type="email" class="form-control" name="cc4">
</div>
<br>


  <div class="attachment-row col-md-7">
            <input type="file" class="input-field" name="adjuntos[]">
          </div>
          <div onClick="AgregarArchivos();" class="icon-add-more-attachemnt" title="Agregar más archivos"> <span class="badge badge-info"><i class="fas fa-plus"></i> </span></div>
<br>
  
  </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-sm btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Fin modal Cambio Estatus -->



<!-- Modal Eventos-->
<div class="modal fade" id="bitacora" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Bitacora de Eventos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if($eventos->count())
        @foreach($eventos as $evento)
            
 <div class="alert alert-success" role="alert">
<div class="d-flex">
  <div class="mr-auto p-2"> <b style="font-size: 12px; font-weight: bold;">{{$evento->tipo_modificacion}}</b></div>
  <div class="p-2" style="font-size: 10px; font-weight: bold;">{{$evento->usuario}} - {{$evento->fecha_mod}}</div>
  
</div>



 <p style="font-size: 12px;">{!! $evento->mensaje !!}</p>
</div>
 
        @endforeach
        @else
     <div class="alert alert-success" role="alert">
  No hay datos
</div>

        @endif

        <form class="form-group" method="POST" action="{{route('eventoManual',$servicio)}}">
        	{{@csrf_field()}}
        
        <label for="eventomanual">Anadir evento manualmente:</label>
        <textarea maxlength="10000" name="eventomanual" class="form-control" placeholder="Escriba aquí"></textarea>
        
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal admin-->
<div class="modal fade" id="infoAdm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Información administrativa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" method="POST" action="{{route('infoAdm',$servicio)}}">
          {{@csrf_field()}}
        <div class="form-row">
    <div class="form-group col-md-6">
      <label for="solicitado">Monto solicitado</label>
        <input type="text" value="{{$montoSolicitado}} {{$isoMoneda}}"  disabled name="solicitado" class="form-control">
    </div>
    <div class="form-group col-md-6">
      <label for="medio_pago">Medio de pago</label>
          <select class="form-control" name="medio_pago">
            <option disabled selected>Seleccione</option>
            @foreach($formasPago as $forma)
            <option value="{{$forma->id}}">{{$forma->nombre}}</option>
            @endforeach
          </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
        <label for="monto_aprobado">Monto aprobado</label>
          <input type="number" step="0.01" name="monto_aprobado" id="monto_aprobado" class="form-control" min="0" autocomplete="off">
      
    </div>
    <div class="form-group col-md-6">
         <label for="moneda_aprobado">Moneda de pago </label>
          <select class="form-control" name="moneda_aprobado">
            <option disabled selected>Seleccione</option>
            @foreach($listadoMonedas as $monedas)
            <option value="{{$monedas->CurrencyISO}}">{{$monedas->CurrencyName}}</option>
            @endforeach
          </select>
    </div>
    
  </div>
      	
        
        	
        
        
        	
        	<div>
        		
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>






<!-- Modal Estado-->
<div class="modal fade" id="estadoCaso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Estatus del caso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form class="form-group" method="POST" action="{{route('estadoCambio',$servicio)}}">
          {{@csrf_field()}}
          <label for="estado">Estado administrativo</label>
          <select class="form-control" name="estado" id="estado1" onchange="changeSelect()">
            <option selected disabled>Seleccione</option>
            @foreach($listadosEstados as $estado)
            <option value="{{$estado->codigo}}">{{$estado->nombre}}</option>
            @endforeach

          </select>
          <br>
          <div id="demo" style="display: none;"> 

            <label for="fecha_pagado">Fecha de pago</label>
            <input type="text" name="fecha_pagado" id="fecha_pagado" class="form-control" autocomplete="off">

            <label for="referencia">Ref. de pago</label>
            <input type="text" name="referencia" id="referencia" class="form-control" autocomplete="off">

          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Modal Fecha de formulario -->
<div class="modal fade" id="formularioEnvio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Envio de Formulario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" class="form-group" action="{{route('formulario',$servicio)}}">
          {{@csrf_field()}}
          <label for="fecha_envio_form">Fecha de envío del formulario al Pasajero</label>
          
          <input type="text" name="fecha_envio_form" id="fecha_envio_form" class="form-control" placeholder="yyyy-mm-dd" autocomplete="off">
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Fecha de recepcion formulario -->
<div class="modal fade" id="formularioRecepcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Recepción Formulario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" class="form-group" action="{{route('formulario2',$servicio)}}">
          {{@csrf_field()}}
    

    <label for="formulario_recepcion">Fecha de recepción de formulario</label>
          
          
<input type="text" name="formulario_recepcion" id="formulario_recepcion" class="form-control" placeholder="yyyy-mm-dd" autocomplete="off">
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Modal Ficha-->
<div class="modal fade" id="editarFicha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarFicha">Ficha de pago Western Union</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" method="POST" action="{{route('fichaUpdate',$servicio)}}">
          {{@csrf_field()}}
          {!! $formularioFicha !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>





<a href="{{route('inicio')}}" class="btn btn-success" style="float: right;">Regresar</a>

<script type="text/javascript">
  
  function changeSelect(){
    element = document.getElementById("demo");
    var x = document.getElementById("estado1").value;

    if (x == 2) {
      demo.style.display='block';
      document.getElementById("demo").innerHTML;
    }
    else {
            demo.style.display='none';
        }
     
  }

</script>


<script type="text/javascript">
    function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("check");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
</script>
<script type="text/javascript">
    function showContent1() {
        element = document.getElementById("content1");
        check = document.getElementById("check1");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
</script>


  <script type="text/javascript">
  $( function() {
    $( "#fecha_envio_form" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  } );
</script>
 <script type="text/javascript">
  $( function() {
    $( "#fecha_pagado" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  } );
</script>
 <script type="text/javascript">
  $( function() {
    $( "#fecha_para_pago" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  } );
</script>
 <script type="text/javascript">
  $( function() {
    $( "#fecha_para_pago2" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  } );
</script>
<script type="text/javascript">
  $( function() {
    $( "#fecha_para_pago3" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  } );
</script>
<script type="text/javascript">
  $( function() {
    $( "#fecha_para_pago4" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  } );
</script>
<script type="text/javascript">
  $( function() {
    $( "#formulario_recepcion" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  } );
</script>

<script>
                        CKEDITOR.replace( 'ckeditor' );
                </script>


@endsection