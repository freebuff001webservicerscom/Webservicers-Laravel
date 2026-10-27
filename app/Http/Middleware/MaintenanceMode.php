<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    /**
     * When maintenance mode is enabled in Settings, the public site is taken
     * down with a branded 503 while the admin panel stays reachable.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        static $enabled = null;

        if ($enabled === null) {
            $enabled = Setting::enabled('maintenance_mode');
        }

        if ($enabled && ! $request->is('login', 'admin', 'admin/*', 'up', 'logout')) {
            return response()->view('maintenance', [], 503);
        }

        return $next($request);
    }
}
