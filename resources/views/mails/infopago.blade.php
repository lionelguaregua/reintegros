<div style="font-family: Arial; font-size: 14px;">

<h3>Usted ha recibido una nueva solicitud de pago del departamento de reintegros! </h3>
<br>
<p>Ha recibido una nueva solicitud de pago para el caso N° <b>{{$ObjAdministrativos->caso}} , servicio N° {{$ObjAdministrativos->servicio}}</b> la <span style="color: red;">fecha límite para el pago es </span> {{$ObjAdministrativos->fechapago}}</p>
<div style="font-family: Arial !important; text-align: justify;">
	{!! BBCode::convertToHtml($ObjAdministrativos->mensaje) !!}
</div>

@if($ObjAdministrativos->medioPago == 1)

<ul>
	<li>Medio de pago: Western Union</li>
	<li>Titular: {{$ObjAdministrativos->titular}}</li>
	<li>País: {{$ObjAdministrativos->pais}}</li>
	<li>Estado ó Provincia: {{$ObjAdministrativos->provincia}}</li>
	<li>Ciudad: {{$ObjAdministrativos->ciudad_estado}}</li>
</ul>

</ul>


@elseif($ObjAdministrativos->medioPago == 2)

<ul>
	<li>Medio de pago: Transferencia Local</li>
	<li>Titular: {{$ObjAdministrativos->titular}}</li>
	<li>Número de documento: {{$ObjAdministrativos->documento}}</li>
	<li>Banco: {{$ObjAdministrativos->banco}}</li>
	<li>Número de cuenta: {{$ObjAdministrativos->cuenta}}</li>
	<li>Tipo de cuenta: {{$ObjAdministrativos->tipo_cuenta}}</li>
</ul>

</ul>



@elseif($ObjAdministrativos->medioPago == 3)

<ul>
	<li>Medio de pago: Transferencia Internacional</li>
	<li>Titular: {{$ObjAdministrativos->titular}}</li>
	<li>Número de documento: {{$ObjAdministrativos->documento}}</li>
	<li>Banco: {{$ObjAdministrativos->banco}}</li>
	<li>Número de cuenta: {{$ObjAdministrativos->cuenta}}</li>
	<li>Tipo de cuenta: {{$ObjAdministrativos->tipo_cuenta}}</li>
	<li>Codigo Swift ó Aba: {{$ObjAdministrativos->swift}}</li>
	<li>Dirección del banco: {{$ObjAdministrativos->direccion}}</li>
	<li>Dirección domiciliada: {{$ObjAdministrativos->direccion_domiciliada}}</li>
</ul>

</ul>





@elseif($ObjAdministrativos->medioPago == 4)


<ul>
	<li>Medio de pago: Efectivo</li>
	<li>Especificaciones: {{$ObjAdministrativos->especificaciones}}</li>
	
</ul>

</ul>

@endif

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