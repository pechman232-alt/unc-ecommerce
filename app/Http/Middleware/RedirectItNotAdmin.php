<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\Store;

class RedirectItNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard="user")
    {
        if(!auth()->guard($guard)->check()){
            return redirect('admin-login');
        }
        return $next($request);

        // if(!auth()->guard($guard)->check()){
        //     if (time() - $this->session->get('lastActivityTime') > $this->timeout) {
        //         // Auth::logout();
        //         Auth('user')->logout();
        //         $request->session()->invalidate();
        //         return redirect()->route('admin-login')->with('error', 'Your session has expired. Please login again.');
        //     }
        //     return redirect('admin-login');
        // }
        // $this->session->put('lastActivityTime', time());
        // return $next($request);
    }
}
