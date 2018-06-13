<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryProjectsRelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $category = $this->additional['category'];
        return [
            'links' => [
                'self'    => route('categories.relationships.projects', ['category' => $category->id]),
                'related' => route('categories.projects', ['category' => $category->id]),
            ],
            'data'  => ProjectResource::collection($this),
        ];
    }
}
