<?php

namespace App\Http\Middleware;

use Closure;

class CheckModerator
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
        $group_id = \Auth::user()->group_id;
        if($group_id != 1 && $group_id != 2){
            return redirect()->route('admin.dashboard.index');
        }

        return $next($request);
    }
}
