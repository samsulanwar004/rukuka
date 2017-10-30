<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcriber extends Model
{
    protected $table = 'subcribers';

    public function user()
    {
    	return $this->belongsTo(User::class, 'users_id');
    }
}
