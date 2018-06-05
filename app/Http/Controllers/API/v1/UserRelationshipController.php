<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\CommentsResource;
use App\Http\Resources\FollowersResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectsResource;
use App\Http\Resources\SkillsResource;
use App\Traits\EloquentBuilderTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Optimus\Bruno\LaravelController;

class UserRelationshipController extends LaravelController
{
    use EloquentBuilderTrait;

    public function Badges(User $user = null)
    {
        if (!isset($user)) {
            $user = Auth::user();
        }
    }

    public function Comments(User $user = null)
    {
        if(!isset($user)){
            $user = Auth::user();
        }
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($user->comments, $resourceOptions, 'comments');

        return new CommentsResource($parsedData['comments']);
    }

    public function Followings(User $user = null)
    {
        if(!isset($user)){
            $user = Auth::user();
        }
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($user->followings, $resourceOptions, 'followings');

        return new FollowersResource($parsedData['followings']);
    }

    public function OwnedProjects(User $user = null)
    {
        if(!isset($user)){
            $user = Auth::user();
        }
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($user->OwnedProjects, $resourceOptions, 'projects');

        return new ProjectsResource($parsedData['projects']);
    }

    public function Projects(User $user = null)
    {
        if(!isset($user)){
            $user = Auth::user();
        }
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($user->Projects, $resourceOptions, 'projects');

        return new ProjectsResource($parsedData['projects']);
    }

    public function Skills(User $user = null)
    {
        if(!isset($user)){
            $user = Auth::user();
        }
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($user->Skills, $resourceOptions, 'skills');

        return new SkillsResource($parsedData['skills']);
    }

    public function Votes(User $user = null)
    {
        if(!isset($user)){
            $user = Auth::user();
        }
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($user->Skills, $resourceOptions, 'skills');

        return new SkillsResource($parsedData['skills']);
    }
}
