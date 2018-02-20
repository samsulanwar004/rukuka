<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Order;
use App\Services\CurrencyService;

class InvoicePaid extends Mailable
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

        return $this->markdown('emails.invoice_paid', [
            'order' => $this->paid(),
        ])
            ->subject(trans('app.paid_subject'));
    }

    private function paid()
    {
        $order = $this->order;
        $currencyService = (new CurrencyService);

        $currencyService->setLang($this->lang);

        $exchange = $currencyService->getCurrentCurrency($this->lang);

        logger(serialize($this->lang));
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

        return $order;
    }
}
