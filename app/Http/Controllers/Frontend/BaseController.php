<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{  

    protected function getUserActive()
    {
    	return auth('web')->user();
    }

}
