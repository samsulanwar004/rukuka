<?php

namespace App\Repositories;

use App\ExchangeRate;
use DB;

class ExchangeRateRepository
{
    public function getExchangeRateAvailable()
    {
        return DB::table('exchange_rates')
            ->join('cms_users', function ($join) {
                $join->on('exchange_rates.cms_users_id', '=', 'cms_users.id');
            })->select('exchange_rates.*', 'cms_users.name as admin_name')
            ->orderby('id','desc')
            ->paginate(15);
    }

    public function getExchangeRateUnique()
    {
        return ExchangeRate::groupBy('currency_code_to')
            ->get();
    }
}
