<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsAdmin
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role === 1) {
            return $next($request);
        }        
        else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}
