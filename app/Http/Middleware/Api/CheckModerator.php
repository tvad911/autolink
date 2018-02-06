<?php

namespace App\Http\Middleware\Api;

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
        $group_id = \Auth::guard('api')->user()->group_id;

        if ($request->ajax() || $request->wantsJson()) {
            if($group_id == 1 || $group_id == 2){
                return $next($request);
            }
            else
            {
                return response()->json([
                    'message' =>'You can\'t access to resource!',
                    'data'    => null
                ], 403);
            }
        } else {
            return response('Unauthenticated.', 401);
        }
    }
}
