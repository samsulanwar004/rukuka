<?php

namespace App\Repositories;

use App\User;
use App\CreditCard;
use App\Address;
use DB;
use Exception;
use Carbon\Carbon;
use App\Services\EmailService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

	private $email;

	private $password;

	private $socialMediaType;

	private $socialMediaId;

	private $firstName;

	private $lastName;

	private $phone;

	private $dob;

	private $gender;

	private $avatar;

	private $token;

	private $date;

	private $user;

	const EXPIRED_VERIFICATION_TOKEN_IN = 2;

	public function __construct()
	{
		$this->date = Carbon::now('Asia/Jakarta');
	}

	public function model()
	{
		return new User;
	}

	public function create()
	{

		$verificationToken = strtolower(str_random(60));
		$verificationExpired = $this->date->addDay(self::EXPIRED_VERIFICATION_TOKEN_IN);

		
		$user = $this->model();
		$user->email = $this->getEmail();
		$user->password = $this->getPassword();
		$user->first_name = $this->getFirstName();
		$user->last_name = $this->getLastName();
		$user->phone_number = $this->getPhone();
		$user->dob = $this->getDob();
		$user->gender = $this->getGender();
		$user->social_media_type = $this->getSocialMediaType();
		$user->social_media_id = $this->getSocialMediaId();
		$user->avatar = $this->getAvatar();
		$user->verification_token = $verificationToken;
		$user->verification_expired = $verificationExpired;

		if ($user->social_media_type != 'web') {
			$user->status = 1;
			$user->is_verified = 1;
		}

		if ($user->save() && $user->social_media_type == 'web') {
			$user->passwordString = $this->getPassword();
			$emailService = (new EmailService);
			$emailService->sendPersonalInformation($user);
			$emailService->sendActivationCode($user);
		}

		return $user;

	}

	public function getUserByActivationCode($code)
	{
		return $this->model()
			->where('verification_token', $code)
			->first();
	}

	public function setPassword($value)
	{
		$this->password = $value;

		return $this;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setEmail($value)
	{
		$this->email = $value;

		return $this;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setSocialMediaId($value)
	{
		$this->socialMediaId = $value;

		return $this;
	}

	public function getSocialMediaId()
	{
		return $this->socialMediaId;
	}

	public function setSocialMediaType($value)
	{
		$this->socialMediaType = $value;

		return $this;
	}

	public function getSocialMediaType()
	{
		return $this->socialMediaType;
	}

	public function setFirstName($value)
	{
		$this->firstName = $value;

		return $this;
	}

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function setLastName($value)
	{
		$this->lastName = $value;

		return $this;
	}

	public function getLastName()
	{
		return $this->lastName;
	}

	public function setPhone($value)
	{
		$this->phone = $value;

		return $this;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function setDob($value)
	{
		$this->dob = $value;

		return $this;
	}

	public function getDob()
	{
		return $this->dob;
	}

	public function setGender($value)
	{
		$this->gender = $value;

		return $this;
	}

	public function getGender()
	{
		return $this->gender;
	}

	public function setRemember($value)
	{
		$this->remember = $value;

		return $this;
	}

	public function getRemember()
	{
		return $this->remember;
	}

	public function setAvatar($value)
	{
		$this->avatar = $value;

		return $this;
	}

	public function getAvatar()
	{
		return $this->avatar;
	}

	public function setToken($value)
	{
		$this->token = $value;

		return $this;
	}

	public function getToken()
	{
		return $this->token;
	}

	public function auth($user = null)
	{
		return is_null($user) ?
		Auth::attempt([
            'email' => $this->getEmail(), 
            'password' => $this->getPassword(),
            'status' => 1,
            'is_verified' => 1,
        ], $this->getRemember()) :

        Auth::login($user, true);
	}

	public function logout()
	{
		return Auth::logout();
	}

	public function getUserByEmail($email)
	{
		return $this->model()
			->where('email', $email)
			->first();
	}

	public function forgot()
	{
		$user = $this->getUserByEmail($this->getEmail());

		$user->verification_token = strtolower(str_random(60));
		$user->verification_expired = $this->date->addHour();

		if ($user->update()) {
			(new EmailService)->sendForgotCode($user);
		}
	}

	public function reset()
	{
		$user = $this->getUserByActivationCode($this->getToken());

		if (!$user) {
            throw new Exception("Token code not found!", 1);   
        }

        if ($user->verification_expired <= $this->date) {
            throw new Exception("Token code expired!", 1);                
        }

		$user->password = $this->getPassword();

		$user->update();

	}

	public function update($id)
	{
		$user = $this->model()->where('id', $id)->first();
		$user->first_name = $this->getFirstName();
		$user->last_name = $this->getLastName();
		$user->phone_number = $this->getPhone();
		$user->dob = $this->getDob();
		$user->gender = $this->getGender();

		$user->update();
	}

	public function persistCreditCard($request, $id = null)
	{
		$cc = is_null($id) ? new CreditCard : $this->getCreditCardById($id);
		$cc->card_number = $request->input('card_number');
		$cc->expired_date = $request->input('expired_date');
		$cc->name_card = $request->input('name_card');

		if (is_null($id)) {
			$cc->user()->associate($this->getUser());
			$cc->address()->associate($request->input('address'));
		}

		$cc->save();
	}

	public function getCreditCardById($id)
	{
		return CreditCard::where('id', $id)
			->first();
	}

	public function setUser($value)
	{
		$this->user = $value;

		return $this;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function persistAddress($request, $id = null)
	{
		$address = is_null($id) ? new Address : $this->getAddressById($id);
		$address->first_name = $request->input('first_name');
		$address->last_name = $request->input('last_name');
		$address->company = $request->input('company');
		$address->address_line = $request->input('address_line');
		$address->city = $request->input('city');
		$address->province = $request->input('province');
		$address->postal = $request->input('postal');
		$address->country = $request->input('country');
		$address->phone_number = $request->input('phone_number');

		if (is_null($id)) {
			$address->user()->associate($this->getUser());
		}

		$address->save();
	}

	public function getAddressById($id)
	{
		return Address::where('id', $id)
			->first();
	}

	public function defaultCreditCard($request)
	{
		$ids = [];
		foreach ($request->input('default') as $key => $value) {
    		$ids[] = isset($key) ? $key : 0;
    	}

    	$user = $this->getUser();

    	$cc = new CreditCard;

    	$cc->where('users_id', $user->id)
			->whereNotIn('id', $ids)
			->update(array('is_default' => 0));

		$cc->where('users_id', $user->id)
			->whereIn('id', $ids)
			->update(array('is_default' => 1));
	}

	public function defaultAddress($request)
	{
		$ids = [];
		foreach ($request->input('default') as $key => $value) {
    		$ids[] = isset($key) ? $key : 0;
    	}

    	$user = $this->getUser();

    	$address = new Address;

    	$address->where('users_id', $user->id)
			->whereNotIn('id', $ids)
			->update(array('is_default' => 0));

		$address->where('users_id', $user->id)
			->whereIn('id', $ids)
			->update(array('is_default' => 1));
	}

	public function updatePassword($request)
	{
		
		$user = $this->getUser();

		if(Hash::check($request->input('old_password'), $user->password)){

	    	$user->password = $request->input('new_password');
	       	$user->update();
	    }else{

	       throw new Exception("The specified old password does not match the database password", 1);
	    }
	}
}