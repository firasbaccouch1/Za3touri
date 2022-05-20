<?php

namespace App\Http\Middleware;

use App\Models\Users\banned;
use App\Models\Users\User;
use Closure;
use Illuminate\Http\Request;

class BannedMiddleware
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
       $users= User::where('ip_address',request()->ip())->with('banned')->get();
        foreach ($users as  $user) {
          if ($user->banned != null) {
            return redirect()->route('banned');
          }
        }
        return $next($request);
    }
}
