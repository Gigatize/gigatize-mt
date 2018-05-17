<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AcceptanceCriteriaResource extends JsonResource
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
            'type'          => 'acceptance criteria',
            'id'            => (string)$this->id,
            'attributes'    => [
                'criteria' => $this->criteria,
                'created_at' => $this->created_at->toDateTimeString(),
                'updated_at' => $this->updated_at->toDateTimeString(),
            ],
            'links'         => [
                'self' => route('acceptance-criteria.show', ['acceptancecriteria' => $this->id]),
            ],
        ];
    }
}
