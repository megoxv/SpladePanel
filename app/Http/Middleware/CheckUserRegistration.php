<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userRegistrationEnabled = (bool) getSetting('user_registration', true);

        if (! $userRegistrationEnabled) {
            return redirect()->route('login')->withErrors(['message' => 'User registration is currently disabled.']);
        }

        return $next($request); 
    }
}
