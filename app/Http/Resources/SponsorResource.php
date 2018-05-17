<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SponsorResource extends JsonResource
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
            'type'          => 'sponsor',
            'id'            => (string)$this->id,
            'attributes'    => [
                'points' => $this->points,
                'created_at' => $this->created_at->toDateTimeString(),
                'updated_at' => $this->updated_at->toDateTimeString(),
            ],
            'links'         => [
                'self' => route('sponsors.show', ['user' => $this->id]),
            ],
        ];
    }
}
