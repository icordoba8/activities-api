<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use Laravel\Sanctum\Sanctum;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validateLogin($request);
  
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $token = $request->user()->createToken($request->email);
                return response()->json([
                    'token'=>$token->plainTextToken,
                    'user_id'=>$request->user()->id,
                    'message' => 'Authenticated'
                ]);
            }
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
       
        
    }

    public function logout(Request $request)
    {
        $response = ['status'=>0];
        if ($token = $request->bearerToken()) {
            $model = Sanctum::$personalAccessTokenModel;
            $accessToken = $model::findToken($token);
            $accessToken->delete();
            $response['message'] = 'successful logout';
            $response['status']  = 1;
        }
        return response()->json($response, 401);
    }


    public function validateLogin(Request $request)
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    }


}
