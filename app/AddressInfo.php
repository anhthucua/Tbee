<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressInfo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'address_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'address'
    ];
}
