<?php

namespace App\Http\Middleware;

use Closure;
use Hyn\Tenancy\Models\Customer;
use Illuminate\Support\Facades\Redirect;

class RedirectTenant
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
        $pieces = explode('.', $request->getHost());
        $customer = $pieces[0];
        //dd($customer);
        if(!Customer::where('name',$customer)->exists() and $pieces[0] != explode('.',config('app.url_base'))[0])
        {
            return Redirect::to('https://'.config('app.url_base'))->with('error','Unable to find specified host');
        }

        return $next($request);
    }
}
