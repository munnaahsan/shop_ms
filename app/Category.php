<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id', 'name', 'slug', 'remarks'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id','id');
    }
}
