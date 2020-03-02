<?php

namespace App\Http\Controllers;


use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\View;                                           
use Illuminate\Support\Facades\Mail;                                           
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\MessageBag;  
use App\Mail\ConfirmationForm;  
use App\Mail\newRequest;                                           
use Illuminate\Http\UploadedFile; 
use Illuminate\Http\Request; 
use Illuminate\Http\File; 
use Carbon\Carbon;
use App\Crmquery;
use Session;


class LogueadosController extends Controller
{
    //

      public function __construct()
   {
       $this->middleware('users');
   }
    
    public function index(Request $request, $voucher, $caso, $service, $hash, $afiliadoId, $voucherid)
    {


      View::share('voucher','voucherShared');
      View::share('caso','casoShared');
      View::share('servicio','servicioShared');
      View::share('hash','hashShared');
      View::share('afiliadoId','afiliadoIdShared');
      View::share('voucherid','voucheridShared');

         
      
$q1 = 'c0_.id';
$q2 = 'c0_.fecha_creacion';
$q3 = 'c0_.fecha_modificacion';
$q4 = 'c0_.preexistencia_solucion';
$q5 = 'c0_.diagnostico_tratamiento';
$q6 = 'c0_.direccion_actual_afiliado';
$q7 = 'c0_.telefono_actual_afiliado';
$q8 = 'c0_.descripcion';
$q9 = 'c0_.estado';
$q10 = 'c0_.ciudad';
$q11 = 'c0_.cliente_corporativo_id';
$q12 = 'c0_.afiliado_id';
$q13 = 'c0_.user_id';
$q14 = 'c0_.voucher_id';
$q15 = 'c0_.metodo_recepcion_caso_id';
$q16 = 'c0_.pais_id';
$q17 = 'c0_.preexistencia_id';
$q18 = 'c0_.idcasoidioma';



$w1 = 'c0_.voucher_id';
$w2 = 'v1_.id';
$w3 = 'v1_.numero';
$w4 = 'c0_.afiliado_id';
$w5 = 'a2_.id';
$w6 = 'a2_.identificacion_afiliado';
$w7 = 'a2_.nombre';

       

       $queryVoucher = DB::connection('mysql')->select('SELECT
  '.$q1.' AS id0,
  '.$q2.' AS fecha_creacion1,
  '.$q3.' AS fecha_modificacion2,
  '.$q4.' AS preexistencia_solucion3,
  '.$q5.' AS diagnostico_tratamiento4,
  '.$q6.' AS direccion_actual_afiliado5,
  '.$q7.' AS telefono_actual_afiliado6,
  '.$q8.' AS descripcion7,
    '.$q9.' AS estado8,
  '.$q10.' AS ciudad9,
  '.$q11.' AS cliente_corporativo_id10,
  '.$q12.' AS afiliado_id11,
  '.$q13.' AS user_id12,
  '.$q14.' AS voucher_id13,
  '.$q15.' AS metodo_recepcion_caso_id14,
  '.$q16.' AS pais_id15,
  '.$q17.' AS preexistencia_id16,
  '.$q18.' AS idcasoidioma17
FROM
  casos c0_
WHERE
  '.$w1.' IN (
    SELECT
      '.$w2.'
    FROM
      vouchers v1_
    WHERE
      '.$w3.' LIKE "%'.$voucher.'%"
  )
OR '.$w4.' IN (
  SELECT
    '.$w5.'
  FROM
    afiliados a2_
  WHERE
    '.$w6.' LIKE "%'.$voucher.'%"
  OR '.$w7.' LIKE "%'.$voucher.'%"
)
OR '.$q1.' = "'.$voucher.'"
ORDER BY
  '.$q1.' DESC
LIMIT 1 ');




 


  $x1 = 't0.id';
  $x2 = 't0.identificacion_afiliado';
  $x3 = 't0.nombre';
  $x4 = 't0.telefono';
  $x5 = 't0.email';
  $x6 = 't0.fecha_de_nacimiento';
  $x7 = 't0.genero';
  $x8 = 't0.is_active';
  $x9 = 't0.is_deleted';
  $x10 = 't0.is_manually_added';
  $x11 ='t0.nacionalidad';
  $x12 = 't0.observaciones';
  $x13 = 't0.cliente_id';
  $x14 = 'cliente_id13';
  $x15 = 't0.upload_id';
  $x16 = 't0.id';


$queryAfiliado = DB::connection('mysql')->select( 'SELECT '.$x1.' AS id1,'.$x2.' AS identificacion_afiliado2,'.$x3.' AS nombre3,'.$x4.' AS telefono4,'.$x5.' AS email5, '.$x6.' AS fecha_de_nacimiento6, '.$x7.' AS genero7, '.$x8.' AS is_active8, '.$x9.' AS is_deleted9, '.$x10.' AS is_manually_added10, '.$x11.' AS nacionalidad11,'.$x12.' AS observaciones12, '.$x13.' AS '.$x14.', '.$x15.' AS upload_id14 FROM afiliados t0 WHERE '.$x16.' = '.$afiliadoId);


  $nombrePax = $queryAfiliado[0]->nombre3;






       $clienteId = $queryAfiliado[0]->cliente_id13;
       



      $clienteNombre = DB::connection('mysql')->table('clientes_corporativos')->where('id',$clienteId)->value('nombre_comercial');

        





        return view('home', compact('clienteNombre', 'nombrePax', 'voucher', 'caso', 'service','hash', 'afiliadoId', 'voucherid'));


    	
    }




    public function showForm (Request $request, $voucher, $caso, $service, $hash, $afiliadoId, $voucherid)
    {


    $validacionCaso =  DB::connection('mysql2')->table('afiliado_datos')
    -> where([
          ['afiliado_datos.servicio', '=', $service],
          ['afiliado_datos.caso', '=', $caso],
          ['afiliado_datos.voucher', '=', $voucher],
          ])
    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('*')
    ->get();



    	 $subsercioId = DB::connection('mysql')->table('caso_servicios')

            ->where([
                ['tipo_servicio_id','=',4],
                ['caso_id','=',$caso ],
                ['caso_servicios.id','=',$service],
                ['estado_id','<>',999998],
                ['estado_id','<>',999999],

            ])
            ->join('casos','casos.id','=','caso_servicios.caso_id')
            ->select('subservicio_id')
            ->value('subservicio_id');

         
         $subservicioDatos = DB::connection('mysql')->table('operaciones_subservicio')
      
                  ->where([
                  	['id',$subsercioId],
                  	['is_deleted','<>',1]
                  ])
                  ->get();

                  $inputAdicional = DB::connection('mysql')->table('operaciones_subservicio')
      
                  ->where([
                    ['id',$subsercioId],
                    ['is_deleted','<>',1]
                  ])
                  ->value('tipo_cobertura');




         

        $paises =  DB::connection('mysql2')->table('paises')->get();
        $monedas =  DB::connection('mysql2')->table('currency')
        ->where('Language','ES')
        ->get();





$q1 = 'c0_.id';
$q2 = 'c0_.fecha_creacion';
$q3 = 'c0_.fecha_modificacion';
$q4 = 'c0_.preexistencia_solucion';
$q5 = 'c0_.diagnostico_tratamiento';
$q6 = 'c0_.direccion_actual_afiliado';
$q7 = 'c0_.telefono_actual_afiliado';
$q8 = 'c0_.descripcion';
$q9 = 'c0_.estado';
$q10 = 'c0_.ciudad';
$q11 = 'c0_.cliente_corporativo_id';
$q12 = 'c0_.afiliado_id';
$q13 = 'c0_.user_id';
$q14 = 'c0_.voucher_id';
$q15 = 'c0_.metodo_recepcion_caso_id';
$q16 = 'c0_.pais_id';
$q17 = 'c0_.preexistencia_id';
$q18 = 'c0_.idcasoidioma';



$w1 = 'c0_.voucher_id';
$w2 = 'v1_.id';
$w3 = 'v1_.numero';
$w4 = 'c0_.afiliado_id';
$w5 = 'a2_.id';
$w6 = 'a2_.identificacion_afiliado';
$w7 = 'a2_.nombre';

       

       $queryVoucher = DB::connection('mysql')->select('SELECT
  '.$q1.' AS id0,
  '.$q2.' AS fecha_creacion1,
  '.$q3.' AS fecha_modificacion2,
  '.$q4.' AS preexistencia_solucion3,
  '.$q5.' AS diagnostico_tratamiento4,
  '.$q6.' AS direccion_actual_afiliado5,
  '.$q7.' AS telefono_actual_afiliado6,
  '.$q8.' AS descripcion7,
    '.$q9.' AS estado8,
  '.$q10.' AS ciudad9,
  '.$q11.' AS cliente_corporativo_id10,
  '.$q12.' AS afiliado_id11,
  '.$q13.' AS user_id12,
  '.$q14.' AS voucher_id13,
  '.$q15.' AS metodo_recepcion_caso_id14,
  '.$q16.' AS pais_id15,
  '.$q17.' AS preexistencia_id16,
  '.$q18.' AS idcasoidioma17
FROM
  casos c0_
WHERE
  '.$w1.' IN (
    SELECT
      '.$w2.'
    FROM
      vouchers v1_
    WHERE
      '.$w3.' LIKE "%'.$voucher.'%"
  )
OR '.$w4.' IN (
  SELECT
    '.$w5.'
  FROM
    afiliados a2_
  WHERE
    '.$w6.' LIKE "%'.$voucher.'%"
  OR '.$w7.' LIKE "%'.$voucher.'%"
)
OR '.$q1.' = "'.$voucher.'"
ORDER BY
  '.$q1.' DESC
LIMIT 1 ');




 


  $x1 = 't0.id';
  $x2 = 't0.identificacion_afiliado';
  $x3 = 't0.nombre';
  $x4 = 't0.telefono';
  $x5 = 't0.email';
  $x6 = 't0.fecha_de_nacimiento';
  $x7 = 't0.genero';
  $x8 = 't0.is_active';
  $x9 = 't0.is_deleted';
  $x10 = 't0.is_manually_added';
  $x11 ='t0.nacionalidad';
  $x12 = 't0.observaciones';
  $x13 = 't0.cliente_id';
  $x14 = 'cliente_id13';
  $x15 = 't0.upload_id';
  $x16 = 't0.id';


$queryAfiliado = DB::connection('mysql')->select( 'SELECT '.$x1.' AS id1,'.$x2.' AS identificacion_afiliado2,'.$x3.' AS nombre3,'.$x4.' AS telefono4,'.$x5.' AS email5, '.$x6.' AS fecha_de_nacimiento6, '.$x7.' AS genero7, '.$x8.' AS is_active8, '.$x9.' AS is_deleted9, '.$x10.' AS is_manually_added10, '.$x11.' AS nacionalidad11,'.$x12.' AS observaciones12, '.$x13.' AS '.$x14.', '.$x15.' AS upload_id14 FROM afiliados t0 WHERE '.$x16.' = '.$afiliadoId);


  $nombrePax = $queryAfiliado[0]->nombre3;

  $idPax = $queryAfiliado[0]->identificacion_afiliado2;
  






        //Query para el plan



  $z1 = 't0.id';
  $z2 = 't0.numero';
  $z3 = 't0.fecha_creacion';
  $z4 = 't0.fecha_salida';
  $z5 = 't0.fecha_regreso';
  $z6 = 't0.is_active';
  $z7 = 't0.is_manually_added';
  $z8 = 't0.afiliado_id';
  $z9 = 't0.plan_id';
  $z10 = 't0.cliente_id';
  $z11 = 't0.upload_id';
  $z12 = 't0.id';

  $queryPlan = DB::connection('mysql')->select('SELECT '.$z1.' AS id1, '.$z2.' AS numero2, '.$z3.' AS fecha_creacion3, '.$z4.' AS fecha_salida4, '.$z5.' AS fecha_regreso5, '.$z6.' AS is_active6, '.$z7.' AS is_manually_added7, '.$z8.' AS afiliado_id8, '.$z9.' AS plan_id9, '.$z10.' AS cliente_id10, '.$z11.' AS upload_id11 FROM vouchers t0 WHERE '.$z12.' = '.$queryVoucher[0]->voucher_id13);



  $nombrePlan = DB::connection('mysql')->select('SELECT t0.id AS id1, t0.nombre AS nombre2, t0.id_plan AS id_plan3, t0.observaciones AS observaciones4, t0.is_active AS is_active7, t0.tipo_asistencia_id AS tipo_asistencia_id8, t0.cliente_id AS cliente_id9 FROM planes_de_cobertura t0 WHERE t0.id = '.$queryPlan[0]->plan_id9);

$planNombre = $nombrePlan[0]->nombre2;

//Fin obtencion del plan








    	return view('formRequest', compact('voucher', 'caso', 'service','hash', 'afiliadoId', 'voucherid','subservicioDatos','paises','monedas','planNombre', 'nombrePax', 'idPax','validacionCaso','inputAdicional'));
    }




     public function formProcess (Request $request, $voucher, $caso, $service, $hash, $afiliadoId, $voucherid)
    {

    	
    
      $rules = [
         'nacionalidad' => 'required',
         'pais_residencia' => 'required',
         'pais_ocurrencia' => 'required',
         'monto_gasto' => 'required',
         'moneda' => 'required',
         'direccion' => 'required',
         'fecha_ocurrencia' => 'required',
         'email' => 'required',
         'archivos' => 'mime:pdf,jpg,jpe,png,jpeg,gif|size:12000'
        
    ];

     $this->validate($request, $rules);


    $fechaActual = Carbon::now();
     $nacionalidad = $request->input('nacionalidad');
     $pais_residencia = $request->input('pais_residencia');
      $pais_ocurrencia = $request->input('pais_ocurrencia');
     $monto_gasto = $request->input('monto_gasto');
     $moneda = $request->input('moneda');
     $direccion = $request->input('direccion');
     $fecha_ocurrencia = $request->input('fecha_ocurrencia');
     $email = $request->input('email');
     $observaciones = $request->input('observaciones');
     $archivos = $request->file('adjuntos');
     $pir = $request->input('pir');
     $aerolinea = $request->input('aerolinea');

     


if ($archivos != NULL) {
  foreach ($archivos as $key => $file) {

    $nombre = $file->getClientOriginalName();

    $file->storeAs('public/solicitud/'.$service.'',$nombre);
    
}
}



    

  
    



  $q1 = 'c0_.id';
$q2 = 'c0_.fecha_creacion';
$q3 = 'c0_.fecha_modificacion';
$q4 = 'c0_.preexistencia_solucion';
$q5 = 'c0_.diagnostico_tratamiento';
$q6 = 'c0_.direccion_actual_afiliado';
$q7 = 'c0_.telefono_actual_afiliado';
$q8 = 'c0_.descripcion';
$q9 = 'c0_.estado';
$q10 = 'c0_.ciudad';
$q11 = 'c0_.cliente_corporativo_id';
$q12 = 'c0_.afiliado_id';
$q13 = 'c0_.user_id';
$q14 = 'c0_.voucher_id';
$q15 = 'c0_.metodo_recepcion_caso_id';
$q16 = 'c0_.pais_id';
$q17 = 'c0_.preexistencia_id';
$q18 = 'c0_.idcasoidioma';



$w1 = 'c0_.voucher_id';
$w2 = 'v1_.id';
$w3 = 'v1_.numero';
$w4 = 'c0_.afiliado_id';
$w5 = 'a2_.id';
$w6 = 'a2_.identificacion_afiliado';
$w7 = 'a2_.nombre';

       

       $queryVoucher = DB::connection('mysql')->select('SELECT
  '.$q1.' AS id0,
  '.$q2.' AS fecha_creacion1,
  '.$q3.' AS fecha_modificacion2,
  '.$q4.' AS preexistencia_solucion3,
  '.$q5.' AS diagnostico_tratamiento4,
  '.$q6.' AS direccion_actual_afiliado5,
  '.$q7.' AS telefono_actual_afiliado6,
  '.$q8.' AS descripcion7,
    '.$q9.' AS estado8,
  '.$q10.' AS ciudad9,
  '.$q11.' AS cliente_corporativo_id10,
  '.$q12.' AS afiliado_id11,
  '.$q13.' AS user_id12,
  '.$q14.' AS voucher_id13,
  '.$q15.' AS metodo_recepcion_caso_id14,
  '.$q16.' AS pais_id15,
  '.$q17.' AS preexistencia_id16,
  '.$q18.' AS idcasoidioma17
FROM
  casos c0_
WHERE
  '.$w1.' IN (
    SELECT
      '.$w2.'
    FROM
      vouchers v1_
    WHERE
      '.$w3.' LIKE "%'.$voucher.'%"
  )
OR '.$w4.' IN (
  SELECT
    '.$w5.'
  FROM
    afiliados a2_
  WHERE
    '.$w6.' LIKE "%'.$voucher.'%"
  OR '.$w7.' LIKE "%'.$voucher.'%"
)
OR '.$q1.' = "'.$voucher.'"
ORDER BY
  '.$q1.' DESC
LIMIT 1 ');



       $clienteId = $queryVoucher[0]->cliente_corporativo_id10;



  $x1 = 't0.id';
  $x2 = 't0.identificacion_afiliado';
  $x3 = 't0.nombre';
  $x4 = 't0.telefono';
  $x5 = 't0.email';
  $x6 = 't0.fecha_de_nacimiento';
  $x7 = 't0.genero';
  $x8 = 't0.is_active';
  $x9 = 't0.is_deleted';
  $x10 = 't0.is_manually_added';
  $x11 ='t0.nacionalidad';
  $x12 = 't0.observaciones';
  $x13 = 't0.cliente_id';
  $x14 = 'cliente_id13';
  $x15 = 't0.upload_id';
  $x16 = 't0.id';


$queryAfiliado = DB::connection('mysql')->select( 'SELECT '.$x1.' AS id1,'.$x2.' AS identificacion_afiliado2,'.$x3.' AS nombre3,'.$x4.' AS telefono4,'.$x5.' AS email5, '.$x6.' AS fecha_de_nacimiento6, '.$x7.' AS genero7, '.$x8.' AS is_active8, '.$x9.' AS is_deleted9, '.$x10.' AS is_manually_added10, '.$x11.' AS nacionalidad11,'.$x12.' AS observaciones12, '.$x13.' AS '.$x14.', '.$x15.' AS upload_id14 FROM afiliados t0 WHERE '.$x16.' = '.$afiliadoId);


  $nombrePax = $queryAfiliado[0]->nombre3;

  $identificacionPax = $queryAfiliado[0]->identificacion_afiliado2;


  //Query para el plan



  $z1 = 't0.id';
  $z2 = 't0.numero';
  $z3 = 't0.fecha_creacion';
  $z4 = 't0.fecha_salida';
  $z5 = 't0.fecha_regreso';
  $z6 = 't0.is_active';
  $z7 = 't0.is_manually_added';
  $z8 = 't0.afiliado_id';
  $z9 = 't0.plan_id';
  $z10 = 't0.cliente_id';
  $z11 = 't0.upload_id';
  $z12 = 't0.id';

  $queryPlan = DB::connection('mysql')->select('SELECT '.$z1.' AS id1, '.$z2.' AS numero2, '.$z3.' AS fecha_creacion3, '.$z4.' AS fecha_salida4, '.$z5.' AS fecha_regreso5, '.$z6.' AS is_active6, '.$z7.' AS is_manually_added7, '.$z8.' AS afiliado_id8, '.$z9.' AS plan_id9, '.$z10.' AS cliente_id10, '.$z11.' AS upload_id11 FROM vouchers t0 WHERE '.$z12.' = '.$queryVoucher[0]->voucher_id13);


      $nombrePlan = DB::connection('mysql')->select('SELECT t0.id AS id1, t0.nombre AS nombre2, t0.id_plan AS id_plan3, t0.observaciones AS observaciones4, t0.is_active AS is_active7, t0.tipo_asistencia_id AS tipo_asistencia_id8, t0.cliente_id AS cliente_id9 FROM planes_de_cobertura t0 WHERE t0.id = '.$queryPlan[0]->plan_id9);

      

      $planNombre = $nombrePlan[0]->nombre2;

      $subsercioId = DB::connection('mysql')->table('caso_servicios')

            ->where([
                ['tipo_servicio_id','=',4],
                ['caso_id','=',$caso ],
                ['caso_servicios.id','=',$service],
                ['estado_id','<>',999998],
                ['estado_id','<>',999999],

            ])
            ->join('casos','casos.id','=','caso_servicios.caso_id')
            ->select('subservicio_id')
            ->value('subservicio_id');




     $insertarDatos = DB::connection('mysql2')->table('afiliado_datos')->insert([

      	'voucher' => $voucher,
      	'caso' => $caso,
      	'servicio' => $service,
      	'nombre' => $nombrePax,
        'documento' => $identificacionPax,
      	'email' => $email,
      	'pais_ocurrencia' => $pais_ocurrencia,
      	'nacionalidad' => $nacionalidad,
      	'pais_residencia' => $pais_residencia, 
      	'fecha_ocurrencia' => $fecha_ocurrencia,
      	'observaciones' => $observaciones,
        'fecha_solicitud' =>  $fechaActual,
        'subservicio' => $subsercioId,
        'direccion_evento' => $direccion

      ]);


     $insertarDatosAdm =  DB::connection('mysql2')->table('afiliado_administrativo')->insert([

      	'voucher' => $voucher,
      	'caso' => $caso,
      	'servicio_id' => $service,
      	'plan' => $planNombre,
      	'monto_solicitado' => $monto_gasto,
      	'moneda' => $moneda,
      	'cliente' => $clienteId,
        'estatus_solicitud' => 2,
        'estado' => 0,
        'pir' => $pir,
        'aerolinea' => $aerolinea
      
      ]);




    

    if ($insertarDatos == true &&  $insertarDatosAdm == true) {
    	
    	 $data = new \stdClass();
     
      $data->nombrePax = $nombrePax;
      $data->sender = 'Departamento de Reintegros';
      

      Mail::to($email)->send(new ConfirmationForm($data));



/*
       $data2 = new \stdClass();
     
      $data2->nombrePax = $nombrePax;
      $data2->voucher = $voucher;
      $data2->caso= $caso;
      $data2->service =$service; 
      $data2->sender = 'Departamento de Reintegros';
      

      Mail::to('reembolso@quanticoservicios.com')->send(new newRequest($data2)); */

      return redirect()->route('formSubmited', [$voucher, $caso, $service, $hash, $afiliadoId, $voucherid]);
      
    }else{

      Session::flash('envio_fallido','No se pudo enviar la informacion al departamento de reintegros, por favor intente nuevamente. Si el problema persiste notifiquelo a atencion.cliente@quanticoservicios.com');

       return redirect()->route('formRequest', [$voucher, $caso, $service, $hash, $afiliadoId, $voucherid]);

    }



         
     

    }




       public function formSubmited(Request $request, $voucher, $caso, $service, $hash, $afiliadoId, $voucherid)
       {

       	$email = DB::connection('mysql2')->table('afiliado_datos')
       	->where([

       		['voucher','=', $voucher],
       		['caso'    ,'=',$caso],
       		['servicio','=',$service]


       	])->value('email');




       	return view('infoSent', compact('email', 'voucher', 'caso', 'service', 'hash', 'afiliadoId', 'voucherid'));



       }


   public function requestEstatus(Request $request, $voucher, $caso, $service, $hash, $afiliadoId, $voucherid)
   {


    

         
      
    $listadoRegistros = DB::connection('mysql2')->table('afiliado_datos')
    -> where([
          ['afiliado_datos.servicio', '=', $service],
          ['afiliado_datos.caso', '=', $caso],
          ['afiliado_datos.voucher', '=', $voucher],
          ])
    ->join('afiliado_administrativo','afiliado_administrativo.servicio_id','=','afiliado_datos.servicio')
    ->select('*')
    ->get();

   







    return view('requestEstatus', compact('listadoRegistros','voucher', 'caso', 'service','hash', 'afiliadoId', 'voucherid'));
   }



   public function logout(Request $request, $voucher, $caso, $service, $hash, $afiliadoId, $voucherid){
    
    DB::connection('mysql2')->table('ruta_hash_temporal')->where('voucher', $voucher)->delete();

    return redirect('/')->route('showUsersForm');


    
   }






}
