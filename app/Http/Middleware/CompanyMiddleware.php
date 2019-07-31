<?php

namespace App\Http\Middleware;

use Closure;
use App\Enumeration\RoleTypes;
use Illuminate\Support\Facades\Auth;

class CompanyMiddleware
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
        if(Auth::check() && auth()->user()->role == RoleTypes::COMPANY){
            return $next($request);
        }
        return redirect()->route('company_login_form');
    }
}
