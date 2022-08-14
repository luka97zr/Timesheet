<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Traits\ShowAllTrait;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProjectResource::collection(
            Project::with('client')->orderBy('created_at', 'DESC')->paginate(3)
        );

    }

    public function getAlphabet() {
        $letters = DB::table('projects')
                ->selectRaw("SUBSTRING(name, 1,1) AS letter")
                ->groupBy("letter")->get();

        return collect($letters)->map(function($letter) {
            return $letter->letter;
        });
    }

    public function allProjects() {
       return ProjectResource::collection(
            Project::where('status', 1)->get()
       );
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        Project::create($request->all());
        return response()->json(['success'=> true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($letter)
    {
        return ProjectResource::collection(
            Project::where('name','LIKE', $letter.'%')->with('client')->paginate(3)
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectUpdateRequest $request, $project_id)
    {
        Project::findOrFail($project_id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id)
    {
        Project::destroy($project_id);
        Project::findOrFail($project_id)->is_deleted = 1;
    }
}
