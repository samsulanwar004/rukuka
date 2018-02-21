<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lookbook;

class LookbookRepository extends Controller
{
    public function getLookbook($slug)
    {
        return Lookbook::get()
            ->where('is_active',1)
            ->where('slug', $slug)
            ->first();
    }
}
