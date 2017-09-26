<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Exception;
use DB;
use App\Repositories\UserRepository;

class UserController extends BaseController
{
    protected $redirectAfterSave = '/account/detail';
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
            'phone_number' => 'required|string|max:255',
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

        	return redirect($this->redirectAfterSave)->with(['success' => 'Update successfully!']);
        } catch (Exception $e) {
        	DB::rollBack();

        	return back()->withErrors($e->getMessage());
        }
    }

}
