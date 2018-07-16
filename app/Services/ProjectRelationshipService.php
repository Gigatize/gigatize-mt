<?php

namespace App\Services;

use App\AcceptanceCriteria;
use App\Achievements\UserJoined10Projects;
use App\Achievements\UserJoinedAProject;
use App\Comment;
use App\Project;
use App\Repositories\ProjectRelationshipRepository;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Helper\ProcessHelper;

class ProjectRelationshipService {

    private $dispatcher;

    private $projectRelationshipRepository;

    public function __construct(Dispatcher $dispatcher, ProjectRelationshipRepository $projectRelationshipRepository) {
        $this->dispatcher = $dispatcher;
        $this->projectRelationshipRepository = $projectRelationshipRepository;
    }

    public function AcceptanceCriteria(Project $project){
        $response = $this->projectRelationshipRepository->AcceptanceCriteria($project);

        if($response->success){
            return $response;
        }else{
            return $response;
        }
    }

    public function CompleteAcceptanceCriteria(Project $project, $criteria){
        $user = Auth::user();
        if((($user->can('edit project') and $user->id == $project->user_id) or $user->can('manage projects') or $user->can('manage everything')) and $project->id == $criteria->project_id) {

            $response = $this->projectRelationshipRepository->CompleteAcceptanceCriteria($criteria);

            if($response->success) {
                //log user activity
                activity()
                    ->causedBy($user)
                    ->performedOn($response->object)
                    ->withProperties(['points' => 2])
                    ->log('acceptance criteria completed');

                return $response;

            }else{
                return $response;
            }
        }else{
            $response = array(
                'success' => false,
                'msg' => "Unauthorized action",
                'error' => 403
            );
            return (object)$response;
        }
    }

    public function Category(Project $project){
        $response = $this->projectRelationshipRepository->Category($project);

        if($response->success){
            return $response;
        }else{
            return $response;
        }
    }

    public function Comments(Project $project){
        $response = $this->projectRelationshipRepository->Comments($project);

        if($response->success){
            return $response;
        }else{
            return $response;
        }
    }

    public function leaveComment($request, Project $project){
        $user = Auth::user();
        $response = $this->projectRelationshipRepository->leaveComment($request, $project, $user);

        if($response->success){

            activity()
                ->causedBy($user)
                ->performedOn($response->object)
                ->withProperties(['points' => 2])
                ->log('comment created');

            return $response;
        }else{
            return $response;
        }

    }

    public function editComment($request, Project $project, Comment $comment){
        $user = Auth::user();
        if($comment->commentable_id == $project->id) {
            if ($comment->commented_id == $user->id) {
                $response = $this->projectRelationshipRepository->editComment($request, $project, $comment);

                if($response->success){
                    return $response;
                }else{
                    return $response;
                }
            }else{
                $response = array(
                    'success' => false,
                    'msg' => "Unauthorized action",
                    'error' => 403
                );
                return (object)$response;
            }
        }else{
            $response = array(
                'success' => false,
                'msg' => "The specified comment is not associated with this project",
                'error' => 404
            );
            return (object)$response;
        }

    }

    public function deleteComment(Project $project, Comment $comment){
        $user = Auth::user();
        if($comment->commentable_id == $project->id) {
            if ($comment->commented_id == $user->id) {
                $response = $this->projectRelationshipRepository->deleteComment($comment);

                if($response->success){
                    return $response;
                }else{
                    return $response;
                }
            }else{
                $response = array(
                    'success' => false,
                    'msg' => "Unauthorized action",
                    'error' => 403
                );
                return (object)$response;
            }
        }else{
            $response = array(
                'success' => false,
                'msg' => "The specified comment is not associated with this project",
                'error' => 404
            );
            return (object)$response;
        }

    }

    public function Followers(Project $project){
        $response = $this->projectRelationshipRepository->Followers($project);

        if($response->success){
            return $response;
        }else{
            return $response;
        }
    }

    public function createFollower(Project $project){
        $user = Auth::user();
        $response = $this->projectRelationshipRepository->createFollower($project, $user);
        if($response->success){
            //log user activity
            activity()
                ->causedBy($user)
                ->performedOn($project)
                ->withProperties(['points' => 1])
                ->log('project followed');

            return $response;
        }else{
            return $response;
        }
    }

    public function deleteFollower(Project $project){
        $user = Auth::user();
        $response = $this->projectRelationshipRepository->deleteFollower($project, $user);
        if($response->success){
            return $response;
        }else{
            return $response;
        }
    }

    public function Owner(Project $project){
        $response = $this->projectRelationshipRepository->Owner($project);

        if($response->success){
            return $response;
        }else{
            return $response;
        }
    }

    public function Skills(Project $project){
        $response = $this->projectRelationshipRepository->Skills($project);

        if($response->success){
            return $response;
        }else{
            return $response;
        }
    }

    public function Users(Project $project){
        $response = $this->projectRelationshipRepository->Users($project);

        if($response->success){
            return $response;
        }else{
            return $response;
        }
    }

    public function joinProject(Project $project){
        $user = Auth::user();
        if($user->id != $project->user_id) {
            if(!$project->Users()->where('users.id',$user->id)->exists()) {
                $response = $this->projectRelationshipRepository->joinProject($project, $user);
                if ($response->success) {
                    //log user activity
                    activity()
                        ->causedBy($user)
                        ->performedOn($project)
                        ->withProperties(['points' => 10])
                        ->log('project joined');

                    //add achievement progress
                    $user->addProgress(new UserJoinedAProject(), 1);
                    $user->addProgress(new UserJoined10Projects(), 1);

                    return $response;
                } else {
                    return $response;
                }
            }else{
                $response = array(
                    'success' => false,
                    'msg' => "User already belongs to project",
                    'error' => 403
                );
                return (object)$response;
            }
        }else{
            $response = array(
                'success' => false,
                'msg' => "Unauthorized action",
                'error' => 403
            );
            return (object)$response;
        }
    }

    public function leaveProject(Project $project){
        $user = Auth::user();
        $response = $this->projectRelationshipRepository->leaveProject($project, $user);
        if ($response->success) {
            return $response;
        }else{
            return $response;
        }
    }

    public function Votes(Project $project){
        $response = $this->projectRelationshipRepository->Votes($project);

        if($response->success){
            return $response;
        }else{
            return $response;
        }
    }

    public function upVote(Project $project){
        $user = Auth::user();
        $response = $this->projectRelationshipRepository->upVote($project, $user);
        if($response->success){
            //log user activity
            activity()
                ->causedBy($user)
                ->performedOn($project)
                ->withProperties(['points' => 1])
                ->log('project followed');

            return $response;
        }else{
            return $response;
        }
    }

    public function downVote(Project $project){
        $user = Auth::user();
        $response = $this->projectRelationshipRepository->downVote($project, $user);
        if($response->success){
            return $response;
        }else{
            return $response;
        }
    }


}