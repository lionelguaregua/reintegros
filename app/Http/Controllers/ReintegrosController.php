<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Storage;                                            
use Illuminate\Support\Facades\Mail;                                           
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\MessageBag;                                            
use Illuminate\Http\UploadedFile; 
use App\Mail\envioAdministrativo;
use App\Mail\CambioEstado;        
use Illuminate\Http\Request; 
use App\Afiliado_datos;
use Illuminate\Http\File;     
use Carbon\Carbon;
use Session;
use Auth;

class ReintegrosController extends Controller
{
      public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    public function index(Request $request){

        if ($request->get('busqueda') !== NULL) {

            $search = $request->get('busqueda');


           $listado =  DB::connection('mysql2')->table('afiliado_datos')

        ->where('afiliado_datos.servicio','like', '%'.$search.'%')

        ->orWhere('afiliado_datos.caso','like', '%'.$search.'%')

        ->orWhere('afiliado_datos.documento','like', '%'.$search.'%')

        ->orWhere('afiliado_datos.voucher','like', '%'.$search.'%')

        ->orWhere('afiliado_datos.email','like', '%'.$search.'%')

        ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('estatus_administrativo','estatus_administrativo.codigo','=','afiliado_administrativo.estado')
    ->join('crm.clientes_corporativos','crm.clientes_corporativos.id','=','afiliado_administrativo.cliente')
    ->join('estatus_solicitud','estatus_solicitud.codigo','=','afiliado_administrativo.estatus_solicitud')
        ->select('afiliado_datos.nombre as nombre_afiliado','afiliado_datos.servicio','estatus_administrativo.nombre AS estado_casos','afiliado_datos.documento as identificacion_afiliado','afiliado_administrativo.agendado','afiliado_administrativo.estatus_solicitud', 'crm.clientes_corporativos.nombre_comercial AS nombre_cliente','afiliado_administrativo.voucher','afiliado_datos.fecha_solicitud','estatus_solicitud.estatus AS estatus_solicitud')
        ->paginate(5);
 
    $diaActual = Carbon::now()->toDateString();

    
    $casosDia = DB::connection('mysql2')
    ->table('afiliado_administrativo')
    ->where('agendado','=',$diaActual)
    ->count();

    $casosDiaLista = DB::connection('mysql2')
    ->table('afiliado_administrativo')
    ->where('agendado','=',$diaActual)
    ->get();


    $casosRetrasadosCuenta = DB::connection('mysql2')
    ->table('afiliado_administrativo')
    ->where('agendado','<',$diaActual)
    ->count();


    $casosRetrasadosLista = DB::connection('mysql2')
    ->table('afiliado_administrativo')
    ->where('agendado','<',$diaActual)
    ->get();

    $query = $listado;



    return view('dashboard.inicio', compact('listado','casosDia','casosDiaLista','casosRetrasadosCuenta','casosRetrasadosLista','query','search'));




        }else{

    $diaActual = Carbon::now()->toDateString();



    $listado = DB::connection('mysql2')->table('afiliado_datos')

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('estatus_administrativo','estatus_administrativo.codigo','=','afiliado_administrativo.estado')
    ->join('crm.clientes_corporativos','crm.clientes_corporativos.id','=','afiliado_administrativo.cliente')
    ->join('estatus_solicitud','estatus_solicitud.codigo','=','afiliado_administrativo.estatus_solicitud')
        ->select('afiliado_datos.nombre as nombre_afiliado','afiliado_datos.servicio','estatus_administrativo.nombre AS estado_casos','afiliado_datos.documento as identificacion_afiliado','afiliado_administrativo.agendado','afiliado_administrativo.estatus_solicitud', 'crm.clientes_corporativos.nombre_comercial AS nombre_cliente','afiliado_administrativo.voucher','afiliado_datos.fecha_solicitud','estatus_solicitud.estatus AS estatus_solicitud')
        

        ->paginate(10);
    
  

    $casosDia = DB::connection('mysql2')
    ->table('afiliado_administrativo')
    ->where('agendado','=',$diaActual)
    ->count();

    $casosDiaLista = DB::connection('mysql2')
    ->table('afiliado_administrativo')
    ->where('agendado','=',$diaActual)
    ->get();


    $casosRetrasadosCuenta = DB::connection('mysql2')
    ->table('afiliado_administrativo')
    ->where('agendado','<',$diaActual)
    ->count();


    $casosRetrasadosLista = DB::connection('mysql2')
    ->table('afiliado_administrativo')
    ->where('agendado','<',$diaActual)
    ->get();



	return view('dashboard.inicio', compact('listado','casosDia','casosDiaLista','casosRetrasadosCuenta','casosRetrasadosLista'));

    }


    }


    public function search(Request $request)
    {

        $search = $request->input('busqueda');

      
    $query = DB::connection('mysql2')->table('afiliado_datos')

        ->where('afiliado_datos.servicio','like', '%'.$search.'%')

        ->orWhere('afiliado_datos.caso','like', '%'.$search.'%')

        ->orWhere('afiliado_datos.documento','like', '%'.$search.'%')

        ->orWhere('afiliado_datos.voucher','like', '%'.$search.'%')

        ->orWhere('afiliado_datos.email','like', '%'.$search.'%')

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('*')
    ->get();

      return view('dashboard.inicio',compact('query','search'));

    }



     public function show($servicio)
    {


    	$registros = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('*')
    ->first();

    $clienteId = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('cliente')
    ->value('cliente');

     $nombrePasajero = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('nombre')
    ->value('nombre');

     $caso = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_datos.caso')
    ->value('caso');

    $voucher = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_datos.voucher')
    ->value('voucher');

    $documento = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_datos.documento')
    ->value('documento');


    $planNombre = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_administrativo.plan')
    ->value('plan');


    $subservicioId = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_datos.subservicio')
    ->value('subservicio');

    $nombreSubservicio = DB::connection('mysql2')->table('operaciones_subservicio')
    ->where('id',$subservicioId)
    ->value('nombre');

    $fechaSolicitud = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_datos.fecha_solicitud')
    ->value('fecha_solicitud');

    $direccionEvento = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_datos.direccion_evento')
    ->value('direccion_evento');


    $montoSolicitado = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_administrativo.monto_solicitado')
    ->value('monto_solicitado');

    $isoMoneda = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_administrativo.moneda')
    ->value('moneda');


    $moneda = DB::connection('mysql2')->table('currency')
        ->where([
        	['CurrencyISO','=',$isoMoneda],
        	['Language','=', 'ES'],
        ])
        ->value('CurrencyName');


    $isoOcurrencia = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_datos.pais_ocurrencia')
    ->value('pais_ocurrencia');


   $paisOcurrencia = DB::connection('mysql2')->table('paises')
    	->where('iso',$isoOcurrencia)
    	->value('nombre');


    	 $isoResidencia = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_datos.pais_residencia')
    ->value('pais_residencia');


   $paisResidencia = DB::connection('mysql2')->table('paises')
    	->where('iso',$isoResidencia)
    	->value('nombre');


   
    $isoNacionalidad = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_datos.nacionalidad')
    ->value('nacionalidad');


   $paisNacionalidad = DB::connection('mysql2')->table('paises')
    	->where('iso',$isoNacionalidad)
    	->value('nombre');

         $pir = DB::connection('mysql2')->table('afiliado_administrativo')
        ->where('servicio_id',$servicio)
        ->value('pir');

 
         $aerolinea = DB::connection('mysql2')->table('afiliado_administrativo')
        ->where('servicio_id',$servicio)
        ->value('aerolinea');



    	$fechaOcurrencia = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_datos.fecha_ocurrencia')
    ->value('fecha_ocurrencia');


   $idEstatus = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_administrativo.estatus_solicitud')
    ->value('estatus_solicitud');


    $nombreEstatus = DB::connection('mysql2')->table('estatus_solicitud')
    	->where('codigo',$idEstatus)
    	->value('estatus');


    	$observaciones = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_datos.observaciones')
    ->value('observaciones');

    $email = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_datos.email')
    ->value('email');

    $estadoId =  DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_administrativo.estado')
    ->value('estado');

    $nombreEstado =  DB::connection('mysql2')->table('estatus_administrativo')
        ->where('codigo',$estadoId)
        ->value('nombre');

        $montoAprobado = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_administrativo.monto_aprobado')
    ->value('monto_aprobado');

    $monedaPago = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_administrativo.moneda_pago')
    ->value('moneda_pago');

    if ($monedaPago == NULL) {
    	
         $monedaPagoReal = 'Por determinar';

    }else{

        $monedaPagoReal = $monedaPago;

    }




    $fechaEnvioFormulario = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_administrativo.formulario_envio')
    ->value('formulario_envio');


    if ($fechaEnvioFormulario == NULL) {
    	
    	$fechaRealEnvio = 'Por determinar';

    }else{

    	$fechaRealEnvio =  $fechaEnvioFormulario ;

    }



    $fechaRecepcionFormulario = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_administrativo.formulario_recepcion')
    ->value('formulario_recepcion');


    if ($fechaRecepcionFormulario == NULL) {
    	
    	$fechaRealRecepcion = 'Por determinar';

    }else{

    	$fechaRealRecepcion =  $fechaRecepcionFormulario ;

    }
    


  $medioPagoId =  DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_administrativo.medio_pago')
    ->value('medio_pago');

    $medioPago = DB::connection('mysql2')->table('formas_pago')
    ->where('id',$medioPagoId)
    ->value('nombre');

    $fichaMedio =  DB::connection('mysql2')->table('formas_pago')
    ->where('id',$medioPagoId)
    ->value('ficha_medio');


    $fechaPago = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.fecha_para_pago') 
    ->value('fecha_para_pago');
    


    


    if ($fechaPago == NULL) {
    	$fechaPagoReal = 'Por determinar';
    }else{
    	$fechaPagoReal = $fechaPago;
    }


     $titular = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.titular') 
    ->value('titular');
    


    if ($titular == NULL) {
    	$titularReal = 'Por determinar';
    }else{
    	$titularReal = $titular;
    }


    $documentoPago = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.documento_pago') 
    ->value('documento_pago');
    


    if ($documentoPago == NULL) {
        $documentoPagoReal = 'Por determinar';
    }else{
        $documentoPagoReal = $titular;
    }



     $bancoPago = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.banco_pago') 
    ->value('banco_pago');
    


    if ($bancoPago == NULL) {
        $bancoPagoReal = 'Por determinar';
    }else{
        $bancoPagoReal = $titular;
    }

    $cuentaPago = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.cuenta') 
    ->value('cuenta');
    


    if ($cuentaPago == NULL) {
        $cuentaPagoReal = 'Por determinar';
    }else{
        $cuentaPagoReal = $cuentaPago;
    }

 
    $tipoCuenta = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.tipo_cuenta') 
    ->value('tipo_cuenta');
    


    if ($tipoCuenta == NULL) {
        $tipoCuentaReal = 'Por determinar';
    }else{
        $tipoCuentaReal = $tipoCuenta;
    }



     $swift = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.swift') 
    ->value('swift');
    


    if ($swift == NULL) {
        $swiftReal = 'Por determinar';
    }else{
        $swiftReal = $swift;
    }



    $direccionBanco = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.direccion_banco') 
    ->value('direccion_banco');
    


    if ($direccionBanco == NULL) {
        $direccionBancoReal = 'Por determinar';
    }else{
        $direccionBancoReal = $direccionBanco;
    }


    $direccionBancoDomicilada = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.direccion_banco') 
    ->value('direccion_banco');
    


    if ($direccionBancoDomicilada == NULL) {
        $direccionBancoDomiciladaReal = 'Por determinar';
    }else{
        $direccionBancoDomiciladaReal = $direccionBancoDomicilada;
    }


   $paisPago = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.pais_pago') 
    ->value('pais_pago');
    


    if ($paisPago == NULL) {
    	$paisPagoReal = 'Por determinar';
    }else{
    	$paisPagoReal = $paisPago;
    }

    $paisPago = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.pais_pago') 
    ->value('pais_pago');
    


    if ($paisPago == NULL) {
    	$paisPagoReal = 'Por determinar';
    }else{
    	$paisPagoReal = $paisPago;
    }


   $ciudadPago = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.ciudad_pago') 
    ->value('ciudad_pago');

    


    if ($ciudadPago == NULL) {
    	$ciudadPagoReal = 'Por determinar';
    }else{
    	$ciudadPagoReal = $ciudadPago;
    }

   $provinciaPago = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.provincia_pago') 
    ->value('provincia_pago');

    


    if ($provinciaPago == NULL) {
    	$provinciaPagoReal = 'Por determinar';
    }else{
    	$provinciaPagoReal = $provinciaPago;
    }    



    $efectivo = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$servicio)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.especificaciones') 
    ->value('especificaciones');

    


    if ($efectivo == NULL) {
        $especificacionesEfectivo = 'Por determinar';
    }else{
        $especificacionesEfectivo = $efectivo;
    }    



     $eventos =  DB::connection('mysql2')->table('evento')
    ->where('id_mod',$servicio)
    ->get();


    
   

  $cliente =  DB::connection('mysql')->table('clientes_corporativos')
  ->where('id',$clienteId)->value('nombre_comercial');

  $estatusSolicitudListado = DB::connection('mysql2')
  ->table('estatus_solicitud')
  ->orderByraw('codigo','ASC')
  ->get();


  $estatusAdministrativos =  DB::connection('mysql2')->table('estatus_administrativo')->get();

   $formasPago =  DB::connection('mysql2')->table('formas_pago')->get();

   $listadoMonedas = DB::connection('mysql2')->table('currency')->where('Language','ES')->get();


   $listadosEstados = DB::connection('mysql2')->table('estatus_administrativo')->get();



    $medioPagoIdFicha = DB::connection('mysql2')->table('afiliado_administrativo')
        ->where('servicio_id',$servicio)
        ->value('medio_pago');

        $formularioFicha = DB::connection('mysql2')->table('formas_pago')
        ->where('id',$medioPagoIdFicha)
        ->value('formulario');









    
    	return view('dashboard.ver', compact('registros','cliente','servicio','nombrePasajero','caso','voucher','nombrePasajero','planNombre','nombreSubservicio','formasPago','documento','fechaSolicitud','direccionEvento','montoSolicitado','moneda','paisResidencia','isoMoneda','paisOcurrencia','paisNacionalidad','fechaOcurrencia','nombreEstatus','observaciones','email','nombreEstado','montoAprobado','monedaPago','monedaPagoReal','fechaRealEnvio','fechaRealRecepcion','medioPagoId','fichaMedio','medioPago','fechaPagoReal','titularReal','paisPagoReal','ciudadPagoReal','provinciaPagoReal','estatusSolicitudListado','eventos','estatusAdministrativos','listadoMonedas','documentoPagoReal','bancoPagoReal','tipoCuentaReal','cuentaPagoReal','direccionBancoReal','swiftReal','direccionBancoDomiciladaReal','listadosEstados','formularioFicha','especificacionesEfectivo','aerolinea','pir'));

    }



    public function changeStatus(Request $request, $id){


      $rules = [
         'estatus_solicitud' => 'required'
    ];

     $this->validate($request, $rules);


     DB::connection('mysql2')->table('afiliado_administrativo')
    	->where('servicio_id',$id)

    ->update([
    	'estatus_solicitud' => $request->input('estatus_solicitud')
    ]);

      
     if ($request->input('estatus_solicitud') == 2) {
						$status = 'Recibido';
						
					}elseif ($request->input('estatus_solicitud') == 3) {
						$status = 'En análisis';
						
					}elseif ($request->input('estatus_solicitud') == 4) {
						$status = 'Aprobado';
						

					}elseif ($request->input('estatus_solicitud') == 5) {
						$status = 'Negado';
						
					}elseif ($request->input('estatus_solicitud') == 6) {
						$status = 'Aprobado parcial';
						

					
					}elseif ($request->input('estatus_solicitud')== 7) {
						$status = 'Documentación faltante';	
					}else{

						$status = '';
					}

     $objReintegros = NULL;

      $mensaje = $request->input('mensaje');
      $check = $request->input('check');


       if ( $mensaje != NULL && $check != NULL) {

      $emailPasajero = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_datos.email')
    ->value('email');

      $nombrePasajero = DB::connection('mysql2')->table('afiliado_datos')
    	->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('afiliado_datos.nombre')
    ->value('nombre');

       //Inicializo los 4 inputs de CC 



    $cc1 = $request->input('cc1');
    $cc2 = $request->input('cc2');
    $cc3 = $request->input('cc3');
    $cc4 = $request->input('cc4');

    if ($request->input('cc1') == NULL) {
    	$cc1 = 'no-reply@quanticoservicios.net';
    }
    if ($request->input('cc2') == NULL) {
    	$cc2 = 'no-reply@quanticoservicios.net';
    }
    if ($request->input('cc3') == NULL) {
    	$cc3 = 'no-reply@quanticoservicios.net';
    }
    if ($request->input('cc4') == NULL) {
    	$cc4 = 'no-reply@quanticoservicios.net';
    }
     
     
     $copias = [$cc1, $cc2, $cc3, $cc4];

     if ($request->file('adjuntos') == NULL) {
       $files = ['0'];
     }else{
      $files = $request->file('adjuntos');
     }

     
         
         $i = 0;
     //Configuracion para enviar parametros dinamicos en  envio de correo electronico notificando al pasajero del cambio de estado

     foreach ($files as $key => $file) {
     	$i++;
     }

     $voucher = DB::connection('mysql2')
     ->table('afiliado_datos')
     ->where('servicio',$id)
     ->value('voucher');


      $objReintegros = new \stdClass();
      $objReintegros->nuevoEstado = $status;
      $objReintegros->voucher = $voucher;
      $objReintegros->mensajeEstado = $mensaje;
      $objReintegros->sender = 'Departamento de Reintegros';
      $objReintegros->receiver = $nombrePasajero;

        if($i > 0) {
            foreach ($files as $key => $file) {
     	     $objReintegros->files = $request->file('adjuntos');
           } 
        }else{
          $objReintegros->files = NULL;
        }

   
      Mail::to($emailPasajero)
      ->cc($copias)
      ->send(new CambioEstado($objReintegros));



      DB::table('evento')->insert([

      	'id_mod' => $id,

      	'mensaje' => $mensaje,

        'tipo_modificacion' => 'El caso ha sido actualizado de estado: '.$status.' el pasajero ha sido notificado',

        'usuario' => auth()->user()->name

      ]);



      


      Session::flash('estado_actualizado','El estatus del caso ha sido actualizado correctamente y el pasajero ha sido notificado via email');

       return redirect()->route('ver', $id);


         }else{

         	 DB::table('evento')->insert([

      	'id_mod' => $id,

      	'mensaje' => $mensaje,

        'tipo_modificacion' => 'El caso ha sido actualizado de estado: '.$status.' el pasajero NO ha sido notificado',

        'usuario' => auth()->user()->name

      ]);

       
         Session::flash('estado_actualizado','El estatus del caso ha sido actualizado correctamente y el pasajero NO ha sido notificado via email');


         return redirect()->route('ver', $id);



    }




}

public function manualEvent(Request $request, $id)
       {

       $mensaje = 	$request->input('eventomanual');


        DB::table('evento')->insert([
                   'tipo_modificacion' => 'Se há añadido un evento manualmente',
                   'mensaje' => $mensaje,
                   'id_mod'  => $id,
                   'usuario' => auth()->user()->name

        ]);


        Session::flash('evento_insertado', 'Evento registrado en la bitacora exitosamente');


        return redirect()->route('ver', $id);

       }





       public function infoAdm(Request $request, $id)
       {

           $rules = [
           'monto_aprobado' => 'required',
           'moneda_aprobado' => 'required',
           'medio_pago' => 'required'
       ];




       $this->validate($request, $rules);

      $montoAprobado =  $request->input('monto_aprobado');
      $monedaAprobada = $request->input('moneda_aprobado');
      $medioPago = $request->input('medio_pago');

      $monedaAprobadaReal =  
      DB::connection('mysql2')->table('currency')
      ->where([
        ['CurrencyISO','=',$monedaAprobada],
        ['Language','=','ES'],

    ])
      ->value('CurrencyName');



       DB::connection('mysql2')->table('afiliado_administrativo')
        ->where('servicio_id',$id)
        ->update([
            'monto_aprobado' =>  $montoAprobado,
            'moneda_pago' =>  $monedaAprobadaReal,
            'medio_pago' =>  $medioPago

        ]);


    


     

       if ($medioPago == 1) {
        $forma_pago = 'Western Union';
       }elseif ($medioPago == 2) {
        $forma_pago = 'Transferencia Local';
       }elseif ($medioPago == 3) {
        $forma_pago = 'Transferencia Internacional';
       }elseif ($medioPago == 4) {
        $forma_pago = 'Efectivo';
       }else{
        $forma_pago = '';
       }




       DB::table('evento')->insert([

        'id_mod' => $id,

        'mensaje' => 'Información administrativa modificada, monto aprobado: '.$request->input('monto_aprobado').' '.$request->input('moneda_aprobado').', medio de pago: '.$forma_pago,

        'tipo_modificacion' => 'La información administrativa del caso ha sido modificada',

        'usuario' => auth()->user()->name
 
       ]);


       Session::flash('info_adm', 'Información administrativa modificada exitosamente');
        
       
       return redirect()->route('ver', $id); 
       }



        public function changeAdmin(Request $request, $id)
       {


         $rules = [

          'estado' => 'required'

         ];

         $this->validate($request, $rules);


          $estado = $request->input('estado');

         if ($estado == 2) {

          $rules2 = [

          'fecha_pagado' => 'required',
          'referencia' => 'required'

         ];

          $this->validate($request, $rules2);




           DB::connection('mysql2')->table('afiliado_administrativo')
           ->where('servicio_id',$id)
           ->update([
            'estado' => $estado,
            'fecha_pagado' => $request->input('fecha_pagado'),
            'referencia' => $request->input('referencia')
           ]);

           DB::table('evento')->insert([

         'id_mod' => $id,
  
         'tipo_modificacion' => 'Estatus administrativo del caso actualizado',

         'mensaje' => 'El estatus administrativo del caso ha sido modificado a Cerrado /  Pagado, fecha de pago del caso: '.$request->input('fecha_pagado'),

         'usuario' => auth()->user()->name

         ]);

           Session::flash('estado_actualizado2', 'El estatus administrativo del caso ha sido actualizado');





           return redirect()->route('ver', $id);

           }



         if ($estado == 1) {
           $text = 'Abierto / Por Pagar';
          }elseif ($estado == 3) {
            $text = 'Cerrado / Negado';
          }else{
            $text = 'Por determinar';
          }


          DB::connection('mysql2')
          ->table('afiliado_administrativo')
          ->where('servicio_id',$id)
           ->update([
            'estado' => $estado
            
           ]);

          DB::table('evento')->insert([

         'id_mod' => $id,

           'tipo_modificacion' => 'Estatus administrativo del caso actualizado',

           'mensaje' => 'El estatus administrativo del caso ha sido modificado a '.$text,

           'usuario' => auth()->user()->name

         ]);


         Session::flash('estado_actualizado2', 'El estatus administrativo del caso ha sido actualizado');



         return redirect()->route('ver', $id);


         }




       public function formRequest(Request $request, $id)
       {


        $fecha_envio_form = $request->input('fecha_envio_form');

         if ($fecha_envio_form > Carbon::now()) {
           Session::flash('formulario_info_fallida2','No puede indicar una fecha de envío para el formulario mayor a la fecha actual');

    return redirect()->route('ver', $id); 
        }




       DB::connection('mysql2')
       ->table('afiliado_administrativo')
       ->where('servicio_id', $id)
       ->update([

        'formulario_envio' => $fecha_envio_form,

       ]);


        DB::table('evento')->insert([

        'id_mod' => $id,

        'mensaje' => 'Fecha de envio del formulario al pasajero '.$fecha_envio_form,

        'tipo_modificacion' => 'Se ha modificado la información del envio del formulario al pasajero',

        'usuario' => auth()->user()->name

      ]);



    Session::flash('formulario_info','Información de formulario actualizada exitosamente');


    return redirect()->route('ver', $id); 

       
       }

       public function formRequest2(Request $request, $id)
       {


        $formulario_recepcion = $request->input('formulario_recepcion');

        if ($formulario_recepcion > Carbon::now()) {
           Session::flash('formulario_info_fallida','No puede indicar una fecha de recepción para el formulario mayor a la fecha actual');

    return redirect()->route('ver', $id); 
        }



       DB::connection('mysql2')
       ->table('afiliado_administrativo')
       ->where('servicio_id', $id)
       ->update([

        'formulario_recepcion' => $formulario_recepcion,

       ]);



     DB::table('evento')->insert([

        'id_mod' => $id,

        'mensaje' => 'Fecha de recepción del formulario del pasajero '.$formulario_recepcion,

        'tipo_modificacion' => 'Se ha modificado la información de la recepcion del formulario ',

        'usuario' => auth()->user()->name

      ]);


    Session::flash('formulario_info','Información de formulario actualizada exitosamente');

    return redirect()->route('ver', $id); 

              }

    


    public function fichaUpdate(Request $request, $id)
    {
            

      $medioPagoId = DB::connection('mysql2')->table('afiliado_administrativo')
      ->where('servicio_id',$id)
      ->value('medio_pago');


          $voucher = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)
        ->value('voucher');

        //Valido que la ficha de pago no exista

        $validacion = DB::connection('mysql2')->table('fichas_pago')
        ->where('servicio_id',$id)
        ->count();


        $caso = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)
        ->value('caso');


         if ($validacion > 0) {
             
           DB::connection('mysql2')->table('fichas_pago')
        ->where('servicio_id',$id)
        ->delete();


         DB::connection('mysql2')->table('fichas_pago')
        ->insert([

            'servicio_id'  => $id,
            'caso' => $caso,
            'medio_pago_id'  => $medioPagoId,
            'voucher' => $voucher

        ]);



      if ($medioPagoId == 1) 
      {
                

     $this->validate($request,[ 
        'fecha_para_pago'=>'required', 
        'titular'=>'required', 
        'pais'=>'required', 
        'provincia'=>'required', 
        'ciudad_estado'=>'required']);
         


      $fechaParaPago =   $request->input('fecha_para_pago');
      $titular = $request->input('titular');
      $pais =  $request->input('pais');
      $provincia =  $request->input('provincia');
      $ciudad_estado =  $request->input('ciudad_estado');





        DB::connection('mysql2')->table('fichas_pago')
      ->where('servicio_id',$id)
      ->update([

        'fecha_para_pago' => $fechaParaPago,
        'titular' => $titular,
        'pais_pago' => $pais,
        'provincia_pago' => $provincia,
        'ciudad_pago' => $ciudad_estado

      ]);





       DB::table('evento')->insert([

        'id_mod' => $id,

        'tipo_modificacion' => 'Información de pago actualizada: Western Union',

        'mensaje' => 'La informacion de pago del caso ha sido actualizada, se han editado y/o agragado datos de Western Union',

        'usuario' => auth()->user()->name

       ]);


       Session::flash('ficha_actualizada', 'Se ha actualizado la informacion para el pago correctamente');



         return redirect()->route('ver', $id);


          
      }elseif ($medioPagoId == 2) {


           $this->validate($request,[ 
            'fecha_para_pago2'=>'required', 
            'titular'=>'required', 
            'documento_pago'=>'required', 
            'banco'=>'required', 
            'cuenta'=>'required', 
            'tipo_cuenta' => 'required']);


       

        $fechaPago = $request->input('fecha_para_pago2');
        $titular = $request->input('titular');
        $documento = $request->input('documento_pago');
        $banco = $request->input('banco');
        $cuenta = $request->input('cuenta');
        $tipoCuenta = $request->input('tipo_cuenta');


        DB::connection('mysql2')->table('fichas_pago')
      ->where('servicio_id',$id)
      ->update([

        'fecha_para_pago' => $fechaPago,
        'titular' => $titular,
        'documento_pago' => $documento,
        'banco_pago' => $banco,
        'cuenta' => $cuenta,
        'tipo_cuenta' => $tipoCuenta,

      ]);

    


       DB::table('evento')->insert([

        'id_mod' => $id,

        'tipo_modificacion' => 'Información de pago actualizada: Transferencia Local',

        'mensaje' => 'La informacion de pago del caso ha sido actualizada, se han editado y/o agregado datos de Transferencia Local',

        'usuario' => auth()->user()->name

       ]);


       Session::flash('ficha_actualizada1', 'Se ha actualizado la informacion para el pago correctamente');



         return redirect()->route('ver', $id);

      }elseif ($medioPagoId == 3) {
          


          $this->validate($request,[ 
            'fecha_para_pago3'=>'required', 
            'titular'=>'required', 
            'documento_pago'=>'required', 
            'banco'=>'required', 
            'cuenta'=>'required', 
            'tipo_cuenta' => 'required', 
            'swift' => 'required',
            'direccion' => 'required',
            'direccion_domiciliada' => 'required']);

       

      $fechaPago = $request->input('fecha_para_pago3');
      $titular = $request->input('titular');
      $documento = $request->input('documento_pago');
      $banco = $request->input('banco');
      $cuenta = $request->input('cuenta');
      $tipoCuenta = $request->input('tipo_cuenta');
      $swift = $request->input('swift');
      $direccionBanco = $request->input('direccion');
      $direccionDomiciada = $request->input('direccion_domiciliada');


         DB::connection('mysql2')->table('fichas_pago')
      ->where('servicio_id',$id)
      ->update([

        'fecha_para_pago' => $fechaPago,
        'titular' => $titular,
        'documento_pago' => $documento,
        'banco_pago' => $banco,
        'cuenta' => $cuenta,
        'tipo_cuenta' => $tipoCuenta,
        'swift' => $swift,
        'direccion_banco' => $direccionBanco,
        'direccion_banco_domiciliada' => $direccionDomiciada

      ]);


       DB::table('evento')->insert([

        'id_mod' => $id,

        'tipo_modificacion' => 'Información de pago actualizada: Transferencia Internacional',

        'mensaje' => 'La informacion de pago del caso ha sido actualizada, se han editado y/o agregado datos de Transferencia Internacional',

        'usuario' => auth()->user()->name

      ]);


       Session::flash('ficha_actualizada2', 'Se ha actualizado la informacion para el pago correctamente');



         return redirect()->route('ver', $id);




      }elseif ($medioPagoId == 4) {
         

         $this->validate($request,[ 
            'fecha_para_pago4'=>'required', 
            'especificaciones'=>'required']);

      

         $fechaPago = $request->input('fecha_para_pago4');
         $especificaciones = $request->input('especificaciones');


         DB::connection('mysql2')->table('fichas_pago')
      ->where('servicio_id',$id)
      ->update([

        'fecha_para_pago' => $fechaPago,
        'especificaciones' => $especificaciones

      ]);
          



       DB::table('evento')->insert([

        'id_mod' => $id,

        'tipo_modificacion' => 'Información de pago actualizada: Efectivo',

        'mensaje' => 'La informacion de pago del caso ha sido actualizada, se han editado y/o agregado datos de Efectivo',

        'usuario' => auth()->user()->name

      ]);


       Session::flash('ficha_actualizada3', 'Se ha actualizado la informacion para el pago correctamente');



         return redirect()->route('ver', $id);




      }

  }else{


     $caso = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)
        ->value('caso');

        DB::connection('mysql2')->table('fichas_pago')
        ->insert([

            'servicio_id'  => $id,
            'medio_pago_id'  => $medioPagoId,
            'voucher' => $voucher,
            'caso' =>$caso

        ]);



      if ($medioPagoId == 1) 
      {
                

     $this->validate($request,[ 
        'fecha_para_pago'=>'required', 
        'titular'=>'required', 
        'pais'=>'required', 
        'provincia'=>'required', 
        'ciudad_estado'=>'required']);
         


      $fechaParaPago =   $request->input('fecha_para_pago');
      $titular = $request->input('titular');
      $pais =  $request->input('pais');
      $provincia =  $request->input('provincia');
      $ciudad_estado =  $request->input('ciudad_estado');





        DB::connection('mysql2')->table('fichas_pago')
      ->where('servicio_id',$id)
      ->update([

        'fecha_para_pago' => $fechaParaPago,
        'titular' => $titular,
        'pais_pago' => $pais,
        'provincia_pago' => $provincia,
        'ciudad_pago' => $ciudad_estado

      ]);





       DB::table('evento')->insert([

        'id_mod' => $id,

        'tipo_modificacion' => 'Información de pago actualizada: Western Union',

        'mensaje' => 'La informacion de pago del caso ha sido actualizada, se han editado y/o agragado datos de Western Union',

        'usuario' => auth()->user()->name

       ]);


       Session::flash('ficha_actualizada', 'Se ha actualizado la informacion para el pago correctamente');



         return redirect()->route('ver', $id);


          
      }elseif ($medioPagoId == 2) {


           $this->validate($request,[ 
            'fecha_para_pago2'=>'required', 
            'titular'=>'required', 
            'documento_pago'=>'required', 
            'banco'=>'required', 
            'cuenta'=>'required', 
            'tipo_cuenta' => 'required']);


       

        $fechaPago = $request->input('fecha_para_pago2');
        $titular = $request->input('titular');
        $documento = $request->input('documento_pago');
        $banco = $request->input('banco');
        $cuenta = $request->input('cuenta');
        $tipoCuenta = $request->input('tipo_cuenta');


        DB::connection('mysql2')->table('fichas_pago')
      ->where('servicio_id',$id)
      ->update([

        'fecha_para_pago' => $fechaPago,
        'titular' => $titular,
        'documento_pago' => $documento,
        'banco_pago' => $banco,
        'cuenta' => $cuenta,
        'tipo_cuenta' => $tipoCuenta,

      ]);

    


       DB::table('evento')->insert([

        'id_mod' => $id,

        'tipo_modificacion' => 'Información de pago actualizada: Transferencia Local',

        'mensaje' => 'La informacion de pago del caso ha sido actualizada, se han editado y/o agregado datos de Transferencia Local',

        'usuario' => auth()->user()->name

       ]);


       Session::flash('ficha_actualizada1', 'Se ha actualizado la informacion para el pago correctamente');



         return redirect()->route('ver', $id);

      }elseif ($medioPagoId == 3) {
          


          $this->validate($request,[ 
            'fecha_para_pago3'=>'required', 
            'titular'=>'required', 
            'documento_pago'=>'required', 
            'banco'=>'required', 
            'cuenta'=>'required', 
            'tipo_cuenta' => 'required', 
            'swift' => 'required',
            'direccion' => 'required',
            'direccion_domiciliada' => 'required']);

       

      $fechaPago = $request->input('fecha_para_pago3');
      $titular = $request->input('titular');
      $documento = $request->input('documento_pago');
      $banco = $request->input('banco');
      $cuenta = $request->input('cuenta');
      $tipoCuenta = $request->input('tipo_cuenta');
      $swift = $request->input('swift');
      $direccionBanco = $request->input('direccion');
      $direccionDomiciada = $request->input('direccion_domiciliada');


         DB::connection('mysql2')->table('fichas_pago')
      ->where('servicio_id',$id)
      ->update([

        'fecha_para_pago' => $fechaPago,
        'titular' => $titular,
        'documento_pago' => $documento,
        'banco_pago' => $banco,
        'cuenta' => $cuenta,
        'tipo_cuenta' => $tipoCuenta,
        'swift' => $swift,
        'direccion_banco' => $direccionBanco,
        'direccion_banco_domiciliada' => $direccionDomiciada

      ]);


       DB::table('evento')->insert([

        'id_mod' => $id,

        'tipo_modificacion' => 'Información de pago actualizada: Transferencia Internacional',

        'mensaje' => 'La informacion de pago del caso ha sido actualizada, se han editado y/o agregado datos de Transferencia Internacional',

        'usuario' => auth()->user()->name

      ]);


       Session::flash('ficha_actualizada2', 'Se ha actualizado la informacion para el pago correctamente');



         return redirect()->route('ver', $id);




      }elseif ($medioPagoId == 4) {
         

         $this->validate($request,[ 
            'fecha_para_pago4'=>'required', 
            'especificaciones'=>'required']);

      

         $fechaPago = $request->input('fecha_para_pago4');
         $especificaciones = $request->input('especificaciones');


         DB::connection('mysql2')->table('fichas_pago')
      ->where('servicio_id',$id)
      ->update([

        'fecha_para_pago' => $fechaPago,
        'especificaciones' => $especificaciones

      ]);
          



       DB::table('evento')->insert([

        'id_mod' => $id,

        'tipo_modificacion' => 'Información de pago actualizada: Efectivo',

        'mensaje' => 'La informacion de pago del caso ha sido actualizada, se han editado y/o agregado datos de Efectivo',

        'usuario' => auth()->user()->name

      ]);


       Session::flash('ficha_actualizada3', 'Se ha actualizado la informacion para el pago correctamente');



         return redirect()->route('ver', $id);


      }

  }

  }


       public function uploadFile(Request $request, $id)
       {  


         $request->validate([
        'documentos' => 'mimes:jpeg,bmp,png,gif,pdf,jpg,jpe',
        ]);


        $file = $request->file('documentos');

        $rules = ['

        '];

       

        $nombre = $file->getClientOriginalName();


         $registros = DB::connection('mysql2')
         ->table('afiliado_datos')->where('servicio','=',$id)->first();



         $ruta= $id;
         
      
          
            $path = $file->storeAs('public/solicitud/'.$ruta.'',$nombre);

            
    
       DB::table('evento')->insert([

        'id_mod' => $id,

        'mensaje' => 'Archivos subidos',

        'tipo_modificacion' => 'Se han subido archivos manualmente',

        'usuario' => auth()->user()->name

      ]);


     Session::flash('subida_manual', 'El archivo ha sido subido exitosamente');

     return redirect()->route('archivospax',$id);
        



       }







          public function correoAdm(Request $request, $id)
       
       {

        

     $servicio = $id;

     $fechapago = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.fecha_para_pago') 
    ->value('fecha_para_pago');

     $medio = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.medio_pago_id') 
    ->value('medio_pago_id');
     
     $medioNombre= DB::connection('mysql2')->table('formas_pago')
     ->where('id',$medio)
     ->value('nombre');


     $caso =  DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.caso') 
    ->value('caso');

     $titular =  DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.titular') 
    ->value('titular');


     $doc =   DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.documento_pago') 
    ->value('documento_pago');


     $banco = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.banco_pago') 
    ->value('banco_pago');


     $cuenta = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.cuenta') 
    ->value('cuenta');


     $swift = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.swift') 
    ->value('swift');


     $direccion = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.direccion_banco') 
    ->value('direccion_banco');



     $direccion_domiciliada = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.direccion_banco_domiciliada') 
    ->value('direccion_banco_domiciliada');


     $pais = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.pais_pago') 
    ->value('pais_pago');


     $ciudad_estado = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.ciudad_pago') 
    ->value('ciudad_pago');


     $provincia = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.provincia_pago') 
    ->value('provincia_pago');


     $tipo_cuenta = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.tipo_cuenta') 
    ->value('tipo_cuenta');


     $especificaciones = DB::connection('mysql2')->table('afiliado_datos')
        ->where('servicio',$id)

    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->join('fichas_pago','fichas_pago.servicio_id','=','afiliado_datos.servicio')
    ->select('fichas_pago.especificaciones') 
    ->value('especificaciones');


     $receptores =  $request->input('receptores');
     $mensaje =  $request->input('aclaratorias');
    

      $ObjAdministrativos = new \stdClass();
      $ObjAdministrativos->medioPago = $medio;
      $ObjAdministrativos->medioNombre = $medioNombre;
      $ObjAdministrativos->fechapago = $fechapago;
      $ObjAdministrativos->servicio = $servicio;
      $ObjAdministrativos->caso = $caso;
      $ObjAdministrativos->aclaratorias = $mensaje;
      $ObjAdministrativos->titular = $titular;
      $ObjAdministrativos->documento = $doc;
      $ObjAdministrativos->banco = $banco;
      $ObjAdministrativos->cuenta = $cuenta;
      $ObjAdministrativos->swift = $swift;
      $ObjAdministrativos->direccion = $direccion;
      $ObjAdministrativos->direccion_domiciliada = $direccion_domiciliada;
      $ObjAdministrativos->pais = $pais;
      $ObjAdministrativos->ciudad_estado = $ciudad_estado;
      $ObjAdministrativos->provincia = $provincia;
      $ObjAdministrativos->tipo_cuenta = $tipo_cuenta;
      $ObjAdministrativos->especificaciones = $especificaciones;
      $ObjAdministrativos->mensaje = $mensaje;
      $ObjAdministrativos->sender = 'Departamento de Reintegros';
      

      Mail::to($receptores)->send(new envioAdministrativo($ObjAdministrativos));



        DB::table('evento')->insert([
                   'tipo_modificacion' => 'Se há enviado la información administrativa correspondiente al pago',
                   'mensaje' => 'Se ha enviado la ficha administrativa para el pago del caso',
                   'id_mod'  => $id,

                   'usuario' => auth()->user()->name

        ]);

        Session::flash('info_enviada','Se ha enviado la información administrativa para el pago exitosamente');


        return redirect()->route('ver', $id);

       }


       public function archivosPax(Request $request,$id)
       {

        $registros = DB::connection('mysql2')
        ->table('afiliado_datos')
        ->where('servicio','=',$id)
        ->first();
        


     //  $files = Storage::allFiles('/public/solicitud/'.$id.'');

         $files = Storage::allFiles('/public/solicitud/'.$id.'/');
      
        
    
       if ($files == []) {

       $view[] = NULL;

       }else{

        foreach ($files as $key => $file) {
           $view[] = basename($file);
       }

       }



        return view('dashboard.archivospax',compact('registros','view','id'));
       }


       public function deleteDocPax(Request $request, $id) {

        $filename = $request->input('archivo_name');

        Storage::delete('public/solicitud/'.$id.'/'.$filename);


         return redirect()->back();
       }

       public function deleteDocAdm(Request $request, $id) {


        $filename = $request->input('archivo_name');

        Storage::delete('public/administrativos/'.$id.'/'.$filename);


         return redirect()->back();
       }


       public function archivosAdm(Request $request, $id)
       {


        $registros = DB::connection('mysql2')
        ->table('afiliado_datos')
        ->where('servicio','=', $id)
        ->first();
        
        $ruta = $id;

        $files = Storage::allFiles('/public/administrativos/'.$ruta);

        if ($files == []) {

        $view[] = NULL;

        }else{

        foreach ($files as $key => $file) {

        $view[] = basename($file);

        }

       }




        return view('dashboard.archivosadm', compact('registros','view','id'));

       }


       public function uploadadm(Request $request, $id)
       {

         $request->validate([
        'documentos' => 'mimes:jpeg,bmp,png,gif,pdf,jpg,jpe',
        ]);


        $file = $request->file('documentos');

        $nombre = $file->getClientOriginalName();

        $registros = DB::connection('mysql2')
        ->table('afiliado_datos')
        ->where('servicio','=',$id)
        ->first();

        $ruta = $id;


                  
        $path = $file->storeAs('public/administrativos/'.$ruta,$nombre);



        DB::table('evento')->insert([

        'id_mod' => $id,

        'mensaje' => 'Archivos administrativos subidos',

        'tipo_modificacion' => 'Se han subido archivos administrativos al caso',

        'usuario' => auth()->user()->name

          ]);


     Session::flash('subida_manual', 'El archivo ha sido subido exitosamente');


     return redirect()->route('archivosAdm', $id);

       }






     }