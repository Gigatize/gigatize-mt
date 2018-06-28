<?php

namespace App;

use App\Traits\Commentable;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Overtrue\LaravelFollow\Traits\CanBeVoted;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model 
{
    //use SearchableTrait;
    use HasSlug;
    use UsesTenantConnection;
    use Commentable;
    use CanBeVoted;
    use CanBeFollowed;

    protected $table = 'projects';
    public $timestamps = true;
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'deadline'
    ];
    protected $mustBeApproved = false;
    protected $vote = User::class;

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'title' => 10,
            'description' => 10,
            'impact' => 2,
            'additional_info' => 2,
            'users.email' => 1,
            'users.first_name' => 1,
            'users.last_name' => 1,
            'categories.name' => 1,
            'skills.name' => 5,
        ],
        'joins' => [
            'users' => ['projects.user_id','users.id'],
            'categories' => ['projects.category_id','categories.id'],
            'project_skill' => ['project_skill.project_id','projects.id'],
            'skills' => ['skills.id','project_skill.skill_id'],
        ],
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function Owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function Category()
    {
        return $this->belongsTo('App\Category');
    }

    public function Location()
    {
        return $this->belongsTo('App\Location');
    }

    public function Users()
    {
        return $this->belongsToMany('App\User');
    }

    public function AcceptanceCriteria()
    {
        return $this->hasMany('App\AcceptanceCriteria');
    }

    public function Skills()
    {
        return $this->belongsToMany('App\Skill');
    }

    public function Sponsors(){
        return $this->belongsToMany('App\User', 'project_sponsor')->withPivot('points');
    }

    /*
    |---------------------------------------------------------------|
    |Local Scopes
    |---------------------------------------------------------------|
    */
    public function scopeActive($query)
    {
        return $query->where('complete', false);
    }

    public function scopeByCategory($query, $categoryId){
        return $query->whereHas('categories', function($q) use ($categoryId){
            $q->where('id', $categoryId);
        });
    }


    /*
    |---------------------------------------------------------------|
    |Helper Methods
    |---------------------------------------------------------------|
    */
    public function isSponsored(){
        return $this->Sponsors()->exists();
    }

    public function getCompletePercent(){
        return round(($this->acceptanceCriteriaCompleteCount()/$this->acceptanceCriteriaCount())*100,2);
    }

    public function acceptanceCriteriaCount(){
        return $this->AcceptanceCriteria()->count();
    }

    public function acceptanceCriteriaCompleteCount(){
        return $this->AcceptanceCriteria()->where('complete',true)->count();
    }

    public function acceptanceCriteriaIncompleteCount(){
        return $this->AcceptanceCriteria()->where('complete',false)->count();
    }

}