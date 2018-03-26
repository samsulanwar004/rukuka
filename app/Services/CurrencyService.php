<?php

namespace App\Services;

use App\ExchangeRate;
use App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class CurrencyService
{

	public function getCurrentCurrency($lang = null)
	{   // 1. United States of America
		if (App::isLocale('en') || $lang == 'en') {
		    $currency = ExchangeRate::where('currency_code_to', 'usd')
		    	->orderBy('id', 'DESC')
		    	->first();
		    if ($currency) {
		    	$currency->symbol = '$';
		    	$currency->currency_code_to = 'usd';
		    }

        // 2. Japan
		} elseif (App::isLocale('jp') || $lang == 'jp') {
			$currency = ExchangeRate::where('currency_code_to', 'jpy')
		    	->orderBy('id', 'DESC')
		    	->first();
		    if ($currency) {
		    	$currency->symbol = 'JPY';
		    	$currency->currency_code_to = 'jpy';
		    }

        // 3. Indonesia
		} elseif (App::isLocale('id') || $lang == 'id') {
            $currency = ExchangeRate::where('currency_code_to', 'idr')
                ->orderBy('id', 'DESC')
                ->first();
            if ($currency) {
                $currency->symbol = 'IDR';
                $currency->currency_code_to = 'idr';
            }

        // 4. Singapore
        }elseif (App::isLocale('sg') || $lang == 'sg') {
            $currency = ExchangeRate::where('currency_code_to', 'sgd')
                ->orderBy('id', 'DESC')
                ->first();
            if ($currency) {
                $currency->symbol = 'SGD';
                $currency->currency_code_to = 'sgd';
            }

        // 5. South Korea
        }elseif (App::isLocale('kr') || $lang == 'kr') {
            $currency = ExchangeRate::where('currency_code_to', 'krw')
                ->orderBy('id', 'DESC')
                ->first();
            if ($currency) {
                $currency->symbol = 'KRW';
                $currency->currency_code_to = 'krw';
            }

        // 6. Canada
        }elseif (App::isLocale('ca') || $lang == 'ca') {
            $currency = ExchangeRate::where('currency_code_to', 'cad')
                ->orderBy('id', 'DESC')
                ->first();
            if ($currency) {
                $currency->symbol = 'CAD';
                $currency->currency_code_to = 'cad';
            }

        // 7. Euro
        }elseif (App::isLocale('eu') || $lang == 'eu') {
            $currency = ExchangeRate::where('currency_code_to', 'eur')
                ->orderBy('id', 'DESC')
                ->first();
            if ($currency) {
                $currency->symbol = 'EUR';
                $currency->currency_code_to = 'eur';
            }

        // 8. Malaysia
        }elseif (App::isLocale('my') || $lang == 'my') {
            $currency = ExchangeRate::where('currency_code_to', 'myr')
                ->orderBy('id', 'DESC')
                ->first();
            if ($currency) {
                $currency->symbol = 'MYR';
                $currency->currency_code_to = 'myr';
            }

        // 9. Brunei
        }elseif (App::isLocale('bn') || $lang == 'bn') {
            $currency = ExchangeRate::where('currency_code_to', 'bnd')
                ->orderBy('id', 'DESC')
                ->first();
            if ($currency) {
                $currency->symbol = 'BND';
                $currency->currency_code_to = 'bnd';
            }

        // 10. Hongkong
        }elseif (App::isLocale('hk') || $lang == 'hk') {
            $currency = ExchangeRate::where('currency_code_to', 'hkd')
                ->orderBy('id', 'DESC')
                ->first();
            if ($currency) {
                $currency->symbol = 'HKD';
                $currency->currency_code_to = 'hkd';
            }

        // 11. China
        }elseif (App::isLocale('cn') || $lang == 'cn') {
            $currency = ExchangeRate::where('currency_code_to', 'cny')
                ->orderBy('id', 'DESC')
                ->first();
            if ($currency) {
                $currency->symbol = 'CNY';
                $currency->currency_code_to = 'cny';
            }
        }else {
			$currency = ExchangeRate::where('currency_code_to', 'usd')
		    	->orderBy('id', 'DESC')
		    	->first();
		    if ($currency) {
		    	$currency->symbol = '$';
		    	$currency->currency_code_to = 'usd';
		    }
		}

		$result = new \stdClass();
		$result->symbol = isset($currency->symbol) ? $currency->symbol : 'IDR';
		$result->currency = isset($currency->currency_code_to) ? $currency->currency_code_to : 'idr';
		$result->value = isset($currency->conversion_value) ? $currency->conversion_value : '1';

		return $result;
	}

	public function getLang()
	{
		return App::getLocale();
	}
}