<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        if(Auth::check())
        {
            if(auth()->user()->tokenCan('server:admin'))
            {
                return $next($request);

            }

            return response()->json(['message'=>"Erişim red edildi. Yetkiniz yetersiz.",'status'=>403],403);
        }
        
        return response()->json(['message'=>"Lütfen giriş yapın",'status'=> 401],401);
        
    }
}
