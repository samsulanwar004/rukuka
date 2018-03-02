<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Order;
use App\Services\CurrencyService;

class InvoiceUnpaid extends Mailable
{
    use Queueable, SerializesModels;
    private $order;
    private $lang;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $lang)
    {
        $this->order = $order;
        $this->lang = $lang;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('emails.invoice_unpaid', [
            'order' => $this->unpaid(), 'locale' => $this->lang
        ])
            ->subject(trans('app.unpaid_subject',[], $this->lang))
            ->replyTo(config('mail.replyto.address'));
    }

    private function unpaid()
    {
        $order = $this->order;

        $exchange = (new CurrencyService)->getCurrentCurrency($this->lang);

        //inject currency
        $order->order_total_idr = $order->order_subtotal + $order->shipping_cost;
        $order->order_subtotal = $order->order_subtotal / $exchange->value;
        $order->shipping_cost = $order->shipping_cost / $exchange->value;
        $order->symbol = $exchange->symbol;

        $order->details = $order->details->map(function ($entry) use ($exchange){
            return [
              'product_name' =>  $entry['product_name'],
              'size'  =>  $entry->productStock->size,
              'qty' =>  $entry['qty'],
              'image' =>  $entry->productStock->product->images->first()->photo,
              'price' =>  $entry['price']/ $exchange->value,
            ];
        });

        return $order;
    }
}
