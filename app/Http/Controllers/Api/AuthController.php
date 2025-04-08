<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerOtherInfo;
use App\Models\CustomerPersonalInfo;
use App\Rules\Adult;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login()
    {
        $request = request()->all();
        $rules = [
            'email'    => 'required|email|max:255|exists:shaadi_customers,email',
            'password' => 'required|max:30'
        ];
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Email and password fields is required',
                'errors'  => $validator->errors()
            ], 200);
        }

        $customer = Customer::select(
            'id',
            'first_name',
            'last_name',
            'name',
            'image',
            'email',
            'password',
            'mobile',
            'profile_pic_client_status',
            'profile_pic_status',
            'email_verified'
        )->with([
            'getCitySlug',
            'getCountrySlug',
            'getCountryName',
            'getStateName',
            'getCitiesName'
        ])->whereEmail($request['email'])->where('deleted',0)->first();
        if (!empty($customer) && Hash::check($request['password'], $customer->password)) {
            auth()->login($customer);
            $customer->accessToken = 'Bearer '.auth()->user()->createToken('doosri-biwi-api-token')->plainTextToken;
            $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'na').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'na').'-'.$customer->id;
            $baseUrl = config('services.app_url');
            $customer->profile_link = $baseUrl.'/'.$uniqueProfileSlug;
            $customer->profileComplete = checkProfileComplete($customer->id);
            $customer->makeHidden([
                'getCitySlug',
                'getCountrySlug',
                'assign_user_name',
                'assign_lead_user_name',
                'match_assign_user_name',
                'match_assign_lead_user_name',
                'email_verified',
                'profile_pic_status',
                'profile_pic_client_status',
                'faker_id',
                'un_seen_messages_count',
                'image'
            ]);
            $imageFullPath = $baseUrl.'/customer-images/'.$customer->image;
            $customer = $customer->toArray();
            $customer['imageFullPath'] = $imageFullPath;

            return response()->json([
                'success' => true,
                'message' => 'Customer has been login successfully.',
                'data'    => $customer
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Credentials does not match.',
            'errors'  => []
        ], 200);
    }

    public function signUp()
    {
        $request = request()->all();
        $rules = [
            'gender'                 => 'required|numeric|in:1,2',
            'first_name'             => 'required|max:255',
            'last_name'              => 'required|max:255',
            'mobile'                 => 'required',
            'mobile_country_code'    => 'required|min:1',
            'country_id'             => 'required|numeric|exists:shaadi_countries,id',
            'state_id'               => 'required|numeric|exists:shaadi_states,id',
            'city_id'                => 'required|numeric|exists:shaadi_cities,id',
            'dob'                    => ['required','date_format:Y-m-d', new Adult],
            'email'                  => 'required|email|max:255|unique:shaadi_customers,email',
            'password'               => 'required|min:6',
            'registration_reason_id' => 'required|numeric|exists:shaadi_registrations_reasons,id',
            'marital_status'         => 'required|numeric|exists:shaadi_marital_statuses,id'
        ];
        if (!empty($request['last_name'])) {
            $rules['last_name'] = 'required|max:255';
        }
        if (isset($request['city_id']) && !empty($request['city_id']) && in_array($request['city_id'], [551,748,1,592,591,594,552])) {
            $rules['area_id'] = 'required|numeric|exists:shaadi_areas,id';
        }
        $validator = Validator::make($request, $rules);
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'errors'  => $validator->errors()
            ], 200);
        }

        $userName = $request['first_name'].' '.$request['last_name'];
        $userName = str_replace(" ","-",$userName);
        $userName = strtolower($userName);
        $userName = giveNewUserName($userName);

        DB::beginTransaction();
        try {
            $request['name']                   = $userName;
            $request['password']               = Hash::make($request['password']);
            $request['status']                 = 1;
            $request['profile_status']         = 1;
            $request['user_type']              = 3;
            if ($request['gender']==1) {
                $request['image'] = 'default-male.jpg';
                $request['second_marraige'] = 1;
            } else {
                $request['image'] = 'default-female.jpg';
                $request['second_marraige'] = 2;
            }
            $request['DOB']                    = $request['dob'];
            $request['RegistrationsReasonsID'] = $request['registration_reason_id'];
            $request['MaritalStatusID']        = $request['marital_status'];

            $newCustomer = Customer::create($request);
            if (!empty($newCustomer)) {
                $request['RegistrationID'] = $newCustomer->id;
                $request['dob_date'] = date('d',strtotime($request['DOB']));
                $request['dob_month'] = date('m',strtotime($request['DOB']));
                $request['dob_year'] = date('Y',strtotime($request['DOB']));
                $request['age'] = date("Y") - $request['dob_year'];
                CustomerOtherInfo::create($request);

                $request['CustomerID'] = $newCustomer->id;
                $request['CountryOfOrigin'] = $request['country_id'];
                $request['StateOfOrigin'] = $request['state_id'];
                $request['CityOfOrigin'] = $request['city_id'];
                $request['MaritalStatus'] = $request['marital_status'];
                CustomerPersonalInfo::create($request);

                $data = [
                    'email'     => $newCustomer->email,
                    'code'      => base64_encode($newCustomer->email)
                ];

                sendNewEmail('emails.confirmation',$data,'Confirm Account - DoosriBiwi.com');

                DB::commit();
                $customer = Customer::select(
                    'id',
                    'first_name',
                    'last_name',
                    'name',
                    'image',
                    'email',
                    'password',
                    'mobile',
                    'profile_pic_client_status',
                    'profile_pic_status',
                    'email_verified'
                )->with([
                    'getCitySlug',
                    'getCountrySlug',
                    'getCountryName',
                    'getStateName',
                    'getCitiesName'])
                    ->findOrFail($newCustomer->id);
                auth()->login($customer);
                $customer->accessToken = 'Bearer '.auth()->user()->createToken('doosri-biwi-api-token')->plainTextToken;
                $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'na').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'na').'-'.$customer->id;
                $baseUrl = config('services.app_url');
                $customer->profile_link = $baseUrl.'/'.$uniqueProfileSlug;
                $customer->profileComplete = checkProfileComplete($customer->id);
                $customer->makeHidden([
                    'getCitySlug',
                    'getCountrySlug',
                    'assign_user_name',
                    'assign_lead_user_name',
                    'match_assign_user_name',
                    'match_assign_lead_user_name',
                    'email_verified',
                    'profile_pic_status',
                    'profile_pic_client_status',
                    'faker_id',
                    'un_seen_messages_count',
                    'image'
                ]);
                $imageFullPath = $baseUrl.'/customer-images/'.$customer->image;
                $customer = $customer->toArray();
                $customer['imageFullPath'] = $imageFullPath;

                return response()->json([
                    'success'  => true,
                    'message' => 'Customer has been registered successfully.',
                    'data'    => $customer
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success'  => false,
                'message' => 'Customer has not been registered.',
                'errors'  => $e->getMessage()
            ], 200);
        }
    }

    public function forgetPassword()
    {
        $request = request()->all();
        if (isset($request['email']) && !empty($request['email'])) {
            $customer = Customer::where([
                'email'   => $request['email'],
                'deleted' => 0
            ])->first();
            if (empty($customer)) {
                return response()->json([
                    'success'  => false,
                    'message' => 'Email address does not exists.',
                    'errors'  => []
                ], 200);
            }
            $messageData = array(
                'code'  => base64_encode($customer->email),
                'email' => $customer->email
            );

            $res = sendNewEmail('emails.password_reset',$messageData,'Password Reset - DoosriBiwi.com');
            if (!empty($res)) {
                return response()->json([
                    'success'  => true,
                    'message' => 'Please check your email. We have sent you a link to reset your password. Thanks.',
                    'data'    => []
                ], 200);
            }
        }
        return response()->json([
            'success'  => false,
            'message' => 'Email field is required.',
            'errors'  => []
        ], 200);
    }

    public function resetPassword()
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'hash_id'          => 'required',
            'password'         => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'errors'   => $validator->errors()
            ], 200);
        }
        $customer = Customer::where('email',base64_decode($request['hash_id']))->first();
        if (!empty($customer)) {
            $res = $customer->update([
                'password'       => Hash::make($request['password']),
                'profile_status' => 1,
                'status'         => 1
            ]);
            if (!empty($res)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your password has been updated successfully, now you can log in thanks',
                    'data'    => []
                ], 200);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Customer does not exists.',
            'errors'  => []
        ], 200);
    }

}
