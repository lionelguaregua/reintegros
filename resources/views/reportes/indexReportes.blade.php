@extends('layouts.layout3')
@section('content3')

<div style="padding-top:50px;">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h3>Total de solicitudes: {{$solicitud}}</h3>
<hr>



<form method="GET" action="{{route('queryReport')}}">
  <div class="form-row">
    <div class="col">
    <label for="date-filter-from">Desde:</label>
      <input type="text" name="date-filter-from" id="date-filter-from" class="form-control" placeholder="yyyy-mm-dd" autocomplete="off" value="{{$from}}">
    </div>
    <div class="col">
    <label for="date-filter-to">Hasta:</label>
      <input type="text" name="date-filter-to" id="date-filter-to" class="form-control" placeholder="yyyy-mm-dd" autocomplete="off"  value="{{$to}}">
    </div>
    <div class="col">
      <button type="sumbit" class="btn btn-success">Filtrar</button>
    </div>
    @if(isset($from) && isset($to))
    <div class="col">
    <a href="{{route('indexReportes')}}" style="color: red; font-size: 12px;">Limpiar busqueda <i class="fas fa-times-circle"></i></a>
    </div>
    @endif
  </div>
</form>


<br>

@if(isset($from) && isset($to))

<p style="color:red;">Al utilizar el filtro de fecha la grafica tener en cuenta:</p>

<ul style="color:red;">
<li>La grafica solicitudes por cobertura se rige por fecha de solicitud</li>
<li>La grafica total aprobado por cobertura se rige por fecha de aprobacion</li>
</ul>

@endif

<div class="col-md-12">
<div id="chart">
</div>
</div>

<hr>

<div class="col-md-12">
<div id="chart2">
</div>

</div>






</div>






@include('reportes.graficas.pieScript', ['data' => $data])

@include('reportes.graficas.barScript', ['dataClients' => $dataClients])

@include('reportes.graficas.barScriptTwo', ['dataTwo' => $dataTwo])

@include('reportes.graficas.ajaxReport')





<script type="text/javascript">
  $( function() {
    $( "#date-filter-from" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  } );

  $( function() {
    $( "#date-filter-to" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  } );
</script>
@endsection