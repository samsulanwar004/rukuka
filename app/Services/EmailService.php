<?php

namespace App\Services;

use App\Mail\Activation;
use App\Mail\Forgot;
use App\Mail\PersonalInformation;
use Illuminate\Support\Facades\Mail;

class EmailService
{
	public function sendActivationCode($user)
	{
		Mail::to($user->email)->send(new Activation($user));
	}

	public function sendForgotCode($user)
	{
		Mail::to($user->email)->send(new Forgot($user));
	}

	public function sendPersonalInformation($user)
	{
		Mail::to($user->email)->send(new PersonalInformation($user));
	}
}