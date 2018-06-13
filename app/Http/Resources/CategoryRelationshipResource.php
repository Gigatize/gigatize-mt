<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryRelationshipResource extends JsonResource
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
                return (new CategoryProjectsRelationshipResource($this->Projects))->additional(['category' => $this]);
            }),
        ];
    }
}
