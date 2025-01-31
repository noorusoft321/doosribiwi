<?php

namespace App\Http\Controllers\Api;

use App\helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Models\AnnualInCome;
use App\Models\Area;
use App\Models\AreYouRevert;
use App\Models\Caste;
use App\Models\City;
use App\Models\Complexion;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerChatting;
use App\Models\CustomerFamilyInfo;
use App\Models\CustomerNotificationPreference;
use App\Models\CustomerOtherInfo;
use App\Models\CustomerResidentialInfo;
use App\Models\Disability;
use App\Models\DoYouHaveBeard;
use App\Models\DoYouKeepHalal;
use App\Models\DoYouPerformSalaah;
use App\Models\DoYouPreferHijab;
use App\Models\Education;
use App\Models\EyeColor;
use App\Models\FamilyValue;
use App\Models\FuturePlan;
use App\Models\HairColor;
use App\Models\Height;
use App\Models\HobbiesAndInterest;
use App\Models\IAmLookingToMarry;
use App\Models\JobPost;
use App\Models\MajorCourse;
use App\Models\MaritalStatus;
use App\Models\MotherTongue;
use App\Models\MyBuild;
use App\Models\MyLivingArrangement;
use App\Models\Occupation;
use App\Models\Package;
use App\Models\RegistrationsReason;
use App\Models\Religion;
use App\Models\ResidenceStatus;
use App\Models\Sect;
use App\Models\Smoke;
use App\Models\State;
use App\Models\SupportMessage;
use App\Models\University;
use App\Models\Weight;
use App\Models\WillingToRelocate;
use App\Rules\Adult;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;

class HomeController extends Controller
{
    public function profile()
    {
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
            'profile_gallery_client_status',
            'email_verified',
            'package_id',
            'user_package',
            'age_verification',
            'education_verification',
            'location_verification',
            'meeting_verification',
            'nationality_verification',
            'mobile_verified',
            'salary_verification'
        )
            ->with([
                'getCitySlug',
                'getCountrySlug',
                'getCountryName',
                'getStateName',
                'getCitiesName',
                'customerOtherInfo',
                'customerPersonalInfo',
                'customerReligionInfo'
            ])
            ->findOrFail(auth()->id());
        $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'na').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'na').'-'.$customer->id;
        $baseUrl = env('APP_URL');
        $customer->profile_link = $baseUrl.'/'.$uniqueProfileSlug;
        $customer->packageType = (!empty($customer->package_id) && $customer->package_id > 0) ? $customer->user_package : 'Free';
        $messagesLimit = checkMessageLimit($customer->id,true);
        $customer->directMessages = $messagesLimit[0];
        $customer->remainMessages = $messagesLimit[1];
        $customer->isSoialSignIn = (empty($customer->password)) ? true : false;
        $customer->profileComplete = checkProfileComplete($customer->id);
        $customer->unread_messages_count = CustomerChatting::where('receiver_id', $customer->id)->where('message_status',1)->where('deleted',0)->count();
        $customer->makeHidden([
            'getCitySlug',
            'getCountrySlug',
            'assign_user_name',
            'assign_lead_user_name',
            'match_assign_user_name',
            'match_assign_lead_user_name',
            'faker_id',
            'image'
        ]);
        $imageFullPath = $baseUrl.'/customer-images/'.$customer->image;
        $customerArr = $customer->toArray();
        $customerArr['imageFullPath'] = $imageFullPath;

        $customerArr['customerFormProgress'] = checkProfileCompletePercent($customer);
        unset(
            $customerArr['customer_other_info'],
            $customerArr['customer_personal_info'],
            $customerArr['customer_religion_info']
        );

        return response()->json([
            'success'  => true,
            'message' => 'Profile has been fetched successfully.',
            'data'    => $customerArr
        ], 200);
    }

    public function sendConfirmationEmail()
    {
        $customer = Customer::findOrFail(auth()->id());
        if (!empty($customer) && $customer->email_verified == 1) {
            return response()->json([
                'success'  => false,
                'message' => 'Already verified please reload the page to proceed thanks',
                'data'    => []
            ], 200);
        }

        $data = [
            'email'    => $customer->email,
            'code'     => base64_encode($customer->email),
            'customer' => $customer
        ];

        $isEmailSent = sendNewEmail('emails.confirmation',$data,'Confirm Account - DoosriBiwi.com');
        if (!empty($isEmailSent)) {
            return response()->json([
                'success'  => true,
                'message' => 'Confirmation email has been sent to your email address',
                'data'    => []
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Confirmation email has not been sent.',
            'errors'  => []
        ], 200);
    }

    public function confirmCustomerAccount()
    {
        $verificationToken = request()->verification_token;
        $email = base64_decode($verificationToken);
        $customer = Customer::where('email', $email)->where('deleted', 0)->first();
        if (!empty($customer) && $customer->id == auth()->id()) {
            if ($customer->status == 1 && $customer->email_verified == 1) {
                return response()->json([
                    'success'  => true,
                    'message' => 'Your email verified already please login...!',
                    'data'    => []
                ], 200);
            }
            $customer->update([
                'status' => 1,
                'email_verified' => 1,
                'email_verified_at' => date('Y-m-d')
            ]);
            return response()->json([
                'success'  => true,
                'message' => 'Your email address has been verified successfully',
                'data'    => []
            ], 200);
        }

        return response()->json([
            'success'  => false,
            'message' => 'Your email address has not been verified',
            'errors'    => []
        ], 200);

    }

    public function updateDeviceToken()
    {
        $request = request()->all();
        $rules = [
            'deviceToken' => 'required'
        ];
        $validator = Validator::make($request, $rules);
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Device token is required.',
                'errors'    => []
            ], 200);
        }
        $customer = Customer::findOrFail(auth()->id());
        $customer->update([
            'device_token' => $request['deviceToken']
        ]);
        return response()->json([
            'success'  => true,
            'message' => 'Device token has been updated successfully.',
            'data'    => $customer
        ], 200);
    }

    public function getAllData()
    {
        return response()->json([
            'success'  => true,
            'message' => 'Data has been fetched successfully.',
            'data'    => [
                'gender' => [
                    [
                        'id' => 1,
                        'name' => 'Male'
                    ],
                    [
                        'id' => 2,
                        'name' => 'Female'
                    ]
                ],
                'countries'           => Country::select('id','name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'qualifications'      => Education::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'professions'         => Occupation::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'monthlyIncomes'      => AnnualInCome::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'religions'           => Religion::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'castes'              => Caste::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'tongues'             => MotherTongue::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'maritalStatus'       => MaritalStatus::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'livingArrangements'  => MyLivingArrangement::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'heights'             => Height::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'disabilities'        => Disability::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'registrationReasons' => RegistrationsReason::select('id','title as name')->where('deleted',0)->orderBy('order_at','asc')->get()
            ]
        ], 200);
    }

    public function getStates($countryId=null)
    {
        if (!empty($countryId) && is_numeric($countryId)) {
            $data = State::select('id','title as name','country_id')->where('country_id',$countryId)->where('deleted', 0)->orderBy('order_at','asc')->get();
            return response()->json([
                'success'  => true,
                'message' => 'States has been fetched successfully.',
                'data'    => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Please first select country.',
                'errors'    => []
            ], 200);
        }
    }

    public function getCities($stateId=null)
    {
        if (!empty($stateId) && is_numeric($stateId)) {
            $data = City::select('id','title as name','state_id')->where('state_id',$stateId)->where('deleted', 0)->orderBy('order_at','asc')->get();
            return response()->json([
                'success'  => true,
                'message' => 'Cities has been fetched successfully.',
                'data'    => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Please first select state.',
                'errors'    => []
            ], 200);
        }
    }

    public function getAreas($cityId)
    {
        if (!empty($cityId) && is_numeric($cityId)) {
            $data = Area::select('id','title as name')->where([
                'city_id' => $cityId,
                'deleted'  => 0
            ])->orderBy('title','asc')->get();
            return response()->json([
                'success'  => true,
                'message' => 'Areas has been fetched successfully.',
                'data'    => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Please first select state.',
                'errors'    => []
            ], 200);
        }
    }

    public function getSects($religionId=null)
    {
        if (!empty($religionId) && is_numeric($religionId)) {
            $data = Sect::select('id','title as name','religions_id')->where('religions_id',$religionId)->where('deleted', 0)->orderBy('order_at','asc')->get();
            return response()->json([
                'success'  => true,
                'message' => 'Sects has been fetched successfully.',
                'data'    => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Please first select religion.',
                'errors'    => []
            ], 200);
        }
    }

    public function getMajorCourses($educationId=null)
    {
        if (!empty($educationId) && is_numeric($educationId)) {
            $data = MajorCourse::select('id','title')->where([
                'education_id' => $educationId,
                'deleted'      => 0
            ])->orderBy('order_at','asc')->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Major course has been fetched successfully.',
                'data'    => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Please first select education.',
                'errors'    => []
            ], 200);
        }
    }

    public function contactUs()
    {
        $request = request()->all();
        $rules = [
            'name'    => 'required|max:255',
            'email'   => 'required|max:255',
            'mobile'  => 'required|max:255',
            'message' => 'required|max:255'
        ];
        $validator = Validator::make($request, $rules);
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'errors'    => $validator->errors()
            ], 200);
        }
        $data = $request;
        $data['your_name'] = $data['name'];
        $data['your_number'] = $data['mobile'];
        $data['your_message'] = $data['message'];
        $data['your_email'] = 'admin@shaadi.org.pk';
        $data['email'] = 'admin@shaadi.org.pk';

        /* It will work on production */
        sendNewEmail('emails.elite_matrimonial_email',$data,'Elite Matrimony Consultant - LEAD - DoosriBiwi.com');

        return response()->json([
            'success'  => true,
            'message' => 'Contact form has been submitted successfully.',
            'data'    => []
        ], 200);
    }

    public function getProfileInfo()
    {
        $data = [
            'customerData' => [
                "first_name"      => "",
                "last_name"       => "",
                "country_id"      => "",
                "state_id"        => "",
                "city_id"         => "",
                "area_id"         => "",
                "post_zip_code"   => "",
                "DOB"             => "",
                "MaritalStatusID" => "",
                "address"         => ""
            ],
            'formData' => [
                'countries'     => Country::select('id','name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'maritalStatus' => MaritalStatus::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get()
            ]
        ];

        $currentAuthId = auth()->id();
        $customer = Customer::with('customerOtherInfo')->where('id', $currentAuthId)->first();
        if (!empty($customer)) {
            $data['customerData']['first_name'] = $customer->first_name;
            $data['customerData']['last_name'] = $customer->last_name;
            if (!empty($customer->customerOtherInfo)) {
                $data['customerData']['country_id'] = (int) $customer->customerOtherInfo->country_id;
                $data['customerData']['state_id'] = (int) $customer->customerOtherInfo->state_id;
                $data['customerData']['city_id'] = (int) $customer->customerOtherInfo->city_id;
                $data['customerData']['area_id'] = (int) $customer->customerOtherInfo->area_id;
                $data['customerData']['post_zip_code'] = $customer->customerOtherInfo->post_zip_code;
                $data['customerData']['DOB'] = $customer->customerOtherInfo->DOB;
                $data['customerData']['MaritalStatusID'] = (int) $customer->customerOtherInfo->MaritalStatusID;
                $data['customerData']['address'] = $customer->customerOtherInfo->address;
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Personal form data has been fetched successfully.',
            'data'    => $data,
            'errors'  => []
        ], 200);
    }

    public function updateProfile()
    {
        $request = request()->all();
        $rules = [
            'first_name'      => 'required|regex:/^[a-zA-Z]+$/u|max:255|min:3',
            'country_id'      => 'required|numeric|exists:shaadi_countries,id',
            'state_id'        => 'required|numeric|exists:shaadi_states,id',
            'city_id'         => 'required|numeric|exists:shaadi_cities,id',
            'MaritalStatusID' => 'required|numeric|exists:shaadi_marital_statuses,id',
            'DOB'             => ['required','date_format:Y-m-d', new Adult],
        ];
        if (!empty($request['last_name'])) {
            $rules['last_name'] = 'required|regex:/^[a-zA-Z]+$/u|max:255|min:3';
        }
        $messages['state_id'] = 'The state field is required.';
        $messages['country_id'] = 'The country field is required.';
        $messages['city_id'] = 'The city field is required.';
        $messages['DOB'] = 'The date of birth field is required and must be 18 plus';
        $messages['MaritalStatusID'] = 'The marital status field is required.';
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'data'    => [],
                'errors'  => $validator->errors()
            ], 200);
        }

        $request['dob_date'] = date('d',strtotime($request['DOB']));
        $request['dob_month'] = date('m',strtotime($request['DOB']));
        $request['dob_year'] = date('Y',strtotime($request['DOB']));
        $request['age'] = date("Y") - $request['dob_year'];

        $customer = Customer::findOrFail(auth()->id());

        DB::beginTransaction();
        try {

            $customer->update($request);

            unset($request['first_name']);
            unset($request['last_name']);

            CustomerOtherInfo::where('RegistrationID',$customer->id)->update($request);

            DB::commit();
            return response()->json([
                'success'  => true,
                'message' => 'Personal info has been updated successfully',
                'data'    => []
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Personal info has not been updated',
                'data'    => [],
                'errors'  => $e
            ], 200);
        }
    }

    public function getFamilyInformation()
    {
        $data = [
            'customerData' => [
                "fatherName"        => "",
                "fatherProfession"  => "",
                "motherName"        => "",
                "motherProfession"  => "",
                "totalNoOfSisters"  => "",
                "totalNoOfBrothers" => "",
                "marriedSisters"    => "",
                "marriedBrothers"   => "",
            ],
            'formData' => [
                'occupations' => Occupation::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get()
            ]
        ];

        $currentAuthId = auth()->id();
        $customerFamilyInfo = CustomerFamilyInfo::where('CustomerID',$currentAuthId)->first();
        if (!empty($customerFamilyInfo)) {
            $data['customerData']['fatherName'] = $customerFamilyInfo->fatherName;
            $data['customerData']['fatherProfession'] = (int) $customerFamilyInfo->fatherProfession;
            $data['customerData']['motherName'] = $customerFamilyInfo->motherName;
            $data['customerData']['motherProfession'] = (int) $customerFamilyInfo->motherProfession;
            $data['customerData']['totalNoOfSisters'] = $customerFamilyInfo->totalNoOfSisters;
            $data['customerData']['totalNoOfBrothers'] = $customerFamilyInfo->totalNoOfBrothers;
            $data['customerData']['marriedSisters'] = $customerFamilyInfo->marriedSisters;
            $data['customerData']['marriedBrothers'] = $customerFamilyInfo->marriedBrothers;
        }
        return response()->json([
            'success' => true,
            'message' => 'Family information has been fetched successfully.',
            'data'    => $data,
            'errors'  => []
        ], 200);
    }

    public function saveFamilyInformation()
    {
        $request = request()->all();
        $rules = [
            'fatherName'        => 'required|max:255',
            'fatherProfession'  => 'required|numeric',
            'motherName'        => 'required|max:255',
            'motherProfession'  => 'required|numeric',
            'totalNoOfSisters'  => 'required|numeric',
            'totalNoOfBrothers' => 'required|numeric',
            'marriedSisters'    => 'required|numeric',
            'marriedBrothers'   => 'required|numeric'
        ];
        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'data'    => [],
                'errors'  => $validator->errors()
            ], 200);
        }
        DB::beginTransaction();
        try {
            CustomerFamilyInfo::updateOrCreate([
                'CustomerID' => auth()->id()
            ],$request);

            DB::commit();
            return response()->json([
                'success'  => true,
                'message' => 'Family info has been updated successfully',
                'data'    => []
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Family info has not been updated',
                'data'    => [],
                'errors'  => $e
            ], 200);
        }
    }

    public function getResidenceInformation()
    {
        $data = [
            'customerData' => [
                "ResidenceStatus" => "",
                "HouseSize"       => "",
                "FamilyValues"    => "",
                "CompleteAddress" => "",
            ],
            'formData' => [
                'residenceStatus' => ResidenceStatus::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'familyValue' => FamilyValue::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get()
            ]
        ];

        $currentAuthId = auth()->id();
        $customerResidenceInfo = CustomerResidentialInfo::where('CustomerID', $currentAuthId)->first();
        if (!empty($customerResidenceInfo)) {
            $data['customerData']['ResidenceStatus'] = (int) $customerResidenceInfo->ResidenceStatus;
            $data['customerData']['HouseSize'] = $customerResidenceInfo->HouseSize;
            $data['customerData']['FamilyValues'] = (int) $customerResidenceInfo->FamilyValues;
            $data['customerData']['CompleteAddress'] = $customerResidenceInfo->CompleteAddress;
        }
        return response()->json([
            'success' => true,
            'message' => 'Residence information has been fetched successfully.',
            'data'    => $data,
            'errors'  => []
        ], 200);
    }

    public function saveResidenceInformation()
    {
        $request = request()->all();
        $rules = [
            'ResidenceStatus' => 'required|numeric',
            'HouseSize'       => 'required|max:255',
            'FamilyValues'    => 'required|numeric',
            'CompleteAddress' => 'required|max:255',
        ];
        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'data'    => [],
                'errors'  => $validator->errors()
            ], 200);
        }
        DB::beginTransaction();
        try {
            CustomerResidentialInfo::updateOrCreate([
                'CustomerID' => auth()->id()
            ],$request);

            DB::commit();
            return response()->json([
                'success'  => true,
                'message' => 'Residence info has been updated successfully',
                'data'    => []
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Residence info has not been updated',
                'data'    => [],
                'errors'  => $e
            ], 200);
        }
    }

    public function getPersonalNote()
    {
        $data = [
            'customerData' => [
                "personal_note"      => "",
            ],
            'formData' => []
        ];

        $currentAuthId = auth()->id();
        $customer = Customer::with('customerOtherInfo')->where('id', $currentAuthId)->first();
        if (!empty($customer) && !empty($customer->customerOtherInfo)) {
            $data['customerData']['personal_note'] = $customer->customerOtherInfo->persona_note;
        }
        return response()->json([
            'success' => true,
            'message' => 'Personal note has been fetched successfully.',
            'data'    => $data,
            'errors'  => []
        ], 200);
    }

    public function savePersonalNote()
    {
        $request = request()->all();
        $rules = ['personal_note' => 'required|max:1000'];
        $message['personal_note'] = 'The personal note field is required and must not exceed 1000 characters.';
        $validator = Validator::make($request, $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'data'    => [],
                'errors'  => $validator->errors()
            ], 200);
        }
        DB::beginTransaction();
        try {
            $request['personal_note_approve'] = 0;
            $request['persona_note'] = $request['personal_note'];
            CustomerOtherInfo::updateOrCreate([
                'RegistrationID' => auth()->id()
            ],$request);

            DB::commit();
            return response()->json([
                'success'  => true,
                'message' => 'Personal Note has been updated successfully',
                'data'    => []
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Personal Note has not been updated',
                'data'    => [],
                'errors'  => $e
            ], 200);
        }
    }

    public function getHobbiesInterest()
    {
        $data = [
            'customerData' => [
                "hobbiesAndInterest" => [],
            ],
            'formData' => [
                'hobbiesAndInterest' => HobbiesAndInterest::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get()
            ]
        ];

        $currentAuthId = auth()->id();
        $customerOtherInfo = CustomerOtherInfo::where('RegistrationID',$currentAuthId)->first();
        if (!empty($customerOtherInfo) && !empty($customerOtherInfo->hobbiesAndInterest)) {
            $data['customerData']['hobbiesAndInterest'] = explode(",",$customerOtherInfo->hobbiesAndInterest);
        }
        return response()->json([
            'success' => true,
            'message' => 'Hobbies and Interest information has been fetched successfully.',
            'data'    => $data,
            'errors'  => []
        ], 200);
    }

    public function saveHobbiesInterest()
    {
        $request = request()->all();
        $rules = [
            'hobbiesAndInterest.*' => 'required|numeric'
        ];
        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'data'    => [],
                'errors'  => $validator->errors()
            ], 200);
        }
        DB::beginTransaction();
        try {
            $request['hobbiesAndInterest'] = implode(",",$request['hobbiesAndInterest']);
            CustomerOtherInfo::updateOrCreate([
                'RegistrationID' => auth()->id()
            ],$request);

            DB::commit();
            return response()->json([
                'success'  => true,
                'message' => 'Hobbies & Interests has been updated successfully',
                'data'    => []
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Hobbies & Interests has not been updated',
                'data'    => [],
                'errors'  => $e
            ], 200);
        }
    }

    public function getProfileCompleteData()
    {
        return response()->json([
            'success'  => true,
            'message' => 'Data has been fetched successfully.',
            'data'    => [
                'educations'         => Education::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'tongues'            => MotherTongue::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'occupations'        => Occupation::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'WillingToRelocates' => WillingToRelocate::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'IAmLookingToMarry'  => IAmLookingToMarry::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'livingArrangement'  => MyLivingArrangement::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'heights'            => Height::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'weights'            => Weight::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'complexions'        => Complexion::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'myBuilds'           => MyBuild::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'hairColor'          => HairColor::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'eyeColor'           => EyeColor::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'smokes'             => Smoke::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'disability'         => Disability::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'doYouPreferHijab'   => DoYouPreferHijab::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'doYouHaveBeard'     => DoYouHaveBeard::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'areYouRevert'       => AreYouRevert::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'doYouKeepHalal'     => DoYouKeepHalal::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'doYouPerformSalaah' => DoYouPerformSalaah::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'castes'             => Caste::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'incomes'            => AnnualInCome::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'countries'          => Country::select('id','name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'religions'          => Religion::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'maritalStatus'      => MaritalStatus::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'gender'             => [
                    ['id' => 1, 'name' => 'Male'],
                    ['id' => 2, 'name' => 'Female']
                ],
                'universities'       => University::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'jobPosts'           => JobPost::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'futurePlans'        => FuturePlan::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get()
            ]
        ], 200);
    }

    public function getEducationData()
    {
        return response()->json([
            'success'  => true,
            'message' => 'Education Form Data has been fetched successfully.',
            'data'    => [
                'educations'         => Education::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'universities'       => University::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'occupations'        => Occupation::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'jobPosts'           => JobPost::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'incomes'            => AnnualInCome::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'futurePlans'        => FuturePlan::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get()
            ]
        ], 200);
    }

    public function getPersonalData()
    {
        return response()->json([
            'success'  => true,
            'message' => 'Personal Form Data has been fetched successfully.',
            'data'    => [
                'countries'          => Country::select('id','name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'WillingToRelocates' => WillingToRelocate::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'IAmLookingToMarry'  => IAmLookingToMarry::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'livingArrangement'  => MyLivingArrangement::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'heights'            => Height::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'weights'            => Weight::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'complexions'        => Complexion::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'myBuilds'           => MyBuild::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'hairColor'          => HairColor::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'eyeColor'           => EyeColor::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'smokes'             => Smoke::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'disability'         => Disability::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'castes'             => Caste::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'tongues'            => MotherTongue::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get()
            ]
        ], 200);
    }

    public function getReligionData()
    {
        return response()->json([
            'success'  => true,
            'message' => 'Religion Form Data has been fetched successfully.',
            'data'    => [
                'religions'          => Religion::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'doYouPreferHijab'   => DoYouPreferHijab::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'doYouHaveBeard'     => DoYouHaveBeard::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'areYouRevert'       => AreYouRevert::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'doYouKeepHalal'     => DoYouKeepHalal::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'doYouPerformSalaah' => DoYouPerformSalaah::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
            ]
        ], 200);
    }

    public function getExpectationData()
    {
        return response()->json([
            'success'  => true,
            'message' => 'Expectation Form Data has been fetched successfully.',
            'data'    => [
                'gender'             => [
                    ['id' => 1, 'name' => 'Male'],
                    ['id' => 2, 'name' => 'Female']
                ],
                'countries'          => Country::select('id','name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'tongues'            => MotherTongue::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'religions'          => Religion::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'educations'         => Education::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'occupations'        => Occupation::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'WillingToRelocates' => WillingToRelocate::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'incomes'            => AnnualInCome::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'maritalStatus'      => MaritalStatus::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'livingArrangement'  => MyLivingArrangement::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'heights'            => Height::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'myBuilds'           => MyBuild::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'disability'         => Disability::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'castes'             => Caste::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get()
            ]
        ], 200);
    }

    public function customerCheckExists()
    {
        $request = request()->all();
        $validationMessage = false;
        $emailMessage = '';
        if (isset($request['email']) && !empty($request['email'])) {
            $customerEmail = Customer::where([
                'deleted' => 0,
                'email'   => $request['email']
            ])->count();
            if ($customerEmail > 0) {
                $emailMessage = 'Email address already exists';
                $validationMessage = true;
            }
        }

        $mobileMessage = '';
        if (isset($request['mobile']) && !empty($request['mobile'])) {
            $customerMobile = Customer::where([
                'deleted' => 0,
                'mobile'   => $request['mobile']
            ])->count();
            if ($customerMobile > 0) {
                $mobileMessage = 'Mobile No already exists';
                $validationMessage = true;
            }
        }

        $nameMessage = '';
        if (isset($request['name']) && !empty($request['name'])) {
            $customerName = Customer::where([
                'deleted' => 0,
                'name'   => $request['name']
            ])->count();
            if ($customerName > 0) {
                $nameMessage = 'Username already exists';
                $validationMessage = true;
            }
        }
        return response()->json([
            'status' => $validationMessage,
            'email'  => $emailMessage,
            'mobile' => $mobileMessage,
            'name'   => $nameMessage
        ]);
    }

    public function getNotifications()
    {
        $request = request()->all();
        $skipProposals = (isset($request['page']) && $request['page'] > 0) ? ($request['page']-1) * 10 : 0;
        $type = (isset($request['type']) && !empty($request['type'])) ? true : false;
        $notifications = NotificationAll::where([
            ['type', '=', 'All'],
            ['customer_id', '=', NULL]
        ]);
        if (empty($type)) {
            $notifications = $notifications->orWhere([
                ['type', '=', 'Specific'],
                ['customer_id', '=', auth()->id()]
            ]);
        } else {

        }

        $notifications = $notifications->skip($skipProposals)->take(10)->orderBy('id','desc')->get();

        $notifications->makeHidden([
            'type',
            'created_at',
            'updated_at',
            'faker_id',
            'image'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Notifications has been fetched successfully.',
            'data'    => $notifications
        ], 200);
    }

    public function customerSupportMessage()
    {
        $request = request()->all();
        $messages['mobile_number'] = 'Mobile number must be filled / valid.';
        $messages['full_name'] = 'Full name field must be filled.';
        $messages['discussion'] = 'Message field must be filled & up to 1000 characters.';
        $validator = Validator::make($request, [
            'mobile_number' => 'required|digits_between:10,15',
            'full_name'     => 'required|max:100|min:3',
            'discussion'    => 'required|max:1000'
        ],$messages);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        if (auth()->check()) {
            $request['customer_id'] = auth()->id();
        }
        $request['ip_address'] = $_SERVER['REMOTE_ADDR'];

        $supportMessage = SupportMessage::create($request);
        if (!empty($supportMessage)) {
            return response()->json([
                'success' => true,
                'message' => 'Thanks for message, our consultant will contact you soon.<br>پیغام کے لیے شکریہ، ہمارا نمائندہ جلد ہی آپ سے رابطہ کرے گا۔'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Support message has not been send successfully.'
        ], 200);
    }

    public function getPackages()
    {
        $packages = Package::where('status', 1)->get();

        $packages->makeHidden([
            'package_type',
            'created_at',
            'updated_at',
//            'faker_id',
            'status'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Packages has been fetched successfully.',
            'data'    => $packages
        ], 200);
    }

    public function saveNewEmail()
    {
        $request = request()->all();
        $customer = Customer::findOrFail(auth()->id());
        $hasPassword = $customer->password;
        $rules = [
            'email' => 'required|email|max:255|unique:shaadi_customers,email|required_with:confirm_email|same:confirm_email',
            'confirm_email' => 'required|email'
        ];
        if (!empty($hasPassword)) {
            $rules['current_password'] = 'required';
        }
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'data'    => [],
                'errors'   => $validator->errors()
            ], 200);
        }

        if (!empty($hasPassword)) {
            if (!(Hash::check($request['current_password'], $customer->password))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password does not match*',
                    'data'    => []
                ], 200);
            }
        }

        $customer->update([
            'email' => $request['email']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'New email address has been updated successfully',
            'data'    => []
        ], 200);
    }

    public function saveNewPassword()
    {
        $request = request()->all();
        $customer = Customer::findOrFail(auth()->id());
        $hasPassword = $customer->password;
        $rules = [
            'password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6'
        ];
        if (!empty($hasPassword)) {
            $rules['current_password'] = 'required';
        }
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'data'    => [],
                'errors'   => $validator->errors()
            ], 200);
        }

        if (!empty($hasPassword)) {
            if (!(Hash::check($request['current_password'], $customer->password))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password does not match*',
                    'data'    => []
                ], 200);
            }
        }

        $customer->update([
            'password' => Hash::make($request['password'])
        ]);

        return response()->json([
            'success' => true,
            'message' => 'New password has been updated successfully',
            'data'    => []
        ], 200);
    }

    public function mediaChangeStatus()
    {
        $request = request()->all();
        $customer = Customer::findOrFail(auth()->id());
        $rules = [
            'profile_pic_client_status'     => 'required|numeric|in:0,1',
            'profile_gallery_client_status' => 'required|numeric|in:0,1'
        ];
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'data'    => [],
                'errors'   => $validator->errors()
            ], 200);
        }

        $res = $customer->update($request);

        if (!empty($res)) {
            return response()->json([
                'success' => true,
                'message' => 'Media status has been updated successfully',
                'data'    => []
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Media status has not been updated',
            'data'    => []
        ], 200);
    }

    public function sendNotification()
    {
        $request = request()->all();
        $rules = [
            'title'   => 'required',
            'message' => 'required',
            'to'      => 'required'
        ];
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'data'    => [],
                'errors'   => $validator->errors()
            ], 200);
        }
        $res = NULL;
        if ($request['to']=="shaadi") {
            $notification = [
                'title' => $request['title'],
                'message' => $request['message'],
                'route_name' => 'SopInbox',
                'sender_id' => null,
                'imageFullPath' => 'https://shaadi.eliterishtay.pk/notifications/237021724255802.jpg'
            ];
            $notification = (object) $notification;
            $res = topicSendAndroidNotification($notification);
        } else {
            $title = $request['title'];
            $message = $request['message'];
            $deviceToken = $request['to'];
            $res = sendAndroidNotification($title,$message,$deviceToken);
        }
        return response()->json([
            'message' => $res
        ]);
    }

    public function seenNotification($notificationId)
    {
        $notification = NotificationAll::where('id',$notificationId)->first();
        if (!empty($notification)) {
            $customerId = auth()->id();
            $notification->update(['seen' => 1]);
            $notificationCount = NotificationAll::where([
                'customer_id' => $customerId,
                'type'        => 'Specific',
                'seen'        => 0
            ])->count();
            notificationMessageEvent($customerId,$notificationCount);
            return response()->json([
                'success' => true,
                'message' => 'Notification has been seen successfully',
                'data'    => []
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Notification has not been seen',
            'data'    => []
        ], 200);
    }

    public function customerBuyPackage()
    {
        $customer = auth()->user();
        $packageFakerId = request()->package_id;
        $package = Package::findOrFail(FakerURL::id_d($packageFakerId));
        $hasOrder = Order::where([
            'customer_id'  => $customer->id,
            'package_id'   => $package->id,
            'order_status' => 'Unpaid'
        ])->orderBy('id','desc')->first();
        if (!empty($hasOrder)) {
            $orderDueDate = date('Y-m-d',strtotime($hasOrder->created_at. ' +1 day'));
            if (date('Y-m-d') <= $orderDueDate) {
                return response()->json([
                    'success' => true,
                    'message' => 'already',
                    'data'    => []
                ], 200);
            }
        }
        $token = fetchPayProToken();
        $orderNo = getNewOrderNumber();
        if (!empty($token)) {
            $orderAmount = str_replace(",", "", $package->price);
            $customerMobile = payProMobileFormat($customer->mobile);
            $issueDate = date('Y-m-d');
            $dueDate = date('Y-m-d',strtotime('+2 day'));
            $postFields = [
                [
                    "MerchantId" => config('services.paypro_merchant_id')
                ],
                [
                    "OrderNumber"             => $orderNo,
                    "OrderAmount"             => $orderAmount,
                    "OrderDueDate"            => date('d/m/Y',strtotime($dueDate)),
                    "OrderType"               => "Service",
                    "IssueDate"               => date('d/m/Y',strtotime($issueDate)),
                    "OrderExpireAfterSeconds" => "0",
                    "CustomerName"            => $customer->full_name,
                    "CustomerMobile"          => $customerMobile,
                    "CustomerEmail"           => $customer->email,
                    "CustomerAddress"         => ''
                ]
            ];
            $resJson = createNewOrder($token,$postFields);
            $res = json_decode($resJson);
            if ($res[0]->Status=="00") {

                $redirectUrl = $res[1]->Click2Pay;
                $newOrder = Order::create([
                    "customer_id"    => $customer->id,
                    "package_id"     => $package->id,
                    "package_name"   => $package->package_name,
                    "order_no"       => $orderNo,
                    "order_amount"   => $orderAmount,
                    "order_response" => $resJson,
                    "redirect_url"   => $redirectUrl,
                    "issue_date"     => $issueDate,
                    "due_date"       => $dueDate,
                    "paypro_id"      => $res[1]->PayProId
                ]);

                if (!empty($newOrder)) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Order has been generated successfully.',
                        'data'    => $newOrder
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Order has not been generated.',
                        'data'    => []
                    ], 200);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $res[1]->Description,
                    'data'    => []
                ], 200);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Token has not been generated.',
            'data'    => []
        ], 200);
    }

    public function purchaseHistory()
    {
        $orders = Order::where('customer_id',auth()->id())->orderBy('id','desc')->get();
        return response()->json([
            'success' => true,
            'message' => 'Purchase history has been fetched successfully.',
            'data'    => $orders
        ], 200);
    }

    public function paymentCheck($orderNo)
    {
        if (!empty($orderNo)) {
            $orderStatus = getOrderStatus($orderNo);
            if (!empty($orderStatus)) {
                $order = Order::where('order_no',$orderNo)->first();
                if (empty($order)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Order Number does not exists.',
                        'data'    => []
                    ], 200);
                }
                if (auth()->id() != $order->customer_id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Customer not match.',
                        'data'    => []
                    ], 200);
                }
                $package = Package::findOrFail($order->package_id);
                $customer = Customer::findOrFail($order->customer_id);

                $duration = $package->duration;
                $startDate = date('Y-m-d 00:00:00');
                $endDate = date('Y-m-d 23:59:59',strtotime("+$duration days"));

                if ($package->package_type==1) {
                    $customerRequest = [
                        'user_package'       => $package->package_name,
                        'user_package_color' => $package->color,
                        'package_id'         => $package->id,
                        'package_expiry_date'=> $endDate,
                        'mobile_verified'    => 1,
                    ];

                    if ($package->vip_status=="Yes") {
                        $customerRequest['featuredProfile'] = 1;
                    }
                } else {
                    $boostProfile = ($package->profile_status=='Boosted') ? 1 : 2;
                    $customerRequest = [
                        'boost_profile'   => $boostProfile,
                        'boost_expiry'    => $endDate,
                        'mobile_verified' => 1
                    ];
                }


                Customer::findOrFail($order->customer_id)->update($customerRequest);

                if ($package->package_type==1) {
                    CustomerNotificationPreference::updateOrCreate([
                        'customerID' => $order->customer_id
                    ],[
                        'customerID'       => $order->customer_id,
                        'messagelimits'    => $package->direct_messages,
                        'limit_start_date' => $startDate,
                        'limit_end_date'   => $endDate
                    ]);
                }

                $order->update([
                    'order_status'   => 'Paid',
                    'package_status' => 'Active'
                ]);
                $data = [
                    'email' => $customer->email,
                    'order' => $order,
                    'full_name' => $customer->full_name
                ];

                sendNewEmail('emails.package_receipt',$data,'Thanks for Your Purchase!');
                return response()->json([
                    'success' => true,
                    'message' => 'Payment is paid.',
                    'data'    => []
                ], 200);
            }
            return response()->json([
                'success' => false,
                'message' => 'Payment is unpaid.',
                'data'    => []
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Order Number not exists.',
            'data'    => []
        ], 200);
    }

}
