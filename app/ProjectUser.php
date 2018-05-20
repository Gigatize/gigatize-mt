<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model 
{

    protected $table = 'project_user';
    public $timestamps = true;
    protected $fillable = array('project_id', 'user_id');

}