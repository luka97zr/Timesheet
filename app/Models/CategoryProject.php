<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProject extends Model
{
    use HasFactory;
    protected $table = 'categories_projects';


    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function log() {
        return $this->belongsTo(Log::class);
    }
}
