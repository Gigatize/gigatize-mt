<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AchievementRelationshipResource extends JsonResource
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
            'user' => $this->when($this->relationLoaded('achiever'), function () {
                return [
                    'links' => [
                        'self'    => route('achievements.relationships.user', ['achievement' => $this->id]),
                        'related' => route('achievements.user', ['achievement' => $this->id]),
                    ],
                    'data'  => new UserResource($this->achiever),
                ];
            }),
        ];
    }

    public function with($request)
    {
        return [
            'links' => [
                'self' => route('achievements.index'),
            ],
        ];
    }
}
