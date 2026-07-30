<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\WebsiteUser;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentSessionId = Session::getId();

            // Check if the session ID stored in the database matches the current session ID
            if ($user->session_id !== $currentSessionId) {
                Auth::logout();
                return redirect()->route('websitelogin.submit')->with('error', 'Your session has expired. Please log in again.');
            }
        }

        return $next($request);
    }
}
