<?php

namespace App\Repositories;


use App\Project;
use App\Skill;
use Carbon\Carbon;
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
        $project->location_id = $data['location_id'];
        $project->timezone = isset($data['timezone']) ?: $data['timezone'] = null;
        $project->impact = $data['impact'];
        $project->max_users = $data['max_users'];
        $project->estimated_hours = $data['estimated_hours'];
        $project->resources_link = isset($data['resources_link']) ?: $data['resources_link'] = null;
        $project->additional_info = isset($data['additional_info']) ?: $data['additional_info'] = null;
        if(isset($data['flexible_start'])) {
            $project->flexible_start = true;
        }else{
            $project->flexible_start = false;
        }
        if(isset($data['on_site'])) {
            $project->on_site = true;
        }else{
            $project->on_site = false;
        }
        if(isset($data['renew'])) {
            $project->renew = true;
        }else{
            $project->renew = false;
        }
        $project->save();

        foreach ($data['acceptance_criteria'] as $criteria){
            $project->AcceptanceCriteria()->create([
                'criteria' => $criteria
            ]);
        }

        foreach (explode(',',$data['skills']) as $skillName){
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

        return $project;
    }
}