<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\TwoFactor\Authy;

class ProfileController extends Controller
{
    protected $users;
    protected $authy;

    public function __construct(User $users, Authy $authy)
    {
        $this->users = $users;
        $this->authy = $authy;
    }

    public function registerAuthyUser()
    {
        $email = 'smawp786@gmail.com';
        $countryCode = '92';
        $mobileNumber = '3008237720';
        $register = $this->authy->register(
            $email,
            $mobileNumber,
            $countryCode
        );

        if ($register->ok()) {
            dd($register->id());
        } else {
            dd('Not found');
        }
    }

    public function sendNewRequest()
    {
        /* One time password */
        $response = $this->authy->sendToken(config('services.authy.id'));
        if ($response->ok()) {
            dd('Yes',$response);
        } else {
            dd('No',$response);
        }
    }

    public function verifyAuthToken($token)
    {
        $verfiy = $this->authy->verifyToken(config('services.authy.id'), $token);
        if ($verfiy->ok()) {
            dd('Verified successfully',$verfiy);
        } else {
            dd('Not verified',$verfiy);
        }
    }

    public function makeNewRequest()
    {
        $authyId = config('services.authy.id');
        $message = 'BDO username approval request for login';
        $options = [
            "details[username]" => "BDO Name",
            "details[email]" => "bdoemail@gmail.com"
        ];
        /*Send a request*/
        $response = $this->authy->createApprovalRequest($authyId,$message,$options);
        if ($response->ok()) {
            dd('Yes',$response->bodyvar("approval_request")->uuid);
        } else {
            dd('No',$response);
        }
    }

    public function checkRequestStatus($uuid)
    {
        $authyId = config('services.authy.id');
        $message = 'BDO username approval request for login';
        $options = [
            "details[username]" => "BDO Name",
            "details[email]" => "bdoemail@gmail.com"
        ];
        /*Send a request*/
        $response = $this->authy->getApprovalRequest($uuid);
        if ($response->ok()) {
            dd('Yes',$response->bodyvar("approval_request")->status);
        } else {
            dd('No',$response);
        }
    }

    public function enableTwoFactor(Request $request)
    {
        $user = auth()->user();

        $checkUser = User::where('authy_country_code', $request->get('country_code'))
            ->where('authy_phone', $request->get('phone_number'))
            ->first();

        if(is_null($checkUser)) {
            $register = $this->authy->register(
                $user->email,
                $request->get('phone_number'),
                $request->get('country_code')
            );

            if ($register->ok()) {
                $authyId = $register->id();

                $user->update([
                    'authy_status' => false,
                    'authy_id' => $authyId,
                    'authy_country_code' => $request->get('country_code'),
                    'authy_phone' => $request->get('phone_number')
                ]);
            } else {
                return redirect('profile')->with('authy_errors', $register->errors());
            }

        } else {
            $authyId = $checkUser->authy_id;
        }

        $this->authy->sendToken($authyId);

        return redirect('profile/two-factor/verification');
    }

    public function disableTwoFactor(Request $request)
    {
        $user = auth()->user();

        $user->update([
            'authy_status' => false
        ]);

        return redirect('profile')
            ->with('success',  __('Two factor authentication has been disabled.'));
    }

    public function getVerifyTwoFactor()
    {
        return view('profile.verify-two-factor');
    }

    public function postVerifyTwoFactor(Request $request)
    {
        $user = auth()->user();

        $verfiy = $this->authy->verifyToken($user->authy_id, $request->get('authy_token'));

        if ( $verfiy->ok() ) {
            $user->update(['authy_status' => 1]);

            return redirect('profile')
                ->with('success', __('Two factor authentication has been enabled.'));
        }

        return redirect('profile/two-factor/verification')
            ->with('errors', __('Invalid token. Please try again.'));
    }
}