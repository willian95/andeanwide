<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'identification', 'phone', 'lastname', 'country_id', 'agent_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['agent', 'country'];

    public function agent()
    {
        return $this->hasOne('App\Agent');
    }

    public function identity()
    {
        return $this->hasOne('App\Identity');
    }

    public function address()
    {
        return $this->hasOne('App\Address');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function getIsCompletedAttribute()
    {
        return !is_null($this->identity) && !is_null($this->address);
    }

    public function getVerificationLevelAttribute()
    {
        if($this->hasRole('user')){
            if($this->identity && $this->identity->verified_at){
                if($this->address && $this->address->verified_at){
                    return 2;
                }
                return 1;
            }
            return 0;
        }
        return null;
    }

    public function getHasPendingApprovalLevelAttribute()
    {
        if($this->hasRole('user')){
            if($this->identity && is_null($this->identity->verified_at)) {
                return true;
            } else if($this->address && is_null($this->address->verified_at)) {
                return true;
            }
            return false;
        }
        return null;
    }
}
