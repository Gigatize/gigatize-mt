<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectUsersRelationshipResource extends JsonResource
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
                'self'    => route('projects.relationships.users', ['project' => $project->id]),
                'related' => route('projects.users', ['project' => $project->id]),
            ],
            'data'  => new UsersResource($this),
        ];
    }
}
