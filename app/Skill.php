<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model 
{
    use UsesTenantConnection;

    protected $table = 'skills';
    public $timestamps = true;
    protected $fillable = array('name');

    public function Projects()
    {
        return $this->belongsToMany('Project');
    }

}