<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $permission
     * @return Response|RedirectResponse
     */

    public function handle(Request $request, Closure $next, $permission): Response|RedirectResponse
    {
        $currentUser = Auth::guard('Authorized')->user();


        $modulePermissions = Cache::remember('module_permissions_' . $currentUser->Role_ID, now()->addDay(), function () use ($currentUser) {
            return DB::table('module_permissions')->where('Role_ID', $currentUser->Role_ID)->first();
        });
        

        $otherPermissions = Cache::remember('other_permissions_' . $currentUser->Role_ID, now()->addDay(), function () use ($currentUser) {
            return DB::table('other_permissions')->where('Role_ID', $currentUser->Role_ID)->first();
        });
        

        if ($modulePermissions && property_exists($modulePermissions, $permission) && $modulePermissions->$permission == 1) {
            return $next($request);
        }

        if ($otherPermissions && property_exists($otherPermissions, $permission) && $otherPermissions->$permission == 1) {
            return $next($request);
        }

        abort(403);
    }
}
