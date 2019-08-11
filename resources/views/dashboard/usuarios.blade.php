@extends('layouts.layout3')
@section('content3')

<style type="text/css">

th{
	background-color: #201547;
	color: #fff;
}

</style>

<div class="container">
	<div class="d-flex">
		<div class="p-2">
			<h5 style="padding-bottom: 30px;padding-top: 30px;">Gestión de usuarios</h5>
		</div>
		<div class="p-2 ml-auto">
			<h5 style="padding-bottom: 30px;padding-top: 30px;">
				
				Nuevo usuario 

				<a href="{{route('nuevoUsuario')}}">
				<i class="fas fa-plus-circle"></i>
				</a>
			</h5>
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

@if(Session::has('usuario_eliminado'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {!! session('usuario_eliminado') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(Session::has('usuario_editado'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {!! session('usuario_editado') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
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

<hr>
<table class="table">
	<thead>
		<th>Nombre</th>
		<th>Email</th>
		<th>Estado</th>
		<th>Acciones</th>
	</thead>
	<tbody>
		@foreach($usuarios as $user)
	<tr>

		<td>{{$user ->name}}</td>
		<td>{{$user ->email}}</td>
		<td>
			@if($user ->status == 1)
			Activo
			@else
			Inactivo
			@endif
		</td>
		<td>
			<button data-toggle="modal" data-target="#editModal" class="btn" style="padding: 2px;" data-editar="{{$user->id}}"><span class="badge badge-warning"><i class="fas fa-edit"></i></span></button>&nbsp;
			<button data-toggle="modal" class="btn" style="padding: 2px;" data-toggle="modal" data-target="#deleteModal" data-estatus="{{$user->id}}"><span class="badge badge-danger"><i class="fas fa-user-slash"></i></span></button>
		</td>
	</tr>

		@endforeach
	</tbody>
	
</table>
</div>
<!-- Modal Editar -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModal">Editar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('editUser')}}">
          {{@csrf_field()}}
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control">
         <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" class="form-control">
        <input type="hidden" name="edit_id" id="edit_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Desactivar -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModal">Inhabilitar usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('statusChange')}}">
          {{csrf_field()}}
        <label for="status">Estatus de usuario</label>
        <select name="status" id="status" class="form-control">
        	<option disabled selected>Seleccione</option>
        	<option value="1">Activo</option>
        	<option value="0">Inactivo</option>
        </select>
        <input type="hidden" name="estatus_id" id="estatus_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $('#editModal').on('show.bs.modal', function (event) {


   var button = $(event.relatedTarget)

   var edit_id = button.data('editar')

   var modal = $(this)

   modal.find('.modal-body #edit_id').val(edit_id);

  })

</script>

<script type="text/javascript">
  $('#deleteModal').on('show.bs.modal', function (event) {


   var button = $(event.relatedTarget)

   var estatus_id = button.data('estatus')

   var modal = $(this)

   modal.find('.modal-body #estatus_id').val(estatus_id);

  })

</script>


@endsection