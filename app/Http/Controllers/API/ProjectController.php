<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CreateProjectFormRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectsResource;
use App\Project;
use App\Services\ProjectService;
use App\Skill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    private $projectService;

    public function __construct(ProjectService $projectService) {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ProjectsResource
     */
    public function index()
    {
        return new ProjectsResource(Project::with(['Owner','Category','Skills'])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProjectFormRequest  $request
     * @return ProjectResource
     */
    public function store(CreateProjectFormRequest $request)
    {
        $project = $this->projectService->create($request);

        ProjectResource::withoutWrapping();
        return new ProjectResource($project);

    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Resource
     */
    public function show(Project $project)
    {
        ProjectResource::withoutWrapping();
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
