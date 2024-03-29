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
        if(isset($this->completed_at)){
            $completed_at  = (string)$this->completed_at->toDateTimeString();
        }else{
            $completed_at  = null;
        }

        return [
            'type'          => 'acceptance criteria',
            'id'            => (string)$this->id,
            'attributes'    => [
                'criteria' => (string)$this->criteria,
                'complete' => (boolean)$this->complete,
                'completed_at' => $completed_at,
                'created_at' => (string)$this->created_at->toDateTimeString(),
                'updated_at' => (string)$this->updated_at->toDateTimeString(),
            ],
            'links'         => [
                'self' => route('acceptance-criteria.show', ['acceptancecriteria' => $this->id]),
            ],
        ];
    }
}
