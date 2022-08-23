<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProject extends Model
{
    use HasFactory;
    protected $table = 'categories_projects';
    protected $hidden = ['project_id', 'category_id'];


    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function log() {
        return $this->hasMany(Log::class);
    }
}
