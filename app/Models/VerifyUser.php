<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function generateToken($userId) {
        $token = bin2hex(random_bytes(32));
            VerifyUser::create([
                'user_id'   => $userId,
                'token'     => $token
            ]);
        return $token;
    }

    public function setExpiryDateAttribute($value) {
        $this->attributes['expiry_date'] = $value->addMinutes(40);
    }
}
