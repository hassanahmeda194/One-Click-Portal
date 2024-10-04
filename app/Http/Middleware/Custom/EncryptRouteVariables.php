<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;

class EncryptRouteVariables
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $route = $request->route();
        $parameters = $route->parameters();

        foreach ($parameters as $key => $value) {
            if (is_string($value)) {
                $encryptedValue = Crypt::encryptString($value);
                $route->setParameter($key, urlencode($encryptedValue));
            }
        }

        return $next($request);
    }
}
