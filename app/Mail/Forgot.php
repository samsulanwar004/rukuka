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

        (new CurrencyService)->setLang($this->lang);

        return $this->markdown('emails.forgot', ['user' => $this->user])
            ->subject(trans('app.forgot_subject'));
    }
}
