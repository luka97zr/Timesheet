<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function categoryProject() {
        return $this->belongsTo(CategoryProject::class);
    }

    public function scopeReport($query) {
       return $query->when(request('startDate'), fn($query)=>
            $query->where('date', '>=', request('startDate'))
        )
        ->when(request('endDate'), fn($query)=>
            $query->where('date', '<=', request('endDate'))
        )
        ->when(request('user_id'), fn($query)=>
            $query->where('user_id', request('user_id'))
        )
        ->when(request('category_project'), fn($query)=>
            $query->whereIn('category_project_id', request('category_project'))->with(['categoryProject.project', 'categoryProject.category'])
        )
        ->get();
    }
}
