<?php
namespace App\Http\Controllers\Front;
use App\helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Models\AnnualInCome;
use App\Models\AreYouRevert;
use App\Models\Caste;
use App\Models\City;
use App\Models\Complexion;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerBlock;
use App\Models\CustomerCareerInfo;
use App\Models\CustomerChatting;
use App\Models\CustomerFamilyInfo;
use App\Models\CustomerImage;
use App\Models\CustomerLike;
use App\Models\CustomerNotificationPreference;
use App\Models\CustomerOtherInfo;
use App\Models\CustomerPersonalInfo;
use App\Models\CustomerProfileView;
use App\Models\CustomerReligionInfo;
use App\Models\CustomerReport;
use App\Models\CustomerResidentialInfo;
use App\Models\CustomerSaved;
use App\Models\CustomerSearch;
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
use App\Models\RegistrationsReason;
use App\Models\Religion;
use App\Models\ResidenceArea;
use App\Models\ResidenceStatus;
use App\Models\Sect;
use App\Models\Smoke;
use App\Models\State;
use App\Models\University;
use App\Models\Weight;
use App\Models\WillingToRelocate;
use App\Rules\Adult;
//use App\Rules\ReCaptcha;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Image;
use Imagick;

class CustomerAuthController extends Controller
{

    public function loginProcess()
    {
        $request = request()->all();
        $ifEmail = filter_var($request['email'], FILTER_VALIDATE_EMAIL);
        $rules = [
            'password' => 'required'
        ];
        if (!empty($ifEmail)) {
            $rules['email'] = 'required|email|exists:shaadi_customers,email';
        } else {
            $rules['email'] = 'required|exists:shaadi_customers,mobile';
        }
        $messages['email'] = 'The selected Email Address/Mobile Number is invalid';
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }
        $customer = Customer::where('deleted',0)
            ->where('email',$request['email'])
            ->orWhere('mobile',$request['email'])
            ->first();
        if (!empty($customer)) {
            if (Hash::check($request['password'], $customer->password)) {
                auth()->guard('customer')->attempt(['email' => $customer->email, 'password' => $request['password']]);
//                $redirectUrl = '';

                if ($customer->mobile_verified == 0 && $customer->email_verified == 0) {
                    session::flash('error_message', "Please verify your mobile number or email first");
                    $redirectUrl = route('auth.verify');
                    return response()->json([
                        'status'      => 'success',
                        'msg'         => 'You are logged in successfully',
                        'redirectUrl' => $redirectUrl
                    ]);
                }

                $customerCareerInfo = CustomerCareerInfo::where('CustomerID',$customer->id)->count();
                if ($customerCareerInfo==0) {
                    session::flash('error_message', "Please add education info first thanks...!");
                    $redirectUrl = route('education.form');
                    return response()->json([
                        'status'      => 'success',
                        'msg'         => 'You are logged in successfully',
                        'redirectUrl' => $redirectUrl
                    ]);
                }

                $customerPersonalInfo = CustomerPersonalInfo::where('CustomerID',$customer->id)->count();
                if ($customerPersonalInfo==0) {
                    session::flash('error_message', "Please add Personal Information info first thanks...!");
                    $redirectUrl = route('personal.form');
                    return response()->json([
                        'status'      => 'success',
                        'msg'         => 'You are logged in successfully',
                        'redirectUrl' => $redirectUrl
                    ]);
                }

                $customerReligionInfo = CustomerReligionInfo::where('CustomerID',$customer->id)->count();
                if ($customerReligionInfo==0) {
                    session::flash('error_message', "Please add Religion info first thanks...!");
                    $redirectUrl = route('religion.form');
                    return response()->json([
                        'status'      => 'success',
                        'msg'         => 'You are logged in successfully',
                        'redirectUrl' => $redirectUrl
                    ]);
                }

                $customerSearch = CustomerSearch::where('customerID',$customer->id)->count();
                if ($customerSearch==0) {
                    session::flash('error_message', "Please add Expectations info first thanks...!");
                    $redirectUrl = route('expectation.form');
                    return response()->json([
                        'status'      => 'success',
                        'msg'         => 'You are logged in successfully',
                        'redirectUrl' => $redirectUrl
                    ]);
                }

                if (empty($redirectUrl)) {
                    $redirectUrl = route('customer.dashboard');
                    if ($customer->profile_status == 2) {
                        auth()->guard('customer')->logout();
                        session::flash('error_message', "Your account blocked / deleted please contact administration thanks");
                        $redirectUrl = route('landing.page');
                        return response()->json([
                            'status'      => 'success',
                            'msg'         => 'You are logged in successfully',
                            'redirectUrl' => $redirectUrl
                        ]);
                    }
                    return response()->json([
                        'status'      => 'success',
                        'msg'         => 'You are logged in successfully',
                        'redirectUrl' => $redirectUrl
                    ]);
                }

                return response()->json([
                    'status'      => 'success',
                    'msg'         => 'You are logged in successfully',
                    'redirectUrl' => $redirectUrl
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Invalid Credentials'
        ]);
    }

    public function logoutProcess()
    {
        auth()->guard('customer')->logout();
        return redirect()->route('landing.page');
    }

    public function viewRegister()
    {
        if (auth()->guard('customer')->check()) {
            return redirect()->route('customer.dashboard');
        }
        $title = 'Register';
        $countries = Country::where('deleted',0)->orderBy('order_at','asc')->get();
        $registrationReasons = RegistrationsReason::where('deleted',0)->orderBy('order_at','asc')->get();
        $maritalStatues = MaritalStatus::where('deleted',0)->orderBy('order_at','asc')->get();
        return view('front.auth.register',compact('title','countries','registrationReasons','maritalStatues'));
    }

    public function registerProcess()
    {
        $request = request()->all();
        $messages['DOB'] = 'The date of birth field is required and must be 18 plus.';
        $messages['country_id'] = 'The country field is required.';
        $messages['city_id'] = 'The city field is required.';
        $messages['state_id'] = 'The state field is required.';
        $messages['RegistrationsReasonsID'] = 'The registration reason field is required.';
        $messages['MaritalStatusID'] = 'The marital status field is required.';
        $validator = Validator::make($request, [
            'gender'                 => 'required|numeric|in:1,2',
            'first_name'             => 'required|regex:/^[a-zA-Z]+$/u|max:255|min:3',
            'mobile'                 => 'required|max:255|unique:shaadi_customers,mobile',
            'country_id'             => 'required|numeric|exists:shaadi_countries,id',
            'state_id'               => 'required|numeric|exists:shaadi_states,id',
            'city_id'                => 'required|numeric|exists:shaadi_cities,id',
            'DOB'                    => ['required','date_format:Y-m-d', new Adult],
            'email'                  => 'required|email|max:255|unique:shaadi_customers,email',
            'password'               => 'required|min:6',
            'RegistrationsReasonsID' => 'required|numeric|exists:shaadi_registrations_reasons,id',
            'MaritalStatusID'        => 'required|numeric|exists:shaadi_marital_statuses,id',
            'read_policy'            => 'required'
        ],$messages);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        DB::beginTransaction();
        try {
            $request['profile_status'] = 1;
            $request['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $request['user_type'] = 3;
            $request['source'] = 'Website';
            $request['image'] = ($request['gender']==1) ? 'default-male.jpg' : 'default-female.jpg';
            $request['second_marraige'] = ($request['gender']==1) ? 1 : 2;
            $request['password'] = Hash::make($request['password']);
            unset($request['read_policy']);
            $customer = Customer::create($request);
            if (!empty($customer)) {
                $request['RegistrationID'] = $customer->id;
                $request['dob_date'] = date('d',strtotime($request['DOB']));
                $request['dob_month'] = date('m',strtotime($request['DOB']));
                $request['dob_year'] = date('Y',strtotime($request['DOB']));
                $request['age'] = date("Y") - $request['dob_year'];
                CustomerOtherInfo::create($request);
                $request['CustomerID'] = $customer->id;
                $request['CountryOfOrigin'] = $request['country_id'];
                $request['StateOfOrigin'] = $request['state_id'];
                $request['CityOfOrigin'] = $request['city_id'];
                CustomerPersonalInfo::create($request);
                DB::commit();
                $data = [
                    'email'     => $customer->email,
                    'code'      => base64_encode($customer->email),
                    'fullName' => $customer->full_name
                ];

                sendNewEmail('emails.confirmation',$data,'Confirm Account - DoosriBiwi.com');
                auth()->guard('customer')->login($customer);
                $redirectUrl = route('view.login');
                if (auth()->guard('customer')->check()) {
                    $redirectUrl = route('auth.verify');
                }
                return response()->json([
                    'status'      => 'success',
                    'msg'         => 'Confirmation email has been sent to your email address.',
                    'redirectUrl' => $redirectUrl
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Registration form has not been saved',
                'error'   => $e
            ]);
        }
    }

    public function forgetPassword()
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'email' => 'required|email|exists:shaadi_customers,email'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }
        $customer = Customer::where([
            'email'   => $request['email'],
            'deleted' => 0
        ])->first();
        if (empty($customer)) {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Email address does not exists.'
            ]);
        }
        $messageData = array(
            'code'  => base64_encode($customer->email),
            'email' => $customer->email
        );

        $res = sendNewEmail('emails.password_reset',$messageData,'Password Reset - DoosriBiwi.com');
        if (!empty($res)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Please check your email. We have sent you a link to reset your password. Thanks.'
            ]);
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Email address does not exists.'
        ]);
    }

    public function forgetPasswordConfirm($email)
    {
        $email = base64_decode($email);
        $customer = Customer::where('email',$email)->first();
        if (empty($customer)) {
            abort(404);
        }
        return view('front.auth.forgot_password_confirm',compact('email'));
    }

    public function forgetPasswordConfirmProcess()
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'email'            => 'required|email|exists:shaadi_customers,email',
            'password'         => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors(),
                'status'=>'error'
            ],422);
        }
        $customer = Customer::where('email',$request['email'])->first();
        $res = $customer->update([
            'password'       => Hash::make($request['password']),
            'profile_status' => 1
        ]);
        if (!empty($res)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Your password has been updated successfully, now you can log in thanks'
            ]);
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Customer does not exists.'
        ]);
    }

    public function dashboard()
    {
        $customer = Customer::with(['getOccupationName','getCountryName','getCountrySlug','getCitySlug','customerSearch'])->findOrFail(auth()->guard('customer')->id());
        $customerSearch = null;
        if (!empty($customer->customerSearch) && !empty($customer->customerSearch->title)) {
            $customerSearch = json_decode($customer->customerSearch->title);
        }

        $customers = Customer::where('profile_status',1)->whereNotIn('image',['default-user.png','default-male.jpg','default-female.jpg'])->with([
            'customerOtherInfo' => function($query) use ($customerSearch) {
                if (isset($customerSearch->gender) && !empty($customerSearch->gender)) {
                    $query->where('gender', $customerSearch->gender);
                }
                if (!empty($customerSearch->ageFrom) && !empty($customerSearch->ageTo)) {
                    $query->whereBetween('age', [$customerSearch->ageFrom, $customerSearch->ageTo]);
                } elseif (!empty($customerSearch->ageFrom)) {
                    $query->where('age', '>=', $customerSearch->ageFrom);
                } elseif (!empty($customerSearch->ageTo)) {
                    $query->where('age', '<=', $customerSearch->ageTo);
                }
                if (isset($customerSearch->country_id) && !empty($customerSearch->country_id)) {
                    $query->where('country_id', $customerSearch->country_id);
                }
                if (isset($customerSearch->state_id) && $customerSearch->state_id > 0) {
                    $query->where('state_id', $customerSearch->state_id);
                }
                if (isset($customerSearch->city_id) && $customerSearch->city_id > 0) {
                    $query->where('city_id', $customerSearch->city_id);
                }
            }, 'customerReligionInfo' => function($query) use ($customerSearch) {
                if (isset($customerSearch->Religions) && !empty($customerSearch->Religions)) {
                    $query->where('Religions', $customerSearch->Religions);
                }
            }]);

        if (
            isset($customerSearch->gender) ||
            isset($customerSearch->ageFrom) ||
            isset($customerSearch->ageTo) ||
            isset($customerSearch->country_id) ||
            isset($customerSearch->state_id) ||
            isset($customerSearch->city_id)
        ) {
            $customers = $customers->whereHas('customerOtherInfo', function ($query) use ($customerSearch) {
                if (isset($customerSearch->gender) && !empty($customerSearch->gender)) {
                    $query->where('gender', $customerSearch->gender);
                }
                if (!empty($customerSearch->ageFrom) && !empty($customerSearch->ageTo)) {
                    $query->whereBetween('age', [$customerSearch->ageFrom, $customerSearch->ageTo]);
                } elseif (!empty($customerSearch->ageFrom)) {
                    $query->where('age', '>=', $customerSearch->ageFrom);
                } elseif (!empty($customerSearch->ageTo)) {
                    $query->where('age', '<=', $customerSearch->ageTo);
                }
                if (isset($customerSearch->country_id) && !empty($customerSearch->country_id)) {
                    $query->where('country_id', $customerSearch->country_id);
                }
                if (isset($customerSearch->state_id) && $customerSearch->state_id > 0) {
                    $query->where('state_id', $customerSearch->state_id);
                }
                if (isset($customerSearch->city_id) && $customerSearch->city_id > 0) {
                    $query->where('city_id', $customerSearch->city_id);
                }
            });
        }

        if (!empty($customerSearch->Religions)) {
            $customers = $customers->whereHas('customerReligionInfo', function ($query) use ($customerSearch) {
                $query->where('Religions', $customerSearch->Religions);
            });
        }

        $customersVerified = $customers->limit(8)->orderBy('id','desc')->get();

        $newMessages = CustomerChatting::with('getSenderCustomer')->where([
            'receiver_id'    => $customer->id,
            'message_status' => 1
        ])->whereHas('getSenderCustomer')->orderBy('id', 'desc')->groupBy('sender_id')->limit(10)->get();
        $title = 'Dashboard';
        return view('front.customer.dashboard',compact('title','customer','customersVerified','newMessages'));
    }

    public function editPersonalProfile()
    {
        $customer = Customer::with(['getOccupationName','getCountryName','getCitiesName','customerOtherInfo'])->findOrFail(auth()->guard('customer')->id());
        $title = 'Edit Personal Profile';
        $states = [];
        $cities = [];
        $countries = Country::where('deleted',0)->orderBy('order_at','asc')->get();
        if (!empty($customer->customerOtherInfo)) {
            if (!empty($customer->customerOtherInfo->country_id)) {
                $states = State::where('country_id',$customer->customerOtherInfo->country_id)->where('deleted',0)->orderBy('order_at','asc')->get();
            }
            if (!empty($customer->customerOtherInfo->state_id)) {
                $cities = City::where('state_id',$customer->customerOtherInfo->state_id)->where('deleted',0)->orderBy('order_at','asc')->get();
            }
        }
        if ($customer->gender_name=='Male') {
            $maritalStatuses = MaritalStatus::where('deleted',0)->whereNotIn('id',[1,17])->orderBy('order_at','asc')->get();
        } else {
            $maritalStatuses = MaritalStatus::where('deleted',0)->whereNotIn('id',[16,7])->orderBy('order_at','asc')->get();
        }
        return view('front.customer.edit_personal_profile',compact('title','customer','countries','states','cities','maritalStatuses'));
    }

    public function savePersonalInfo()
    {
        $request = request()->all();
        $rules = [
            'first_name'      => 'required|max:255',
            'country_id'      => 'required|numeric',
            'state_id'        => 'required|numeric',
            'city_id'         => 'required|numeric',
            'post_zip_code'   => 'required|digits:5',
            'MaritalStatusID' => 'required|numeric',
            'DOB'             => ['required','date_format:Y-m-d', new Adult],
            'address'         => 'required'
        ];
        $messages['state_id'] = 'The state field is required.';
        $messages['country_id'] = 'The country field is required.';
        $messages['city_id'] = 'The city field is required.';
        $messages['DOB'] = 'The date of birth field is required and must be 18 plus';
        $messages['MaritalStatusID'] = 'The marital status field is required.';
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        $request['dob_date'] = date('d',strtotime($request['DOB']));
        $request['dob_month'] = date('m',strtotime($request['DOB']));
        $request['dob_year'] = date('Y',strtotime($request['DOB']));
        $request['age'] = date("Y") - $request['dob_year'];

        $customer = Customer::findOrFail(auth()->guard('customer')->id());

        DB::beginTransaction();
        try {

            $customer->update($request);

            unset($request['first_name']);
            unset($request['last_name']);

            CustomerOtherInfo::where('RegistrationID',$customer->id)->update($request);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg'    => 'Personal info has been updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Personal info has not been updated',
                'error'   => $e
            ]);
        }
    }

    public function editProfile()
    {
        $customer = Customer::with([
            'getOccupationName',
            'getCountryName',
            'customerPersonalInfo',
            'customerReligionInfo',
            'customerOtherInfo',
            'customerSearch',
            'customerCareerInfo',
            'customerFamilyInfo',
            'customerResidentialInfo'
        ])->findOrFail(auth()->guard('customer')->id());
        $title = 'Edit Profile';
        /*Personal Information*/
        $countries = Country::where('deleted',0)->get();
        $states = [];
        $cities = [];
//        $majorCourses = [];
        if (!empty($customer->customerPersonalInfo)) {
            if (!empty($customer->customerPersonalInfo)) {
                $states = State::where('country_id',$customer->customerPersonalInfo->CountryOfOrigin)->where('deleted',0)->get();
            }
            if (!empty($customer->customerPersonalInfo)) {
                $cities = City::where('state_id',$customer->customerPersonalInfo->StateOfOrigin)->where('deleted',0)->get();
            }
        }
//        if (!empty($customer->customerCareerInfo)) {
//            $majorCourses = MajorCourse::where('deleted',0)->where('education_id',$customer->customerCareerInfo->Qualification)->get();
//        }
//        $willingToRelocate = WillingToRelocate::where('deleted',0)->orderBy('order_at','asc')->get();
        $lookingToMarry = IAmLookingToMarry::where('deleted',0)->orderBy('order_at','asc')->get();
        $livingArrangement = MyLivingArrangement::where('deleted',0)->orderBy('order_at','asc')->get();
        $heights = Height::where('deleted',0)->orderBy('order_at','asc')->get();
        $weights = Weight::where('deleted',0)->orderBy('order_at','asc')->get();
        $complexions = Complexion::where('deleted',0)->orderBy('order_at','asc')->get();
//        $myBuilds = MyBuild::where('deleted',0)->orderBy('order_at','asc')->get();
        $hairColors = HairColor::where('deleted',0)->orderBy('order_at','asc')->get();
        $eyeColors = EyeColor::where('deleted',0)->orderBy('order_at','asc')->get();
        $smokes = Smoke::where('deleted',0)->orderBy('order_at','asc')->get();
        $disabilities = Disability::where('deleted',0)->orderBy('order_at','asc')->get();

        /*Qualification*/
        $educations = Education::where('deleted',0)->orderBy('order_at','asc')->get();
        $occupations = Occupation::where('deleted',0)->orderBy('order_at','asc')->get();
        $tongues = MotherTongue::where('deleted',0)->orderBy('order_at','asc')->get();

        /*Career Information*/

//        $universities = University::where('deleted',0)->orderBy('order_at','asc')->get();
        $incomes = AnnualInCome::where('deleted',0)->orderBy('order_at','asc')->get();
//        $jobPosts = JobPost::where('deleted',0)->orderBy('order_at','asc')->get();
//        $futurePlans = FuturePlan::where('deleted',0)->orderBy('order_at','asc')->get();

        /*Religion*/
        $religions = Religion::where('deleted',0)->orderBy('order_at','asc')->get();
        $preferHijabs = DoYouPreferHijab::where('deleted',0)->orderBy('order_at','asc')->get();
        $reverts = AreYouRevert::where('deleted',0)->orderBy('order_at','asc')->get();
//        $performSalaahs = DoYouPerformSalaah::where('deleted',0)->orderBy('order_at','asc')->get();
        if (!empty($customer->customerReligionInfo)) {
            $sects = Sect::where('religions_id',$customer->customerReligionInfo->Religions)->where('deleted',0)->orderBy('order_at','asc')->get();
        } else {
            $sects = Sect::where('deleted',0)->orderBy('order_at','asc')->get();
        }
        $beards = DoYouHaveBeard::where('deleted',0)->orderBy('order_at','asc')->get();
        $halals = DoYouKeepHalal::where('deleted',0)->orderBy('order_at','asc')->get();
        $castes = Caste::where('deleted',0)->orderBy('order_at','asc')->get();

        /*Residence Information*/
        $residenceStatuses = ResidenceStatus::where('deleted',0)->orderBy('order_at','asc')->get();
        $residenceAreas = ResidenceArea::where('deleted',0)->orderBy('order_at','asc')->get();
        $familyValues = FamilyValue::where('deleted',0)->orderBy('order_at','asc')->get();

        /*Expectations*/
        if ($customer->gender_name=='Male') {
            $maritalStatuses = MaritalStatus::where('deleted',0)->whereNotIn('id',[16,7])->orderBy('order_at','asc')->get();
        } else {
            $maritalStatuses = MaritalStatus::where('deleted',0)->whereNotIn('id',[1,17])->orderBy('order_at','asc')->get();
        }

        /*Customer Searches / Expectation*/
        $expStates = [];
        $expCities = [];
        if (!empty($customer->customerSearch) && !empty($customer->customerSearch->title)) {
            $customerSearch = json_decode($customer->customerSearch->title);
            if (isset($customerSearch->country_id) && !empty($customerSearch->country_id)) {
                $expStates = State::where('country_id',$customerSearch->country_id)->where('deleted',0)->orderBy('order_at','asc')->get();
            }
            if (isset($customerSearch->state_id) && !empty($customerSearch->state_id)) {
                $expCities = City::where('state_id',$customerSearch->state_id)->where('deleted',0)->orderBy('order_at','asc')->get();
            }
        }

        $hobbies = HobbiesAndInterest::where('deleted',0)->orderBy('order_at','asc')->get();

        return view('front.customer.edit_profile',compact(
            'title',
            'customer',
            'countries',
            'states',
            'cities',
//            'willingToRelocate',
            'lookingToMarry',
            'livingArrangement',
            'heights',
            'weights',
            'complexions',
//            'myBuilds',
            'hairColors',
            'eyeColors',
            'smokes',
            'disabilities',
            'educations',
            'occupations',
            'tongues',
//            'universities',
            'incomes',
//            'jobPosts',
//            'futurePlans',
            'religions',
            'preferHijabs',
            'reverts',
//            'performSalaahs',
            'sects',
            'beards',
            'halals',
            'castes',
            'residenceStatuses',
            'residenceAreas',
            'familyValues',
            'maritalStatuses',
            'expStates',
            'expCities',
            'hobbies'
//            'majorCourses'
        ));
    }

    public function careerInfoSave()
    {
        $request = request()->all();
        $rules = [
            'Qualification'   => 'required|numeric',
            'Profession'      => 'required|numeric',
            'MonthlyIncome'   => 'required|numeric',
        ];
        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }
        DB::beginTransaction();
        try {
            CustomerCareerInfo::updateOrCreate([
                'CustomerID' => auth()->guard('customer')->id()
            ],$request);

            CustomerOtherInfo::updateOrCreate([
                'RegistrationID' => auth()->guard('customer')->id()
            ],[
                'EducationID' => $request['Qualification'],
                'OccupationID' => $request['Profession']
            ]);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg'    => 'Career info has been updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Career info has not been updated',
                'error'   => $e
            ]);
        }
    }

    public function familyInfoSave()
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
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }
        DB::beginTransaction();
        try {
            CustomerFamilyInfo::updateOrCreate([
                'CustomerID' => auth()->guard('customer')->id()
            ],$request);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg'    => 'Family info has been updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Family info has not been updated',
                'error'   => $e
            ]);
        }
    }

    public function residenseInfoSave()
    {
        $request = request()->all();
        $rules = [
            'ResidenceStatus' => 'required|numeric',
            'HouseSize'       => 'required|max:255',
            'ResidenceArea'   => 'required|numeric',
            'FamilyValues'    => 'required|numeric',
            'CompleteAddress' => 'required|max:255',
        ];
        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }
        DB::beginTransaction();
        try {
            CustomerResidentialInfo::updateOrCreate([
                'CustomerID' => auth()->guard('customer')->id()
            ],$request);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg'    => 'Residence info has been updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Residence info has not been updated',
                'error'   => $e
            ]);
        }
    }

    public function personalNoteSave()
    {
        $request = request()->all();
        $rules = [
            'persona_note' => 'required|max:1000'
        ];
        $message['persona_note'] = 'The personal note field is required.';
        $validator = Validator::make($request, $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }
        DB::beginTransaction();
        try {
            CustomerOtherInfo::updateOrCreate([
                'RegistrationID' => auth()->guard('customer')->id()
            ],$request);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg'    => 'Personal Note has been updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Personal Note has not been updated',
                'error'   => $e
            ]);
        }
    }

    public function hobbiesInterestsSave()
    {
        $request = request()->all();
        $rules = [
            'hobbiesAndInterest.*' => 'required|numeric'
        ];
        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }
        DB::beginTransaction();
        try {
            $request['hobbiesAndInterest'] = implode(",",$request['hobbiesAndInterest']);
            CustomerOtherInfo::updateOrCreate([
                'RegistrationID' => auth()->guard('customer')->id()
            ],$request);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg'    => 'Hobbies & Interests has been updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Hobbies & Interests has not been updated',
                'error'   => $e
            ]);
        }
    }

    public function editPhoto()
    {
        $customer = Customer::with(['getOccupationName','getCountryName'])->findOrFail(auth()->guard('customer')->id());
        $title = 'Change Profile';
        $photos = CustomerImage::where([
            'CustomerID' => $customer->id,
            'deleted'    => 0
        ])->get();
        return view('front.customer.edit_photo',compact('title','customer','photos'));
    }

    public function galleryPhotosSave()
    {
        $request = request();
        $rules = [
            'public_gallery.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail(auth()->guard('customer')->id());
            if ($request->hasFile('public_gallery')) {
                $image_tmp = $request->file('public_gallery');
                $customerImagesCount = CustomerImage::where([
                    'CustomerID' => $customer->id,
                    'deleted'    => 0
                ])->count();
                $customerImagesCount = 5 - $customerImagesCount;
                if (count($image_tmp) > $customerImagesCount) {
                    return response()->json([
                        'status'  => 'warning',
                        'msg' => 'Only 5 photos allowed*'
                    ], 200);
                }
                foreach ($image_tmp as $key => $image) {
                    if ($image->isValid()) {
                        $extension = $image->getClientOriginalExtension();
//                        $imageName = rand(111, 99999).time(). '.' . $extension;
                        $uniqueKeyword = getUniqueKeyword();
                        $imageName = $uniqueKeyword.'-'.date('YmdHis').'.'.$extension;
                        $main_image = public_path('customer-images/' . $imageName);

                        Image::make($image)->save($main_image);

                        CustomerImage::create([
                            'CustomerID' => $customer->id,
                            'image'      => $imageName
                        ]);
                    }
                }
                $customer->update(['profile_gallery_status' => 0, 'changes_approval' => 1]);
                DB::commit();
                return response()->json([
                    'status'  => 'success',
                    'msg' => 'Gallery Images has been saved successfully'
                ], 200);
            }
            return response()->json([
                'status'  => 'warning',
                'msg' => 'Gallery Images has not been saved'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Gallery Images has not been saved',
                'error'   => $e
            ]);
        }
    }

    public function deletePhoto()
    {
        $photoId = request()->photo_id;
        $imageRow = CustomerImage::findOrFail(FakerURL::id_d($photoId));
        if (!in_array($imageRow->image,['default-female.jpg','default-male.jpg','default-user.png'])) {
            if (file_exists(public_path('customer-images/'.$imageRow->image))) {
                unlink(public_path('customer-images/'.$imageRow->image));
            }
        }
        $imageRow->delete();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Gallery Photo has been deleted successfully'
        ]);
    }

    public function notificationPreferences()
    {
        $customer = Customer::with(['getOccupationName','getCountryName','customerNotificationPreference'])->findOrFail(auth()->guard('customer')->id());
        $title = 'Notification Preferences';
        return view('front.customer.notification_preference',compact('title','customer'));
    }

    public function saveNotificationPreferences()
    {
        $request = request()->all();
        DB::beginTransaction();
        try {
            CustomerNotificationPreference::updateOrCreate([
                'customerID' => auth()->guard('customer')->id()
            ],$request);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg'    => 'Notification preferences has been updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Notification preferences has not been updated',
                'error'   => $e
            ]);
        }
    }

    public function customerLikeSave()
    {
        $currentCustomerId = auth()->guard('customer')->id();
        $customer = Customer::with(['getOccupationName','getCountryName'])->findOrFail($currentCustomerId);
        $customerYouLiked = CustomerLike::where('deleted',0)->where('like_by',$currentCustomerId)->count();
        $customerOtherLiked = CustomerLike::where('deleted',0)->where('like_to',$currentCustomerId)->count();
        $customerYouSaved = CustomerSaved::where('deleted',0)->where('save_by',$currentCustomerId)->count();
        $customerOtherSaved = CustomerSaved::where('deleted',0)->where('save_to',$currentCustomerId)->count();
        $customerOtherViews = CustomerProfileView::where('deleted',0)->where('view_to',$currentCustomerId)->count();
        $title = 'Liked & Saved';
        return view('front.customer.like_save',compact('title','customer','customerYouLiked','customerOtherLiked','customerYouSaved','customerOtherSaved','customerOtherViews'));
    }

    public function changeEmailPassword()
    {
        $customer = Customer::with(['getOccupationName','getCountryName'])->findOrFail(auth()->guard('customer')->id());
        $title = 'Change Email & Password';
        return view('front.customer.change_email_password',compact('title','customer'));
    }

    public function saveNewEmail()
    {
        $request = request()->all();
        $customer = Customer::findOrFail(auth()->guard('customer')->id());
        $rules = [
            'email' => 'required|email|max:255|unique:shaadi_customers,email|required_with:confirm_email|same:confirm_email',
            'confirm_email' => 'required|email',
            'current_password' => 'required'
        ];
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors(),
                'status'=>'error'
            ],422);
        }

        if (!(Hash::check($request['current_password'], $customer->password))) {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Current password does not match*'
            ],200);
        }

        $customer->update([
            'email' => $request['email']
        ]);

        return response()->json([
            'status' => 'success',
            'msg'    => 'New email address has been updated successfully'
        ],200);
    }

    public function saveNewPassword()
    {
        $request = request()->all();
        $customer = Customer::findOrFail(auth()->guard('customer')->id());
        $rules = [
            'password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6',
            'current_password' => 'required'
        ];
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors(),
                'status'=>'error'
            ],422);
        }

        if (!(Hash::check($request['current_password'], $customer->password))) {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Current password does not match*'
            ],200);
        }

        $customer->update([
            'password' => Hash::make($request['password'])
        ]);

        return response()->json([
            'status' => 'success',
            'msg'    => 'New password has been updated successfully'
        ],200);
    }

    public function saveNewName()
    {
        $request = request()->all();
        $customer = Customer::findOrFail(auth()->guard('customer')->id());
        $rules = [
            'name' => 'required|max:255|unique:shaadi_customers,name|required_with:confirm_name|same:confirm_name',
            'confirm_name' => 'required|max:255',
            'current_password' => 'required'
        ];
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors(),
                'status'=>'error'
            ],422);
        }

        if (!(Hash::check($request['current_password'], $customer->password))) {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Current password does not match*'
            ],200);
        }

        $customer->update([
            'name' => $request['name']
        ]);

        return response()->json([
            'status' => 'success',
            'msg'    => 'New username has been updated successfully'
        ],200);
    }

    public function customerBlock()
    {
        $customer = Customer::with(['getOccupationName','getCountryName'])->findOrFail(auth()->guard('customer')->id());
        $title = 'Block Profiles';
        $customerBlockIds = CustomerBlock::select('blockTo')->where('blockBy',$customer->id)->pluck('blockTo')->toArray();
        $blockCustomers = Customer::with('getOccupationName')->whereIn('id',$customerBlockIds)->get();
        return view('front.customer.block',compact('title','customer','blockCustomers'));
    }

    public function contactUs()
    {
        $title = 'Contact Us';
        return view('front.customer.contact_us',compact('title'));
    }

    public function authVerify()
    {
        if(!auth()->guard('customer')->check()) {
            return redirect()->route('view.login');
        }
        $title = 'Customer Verification';
        return view('front.customer.steps.verify',compact('title'));
    }

    public function confirmationEmail()
    {
        $customer = Customer::with('customerOtherInfo')->findOrFail(auth()->guard('customer')->id());
        if (!empty($customer) && $customer->email_verified == 1) {
            return response()->json(array(
                'status' => 'warning',
                'msg' => 'Already verified please reload the page to proceed thanks',
            ));
        }

        $data = [
            'email'    => $customer->email,
            'code'     => base64_encode($customer->email),
            'fullName' => $customer->full_name
        ];

        $isEmailSent = sendNewEmail('emails.confirmation',$data,'Confirm Account - DoosriBiwi.com');
        if (!empty($isEmailSent)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Confirmation email has been sent to your email address'
            ]);
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Confirmation email has not been sent.'
        ]);
    }

    public function confirmCustomerAccount($email)
    {
        $email = base64_decode($email);
        $customer = Customer::where('email', $email)->where('deleted', 0)->first();
        if (!empty($customer)) {
            if(!auth()->guard('customer')->check()) {
                auth()->guard('customer')->login($customer);
            }
            if ($customer->status == 1 && $customer->email_verified == 1) {
                $message = "Your email verified already please login...!";
                session::flash('success_message', $message);
                return redirect()->route('landing.page');
            }
            $customer->update([
                'status' => 1,
                'email_verified' => 1,
                'email_verified_at' => date('Y-m-d')
            ]);
            $data = [
                'email'    => $email,
                'customer' => $customer
            ];

            sendNewEmail('emails.welcome',$data,'Welcome - DoosriBiwi.com');
            if (auth()->guard('customer')->check()) {
                $message = "Your email has been verified successfully";
                session::flash('success_message', $message);
                return redirect()->route('auth.verify');
            }

            $message = "Your email has been verified successfully please login here.";
            session::flash('success_message', $message);
            return redirect()->route('view.login');
        } else {
            abort(404);
        }

    }

    public function educationForm()
    {
        $customer = Customer::where('id',auth()->guard('customer')->id())->first();
        if ($customer->mobile_verified == 0 && $customer->email_verified == 0) {
            session::flash('error_message', "Please verify your mobile number or email first");
            return redirect()->route('auth.verify');
        }
        $title = 'Career Form';
        $customerCareerInfo = CustomerCareerInfo::where('CustomerID',auth()->guard('customer')->id())->first();
        $educations = Education::where('deleted',0)->orderBy('order_at','asc')->get();
        $occupations = Occupation::where('deleted',0)->orderBy('order_at','asc')->get();
        $incomes = AnnualInCome::where('deleted',0)->orderBy('order_at','asc')->get();
        return view('front.customer.steps.education',compact(
            'title',
            'customerCareerInfo',
            'educations',
            'occupations',
            'incomes'
        ));
    }

    public function educationSave()
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'Qualification'   => 'required|numeric',
            'Profession'      => 'required|numeric',
            'MonthlyIncome'   => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        DB::beginTransaction();
        try {
            $request['RegistrationID'] = auth()->guard('customer')->id();
            CustomerCareerInfo::updateOrCreate([
                'CustomerID' => $request['RegistrationID']
            ],$request);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg'    => 'Form has been saved successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Form has not been saved',
                'error'   => $e
            ]);
        }
    }

    public function personalForm()
    {
        $customer = Customer::where('id',auth()->guard('customer')->id())->first();
        if ($customer->mobile_verified == 0 && $customer->email_verified == 0) {
            session::flash('error_message', "Please verify your mobile number or email first");
            return redirect()->route('auth.verify');
        }

        $customerCareerInfo = CustomerCareerInfo::where('CustomerID',$customer->id)->count();
        if ($customerCareerInfo==0) {
            session::flash('error_message', "Please add education info first thanks...!");
            return redirect()->route('education.form');
        }

        $customerPersonalInfo = CustomerPersonalInfo::where('CustomerID',auth()->guard('customer')->id())->first();
        $customerOtherInfo = CustomerOtherInfo::where('RegistrationID',auth()->guard('customer')->id())->first();
        $title = 'Personal Form';
        $lookingToMarry = IAmLookingToMarry::where('deleted',0)->orderBy('order_at','asc')->get();
        $livingArrangement = MyLivingArrangement::where('deleted',0)->orderBy('order_at','asc')->get();
        $heights = Height::where('deleted',0)->orderBy('order_at','asc')->get();
        $weights = Weight::where('deleted',0)->orderBy('order_at','asc')->get();
        $complexions = Complexion::where('deleted',0)->orderBy('order_at','asc')->get();
        $hairColors = HairColor::where('deleted',0)->orderBy('order_at','asc')->get();
        $eyeColors = EyeColor::where('deleted',0)->orderBy('order_at','asc')->get();
        $smokes = Smoke::where('deleted',0)->orderBy('order_at','asc')->get();
        $disabilities = Disability::where('deleted',0)->orderBy('order_at','asc')->get();
        $castes = Caste::where('deleted',0)->orderBy('order_at','asc')->get();
        $tongues = MotherTongue::where('deleted',0)->orderBy('order_at','asc')->get();
        return view('front.customer.steps.personal',compact('title',
            'customerPersonalInfo',
            'customerOtherInfo',
            'lookingToMarry',
            'livingArrangement',
            'heights',
            'weights',
            'complexions',
            'hairColors',
            'eyeColors',
            'smokes',
            'disabilities',
            'castes',
            'tongues'
        ));
    }

    public function personalSave()
    {
        $request = request()->all();
        $message['MyFirstLanguageMotherTonguesID'] = 'The mother tongue field is required.';
        $validator = Validator::make($request, [
            'IAmLookingToMarry'              => 'required|numeric',
            'MyLivingArrangements'           => 'required|numeric',
            'Heights'                        => 'required|numeric',
            'HairColors'                     => 'required|numeric',
            'EyeColors'                      => 'required|numeric',
            'Smokes'                         => 'required|numeric',
            'Disabilities'                   => 'required|numeric',
            'Weights'                        => 'required|numeric',
            'Complexions'                    => 'required|numeric',
            'Caste'                          => 'required|numeric',
            'MyFirstLanguageMotherTonguesID' => 'required|numeric'
        ],$message);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        DB::beginTransaction();
        try {
            $request['CustomerID'] = auth()->guard('customer')->id();
            CustomerPersonalInfo::updateOrCreate([
                'CustomerID' => $request['CustomerID']
            ],$request);

            CustomerOtherInfo::updateOrCreate([
                'RegistrationID' => $request['CustomerID']
            ],[
                'Caste'                          => $request['Caste'],
                'MyFirstLanguageMotherTonguesID' => $request['MyFirstLanguageMotherTonguesID'],
                'MySecondLanguageMotherTonguesID' => $request['MyFirstLanguageMotherTonguesID']
            ]);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg'    => 'Form has been saved successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Form has not been saved',
                'error'   => $e
            ]);
        }
    }

    public function religionForm()
    {
        $customer = Customer::where('id',auth()->guard('customer')->id())->first();
        if ($customer->mobile_verified == 0 && $customer->email_verified == 0) {
            session::flash('error_message', "Please verify your mobile number or email first");
            return redirect()->route('auth.verify');
        }

        $customerCareerInfo = CustomerCareerInfo::where('CustomerID',$customer->id)->count();
        if ($customerCareerInfo==0) {
            session::flash('error_message', "Please add education info first thanks...!");
            return redirect()->route('education.form');
        }

        $customerPersonalInfo = CustomerPersonalInfo::where('CustomerID',$customer->id)->count();
        if ($customerPersonalInfo==0) {
            session::flash('error_message', "Please add Personal Information info first thanks...!");
            return redirect()->route('personal.form');
        }

        $customerReligionInfo = CustomerReligionInfo::where('CustomerID',auth()->guard('customer')->id())->first();
        $customerPersonalInfo = CustomerPersonalInfo::where('CustomerID',auth()->guard('customer')->id())->first();
        if (!empty($customerReligionInfo) && !empty($customerPersonalInfo)) {
            $customerReligionInfo->Caste = $customerPersonalInfo->Caste;
        }
        $religions = Religion::where('deleted',0)->orderBy('order_at','asc')->get();
        $preferHijabs = DoYouPreferHijab::where('deleted',0)->orderBy('order_at','asc')->get();
        $reverts = AreYouRevert::where('deleted',0)->orderBy('order_at','asc')->get();
//        $performSalaahs = DoYouPerformSalaah::where('deleted',0)->orderBy('order_at','asc')->get();
        if (!empty($customerReligionInfo) && !empty($customerReligionInfo->Religions)) {
            $sects = Sect::where('religions_id',$customerReligionInfo->Religions)->where('deleted',0)->orderBy('order_at','asc')->get();
        } else {
            $sects = Sect::where('deleted',0)->orderBy('order_at','asc')->get();
        }
        $beards = DoYouHaveBeard::where('deleted',0)->orderBy('order_at','asc')->get();
        $halals = DoYouKeepHalal::where('deleted',0)->orderBy('order_at','asc')->get();
        $castes = Caste::where('deleted',0)->orderBy('order_at','asc')->get();
        $title = 'Religion Form';
        return view('front.customer.steps.religion',compact(
            'title',
            'customerReligionInfo',
            'religions',
            'preferHijabs',
            'reverts',
//            'performSalaahs',
            'sects',
            'beards',
            'halals',
            'castes'
        ));
    }

    public function religionSave()
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'Religions'          => 'required',
            'Sects'              => 'required',
            'DoYouPreferHijabs'  => 'required',
            'DoYouHaveBeards'    => 'required',
            'AreYouReverts'      => 'required',
            'DoYouKeepHalal'     => 'required',
//            'DoYouPerformSalaah' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        DB::beginTransaction();
        try {
            $request['CustomerID'] = auth()->guard('customer')->id();
            CustomerReligionInfo::updateOrCreate([
                'CustomerID' => $request['CustomerID']
            ],$request);

            CustomerPersonalInfo::updateOrCreate([
                'CustomerID' => $request['CustomerID']
            ],$request);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg'    => 'Form has been saved successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Form has not been saved',
                'error'   => $e
            ]);
        }
    }

    public function expectationForm()
    {
        $customer = Customer::where('id',auth()->guard('customer')->id())->first();
        if ($customer->mobile_verified == 0 && $customer->email_verified == 0) {
            session::flash('error_message', "Please verify your mobile number or email first");
            return redirect()->route('auth.verify');
        }

        $customerCareerInfo = CustomerCareerInfo::where('CustomerID',$customer->id)->count();
        if ($customerCareerInfo==0) {
            session::flash('error_message', "Please add education info first thanks...!");
            return redirect()->route('education.form');
        }

        $customerPersonalInfo = CustomerPersonalInfo::where('CustomerID',$customer->id)->count();
        if ($customerPersonalInfo==0) {
            session::flash('error_message', "Please add Personal Information info first thanks...!");
            return redirect()->route('personal.form');
        }

        $customerReligionInfo = CustomerReligionInfo::where('CustomerID',$customer->id)->count();
        if ($customerReligionInfo==0) {
            session::flash('error_message', "Please add Religion info first thanks...!");
            return redirect()->route('religion.form');
        }

        $customerSearch = null;
        $states = [];
        $cities = [];
        $sects = [];
        $customerSearchRow = CustomerSearch::where('customerID',auth()->guard('customer')->id())->first();
        if (!empty($customerSearchRow) && !empty($customerSearchRow->title)) {
            $customerSearch = json_decode($customerSearchRow->title);
        }
        if (!empty($customerSearch)) {
            if (!empty($customerSearch->country_id)) {
                $states = State::where('country_id',$customerSearch->country_id)->where('deleted',0)->get();
            } else {
                $states = State::where('deleted',0)->get();
            }
            if (!empty($customerSearch->state_id)) {
                $cities = City::where('state_id',$customerSearch->state_id)->where('deleted',0)->get();
            } else {
                $cities = City::where('deleted',0)->get();
            }
            if (!empty($customerSearch->Religions)) {
                $sects = Sect::where('religions_id',$customerSearch->Religions)->where('deleted',0)->get();
            } else {
                $sects = Sect::where('deleted',0)->get();
            }
        }
        $halals = DoYouKeepHalal::where('deleted',0)->orderBy('order_at','asc')->get();
        $tongues = MotherTongue::where('deleted',0)->orderBy('order_at','asc')->get();
        $incomes = AnnualInCome::where('deleted',0)->orderBy('order_at','asc')->get();
        $heights = Height::where('deleted',0)->orderBy('order_at','asc')->get();
        $smokes = Smoke::where('deleted',0)->orderBy('order_at','asc')->get();
//        $perferHijabs = DoYouPreferHijab::where('deleted',0)->orderBy('order_at','asc')->get();
        $salaahs = DoYouPerformSalaah::where('deleted',0)->orderBy('order_at','asc')->get();
        $occupations = Occupation::where('deleted',0)->orderBy('order_at','asc')->get();
        $lookingToMarry = IAmLookingToMarry::where('deleted',0)->orderBy('order_at','asc')->get();
        $myBuilds = MyBuild::where('deleted',0)->orderBy('order_at','asc')->get();
        $disabilities = Disability::where('deleted',0)->orderBy('order_at','asc')->get();
        $beards = DoYouHaveBeard::where('deleted',0)->orderBy('order_at','asc')->get();
        $educations = Education::where('deleted',0)->orderBy('order_at','asc')->get();
        $counties = Country::where('deleted',0)->orderBy('order_at','asc')->get();
        if ($customer->gender_name=='Male') {
            $maritalStatues = MaritalStatus::where('deleted',0)->whereNotIn('id',[16,7])->orderBy('order_at','asc')->get();
        } else {
            $maritalStatues = MaritalStatus::where('deleted',0)->whereNotIn('id',[1,17])->orderBy('order_at','asc')->get();
        }
        $hairColors = HairColor::where('deleted',0)->orderBy('order_at','asc')->get();
        $castes = Caste::where('deleted',0)->orderBy('order_at','asc')->get();
        $religions = Religion::where('deleted',0)->orderBy('order_at','asc')->get();
        $areYouReverts = AreYouRevert::where('deleted',0)->orderBy('order_at','asc')->get();
//        $willingToRelocates = WillingToRelocate::where('deleted',0)->orderBy('order_at','asc')->get();
        $livingArrangements = MyLivingArrangement::where('deleted',0)->orderBy('order_at','asc')->get();
        $eyeColors = EyeColor::where('deleted',0)->orderBy('order_at','asc')->get();
        $title = 'Life Partner Expectations Form';
        return view('front.customer.steps.expectation',compact(
            'title',
            'customer',
            'customerSearch',
            'states',
            'sects',
            'halals',
            'tongues',
            'incomes',
            'heights',
            'smokes',
            'cities',
//            'perferHijabs',
            'salaahs',
            'occupations',
            'lookingToMarry',
            'myBuilds',
            'disabilities',
            'beards',
            'educations',
            'counties',
            'maritalStatues',
            'hairColors',
            'castes',
            'religions',
            'areYouReverts',
            'livingArrangements',
            'eyeColors'
        ));
    }

    public function expectationSave()
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'gender'               => 'required|numeric',
            'ageFrom'              => 'required|numeric',
            'ageTo'                => 'required|numeric',
            'country_id'           => 'required|numeric',
            'state_id'             => 'required|numeric',
            'city_id'              => 'required|numeric',
            'Tongue'               => 'required|numeric',
            'Religions'            => 'required|numeric',
            'Sects'                => 'required|numeric',
            'EducationID'          => 'required|numeric',
            'OccupationID'         => 'required|numeric',
            'MyIncome'             => 'required|numeric',
//            'WillingToRelocate'    => 'required|numeric',
//            'MyBuilds'             => 'required|numeric',
            'MaritalStatus'        => 'required|numeric',
            'MyLivingArrangements' => 'required|numeric',
            'Heights'              => 'required|numeric',
            'Disabilities'         => 'required|numeric',
            'Castes'               => 'required|numeric'
        ],[
            'state_id'             => 'The state field is required.',
            'city_id'              => 'The city field is required.',
            'OccupationID'         => 'The occupation field is required.',
            'EducationID'          => 'The education field is required.',
            'country_id'           => 'The country field is required.'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        DB::beginTransaction();
        try {
            $request['title'] = json_encode($request);
            $request['customerID'] = auth()->guard('customer')->id();
            CustomerSearch::updateOrCreate([
                'customerID' => $request['customerID']
            ],$request);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg'    => 'Form has been saved successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Form has not been saved',
                'error'   => $e
            ]);
        }
    }

    public function profileImageForm()
    {
        $customer = Customer::where('id',auth()->guard('customer')->id())->first();
        if ($customer->mobile_verified == 0 && $customer->email_verified == 0) {
            session::flash('error_message', "Please verify your mobile number or email first");
            return redirect()->route('auth.verify');
        }

        $customerCareerInfo = CustomerCareerInfo::where('CustomerID',$customer->id)->count();
        if ($customerCareerInfo==0) {
            session::flash('error_message', "Please add education info first thanks...!");
            return redirect()->route('education.form');
        }

        $customerPersonalInfo = CustomerPersonalInfo::where('CustomerID',$customer->id)->count();
        if ($customerPersonalInfo==0) {
            session::flash('error_message', "Please add Personal Information info first thanks...!");
            return redirect()->route('personal.form');
        }

        $customerReligionInfo = CustomerReligionInfo::where('CustomerID',$customer->id)->count();
        if ($customerReligionInfo==0) {
            session::flash('error_message', "Please add Religion info first thanks...!");
            return redirect()->route('religion.form');
        }

        $customerSearch = CustomerSearch::where('customerID',$customer->id)->count();
        if ($customerSearch==0) {
            session::flash('error_message', "Please add Expectations info first thanks...!");
            return redirect()->route('expectation.form');
        }

        $customer = Customer::findOrFail(auth()->guard('customer')->id());
        $title = 'Image Upload Form';
        return view('front.customer.steps.image',compact('title','customer'));
    }

    public function makeBlurImage($imageName,$blur_percent)
    {
        switch ($blur_percent)
        {
            case '10':
                $blur_percent = 5;
                break;
            case '15':
                $blur_percent = 10;
                break;
            case '25':
                $blur_percent = 15;
                break;
        }
        $file = public_path('customer-images/original_images/'.$imageName);
        $fileUrl = asset('/customer-images/original_images/'.$imageName);
        if (env('APP_ENV')=='local') {
            $fileUrl = str_replace("https","http",$fileUrl);
        }
        $imageNewPath = public_path('customer-images/' . $imageName);
        $headers = get_headers($fileUrl, 1);
        $contentType = (isset($headers['Content-Type'])) ? $headers['Content-Type'] : $headers['content-type'];
        switch ($contentType)
        {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($file);
                break;
            case 'image/png':
                $image = imagecreatefrompng($file);
                break;
        }

        list($w, $h) = getimagesize($file);

        $size = array('sm'=>array('w'=>intval($w/4), 'h'=>intval($h/4)),
            'md'=>array('w'=>intval($w/2), 'h'=>intval($h/2))
        );

        $sm = imagecreatetruecolor($size['sm']['w'],$size['sm']['h']);
        imagecopyresampled($sm, $image, 0, 0, 0, 0, $size['sm']['w'], $size['sm']['h'], $w, $h);

        for ($x=1; $x <=$blur_percent*2; $x++){
            imagefilter($sm, IMG_FILTER_GAUSSIAN_BLUR, 999);
        }

        imagefilter($sm, IMG_FILTER_SMOOTH,99);
        imagefilter($sm, IMG_FILTER_BRIGHTNESS, 10);

        $md = imagecreatetruecolor($size['md']['w'], $size['md']['h']);
        imagecopyresampled($md, $sm, 0, 0, 0, 0, $size['md']['w'], $size['md']['h'], $size['sm']['w'], $size['sm']['h']);
        imagedestroy($sm);

        for ($x=1; $x <=$blur_percent; $x++){
            imagefilter($md, IMG_FILTER_GAUSSIAN_BLUR, 999);
        }

        imagefilter($md, IMG_FILTER_SMOOTH,99);
        imagefilter($md, IMG_FILTER_BRIGHTNESS, 10);

        imagecopyresampled($image, $md, 0, 0, 0, 0, $w, $h, $size['md']['w'], $size['md']['h']);
        imagedestroy($md);

        imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
        switch ($contentType)
        {
            case 'image/jpeg':
                imagejpeg($image,$imageNewPath);
                break;
            case 'image/gif':
                imagegif($image,$imageNewPath);
                break;
            case 'image/png':
                imagepng($image,$imageNewPath);
                break;
        }
        imagedestroy($image);

        return true;
    }

    public function profileImageSave()
    {
        $request = request();
        $rules = [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail(auth()->guard('customer')->id());
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
//                    $imageName = rand(111, 99999) .time(). '.' . $extension;
                    $uniqueKeyword = getUniqueKeyword();
                    $imageName = $uniqueKeyword.'-'.date('YmdHis').'.'.$extension;
                    $blur_percent = (isset($request->blur_percent) && $request->blur_percent > 0 ? $request->blur_percent : 0);
                    $profile_pic_client_status = (isset($request->profile_pic_client_status) && $request->profile_pic_client_status > 0 ? $request->profile_pic_client_status : 0);
                    if ($blur_percent > 0) {
                        $main_image = public_path('customer-images/original_images/' . $imageName);
                        Image::make($image_tmp)->resize(500, 500, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($main_image,60);

                        $this->makeBlurImage($imageName,$blur_percent);
                    } else {
                        $main_image = public_path('customer-images/' . $imageName);
                        Image::make($image_tmp)->resize(500, 500, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($main_image,60);
                    }

                    if (!in_array($customer->image,['default-female.jpg','default-male.jpg','default-user.png']) && file_exists(public_path('customer-images/'.$customer->image))) {
                        unlink(public_path('customer-images/'.$customer->image));
                    }
                    if (!in_array($customer->image,['default-female.jpg','default-male.jpg','default-user.png']) && file_exists(public_path('customer-images/original_images/'.$customer->image))) {
                        unlink(public_path('customer-images/original_images/'.$customer->image));
                    }

                    $customer->update([
                        'image' => $imageName,
                        'profile_pic_client_status' => $profile_pic_client_status,
                        'blur_percent' => $blur_percent,
                        'profile_pic_status' => 0,
                        'changes_approval' => 1
                    ]);
                    DB::commit();
                    return response()->json([
                        'status'  => 'success',
                        'msg' => 'Profile Image has been saved successfully'
                    ], 200);
                }
            }
            return response()->json([
                'status'  => 'success',
                'msg' => 'Profile Image has not been saved'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Form has not been saved',
                'error'   => $e
            ]);
        }
    }

    public function imagePreviewPixelate()
    {
        $request = request();
        if ($request->hasFile('image')) {
            $image_tmp = $request->file('image');
            if ($image_tmp->isValid()) {
                $image = Image::make($image_tmp);

                if ($request->blur_percent > 0) {
                    $image = $image->pixelate($request->blur_percent);
                    $image = $image->blur($request->blur_percent*2);
                }

                // Encode the image
                $encodedImage = $image->encode('data-url');

                return response()->json([
                    'status'    => 'success',
                    'msg'       => 'Image has been previewed successfully',
                    'imageFile' => $encodedImage->encoded
                ], 200);
            }
        }
        return response()->json([
            'status'  => 'warning',
            'msg' => 'Image has not been previewed'
        ], 200);
    }

    public function finishForm()
    {
        $customer = Customer::where('id',auth()->guard('customer')->id())->first();
        if ($customer->mobile_verified == 0 && $customer->email_verified == 0) {
            session::flash('error_message', "Please verify your mobile number or email first");
            return redirect()->route('auth.verify');
        }

        $customerCareerInfo = CustomerCareerInfo::where('CustomerID',$customer->id)->count();
        if ($customerCareerInfo==0) {
            session::flash('error_message', "Please add education info first thanks...!");
            return redirect()->route('education.form');
        }

        $customerPersonalInfo = CustomerPersonalInfo::where('CustomerID',$customer->id)->count();
        if ($customerPersonalInfo==0) {
            session::flash('error_message', "Please add Personal Information info first thanks...!");
            return redirect()->route('personal.form');
        }

        $customerReligionInfo = CustomerReligionInfo::where('CustomerID',$customer->id)->count();
        if ($customerReligionInfo==0) {
            session::flash('error_message', "Please add Religion info first thanks...!");
            return redirect()->route('religion.form');
        }

        $customerSearch = CustomerSearch::where('customerID',$customer->id)->count();
        if ($customerSearch==0) {
            session::flash('error_message', "Please add Expectations info first thanks...!");
            return redirect()->route('expectation.form');
        }

        $title = 'Customer Verification';
        return view('front.customer.steps.finish',compact('title'));
    }

    public function getStates($countryId)
    {
        $data = [];
        if (!empty($countryId)) {
            $data = State::select('id','title')->where([
                'country_id' => $countryId,
                'deleted'    => 0
            ])->orderBy('order_at','asc')->get();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Fetched successfully.',
            'data'    => $data,
            'code'    => 200
        ], 200);
    }

    public function getCities($stateId)
    {
        $data = [];
        if (!empty($stateId)) {
            $data = City::select('id','title')->where([
                'state_id' => $stateId,
                'deleted'  => 0
            ])->orderBy('order_at','asc')->get();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Fetched successfully.',
            'data'    => $data,
            'code'    => 200
        ], 200);
    }

    public function getSects($religionId)
    {
        $data = [];
        if (!empty($religionId)) {
            $data = Sect::select('id','title')->where([
                'religions_id' => $religionId,
                'deleted'      => 0
            ])->orderBy('order_at','asc')->get();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Fetched successfully.',
            'data'    => $data,
            'code'    => 200
        ], 200);
    }

    public function getMajorCourses($educationId)
    {
        $data = [];
        if (!empty($educationId)) {
            $data = MajorCourse::select('id','title')->where([
                'education_id' => $educationId,
                'deleted'      => 0
            ])->orderBy('order_at','asc')->get();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Fetched successfully.',
            'data'    => $data,
            'code'    => 200
        ], 200);
    }

    public function search($slug='')
    {
        $currentUserGenderExp = '';
        $currentUser = null;
        if (auth()->guard('customer')->check()) {
            $currentUser = auth()->guard('customer')->user();
            $currentUserGenderExp = ($currentUser->gender_name=='Male') ? 2 : 1;
        }

        $customers = Customer::with([
            'getCountryName',
            'getCitiesName',
            'getReligionName',
            'getSectName',
            'getCasteName',
            'getMotherTongueName',
            'getMaritalStatusName',
            'getHeightName',
            'getCountrySlug',
            'getCitySlug',
            'customerOtherInfo' => function($q) use($currentUserGenderExp){
                if (!empty($currentUserGenderExp)) {
                    $q->where('gender', $currentUserGenderExp);
                }
            }
        ]);

        if (!empty($currentUserGenderExp)) {
            $customers = $customers->whereHas('customerOtherInfo', function($q) use($currentUserGenderExp){
                $q->where('gender', $currentUserGenderExp);
            });
            if (!empty($currentUser)) {
                $customers = $customers->where('id','!=',$currentUser->id);
            }
        }

        $customers = $customers->where('deleted',0)
            ->where('profile_status',1)
            ->where('email_verified',1)
//            ->where('profile_pic_status',1)
//            ->where('profile_pic_client_status',1)
//            ->whereNotIn('image',['default-female.jpg','default-male.jpg','default-user.png'])
            ->orderBy('blur_percent','asc')
            ->orderBy('profile_pic_status','desc')
            ->orderBy('profile_pic_client_status','desc')
//            ->inRandomOrder()
            ->limit(10)
            ->get();

        $countries         = Country::where('deleted',0)->orderBy('order_at','asc')->get();
        $states            = [];
        $cities            = [];
        $religions         = Religion::where('deleted',0)->orderBy('order_at','asc')->get();
        $sects             = [];
        $preferHijabs      = DoYouPreferHijab::where('deleted',0)->orderBy('order_at','asc')->get();
        $beards            = DoYouHaveBeard::where('deleted',0)->orderBy('order_at','asc')->get();
        $reverts           = AreYouRevert::where('deleted',0)->orderBy('order_at','asc')->get();
        $halals            = DoYouKeepHalal::where('deleted',0)->orderBy('order_at','asc')->get();
        $performSalaahs    = DoYouPerformSalaah::where('deleted',0)->orderBy('order_at','asc')->get();
        $educations        = Education::where('deleted',0)->orderBy('order_at','asc')->get();
        $tongues           = MotherTongue::where('deleted',0)->orderBy('order_at','asc')->get();
        $occupations       = Occupation::where('deleted',0)->orderBy('order_at','asc')->get();
//        $willingToRelocate = WillingToRelocate::where('deleted',0)->orderBy('order_at','asc')->get();
        $incomes           = AnnualInCome::where('deleted',0)->orderBy('order_at','asc')->get();
        $lookingToMarry    = IAmLookingToMarry::where('deleted',0)->orderBy('order_at','asc')->get();
        $maritalStatuses   = MaritalStatus::where('deleted',0)->orderBy('order_at','asc')->get();
        $livingArrangement = MyLivingArrangement::where('deleted',0)->orderBy('order_at','asc')->get();
        $heights           = Height::where('deleted',0)->orderBy('order_at','asc')->get();
        $myBuilds          = MyBuild::where('deleted',0)->orderBy('order_at','asc')->get();
        $hairColors        = HairColor::where('deleted',0)->orderBy('order_at','asc')->get();
        $eyeColors         = EyeColor::where('deleted',0)->orderBy('order_at','asc')->get();
        $disabilities      = Disability::where('deleted',0)->orderBy('order_at','asc')->get();
        $castes            = Caste::where('deleted',0)->orderBy('order_at','asc')->get();
        $title = 'Search';
        return view('front.search',compact(
            'title',
            'customers',
            'countries',
            'states',
            'cities',
            'religions',
            'sects',
            'preferHijabs',
            'beards',
            'reverts',
            'halals',
            'performSalaahs',
            'educations',
            'tongues',
            'occupations',
//            'willingToRelocate',
            'incomes',
            'lookingToMarry',
            'maritalStatuses',
            'livingArrangement',
            'heights',
            'myBuilds',
            'hairColors',
            'eyeColors',
            'disabilities',
            'castes',
            'slug'
        ));
    }

    public function searchProcess()
    {
        $request = request()->all();
        try {
            if (!empty($request) || count($request) > 0) {
                $customers = Customer::where('deleted',0)->with([
                    'getCountryName',
                    'getCitiesName',
                    'getReligionName',
                    'getSectName',
                    'getCasteName',
                    'getMotherTongueName',
                    'getMaritalStatusName',
                    'getHeightName',
                    'getCountrySlug',
                    'getCitySlug',
                    'customerOtherInfo' => function($q) use($request){
                        $maritalStatusIdArr = [];
                        if (isset($request['secondMarraige']) && isset($request['divorcedMarraige'])) {
                            $maritalStatusIdArr = array_merge($maritalStatusIdArr,[7,9,16,3,4,8,12]);
                        } elseif (isset($request['secondMarraige']) && !empty($request['secondMarraige'])) {
                            $maritalStatusIdArr = array_merge($maritalStatusIdArr,[7,9,16]);
                        } elseif (isset($request['divorcedMarraige']) && !empty($request['divorcedMarraige'])) {
                            $maritalStatusIdArr = array_merge($maritalStatusIdArr,[3,4,8,12]);
                        }
                        if (!empty($request['MaritalStatus'])) {
                            array_push($maritalStatusIdArr,$request['MaritalStatus']);
                        }
                        if (count($maritalStatusIdArr) > 0) {
                            $q->whereIn('MaritalStatusID',$maritalStatusIdArr);
                        }
                        if (!empty($request['gender'])) {
                            $q->where('gender', $request['gender']);
                        }
                        if (!empty($request['ageFrom']) && !empty($request['ageTo'])) {
                            $q->whereBetween('age', [$request['ageFrom'], $request['ageTo']]);
                        } elseif (!empty($request['ageFrom'])) {
                            $q->where('age', '>=', $request['ageFrom']);
                        } elseif (!empty($request['ageTo'])) {
                            $q->where('age', '<=', $request['ageTo']);
                        }
                        if (!empty($request['country_id'])) {
                            $q->where('country_id', $request['country_id']);
                        }
                        if (!empty($request['state_id'])) {
                            $q->where('state_id', $request['state_id']);
                        }
                        if (!empty($request['city_id'])) {
                            $q->where('city_id', $request['city_id']);
                        }
                        if (!empty($request['MyFirstLanguageMotherTonguesID'])) {
                            $q->where('MyFirstLanguageMotherTonguesID', $request['MyFirstLanguageMotherTonguesID']);
                        }
                        if (isset($request['slug']) && $request['slug']=='foreign-proposals') {
                            $q->where('country_id','!=',162);
                        }
                }, 'customerReligionInfo' => function($q) use ($request) {
                    if (!empty($request['Religions'])) {
                        $q->where('Religions', $request['Religions']);
                    }
                    if (!empty($request['Sects'])) {
                        $q->where('Sects', $request['Sects']);
                    }
                }, 'customerPersonalInfo' => function($q) use ($request) {
                    if (!empty($request['Castes'])) {
                        $q->where('Caste', $request['Castes']);
                    }
//                    if (!empty($request['WillingToRelocate'])) {
//                        $q->where('WillingToRelocate', $request['WillingToRelocate']);
//                    }
//                    if (!empty($request['MyBuilds'])) {
//                        $q->where('MyBuilds', $request['MyBuilds']);
//                    }
                    if (!empty($request['MyLivingArrangements'])) {
                        $q->where('MyLivingArrangements', $request['MyLivingArrangements']);
                    }
                    if (!empty($request['Heights'])) {
                        $q->where('Heights', $request['Heights']);
                    }
                    if (!empty($request['Disabilities'])) {
                        $q->where('Disabilities', $request['Disabilities']);
                    }
                }, 'customerCareerInfo' => function($q) use ($request) {
                    if (!empty($request['EducationID'])) {
                        $q->where('Qualification', $request['EducationID']);
                    }
                    if (!empty($request['OccupationID'])) {
                        $q->where('Profession', $request['OccupationID']);
                    }
                    if (!empty($request['MyIncome'])) {
                        $q->where('MonthlyIncome', $request['MyIncome']);
                    }
                }
                ]);
                if (!empty($request['gender']) ||
                    isset($request['secondMarraige']) ||
                    isset($request['divorcedMarraige']) ||
                    !empty($request['ageFrom']) ||
                    !empty($request['MaritalStatus']) ||
                    !empty($request['ageTo']) ||
                    !empty($request['country_id']) ||
                    !empty($request['state_id']) ||
                    !empty($request['city_id']) ||
                    $request['slug'] == 'foreign-proposals' ||
                    !empty($request['MyFirstLanguageMotherTonguesID'])) {
                    $customers = $customers->whereHas('customerOtherInfo', function($q) use($request){
                        $maritalStatusIdArr = [];
                        if (isset($request['secondMarraige']) && isset($request['divorcedMarraige'])) {
                            $maritalStatusIdArr = array_merge($maritalStatusIdArr,[7,9,16,3,4,8,12]);
                        } elseif (isset($request['secondMarraige']) && !empty($request['secondMarraige'])) {
                            $maritalStatusIdArr = array_merge($maritalStatusIdArr,[7,9,16]);
                        } elseif (isset($request['divorcedMarraige']) && !empty($request['divorcedMarraige'])) {
                            $maritalStatusIdArr = array_merge($maritalStatusIdArr,[3,4,8,12]);
                        }
                        if (!empty($request['MaritalStatus'])) {
                            array_push($maritalStatusIdArr,$request['MaritalStatus']);
                        }
                        if (count($maritalStatusIdArr) > 0) {
                            $q->whereIn('MaritalStatusID',$maritalStatusIdArr);
                        }
                        if (!empty($request['gender'])) {
                            $q->where('gender', $request['gender']);
                        }
                        if (!empty($request['ageFrom']) && !empty($request['ageTo'])) {
                            $q->whereBetween('age', [$request['ageFrom'], $request['ageTo']]);
                        } elseif (!empty($request['ageFrom'])) {
                            $q->where('age', '>=', $request['ageFrom']);
                        } elseif (!empty($request['ageTo'])) {
                            $q->where('age', '<=', $request['ageTo']);
                        }
                        if (!empty($request['country_id'])) {
                            $q->where('country_id', $request['country_id']);
                        }
                        if ($request['state_id'] > 0) {
                            $q->where('state_id', $request['state_id']);
                        }
                        if ($request['city_id'] > 0) {
                            $q->where('city_id', $request['city_id']);
                        }
                        if ($request['MyFirstLanguageMotherTonguesID'] > 0) {
                            $q->where('MyFirstLanguageMotherTonguesID', $request['MyFirstLanguageMotherTonguesID']);
                        }
                        if (isset($request['slug']) && $request['slug']=='foreign-proposals') {
                            $q->where('country_id','!=',162);
                        }
                    });
                }

                if (!empty($request['Religions']) ||
                    $request['Sects'] > 0) {
                    $customers = $customers->whereHas('customerReligionInfo', function($q) use ($request) {
                        if (!empty($request['Religions'])) {
                            $q->where('Religions', $request['Religions']);
                        }
                        if ($request['Sects'] > 0) {
                            $q->where('Sects', $request['Sects']);
                        }
                    });
                }

                if ($request['Castes'] > 0 ||
//                    !empty($request['WillingToRelocate']) ||
//                    !empty($request['MyBuilds']) ||
                    !empty($request['MyLivingArrangements']) ||
                    !empty($request['Heights']) ||
                    !empty($request['Disabilities'])) {
                    $customers = $customers->whereHas('customerPersonalInfo', function($q) use ($request) {
                        if ($request['Castes'] > 0) {
                            $q->where('Caste', $request['Castes']);
                        }
//                        if (!empty($request['WillingToRelocate'])) {
//                            $q->where('WillingToRelocate', $request['WillingToRelocate']);
//                        }
//                        if (!empty($request['MyBuilds'])) {
//                            $q->where('MyBuilds', $request['MyBuilds']);
//                        }
                        if (!empty($request['MyLivingArrangements'])) {
                            $q->where('MyLivingArrangements', $request['MyLivingArrangements']);
                        }
                        if ($request['Heights'] > 0) {
                            $q->where('Heights', $request['Heights']);
                        }
                        if (!empty($request['Disabilities'])) {
                            $q->where('Disabilities', $request['Disabilities']);
                        }
                    });
                }

                if ($request['EducationID'] > 0 || $request['OccupationID'] > 0 || $request['MyIncome'] > 0) {
                    $customers = $customers->whereHas('customerCareerInfo', function($q) use ($request) {
                        if ($request['EducationID'] > 0) {
                            $q->where('Qualification', $request['EducationID']);
                        }
                        if ($request['OccupationID'] > 0) {
                            $q->where('Profession', $request['OccupationID']);
                        }
                        if ($request['MyIncome'] > 0) {
                            $q->where('MonthlyIncome', $request['MyIncome']);
                        }
                    });
                }

                if (!empty($request['featuredProfile'])) {
                    $customers = $customers->where('featuredProfile', 1);
                }

                if (!empty($request['percentageFilter'])) {
                    $customers = $customers
                        ->where('mobile_verified',1)
                        ->where('email_verified',1)
                        ->where('profile_pic_status',1)
                        ->where('age_verification',1)
                        ->where('education_verification',1)
                        ->where('location_verification',1)
                        ->where('meeting_verification',1)
                        ->where('nationality_verification',1)
                        ->where('salary_verification',1);
                }

//                if (!empty($request['name'])) {
//                    $customers = $customers->where('name', $request['name']);
//                }
                $customers = $customers->where('deleted',0)
                    ->where('profile_status',1)
                    ->where('email_verified',1)
                    ->orderBy('blur_percent','asc')
                    ->orderBy('profile_pic_status','desc')
                    ->orderBy('profile_pic_client_status','desc')
//                    ->inRandomOrder()
                    ->skip($request['page'] * 10)
                    ->take(10)
                    ->get();

                return view('front.customer.partials.search_members',compact('customers'))->render();
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    public function viewProfile($userName)
    {
        $customer = Customer::with([
            'customerOtherInfo',
            'customerPersonalInfo',
            'customerSearch',
            'customerReligionInfo'
        ])->where('name',$userName)->first();
        if (empty($customer)) {
            abort(404);
        }
        $profileViewsCount = CustomerProfileView::where([
            'view_to' => $customer->id,
            'deleted' => 0
        ])->count();

        $profileLikesCount = CustomerLike::where([
            'like_to' => $customer->id,
            'deleted' => 0
        ])->count();

        $profileSavesCount = CustomerSaved::where([
            'save_to' => $customer->id,
            'deleted' => 0
        ])->count();

        $customerImages = CustomerImage::where([
            'CustomerID' => $customer->id,
            'deleted'    => 0
        ])->get();

        $customerBlockByMe = false;
        $customerLikedByMe = false;
        $customerSaveByMe = false;
        if (auth()->guard('customer')->check()) {
            $currentCustomerId = auth()->guard('customer')->id();
            $customerBlockByMe = !! CustomerBlock::where([
                'blockBy' => $currentCustomerId,
                'blockTo' => $customer->id
            ])->count();

            $customerLikedByMe = !! CustomerLike::where([
                'like_by' => $currentCustomerId,
                'like_to' => $customer->id
            ])->count();

            $customerSaveByMe = !! CustomerSaved::where([
                'save_by' => $currentCustomerId,
                'save_to' => $customer->id
            ])->count();
        }

        $title = 'Customer Profile';

        return view('front.customer.view_profile',compact(
            'title',
            'customer',
            'profileViewsCount',
            'profileLikesCount',
            'profileSavesCount',
            'customerBlockByMe',
            'customerLikedByMe',
            'customerSaveByMe',
            'customerImages'
        ));
    }

    public function customerReport()
    {
        $request = request()->all();
        if (!empty($request['customer_id'])) {
            $requestChecking = [
                'reportBy' => auth()->guard('customer')->id(),
                'reportTo' => FakerURL::id_d($request['customer_id'])
            ];
            $newRequest = $requestChecking;
            $newRequest['desc'] = $request['desc'];
            $res = CustomerReport::updateOrCreate($requestChecking,$newRequest);
            if (!empty($res)) {
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Customer has been reported successfully'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Customer has not been reported'
        ]);
    }

    public function customerBlockProcess()
    {
        $request = request()->all();
        if (!empty($request['customer_id'])) {
            $newRequest = [
                'blockBy' => auth()->guard('customer')->id(),
                'blockTo' => FakerURL::id_d($request['customer_id'])
            ];
            $row = CustomerBlock::where($newRequest)->first();
            if (!empty($row)) {
                $row->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Customer has been unblocked successfully'
                ]);
            } else {
                $newRequest['desc'] = $request['desc'];
                $res = CustomerBlock::create($newRequest);
                if (!empty($res)) {
                    return response()->json([
                        'status' => 'success',
                        'msg'    => 'Customer has been blocked successfully'
                    ]);
                }
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Request has not been submitted.'
        ]);
    }

    public function customerLikeUnlike()
    {
        if (!empty(request()->customer_id)) {
            $customerId = FakerURL::id_d(request()->customer_id);
            $currentCustomerId = auth()->guard('customer')->id();
            $newRequest = [
                'like_by' => $currentCustomerId,
                'like_to' => $customerId
            ];
            $row = CustomerLike::where($newRequest)->first();

            if (!empty($row)) {
                $row->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Customer has been unliked successfully'
                ]);
            } else {
                $res = CustomerLike::create($newRequest);
                if (!empty($res)) {
                    return response()->json([
                        'status' => 'success',
                        'msg'    => 'Customer has been liked successfully'
                    ]);
                }
            }
        }

        return response()->json([
            'status' => 'warning',
            'msg'    => 'Customer has not been liked'
        ]);
    }

    public function customerSaveUnsaved()
    {
        if (!empty(request()->customer_id)) {
            $customerId = FakerURL::id_d(request()->customer_id);
            $currentCustomerId = auth()->guard('customer')->id();
            $newRequest = [
                'save_by' => $currentCustomerId,
                'save_to' => $customerId
            ];
            $row = CustomerSaved::where($newRequest)->first();

            if (!empty($row)) {
                $row->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Customer has been unsaved successfully'
                ]);
            } else {
                $res = CustomerSaved::create($newRequest);
                if (!empty($res)) {
                    return response()->json([
                        'status' => 'success',
                        'msg'    => 'Customer has been saved successfully'
                    ]);
                }
            }
        }

        return response()->json([
            'status' => 'warning',
            'msg'    => 'Customer has not been saved'
        ]);
    }

    public function saveProfileClientStatus()
    {
        $request = request()->all();
        $customer = Customer::findOrFail(auth()->guard('customer')->id());
        $res = $customer->update($request);
        if (!empty($res)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Status has been changed successfully'
            ]);
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Status has not been changed'
        ]);
    }

    public function developerConfirmCustomerAccount($userName)
    {
        $customer = Customer::where('name',$userName)->first();
        if (empty($customer)) {
            abort(404);
        }
        if ($customer->status == 1 && $customer->email_verified == 1) {
            if(!auth()->guard('customer')->check()) {
                $customer = Customer::findOrFail($customer->id);
                auth()->guard('customer')->login($customer);
            }
            $message = "Your email verified already please login...!";
            session::flash('success_message', $message);
            return redirect()->route('landing.page');
        }
        $customer->update([
            'status' => 1,
            'email_verified' => 1,
            'email_verified_at' => date('Y-m-d')
        ]);

        if(!auth()->guard('customer')->check()) {
            $customer = Customer::findOrFail($customer->id);
            auth()->guard('customer')->login($customer);
        }

        $message = "Your email has been verified successfully";
        session::flash('success_message', $message);
        return redirect()->route('auth.verify');

    }

    public function getViewerProfiles()
    {
        $dataType = request()->data_type;
        $customers = [];
        $pageTitle = '';
        $customerIds = [];
        $currentCustomerId = auth()->guard('customer')->id();
        switch ($dataType) {
            case "youLike":
                $customerIds = CustomerLike::where('deleted',0)->where('like_by',$currentCustomerId)->pluck('like_to')->toArray();
                $pageTitle = 'Like Profiles';
                break;
            case "otherLike":
                $customerIds = CustomerLike::where('deleted',0)->where('like_to',$currentCustomerId)->pluck('like_by')->toArray();
                $pageTitle = 'Like By Other Profiles';
                break;
            case "youSave":
                $customerIds = CustomerSaved::where('deleted',0)->where('save_by',$currentCustomerId)->pluck('save_to')->toArray();
                $pageTitle = 'Save Profiles';
                break;
            case "otherSave":
                $customerIds = CustomerSaved::where('deleted',0)->where('save_to',$currentCustomerId)->pluck('save_by')->toArray();
                $pageTitle = 'Save By Other Profiles';
                break;
            case "otherView":
                $customerIds = CustomerProfileView::where('deleted',0)->where('view_to',$currentCustomerId)->pluck('view_by')->toArray();
                $pageTitle = 'Interested in Your Profile';
                break;
        }
        $customerIds = array_unique($customerIds);
        if (($key = array_search($currentCustomerId, $customerIds)) !== false) {
            unset($customerIds[$key]);
        }
        $customerIds = array_values($customerIds);
        if (count($customerIds) > 0) {
            $customers = Customer::where('deleted',0)->whereIn('id',$customerIds)->get();
        }

        return view('front.customer.partials.like_save_members',compact('pageTitle','customers'))->render();
    }

    public function customerCheckExists()
    {
        $request = request()->all();
        if (!empty($request['fieldName']) && !empty($request['fieldValue'])) {
            $whereCheck = [
                $request['fieldName'] => $request['fieldValue']
            ];
            $whereCheck['deleted'] = 0;
            $customer = Customer::where($whereCheck)->count();
            if ($customer > 0) {
                return response()->json([
                    'status' => 'warning',
                    'msg'    => 'Already exists*'
                ]);
            }
        }
        return response()->json(['status' => 'success']);
    }

    public function customerDeleteProfile()
    {
        DB::beginTransaction();
        try {
            $customerId = auth()->guard('customer')->id();
            $customer = Customer::findOrFail($customerId);
            $customer->update(['deleted' => 1]);
            CustomerCareerInfo::where(['deleted' => 0, 'CustomerID' => $customer->id])->update(['deleted' => 1]);
            CustomerOtherInfo::where(['deleted' => 0, 'RegistrationID' => $customer->id])->update(['deleted' => 1]);
            CustomerPersonalInfo::where(['deleted' => 0, 'CustomerID' => $customer->id])->update(['deleted' => 1]);
            CustomerSearch::where(['deleted' => 0, 'CustomerID' => $customer->id])->update(['deleted' => 1]);
            CustomerReligionInfo::where(['deleted' => 0, 'CustomerID' => $customer->id])->update(['deleted' => 1]);
            CustomerNotificationPreference::where(['deleted' => 0, 'CustomerID' => $customer->id])->update(['deleted' => 1]);
            auth()->guard('customer')->logout();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg'    => 'Profile has been deleted successfully',
                'data'   => $customerId
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Profile has not been deleted',
                'error'   => $e
            ]);
        }
    }

    public function stagingToLive()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://shaadi.org.pk/testing-with-db',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: XSRF-TOKEN=eyJpdiI6Inh0a1hBUFNjY1RsQi9xNy9hSmY4c1E9PSIsInZhbHVlIjoidWFNeWwvcGpKekwvblpJWFdPREYxNDVTUkVGd21zd1YxZnh1blN5alZRUXhpdTBuSmJLcmdZVVpPWVpTeklBOGpsUVNuSnprWk1wallaK2ltL2lsdHRrczNNUWtkdWRHWnhBZzAyMld1ZnBFUlZYOHR1dExITW1aaXdBZkZTMHciLCJtYWMiOiJiYWQ4YWY3YmVkNzMxNTFlMzE1NDU4OGUwMzk4ZDkzZmJkZWY2ODg1NjlhNWFhZjk4OWYyN2NmZTc4YjRjOWRmIiwidGFnIjoiIn0%3D; shaadiorgpk_session=eyJpdiI6Ik9xbCtFMnZvOURKYUdXY1E4RGZ6NVE9PSIsInZhbHVlIjoiYlZDc2l2SG1wVXNIa1d2V251eWtaOVc0TnBGaUM5azdDejR5UjFqZHczb0ZRWmlwWkxYQ09GV2d2SUNzRkFSQ1dVbk1nbWx3WkdpeWkxK3B0UUhJSzBIYU85NzFMU0pvaFhlcGRnajZtYnFPa2hHS3dEdGtJRklDaHlTSEpxQ2IiLCJtYWMiOiJkOTg3ODk4YjBiMTBkMjM1MjY2NzNmZmNkNzFlMDI0OTAyOTNhZjk0NmY2OWNkYjhkZWQwYTUyNmVkZmE2ODU3IiwidGFnIjoiIn0%3D'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $resArr = json_decode($response);
        $oldCustomer = null;
        if (!empty($resArr) && isset($resArr->data) && !empty($resArr->data)) {
            $oldCustomers = $resArr->data;
        }
        $images = [];
        foreach ($oldCustomers as $oldCustomer) {
            $oldCustomer = json_decode(json_encode($oldCustomer), true);
            $oldCustomer['password'] = '$2y$10$0iwkHTzLOfAvzNvrr3L.aeOBShqT9aEw11fZ40NPhugCHMp/kFQ1C';
            $customerExist = Customer::where('email',$oldCustomer['email'])->first();
            if (empty($customerExist)) {
                $newCustomer = Customer::create($oldCustomer);
                array_push($images,$newCustomer->image);
                if (!empty($newCustomer)) {
                    if ($oldCustomer['customer_other_info']) {
                        $oldCustomer['customer_other_info']['RegistrationID'] = $newCustomer->id;
                        $successData = CustomerOtherInfo::create($oldCustomer['customer_other_info']);
                        $newCustomer->customer_other_info = $successData;
                    }
                    if ($oldCustomer['customer_personal_info']) {
                        $oldCustomer['customer_personal_info']['CustomerID'] = $newCustomer->id;
                        $successData = CustomerPersonalInfo::create($oldCustomer['customer_personal_info']);
                        $newCustomer->customer_personal_info = $successData;
                    }
                    if ($oldCustomer['customer_notification_preference']) {
                        $oldCustomer['customer_notification_preference']['customerID'] = $newCustomer->id;
                        $successData = CustomerNotificationPreference::create($oldCustomer['customer_notification_preference']);
                        $newCustomer->customer_notification_preference = $successData;
                    }
                    if ($oldCustomer['customer_search']) {
                        $oldCustomer['customer_search']['customerID'] = $newCustomer->id;
                        $successData = CustomerSearch::create($oldCustomer['customer_search']);
                        $newCustomer->customer_search = $successData;
                    }
                    if ($oldCustomer['customer_religion_info']) {
                        $oldCustomer['customer_religion_info']['CustomerID'] = $newCustomer->id;
                        $successData = CustomerReligionInfo::create($oldCustomer['customer_religion_info']);
                        $newCustomer->customer_religion_info = $successData;
                    }
                    if ($oldCustomer['customer_career_info']) {
                        $oldCustomer['customer_career_info']['CustomerID'] = $newCustomer->id;
                        $successData = CustomerCareerInfo::create($oldCustomer['customer_career_info']);
                        $newCustomer->customer_career_info = $successData;
                    }
                    if ($oldCustomer['customer_family_info']) {
                        $oldCustomer['customer_family_info']['CustomerID'] = $newCustomer->id;
                        $successData = CustomerFamilyInfo::create($oldCustomer['customer_family_info']);
                        $newCustomer->customer_family_info = $successData;
                    }
                    if ($oldCustomer['customer_residential_info']) {
                        $oldCustomer['customer_residential_info']['CustomerID'] = $newCustomer->id;
                        $successData = CustomerResidentialInfo::create($oldCustomer['customer_residential_info']);
                        $newCustomer->customer_residential_info = $successData;
                    }
                }
            }
        }
        dd('Done',$oldCustomer,$images);

    }

}
