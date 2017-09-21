<?php

namespace App\Repositories;

use App\User;
use DB;
use Exception;
use Carbon\Carbon;
use App\Services\EmailService;
use Illuminate\Support\Facades\Auth;

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
			(new EmailService)->sendActivationCode($user);
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
}