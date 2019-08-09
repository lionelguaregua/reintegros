<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Storage;                                            
use Illuminate\Support\Facades\Mail;                                           
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\MessageBag;                                            
use Illuminate\Http\UploadedFile; 
use Illuminate\Http\Request; 
use Illuminate\Http\File; 
use Carbon\Carbon;
use App\Crmquery;
use App\HashTemporal;
use Session;


class UsuariosController extends Controller
{



    //
    public function showUsersForm()
    {
       
    	return view('loginUsers');

    }


    public function validateData(Request $request)
    {


    	$voucher = $request->input('voucher');
        $caso = $request->input('caso');
        $servicio = $request->input('servicio');


        $randomHash= $voucher.str_random(25).$servicio.$caso;

       

       //verificacion del voucher


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

      
 
 $voucherId = $queryVoucher[0]->voucher_id13;









        //Fin query voucher
     

 
        $verificacionCaso = DB::connection('mysql')->table('caso_servicios')

            ->where([
                ['tipo_servicio_id','=',4],
                ['caso_id','=',$caso ],
                ['caso_servicios.id','=',$servicio],
                ['estado_id','<>',999998],
                ['estado_id','<>',999999],

            ])
            ->join('casos','casos.id','=','caso_servicios.caso_id')
            ->select('*')
            ->count();



            $afiliadoId =DB::connection('mysql')->table('caso_servicios')

            ->where([
                ['tipo_servicio_id','=',4],
                ['caso_id','=',$caso ],
                ['caso_servicios.id','=',$servicio],
                ['estado_id','<>',999998],
                ['estado_id','<>',999999],

            ])
            ->join('casos','casos.id','=','caso_servicios.caso_id')
            ->select('afiliado_id')
            ->value('afiliado_id');





            if ($verificacionCaso == 0 || $verificacionCaso == NULL || $queryVoucher == NULL) {
            	 

            	 Session::flash('login_failed','Lo sentimos, alguno de los datos ingresados no es valido, por favor verifiquelos e intente nuevamente. Validation Controller');

            	 return redirect('/');


            }else{

            	DB::connection('mysql2')->table('ruta_hash_temporal')
                ->insert([
                  
                  'voucher' => $voucher,
                  'hash' => $randomHash   

                 ]);
      


               return redirect()->route('validated',[$voucher,$caso,$servicio,$randomHash,$afiliadoId,$voucherId]);

            }













    }




    
}
