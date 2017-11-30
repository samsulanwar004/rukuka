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
            $result['status'] = $this->status('001');
            return $result;
        }
        $result['status'] = $result['status'] = $this->status('000');
        return $result;
    }

    public function getHelp($slug)
    {
        $result['page'] = Help::where('slug',$slug)->get();

        if(count($result['page']) == 0 ){
            $result['status'] = $this->status('001');
            return $result;
        }
        $result['status'] = $result['status'] = $this->status('000');
        return $result;
    }

    public function getPopup($slug)
    {
        $result['popup'] = Popup::where('slug',$slug)->get()->first();

        if(count($result['popup']) == 0 ){
            $result['status'] = $this->status('001');
            return $result;
        }
        $result['status'] = $result['status'] = $this->status('000');
        return $result;
    }

    public function status($code, $custom_msg = null)
    {
        switch ($code) {
            case '000':
                $msg = "Success";
                break;
            case '001':
                $msg = "No Result";
                break;
            default:
                $msg = "Unknown";
        }

        if ($msg != null)
        {
            $msg =  $msg . " " . $custom_msg;
        }

        return $response = array(
            'code' => $code ,
            'message' =>  $msg
        );

    }

}
