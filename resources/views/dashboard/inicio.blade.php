@extends('layouts.layout3')

@section('content3')

<style type="text/css">

th{
	background-color: #201547;
	color: #fff;
}

</style>


<h5 style="padding-bottom: 30px;padding-top: 30px;">Todos los casos</h5>

<div class="d-flex">
  <div class="p-2">
  <form class="form-inline md-form form-sm mt-0" method="GET" action="{{route('query')}}">
  	
  <i class="fas fa-search" aria-hidden="true"></i>
  <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
    aria-label="Search" name="busqueda" autocomplete="off" value="@if(isset($query)){{$search}}@endif">
</form>
</div>

<div class="p-2" style="margin-top: 15px;" >

	@if(isset($query))

<a href="{{route('inicio')}}" style="color: red; font-size: 12px;">Limpiar busqueda <i class="fas fa-times-circle"></i></a>

    @endif

</div>


  
  <div class="ml-auto p-2">
  	  @if(isset($listado))
  	{{$listado->links()}}
  	@endif
  </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('registrado'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {!! session('registrado') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(Session::has('caso_desagendado'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {!! session('caso_desagendado') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


@if(Session::has('no_agendado'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {!! session('no_agendado') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(Session::has('agendado'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {!! session('agendado') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif



@if(Session::has('no_registrado'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {!! session('no_registrado') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif



<table class="table" id="tabla">
	<thead>
		
                    <th  scope="col">No</th>
                    <th  scope="col">Cliente</th>
					<th  scope="col">Nombre</th>
					<th  scope="col">Servicio</th>
                    <th  scope="col">Documento</th>
                    <th  scope="col">Voucher</th>                  
                    <th  scope="col">Fecha Solicitud</th>            
                    <th  scope="col">Estatus</th>                    
                    <th  scope="col">Estado</th>
                    <th scope="col">Acciones</th>                             					
				
	</thead>



	<tbody>
		<tr>

	   @if(isset($listado) && $listado->count())

		@foreach($listado as $lista)
         
         <td>{{$lista->id}}</td>
         <td>


      @if($lista->cliente == 2)
            
             <span class="badge badge-info">Plus Ultra</span>
	   
	    @elseif ($lista->cliente == 3)                                                                                      
	    <span class="badge badge-info">Assist-med</span>
		
		@elseif ($lista->cliente == 4) 
		
		<span class="badge badge-info">Seguros Universitas</span>

		@elseif ($lista->cliente == 5)

	    <span class="badge badge-info">Interwelt</span>
		
		@elseif ($lista->cliente == 6)

		<span class="badge badge-info">Pasaporte Pais</span>
		
		@elseif ($lista->cliente == 7)

		<span class="badge badge-info">Card Club</span>

		@elseif ($lista->cliente == 8)

		<span class="badge badge-info">M.C. Air</span>
		
		@elseif ($lista->cliente == 9)

		<span class="badge badge-info">Más asistencia</span>
		
		@elseif ($lista->cliente == 10)
		
		<span class="badge badge-info">Seguros Universitas</span>
		
		@elseif ($lista->cliente == 11)
		
		<span class="badge badge-info">La Venezolana de Seguros</span>

		@elseif ($lista->cliente == 14)

		<span class="badge badge-info">Más asistencia masivo</span>

		@elseif ($lista->cliente == 15)
		
		<span class="badge badge-info">Smart-Matic</span>
		
		@elseif ($lista->cliente == 16)

        <span class="badge badge-info">Strada Travel</span>
		
		@elseif ($lista->cliente == 17)
	    
	    <span class="badge badge-info">Sou Compare</span>

	    @elseif ($lista->cliente == 18)
					
		<span class="badge badge-info">Compara Online</span>
		
		@elseif ($lista->cliente == 19)
		
		<span class="badge badge-info">Excelencias</span>

		@elseif ($lista->cliente == 20)

		<span class="badge badge-info">Global Mate</span>
	    
	    @elseif ($lista->cliente == 21)
	    
	    <span class="badge badge-info">Booking assistance</span>
		
		@elseif ($lista->cliente == 22)

	    <span class="badge badge-info">Quantico</span>
		
		@elseif ($lista->cliente == 23)

		<span class="badge badge-info">Global Solutions Insurance</span>
		
		@elseif ($lista->cliente == 24)
		<span class="badge badge-info">Miviajeseguro.com</span>

		@elseif ($lista->cliente == 25)
						
		<span class="badge badge-info">segurosparaviajes.net</span>
		
		@elseif ($lista->cliente == 27)
		
		<span class="badge badge-info">estasporviajar.com</span>

		@elseif ($lista->cliente == 28)

		<span class="badge badge-info">Passenger assistance</span>
		
		@elseif ($lista->cliente == 29)

		<span class="badge badge-info">Empresas Polar</span>
		
		@elseif ($lista->cliente == 30)

		<span class="badge badge-info">Travi assist</span>
		
		@elseif ($lista->cliente == 31)

		<span class="badge badge-info">Tusegurodeviaje.net</span>
		
		@elseif ($lista->cliente == 32)
		
		<span class="badge badge-info">Viajes Gaitan</span>

		@elseif ($lista->cliente == 33)
		
		<span class="badge badge-info">RF Seguros Colombia</span>
		
		@elseif ($lista->cliente == 34)

		<span class="badge badge-info">Tranki asistencia</span>
		
		@elseif ($lista->cliente == 35)

		<span class="badge badge-info">Vega corp</span>
		
		@else
		
		<span class="badge badge-info">Sin Cliente</span>

		@endif
						


         </td>
         <td>{{$lista->nombre}}</td>
         <td>{{$lista->servicio}}</td>
         <td>{{$lista->documento}}</td>
         <td>{{$lista->voucher}}</td>
         <td>{{$lista->fecha_solicitud}}</td>
         
         <td>

         @if($lista->estatus_solicitud == 1)
		
		<span class="badge badge-success">Enviado</span>
				
         @elseif($lista->estatus_solicitud == 2)
		
		<span class="badge badge-success">Recibido</span>

		 @elseif($lista->estatus_solicitud == 3)
		
		<span class="badge badge-info">En análisis</span>

		 @elseif($lista->estatus_solicitud == 4)
			
		<span class="badge badge-success">Aprobado</span>

		 @elseif($lista->estatus_solicitud == 5)
	    
	    <span class="badge badge-danger">Negado</span>
		
		@elseif($lista->estatus_solicitud == 6)

	    <span class="badge badge-warning">Aprobado parcial</span>

	    @elseif($lista->estatus_solicitud == 7)

	    <span class="badge badge-warning">A espera de documentación</span>
		
		@else

		<span class="badge badge-warning">Sin estatus</span>
		
		@endif

         	
         </td>
         <td>
        
          @if($lista->estado == 1) 
	
	      <span class="badge badge-success">Abierto - Por pagar</span>
	
	      @elseif($lista->estado == 2)
         
          <span class="badge badge-danger">Cerrado - Pagado</span>


           @elseif($lista->estado == 3)

          <span class="badge badge-danger">Cerrado - Negado</span>

          @elseif($lista->estado == 0)

          <span class="badge badge-info">Por determinar</span>
	
	      @endif

          </td>

          <td>

          <a href="{{route('ver',$lista->servicio)}}">	<i class="fas fa-eye" title="Ver"></i> </a> 
          @if($lista->agendado == NULL)
          <a href="" data-toggle="modal" data-target="#agendarCaso" data-casoid="{{$lista->servicio}}">	<i class="fas fa-calendar" title="Agendar" ></i> </a>
         
          @else
          <i style="color: green;" class="fas fa-check" title="Agendado"></i>
         
          <a href="" data-toggle="modal" data-target="#desagendar" data-agendadoid="{{$lista->servicio}}"> 
          	<i style="color: red;" class="far fa-calendar-times" title="Quitar de la agenda"></i></a>

          @endif

          </td>
          </tr>

		@endforeach

		@elseif(isset($listado) && $listado->count() == false)
<tr>
		<td>No hay datos</td>

</tr>



        @elseif(isset($query) && $query->count())



        @foreach($query as $q)
         
         <td>{{$q->id}}</td>
         <td>


      @if($q->cliente == 2)
            
             <span class="badge badge-info">Plus Ultra</span>
	   
	    @elseif ($q->cliente == 3)                                                                                      
	    <span class="badge badge-info">Assist-med</span>
		
		@elseif ($q->cliente == 4) 
		
		<span class="badge badge-info">Seguros Universitas</span>

		@elseif ($q->cliente == 5)

	    <span class="badge badge-info">Interwelt</span>
		
		@elseif ($q->cliente == 6)

		<span class="badge badge-info">Pasaporte Pais</span>
		
		@elseif ($q->cliente == 7)

		<span class="badge badge-info">Card Club</span>

		@elseif ($q->cliente == 8)

		<span class="badge badge-info">M.C. Air</span>
		
		@elseif ($q->cliente == 9)

		<span class="badge badge-info">Más asistencia</span>
		
		@elseif ($q->cliente == 10)
		
		<span class="badge badge-info">Seguros Universitas</span>
		
		@elseif ($q->cliente == 11)
		
		<span class="badge badge-info">La Venezolana de Seguros</span>

		@elseif ($q->cliente == 14)

		<span class="badge badge-info">Más asistencia masivo</span>

		@elseif ($q->cliente == 15)
		
		<span class="badge badge-info">Smart-Matic</span>
		
		@elseif ($q->cliente == 16)

        <span class="badge badge-info">Strada Travel</span>
		
		@elseif ($q->cliente == 17)
	    
	    <span class="badge badge-info">Sou Compare</span>

	    @elseif ($q->cliente == 18)
					
		<span class="badge badge-info">Compara Online</span>
		
		@elseif ($q->cliente == 19)
		
		<span class="badge badge-info">Excelencias</span>

		@elseif ($q->cliente == 20)

		<span class="badge badge-info">Global Mate</span>
	    
	    @elseif ($q->cliente == 21)
	    
	    <span class="badge badge-info">Booking assistance</span>
		
		@elseif ($q->cliente == 22)

	    <span class="badge badge-info">Quantico</span>
		
		@elseif ($q->cliente == 23)

		<span class="badge badge-info">Global Solutions Insurance</span>
		
		@elseif ($q->cliente == 24)
		<span class="badge badge-info">Miviajeseguro.com</span>

		@elseif ($q->cliente == 25)
						
		<span class="badge badge-info">segurosparaviajes.net</span>
		
		@elseif ($q->cliente == 27)
		
		<span class="badge badge-info">estasporviajar.com</span>

		@elseif ($q->cliente == 28)

		<span class="badge badge-info">Passenger assistance</span>
		
		@elseif ($q->cliente == 29)

		<span class="badge badge-info">Empresas Polar</span>
		
		@elseif ($q->cliente == 30)

		<span class="badge badge-info">Travi assist</span>
		
		@elseif ($q->cliente == 31)

		<span class="badge badge-info">Tusegurodeviaje.net</span>
		
		@elseif ($q->cliente == 32)
		
		<span class="badge badge-info">Viajes Gaitan</span>

		@elseif ($q->cliente == 33)
		
		<span class="badge badge-info">RF Seguros Colombia</span>
		
		@elseif ($q->cliente == 34)

		<span class="badge badge-info">Tranki asistencia</span>
		
		@elseif ($q->cliente == 35)

		<span class="badge badge-info">Vega corp</span>
		
		@else
		
		<span class="badge badge-info">Sin Cliente</span>

		@endif
						


         </td>
         <td>{{$q->nombre}}</td>
         <td>{{$q->servicio}}</td>
         <td>{{$q->documento}}</td>
         <td>{{$q->voucher}}</td>
         <td>{{$q->fecha_solicitud}}</td>
         
         <td>

         @if($q->estatus_solicitud == 1)
		
		<span class="badge badge-success">Enviado</span>
				
         @elseif($q->estatus_solicitud == 2)
		
		<span class="badge badge-success">Recibido</span>

		 @elseif($q->estatus_solicitud == 3)
		
		<span class="badge badge-info">En análisis</span>

		 @elseif($q->estatus_solicitud == 4)
			
		<span class="badge badge-success">Aprobado</span>

		 @elseif($q->estatus_solicitud == 5)
	    
	    <span class="badge badge-danger">Negado</span>
		
		@elseif($q->estatus_solicitud == 6)

	    <span class="badge badge-warning">Aprobado parcial</span>

	    @elseif($q->estatus_solicitud == 7)

	    <span class="badge badge-warning">A espera de documentación</span>
		
		@else

		<span class="badge badge-warning">Sin estatus</span>
		
		@endif

         	
         </td>
         <td>
        
          @if($q->estado == 1) 
	
	      <span class="badge badge-success">Abierto - Por pagar</span>
	
	      @elseif($q->estado == 2)
         
          <span class="badge badge-danger">Cerrado - Pagado</span>


           @elseif($q->estado == 3)

          <span class="badge badge-danger">Cerrado - Negado</span>
	
	      @endif

          </td>

          <td>

          <a href="{{route('ver', $q->id)}}">	<i class="fas fa-eye"></i> </a>&nbsp;&nbsp;&nbsp; 
           @if($q->agendado == NULL)
          <a href="" data-toggle="modal" data-target="#agendarCaso" data-casoid="{{$q->servicio}}">	<i class="fas fa-calendar" title="Agendar" ></i> </a>
          @else
          <i style="color: green;" class="fas fa-check" title="Agendado"></i>

          @endif

          </td>
          </tr>

		@endforeach

		@else
<tr>

		<td width="100%"><h5 style="text-align: center;">No hay datos de busqueda</h5></td>

</tr>



		@endif
          </tr>

		
	</tbody>
</table>

<div class="d-flex">
  <div class="p-2"></div>
  <div class="ml-auto p-2">
  	@if(isset($listado))
  	{{$listado->links()}}
  	@endif
  </div>


</div>



<br>
<br>
<!-- Modal Agendados -->
<div class="modal fade" id="agendarCaso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agendarCaso">Agendar caso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form class="form-group" method="POST" action="{{route('agendarcaso')}}">
      		{{@csrf_field()}}
      	<label for="agendar">Fecha para revisión del caso:</label>
        <input type="text" name="agendar" id="agendar" class="form-control" autocomplete="off">
         <input type="hidden" name="caso_id" id="caso_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal Desagendar -->
<div class="modal fade" id="desagendar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agendarCaso">Quitar de la agenda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form class="form-group" method="POST" action="{{route('desagendar')}}">
      		{{@csrf_field()}}
      	<label for="agendado_id">¿Estas seguro que deseas quitar este caso de la agenda?</label>
       
         <input type="hidden" name="agendado_id" id="agendado_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Continuar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $( function() {
    $( "#agendar" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  } );
</script>

<script type="text/javascript">
  $('#agendarCaso').on('show.bs.modal', function (event) {


   var button = $(event.relatedTarget)

   var caso_id = button.data('casoid')

   var modal = $(this)

   modal.find('.modal-body #caso_id').val(caso_id);

  })

</script>

<script type="text/javascript">
  $('#desagendar').on('show.bs.modal', function (event) {


   var button = $(event.relatedTarget)

   var agendado_id = button.data('agendadoid')

   var modal = $(this)

   modal.find('.modal-body #agendado_id').val(agendado_id);

  })

</script>


@endsection