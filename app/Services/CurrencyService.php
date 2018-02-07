<?php

namespace App\Services;

use App\ExchangeRate;
use App;

class CurrencyService
{

	public function getCurrentCurrency()
	{
		if (App::isLocale('en')) {
		    $currency = ExchangeRate::where('currency_code_to', 'usd')
		    	->orderBy('id', 'DESC')
		    	->first();
		    $currency->currency_code_to = '$';

		} elseif (App::isLocale('jp')) {
			$currency = ExchangeRate::where('currency_code_to', 'jpy')
		    	->orderBy('id', 'DESC')
		    	->first();
		    $currency->currency_code_to = '¥';
		}

		$result = new \stdClass();
		$result->currency = isset($currency->currency_code_to) ? strtoupper($currency->currency_code_to) : 'IDR';
		$result->value = isset($currency->conversion_value) ? $currency->conversion_value : '1';

		return $result;
	}
}