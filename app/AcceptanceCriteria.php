<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class AcceptanceCriteria extends Model 
{
    use UsesTenantConnection;

    protected $table = 'acceptance_criteria';
    public $timestamps = true;
    protected $guarded = [];
    protected $dates = [
        'completed_at',
        'created_at',
        'updated_at'
    ];

    public function Project()
    {
        return $this->belongsTo('App\Project');
    }

}