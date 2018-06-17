<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScoresResource extends JsonResource
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
            'scores' => ScoreResource::collection($this),
        ];
    }
    public function with($request)
    {
        return [
            'links'    => [
                'self' => route('scores.index'),
            ],
        ];
    }
}
