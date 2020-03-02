@extends('layouts.layout3')
@section('content3')

<div style="padding-top:50px;">

<h3>Total de solicitudes: {{$solicitud}}</h3>
<hr>







<div class="row">
<div class="col-md-6">
<div id="chart"></div>

</div>


<div class="col-md-6">
<div id="chart2"></div>

</div>
</div>

</div>


















@include('reportes.graficas.pieScript', ['data' => $data])

@include('reportes.graficas.barScript', ['dataClients' => $dataClients])

@include('reportes.graficas.barScriptTwo', ['dataTwo' => $dataTwo])

@include('reportes.graficas.ajaxReport')



@endsection