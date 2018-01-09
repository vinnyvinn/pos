<?php

namespace App\Http\Middleware;

use Closure;

class CheckedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  $role
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! session()->has('stall_id')) {
            return redirect()->route('checkIn');
        }

        return $next($request);
    }
}
