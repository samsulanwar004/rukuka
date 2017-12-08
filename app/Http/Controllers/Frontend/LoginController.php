<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Exception;
use DB;
use App\Repositories\UserRepository;
use App\Exceptions\SocialAuthException;
use App\Services\SocialMediaService;
use Session;

class LoginController extends BaseController
{
	private $social;
	private $user;
    protected $redirectAfterRegister = '/login';
    protected $redirectAfterLogin = '/account';
    protected $redirectAfterForgot = '/forgot';

    public function __construct(SocialMediaService $social, UserRepository $user)
    {
    	$this->social = $social;
    	$this->user = $user;
    }

    public function showLoginPage()
    {
        $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $ref = rtrim($ref, '/');

        if ($ref != url('logout')) {
            Session::put('referrer', $ref);
        } else {
            Session::put('referrer', '/');
        }

        return view('pages.login');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
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
            	->create();

            DB::commit();

            return redirect($this->redirectAfterRegister)
                ->with(['success' => 'Registration successfully! Please, Check your email!']);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
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

        return redirect()->intended(Session::pull('referrer'))
            ->with('success', 'Login successfully!');
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
        } catch (SocialAuthException $e) {
            return back()->withErrors($e->getMessage());
        }

        return redirect()->intended(Session::pull('referrer'))
            ->with('success', 'Login successfully!');
    }

    public function activation($code)
    {
        try {
            $user = (new UserRepository)->getUserByActivationCode($code);

            if (!$user) {
                throw new Exception("Activation code not found!", 1);   
            }

            if ($user->verification_expired <= $this->date) {
                throw new Exception("Activation code expired!", 1);                
            }

            if ($user->is_verified >= 1) {
            	throw new Exception("Activation is verified!", 1);
            }

            $user->status = 1;
            $user->is_verified = 1;

            $user->update();
        } catch (Exception $e) {
            return view('pages.landing')->withErrors($e->getMessage());
        }

        return view('pages.landing')->withErrors(['success' => 'Activation successfully!']);
    }

    public function showForgotPage()
    {
    	return view('pages.password.forgot');
    }

    public function forgot(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required|string|email|max:255|exists:users,email'
    	]);

    	try {
    		$this->user
    		->setEmail($request->input('email'))
    		->forgot();

    		return redirect($this->redirectAfterForgot)->with('success', 'Forgot successfully! Please, check your email.');
    	} catch (Exception $e) {
    		return back()->withErrors($e->getMessage());
    	}
    }

    public function showResetPage($code)
    {
    	return view('pages.password.reset', compact('code'));
    }

    public function reset(Request $request)
    {
    	$this->validate($request, [
    		'token' => 'required|string',
    		'password' => 'required|string|min:6',
            'confirmed' => 'required|string|min:6|same:password',
       	]);

       	try {
       		$this->user
       			->setToken($request->input('token'))
       			->setPassword($request->input('password'))
       			->reset();

       		return redirect($this->redirectAfterRegister)->with('success', 'Reset password successfully!');

       	} catch (Exception $e) {
       		return back()->withErrors($e->getMessage());
       	}
    }
 
}
