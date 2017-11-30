<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    public function order()
    {
    	return $this->belongsTo(Order::class, 'orders_id');
    }

    public function productStock()
    {
    	return $this->belongsTo(ProductStock::class, 'product_stocks_id');
    }
}
