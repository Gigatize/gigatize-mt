<?php

namespace App\Repositories;

use App\AcceptanceCriteria;
use App\Comment;
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

    public function editComment($request, Project $project, Comment $comment){
        $comment->comment = $request->get('comment');
        if($comment->save()) {
            $updatedComment = Comment::find($comment->id);
            $response = array(
                'success' => true,
                'object' => $updatedComment,
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "There was an issue saving the comment",
                'error' => 500
            );
            return (object)$response;
        }
    }

    public function deleteComment(Comment $comment){
        $result = $comment->delete();
        if($result) {
            $response = array(
                'success' => true,
                'msg' => "Successfully deleted the comment",
                'status' => 204
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "There was an issue saving the comment",
                'error' => 500
            );
            return (object)$response;
        }
    }

    public function Followers(Project $project){
        // Start a new query for owner using Eloquent query builder
        $followers = $project->followers;
        if($followers){
            $response = array(
                'success' => true,
                'object' => $followers
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "Unable to find related followers",
                'error' => 404
            );
            return (object)$response;
        }
    }

    public function createFollower(Project $project, $user){
        $user->follow($project);
        $follower = $project->followers()->where('user_id',$user->id)->first();
        if($follower){
            $response = array(
                'success' => true,
                'object' => $follower
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "Unable to follow project",
                'error' => 500
            );
            return (object)$response;
        }
    }

    public function deleteFollower(Project $project, $user){
        $user->unfollow($project);

        $response = array(
            'success' => true,
            'msg' => "Successfully unfollowed the project",
            'status' => 204
        );
        return (object)$response;
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

    public function Skills(Project $project){
        // Start a new query for owner using Eloquent query builder
        $skills = $project->Skills;
        if($skills){
            $response = array(
                'success' => true,
                'object' => $skills
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "Unable to find related skill",
                'error' => 404
            );
            return (object)$response;
        }
    }

    public function Users(Project $project){
        // Start a new query for owner using Eloquent query builder
        $users = $project->Users;
        if($users){
            $response = array(
                'success' => true,
                'object' => $users
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "Unable to find related users",
                'error' => 404
            );
            return (object)$response;
        }
    }

    public function joinProject(Project $project, $user){
        $project->Users()->attach($user->id);
        $users = $project->Users;
        if($users){
            $response = array(
                'success' => true,
                'object' => $users
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "Unable to follow project",
                'error' => 500
            );
            return (object)$response;
        }
    }

    public function leaveProject(Project $project, $user){
        $project->Users()->detach($user->id);
        $users = $project->Users;
        if($users){
            $response = array(
                'success' => true,
                'object' => $users
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "Unable to follow project",
                'error' => 500
            );
            return (object)$response;
        }
    }

    public function Votes(Project $project){
        // Start a new query for owner using Eloquent query builder
        $votes = $project->voters;
        if($votes){
            $response = array(
                'success' => true,
                'object' => $votes
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "Unable to find related votes",
                'error' => 404
            );
            return (object)$response;
        }
    }

    public function upVote(Project $project, $user){
        $user->upvote($project);
        $upvoter = $project->upvoters()->where('user_id',$user->id)->first();
        if($upvoter){
            $response = array(
                'success' => true,
                'object' => $upvoter
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "Unable to follow project",
                'error' => 500
            );
            return (object)$response;
        }
    }

    public function downVote(Project $project, $user){
        $user->cancelVote($project);

        $response = array(
            'success' => true,
            'msg' => "Successfully removed your upvote",
            'status' => 204
        );
        return (object)$response;
    }
}