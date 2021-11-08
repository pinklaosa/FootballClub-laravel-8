<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('LoggedUser')) {
            return redirect('login')->with('fail', 'You must logged in');
        } 
        // else if (session()->has('LoggedUser')) {
        //     $type = DB::table('users')
        //         ->where('id', session('LoggedUser'))
        //         ->first();
        //     if ($type->type == 'Admin') {
        //         return redirect('register');
        //     } else {
        //         return redirect('member');
        //     }
        // }
        return $next($request);
    }
}
