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
use App\User;
use Session;
use Auth;

class UsersController extends Controller
{
    //

    public function __construct()
   {
       $this->middleware('auth');
   }


    public function index(Request $request)
    {
    	$usuarios = DB::connection('mysql2')->table('users')->get();

       return view('dashboard.usuarios' ,compact('usuarios'));
    }

    public function newUser(Request $request)
    {
    	return view('auth.register');
    }

    public function edit(Request $request)
    {

      $usuario = $request->input('edit_id');

      DB::connection('mysql2')
      ->table('users')
      ->where('id',$usuario)
      ->update([
          'email' => $request->input('email'),
          'name' => $request->input('name')
      ]);   


      Session::flash('usuario_editado', 'Se han actualizado exitosamente los datos del usuario');

      return redirect()->route('usuarios');

     
    }
}
