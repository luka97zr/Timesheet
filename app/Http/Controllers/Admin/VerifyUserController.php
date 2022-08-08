<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerifyUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerifyUserController extends Controller
{
    public function index(Request $request) {
       $inactiveUser = VerifyUser::checkToken($request);

        return $inactiveUser->first()->user;
    }

    public function store(Request $request) {
        VerifyUser::checkToken($request);

        User::findOrFail($request->get('uuid'))->update([
            'password'          => $request->get('password'),
            'is_verified'       => true,
            'email_verified_at' => Carbon::now()
        ]);
    }
}
