<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkillProjectsRelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $skill = $this->additional['skill'];
        return [
            'links' => [
                'self'    => route('skills.relationships.projects', ['skill' => $skill->id]),
                'related' => route('skills.projects', ['skill' => $skill->id]),
            ],
            'data'  => ProjectResource::collection($this),
        ];
    }
}
