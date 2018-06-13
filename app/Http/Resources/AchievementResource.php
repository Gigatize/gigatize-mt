<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AchievementResource extends JsonResource
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
            'type'          => 'achievement',
            'id'            => (string)$this->id,
            'attributes'    => [
                'name' => $this->details->name,
                'description' => $this->details->description,
                'points' => (string)$this->points,
                'unlocked_at' => (string)$this->unlocked_at->toDateTimeString(),
                'created_at' => (string)$this->created_at->toDateTimeString(),
                'updated_at' => (string)$this->updated_at->toDateTimeString(),
            ],
            'relationships' => $this->when($this->relationLoaded('achiever'), function() {
                return new AchievementRelationshipResource($this);
            }),
            'links'         => [
                'self' => route('achievements.show', ['achievement' => $this->id]),
            ],
        ];
    }
}
