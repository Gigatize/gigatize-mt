<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RolesResource extends JsonResource
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
            'roles' => RoleResource::collection($this),
        ];
    }
    public function with($request)
    {
        return [
            'links'    => [
                'self' => route('roles.index'),
            ],
        ];
    }
}
