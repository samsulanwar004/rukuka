<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lookbook extends Model
{
    protected $table = 'lookbooks';

    public function lookbookCollections()
    {
        return $this->hasMany(LookbookCollection::class, 'lookbooks_id', 'id')->where('is_active',1)->whereNull('deleted_at')->orderBy('order','ASC');
    }
}
