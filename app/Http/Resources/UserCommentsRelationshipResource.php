<?php

namespace App\Http\Resources;

use App\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCommentsRelationshipResource extends JsonResource
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
                'self'    => route('users.relationships.comments', ['user' => $user->id]),
                'related' => route('users.comments', ['user' => $user->id]),
            ],
            'data'  => CommentResource::collection($this),
        ];
    }
}
