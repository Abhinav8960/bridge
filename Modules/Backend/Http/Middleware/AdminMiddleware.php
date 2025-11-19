<?php

namespace Modules\Backend\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
            if (Auth::user()->role_id == User::ROLE_ADMIN) {
                return $next($request);
            } elseif (Auth::user()->role_id == User::ROLE_VENDOR) {
                return redirect()->route('institute.public');
            } 
            abort(403);
        }
        return redirect()->route('backend.login');

    }
}
