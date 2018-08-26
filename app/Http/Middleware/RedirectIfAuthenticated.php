<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            $userModel = Auth::user();

            if(in_array($userModel->role_id, [3,4]))
                return redirect('/cabinet');

            if($userModel->role_id == 1)
                return redirect('/admin');

        }

        return $next($request);
    }
}
