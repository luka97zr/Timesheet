<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProject;
use App\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryProjectController extends Controller
{
    public function __invoke()
    {
        $q = CategoryProject::whereHas('project', function(Builder $query) {
            $query->where('client_id', request('client_id'));
        });

        if(request('category_id')) {
            $q->where('category_id', '=', request('category_id'));
        }

        return $q->get();

    }
}
