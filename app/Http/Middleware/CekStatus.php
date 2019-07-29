<?php

namespace App\Http\Middleware;

use Closure;

class CekStatus
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
        $user = \App\User::where('email', $request->email)->first();
        if ($user->status == 'admin') {
            return redirect('admin/dashboard');
        } elseif ($user->status == 'mahasiswa') {
            return redirect('mahasiswa/dashboard');
        }

        return $next($request);
    }
}