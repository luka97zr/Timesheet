<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Project;
use App\Traits\ShowAllTrait;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use ShowAllTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = ProjectResource::collection(
            Project::with('client')->orderBy('name')->get()
        );
        return $this->getResults($projects);

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
    public function show(Request $request, $term)
    {
        return ProjectResource::collection(
            Project::where('name','LIKE','%'.$term.'%')->with('client')->get()
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $project_id)
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
    }
}
