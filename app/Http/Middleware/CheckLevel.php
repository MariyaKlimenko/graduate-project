<?php

namespace App\Http\Middleware;

use Closure;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $level
     * @return mixed
     */
    public function handle($request, Closure $next, $level)
    {
        if ($request->user()->level() < $level) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
