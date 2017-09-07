<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'product_categories';

    public function products()
    {
    	return $this->hasMany(Product::class, 'product_categories_id', 'id');
    }

    public function childs()
    {
    	return $this->hasMany(Category::class, 'parent_product_categories_id', 'id');
    }
}
