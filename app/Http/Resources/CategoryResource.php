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
                'name' => $this->name,
                'icon_path' => $this->icon_path,
                //'created_at' => $this->created_at->toDateTimeString(),
                //'updated_at' => $this->updated_at->toDateTimeString(),
            ],
            'links'         => [
                'self' => route('categories.show', ['category' => $this->id]),
            ],
        ];
    }
}
