<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate;
use Closure;
use App\User;
use Session;
use Auth;

class IsActiveUser
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

       if (auth()->user()->status === 0) {
        Session::flash('usuario_inactivo', 'Su usuario se encuentra inactivo. Entre en contácto con el departamento de reintegros si considera que esto es un error');
           return redirect()->route('login');
       }


        return $next($request);
    }
}
