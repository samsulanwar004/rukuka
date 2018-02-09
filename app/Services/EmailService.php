<?php

namespace App\Services;

use App\Mail\Activation;
use App\Mail\Forgot;
use App\Mail\InvoiceUnpaid;
use App\Mail\InvoicePaid;
use App\Mail\Shipping;
use App\Services\CurrencyService;
use Illuminate\Support\Facades\Mail;

class EmailService
{
	public function sendActivationCode($user)
	{
        $mail = (new Activation($user))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

		Mail::to($user->email)->queue($mail);
	}

	public function sendForgotCode($user)
	{
        $mail = (new Forgot($user))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

		Mail::to($user->email)->queue($mail);
	}

	public function sendInvoiceUnpaid($order)
    {
        $exchange = (new CurrencyService)->getCurrentCurrency();
        //inject currency
        $order->order_total_idr = $order->order_subtotal + $order->shipping_cost;
        $order->order_subtotal = $order->order_subtotal / $exchange->value;
        $order->shipping_cost = $order->shipping_cost / $exchange->value;
        $order->symbol = $exchange->symbol;

        $order->details = $order->details->map(function ($entry) use ($exchange){
            return [
              'product_name' =>  $entry['product_name'],
              'qty' =>  $entry['qty'],
              'image' =>  $entry->productStock->product->images->first()->photo,
              'price' =>  $entry['price']/ $exchange->value,
            ];
        });

        $mail = (new InvoiceUnpaid($order))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

        Mail::to($order->user->email)->queue($mail);
    }

    public function sendInvoicePaid($order)
    {
        $exchange = (new CurrencyService)->getCurrentCurrency();
        //inject currency
        $order->order_total_idr = $order->order_subtotal + $order->shipping_cost;
        $order->order_subtotal = $order->order_subtotal / $exchange->value;
        $order->shipping_cost = $order->shipping_cost / $exchange->value;
        $order->symbol = $exchange->symbol;

        $order->details = $order->details->map(function ($entry) use ($exchange){
            return [
                'product_name' =>  $entry['product_name'],
                'qty' =>  $entry['qty'],
                'image' =>  $entry->productStock->product->images->first()->photo,
                'price' =>  $entry['price']/ $exchange->value,
            ];
        });

        $mail = (new InvoicePaid($order))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

        Mail::to($order->user->email)->queue($mail);
    }

    public function sendShipping($order)
    {
        $exchange = (new CurrencyService)->getCurrentCurrency();
        //inject currency
        $order->order_total_idr = $order->order_subtotal + $order->shipping_cost;
        $order->order_subtotal = $order->order_subtotal / $exchange->value;
        $order->shipping_cost = $order->shipping_cost / $exchange->value;
        $order->symbol = $exchange->symbol;

        $order->details = $order->details->map(function ($entry) use ($exchange){
            return [
                'product_name' =>  $entry['product_name'],
                'qty' =>  $entry['qty'],
                'image' =>  $entry->productStock->product->images->first()->photo,
                'price' =>  $entry['price']/ $exchange->value,
            ];
        });

        $mail = (new Shipping($order))
            ->onConnection(config('common.queue_active'))
            ->onQueue(config('common.queue_list.user_mail'));

        Mail::to($order->user->email)->queue($mail);
    }


}