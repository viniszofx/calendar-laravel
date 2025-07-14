<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckBlocked
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_blocked) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'blocked' => 'Seu acesso foi suspenso pelo administrador. Entre em contato com o suporte.'
            ]);
        }
        return $next($request);
    }
}
