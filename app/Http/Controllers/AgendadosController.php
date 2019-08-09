<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Storage;                                            
use Illuminate\Support\Facades\Mail;                                           
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\MessageBag;                                            
use Illuminate\Http\UploadedFile;                                            
use Illuminate\Http\Request;                                    
use Illuminate\Http\File;                                            
use Carbon\Carbon;
use App\Evento;
use Session;
use Auth;


class AgendadosController extends Controller
{
    //

    public function __construct()
   {
       $this->middleware('auth');
   }





   public function agendadosIndex(){
    

   }




    public function scheduleCase(Request $request)
    { 

      $caso    = $request->input('caso_id');
      $agendar = $request->input('agendar');
      $fechaactual = Carbon::now();

      $estado = DB::connection('mysql2')
      ->table('afiliado_administrativo')
      ->where('servicio_id',$caso)
      ->value('estado');

      
      $validacion = false;


      if ($estado == 2 || $estado == 3) {
      	$validacion = true;
      }
    

  
      if ($agendar < $fechaactual->toDateString() || $validacion == true) {

        Session::flash('no_agendado', 'No es posible agendar este caso. Usted selecciono una fecha anterior a la actual ó el caso ya se encuentra cerrado');
        return redirect()->route('inicio');


      }else{


       DB::connection('mysql2')
      ->table('afiliado_administrativo')
      ->where('servicio_id',$caso)
      ->update([

      	'agendado' => $agendar

      ]);

        DB::table('evento')->insert([

      	'id_mod' => $caso,

      	'mensaje' => 'Se ha agendado el caso para la fecha: '.$agendar,

        'tipo_modificacion' => 'El caso ha sido agendado',

        'usuario' => auth()->user()->name

      ]);


        Session::flash('agendado', 'Se ha agendado el caso correctamente. Debe ser revisado nuevamente: '.$agendar);
       

       return redirect()->route('inicio');

      }

  

    }


    public function searchAgendados(Request $request)
    { 

    	$busqueda = $request->input('agendar-search');


    	$query = Reintegros::where('agendado',$busqueda)->get();

    	

    	return view('agendados', compact('query','busqueda'));
    	
    	
    }



    public function desagendar(Request $request)
    {
      $idCaso = $request->input('agendado_id');

      DB::connection('mysql2')
      ->table('afiliado_administrativo')
      ->where('servicio_id', $idCaso)
      ->update([

        'agendado' => NULL

      ]);

      Session::flash('caso_desagendado','Se ha removido el caso '.$idCaso.' de la agenda exitosamente');

      return redirect()->route('inicio');


    }

}
