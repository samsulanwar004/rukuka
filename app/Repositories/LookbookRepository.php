<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lookbook;
use App\LookbookCollection;

class LookbookRepository extends Controller
{

    public function getLookbook()
    {
        return Lookbook::where('is_active','1')->whereNull('deleted_at')->get();
    }

    public function getLookbookCollection($lookbook_slug)
    {
        return Lookbook::get()
            ->where('is_active',1)
            ->where('slug', $lookbook_slug)
            ->first();
    }

    public function getLookbookProduct($collection_slug)
    {
        return LookbookCollection::get()
            ->where('slug', $collection_slug)
            ->where('is_active',1)
            ->first();
    }
}
