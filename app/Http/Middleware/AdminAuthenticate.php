<?php

namespace App\Http\Middleware;

use App\Services\TwoFactor\Authy;
use Closure;
use Illuminate\Http\Request;

class AdminAuthenticate
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
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.view.login');
        }
        $loginUser = auth()->guard('admin')->user();
        if ($loginUser->authy_approval_status != 'approved') {
            $authyApprovalStatus = $loginUser->authy_approval_status;
            if (!empty($loginUser->authy_approval_id)) {
                $res = $this->authy->getApprovalRequest($loginUser->authy_approval_id);
                if ($res->ok()) {
                    $authyApprovalStatus = $res->bodyvar("approval_request")->status;
                    if ($authyApprovalStatus=='approved') {
                        $loginUser->update([
                            'authy_approval_status' => $authyApprovalStatus
                        ]);
                        return $next($request);
                    } elseif ($authyApprovalStatus=='denied' || $authyApprovalStatus=='expired') {
                        $loginUser->update([
                            'authy_approval_id'     => '',
                            'authy_approval_status' => 'pending'
                        ]);
                        auth()->guard('admin')->logout();
                        session()->flash('error_message', "Your approval request has been $authyApprovalStatus");
                        return redirect()->route('admin.view.login');
                    }
                    $loginUser->update([
                        'authy_approval_status' => $authyApprovalStatus
                    ]);
                }
            }
            return response()->view('admin.waiting_approval',compact('authyApprovalStatus'));
        }
        return $next($request);
    }
}
