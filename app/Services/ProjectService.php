<?php

namespace App\Services;

use App\Http\Requests\CreateProjectFormRequest;
use App\Repositories\ProjectRepository;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;

class ProjectService {

    private $auth;

    private $dispatcher;

    private $projectRepository;

    public function __construct(Dispatcher $dispatcher, ProjectRepository $projectRepository) {
        $this->dispatcher = $dispatcher;
        $this->projectRepository = $projectRepository;
    }

    public function create(CreateProjectFormRequest $request)
    {
        $user = Auth::user();
        // Check if the user has permission to create other users.
        // Will throw an exception if not.
        $user->hasPermissionTo('create project');
        $data = $request->all();
        // Set the account ID on the user and create the record in the database
        $data['user_id'] = $user->id;
        $project = $this->projectRepository->create($data);

        return $project;
    }
}