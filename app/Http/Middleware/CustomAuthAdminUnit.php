<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
class CustomAuthAdminUnit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         if(!Session::has('auth') || Session::has('auth') && session::get('auth')->status != 'AdminUnit'){
            abort(403, 'Unauthorized action.');

        }
        return $next($request);
    }
}