<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('customer')->check()) {
            return redirect()->away(route('view.login'), 301);
        }

        $currentCustomer = auth()->guard('customer')->user();
        if ($currentCustomer->profile_status == 2){
            auth()->guard('customer')->logout();
            session::flash('error_message', "Your account blocked / deleted please contact administration thanks");
            return redirect()->route('landing.page');
        }

        if ($currentCustomer->mobile_verified == 0 && $currentCustomer->email_verified == 0){
            session::flash('error_message', "Please verify your mobile number or email first");
            return redirect()->route('auth.verify');
        }

        return $next($request);
    }
}
