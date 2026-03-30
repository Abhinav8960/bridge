<?php

namespace Modules\Institute\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == User::ROLE_VENDOR) {
                return $next($request);
            } elseif (Auth::user()->role_id == User::ROLE_ADMIN) {
                return redirect()->route('backend.public');
            }
            abort(403);
        }
        return redirect()->route('institute.login');
    }
}
