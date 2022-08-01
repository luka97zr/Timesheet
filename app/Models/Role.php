<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public const IS_ADMIN = 1;
    public const IS_USER = 2;

    public static function get_role_name($role_id) {
        return Role::findOrFail($role_id)->name;
    }
}
