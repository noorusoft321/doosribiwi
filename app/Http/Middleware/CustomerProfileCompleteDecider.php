<?php

namespace App\Http\Middleware;
use App\Models\CustomerCareerInfo;
use App\Models\CustomerPersonalInfo;
use App\Models\CustomerReligionInfo;
use App\Models\CustomerSearch;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerProfileCompleteDecider
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
        if (auth()->guard('customer')->check()) {
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

            $customerCareerInfo = CustomerCareerInfo::where('CustomerID',$currentCustomer->id)->count();
            if ($customerCareerInfo==0) {
                session::flash('error_message', "Please add education info first thanks...!");
                return redirect()->route('education.form');
            }

            $customerPersonalInfo = CustomerPersonalInfo::where('CustomerID',$currentCustomer->id)->count();
            if ($customerPersonalInfo==0) {
                session::flash('error_message', "Please add Personal Information info first thanks...!");
                return redirect()->route('personal.form');
            }

            $customerReligionInfo = CustomerReligionInfo::where('CustomerID',$currentCustomer->id)->count();
            if ($customerReligionInfo==0) {
                session::flash('error_message', "Please add Religion info first thanks...!");
                return redirect()->route('religion.form');
            }

            $customerSearch = CustomerSearch::where('customerID',$currentCustomer->id)->count();
            if ($customerSearch==0) {
                session::flash('error_message', "Please add Expectations info first thanks...!");
                return redirect()->route('expectation.form');
            }

            if (empty($currentCustomer->image) || in_array($currentCustomer->image,['default-female.jpg','default-male.jpg','default-user.png'])){
                session::flash('error_message', "Please upload profile image...!");
                return redirect()->route('profile.image.form');
            }

        }
        return $next($request);
    }
}
