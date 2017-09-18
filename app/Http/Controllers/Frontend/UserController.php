<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Exception;
use DB;
use App\Repositories\UserRepository;


class UserController extends BaseController
{
    protected $afterRegister = '/register';

    public function login()
    {
        return view('pages.login');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|same:confirmed',
            'confirmed' => 'required|string|min:6',
        ]);

        try {
            DB::beginTransaction();

            (new UserRepository)->setMediaSocialType('web')->create($request);

            DB::commit();

            return redirect($this->afterRegister)
                ->with(['success' => 'Registration successfully! Please, Check your email!']);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with(['errors' => 'Registration failed']);
        }
    }
}
