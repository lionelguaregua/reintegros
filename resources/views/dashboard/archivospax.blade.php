@extends('layouts.layout3')

@section('content3')

<br>
<hr>
<h4>Documentos enviados por el Pasajero</h4>
<br>
<br>
@if(Session::has('subida_manual'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {!! session('subida_manual') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(Session::has('subida_manual_error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {!! session('subida_manual_error') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

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

<div class="row">

	

     @foreach($view as $vi)

     @if($vi == NULL)

     <div class="col-md-12">

     	<h5>No hay archivos enviados por el pasajero</h5>
     	<br>
     	<br>
     	<br>
     	<br>

     </div>

	@else

     <div class="col-md-6">
    <a href="" download> <embed src="{{asset('public/storage/solicitud/'.$id.'/'.$vi)}}" width=     "500px" height="400px"> </embed> </a>
     </div>


     @endif
     
     @endforeach


<div class="text-center col-md-12" style="padding-top: 100px">
<button type="button" class="btn btn-primary text-center" data-toggle="modal" data-target="#subir">
  Subir archivos
</button>
<a  href="{{route('ver',$id)}}" class="btn btn-danger text-center">
Regresar
</a>
</div>

<!-- Modal -->
<div class="modal fade" id="subir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Subir Archivos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" method="POST" action="{{route('subida',$id)}}" enctype="multipart/form-data">
        	{{@csrf_field()}}
        	<label for="documentos">Subida manual:</label>
        	<input type="file" name="documentos" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

	

</div>






@endsection