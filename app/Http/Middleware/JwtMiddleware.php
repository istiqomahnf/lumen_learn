<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Contracts\Auth\Factory as Auth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */

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
        $response = $next($request);
        try{
            $user = JWTAuth::parseToken()->authenticate();
        }catch(Exception $e){
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                try{
                    $refresh = JWTAuth::refresh(JWTAuth::getToken());
                    $request->session()->forget('api_token');
                    $request->session()->put('api_token', $refresh);
                }catch(JWTException $e){
                    return response()->json(['status' => 'Token is Expired']);
                }
            }else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid']);
            }else{
                return redirect('/');
                // return response()->json(['status' => 'Authorization Token Not Found']);
            }
        }
        return $response;
    }
}
