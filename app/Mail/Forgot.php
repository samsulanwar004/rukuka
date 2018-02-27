<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Services\CurrencyService;

class Forgot extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $lang;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $lang)
    {
        $this->user = $user;
        $this->lang = $lang;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('emails.forgot', ['user' => $this->user, 'locale' => $this->lang])
            ->subject(trans('app.forgot_subject', null, $this->lang));
    }
}
