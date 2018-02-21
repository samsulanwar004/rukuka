<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LookbookCollection extends Model
{
    protected $table = 'lookbook_collections';

    public function lookbookProducts()
    {
        return $this->hasMany(LookbookProduct::class, 'lookbook_collections_id', 'id');
    }
}
