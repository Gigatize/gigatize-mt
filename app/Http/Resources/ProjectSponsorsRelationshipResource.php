<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectSponsorsRelationshipResource extends JsonResource
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
                'self'    => route('projects.relationships.sponsors', ['project' => $project->id]),
                'related' => route('projects.sponsors', ['project' => $project->id]),
            ],
            'data'  => SponsorResource::collection($this),
        ];
    }
}
