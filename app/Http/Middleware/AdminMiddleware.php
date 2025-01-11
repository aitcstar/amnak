<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->role_id == 1 ||  Auth::user()->role_id == 0 && Auth::user()->active == 1) {
            return $next($request);
        }

            return redirect('home')->with('message','تم تعطيل الحساب يرجي التواصل مع الاداره');
        }


    //}
}
