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
use Session;
use Auth;

class VistasFormularioController extends Controller
{
    //

     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
    	$crmSubservicios = DB::connection('mysql')
    	->table('operaciones_subservicio')
    	->get();



    	return view('dashboard.modificacionVistas', compact('crmSubservicios'));
    }


    public function editarInfo(Request $request,$id){
         
            
           $nombreCobertura = DB::connection('mysql')->table('operaciones_subservicio')
            ->where('id',$id)
            ->value('nombre');

           $infoAlmacenadaCobertura = DB::connection('mysql')->table('operaciones_subservicio')
            ->where('id',$id)
            ->value('cobertura');

            if ($infoAlmacenadaCobertura == NULL) {
               
               $infoAlmacenadaCobertura = '';

            }


             $infoAlmacenadaDocumentacion = DB::connection('mysql')->table('operaciones_subservicio')
            ->where('id',$id)
            ->value('documentacion');

            if ($infoAlmacenadaDocumentacion == NULL) {
               
               $infoAlmacenadaDocumentacion = '';

            }


    	return view('dashboard.editarVistas',compact('id','nombreCobertura','infoAlmacenadaCobertura','infoAlmacenadaDocumentacion'));
    }



    public function editarInfoCobertura(Request $request, $id)
    {
    	
    	$rules = [
         'cobertura' => 'required'
    ];

     $this->validate($request, $rules);

    	DB::connection('mysql')->table('operaciones_subservicio')
            ->where('id',$id)
            ->update([
               'cobertura' => $request->input('cobertura')
            ]);

        Session::flash('info_cobertura', 'La información de la cobertura fue actualizada exitosamente');


            return redirect()->route('info');


    }


     public function editarInfoDocumentos(Request $request, $id)
    {
    	$rules = [
         'documentos' => 'required'
    ];

     $this->validate($request, $rules);

    	DB::connection('mysql')->table('operaciones_subservicio')
            ->where('id',$id)
            ->update([
               'documentacion' => $request->input('documentos')
            ]);

        Session::flash('info_documentos', 'La información de la documentación fue actualizada exitosamente');


            return redirect()->route('info');


    }


}
