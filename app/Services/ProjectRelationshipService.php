<?php

namespace App\Services;

use App\AcceptanceCriteria;
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

    public function Owner(Project $project){
        $response = $this->projectRelationshipRepository->Owner($project);

        if($response->success){
            return $response;
        }else{
            return $response;
        }
    }


}