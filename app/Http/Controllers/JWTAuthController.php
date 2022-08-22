<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;


class JWTAuthController extends Controller
{
    public $token = true;

    public function login(Request $request)
    {
        $jwt_token = null;
        $data = $request->validate([
            'email'     => ['required','email'],
            'password'  => 'required'
        ]);

        if (!$jwt_token = auth()->attempt($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ],Response::HTTP_UNAUTHORIZED);
        }
        $payload = [
            'name'  => auth()->user()->name,
            'role'    => Role::get_role_name(auth()->user()->role_id),
            'email'  => auth()->user()->email,
            'id'     => auth()->user()->id
        ];
        return response()->json([
            'success' => true,
            'user'    => $payload
        ])->withCookie('token', $jwt_token, config('jwt.ttl'), "/", null, false, true);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        if ($request->hasCookie('token')) {
            Cookie::queue(Cookie::forget('token'));
            $request->headers->remove('Authorization');
        }
        return response()->json(['message' => 'Successfully logged out'])->withCookie('token');
    }

    public function getUser(Request $request)
    {
        return response()->json(['user' => auth()->user()]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user'       => auth()->user()
        ]);
    }

}
