<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        $path = $request->path();
        $userDesignationId = Auth::guard('Authorized')->user()->designation->id;
        $allowedUrls = [
            'Authorized/Client-Orders-List',
            'Authorized/Get-Client-Orders-List',
            'Authorized/Update-Client-Orders-info',
            'Trashed/Deleted-Research-Orders'

        ];
        if (in_array($path, $allowedUrls)) {
            if (!in_array($userDesignationId, [1, 9, 10, 11], true)) {
                abort(403);
            }
        } else if (!in_array($userDesignationId, [1, 2], true)) {
            abort(403);
        }

        // $EmployeeURL = [
        //     ''
        // ]

        return $next($request);
    }
}
