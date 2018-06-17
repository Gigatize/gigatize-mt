<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRolesRelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $role = $this->additional['role'];
        return [
            'links' => [
                'self'    => route('users.relationships.roles', ['role' => $role->id]),
                'related' => route('users.roles', ['role' => $role->id]),
            ],
            'data'  => RoleResource::collection($this),
        ];
    }
}
