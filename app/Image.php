<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
    ];

    /**
     * Many to many relationship
     *
     * @return void
     */
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
