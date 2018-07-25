<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlists';

    protected $casts = [
    	'content' => 'array'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'users_id');
    }

    public function stock()
    {
    	return $this->belongsTo(ProductStock::class, 'products_id');
    }
}
