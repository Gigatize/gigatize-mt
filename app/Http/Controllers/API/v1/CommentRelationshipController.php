<?php
namespace App\Http\Controllers\API\v1;
use App\Comment;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\UserResource;
use App\Traits\EloquentBuilderTrait;
use Optimus\Bruno\LaravelController;

class CommentRelationshipController extends LaravelController
{
    use EloquentBuilderTrait;

    public function User(Comment $comment)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($comment->commented, $resourceOptions, 'user');

        return new UserResource($parsedData['user']);
    }

    public function Project(Comment $comment)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($comment->commentable, $resourceOptions, 'project');

        return new ProjectResource($parsedData['project']);
    }

}