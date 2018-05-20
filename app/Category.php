<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{
    use UsesTenantConnection;

    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = array('name', 'icon_path');

    public function Projects()
    {
        return $this->hasMany('Project', 'category_id');
    }

}