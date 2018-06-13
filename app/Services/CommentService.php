<?php

namespace App\Services;

use App\Comment;
use App\Http\Requests\EditCommentFormRequest;
use App\Repositories\CommentRepository;
use App\Repositories\UserRepository;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;

class CommentService {

    private $auth;

    private $dispatcher;

    private $commentRepository;

    public function __construct(Dispatcher $dispatcher, CommentRepository $commentRepository) {
        $this->dispatcher = $dispatcher;
        $this->commentRepository = $commentRepository;
    }

    public function update(EditCommentFormRequest $request, $comment)
    {
        $user = Auth::user();
        // Check if the user has permission to create projects.
        // Will throw an exception if not.
        //dd($user->getAllPermissions());
        if($user->can('can comment') && $user->id == $comment->commented_id) {
            $data = $request->all();
            // Set the account ID on the user and create the record in the database
            $updatedComment = $this->commentRepository->update($data, $comment);

            return $updatedComment;
        }else{
            return false;
        }
    }

    public function getAll($options = [])
    {
        return $this->commentRepository->get($options);
    }

    public function getById($id, $options){
        return $this->commentRepository->getById($id, $options);
    }

    public function delete($comment){
        $user = Auth::user();

        if($user->can('can comment') && $user->id == $comment->commented_id or $user->can('manage comments')){
            $this->commentRepository->delete($comment->id);
            return true;
        }else{
            return false;
        }
    }
}