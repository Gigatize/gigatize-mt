<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SponsorsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'sponsors' => SponsorResource::collection($this),
        ];
    }
    public function with($request)
    {
        return [
            'links'    => [
                'self' => route('sponsors.index'),
            ],
        ];
    }
}
