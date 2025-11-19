<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectMiddleware
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
        // dd("Fds");
        $getFullUrl = $request->url();
        $redirectGet = Redirect::where('old_url', $getFullUrl)->first();

        // Check if a matching redirect entry exists

        if ($redirectGet) {
            $getOldUrl = $redirectGet->old_url;
            $getNewUrl = $redirectGet->new_url;
            $getMethod = $redirectGet->method;
            return redirect($getNewUrl, $getMethod);
        }

        return $next($request);
    }
}
