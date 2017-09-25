<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{  

    public function getUserActive()
    {
    	return auth('web')->user();
    }

}
