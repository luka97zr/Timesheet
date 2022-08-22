<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class VerifyUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'expiry_date',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'expiry_date'   => 'datetime'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function generateToken($userId) {
        $token = bin2hex(random_bytes(32));
            VerifyUser::create([
                'user_id'   => $userId,
                'token'     => $token,
                'expiry_date'=> Carbon::now()->addHour(1)
            ]);
        return $token;
    }

    public static function checkToken($request) {
            $inactiveUser = VerifyUser::where('user_id',$request->get('uuid'))->with('user')->latest()->get();
            if (!Hash::check($inactiveUser->first()?->token.env('VERIFY_SECRET'),$request->get('token')) || $inactiveUser?->first()->expiry_date < Carbon::now() )
                throw new Exception('Token is invalid or expired, try again');

            return $inactiveUser;
    }
}
