<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Exception;
use DB;
use App\Repositories\UserRepository;
use App\Exceptions\SocialAuthException;
use App\Services\SocialMediaService;
use App\Services\BagService;
use Session;
use Illuminate\Routing\Route;

class LoginController extends BaseController
{
    const INSTANCE_SHOP = 'shopping';
	private $social;
	private $user;
    protected $redirectAfterLogin = '/account';
    protected $redirectAfterRegister = '/login';
    protected $redirectAfterForgot = '/forgot';
    protected $redirectAfterAsGuest = '/checkout';
    protected $redirectToHistory = '/account/history';

    public function __construct(SocialMediaService $social, UserRepository $user)
    {
    	$this->social = $social;
    	$this->user = $user;
    }

    public function showLoginPage(Request $request)
    {
        $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $ref = $ref === null ? rtrim($ref, '/') : $this->redirectAfterLogin;

        if (session()->has('as.checkout')) {
            $ref = url('checkout');
            session()->forget('as.checkout');
        }

        $ref = $request->has('return') ? $request->input('return') : $ref;

        $bag = (new BagService)->get(self::INSTANCE_SHOP);
        $checkout = count($bag) ? true : false; 

        return view('pages.login', compact('checkout', 'ref'));
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|same:confirmed',
            'confirmed' => 'required|string|min:6',
        ]);

        try {
            DB::beginTransaction();

            $userExist = $this->user->getUserByEmail($request->input('email'));

            if ($userExist) {
                if ($userExist->social_media_type == 'guest') {
                    $this->user
                        ->setSocialMediaType('web')
                        ->setEmail($request->input('email'))
                        ->setPassword($request->input('password'))
                        ->setFirstName($request->input('first_name'))
                        ->setLastName($request->input('last_name'))
                        ->update($userExist->id);
                } else {
                    throw new Exception("Your account has been registered. Please, login your account!", 1);  
                }
            } else {
                $this->user
                    ->setSocialMediaType('web')
                    ->setEmail($request->input('email'))
                    ->setPassword($request->input('password'))
                    ->setFirstName($request->input('first_name'))
                    ->setLastName($request->input('last_name'))
                    ->create();
            }

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
            //delete session as guest
            session()->forget('as.guest');

            $userExist = $this->user->getUserByEmail($request->input('email_login'));

            if (in_array($userExist->social_media_type, array('facebook', 'google'))) {
                throw new Exception("Your account has been registered by ".$userExist->social_media_type.". Please, login with ".$userExist->social_media_type, 1);
            }
            
            $auth = $this->user
            	->setEmail($request->input('email_login'))
            	->setPassword($request->input('password_login'))
            	->setRemember($request->input('remember'))
            	->auth();

            if (!$auth) {
                throw new Exception("The username and password you entered did not match our records. Please double-check and try again", 1);     
            } else {
                (new UserRepository)->updateLastLogin($this->getUserActive()->id);
            }
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        if ($request->input('return_url') == url('/') || $request->input('return_url') == url('logout') || $request->input('return_url') == url('login')) {
            return redirect($this->redirectAfterLogin)->with('success', 'Login successfully!');
        } elseif ($request->input('return_url') == url('tracking/order/result')) {
            return redirect($this->redirectToHistory)->with('success', 'Login successfully!');
        } else {
            return redirect($request->input('return_url'))->with('success', 'Login successfully!');
        }
        
    }

    public function logout()
    {
        $this->user->logout();

        return view('pages.landing')->withErrors(['success' => 'Logout successfully!']);
    }

    public function socialLogin($provider)
    {
        session()->put('as.checkout.social', request()->input('return_url'));

        return $this->social->authenticate($provider);
    }
 
    public function socialLoginCallback($provider)
    {
        try {
            $auth = $this->social->login($provider); 

            if ($auth) {
                (new UserRepository)->updateLastLogin($this->getUserActive()->id);
            }          
        } catch (SocialAuthException $e) {
            return back()->withErrors($e->getMessage());
        }

        $url = session()->get('as.checkout.social');
        session()->forget('as.checkout.social');
        
        if ($url == url('/') || $url == url('logout') || $url == url('login')) {
            return redirect($this->redirectAfterLogin)->with('success', 'Login successfully!');
        } else {
            return redirect($url)->with('success', 'Login successfully!');
        }
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

            $userExist = $this->user->getUserByEmail($request->input('email'));

            if (in_array($userExist->social_media_type, array('guest'))) {
                throw new Exception("Your account by ".$userExist->social_media_type.". Please, register with your ".$userExist->social_media_type." email", 1);
            } elseif (in_array($userExist->social_media_type, array('facebook', 'google'))) {
                throw new Exception("Your account by ".$userExist->social_media_type.". Please, login with ".$userExist->social_media_type, 1);
            }

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

    public function asGuest(Request $request)
    {
        $this->validate($request, [
            'email_guest' => 'required|string|email|max:255',
        ]);

        try {
            DB::beginTransaction();

            $userExist = $this->user->getUserByEmail($request->input('email_guest'));

            if ($userExist) {
                if ($userExist->social_media_type == 'guest') {

                    $userExist =  [
                        'id' => $userExist->id,
                        'email' => $userExist->email
                    ];

                    session()->put('as.guest', $userExist);
                } else {
                    throw new Exception("Your account has been registered. Please, login your account!", 1);  
                }
            } else {
                $guest = $this->user
                    ->setSocialMediaType('guest')
                    ->setEmail($request->input('email_guest'))
                    ->setPassword(strtolower(str_random(10)))
                    ->create(); 

                $guest = [
                    'id' => $guest->id,
                    'email' => $guest->email
                ];

                session()->put('as.guest', $guest);
            }         

            DB::commit();

            return redirect($this->redirectAfterAsGuest)
                ->with(['success' => 'As guest successfully! Please, finish your order!']);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
    }
 
}
