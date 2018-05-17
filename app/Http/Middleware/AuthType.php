<?php

namespace App\Http\Middleware;

use Closure;
use Hyn\Tenancy\Environment;

class AuthType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $authType)
    {
        $tenancy = app(Environment::class);
        $hostname = $tenancy->hostname();
        //dd($authType);
        if($hostname->auth_type != $authType){
            return redirect('/');
        }else {
            return $next($request);
        }
    }
}
