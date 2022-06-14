<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function clients() {
        return $this->belongsTo(Calendar::class);
    }

    public function userProject() {
        return $this->hasMany(UserProject::class);
    }
}
