<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Category;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Validator;

class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed',
        ]);

        try {
           
            $user           = new User;
            $user->name     = $request->input('name');
            $user->email    = $request->input('email');
            $plainPassword  = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }


    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'email'     => 'required|string',
            'password'  => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);
        try{
            if (! $token = JWTAuth::attempt($credentials)) {
                // return response()->json(['message' => 'Unauthorized'], 401);
                return view('index',['message'=>'Email and Password doesnt match']);
            }
        }catch(Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            return response()->json(['token_invalid'], $e->getStatusCode());
        }catch(Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
            return response()->json(['token_expired'], $e->getStatusCode());
        }catch (Tymon\JWTAuth\Exceptions\JWTException $e){
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        $user = User::where('email', $request->email)->first();
        $request->session()->put('api_token', $token);
        $request->session()->put('user_id', $user->id);
        $request->session()->put('role_user', $user->role);
        $this->respondWithToken($token);
        return redirect('/client/all');
    }

    public function logout(Request $request)
    {   
        $request->session()->flush();
        $token = $request->header('Authorization');
        try{
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'status'    => "Success",
                'message'   => "Successfully Logged out"
            ]);
        }catch(JWTException $e){
            return response()->json([
                'status'    => "error",
                'message'   => "Failed to log out"
            ], 500);
        }
    }

    public function signUp(Request $request){
        $validator = Validator::make($request->all(),[
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed',
            'role'      => 'required',
        ]); 

        if ($validator->passes()) {
            $user   = new User;
            $user->name     = $request->input('name');
            $user->email    = $request->input('email');
            $user->role     = $request->input('role');
            $user->password = app('hash')->make($request->input('password'));
            $user->save();

            return response()->json(['status'=>true, 'message'=>'Sign Up Successful'], 200);
        }else{
            return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
        }
    }

    public function storeTask(Request $request){
        dd($request);
    }

    public function refreshToken(Request $request){
        $token      = $request->header('Authorization');
        $newtoken   = JWTAuth::refresh($token);
        $request->session()->put('api_token', $newtoken);
        // Session::get('api_token', $newtoken);
        return response()->json(['refresh_token' => $newtoken, 'old_token' => $token], 201);
    }
    
}
