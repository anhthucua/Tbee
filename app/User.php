<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'phone', 'email', 'password', 'is_banned'
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
     * Many to many relationship
     *
     * @return void
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    /**
     * Check if user has role
     *
     * @param string $rolename
     * @return boolean
     */
    public function is($rolename)
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == $rolename)
            {
                return true;
            }
        }

        return false;
    }
}
