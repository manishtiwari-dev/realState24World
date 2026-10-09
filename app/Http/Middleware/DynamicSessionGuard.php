<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Config;

class DynamicSessionGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($request->is('admin/*')) {
            config(['session.cookie' => 'admin_session']);
        } elseif ($request->is('agentpanel/*')) {
            config(['session.cookie' => 'agent_session']);
        } elseif ($request->is('dealerpanel/*')) {
            config(['session.cookie' => 'dealer_session']);
        }

        return $next($request);
    }
}
