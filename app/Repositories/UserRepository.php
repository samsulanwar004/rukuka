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

	private $socialMediaType;

	private $socialMediaId;

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

	public function create($request)
	{

		$dob = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');
		$verificationToken = strtolower(str_random(60));
		$verificationExpired = $this->date->addDay(self::EXPIRED_VERIFICATION_TOKEN_IN);

		
		$user = $this->model();
		$user->email = $request->input('email');
		$user->password = $request->input('password');
		$user->first_name = $request->input('first_name');
		$user->last_name = $request->input('last_name');
		$user->phone_number = $request->input('phone_number');
		$user->dob = $request->input('dob');
		$user->gender = $request->input('gender');
		$user->social_media_type = $this->getSocialMediaType();
		$user->social_media_id = $this->getSocialMediaId();
		$user->verification_token = $verificationToken;
		$user->verification_expired = $verificationExpired;

		if ($user->save()) {
			(new EmailService)->sendActivationCode($user);
		}


	}

	public function getUserByActivationCode($code)
	{
		return $this->model()
			->where('verification_token', $code)
			->where('is_verified', 0)
			->first();
	}

	public function setMediaSocialId($value)
	{
		$this->socialMediaId = $value;

		return $this;
	}

	public function getSocialMediaId()
	{
		return $this->socialMediaId;
	}

	public function setMediaSocialType($value)
	{
		$this->socialMediaType = $value;

		return $this;
	}

	public function getSocialMediaType()
	{
		return $this->socialMediaType;
	}

	public function auth($request)
	{
		return Auth::attempt([
            'email' => $request->input('email_login'), 
            'password' => $request->input('password_login'),
            'status' => 1,
            'is_verified' => 1,
        ], $request->input('remember'));
	}

	public function logout()
	{
		return Auth::logout();
	}
}