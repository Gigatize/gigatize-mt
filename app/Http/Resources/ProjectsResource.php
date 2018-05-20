<?php

namespace App\Http\Resources;

use App\AcceptanceCriteria;
use App\Category;
use App\Comment;
use App\Location;
use App\Skill;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectsResource extends ResourceCollection
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
            'data' => ProjectResource::collection($this->collection),
        ];
    }

    public function with($request)
    {
        return [
            'links'    => [
                'self' => route('projects.index'),
            ],
        ];
    }

}
