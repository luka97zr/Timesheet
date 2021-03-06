<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function userProject() {
        return $this->hasMany(UserProject::class);
    }

    public function category() {
        return $this->hasMany(Category::class);
    }
}
