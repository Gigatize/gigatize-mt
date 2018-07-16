<?php
namespace App\Http\Controllers\API\v1;
use App\AcceptanceCriteria;
use App\Achievements\UserJoinedAProject;
use App\Comment;
use App\Http\Requests\EditCommentFormRequest;
use App\Http\Resources\AcceptanceCriteriaCollectionResource;
use App\Http\Resources\AcceptanceCriteriaResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CommentResource;
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
use App\Services\ProjectRelationshipService;
use App\Traits\EloquentBuilderTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Optimus\Bruno\LaravelController;

class ProjectRelationshipController extends LaravelController
{
    use EloquentBuilderTrait;

    private $projectRelationshipService;

    public function __construct(ProjectRelationshipService $projectRelationshipService) {
        $this->projectRelationshipService = $projectRelationshipService;
    }

    public function AcceptanceCriteria(Project $project)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();
        $response = $this->projectRelationshipService->AcceptanceCriteria($project);

        if($response->success) {
            $parsedData = $this->parseData($response->object, $resourceOptions, 'AcceptanceCriteria');
            return new AcceptanceCriteriaCollectionResource($parsedData['AcceptanceCriteria']);
        }else{
            return response()->json(['message' => $response->msg, 'error' => $response->error], $response->error);
        }

    }

    public function CompleteAcceptanceCriteria(Project $project, $criteria)
    {
        $criteria = AcceptanceCriteria::findOrFail($criteria);
        $resourceOptions = $this->parseResourceOptions();

        $response = $this->projectRelationshipService->CompleteAcceptanceCriteria($project, $criteria);
        if($response->success) {
            $parsedData = $this->parseData($response->object, $resourceOptions, 'AcceptanceCriteria');

            return new AcceptanceCriteriaResource($parsedData['AcceptanceCriteria']);
        }else{
            return response()->json(['message'=> $response->msg,'error'=> $response->error], $response->error);
        }
    }

    public function Category(Project $project)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $response = $this->projectRelationshipService->Category($project);

        if($response->success) {
            $parsedData = $this->parseData($response->object, $resourceOptions, 'category');

            return new CategoryResource($parsedData['category']);
        }else{
            return response()->json(['message'=> $response->msg,'error'=> $response->error], $response->error);
        }
    }

    public function Comments(Project $project)
    {

        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $response = $this->projectRelationshipService->Comments($project);

        if($response->success) {
            $parsedData = $this->parseData($response->object, $resourceOptions, 'comments');

            return new CommentsResource($parsedData['comments']);
        }else{
            return response()->json(['message'=> $response->msg,'error'=> $response->error], $response->error);
        }
    }

    public function leaveComment(EditCommentFormRequest $request, Project $project){

        $response = $this->projectRelationshipService->leaveComment($request, $project);
        if($response->success) {
            return new CommentResource($response->object);
        }else{
            return response()->json(['message'=> $response->msg,'error'=> $response->error], $response->error);
        }
    }

    public function editComment(EditCommentFormRequest $request, Project $project, Comment $comment){

        $response = $this->projectRelationshipService->editComment($request, $project, $comment);
        if($response->success) {
            return new CommentResource($response->object);
        }else{
            return response()->json(['message'=> $response->msg,'error'=> $response->error], $response->error);
        }
    }

    public function deleteComment(Project $project, Comment $comment){

        $response = $this->projectRelationshipService->deleteComment($project, $comment);
        if($response->success) {
            return response()->json(['message'=> $response->msg],$response->status);
        }else{
            return response()->json(['message'=> $response->msg,'error'=> $response->error], $response->error);
        }
    }

    public function Followers(Project $project){

        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $response = $this->projectRelationshipService->Followers($project);

        if($response->success) {
            $parsedData = $this->parseData($response->object, $resourceOptions, 'followers');

            return new FollowersResource($parsedData['followers']);
        }else{
            return response()->json(['message'=> $response->msg,'error'=> $response->error], $response->error);
        }

    }

    public function createFollower(Project $project){

        $response = $this->projectRelationshipService->createFollower($project);
        if($response->success) {
            return (new FollowerResource($response->object))->response()->setStatusCode(201);
        }else{
            return response()->json(['message'=> $response->msg,'error'=> $response->error], $response->error);
        }
    }

    public function deleteFollower(Project $project){

        $response = $this->projectRelationshipService->deleteFollower($project);
        if($response->success) {
            return response()->json(['message'=> $response->msg],$response->status);
        }else{
            return response()->json(['message'=> $response->msg,'error'=> $response->error], $response->error);
        }

    }

    public function Location(Project $project)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($project->Location, $resourceOptions, 'location');

        return new LocationResource($parsedData['location']);
    }

    public function Owner(Project $project)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $response = $this->projectRelationshipService->Owner($project);

        if($response->success) {
            $parsedData = $this->parseData($response->object, $resourceOptions, 'owner');
            return new UserResource($parsedData['owner']);
        }else{
            return response()->json(['message' => $response->msg, 'error' => $response->error], $response->error);
        }

    }

    public function Skills(Project $project)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $response = $this->projectRelationshipService->Skills($project);

        if($response->success) {
            $parsedData = $this->parseData($response->object, $resourceOptions, 'skills');
            return new SkillsResource($parsedData['skills']);
        }else{
            return response()->json(['message' => $response->msg, 'error' => $response->error], $response->error);
        }
    }

    public function Users(Project $project)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $response = $this->projectRelationshipService->Users($project);

        if($response->success) {
            $parsedData = $this->parseData($response->object, $resourceOptions, 'users');
            return new UsersResource($parsedData['users']);
        }else{
            return response()->json(['message' => $response->msg, 'error' => $response->error], $response->error);
        }

    }

    public function joinProject(Project $project){

        $response = $this->projectRelationshipService->joinProject($project);
        if($response->success) {
            return (new UsersResource($response->object))->response()->setStatusCode(201);
        }else {
            return response()->json(['message' => $response->msg, 'error' => $response->error], $response->error);
        }
    }

    public function leaveProject(Project $project){

        $response = $this->projectRelationshipService->leaveProject($project);
        if($response->success) {
            return (new UsersResource($response->object))->response()->setStatusCode(204);
        }else {
            return response()->json(['message' => $response->msg, 'error' => $response->error], $response->error);
        }
    }

    public function Votes(Project $project){

        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $response = $this->projectRelationshipService->Votes($project);

        if($response->success) {
            $parsedData = $this->parseData($response->object, $resourceOptions, 'upvotes');
            return new VotesResource($parsedData['upvotes']);
        }else{
            return response()->json(['message' => $response->msg, 'error' => $response->error], $response->error);
        }

    }

    public function upVote(Project $project){

        $response = $this->projectRelationshipService->upVote($project);
        if($response->success) {
            return (new VotesResource($response->object))->response()->setStatusCode(201);
        }else{
            return response()->json(['message'=> $response->msg,'error'=> $response->error], $response->error);
        }
    }

    public function downVote(Project $project){

        $response = $this->projectRelationshipService->downVote($project);
        if($response->success) {
            return response()->json(['message'=> $response->msg],$response->status);
        }else{
            return response()->json(['message'=> $response->msg,'error'=> $response->error], $response->error);
        }
    }
}