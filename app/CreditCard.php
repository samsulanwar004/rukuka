<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $table = 'credit_cards';

    public function user()
    {
    	return $this->belongsTo(User::class, 'users_id');
    }

    public function address()
    {
    	return $this->belongsTo(Address::class, 'address_id');
    }
}
