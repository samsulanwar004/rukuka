<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use Log;

class CheckOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking Orders expired';

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
        $now = Carbon::now();
        DB::table('orders')
            ->whereDate('expired_date', '<', $now->toDateString())
            ->where('payment_status',0)
            ->update(['payment_status' => 2,'order_status' => 3,'cancel_reason' => 'Payment Expired']);

        Log::info('Checking order expired');
    }
}
