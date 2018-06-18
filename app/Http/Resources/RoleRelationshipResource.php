<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class RoleRelationshipResource extends JsonResource
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
            'permissions' => $this->when($this->relationLoaded('permissions') and Auth::user()->can('manage users'), function () {
                return (new RolePermissionsRelationshipResource($this->permissions))->additional(['permission' => $this]);
            }),
        ];
    }
}
