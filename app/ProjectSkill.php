<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSkill extends Model 
{

    protected $table = 'project_skill';
    public $timestamps = true;
    protected $fillable = array('project_id', 'skill_id');

}