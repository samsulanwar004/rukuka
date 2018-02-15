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
		    $currency->symbol = '$';
		    $currency->currency_code_to = 'usd';

		} elseif (App::isLocale('jp')) {
			$currency = ExchangeRate::where('currency_code_to', 'jpy')
		    	->orderBy('id', 'DESC')
		    	->first();
		    $currency->symbol = '¥';
		    $currency->currency_code_to = 'jpy';
		}

		$result = new \stdClass();
		$result->symbol = isset($currency->symbol) ? $currency->symbol : 'IDR';
		$result->currency = isset($currency->currency_code_to) ? $currency->currency_code_to : 'idr';
		$result->value = isset($currency->conversion_value) ? $currency->conversion_value : '1';

		return $result;
	}

	public function setLang($lang)
	{
		return App::setLocale($lang);
	}

	public function getLang()
	{
		return App::getLocale();
	}
}