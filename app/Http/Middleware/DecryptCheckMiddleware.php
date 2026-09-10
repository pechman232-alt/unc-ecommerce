<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DecryptCheckMiddleware
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
        $id = $request->route('id');
        try {
            $decryptedId = Crypt::decrypt($id);
            if (!is_numeric($decryptedId) || $decryptedId <= 0) {
                return redirect()->route('pageNotfound');
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('pageNotfound');
        }

        return $next($request);
    }
}
