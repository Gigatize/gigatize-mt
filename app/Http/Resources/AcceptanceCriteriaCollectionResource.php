<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AcceptanceCriteriaCollectionResource extends JsonResource
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
            'acceptance-criteria' => AcceptanceCriteriaResource::collection($this)
        ];
    }
    public function with($request)
    {
        return [
            'links'    => [
                'self' => route('acceptance-criteria.index'),
            ],
        ];
    }
}
