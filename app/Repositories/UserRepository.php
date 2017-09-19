<?php

namespace App\Repositories;

use App\User;
use DB;
use Exception;
use Carbon\Carbon;

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
		$user->save();
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
}