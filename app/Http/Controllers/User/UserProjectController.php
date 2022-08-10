<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;

class UserProjectController extends Controller
{
    public function index()
    {
        return Project::whereHas('userProject', function (Builder $query) {
            $query->where('user_id', '=', auth()->user()->id);
          })->with(['client','categoryProject.category'])->get();
    }
}
