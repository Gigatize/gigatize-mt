<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ScoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //get start date url parameter
        $start_date = $request->get('start_date');
        if($start_date){
            //parse start date parameter
            $start_date = Carbon::parse($start_date);
        }
        //get end url date parameter
        $end_date = $request->get('end_date');
        if($end_date){
            //parse end date parameter and
            $end_date = Carbon::parse($end_date);
        }

        return [
            'attributes'    => [
                'name' => (string)$this->first_name . " " . $this->last_name,
                'impact_score' => (string)$this->getEngagementScore($start_date,$end_date),
            ],
        ];
    }
}
