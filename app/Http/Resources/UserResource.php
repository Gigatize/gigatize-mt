<?php

namespace App\Http\Resources;

use App\Project;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
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
            'type'          => 'user',
            'id'            => (string)$this->id,
            'attributes'    => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'job_title' => $this->job_title,
                'location' => $this->location,
                'picture' => secure_asset($this->picture),
                'followed_projects' => $this->followings(Project::class)->select('id')->orderBy('id')->pluck('id')->toArray(),
                'upvoted_projects' => $this->upvotes(Project::class)->select('id')->orderBy('id')->pluck('id')->toArray(),
                'created_at' => $this->created_at->toDateTimeString(),
                'updated_at' => $this->updated_at->toDateTimeString(),
            ],
            'relationships' => $this->when(($this->relationLoaded('achievements') or $this->relationLoaded('comments') or $this->relationLoaded('followings') or $this->relationLoaded('OwnedProjects') or $this->relationLoaded('projects') or $this->relationLoaded('skills') or $this->relationLoaded('upvotes')) or (($this->relationLoaded('roles') or $this->relationLoaded('permissions')) and Auth::user()->can('manage users') or ($this->relationLoaded('SponsoredProjects') and Auth::user()->can('sponsor project'))), function() {
                return new UserRelationshipResource($this);
            }),
            'links'         => [
                'self' => route('users.show', ['user' => $this->id]),
            ],
        ];
    }
}
