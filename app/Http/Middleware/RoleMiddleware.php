<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
//use App\Http\Middleware\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$roles): Response
    {  
        $roles = is_array($roles) ? $roles : explode(',', $roles);
       //$roles = ['user', 'admin']; 

        if (Auth::check() && in_array(Auth::user()->role, $roles)) {
            return $next($request); 
    }
    abort(403, 'Unauthorized action.');
    
}

}

