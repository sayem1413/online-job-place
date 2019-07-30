<?php

namespace App\Http\Middleware;

use Closure;
use App\Enumeration\RoleTypes;

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
        if(auth()->user()->role == RoleTypes::JOBSEEKER){
            return $next($request);
        }
        return redirect(‘home’)->with(‘error’,'You have no access');
    }
}
