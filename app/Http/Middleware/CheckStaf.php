<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckStaf
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
        if (session()->has('role') && session('role') == 'staf') { // Check if session role exists and equals 'admin'
            return $next($request);
        }

        session()->flash('error', 'Anda tidak memiliki izin untuk mengakses halaman ini. Ini halaman staf'); // Flash error message
        return redirect()->back(); // Redirect to home page with error message
    }
}
