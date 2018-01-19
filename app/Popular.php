<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Popular extends Model
{
    protected $table = 'populars';

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'products_id')->where('is_active',1)->whereNull('deleted_at');
    }
}
