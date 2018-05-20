<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';
    public $timestamps = true;
    protected $fillable = array('user_id', 'project_id', 'created_at', 'updated_at');
}
