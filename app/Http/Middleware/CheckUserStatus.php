<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->estado == 0) {
            Auth::logout(); // Desconectamos al usuario si el estado es 0
            return redirect()->route('login');
        }
        return $next($request);
    }
}
