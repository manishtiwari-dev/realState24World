<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class Check2FA
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (!Session::has('user_2fa')) {
        //     return redirect()->route('admin.2fa');
        // }
        // return $next($request);
        $guards = ['web','admin', 'agent', 'dealer'];
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
               $user = Auth::guard($guard)->user();
                 
                // $user = Auth::user();
                if ($user && $user->is_2fa_enable == 1 && !Session::has($guard . '_2fa_verified')) {
                    // Clear session if 2FA hasn't been completed
                   // Session::forget('user_2fa');
                    Session::forget($guard . '_2fa_verified');

                    return redirect()->route(getRolePrefix() . '2fa');
                }
                return $next($request);
            }
        }
    }
}
