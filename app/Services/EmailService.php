<?php

namespace App\Services;

use App\Mail\Activation;
use Illuminate\Support\Facades\Mail;

class EmailService
{
	public function sendActivationCode($user)
	{
		Mail::to($user->email)->send(new Activation($user));
	}
}