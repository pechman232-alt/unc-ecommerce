<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class SessionTimeOut
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected $session;
    protected $timeout;
    public function __construct(Store $session)
    {
        $this->session = $session;
        $this->timeout = config('session.lifetime') * 60; // Convert minutes to seconds
    }
    public function handle(Request $request, Closure $next)
    {
        if (time() - $this->session->get('lastActivityTime') > $this->timeout) {
            // Auth::logout();
            Auth('user')->logout();
            $request->session()->invalidate();
            return redirect()->route('admin-login')->with('error', 'Your session has expired. Please login again.');
        }
        $this->session->put('lastActivityTime', time());
        return $next($request);
    }
}
