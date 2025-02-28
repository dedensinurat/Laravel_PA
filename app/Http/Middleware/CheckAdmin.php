<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('role') && session('role') == 'admin') { // Check if session role exists and equals 'admin'
            return $next($request);
        }

        session()->flash('error', 'Anda tidak memiliki izin untuk mengakses halaman ini. Ini halaman admin.'); // Flash error message
        return redirect()->back(); // Redirect to home page with error message
    }
}
