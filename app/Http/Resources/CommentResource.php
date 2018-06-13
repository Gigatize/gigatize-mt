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
                'comment' => (string)$this->comment,
                'approved' => (boolean)$this->approved,
                'rating' => (string)$this->rate,
                'created_at' => (string)$this->created_at->toDateTimeString(),
                'updated_at' => (string)$this->updated_at->toDateTimeString(),
            ],
            'relationships' => $this->when($this->getRelations(), function() {
                return new CommentRelationshipResource($this);
            }),
            'links'         => [
                'self' => route('comments.show', ['comment' => $this->id]),
            ],
        ];
    }
}
