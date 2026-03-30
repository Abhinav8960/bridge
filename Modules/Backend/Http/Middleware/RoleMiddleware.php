<?php

namespace Modules\Backend\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {

        if (Auth::check()) {

            $user = Auth::user();
            foreach ($roles as $role) {
                // Check if user has the role This check will depend on how your roles are set up
                if ($user->role_id == $role)
                    return $next($request);
            }
        }
        return redirect()->route('backend.login');
    }
}
