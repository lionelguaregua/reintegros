<div style="font-family: Arial; font-size: 14px;">
	<h3>Estimado/a {{$ObjReintegros->receiver}} su solicitud de reeintegro ha cambiado de estatus</h3><br>

<p>Estimado afiliado, su solicitud de reintegro ha sido verificada por el departamento de reintegros y ha actualizado su estatus a: <b> {{$ObjReintegros->nuevoEstado}}</b></p>

<p>El departamento de reintegros indica lo siguiente:</p><br>
<div style="text-align: justify; font-family: Arial !important;">
{!! BBCode::convertToHtml($ObjReintegros->mensajeEstado) !!}
</div>
<br>
<br>
<p>Saludos,</p>

<p style='font-size: 15px;'>Departamento de reintegros</p>
<img src="http://quanticoservicios.net/webroot/img/quantico.png"><br>
<small>Quantico servicios de asistencia<br>
	+(507) 831 5098 <br> 
	Edificio Magna Corp, Piso No.6, Oficina 622, Calle 51 y Manual María Icaza, Bella Vista, Ciudad de Panamá.. <br>
	www.quanticoservicios.net/ <br> 
Recuerde tener en cuenta:<br>
-Horario hábil (Lunes a Viernes desde las 8:00 am hasta las 5:00 pm)<br>
-Para activar el servicio debe haberse comunicado con la central de emergencias dentro de las 24 hs de sucedido el hecho.<br>
-Presentar la documentación por original dentro de los 30 días a partir del fin de vigencia del voucher.

No me imprimas si no es necesario. Protejamos el medio ambiente.</small>


</div>