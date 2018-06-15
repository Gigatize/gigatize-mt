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
            'owner' => $this->when($this->relationLoaded('owner'), function () {
                return [
                    'links' => [
                        'self'    => route('projects.relationships.owner', ['project' => $this->id]),
                        'related' => route('projects.owner', ['project' => $this->id]),
                    ],
                    'data'  => new UserResource($this->Owner),
                ];
            }),
            'category' => $this->when($this->relationLoaded('category'), function () {
                return [
                    'links' => [
                        'self' => route('projects.relationships.category', ['project' => $this->id]),
                        'related' => route('projects.category', ['project' => $this->id]),
                    ],
                    'data' => new CategoryResource($this->Category),
                ];
            }),
            'skills' => $this->when($this->relationLoaded('skills'), function () {
                return (new ProjectSkillsRelationshipResource($this->Skills))->additional(['project' => $this]);
            }),
            'users' => $this->when($this->relationLoaded('users'), function () {
                return (new ProjectUsersRelationshipResource($this->Users))->additional(['project' => $this]);
            }),
            'acceptance_criteria' => $this->when($this->relationLoaded('AcceptanceCriteria'), function () {
                return (new ProjectAcceptanceCriteriaRelationshipResource($this->AcceptanceCriteria))->additional(['project' => $this]);
            }),
            'sponsors' => $this->when($this->relationLoaded('sponsors'), function () {
                return (new ProjectSponsorsRelationshipResource($this->Sponsors))->additional(['project' => $this]);
            }),
            'comments' => $this->when($this->relationLoaded('comments'), function () {
                return (new ProjectCommentsRelationshipResource($this->comments))->additional(['project' => $this]);
            })
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
