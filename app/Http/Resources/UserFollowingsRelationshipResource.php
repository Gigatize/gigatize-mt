<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserFollowingsRelationshipResource extends JsonResource
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
                'self'    => route('users.relationships.followings', ['user' => $user->id]),
                'related' => route('users.followings', ['user' => $user->id]),
            ],
            'data'  => FollowerResource::collection($this),
        ];
    }
}
