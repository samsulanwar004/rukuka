<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Language
{
    public function handle($request, Closure $next)
    {
        if (Session::has('applocale') AND array_key_exists(Session::get('applocale'), Config::get('languages'))) {
            App::setLocale(Session::get('applocale'));
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            $availableLangs = ['jp', 'en'];
            $userLangs = preg_split('/,|;/', $request->server('HTTP_ACCEPT_LANGUAGE'));

            foreach ($availableLangs as $lang) {
                if(in_array($lang, $userLangs)) {
                    App::setLocale($lang);
                    Session::put('applocale', $lang);
                    break;
                } 
            }

            //App::setLocale(Config::get('app.fallback_locale'));         
        }

        return $next($request);
    }
}