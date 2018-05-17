<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkillsResource extends JsonResource
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
            'skills' => SkillResource::collection($this)
        ];
    }
    public function with($request)
    {
        return [
            'links'    => [
                'self' => route('skills.index'),
            ],
        ];
    }
}
