@extends('layouts.layout3')

@section('content3')

<style type="text/css">

th{
	background-color: #201547;
	color: #fff;
}

</style>

<div class="container">
<h5 style="padding-bottom: 30px;padding-top: 30px;">Todos los casos</h5>

<div class="d-flex">
  <div class="p-2">
  <form class="form-inline md-form form-sm mt-0" method="GET" action="{{route('inicio')}}">
  	
  <i class="fas fa-search" aria-hidden="true"></i>
  <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
    aria-label="Search" name="busqueda" autocomplete="off" value="@if(isset($search)){{$search}}
    @endif">

</form>
</div>
<div class="ml-auto p-2">
	@if(isset($query))

<a href="{{route('inicio')}}" style="color: red; font-size: 12px;">Limpiar busqueda <i class="fas fa-times-circle"></i></a>

    @endif
	<a href="#" class="btn btn-success" data-toggle="modal" data-target="#casosDia">
  Agendados del día <span class="badge badge-light">{{$casosDia}}</span>
</a>
<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#casosRetrasados">
  Retrasos <span class="badge badge-light">{{$casosRetrasadosCuenta}}</span>
</a>

</div>
</div>




  
  <div class="ml-auto p-2">
  	
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
		
                    
                <th  scope="col">Cliente</th>
	            <th  scope="col">Nombre</th>
	            <th  scope="col">Servicio</th>
                <th  scope="col">Documento</th>
                <th  scope="col">Voucher</th>                  
                <th  scope="col">Fecha Solicitud</th> 
                <th  scope="col">Agenda</th>           
                <th  scope="col">Estatus</th>                    
                <th  scope="col">Estado</th>
                <th  scope="col">Acciones</th>                             					
				
	</thead>
	@if($listado->count())
	@foreach($listado as $lista)
	<tr>
	            <td><span class="badge badge-info">{{$lista->nombre_cliente}}</span></td>
	            <td>{{$lista->nombre_afiliado}}</td>
	            <td>{{$lista->servicio}}</td>
	            <td>{{$lista->identificacion_afiliado}}</td>
	            <td>{{$lista->voucher}}</td>
	            <td>{{$lista->fecha_solicitud}}</td>
	            <td>
	            	@if($lista->agendado === NULL)
	            	<span class="badge badge-info">Sin agendar</span>
	            	@else
	            	{{$lista->agendado}}
	            	@endif
	            </td>
	            <td><span class="badge badge-info">{{$lista->estatus_solicitud}}</span></td>
	            <td><span class="badge badge-success">{{$lista->estado_casos}}</span></td>
	            <td>
	            	 <a href="{{route('ver', $lista->servicio)}}">	<i class="fas fa-eye" title="Ver"></i> </a>
	      @if($lista->agendado == NULL)

          <a href="" data-toggle="modal" data-target="#agendarCaso" data-casoid="{{$lista->servicio}}"> <i class="fas fa-calendar" title="Agendar" >
          	
          </i> 
          </a>
          @else

          <i style="color: green;" class="fas fa-check" title="Agendado"></i>
          <a href="" data-toggle="modal" data-target="#desagendar" data-agendadoid="{{$lista->servicio}}"><i style="color: red;" class="fas fa-calendar-times"></i></a>

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



	<tbody>


	</tbody>
	</table>



<div class="d-flex">
  <div class="p-2"></div>
  <div class="ml-auto p-2">
  	{{$listado->links()}}
  </div>


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



<!-- Modal Casos del día -->
<div class="modal fade" id="casosDia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Casos del día</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	@if($casosDiaLista->count())
      	<ul>
        @foreach($casosDiaLista as $casoDia)
        
        	<li><a href="{{route('ver',$casoDia->servicio_id)}}">{{$casoDia->servicio_id}}</a></li>
        
        @endforeach
        </ul>
        @else
        <p>No hay casos agendados para el día de hoy</p>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>


<!-- Modal Casos retrasados -->
<div class="modal fade" id="casosRetrasados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Casos retrasados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	@if($casosRetrasadosLista->count())
      	<ul>
        @foreach($casosRetrasadosLista as $casosRetrasados)
        
        	<li><a href="{{route('ver',$casosRetrasados->servicio_id)}}">{{$casosRetrasados->servicio_id}}</a></li>
        
        @endforeach
        </ul>
        @else
        <p>No hay casos con retraso</p>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        
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