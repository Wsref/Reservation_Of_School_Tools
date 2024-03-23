<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->customAuthenticationCheck()) {
            return $next($request);
        }
    
        return redirect()->route('loginadmin');
    }

    protected function customAuthenticationCheck()
    {
        return session()->has('admin_id');
    }
}
