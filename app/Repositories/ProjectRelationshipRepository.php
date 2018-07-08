<?php

namespace App\Repositories;

use App\AcceptanceCriteria;
use App\Project;
use App\Traits\EloquentBuilderTrait;
use App\User;
use Carbon\Carbon;

class ProjectRelationshipRepository
{
    use EloquentBuilderTrait;

    public function AcceptanceCriteria(Project $project){
        // Start a new query for owner using Eloquent query builder
        $acceptanceCriteria = $project->AcceptanceCriteria;
        if($acceptanceCriteria){
            $response = array(
                'success' => true,
                'object' => $acceptanceCriteria
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "Something went wrong",
                'error' => 500
            );
            return (object)$response;
        }
    }

    public function CompleteAcceptanceCriteria($criteria){
        if(!$criteria->complete) {
            $criteria->complete = true;
            $criteria->completed_at = Carbon::now();
            $updatedCriteria = $criteria->save();

            if ($updatedCriteria) {
                $response = array(
                    'success' => true,
                    'object' => $criteria
                );
                return (object)$response;
            } else {
                $response = array(
                    'success' => false,
                    'msg' => "Unable to save acceptance criteria",
                    'error' => 500
                );
                return (object)$response;
            }
        }else{
            $response = array(
                'success' => false,
                'msg' => "acceptance criteria already complete",
                'error' => 409
            );
            return (object)$response;
        }
    }

    public function Category(Project $project){
        // Start a new query for owner using Eloquent query builder
        $category = $project->Category;
        if($category){
            $response = array(
                'success' => true,
                'object' => $category
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "Unable to find related category",
                'error' => 404
            );
            return (object)$response;
        }
    }

    public function Comments(Project $project){
        // Start a new query for owner using Eloquent query builder
        $comments = $project->Comments;
        if($comments){
            $response = array(
                'success' => true,
                'object' => $comments
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "Unable to find related comments",
                'error' => 404
            );
            return (object)$response;
        }
    }

    public function leaveComment($request, Project $project, $user){
        $user->comment($project, $request->get('comment'));
        $comment = $project->comments()->orderBy('created_at','desc')->first();
        if($comment) {
            $response = array(
                'success' => true,
                'object' => $comment
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "Unable to create comment",
                'error' => 500
            );
            return (object)$response;
        }
    }

    public function Owner(Project $project){
        // Start a new query for owner using Eloquent query builder
        $owner = $project->Owner;
        if($owner){
            $response = array(
                'success' => true,
                'object' => $owner
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "Unable to find related owner",
                'error' => 404
            );
            return (object)$response;
        }
    }
}