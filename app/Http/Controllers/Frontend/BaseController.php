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

}
