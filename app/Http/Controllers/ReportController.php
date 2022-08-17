<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\UserProjectResource;
use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use App\Models\UserProject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class ReportController extends Controller
{
    public function index() {
        if(auth()->user()->role_id === Role::IS_ADMIN) {
            return Cache::remember('employees', 60*10, function() {
                return EmployeeResource::collection(
                    User::get()
                );
            });
        } else {
            return auth()->user();
        }
    }

    public function userClients(User $user) {
        return  UserProjectResource::collection(
            UserProject::where('user_id', $user->id)->with('project.client')->get()
        );
    }

    public function projectCategory(Project $project) {
        return CategoryResource::collection(
            Category::whereHas('categoryProject', function(Builder $query) use ($project) {
                $query->where('project_id',$project->id);
            })->get()
        );
    }
}
