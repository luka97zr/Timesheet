<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatePassword;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function store(Request $request) {

        $user = User::findOrFail($request->get('user_id'));
        $token = VerifyUser::generateToken($user->id);
        event(new UpdatePassword($user, $token));
    }
}
