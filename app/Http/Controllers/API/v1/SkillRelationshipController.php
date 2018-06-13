<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\ProjectsResource;
use App\Http\Resources\UsersResource;
use App\Skill;
use App\Traits\EloquentBuilderTrait;
use Optimus\Bruno\LaravelController;

class SkillRelationshipController extends LaravelController
{
    use EloquentBuilderTrait;

    public function Projects(Skill $skill)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($skill->Projects, $resourceOptions, 'projects');

        return new ProjectsResource($parsedData['projects']);
    }

    public function Users(Skill $skill)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($skill->Users, $resourceOptions, 'users');

        return new UsersResource($parsedData['users']);
    }

}
