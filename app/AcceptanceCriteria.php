<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class AcceptanceCriteria extends Model 
{
    use UsesTenantConnection;

    protected $table = 'acceptance_criteria';
    public $timestamps = true;
    protected $fillable = array('project_id', 'criteria');

    public function Projects()
    {
        return $this->belongsTo('App\Project');
    }

}