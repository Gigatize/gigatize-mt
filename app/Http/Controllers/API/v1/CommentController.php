<?php

namespace App\Http\Controllers\API\v1;

use App\Comment;
use App\Http\Requests\EditCommentFormRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentsResource;
use App\Services\CommentService;
use App\Traits\EloquentBuilderTrait;
use Illuminate\Http\Request;
use Optimus\Bruno\LaravelController;

class CommentsController extends LaravelController
{
    use EloquentBuilderTrait;

    private $commentService;

    public function __construct(CommentService $commentService) {
        $this->commentService = $commentService;
    }
    /**
     * Display a listing of all comments.
     *
     * @return CommentsResource
     */
    public function index()
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->commentService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'comments');

        // Create JSON response of parsed data
        return new CommentsResource($parsedData['comments']);
    }

    /**
     * Display the specified resource.
     *
     * @param  Comment $comment
     * @return CommentResource
     */
    public function show(Comment $comment)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->commentService->getById($comment->id, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'comment');

        // Create JSON response of parsed data
        return new CommentResource($parsedData['comment']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditCommentFormRequest $request
     * @param  Comment $comment
     * @return CommentResource
     */
    public function update(EditCommentFormRequest $request, Comment $comment)
    {
        $comment = $this->commentService->update($request, $comment);

        if($comment) {
            return new CommentResource($comment);
        }else{
            return response(['message' => 'Unauthorized action','error' => '403'], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $success = $this->commentService->delete($comment);
        if($success) {
            return response(['message' => 'success', 'status' => '204'], 204);
        }else{
            return response(['message' => 'Unauthorized action','error' => '403'], 403);
        }
    }
}
