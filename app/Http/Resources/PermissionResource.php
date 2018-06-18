<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
            'type'          => 'permission',
            'id'            => (string)$this->id,
            'attributes'    => [
                'name' => (string)$this->name,
                'created_at' => (string)$this->created_at->toDateTimeString(),
                'updated_at' => (string)$this->updated_at->toDateTimeString(),
            ],
            'links'         => [
                'self' => route('permissions.show', ['permission' => $this->id]),
            ],
        ];
    }
}
