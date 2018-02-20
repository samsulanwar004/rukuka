<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Services\IpAddressService;

class Language
{
    public function handle($request, Closure $next)
    {
Session::forget('applocale');
        if (Session::has('applocale') AND array_key_exists(Session::get('applocale'), Config::get('languages'))) {
            App::setLocale(Session::get('applocale'));
        }
        else { 
            $availableLangs = ['jp', 'en'];
            $ip = $this->getIpUser();
            $userLangs = strtolower((new IpAddressService)->ipInfo($ip, "Country Code"));

            if (in_array($userLangs, $availableLangs)) {
                foreach ($availableLangs as $lang) {
                    if($lang == $userLangs) {
                        App::setLocale($lang);
                        Session::put('applocale', $lang);
                        break;
                    } 
                }
            } else {
                $lang = Config::get('app.fallback_locale');
                App::setLocale($lang);
                Session::put('applocale', $lang);
            }   
     
        }

        return $next($request);
    }

    private function getIpUser()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }
}