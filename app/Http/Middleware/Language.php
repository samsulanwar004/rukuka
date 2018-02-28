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

        if (Session::has('applocale') AND array_key_exists(Session::get('applocale'), Config::get('languages'))) {
            App::setLocale(Session::get('applocale'));
        }
        else { 
            $availableLangs = ['jp', 'en'];
            $ipService = (new IpAddressService);
            $ip = $ipService->getIpUser();
            $userLangs = strtolower($ipService->ipInfo($ip, "Country Code"));

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

}