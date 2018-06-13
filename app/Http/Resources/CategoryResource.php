<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'type'          => 'category',
            'id'            => (string)$this->id,
            'attributes'    => [
                'name' => (string)$this->name,
                'icon_path' => (string)secure_asset($this->icon_path),
                //'created_at' => $this->created_at->toDateTimeString(),
                //'updated_at' => $this->updated_at->toDateTimeString(),
            ],
            'relationships' => $this->when($this->getRelations(), function() {
                return new CategoryRelationshipResource($this);
            }),
            'links'         => [
                'self' => route('categories.show', ['category' => $this->id]),
            ],
        ];
    }
}
