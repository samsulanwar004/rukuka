<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceUnpaid extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $order;
    private $detail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$order,$detail)
    {
        $this->user = $user;
        $this->order = $order;
        $this->detail = $detail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invoice_unpaid', [
            'user' => $this->user,
            'order' => $this->order,
            'detail' => $this->detail
        ])
            ->subject('Invoice Unpaid');
    }
}
