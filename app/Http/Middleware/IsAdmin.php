<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Auth::user()->isAdmin());
        if (Auth::user()->isAdmin() == false) {
            return redirect(route("login"))->with("error", "Your Are not an admin");
            // abort(403, "Your Are not an admin");
        }
        return $next($request);
    }
}
