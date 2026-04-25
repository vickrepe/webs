<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AutoLoginDev
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! app()->isLocal()) {
            return $next($request);
        }

        $email = config('app.dev_auto_login');
        if (! $email || Auth::check()) {
            return $next($request);
        }

        $user = User::where('email', $email)->first();
        if ($user) {
            Auth::login($user);
        }

        return $next($request);
    }
}
