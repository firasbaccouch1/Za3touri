<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next ,$permission)
    {       
        $route = Route::current()->getName();
        if (Auth::guard('admin')->user()->hasPermissionTo($permission)) {
            return $next($request);
        }if($route == "Trashed.delete" || $route == "Trashed.restore"){
            return response()->json([
                'status' => 401,
                'msg' => "you don't have permission"
            ]);
        }
        else{
         return redirect()->back()->with(notify_messages("You Don't Have Permission To Enter This Page",'error'));
        }
       
    }
}
