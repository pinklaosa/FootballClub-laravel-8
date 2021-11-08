<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IsAdmin
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
        if(session()->has('LoggedUser')){
            $type = DB::table('users')
                    ->where('id',session('LoggedUser'))
                    ->value('type');

            if($type == 'Coach'){
                return redirect('add');
            }
            else if($type == 'Player'){
                return redirect('member')->with('player','none');
            }
            else{
                return redirect('login');
            }
        }
        return $next($request);
    }
}
