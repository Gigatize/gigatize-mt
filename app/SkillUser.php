<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillUser extends Model 
{

    protected $table = 'skill_user';
    public $timestamps = true;
    protected $fillable = array('skill_id', 'user_id');

}