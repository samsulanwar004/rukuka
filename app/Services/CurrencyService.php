<?php

namespace App\Services;

use App\ExchangeRate;
use App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class CurrencyService
{

    const TIME_OF_CACHE = 1440;

	public function getCurrentCurrency($lang = null)
	{   
        $lang = is_null($lang) ? $this->getLang() : $lang;
        // 1. United States of America
		if ($lang == 'en') {

            $cache = 'currency.usd.cache';
            if (Cache::has($cache)) {
                $currency = Cache::get($cache);
            } else {
                $currency = ExchangeRate::where('currency_code_to', 'usd')
                    ->orderBy('id', 'DESC')
                    ->first();
                if ($currency) {
                    $currency->symbol = '$';
                    $currency->currency_code_to = 'usd';
                }

                $expiresAt = Carbon::now()->addMinutes(self::TIME_OF_CACHE);

                Cache::put($cache, $currency, $expiresAt);
            }

        // 2. Japan
		} elseif ($lang == 'jp') {

            $cache = 'currency.jpy.cache';
            if (Cache::has($cache)) {
                $currency = Cache::get($cache);
            } else {
    			$currency = ExchangeRate::where('currency_code_to', 'jpy')
    		    	->orderBy('id', 'DESC')
    		    	->first();
    		    if ($currency) {
    		    	$currency->symbol = 'JPY';
    		    	$currency->currency_code_to = 'jpy';
    		    }

                $expiresAt = Carbon::now()->addMinutes(self::TIME_OF_CACHE);

                Cache::put($cache, $currency, $expiresAt);
            }

        // 3. Indonesia
		} elseif ($lang == 'id') {

            $cache = 'currency.idr.cache';
            if (Cache::has($cache)) {
                $currency = Cache::get($cache);
            } else {
                $currency = ExchangeRate::where('currency_code_to', 'idr')
                    ->orderBy('id', 'DESC')
                    ->first();
                if ($currency) {
                    $currency->symbol = 'IDR';
                    $currency->currency_code_to = 'idr';
                }

                $expiresAt = Carbon::now()->addMinutes(self::TIME_OF_CACHE);

                Cache::put($cache, $currency, $expiresAt);
            }

        // 4. Singapore
        }elseif ($lang == 'sg') {

            $cache = 'currency.sgd.cache';
            if (Cache::has($cache)) {
                $currency = Cache::get($cache);
            } else {
                $currency = ExchangeRate::where('currency_code_to', 'sgd')
                    ->orderBy('id', 'DESC')
                    ->first();
                if ($currency) {
                    $currency->symbol = 'SGD';
                    $currency->currency_code_to = 'sgd';
                }

                $expiresAt = Carbon::now()->addMinutes(self::TIME_OF_CACHE);

                Cache::put($cache, $currency, $expiresAt);
            }

        // 5. South Korea
        }elseif ($lang == 'kr') {

            $cache = 'currency.krw.cache';
            if (Cache::has($cache)) {
                $currency = Cache::get($cache);
            } else {
                $currency = ExchangeRate::where('currency_code_to', 'krw')
                    ->orderBy('id', 'DESC')
                    ->first();
                if ($currency) {
                    $currency->symbol = 'KRW';
                    $currency->currency_code_to = 'krw';
                }

                $expiresAt = Carbon::now()->addMinutes(self::TIME_OF_CACHE);

                Cache::put($cache, $currency, $expiresAt);
            }

        // 6. Canada
        }elseif ($lang == 'ca') {

            $cache = 'currency.cad.cache';
            if (Cache::has($cache)) {
                $currency = Cache::get($cache);
            } else {
                $currency = ExchangeRate::where('currency_code_to', 'cad')
                    ->orderBy('id', 'DESC')
                    ->first();
                if ($currency) {
                    $currency->symbol = 'CAD';
                    $currency->currency_code_to = 'cad';
                }

                $expiresAt = Carbon::now()->addMinutes(self::TIME_OF_CACHE);

                Cache::put($cache, $currency, $expiresAt);
            }

        // 7. Euro
        }elseif ($lang == 'eu') {

            $cache = 'currency.eur.cache';
            if (Cache::has($cache)) {
                $currency = Cache::get($cache);
            } else {
                $currency = ExchangeRate::where('currency_code_to', 'eur')
                    ->orderBy('id', 'DESC')
                    ->first();
                if ($currency) {
                    $currency->symbol = 'EUR';
                    $currency->currency_code_to = 'eur';
                }

                $expiresAt = Carbon::now()->addMinutes(self::TIME_OF_CACHE);

                Cache::put($cache, $currency, $expiresAt);
            }

        // 8. Malaysia
        }elseif ($lang == 'my') {

            $cache = 'currency.myr.cache';
            if (Cache::has($cache)) {
                $currency = Cache::get($cache);
            } else {
                $currency = ExchangeRate::where('currency_code_to', 'myr')
                    ->orderBy('id', 'DESC')
                    ->first();
                if ($currency) {
                    $currency->symbol = 'MYR';
                    $currency->currency_code_to = 'myr';
                }

                $expiresAt = Carbon::now()->addMinutes(self::TIME_OF_CACHE);

                Cache::put($cache, $currency, $expiresAt);
            }

        // 9. Brunei
        }elseif ($lang == 'bn') {

            $cache = 'currency.bnd.cache';
            if (Cache::has($cache)) {
                $currency = Cache::get($cache);
            } else {
                $currency = ExchangeRate::where('currency_code_to', 'bnd')
                    ->orderBy('id', 'DESC')
                    ->first();
                if ($currency) {
                    $currency->symbol = 'BND';
                    $currency->currency_code_to = 'bnd';
                }

                $expiresAt = Carbon::now()->addMinutes(self::TIME_OF_CACHE);

                Cache::put($cache, $currency, $expiresAt);
            }

        // 10. Hongkong
        }elseif ($lang == 'hk') {

            $cache = 'currency.hkd.cache';
            if (Cache::has($cache)) {
                $currency = Cache::get($cache);
            } else {
                $currency = ExchangeRate::where('currency_code_to', 'hkd')
                    ->orderBy('id', 'DESC')
                    ->first();
                if ($currency) {
                    $currency->symbol = 'HKD';
                    $currency->currency_code_to = 'hkd';
                }

                $expiresAt = Carbon::now()->addMinutes(self::TIME_OF_CACHE);

                Cache::put($cache, $currency, $expiresAt);
            }

        // 11. China
        }elseif ($lang == 'cn') {

            $cache = 'currency.cny.cache';
            if (Cache::has($cache)) {
                $currency = Cache::get($cache);
            } else {
                $currency = ExchangeRate::where('currency_code_to', 'cny')
                    ->orderBy('id', 'DESC')
                    ->first();
                if ($currency) {
                    $currency->symbol = 'CNY';
                    $currency->currency_code_to = 'cny';
                }

                $expiresAt = Carbon::now()->addMinutes(self::TIME_OF_CACHE);

                Cache::put($cache, $currency, $expiresAt);
            }
        }else {

            $cache = 'currency.usd.cache';
            if (Cache::has($cache)) {
                $currency = Cache::get($cache);
            } else {
    			$currency = ExchangeRate::where('currency_code_to', 'usd')
    		    	->orderBy('id', 'DESC')
    		    	->first();
    		    if ($currency) {
    		    	$currency->symbol = '$';
    		    	$currency->currency_code_to = 'usd';
    		    }

                $expiresAt = Carbon::now()->addMinutes(self::TIME_OF_CACHE);

                Cache::put($cache, $currency, $expiresAt);
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