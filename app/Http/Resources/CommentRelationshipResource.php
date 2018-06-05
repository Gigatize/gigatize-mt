<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentRelationshipResource extends JsonResource
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
            'project' => $this->when($this->relationLoaded('commentable'), function () {
                return [
                    'links' => [
                        'self'    => route('comments.relationships.project', ['comment' => $this->id]),
                        'related' => route('comments.project', ['comment' => $this->id]),
                    ],
                    'data'  => new ProjectResource($this->commentable),
                ];
            }),
            'user' => $this->when($this->relationLoaded('commented'), function () {
                return [
                    'links' => [
                        'self'    => route('comments.relationships.user', ['comment' => $this->id]),
                        'related' => route('comments.user', ['comment' => $this->id]),
                    ],
                    'data'  => new UserResource($this->commented),
                ];
            }),
        ];
    }

    public function with($request)
    {
        return [
            'links' => [
                'self' => route('comments.index'),
            ],
        ];
    }
}
