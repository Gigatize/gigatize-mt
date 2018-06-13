<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAchievementsRelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $this->additional['user'];
        return [
            'links' => [
                'self'    => route('users.relationships.achievements', ['user' => $user->id]),
                'related' => route('users.achievements', ['user' => $user->id]),
            ],
            'data'  => AchievementResource::collection($this),
        ];
    }
}
