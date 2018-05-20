<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentsResource extends JsonResource
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
            'users' => CommentResource::collection($this),
        ];
    }
    public function with($request)
    {
        return [
            'links'    => [
                'self' => route('comments.index'),
            ],
        ];
    }
}
