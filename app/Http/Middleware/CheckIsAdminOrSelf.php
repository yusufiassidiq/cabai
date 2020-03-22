<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckIsAdminOrSelf
{
    public function handle($request, Closure $next)
    {
        $requestedUserId = $request->route()->parameter('id');        
        if(
            Auth::user()->role === 1 ||
            Auth::user()->id == $requestedUserId
        ) {
            return $next($request);
        }        
        else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}
