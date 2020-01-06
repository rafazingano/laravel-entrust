<?php

namespace ConfrariaWeb\Entrust\Middleware;

use Closure;

class CheckPermission
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
        //dd($request->route()->getName());
        //dd($request->user()->hasPermission($request->route()->getName()));
        abort_unless($request->user()->hasPermission($request->route()->getName()), 403);
        return $next($request);
    }
}
