<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function user()
    {
    	return $this->belongsTo(User::class, 'users_id');
    }

    public function address()
    {
    	return $this->belongsTo(Address::class, 'shipping_id');
    }

    public function creditcard()
    {
    	return $this->belongsTo(CreditCard::class, 'payment_id');
    }
}
