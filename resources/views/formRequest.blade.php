@extends('layouts.layout2')
@section('content2')
<style type="text/css">
  .jumbotron {
    background-color: #09bde6;
background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='75' height='75' viewBox='0 0 120 120'%3E%3Cpolygon fill='%23000' fill-opacity='0.16' points='120 0 120 60 90 30 60 0 0 0 0 0 60 60 0 120 60 120 90 90 120 60 120 0'/%3E%3C/svg%3E");
background-size: cover;
  }
</style>

@if($validacionCaso->count())


<div class=" container text-center">

<div class="alert alert-success" role="alert" style="margin-top: 200px;">
  <h4 class="alert-heading">Usted ya posee una solicitud en proceso!</h4>
  <p>Estimado afiliado, usted posee ya una solicitud de reembolso abierta para el numero de servicio: <b>{{$service}}</b>, para poder realizar una nueva solicitud de reitengro, comuniquese con la central de emergencias y notifique su incidencia para que le sea asignado un nuevo numero de servicio.</p>
  <hr>
  <p class="mb-0">En caso de tener alguna inquietud, puede comunicarse a <b>atencion.cliente@quanticoservicios.com </b>y con gusto resolveremos sus dudas.</p>
</div>
</div>


@else


<div class="container jumbo">
 <div class="jumbotron jumbo-form">
 	<div class="texto-jumbotron">
      <h1 >Solicitud de reintegro</h1>
      <p >Por favor proporciona toda la información solicitada con el fin de garantizar que tu solicitud sea gestionada de la manera mas completa posible.</p>
      </div>
      
    </div>
</div>



<div class="container">
	 @foreach($subservicioDatos as $dato)
   <h3>COBERTURA: {{$dato->nombre}}</h3>
   <div style="text-align: justify;">
    {!!$dato->cobertura!!}
  </div>
 @endforeach
<br>

<br>

<table class="table table-resposive table-striped">
	<thead>

	<th scope="col"><b>Nombre</b></th>
	<th scope="col"><b>Identificación</b></th>
	<th scope="col"><b>Plan</b></th>

	</thead>
	<tbody>

		<td>{{$nombrePax}}</td>
		<td>{{$idPax}}</td>
		<td>{{$planNombre}}</td>
		
	</tbody>
</table>

<br><br>

@if (count($errors) > 0)
    <div class="alert alert-danger">
    	<p>Corrige los siguientes errores:</p>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('envio_fallido'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {!! session('envio_fallido') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

	<form method="POST" action="{{ route ('formProcess', [$voucher, $caso, $service, $hash, $afiliadoId, $voucherid])}}" enctype="multipart/form-data">
		{{@csrf_field()}}
 <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="nacionalidad">Nacionalidad</label>
     <select class="form-control" name="nacionalidad" id="nacionalidad" required>
     	<option disabled selected>Seleccione</option>
     	@foreach($paises as $pais)
        <option value="{{$pais->iso}}">{{$pais->nombre}}</option>
     	@endforeach
     </select>
    </div>
    <div class="col-md-4 mb-3">
      <label for="pais_residencia">País de Residencia</label>
       <select class="form-control" name="pais_residencia" id="pais_residencia" required>
     	<option disabled selected>Seleccione</option>
     	@foreach($paises as $pais)
        <option value="{{$pais->iso}}">{{$pais->nombre}}</option>
     	@endforeach
     </select>
      
    </div>
    <div class="col-md-4 mb-3">
      <label for="pais_ocurrencia">País de Ocurrencia del evento</label>
       <select class="form-control" name="pais_ocurrencia" id="pais_ocurrencia" required>
     	<option disabled selected>Seleccione</option>
     	@foreach($paises as $pais)
        <option value="{{$pais->iso}}">{{$pais->nombre}}</option>
     	@endforeach
     </select>
      
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-3 mb-3">
      <label for="monto_gasto">Monto del gasto</label>
      <input type="number" class="form-control" id="monto_gasto" name="monto_gasto" placeholder="Monto en números" required step="0.01" min="0">
    </div>
    <div class="col-md-3 mb-3">
      <label for="moneda">Moneda</label>
      <select class="form-control" id="moneda" name="moneda" required>
     	<option disabled selected>Seleccione</option>
     	@foreach($monedas as $moneda)
        <option value="{{$moneda->CurrencyISO}}">{{$moneda->CurrencyName}} <b>({{$moneda->CurrencyISO}})</b></option>
     	@endforeach
     </select>
    
    </div>
    <div class="col-md-6 mb-3">
      <label for="direccion">Dirección de ocurrencia del evento</label>
      <input type="text" class="form-control" id="direccion" name="direccion" autocomplete="off" placeholder="Dirección" required>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="fecha_ocurrencia">Fecha de ocurrencia del evento</label>
      <input type="text" class="form-control" id="fecha_ocurrencia" name="fecha_ocurrencia" placeholder="yyyy-mm-dd" required autocomplete="off">
    </div>
    <div class="col-md-4 mb-3">
      <label for="email">Correo Eléctronico</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend2">@</span>
        </div>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" aria-describedby="inputGroupPrepend2" required>
      </div>

     
    
    </div>
    @if($inputAdicional == 1)
    <div class="col-md-2 mb-3">
      <label for="pir">PIR <a href="" data-toggle="tooltip2" title="N° de reclamo emitido por la aerolinea"><i class="far fa-question-circle"></i><a/></label>
      <div class="input-group">
        <input type="text" class="form-control" id="pir" name="pir" placeholder="N° PIR">
      </div>
    </div>
    <div class="col-md-2 mb-3">
      <label for="aerolinea">Aerolinea <a href="" data-toggle="tooltip" title="Aerolinea involucrada en el evento"> <i class="far fa-question-circle"></i></a></label>
      <div class="input-group">
       
        <input type="text" class="form-control" id="aerolinea" name="aerolinea" placeholder="Aerolinea" aria-describedby="inputGroupPrepend2">
      </div>
    </div>
    @endif

    <div class="col-md-12">
      <label for="observaciones">Observaciones Adicionales</label>
      <textarea class="form-control" name="observaciones" maxlength="10000" placeholder="Si tiene alguna observación adicional que deba ser tomada en cuenta por el departamento de reintegros, indiquela en este cuadro..."></textarea>
    </div>
  </div><br>
  <h3>Documentación requerida</h3>
  <p style="text-align: justify;">Estimado Afiliado, haga clic en el icono <span class="badge badge-info"> <i class="fas fa-plus"></i></span> para agregar mas archivos. En cualquier solicitud de reintegro, sin excepción, debe hacernos llegar imagenes de su pasaporte donde se muestre el sello de salida de su país de origen y el sello de entrada al país de ocurrencia del evento por el cual solicita el reintegro, igualmente imagen de su página de titularidad del pasaporte; En caso de no poseer sello debe enviarnos la imagen de su boleto aereo donde se muestre la fecha de salida del vuelo.</p>



  @foreach($subservicioDatos as $dato)
   
   <div style="text-align: justify;">
    {!!$dato->documentacion!!}
  </div>


 @endforeach
 <br>
  <div class="form-row">

    <div class="col-md-6 mb-3">
     
    <div class="attachment-row col-md-7">
            <input type="file" class="input-field" name="adjuntos[]">
          </div>
          <div onClick="AgregarArchivos();" class="icon-add-more-attachemnt" title="Agregar más archivos"> <span class="badge badge-info"><i class="fas fa-plus"></i> </span>
          </div>
    </div>
    
    <div class="col-md-4 mb-3">
     
       
  
      
    </div>
  </div>
 
  <button class="btn btn-primary" type="submit">Enviar Información</button>
</form>
</div>

<script type="text/javascript">
  $( function() {
    $( "#fecha_ocurrencia" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  } );
</script>


<script type="text/javascript">


function AgregarArchivos() {
    $(".attachment-row:last").clone().insertAfter(".attachment-row:last");
    $(".attachment-row:last").find("input").val("");
}
</script>

<script type="text/javascript">
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<script type="text/javascript">
  $(function () {
  $('[data-toggle="tooltip2"]').tooltip()
})
</script>




@endif
@endsection