<?php

namespace App\Services;

use App\Mail\Activation;
use App\Mail\Forgot;
use App\Mail\InvoiceUnpaid;
use App\Mail\InvoicePaid;
use App\Mail\Shipping;
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

	public function sendInvoiceUnpaid($order)
    {
        Mail::to($order->user->email)->send(new InvoiceUnpaid($order));
    }

    public function sendInvoicePaid($order)
    {
        Mail::to($order->user->email)->send(new InvoicePaid($order));
    }

    public function sendShipping($order)
    {
        Mail::to($order->user->email)->send(new Shipping($order));
    }


}