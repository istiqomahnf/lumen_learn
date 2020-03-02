<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class RoleMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        //after middleware
        $response = $next($request);
        $user_role =  $request->session()->get('role_user');
        if ($user_role == "admin") {
            return $response;
        }else{
            return redirect('/home');    
        }
        
    }
}
