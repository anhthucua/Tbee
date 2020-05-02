<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'sale_in_percent', 'sale_in_money', 'start_at', 'end_at', 'numbers'
    ];
}
