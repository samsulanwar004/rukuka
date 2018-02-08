<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class AsGuestMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!Auth::check() && !$request->session()->has('as.guest')) {
            session()->flash('as.checkout', 'ok');

            return redirect('login');
        }

        return $next($request);
    }
}
