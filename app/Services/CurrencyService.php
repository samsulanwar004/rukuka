<?php

namespace App\Services;

use App\ExchangeRate;
use App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class CurrencyService
{

	public function getCurrentCurrency($lang = null)
	{
		if (App::isLocale('en') || $lang == 'en') {
		    $currency = ExchangeRate::where('currency_code_to', 'usd')
		    	->orderBy('id', 'DESC')
		    	->first();
		    $currency->symbol = '$';
		    $currency->currency_code_to = 'usd';

		} elseif (App::isLocale('jp') || $lang == 'jp') {
			$currency = ExchangeRate::where('currency_code_to', 'jpy')
		    	->orderBy('id', 'DESC')
		    	->first();
		    $currency->symbol = '¥';
		    $currency->currency_code_to = 'jpy';
		} else {
			$currency = ExchangeRate::where('currency_code_to', 'usd')
		    	->orderBy('id', 'DESC')
		    	->first();
		    $currency->symbol = '$';
		    $currency->currency_code_to = 'usd';
		}

		$result = new \stdClass();
		$result->symbol = isset($currency->symbol) ? $currency->symbol : 'IDR';
		$result->currency = isset($currency->currency_code_to) ? $currency->currency_code_to : 'idr';
		$result->value = isset($currency->conversion_value) ? $currency->conversion_value : '1';

		return $result;
	}

	public function setLang($lang)
	{
		if (array_key_exists($lang, Config::get('languages'))) {
            return Session::put('applocale', $lang);
        }
	}

	public function getLang()
	{
		return App::getLocale();
	}
}