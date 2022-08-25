<?php

namespace App\Http\Controllers;

use App\Models\CategoryProject;
use Illuminate\Database\Eloquent\Builder;

class CategoryProjectController extends Controller
{
    public function index()
    {
        $q = CategoryProject::whereHas('project', function(Builder $query) {
                $query->where('client_id', request('client_id'));
            });

        if(request('project_id')) {
            $q->where('project_id', request('project_id'));
        }
        if(request('category_id')) {
            $q->where('category_id', request('category_id'));
        }

        return $q->get('id');
    }
}
