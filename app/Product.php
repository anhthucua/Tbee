<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supplier_id', 'category_level2_id', 'image_id', 'name',
        'description', 'price', 'sale_price', 'stock'
    ];

    /**
     * Many to many relationship
     *
     * @return void
     */
    public function images()
    {
        return $this->belongsToMany('App\Image');
    }

    /**
     * Many to one relationship
     *
     * @return void
     */
    public function categoryLvl2()
    {
        return $this->belongsTo('App\CategoryLvl2', 'category_level2_id');
    }
}
