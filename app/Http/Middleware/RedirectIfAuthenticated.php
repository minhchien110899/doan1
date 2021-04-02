<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if (Auth::guard($guard)->check()) {
        //     return redirect(RouteServiceProvider::HOME);
        // }

        if ($guard === 'admin' && Auth::guard($guard)->check()) {
            return redirect('/admin');
        } 
        if ($guard === 'inspector' && Auth::guard($guard)->check()) {
            if(Auth::guard($guard)->user()->status == 1){
                return redirect('/inspector');
            }else{
                Auth::guard($guard)->logout();
                return redirect('/inspector/login')->with('error', 'Tài khoản đã bị khóa. Xin hãy liên hệ với quản lý!');
            }


        } 
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
