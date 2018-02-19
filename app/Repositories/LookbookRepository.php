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
            ->where('slug', $slug)
            ->first();
    }
}
