<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProjectResource;
use App\Models\Project;
use App\Models\UserProject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserProjectController extends Controller
{
    public function index()
    {
        return Project::whereHas('userProject', function (Builder $query) {
            $query->where('user_id', '=', auth()->user()->id);
          })->with(['client','categoryProject.category'])->get();
    }

    public function show(Request $request) {
        $userId = $request->validate([
            'user_id' => 'exists:users,id'
        ]);
        return UserProjectResource::collection(
            UserProject::where('user_id', $userId)->with('project')->get()
        );
    }

    public function store(Request $request) {

        collect($request->get('projects'))->each(function($project) {
            UserProject::updateOrCreate([
                'user_id' => $project['user_id'],
                'project_id' => $project['project_id'],
            ]);
        });
        return 'success';
    }
}
