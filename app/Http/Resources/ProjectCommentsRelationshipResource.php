<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectCommentsRelationshipResource extends JsonResource
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
                'self'    => route('projects.relationships.comments', ['project' => $project->id]),
                'related' => route('projects.comments', ['project' => $project->id]),
            ],
            'data'  => SponsorsIdentifierResource::collection($this),
        ];
    }
}
