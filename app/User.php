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

    /**
     * Create an user with role
     *
     * @param array $attributes
     */
    public static function create(array $attributes = [])
    {
        $user = new static($attributes);

        // Register as normal user
        $attributes['role'] = 3;

        // Save records in user table
        $user->save();

        // Add role to user
        $user->roles()->attach($attributes['role']);

        return $user;
    }
}
