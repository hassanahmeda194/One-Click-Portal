<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class SetIntervalSession
{
    public function handle($request, Closure $next)
    {
        Session::put('interval', 'true');

        return $next($request);
    }
    
}
