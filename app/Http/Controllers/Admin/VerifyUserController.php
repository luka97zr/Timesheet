<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerifyUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VerifyUserController extends Controller
{
    public function __invoke(Request $request) {
         $token = VerifyUser::where('user_id',$request->get('uuid'))->with('user')->get();
         if (!Hash::check($token->first()->token.env('VERIFY_SECRET'),$request->get('token')) || $token->first()->expiery_date > Carbon::now()->toDateTimeString() ) return response()->json(['error' => 'Token is invalid, try again']);

         return $token->first()->user;
    }
}
