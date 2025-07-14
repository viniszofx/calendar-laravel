<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ForcePasswordChange
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->force_password_change) {
            if (!$request->is('password/change') && !$request->is('logout')) {
                return redirect()->route('password.change')->with('warning', 'Você precisa trocar sua senha.');
            }
        }
        return $next($request);
    }
}
