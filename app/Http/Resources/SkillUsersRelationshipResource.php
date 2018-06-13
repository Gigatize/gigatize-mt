<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkillUsersRelationshipResource extends JsonResource
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
                'self'    => route('skills.relationships.users', ['skill' => $skill->id]),
                'related' => route('skills.users', ['skill' => $skill->id]),
            ],
            'data'  => UserResource::collection($this),
        ];
    }
}
