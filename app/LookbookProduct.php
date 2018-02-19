<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LookbookProduct extends Model
{
    protected $table = 'lookbook_products';

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

}
