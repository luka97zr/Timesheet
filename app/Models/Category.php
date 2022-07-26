<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function categoryProject() {
        return $this->hasMany(CategoryProject::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function setNameAttribute($value) {
        return $this->attributes['name'] = ucfirst($value);
    }
}
