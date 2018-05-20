<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'type'          => 'comment',
            'id'            => (string)$this->id,
            'attributes'    => [
                'commenter_first_name' => (string)$this->commented->first_name,
                'commenter_last_name' => $this->commented->last_name,
                'comment' => (string)$this->comment,
                'approved' => (string)$this->approved,
                'rating' => (string)$this->rate,
                'created_at' => (string)$this->created_at->toDateTimeString(),
                'updated_at' => (string)$this->updated_at->toDateTimeString(),
            ],
            'links'         => [
                'self' => route('comments.show', ['comment' => $this->id]),
            ],
        ];
    }
}
