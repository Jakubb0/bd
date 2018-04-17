<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;


class nie_admin
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
        $status = DB::table('pracownicy')->where('id', Auth::id())->pluck('status');
          
        if (Auth::check() && $status[0]=="kierownik" ) 
        {
            return $next($request);    
        }
        else
        {
            return redirect()->back();
        }
    }
}
