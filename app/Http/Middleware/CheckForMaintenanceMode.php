<?php 
namespace App\Http\Middleware;

use Request;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckForMaintenanceMode
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle($request, Closure $next)
    {
        if ($this->app->isDownForMaintenance() && !$this->ipIsWhiteListed())
        {
            throw new HttpException(503);
        }

        return $next($request);
    }

    private function ipIsWhiteListed()
    {
        $ip = Request::getClientIp();
        $allowed = explode(',', config('common.maintance_whitelist'));
        return in_array($ip, $allowed);
    }
}