<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectAcceptanceCriteriaRelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $project = $this->additional['project'];
        return [
            'links' => [
                'self'    => route('projects.relationships.acceptance-criteria', ['project' => $project->id]),
                'related' => route('projects.acceptance-criteria', ['project' => $project->id]),
            ],
            'data'  => AcceptanceCriteriaResource::collection($this),
        ];
    }
}
