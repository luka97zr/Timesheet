<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    public $table = "calendar";

    public function clients() {
        return $this->hasMany(Clients::class);
    }

    public function projects() {
        return $this->hasMany(Projects::class);
    }

}
