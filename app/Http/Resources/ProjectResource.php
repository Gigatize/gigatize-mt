<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'type'          => 'projects',
            'id'            => (string)$this->id,
            'attributes'    => [
                'title' => (string)$this->title,
                'slug' => (string)$this->slug,
                'description' => (string)$this->description,
                'start_date' => (string)$this->start_date->toDateString(),
                'deadline' => (string)$this->deadline->toDateString(),
                'timezone' => (string)$this->timezone,
                'impact' => (string)$this->impact,
                'max_users' => (string)$this->max_users,
                'estimated_hours' => (string)$this->estimated_hours,
                'flexible_start' => (boolean)$this->flexible_start,
                'on_site' => (boolean)$this->on_site,
                'renew' => (boolean)$this->renew,
                'status' => (string)$this->status,
                'started' => (boolean)$this->started,
                'complete' => (boolean)$this->complete,
                'updated_at' => (string)$this->updated_at->toDateTimeString(),
                'created_at' => (string)$this->created_at->toDateTimeString(),
                'computed' => [
                    'sponsor_points' => $this->when($this->Sponsors()->exists(), function () {
                        return (string)$this->Sponsors()->sum('points');
                    }),
                    'total_points' => $this->when(true, function () {
                        if($this->Sponsors()->exists()) {
                            return (string)($this->Sponsors()->sum('points') + $this->estimated_hours);
                        }else{
                            return (string)$this->estimated_hours;
                        }
                    }),
                    'project_users' => (string)$this->Users()->count(),
                    'comments_count' => (string)$this->totalCommentCount(),
                    'upvotes_count' => (string)$this->upvoters()->count(),
                    'followers_count' => (string)$this->followers()->count(),
                ]
            ],
            'relationships' => $this->when($this->getRelations(), function() {
                return new ProjectRelationshipResource($this);
            }),
            'links'         => [
                'self' => route('projects.show', ['project' => $this->id]),
            ],
        ];
    }

    //public function with($request)
    //{
        /*return ['included' =>
            [
                new UserResource($this->Owner),
                new CategoryResource($this->Category),
                new LocationResource($this->Location),
                new UsersResource($this->Users),
                new SkillsResource($this->Skills),
                new AcceptanceCriteriaCollectionResource($this->AcceptanceCriteria),
            ]
        ];*/
    //}
}
