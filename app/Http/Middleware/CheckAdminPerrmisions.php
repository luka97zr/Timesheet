<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class CheckAdminPerrmisions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role_id === Role::IS_ADMIN) {
            return $next($request);
        }
        abort(HttpFoundationResponse::HTTP_FORBIDDEN);
    }
}
