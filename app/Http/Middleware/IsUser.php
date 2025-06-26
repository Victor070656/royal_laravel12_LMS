<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Auth::user()->isAdmin());
        if (Auth::user()->isUser() == false) {
            return redirect()->intended(route("login"))->with("error", "Your Are not Logged in as a Student");
            // abort(403, "Your Are not Logged in as an Instructor");
        }
        return $next($request);
    }
}
