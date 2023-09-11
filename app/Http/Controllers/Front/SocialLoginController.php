<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function socialLogin($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleSocialCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
            dd($user,$user->getEmail());
            $email = $user->getEmail();
            $firstName = $user->getName();
            $userName = str_replace(" ","-",$firstName);
            $userName = strtolower($userName);
            $userName = giveNewUserName($userName);
            $customer = Customer::where('deleted',0)->where('email',$email)->first();
            if (empty($customer)) {
                $customer = Customer::create([
                    'first_name'        => $firstName,
                    'name'              => $userName,
                    'email'             => $email,
                    'user_type'         => 3,
                    'profile_status'    => 1,
                    'email_verified_at' => date('Y-m-d'),
                    'email_verified'    => 1,
                    'status'            => 1
                ]);

                if (!empty($customer)) {
                    $data = [
                        'email'    => $email,
                        'customer' => $customer
                    ];
                    sendNewEmail('emails.welcome',$data,'Welcome - Shaadi.org.pk');
                }
            }

            if (!empty($customer)) {
                auth()->guard('customer')->attempt(['email' => $customer->email, 'password' => $userName]);
                session::flash('success_message', 'You are logged in successfully');
                return redirect()->route('landing.page');
            } else {
                session::flash('error_message', "You can't login via social platform, please register manually.");
                return redirect()->route('view.register');
            }

        } catch (\Exception $e) {
            session::flash('error_message', 'There is something wrong*');
            return redirect()->route('view.login');
        }
    }

}
