@extends('layouts.layout2')
@section('content2')



<div class="container">
  <div class="row align-items-center my-5">
      <div class="col-lg-7 text-center">
        <img class="img-fluid rounded mb-4 mb-lg-0" src="{{asset('public/img/clip-art.png')}}" alt="" width="400">
      </div>
      <!-- /.col-lg-8 -->
      <div class="col-lg-5">
        <h1 class="font-weight-light">Información enviada Exitosamente</h1>
        <p>Su solicitud de reintegro ha sido enviada con exito, lo invitamos a verificar su dirección de email: <b>{{$email}}</b> en donde se le explicarán los proximos pasos a seguir</p>
       
        <a class="btn btn-success" href="{{ route('requestEstatus', [$voucher, $caso, $service, $hash, $afiliadoId, $voucherid]) }}">Estatus de solicitud</a>
      </div>
      <!-- /.col-md-4 -->
    </div>
    </div>



@endsection