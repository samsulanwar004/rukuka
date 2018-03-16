<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Exception;

class UserController extends BaseApiController
{

    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

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

    public function subcriber(Request $request)
    {

        $rules = [
            'email' => 'required|string|email|max:255|unique:subcribers'
        ];

        $validation = $this->validRequest($request, $rules);
        if ($validation->fails()) {
            return $this->error($validation->errors(), 400, false);
        }

        try {
            $subcriber = $this->user
                ->setEmail($request->input('email'))
                ->subcriber()->toArray();

            return $this->success($subcriber, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

}
