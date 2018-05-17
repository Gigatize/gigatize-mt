<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectSkillsRelationshipResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $project = $this->additional['project'];
        return [
            'links' => [
                'self'    => route('projects.relationships.skills', ['project' => $project->id]),
                'related' => route('projects.skills', ['project' => $project->id]),
            ],
            'data'  => SkillIdentifierResource::collection($this->collection),
        ];
    }
}
