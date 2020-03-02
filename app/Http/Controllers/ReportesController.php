<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Middleware\Authenticate;
use Response;
use Illuminate\Support\Facades\Storage;                                            
use Illuminate\Support\Facades\Mail;                                           
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\MessageBag;                                            
use Illuminate\Http\UploadedFile; 
use App\Mail\envioAdministrativo;
use App\Mail\CambioEstado;        
use Illuminate\Http\Request;
use \GuzzleHttp\Client; 
use App\Afiliado_datos;
use Illuminate\Http\File;     
use Carbon\Carbon;
use Session;
use Auth;

class ReportesController extends Controller
{
    //
    public function index() {
       $solicitud = DB::connection('mysql2')->table('afiliado_datos')
        ->count();

        $aprobado = DB::connection('mysql2')->table('afiliado_administrativo')
        ->where('estatus_solicitud',4)
        ->count();

       $negados =  DB::connection('mysql2')->table('afiliado_administrativo')
       ->where('estatus_solicitud',5)
       ->count();

       $otros = DB::connection('mysql2')->table('afiliado_administrativo')
       ->where([
           ['estatus_solicitud','<>',4],
           ['estatus_solicitud','<>',5]
           ])
       ->count();

       $cliente =  DB::connection('mysql')->table('clientes_corporativos')
       ->orderBy('nombre_comercial', 'ASC')
       ->get();

       $subservicio = DB::connection('mysql2')->table('operaciones_subservicio')
       ->where('is_deleted','<>',1)
    ->select('id','nombre')
    ->get();

    $data = DB::connection('mysql2')->table('afiliado_datos')
     ->join('crm.operaciones_subservicio AS operaciones_subservicio','operaciones_subservicio.id','=','afiliado_datos.subservicio')
     ->select('operaciones_subservicio.nombre AS name',DB::raw('COUNT(operaciones_subservicio.nombre) AS y'))
     ->groupBy('operaciones_subservicio.nombre')
    ->orderBy('y','DESC')
     ->get();

     $dataTwo = DB::connection('mysql2')->table('afiliado_administrativo')
     ->join('crm.operaciones_subservicio AS operaciones_subservicio','operaciones_subservicio.id','=','afiliado_administrativo.subservicio')
     ->select('operaciones_subservicio.nombre AS name',DB::raw('SUM(afiliado_administrativo.monto_aprobado) AS y'))
     ->groupBy('operaciones_subservicio.nombre')
    ->orderBy('y','DESC')
     ->get();

 



    






  /*   $dataSum = DB::connection('mysql2')->table('afiliado_administrativo')
     ->join('afiliado_datos','afiliado_datos.servicio','=','afiliado_administrativo.servicio_id')
     ->join('crm.operaciones_subservicio AS operaciones_subservicio','operaciones_subservicio.id','=','afiliado_datos.subservicio')
     ->select('operaciones_subservicio.nombre AS name',DB::raw('SUM(afiliado_administrativo.solicitado_usd) AS y'))
     ->groupBy('operaciones_subservicio.nombre')
    ->orderBy('y','DESC')
    ->limit(12)
     ->get();   */

     $dataClients = DB::connection('mysql2')->table('afiliado_administrativo')
     ->join('crm.clientes_corporativos AS clientes','clientes.id','=','afiliado_administrativo.cliente')
     ->select('clientes.nombre_comercial AS name',DB::raw('COUNT(clientes.nombre_comercial) AS y'))
     ->groupBy('name')
    ->orderBy('y','DESC')
     ->get();

     

   



    
    
        return view('reportes.indexReportes', compact('solicitud', 'aprobado', 'negados', 'otros', 'subservicio', 'cliente', 'data', 'dataClients', 'dataTwo'));
    }


    public function ajaxData (Request $request) {
        return response::json($request->all());
    }


 /*   public function insertData() {

        $customers = DB::connection('mysql2')
        ->table('afiliado_administrativo')
        ->select('id','monto_solicitado', 'moneda')
        ->get()
        ->toArray();
        
 
     // dd($customers);



        foreach($customers as $k => $v) {            
           
           
            $bid =  DB::connection('mysql2')
            ->table('currency')
            ->where('CurrencyISO',  $v->moneda)
            ->value('convertion');
           
            
            DB::connection('mysql2')
            ->table('afiliado_administrativo')
            ->where('id', $v->id)
            ->update([
                'solicitado_usd' => $v->monto_solicitado / $bid
            ]); 
         
        }

        dd($try);

       /* $monedas = DB::connection('mysql2')
        ->table('currency')
        ->get();


        $client = new \GuzzleHttp\Client(['base_uri' => 'https://www1.oanda.com/rates/api/v2/rates/spot.json?api_key=g7J4OrSisR0m6G1BtN8Wqhea&base=USD&quote=']);

        foreach($monedas as $v) {

            $client = new \GuzzleHttp\Client();
            
            $response = $client->request('get','https://www1.oanda.com/rates/api/v2/rates/spot.json?api_key=g7J4OrSisR0m6G1BtN8Wqhea&base=USD&quote='.$v->CurrencyISO);

            $formatResponse = json_decode($response->getBody()->getContents());

            $try = $formatResponse->quotes[0];

            DB::connection('mysql2')->table('currency')
            ->where('CurrencyISO', $v->CurrencyISO)
            ->update([
                'convertion' =>  $try->bid
            ]);}  */




        

    
}
