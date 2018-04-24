<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Dota2Auth
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

        $me = User::first();
        $user = $me->steamid;
        if ($user === '') {
            return redirect(route('blogHomeIndex'));
        }
        return $next($request);
    }
}
