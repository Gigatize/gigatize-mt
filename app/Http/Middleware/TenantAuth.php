<?php

namespace App\Http\Middleware;

use Aacotroneo\Saml2\Facades\Saml2Auth;
use Closure;
use Hyn\Tenancy\Environment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class TenantAuth
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
        $tenancy = app(Environment::class);
        $hostname = $tenancy->hostname();
        if(session()->exists('auth_id')){
            dd(session()->get('auth_id'));
        }
        if ($this->auth()->guest())
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                //dd($hostname->auth_type);
                if($hostname->auth_type == 'oidc'){

                }elseif ($hostname->auth_type == 'saml'){
                    return Saml2Auth::login(URL::full());
                }else{
                    return redirect('/login');
                }
                //return redirect()->guest('auth/login');
            }
        }else if($hostname->auth_type == 'password' && Auth::user()->status == false) {
            return redirect('register/verify/resend')->with('success', 'Please check your email and activate your account');
        }
        return $next($request);
    }
}
