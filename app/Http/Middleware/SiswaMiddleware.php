<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiswaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if(!Auth::check){
            return redirect()->route('show.admin.login')->with('error, silahkan login terlebih dahulu');
        }

        if(Auth::user()->role != 'admin'){
            abort(403, 'Akses ditolak, halaman ini khusus untuk siswa');
        }
        return $next($request);
    }
}
