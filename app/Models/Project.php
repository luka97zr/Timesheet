<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const INACTIVE = 0;
    public const ACTIVE = 1;

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function userProject() {
        return $this->hasMany(UserProject::class);
    }

    public function categoryProject() {
        return $this->hasMany(CategoryProject::class);
    }

    public function lead() {
        return $this->hasOne(Lead::class);
    }

    public function setNameAttribute($value) {
        return $this->attributes['name'] = ucfirst($value);
    }
}
