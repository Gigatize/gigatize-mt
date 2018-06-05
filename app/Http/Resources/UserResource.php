<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type'          => 'user',
            'id'            => (string)$this->id,
            'attributes'    => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'job_title' => $this->job_title,
                'location' => $this->location,
                'picture' => $this->picture,
                'created_at' => $this->created_at->toDateTimeString(),
                'updated_at' => $this->updated_at->toDateTimeString(),
            ],
            'relationships' => $this->when($this->getRelations(), function() {
                return new UserRelationshipResource($this);
            }),
            'links'         => [
                'self' => route('users.show', ['user' => $this->id]),
            ],
        ];
    }
}
