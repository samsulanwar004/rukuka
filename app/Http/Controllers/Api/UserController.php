<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    public function wishlist(Request $request)
    {
    	try {
    		$user = $this->getUserActive();

    		$wishlists = $user->wishlists->toArray();

    		return $this->success($wishlists, 200, true);
    	} catch (Exception $e) {
    		return $this->error($e, 400, true);
    	}
    }
}
