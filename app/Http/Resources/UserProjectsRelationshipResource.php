<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProjectsRelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $this->additional['user'];
        return [
            'links' => [
                'self'    => route('users.relationships.projects', ['user' => $user->id]),
                'related' => route('users.projects', ['user' => $user->id]),
            ],
            'data'  => ProjectResource::collection($this),
        ];
    }
}
