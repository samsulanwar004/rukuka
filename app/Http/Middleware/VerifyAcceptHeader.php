<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAcceptHeader
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
        if($request->hasHeader('accept') && !$request->wantsJson()) {
            return response('Forbidden', 403);
        }
        
        return $next($request);
    }
}
