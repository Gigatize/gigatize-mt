<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkillRelationshipResource extends JsonResource
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
            'projects' => $this->when($this->relationLoaded('projects'), function () {
                return (new SkillProjectsRelationshipResource($this->Projects))->additional(['skill' => $this]);
            }),
            'users' => $this->when($this->relationLoaded('users'), function () {
                return (new SkillUsersRelationshipResource($this->Users))->additional(['skill' => $this]);
            }),
        ];
    }
}
