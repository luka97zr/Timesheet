<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthController extends Controller
{
    public $token = true;

    public function login(Request $request) {
        $jwt_token = null;
        $data = $request->validate([
            'email'     => ['required','email'],
            'password'  => 'required'
        ]);

        if (!$jwt_token = JWTAuth::attempt($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ],Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);

    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
  
        try {
            JWTAuth::invalidate($request->token);
  
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
  
    public function getUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
  
        $user = JWTAuth::authenticate($request->token);
  
        return response()->json(['user' => $user]);
    }
}
