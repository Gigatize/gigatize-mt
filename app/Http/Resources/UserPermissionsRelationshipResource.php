<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPermissionsRelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $permission = $this->additional['permission'];
        return [
            'links' => [
                'self'    => route('users.relationships.permissions', ['permission' => $permission->id]),
                'related' => route('users.permissions', ['permission' => $permission->id]),
            ],
            'data'  => PermissionResource::collection($this),
        ];
    }
}
