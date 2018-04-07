<?php

namespace App\Services;

use App\Mail\Activation;
use App\Mail\Forgot;
use App\Mail\InvoiceUnpaid;
use App\Mail\InvoiceUnpaidBankTransfer;
use App\Mail\InvoicePaid;
use App\Mail\Shipping;
use App\Services\CurrencyService;
use Illuminate\Support\Facades\Mail;

class EmailService
{
	public function sendActivationCode($user)
	{
        $lang = (new CurrencyService)->getLang();
        $mail = (new Activation($user, $lang))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

		Mail::to($user->email)->queue($mail);
	}

	public function sendForgotCode($user)
	{
        $lang = (new CurrencyService)->getLang();
        $mail = (new Forgot($user, $lang))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

		Mail::to($user->email)->queue($mail);
	}

	public function sendInvoiceUnpaid($order)
    {

        $lang = (new CurrencyService)->getLang();
        $mail = (new InvoiceUnpaid($order, $lang))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

        Mail::to($order->user->email)->queue($mail);
    }

    public function sendInvoiceUnpaidBankTransfer($order)
    {

        $lang = (new CurrencyService)->getLang();
        $mail = (new InvoiceUnpaidBankTransfer($order, $lang))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

        Mail::to($order->user->email)->queue($mail);
    }

    public function sendInvoicePaid($order)
    {

        $lang = (new CurrencyService)->getLang();
        $mail = (new InvoicePaid($order, $lang))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

        Mail::to($order->user->email)->queue($mail);
    }

    public function sendShipping($order)
    {

        $mail = (new Shipping($order))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

        Mail::to($order->user->email)->queue($mail);
    }


}