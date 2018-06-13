<?php

namespace App;

use App\Notifications\ResetPassword;
use App\Traits\CanComment;
use App\Traits\Achiever;
use Hyn\Tenancy\Environment;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanVote;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use UsesTenantConnection;
    use Notifiable;
    use HasRoles;
    use HasApiTokens;
    use CanComment;
    use CanVote;
    use CanFollow;
    use Achiever;

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

    public function Projects()
    {
        return $this->belongsToMany('App\Project');
    }

    public function Skills()
    {
        return $this->belongsToMany('App\Skill');
    }

    public function SponsoredProjects(){
        return $this->belongsToMany('App\Project', 'project_sponsor')->withPivot('points');
    }
}
