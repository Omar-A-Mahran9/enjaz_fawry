<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuthKey
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
        // $token = $request->header('APP_KEY');
        
        // if($token != 'webStdy_2020_5'){
        //     return response()->json(['message' => 'App Key Error'] , 401);
        // }

        return $next($request);
    }
}
