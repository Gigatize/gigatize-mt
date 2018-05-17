<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectRelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'owner'   => [
                'links' => [
                    'self'    => route('projects.relationships.owner', ['project' => $this->id]),
                    'related' => route('projects.owner', ['project' => $this->id]),
                ],
                'data'  => new OwnerIdentifierResource($this->Owner),
            ],
            'category' => [
                'links' => [
                    'self'    => route('projects.relationships.category', ['project' => $this->id]),
                    'related' => route('projects.category', ['project' => $this->id]),
                ],
                'data'  => new CategoryIdentifierResource($this->Category),
            ],
            'location' => [
                'links' => [
                    'self'    => route('projects.relationships.location', ['project' => $this->id]),
                    'related' => route('projects.location', ['project' => $this->id]),
                ],
                'data'  => new LocationIdentifierResource($this->Location),
            ],
            'skills' => (new ProjectSkillsRelationshipResource($this->Skills))->additional(['project' => $this]),
            'users' => (new ProjectUsersRelationshipResource($this->Users))->additional(['project' => $this]),
            'acceptance_criteria' => (new ProjectAcceptanceCriteriaRelationshipResource($this->AcceptanceCriteria))->additional(['project' => $this]),
            'sponsors' => (new ProjectSponsorsRelationshipResource($this->Sponsors))->additional(['project' => $this]),
            'comments' => (new ProjectCommentsRelationshipResource($this->comments))->additional(['project' => $this]),

        ];
    }

    public function with($request)
    {
        return [
            'links' => [
                'self' => route('projects.index'),
            ],
        ];
    }
}
