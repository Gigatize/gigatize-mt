<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RolePermissionsRelationshipResource extends JsonResource
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
                'self'    => route('roles.relationships.permissions', ['permission' => $permission->id]),
                'related' => route('roles.permissions', ['permission' => $permission->id]),
            ],
            'data'  => PermissionResource::collection($this),
        ];
    }
}
