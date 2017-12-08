<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function category()
    {
    	return $this->belongsTo(Category::class, 'product_categories_id');
    }

    public function images()
    {
    	return $this->hasMany(ProductImage::class, 'products_id', 'id');
    }

    public function designer()
    {
    	return $this->belongsTo(Designer::class, 'product_designers_id');
    }

    public function stocks()
    {
    	return $this->hasMany(ProductStock::class, 'products_id', 'id');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'products_id', 'id')->where('is_approved',1)->orderBy('id','DESC')->take(3);
    }
}
