<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
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
            'categories' => CategoryResource::collection($this),
        ];
    }
    public function with($request)
    {
        return [
            'links'    => [
                'self' => route('categories.index'),
            ],
        ];
    }
}
