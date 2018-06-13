<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRelationshipResource extends JsonResource
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
            'achievements' => $this->when($this->relationLoaded('achievements'), function () {
                return (new UserAchievementsRelationshipResource($this->achievements))->additional(['user' => $this]);
            }),
            'comments' => $this->when($this->relationLoaded('comments'), function () {
                return (new UserCommentsRelationshipResource($this->comments))->additional(['user' => $this]);
            }),
            'followings' => $this->when($this->relationLoaded('followings'), function () {
                return (new UserFollowingsRelationshipResource($this->followings))->additional(['user' => $this]);
            }),
            'owned_projects' => $this->when($this->relationLoaded('OwnedProjects'), function () {
                return (new UserOwnedProjectsRelationshipResource($this->OwnedProjects))->additional(['user' => $this]);
            }),
            'projects' => $this->when($this->relationLoaded('project'), function () {
                return (new UserProjectsRelationshipResource($this->Projects))->additional(['user' => $this]);
            }),
            'skills' => $this->when($this->relationLoaded('skills'), function () {
                return (new UserSkillsRelationshipResource($this->Skills))->additional(['user' => $this]);
            }),
            'sponsored_projects' => $this->when($this->relationLoaded('SponsoredProjects'), function () {
                return (new UserSponsoredProjectsRelationshipResource($this->SponsoredProjects))->additional(['user' => $this]);
            }),
            'votes' => $this->when($this->relationLoaded('upvotes'), function () {
                return (new UserVotesRelationshipResource($this->upvotes))->additional(['user' => $this]);
            }),
        ];
    }
}
