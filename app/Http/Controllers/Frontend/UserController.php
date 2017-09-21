<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;


class UserController extends BaseController
{
    
    public function profile()
    {
        return view('users.profile');
    }

}
