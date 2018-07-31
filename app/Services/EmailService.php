<?php

namespace App\Services;

use App\Mail\Activation;
use App\Mail\Forgot;
use App\Mail\InvoiceUnpaid;
use App\Mail\InvoiceUnpaidBankTransfer;
use App\Mail\InvoiceUnpaidVirtualAccount;
use App\Mail\InvoicePaid;
use App\Mail\Shipping;
use App\Mail\NotificationInvoiceUnpaid;
use App\Mail\NotificationInvoicePaid;
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

        $mail = (new InvoiceUnpaid($order, $order->current_currency))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

        Mail::to($order->user->email)->queue($mail);
    }

    public function sendInvoiceUnpaidBankTransfer($order)
    {

        $mail = (new InvoiceUnpaidBankTransfer($order, $order->current_currency))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

        Mail::to($order->user->email)->queue($mail);
    }

    public function sendInvoiceUnpaidVirtualAccount($order,$response)
    {

        $mail = (new InvoiceUnpaidVirtualAccount($order, $order->current_currency, $response))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

        Mail::to($order->user->email)->queue($mail);
    }

    public function sendInvoicePaid($order)
    {

        $mail = (new InvoicePaid($order, $order->current_currency))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

        Mail::to($order->user->email)->queue($mail);
    }

    public function sendShipping($order)
    {

        $mail = (new Shipping($order, $order->current_currency))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

        Mail::to($order->user->email)->queue($mail);
    }

    public function sendNotificationInvoiceUnpaidToAdmin($order)
    {
        $mail = (new NotificationInvoiceUnpaid($order, $order->current_currency))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

        Mail::to(explode(',', config('common.notification.email')))->queue($mail);
    }

    public function sendNotificationInvoicePaidToAdmin($order)
    {
        $mail = (new NotificationInvoicePaid($order, $order->current_currency))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

        Mail::to(explode(',', config('common.notification.email')))->queue($mail);
    }


}