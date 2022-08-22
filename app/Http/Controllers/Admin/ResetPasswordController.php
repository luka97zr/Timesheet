<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatePassword;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $email = $request->validate([
            'email' => ['email', 'required', 'exists:users,email']
        ],[
            'email.required' => 'Email is required',
            'email.email' => 'Email needs to be a valid email',
            'email.exists' => 'Email doesn\'t exist in the database',
        ]);
        $user = User::where('email', $email)->first();
        $token = VerifyUser::generateToken($user->id);
        event(new UpdatePassword($user, $token));

        return response()->json(['success'=> true]);
    }
}
