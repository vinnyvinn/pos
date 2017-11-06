<?php

namespace App\Http\Middleware;

use Closure;

class Administrator
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
        if (!session()->has('stall_id')) {
            return redirect()->route('/');
        }
        return $next($request);
    }
}
