<?php
// app/Http/Middleware/CheckTokenExpiration.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckTokenExpiration
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $loginExpired = Carbon::parse($user->updated_at)->addHours(24)->isPast();

            if ($loginExpired) {
                Auth::logout();
                return redirect()->route('login')->withErrors(['session' => 'Your session has expired. Please log in again.']);
            }
        }

        return $next($request);
    }
}