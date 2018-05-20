<?php
namespace App\Http\Controllers\API\v1;
use App\Http\Controllers\Controller;
use App\Http\Resources\AcceptanceCriteriaCollectionResource;
use App\Http\Resources\AcceptanceCriteriaResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\LocationResource;
use App\Http\Resources\SkillsResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Project;

class ProjectRelationshipController extends Controller
{
    public function Owner(Project $project)
    {
        return new UserResource($project->Owner);
    }

    public function Category(Project $project)
    {
        return new CategoryResource($project->Category);
    }

    public function Skills(Project $project)
    {
        return new SkillsResource($project->Skills);
    }

    public function Location(Project $project)
    {
        return new LocationResource($project->Locations);
    }

    public function Users(Project $project)
    {
        return new UsersResource($project->Users);
    }

    public function AcceptanceCriteria(Project $project)
    {
        return new AcceptanceCriteriaCollectionResource($project->AcceptanceCriteria);
    }

}