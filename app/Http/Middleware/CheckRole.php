<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if ($role == 'author' && auth()->user()->role_id != 4) {
            return redirect()->back();
        }
        if ($role == 'editor' && auth()->user()->role_id != 5) {
            return redirect()->back();
        }

        if($role == 'admin' && auth()->user()->role_id != 1)
        {
            return redirect()->back();
        }

        return $next($request);
    }
}
