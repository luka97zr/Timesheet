<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use App\Repository\Interface\ProjectRepositoryInterface;
use App\Repository\ProjectRepository;

class ProjectController extends Controller
{
    private $repository;

    public function __construct(ProjectRepositoryInterface $repository) {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
       return $this->repository->index();
    }

    public function getAlphabet() {
       return $this->repository->alphabet();
    }

    public function allProjects() {
        return $this->repository->all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request) {
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($letter) {
        return $this->repository->show($letter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectUpdateRequest $request, $projectId) {
        return $this->repository->update($request, $projectId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project) {
        return $this->repository->destroy($project->id);
    }
}
