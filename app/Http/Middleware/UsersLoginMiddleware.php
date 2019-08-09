<?php

namespace App\Http\Middleware;

                                        
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request; 
use App\Crmquery;
use App\HashTemporal;
use Session;
use Closure;


class UsersLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {



        $voucher = $request->route('voucher');
        $caso = $request->route('case');
        $servicio = $request->route('service');
        $validacionHash = $request->route('hash');

        $queryHash = HashTemporal::where('hash',$validacionHash)->count();

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

        if ($queryHash == 0 || $verificacionCaso == 0 || $voucher == NULL || $caso == NULL || $servicio == NULL || $queryVoucher == NULL) {



             Session::flash('login_failed','Lo sentimos, alguno de los datos ingresados no es valido, por favor verifiquelos e intente nuevamente. Middleware');
                
                return redirect('/');
        }


           

                
                return $next($request);


        
    }
}
