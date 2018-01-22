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
        $result['page'] = Page::where('slug',$slug)->get();

        if(count($result['page']) == 0 ){
            abort(404);
        }
        return $result;
    }

    public function getHelp($slug)
    {
        $result['page'] = Help::where('slug',$slug)->get();

        if(count($result['page']) == 0 ){
            abort(404);
        }
        return $result;
    }

    public function getPopup($slug)
    {
        $result['popup'] = Popup::where('slug',$slug)->get()->first();

        if(count($result['popup']) == 0 ){
            abort(404);
        }

        return $result;
    }

}
