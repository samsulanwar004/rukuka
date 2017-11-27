<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nestable\NestableTrait;

class Category extends Model
{
	use NestableTrait;

    protected $parent = 'parent_product_categories_id';
    protected $table = 'product_categories';

    public function products()
    {
    	return $this->hasMany(Product::class, 'product_categories_id', 'id');
    }

    public function parent()
    {
    	return $this->belongsTo(Category::class, 'parent_product_categories_id');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_product_categories_id', 'id');
    }
}
