@extends('layouts.layout3')
@section('content3')

<style type="text/css">
	.btn-group-xs > .btn, .btn-xs {
  padding: .25rem .4rem;
  font-size: .875rem;
  line-height: .5;
  border-radius: .2rem;
}

th{
	background-color: #201547;
	color: #fff; 
}
</style>

<hr>
<h3>Subservicios</h3>
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

@if(Session::has('info_cobertura'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {!! session('info_cobertura') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(Session::has('info_documentos'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {!! session('info_documentos') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<br>
<div class="container">
	
	<table class="table">
  <thead>
    <tr>
      <th scope="col">Subservicio</th>
      <th scope="col">Cobertura</th>
      <th scope="col">Documentación</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($crmSubservicios as $crm)
    <tr>
      <th scope="row">{{$crm->nombre}}</th>
      <td style="text-align: justify;" width="50%">{!!$crm->cobertura!!}</td>
      <td style="text-align: justify;" width="50%">{!!$crm->documentacion!!}</td>
      <td><a href="{{route('editarInfo',$crm->id)}}" class="btn btn-xs btn-success"><i class="fas fa-pencil-alt"></i></a></td>
    </tr>
    @endforeach
   
  </tbody>
</table>
	
</div>





@endsection