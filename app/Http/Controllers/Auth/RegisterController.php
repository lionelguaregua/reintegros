<?php

namespace App\Http\Controllers\Auth;


use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\User;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Session;
use Mail;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    public function __construct()
   {
       $this->middleware('auth');
   }

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/inicio/usuarios';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

  
  

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {

         $validData = $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
             'name' => ['required', 'string', 'max:255'],
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required'
        ]);
          
      
              
        $user = User::create([
            'email' => $validData['email'],
            'name' => $validData['name'],
            'password' => Hash::make($validData['password']),
            'status' => $validData['status'],
        ]);


        Session::flash('registrado', 'Usuario ha sido registrado de forma exitosa. El usuario debe verificar su dirección de Email para acceder al dashboard de reintegros ');

      return redirect('/inicio/usuarios');


        
    }
}
