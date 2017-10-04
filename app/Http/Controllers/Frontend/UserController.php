<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Exception;
use DB;
use App\Repositories\UserRepository;

class UserController extends BaseController
{
    protected $redirectAfterSaveProfile = '/account/detail';
    protected $redirectAfterSaveCC = '/account/cc';
    protected $redirectAfterSaveAddress = '/account/address';
    private $user;

    public function __construct(UserRepository $user)
    {
    	$this->user = $user;
    }

    public function index()
    {
    	$user = $this->getUserActive();

    	return view('users.index', compact('user'));
    }

    public function detail()
    {
    	$user = $this->getUserActive();

        return view('users.detail', compact('user'));
    }

    public function update(Request $request)
    {
    	$this->validate($request, [
    		'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|numeric|max:255',
        ]);

        try {
        	DB::beginTransaction();
        	$dob = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');
        	$user = $this->getUserActive();

        	$this->user
        		->setFirstName($request->input('first_name'))
        		->setLastName($request->input('last_name'))
        		->setPhone($request->input('phone_number'))
        		->setGender($request->input('gender'))
        		->setDob($dob)
        		->update($user->id);

        	DB::commit();

        	return redirect($this->redirectAfterSaveProfile)->with(['success' => 'Update successfully!']);
        } catch (Exception $e) {
        	DB::rollBack();

        	return back()->withErrors($e->getMessage());
        }
    }

    public function creditCard()
    {
    	$user = $this->getUserActive();

    	$cards = $user->creditCards;

    	$address = $user->address;

    	return view('users.credit_card', compact('user', 'cards', 'address'));
    }

    public function saveCreditCard(Request $request)
    {
    	$this->validate($request, [
    		'card_number' => 'required',
    		'expired_date' => 'required',
    		'name_card' => 'required|min:2|max:255'
    	]);

    	try {
    		DB::beginTransaction();

    		$user = $this->getUserActive();

    		$this->user
    			->setUser($user)
    			->persistCreditCard($request); 

    		DB::commit();
    		
    		return redirect($this->redirectAfterSaveCC)->with(['success' => 'Save credit card successfully!']);   		
    	} catch (Exception $e) {
    		DB::rollBack();

        	return back()->withErrors($e->getMessage());
    	}
    }

    public function address()
    {
    	$user = $this->getUserActive();

    	$address = $user->address;

    	return view('users.address', compact('user', 'address'));
    }

    public function saveAddress(Request $request)
    {
    	$this->validate($request, [
    		'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'postal' => 'required|numeric',
        ]);

        try {

        	DB::beginTransaction();

    		$user = $this->getUserActive();

    		$this->user
    			->setUser($user)
    			->persistAddress($request); 

    		DB::commit();
    		
    		return redirect($this->redirectAfterSaveAddress)->with(['success' => 'Save address book successfully!']);
        	
        } catch (Exception $e) {
        	DB::rollBack();

        	return back()->withErrors($e->getMessage());
        }
    }

    public function defaultCreditCard(Request $request)
    {
    	try {

        	DB::beginTransaction();

    		$user = $this->getUserActive();

    		$this->user
    			->setUser($user)
    			->defaultCreditCard($request); 

    		DB::commit();
    		
    		return redirect($this->redirectAfterSaveCC)->with(['success' => 'Save default credit card successfully!']);
        	
        } catch (Exception $e) {
        	DB::rollBack();

        	return back()->withErrors($e->getMessage());
        }
    }

    public function defaultAddress(Request $request)
    {
    	try {

        	DB::beginTransaction();

    		$user = $this->getUserActive();

    		$this->user
    			->setUser($user)
    			->defaultAddress($request); 

    		DB::commit();
    		
    		return redirect($this->redirectAfterSaveAddress)->with(['success' => 'Save default address successfully!']);
        	
        } catch (Exception $e) {
        	DB::rollBack();

        	return back()->withErrors($e->getMessage());
        }
    }

}
