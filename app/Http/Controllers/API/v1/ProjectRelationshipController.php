<?php
namespace App\Http\Controllers\API\v1;
use App\AcceptanceCriteria;
use App\Achievements\UserJoinedAProject;
use App\Http\Resources\AcceptanceCriteriaCollectionResource;
use App\Http\Resources\AcceptanceCriteriaResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CommentsResource;
use App\Http\Resources\FollowerResource;
use App\Http\Resources\FollowersResource;
use App\Http\Resources\LocationResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\SkillsResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Http\Resources\VotesResource;
use App\Project;
use App\Traits\EloquentBuilderTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Optimus\Bruno\LaravelController;

class ProjectRelationshipController extends LaravelController
{
    use EloquentBuilderTrait;

    public function Owner(Project $project)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($project->Owner, $resourceOptions, 'owner');

        return new UserResource($parsedData['owner']);
    }

    public function Category(Project $project)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($project->Category, $resourceOptions, 'category');

        return new CategoryResource($parsedData['category']);
    }

    public function Skills(Project $project)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($project->Skills, $resourceOptions, 'skills');

        return new SkillsResource($parsedData['skills']);
    }

    public function Location(Project $project)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($project->Location, $resourceOptions, 'location');

        return new LocationResource($parsedData['location']);
    }

    public function Users(Project $project)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($project->Users, $resourceOptions, 'users');

        return new UsersResource($parsedData['users']);
    }

    public function joinProject(Project $project){
        $user = Auth::user();
        $project->users()->attach($user->id);
        $user->addProgress(new UserJoinedAProject(), 1);

        return new ProjectResource(Project::find($project->id)->with('users')->first());
    }

    public function leaveProject(Project $project){
        $user = Auth::user();
        $project->users()->detach($user->id);

        return new UsersResource($project->users);
    }

    public function AcceptanceCriteria(Project $project)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($project->AcceptanceCriteria, $resourceOptions, 'AcceptanceCriteria');

        return new AcceptanceCriteriaCollectionResource($parsedData['AcceptanceCriteria']);
    }

    public function CompleteAcceptanceCriteria(Project $project, $criteria)
    {
        $criteria = AcceptanceCriteria::findOrFail($criteria);
        $user = Auth::user();
        if(($user->can('edit project') and $user->id == $project->user_id or $user->can('manage projects')) and $project->id == $criteria->project_id) {
            // Parse the resource options given by GET parameters
            $criteria->complete = true;
            $criteria->completed_at = Carbon::now();
            $criteria->save();
            $resourceOptions = $this->parseResourceOptions();

            $parsedData = $this->parseData($criteria, $resourceOptions, 'AcceptanceCriteria');

            return new AcceptanceCriteriaResource($parsedData['AcceptanceCriteria']);
        }else{
            return response()->json(['message'=>'Unauthorized action','error'=>403],403);
        }
    }

    public function Comments(Project $project)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($project->comments, $resourceOptions, 'comments');

        return new CommentsResource($parsedData['comments']);
    }

    public function Votes(Project $project){
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($project->upvoters, $resourceOptions, 'upvotes');

        return new VotesResource($parsedData['upvotes']);
    }

    public function upVote(Project $project){
        $user = Auth::user();
        $user->upvote($project);

        return (new VotesResource($project->upvoters))
            ->response()
            ->setStatusCode(201);
    }

    public function downVote(Project $project){
        $user = Auth::user();
        $user->cancelVote($project);

        return new VotesResource($project->upvoters);
    }

    public function Followers(Project $project){
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($project->followers, $resourceOptions, 'followers');

        return new FollowersResource($parsedData['followers']);
    }

    public function createFollower(Project $project){
        $user = Auth::user();
        $user->follow($project);
        $project->followers()->where('user_id',$user->id)->first();
        return (new FollowerResource($project->upvoters))
            ->response()
            ->setStatusCode(201);
    }

    public function deleteFollower(Project $project){
        $user = Auth::user();
        $user->unfollow($project);

        return response()->json(['status'=> 204, 'message'=>'you successfully unfollowed the project'],204);
    }

}