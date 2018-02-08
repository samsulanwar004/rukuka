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
		Mail::to($user->email)->send(new Activation($user));
	}

	public function sendForgotCode($user)
	{
		Mail::to($user->email)->send(new Forgot($user));
	}

	public function sendInvoiceUnpaid($order)
    {
        $exchange = (new CurrencyService)->getCurrentCurrency();
        //inject currency
        $order->order_subtotal_idr = $order->order_subtotal;
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

        Mail::to($order->user->email)->send(new InvoiceUnpaid($order));
    }

    public function sendInvoicePaid($order)
    {
        $exchange = (new CurrencyService)->getCurrentCurrency();
        //inject currency
        $order->order_subtotal_idr = $order->order_subtotal;
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

        Mail::to($order->user->email)->send(new InvoicePaid($order));
    }

    public function sendShipping($order)
    {
        $exchange = (new CurrencyService)->getCurrentCurrency();
        //inject currency
        $order->order_subtotal_idr = $order->order_subtotal;
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

        Mail::to($order->user->email)->send(new Shipping($order));
    }


}