<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'type'          => 'location',
            'id'            => (string)$this->id,
            'attributes'    => [
                'name' => $this->name,
            ],
            'links'         => [
                'self' => route('locations.show', ['location' => $this->id]),
            ],
        ];
    }
}
