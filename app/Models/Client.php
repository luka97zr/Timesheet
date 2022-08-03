<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function setNameAttribute($value) {
        return $this->attributes['name'] = ucfirst($value);
    }
}
