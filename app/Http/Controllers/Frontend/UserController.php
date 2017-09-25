<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $redirectAfterSave = '/user';

    public function index()
    {
    	$user = $this->getUserActive();

    	return view('users.index', compact('user'));
    }

    public function profile()
    {
    	$user = $this->getUserActive();

        return view('users.profile', compact('user'));
    }

}
