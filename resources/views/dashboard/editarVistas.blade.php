@extends('layouts.layout3')
@section('content3')
<br>
<br>
<h4>Información Cobertura: {{$nombreCobertura}}</h4>
<hr>
<form method="POST" action="{{route('editarInfoCobertura',$id)}}">
	{{@csrf_field()}}
	<textarea class="ckeditor form-control" maxlength="20000" name="cobertura">{!!$infoAlmacenadaCobertura!!}</textarea>
<br>
	<button class="btn btn-success" type="submit">Guardar</button>

</form>
<form method="POST" action="{{route('editarInfoDocumentos',$id)}}">
<hr>
{{@csrf_field()}}
	<h4>Documentación requerida: {{$nombreCobertura}}</h4>
<br>
	<textarea class="ckeditor form-control" maxlength="20000" name="documentos">{!!$infoAlmacenadaDocumentacion!!}</textarea>
	<br>
	<button class="btn btn-success" type="submit">Guardar</button>
</form>


<a href="{{route('info')}}" class="btn btn-danger" style="float: right;">Regresar</a>


@endsection