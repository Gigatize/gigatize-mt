<?php

namespace App;

use App\Notifications\ResetPassword;
use Hyn\Tenancy\Environment;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use UsesTenantConnection;
    use Notifiable;
    use HasRoles;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'job_title', 'location', 'picture', 'password', 'status', 'activation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $tenancy = app(Environment::class);
        $hostname = $tenancy->hostname();
        $fqdn = $hostname->fqdn;
        $this->notify(new ResetPassword($token,$fqdn));
    }

    /*
   |---------------------------------------------------------------|
   |Accessors
   |---------------------------------------------------------------|
   */
    public function getPictureAttribute($value)
    {
        if(is_null($value)){
            return 'images/user.svg';
        }else{
            return $value;
        }
    }

    public function getName()
    {
        return $this->first_name . " " . $this->last_name;
    }

    /*
    |---------------------------------------------------------------|
    |Relationships
    |---------------------------------------------------------------|
    */
    public function OwnedProjects()
    {
        return $this->hasMany('App\Project', 'user_id');
    }

    /**
     * Get all of favorite posts for the user.
     */
    public function Favorites()
    {
        return $this->belongsToMany('App\Project', 'favorites', 'user_id', 'project_id')->withTimeStamps();
    }
}
