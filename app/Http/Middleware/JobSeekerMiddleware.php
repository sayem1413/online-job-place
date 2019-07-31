<?php

namespace App\Http\Middleware;

use Closure;
use App\Enumeration\RoleTypes;
use Illuminate\Support\Facades\Auth;

class JobSeekerMiddleware
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
        if(Auth::check() && auth()->user()->role == RoleTypes::JOBSEEKER){
            return $next($request);
        }
        return redirect()->route('jobseeker_login_form');
    }
}
