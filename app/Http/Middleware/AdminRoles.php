<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$role)
    {
    
        $roles = is_array($role)
        ? $role
        : explode('|', $role);  

        if (!Auth::guard('admin')->user()->hasAnyRole($roles)) {
            return redirect()->back()->with(notify_messages('Your Role not allowing to go there','warning'));
        }
        return $next($request);
    }
}
