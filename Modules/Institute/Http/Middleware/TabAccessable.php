<?php

namespace Modules\Institute\Http\Middleware;

use App\Models\Institute;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TabAccessable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $tab)
    {
        $institute =  Institute::where('id', Session::get('institute.id'))->first();
        if ($institute->package->$tab) {

            return $next($request);
        }
        abort(403);
    }
}
