<?php

namespace App\Repositories;


use App\Project;
use App\Skill;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Optimus\Genie\Repository;

class ProjectRepository extends Repository
{
    protected function getModel()
    {
        return new Project;
    }

    public function create(array $data)
    {
        $project = new Project();
        $project->title = $data['title'];
        $project->user_id = $data['user_id'];
        $project->category_id = $data['category_id'];
        $project->description = $data['description'];
        $project->start_date = Carbon::parse($data['start_date']);
        $project->deadline = Carbon::parse($data['deadline']);
        $project->impact = $data['impact'];
        $project->open_to = $data['open_to'];
        $project->max_users = $data['max_users'];
        $project->estimated_hours = $data['estimated_hours'];
        $project->resources_link = isset($data['resources_link']) ?: $data['resources_link'] = null;
        $project->additional_info = isset($data['additional_info']) ?: $data['additional_info'] = null;
        $project->urgent = $data['urgent'];
        $project->on_site = $data['on_site'];
        $project->renew = $data['renew'];
        $project->save();

        $this->attachAcceptanceCriteria($project, $data['acceptance_criteria']);
        $this->attachSkills($project, $data['acceptance_criteria']);

        return $project;
    }

    public function update(array $data, $project)
    {
        $project->title = $data['title'];
        $project->user_id = $data['user_id'];
        $project->category_id = $data['category_id'];
        $project->description = $data['description'];
        $project->start_date = Carbon::parse($data['start_date']);
        $project->deadline = Carbon::parse($data['deadline']);
        $project->impact = $data['impact'];
        $project->open_to = $data['open_to'];
        $project->max_users = $data['max_users'];
        $project->estimated_hours = $data['estimated_hours'];
        $project->resources_link = isset($data['resources_link']) ?: $data['resources_link'] = null;
        $project->additional_info = isset($data['additional_info']) ?: $data['additional_info'] = null;
        $project->urgent = $data['urgent'];
        $project->on_site = $data['on_site'];
        $project->renew = $data['renew'];
        $project->save();

        $project->AcceptanceCriteria()->delete();
        $this->attachAcceptanceCriteria($project, $data['acceptance_criteria']);
        $project->Skills()->detach();
        $this->attachSkills($project, $data['acceptance_criteria']);

        return $project;
    }

    public function filterOwner(Builder $query, $method, $clauseOperator, $value)
    {
        // if clauseOperator is idential to false,
        //     we are using a specific SQL method in its place (e.g. `in`, `between`)
        if ($clauseOperator === false) {
            call_user_func([$query, $method], 'users.first_name', $value);
        } else {
            call_user_func([$query, $method], 'users.first_name', $clauseOperator, $value);
        }
    }

    public function filterSkills(Builder $query, $method, $clauseOperator, $value)
    {
        // if clauseOperator is idential to false,
        //     we are using a specific SQL method in its place (e.g. `in`, `between`)
        if ($clauseOperator === false) {
            call_user_func([$query, $method], 'skills.name', $value);
        } else {
            call_user_func([$query, $method], 'skills.name', $clauseOperator, $value);
        }
    }

    private function attachAcceptanceCriteria(Project $project, $acceptanceCriteriaArray){
        foreach ($acceptanceCriteriaArray as $criteria){
            $project->AcceptanceCriteria()->create([
                'criteria' => $criteria
            ]);
        }
    }

    private function attachSkills(Project $project, $skillsArray){
        foreach ($skillsArray as $skillName){
            $skill = Skill::where('name',$skillName)->first();
            if($skill){
                $project->Skills()->attach($skill->id);
            }else{
                $skill = Skill::create([
                    'name'=> $skillName
                ]);
                $project->Skills()->attach($skill->id);
            }
        }
    }

}