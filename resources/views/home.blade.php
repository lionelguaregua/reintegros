@extends('layouts.layout2')
@section('content2')

<header class="bg-primary text-white">
    <div class="container text-center header-margin">
      <h1 style="padding-top: 100px;">Bievenido/a: <b>{{$nombrePax}}</b></h1>
      <p class="lead">Aqui podrás realizar tus gestiones de reintegro y visualizar el estatus de tus solicitudes</p>
      <p><b>{{$clienteNombre}}</b></p>
    </div>
  </header>
  <div class="container seccion">
  	<div class="row">

  	<div class="col-md-6 text-center">
  		<img src="{{asset('img/business-img.png')}}" width="70%">
  	</div>
  	<div class="col-md-6">
  		<h1 class="font-weight-light">Reintegros en línea</h1>
        <p>Estimado usuario bienvenido a reintegros en línea, aquí podrás realizar tus solicitudes de  reintegro de manera automatica, así como oconsultar el estatus de tus solicitudes </p>
        <a class="btn btn-primary" href="{{ route('formRequest', [$voucher, $caso, $service, $hash, $afiliadoId, $voucherid]) }}">Solicitar reintegro</a>
        <a class="btn btn-success" href="{{route('requestEstatus',[$voucher,$caso,$service,$hash,$afiliadoId,$voucherid])}}">Estatus de solicitud</a>
  	</div>
  	</div>
  	
  </div>



@endsection