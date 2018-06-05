<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\CreateProjectFormRequest;
use App\Http\Requests\EditProjectFormRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectsResource;
use App\Project;
use App\Services\ProjectService;
use Illuminate\Support\Facades\Auth;
use App\Traits\EloquentBuilderTrait;
use Optimus\Bruno\LaravelController;

class ProjectController extends LaravelController
{
    use EloquentBuilderTrait;

    private $projectService;

    public function __construct(ProjectService $projectService) {
        $this->projectService = $projectService;
    }
    /**
     * Display a listing of projects.
     *
     * @return ProjectsResource
     */
    public function index()
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->projectService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'projects');

        // Create JSON response of parsed data
        return new ProjectsResource($parsedData['projects']);
    }

    /**
     * Store a newly created project in storage.
     *
     * @param  CreateProjectFormRequest  $request
     * @return ProjectResource
     */
    public function store(CreateProjectFormRequest $request)
    {
        $project = $this->projectService->create($request);

        if($project) {
            return new ProjectResource($project);
        }else{
            return response("Unauthorized action",403);
        }

    }

    /**
     * Display the specified project.
     *
     * @param  Project $project
     * @return ProjectResource
     */
    public function show(Project $project)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->projectService->getById($project->id, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'project');

        // Create JSON response of parsed data
        return new ProjectResource($parsedData['project']);
    }

    /**
     * Update the specified project in storage.
     *
     * @param  EditProjectFormRequest  $request
     * @param  Project $project
     * @return ProjectResource
     */
    public function update(EditProjectFormRequest $request, Project $project)
    {
        $project = $this->projectService->update($request, $project);

        if($project) {
            return new ProjectResource($project);
        }else{
            return response("Unauthorized action",403);
        }
    }

    /**
     * Remove the specified project from storage.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if(Auth::user()->can('delete project')) {
            $project->delete();
            return response("success", 200);
        }else{
            return response("Unauthorized action",403);
        }
    }

}
