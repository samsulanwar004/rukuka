<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\Help;
use App\Popup;

class PageRepository extends Controller
{
    public function getPage($slug)
    {
        $result = Page::where('slug',$slug)->first();
        return $result;
    }

    public function getHelp($slug)
    {
        $result = Help::where('slug',$slug)->first();
        return $result;
    }

    public function getPopup($slug)
    {
        $result = Popup::where('slug',$slug)->first();
        return $result;
    }

}
