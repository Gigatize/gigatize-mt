<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserVotesRelationshipResource extends JsonResource
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
                'self'    => route('users.relationships.votes', ['user' => $user->id]),
                'related' => route('users.votes', ['user' => $user->id]),
            ],
            'data'  => VoteResource::collection($this),
        ];
    }
}
