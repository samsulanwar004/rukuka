<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Exception;

class BaseController extends Controller
{  

    protected function getUserActive()
    {
        if (session()->has('as.guest')) {
            $email = session()->get('as.guest')['email'];

            $user = (new \App\Repositories\UserRepository)->getUserByEmail($email);
            return $user ? $user : session()->forget('as.guest');
        }
        
    	return auth('web')->user();
    }

    /**
     * Validate the user request input data.
     *
     * @param  Request $request
     * @return \Illuminate\Validation\Validator
     */
    protected function validRequest(Request $request, $rules)
    {
        return Validator::make($request->all(), $rules);
    }

    protected function validDelete($value)
    {
        if($value->deleted_at != null)
        {
            throw new Exception("Page Not Found", 1);
        }
    }

    protected function validActive($value)
    {
        if($value->is_active == 0)
        {
            throw new Exception("Page Not Found", 1);
        }
    }

    protected function isCurlSupported() {
        if (in_array ('curl', get_loaded_extensions())) {
            return true;
        }
        else {
            return false;
        }
    }  

}
