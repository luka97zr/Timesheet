<?php

namespace App\Repository;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProjectRepository {

    public function index()
    {
        return ProjectResource::collection(
            Project::with('client')->orderBy('created_at', 'DESC')->paginate(3)
        );
    }

    public function alphabet()
    {
        return Cache::remember('project-alphabet', 60*10, function() {
            $letters = DB::table('projects')
                ->selectRaw("SUBSTRING(name, 1,1) AS letter")
                ->groupBy("letter")->get();

            return collect($letters)->map(function($letter) {
                return $letter->letter;
            });
        });
    }

    public function all()
    {
        return Cache::remember('projects', 60*10, function() {
            return ProjectResource::collection(
                Project::where('status', 1)->get()
           );
        });
    }

    public function store($request)
    {
        Project::create($request->all());
        return response()->json(['success'=> true]);
    }

    public function show($letter)
    {
        return ProjectResource::collection(
            Project::where('name','LIKE', $letter.'%')->with('client')->paginate(3)
        );
    }

    public function update($request, $projectId)
    {
        Project::findOrFail($projectId)->update($request->all());
    }

    public function destroy($projectId)
    {
        Project::destroy($projectId);
    }
}