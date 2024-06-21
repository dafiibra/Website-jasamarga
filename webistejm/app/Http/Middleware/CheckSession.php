<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user')) {
            return redirect()->route("login")->with('You need to login to access this page.');
        }

        return $next($request);
    }
}
