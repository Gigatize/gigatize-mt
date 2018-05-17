<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
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
            'type'          => 'skill',
            'id'            => (string)$this->id,
            'attributes'    => [
                'name' => $this->name,
                'created_at' => $this->created_at->toDateTimeString(),
                'updated_at' => $this->updated_at->toDateTimeString(),
            ],
            'links'         => [
                'self' => route('skills.show', ['skill' => $this->id]),
            ],
        ];
    }
}
