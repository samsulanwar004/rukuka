<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Exception;
use DB;
use App\Repositories\UserRepository;
use App\Exceptions\SocialAuthException;
use App\Services\SocialMediaService;

class LoginController extends BaseController
{
	private $social;
	private $user;
    protected $redirectAfterRegister = '/login';
    protected $redirectAfterLogin = '/user/profile';

    public function __construct(SocialMediaService $social, UserRepository $user)
    {
    	$this->social = $social;
    	$this->user = $user;
    }

    public function showLoginPage()
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

            $dob = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');

            $this->user
            	->setSocialMediaType('web')
            	->setEmail($request->input('email'))
        		->setPassword($request->input('password'))
        		->setFirstName($request->input('first_name'))
        		->setLastName($request->input('last_name'))
        		->setPhone($request->input('phone_number'))
        		->setDob($dob)
        		->setGender($request->input('gender'))
            	->create();

            DB::commit();

            return redirect($this->redirectAfterRegister)
                ->with(['success' => 'Registration successfully! Please, Check your email!']);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with(['errors' => 'Registration failed']);
        }
    }
    

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email_login' => 'required|string|email|max:255|exists:users,email',
            'password_login' => 'required|string|min:6',
        ]);

        try {

            $auth = $this->user
            	->setEmail($request->input('email_login'))
            	->setPassword($request->input('password_login'))
            	->setRemember($request->input('remember'))
            	->auth();
            	
            if (!$auth) {
                throw new Exception("Login failed!", 1);     
            }
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return redirect($this->redirectAfterLogin)->with('success', 'Login successfully!');
    }

    public function logout()
    {
        $this->user->logout();

        return view('pages.landing')->withErrors(['success' => 'Logout successfully!']);
    }

    public function socialLogin($provider)
    {
        return $this->social->authenticate($provider);
    }
 
    public function socialLoginCallback($provider)
    {
        try {
            $this->social->login($provider);
            return redirect($this->redirectAfterLogin)->with('success', 'Login successfully!');
        } catch (SocialAuthException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
 
}
