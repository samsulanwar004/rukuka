<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EmailPaymentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:paymentReminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending Email Payment Reminder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

    }
}
