<!-- Modal -->
<div class="modal fade" id="deleteDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <b> ¿Estas seguro que deseas eliminar este documento? </b> Esta accion no se puede deshacer
     <form method="POST" action="{{route('deleteDocPax', $id)}}">
       @csrf
       <input type="hidden" name="archivo_name" id="archivo_name">
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Confirmar</button>
        </form>
      </div>
    </div>
  </div>
</div>