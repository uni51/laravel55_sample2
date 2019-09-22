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
            // 認証区分がある場合は、その名称（「admin」「guest」）＋ '.top'をルート名とするURLにリダイレクトする
            // 認証区分の指定がない時（デフォルト時）は、'/' にリダイレクトさせている
            $route = ($guard) ? $guard.'.top' : '/';
            return redirect()->route($route);
        }

        return $next($request);
    }
}
