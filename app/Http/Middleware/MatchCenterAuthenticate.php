<?php

namespace App\Http\Middleware;

use App\Services\TwoFactor\Authy;
use Closure;
use Illuminate\Http\Request;

class MatchCenterAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    protected $authy;

    public function __construct(Authy $authy)
    {
        $this->authy = $authy;
    }

    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('match')->check()) {
            return redirect()->route('match.view.login');
        }
        return $next($request);
    }
}
