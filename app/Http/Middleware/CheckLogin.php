<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // $adminUser = $request->session()->get('adminUser');
        // if (empty($adminUser))
        // {
        //     return redirect('/admin');
        // }else{
        //     return $next($request);
        // }
        return $next($request);
    }
}
