<?php

namespace Modules\Institute\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IsInstituteAccessibleMiddleware
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
        if (Session::has('institute.is_plan_expired') || Session::has('institute.status')) {

            if (Session::get('institute.is_plan_expired') == true || Session::get('institute.status') == false) {

                return abort(403);
            }
        }
        return $next($request);
    }
}
