<?php

namespace App\Http\Controllers\MatchMaking;

use App\helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Models\AnnualInCome;
use App\Models\AreYouRevert;
use App\Models\CallHistory;
use App\Models\Caste;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerImage;
use App\Models\Disability;
use App\Models\DoYouHaveBeard;
use App\Models\DoYouKeepHalal;
use App\Models\DoYouPerformSalaah;
use App\Models\DoYouPreferHijab;
use App\Models\Education;
use App\Models\EyeColor;
use App\Models\FamilyValue;
use App\Models\HairColor;
use App\Models\Height;
use App\Models\IAmLookingToMarry;
use App\Models\MaritalStatus;
use App\Models\MotherTongue;
use App\Models\MyBuild;
use App\Models\MyLivingArrangement;
use App\Models\Occupation;
use App\Models\Religion;
use App\Models\ResidenceStatus;
use App\Models\Smoke;
use App\Models\User;
use App\Models\WillingToRelocate;
use App\Services\TwoFactor\Authy;
use Illuminate\Support\Facades\Validator;
use Image;

class MatchCenterController extends Controller
{
    protected $authy;

    public function __construct(Authy $authy)
    {
        $this->authy = $authy;
    }

    public function index()
    {
        if (auth()->guard('match')->check()) {
            return redirect()->route('match.get.customers.center');
        } else {
            return redirect()->route('match.view.login');
        }
    }

    public function loginView()
    {
        if (auth()->guard('match')->check()) {
            return redirect()->route('match.get.customers.center');
        }
        return view('match.login');
    }

    public function loginProcess()
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'email'    => 'required|email|exists:shaadi_users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $existingAdmin = User::where([
            'deleted' => 0,
            'email'   => $request['email']
        ])->whereIn('role_id',[1,7,8,9])->first();
        if($existingAdmin == null) {
            return redirect()->back()->withErrors(['errors'=>'User Not Exists'])->withInput();
        }
        $admin = auth()->guard('match')->attempt(['email' => $request['email'], 'password' => $request['password']]);
        if(!empty($admin)) {
            /* Here you can send code */
//            if ($existingAdmin->role_id == 1) {
//                $existingAdmin->update([
//                    'authy_approval_status' => 'approved'
//                ]);
//            } else {
                $authyApprovalId = $this->makeNewRequest($existingAdmin);
                $existingAdmin->update([
                    'authy_approval_id'     => $authyApprovalId,
                    'authy_approval_status' => 'pending'
                ]);
//            }
            return redirect()->route('match.get.customers.center');
        } else {
            return redirect()->back()->withErrors(['errors'=>'Invalid Credentials'])->withInput();
        }
    }

    public function makeNewRequest($user)
    {
        $authyId = config('services.authy.id');
        $message = "User ($user->name) wants approval request for login.";
        $options = [
            "details[Username]"    => $user->name,
            "details[Designation]" => $user->role_name,
            "details[email]"       => $user->email
        ];
        $response = $this->authy->createApprovalRequest($authyId,$message,$options);
        if ($response->ok()) {
            return $response->bodyvar("approval_request")->uuid;
        }
        return '';
    }

    public function logoutProcess()
    {
        $user = auth()->guard('match')->user();
        $user->update([
            'authy_approval_id'     => '',
            'authy_approval_status' => 'pending'
        ]);
        auth()->guard('match')->logout();
        return redirect()->route('match.view.login');
    }

    public function allCustomers()
    {
        $request = request();
        $title = 'All Customers';

        if ($request->ajax()) {
            $orderByColumn = 'id';
            $search = $request->input('search.value', '');
            $orderBy = $request->input('order.0.dir', 'desc');
            if (!empty($request->profile_link)) {
                $profileLink = explode("/",$request->profile_link);
                $profileLink = end($profileLink);
                $profileLink = explode("-",$profileLink);
                $profileLink = end($profileLink);
                $customerId = FakerURL::id_d($profileLink);
                $customers = Customer::where('deleted',0)->where('id',$customerId)->with([
                    'getCountryName',
                    'getCitiesName',
                    'customerOtherInfo',
                    'customerReligionInfo',
                    'customerPersonalInfo',
                    'customerCareerInfo'
                ]);
            } else {
                $customers = Customer::where('deleted',0)->with([
                    'getCountryName',
                    'getCitiesName',
                    'customerOtherInfo' => function($q) use($request){
                        $maritalStatusIdArr = [];
                        if ($request->customer_type == 'second') {
                            $maritalStatusIdArr = array_merge($maritalStatusIdArr,[7,9,16]);
                        }
                        if ($request->customer_type == 'divorced') {
                            $maritalStatusIdArr = array_merge($maritalStatusIdArr,[3,4,8,12]);
                        }
                        if (!empty($request->MaritalStatus)) {
                            array_push($maritalStatusIdArr,$request->MaritalStatus);
                        }
                        if (count($maritalStatusIdArr) > 0) {
                            $q->whereIn('MaritalStatusID',$maritalStatusIdArr);
                        }
                        if (!empty($request->gender)) {
                            $q->where('gender', $request->gender);
                        }
                        if (!empty($request->ageFrom) && !empty($request->ageTo)) {
                            $q->whereBetween('age', [$request->ageFrom, $request->ageTo]);
                        } elseif (!empty($request->ageFrom)) {
                            $q->where('age', '>=', $request->ageFrom);
                        } elseif (!empty($request->ageTo)) {
                            $q->where('age', '<=', $request->ageTo);
                        }
                        if (!empty($request->country_id)) {
                            $q->where('country_id', $request->country_id);
                        }
                        if (!empty($request->state_id)) {
                            $q->where('state_id', $request->state_id);
                        }
                        if (!empty($request->city_id)) {
                            $q->where('city_id', $request->city_id);
                        }
                        if (isset($request->area_id) && count($request->area_id) > 0) {
                            $q->whereIn('area_id', $request->area_id);
                        }
                        if (!empty($request->Tongue)) {
                            $q->where('MyFirstLanguageMotherTonguesID', $request->Tongue);
                        }
                    }, 'customerReligionInfo' => function($q) use ($request) {
                        if (!empty($request->Religions)) {
                            $q->where('Religions', $request->Religions);
                        }
                        if (!empty($request->Sects)) {
                            $q->where('Sects', $request->Sects);
                        }
                    }, 'customerResidentialInfo' => function($q) use ($request) {
                        if (!empty($request->ResidenceStatus)) {
                            $q->where('ResidenceStatus', $request->ResidenceStatus);
                        }
                        if (!empty($request->FamilyValues)) {
                            $q->where('FamilyValues', $request->FamilyValues);
                        }
                    }, 'customerPersonalInfo' => function($q) use ($request) {
                        if (!empty($request->Castes)) {
                            $q->where('Caste', $request->Castes);
                        }
                        if (!empty($request->WillingToRelocate)) {
                            $q->where('WillingToRelocate', $request->WillingToRelocate);
                        }
                        if (!empty($request->MyBuilds)) {
                            $q->where('MyBuilds', $request->MyBuilds);
                        }
                        if (!empty($request->MyLivingArrangements)) {
                            $q->where('MyLivingArrangements', $request->MyLivingArrangements);
                        }
                        if (!empty($request->Heights)) {
                            $q->where('Heights', $request->Heights);
                        }
                        if (!empty($request->Disabilities)) {
                            $q->where('Disabilities', $request->Disabilities);
                        }
                    }, 'customerCareerInfo' => function($q) use ($request) {
                        if (isset($request->EducationID) && count($request->EducationID) > 0) {
                            $q->whereIn('Qualification', $request->EducationID);
                        }
//                      if (!empty($request->EducationID)) {
//                            $q->where('Qualification', $request->EducationID);
//                        }
                        if (!empty($request->OccupationID)) {
                            $q->where('Profession', $request->OccupationID);
                        }
                        if (!empty($request->MyIncome)) {
                            $q->where('MonthlyIncome', $request->MyIncome);
                        }
                    }
                ]);

                if (!empty($request->gender) ||
                    isset($request->customer_type) ||
                    !empty($request->ageFrom) ||
                    !empty($request->MaritalStatus) ||
                    !empty($request->ageTo) ||
                    !empty($request->country_id) ||
                    !empty($request->state_id) ||
                    !empty($request->city_id) ||
                    isset($request->area_id) ||
                    !empty($request->Tongue)) {
                    $customers = $customers->whereHas('customerOtherInfo', function($q) use($request){
                        $maritalStatusIdArr = [];
                        if ($request->customer_type == 'second') {
                            $maritalStatusIdArr = array_merge($maritalStatusIdArr,[7,9,16]);
                        }
                        if ($request->customer_type == 'divorced') {
                            $maritalStatusIdArr = array_merge($maritalStatusIdArr,[3,4,8,12]);
                        }
                        if (!empty($request->MaritalStatus)) {
                            array_push($maritalStatusIdArr,$request->MaritalStatus);
                        }
                        if (count($maritalStatusIdArr) > 0) {
                            $q->whereIn('MaritalStatusID',$maritalStatusIdArr);
                        }
                        if (!empty($request->gender)) {
                            $q->where('gender', $request->gender);
                        }
                        if (!empty($request->ageFrom) && !empty($request->ageTo)) {
                            $q->whereBetween('age', [$request->ageFrom, $request->ageTo]);
                        } elseif (!empty($request->ageFrom)) {
                            $q->where('age', '>=', $request->ageFrom);
                        } elseif (!empty($request->ageTo)) {
                            $q->where('age', '<=', $request->ageTo);
                        }
                        if (!empty($request->country_id)) {
                            $q->where('country_id', $request->country_id);
                        }
                        if (!empty($request->state_id)) {
                            $q->where('state_id', $request->state_id);
                        }
                        if (!empty($request->city_id)) {
                            $q->where('city_id', $request->city_id);
                        }
                        if (isset($request->area_id) && count($request->area_id) > 0) {
                            $q->whereIn('area_id', $request->area_id);
                        }
                        if (!empty($request->Tongue)) {
                            $q->where('MyFirstLanguageMotherTonguesID', $request->Tongue);
                        }
                    });
                }

                if (!empty($request->Religions) || !empty($request->Sects)) {
                    $customers = $customers->whereHas('customerReligionInfo', function($q) use ($request) {
                        if (!empty($request->Religions)) {
                            $q->where('Religions', $request->Religions);
                        }
                        if (!empty($request->Sects)) {
                            $q->where('Sects', $request->Sects);
                        }
                    });
                }

                if (!empty($request->ResidenceStatus) || !empty($request->FamilyValues)) {
                    $customers = $customers->whereHas('customerResidentialInfo', function($q) use ($request) {
                        if (!empty($request->ResidenceStatus)) {
                            $q->where('ResidenceStatus', $request->ResidenceStatus);
                        }
                        if (!empty($request->FamilyValues)) {
                            $q->where('FamilyValues', $request->FamilyValues);
                        }
                    });
                }

                if (!empty($request->Castes) ||
                    !empty($request->WillingToRelocate) ||
                    !empty($request->MyBuilds) ||
                    !empty($request->MyLivingArrangements) ||
                    !empty($request->Heights) ||
                    !empty($request->Disabilities)) {
                    $customers = $customers->whereHas('customerPersonalInfo', function($q) use ($request) {
                        if (!empty($request->Castes)) {
                            $q->where('Caste', $request->Castes);
                        }
                        if (!empty($request->WillingToRelocate)) {
                            $q->where('WillingToRelocate', $request->WillingToRelocate);
                        }
                        if (!empty($request->MyBuilds)) {
                            $q->where('MyBuilds', $request->MyBuilds);
                        }
                        if (!empty($request->MyLivingArrangements)) {
                            $q->where('MyLivingArrangements', $request->MyLivingArrangements);
                        }
                        if (!empty($request->Heights)) {
                            $q->where('Heights', $request->Heights);
                        }
                        if (!empty($request->Disabilities)) {
                            $q->where('Disabilities', $request->Disabilities);
                        }
                    });
                }

                if (!empty($request->EducationID) || !empty($request->OccupationID) || !empty($request->MyIncome)) {
                    $customers = $customers->whereHas('customerCareerInfo', function($q) use ($request) {
                        if (isset($request->EducationID) && count($request->EducationID) > 0) {
                            $q->whereIn('Qualification', $request->EducationID);
                        }
//                        if (!empty($request->EducationID)) {
//                            $q->where('Qualification', $request->EducationID);
//                        }
                        if (!empty($request->OccupationID)) {
                            $q->where('Profession', $request->OccupationID);
                        }
                        if (!empty($request->MyIncome)) {
                            $q->where('MonthlyIncome', $request->MyIncome);
                        }
                    });
                }

                if (!empty($request->customer_type=='featured')) {
                    $customers = $customers->where('featuredProfile', 1);
                }
                if (!empty($request->armed_forces)) {
                    $customers = $customers->where('armed_forces', $request->armed_forces);
                }

                if (!empty($request->customer_type=='verified')) {
                    $customers = $customers
                        ->where('mobile_verified',1)
                        ->where('email_verified',1)
                        ->where('profile_pic_status',1)
                        ->where('meeting_verification',1)
                        ->where('age_verification',1)
                        ->where('education_verification',1)
                        ->where('location_verification',1)
                        ->where('nationality_verification',1);
                }

                if (!empty($request->customer_type=='semi_verified')) {
                    $customers = $customers
                        ->where('mobile_verified',1)
                        ->where('email_verified',1)
                        ->where('profile_pic_status',1)
                        ->where('meeting_verification',1)
                        ->where('age_verification',0)
                        ->where('education_verification',0)
                        ->where('location_verification',0)
                        ->where('nationality_verification',0);
                }

                if (!empty($request->customer_type=='not_verified')) {
                    $customers = $customers
                        ->where('age_verification',0)
                        ->where('education_verification',0)
                        ->where('location_verification',0)
                        ->where('meeting_verification',0)
                        ->where('nationality_verification',0);
                }
            }

            if (!empty($search)) {
                $customers = $customers->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%'. $search . '%');
                    $query->orWhere('email', 'like', '%'. $search . '%');
                    $query->orWhere('first_name', 'like', '%'. $search . '%');
                    $query->orWhere('last_name', 'like', '%'. $search . '%');
                });
            }
            $customers = $customers->orderBy($orderByColumn, $orderBy);
            $count = $customers->count();
            $customers = $customers->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $customers,
                'test' => $orderBy
            ], 200);
        }

        $countries = Country::where('deleted',0)->orderBy('order_at','asc')->get();
        $states = [];
        $cities = [];
        $tongues = MotherTongue::where('deleted',0)->orderBy('order_at','asc')->get();
        $religions = Religion::where('deleted',0)->orderBy('order_at','asc')->get();
        $sects = [];
        $castes = Caste::where('deleted',0)->orderBy('order_at','asc')->get();
        $educations = Education::where('deleted',0)->orderBy('order_at','asc')->get();
        $occupations = Occupation::where('deleted',0)->orderBy('order_at','asc')->get();
        $incomes = AnnualInCome::where('deleted',0)->orderBy('order_at','asc')->get();
        $willingToRelocates = WillingToRelocate::where('deleted',0)->orderBy('order_at','asc')->get();
        $myBuilds = MyBuild::where('deleted',0)->orderBy('order_at','asc')->get();
        $maritalStatues = MaritalStatus::where('deleted',0)->orderBy('order_at','asc')->get();
        $livingArrangements = MyLivingArrangement::where('deleted',0)->orderBy('order_at','asc')->get();
        $heights = Height::where('deleted',0)->orderBy('order_at','asc')->get();
        $disabilities = Disability::where('deleted',0)->orderBy('order_at','asc')->get();
        $residenceStatus = ResidenceStatus::where('deleted',0)->orderBy('order_at','asc')->get();
        $familyStatus = FamilyValue::where('deleted',0)->orderBy('order_at','asc')->get();
        return view('match.maker.all_customers',compact(
            'title',
            'countries',
                'states',
                'cities',
                'tongues',
                'religions',
                'sects',
                'castes',
                'educations',
                'occupations',
                'incomes',
                'willingToRelocates',
                'myBuilds',
                'maritalStatues',
                'livingArrangements',
                'heights',
                'disabilities',
                'residenceStatus',
                'familyStatus'
        ));
    }

    public function getCustomers()
    {
        $request = request();

        $title = 'My Customers';
        $currentUserId = auth()->guard('match')->id();
        $currentUserRoleId = auth()->guard('match')->user()->role_id;

        if ($request->ajax()) {
            switch ($request->input('order.0.column', 0)) {
                case 1:
                    $orderByColumn = 'id';
                    break;
                case 2:
                    $orderByColumn = 'created_at';
                    break;
                case 3:
                    $orderByColumn = 'assign_datetime';
                    break;
                case 4:
                    $orderByColumn = 'last_activity_datetime';
                    break;
                default:
                    $orderByColumn = 'id';
            }
            $search = $request->input('search.value', '');
            $fCustomers = $request->fCustomers;
            $fStart_date = $request->fStart_date;
            $fEnd_date = $request->fEnd_date;
            $fAssign = $request->fAssign;
            $fUserId = $request->fUserId;
            $orderBy = $request->input('order.0.dir', 'desc');
            $customers = Customer::with(['getCountryName','getCitiesName','customerOtherInfo' => function($q) use($request) {
                if (!empty($request->fGender)) {
                    $q->where('gender', $request->fGender);
                }
                if (!empty($request->fCountryId)) {
                    $q->where('country_id', $request->fCountryId);
                }
                if (!empty($request->fStateId)) {
                    $q->where('state_id', $request->fStateId);
                }
                if (!empty($request->fCityId)) {
                    $q->where('city_id', $request->fCityId);
                }
            }])->where('deleted',0);

            if (
                !empty($request->fGender) ||
                !empty($request->fCountryId) ||
                !empty($request->fStateId) ||
                !empty($request->fCityId)
            ){
                $customers = $customers->whereHas('customerOtherInfo', function($q) use($request) {
                    if (!empty($request->fGender)) {
                        $q->where('gender', $request->fGender);
                    }
                    if (!empty($request->fCountryId)) {
                        $q->where('country_id', $request->fCountryId);
                    }
                    if (!empty($request->fStateId)) {
                        $q->where('state_id', $request->fStateId);
                    }
                    if (!empty($request->fCityId)) {
                        $q->where('city_id', $request->fCityId);
                    }
                });
            }

            if ($currentUserRoleId==8) {
                $customers = $customers->where('match_user_lead_id',$currentUserId);
//                if (!empty($fUserId)) {
//                    $customers = $customers->where('match_user_id',$fUserId);
//                }
            } elseif ($currentUserRoleId==9) {
                $customers = $customers->where('match_user_id',$currentUserId);
            }
//            else {
//                if (!empty($fUserId)) {
//                    $customers = $customers->where('match_user_lead_id',$fUserId);
//                }
//            }

            /*Custom Filters*/
            if (!empty($fCustomers)) {
                if ($fCustomers=='today') {
                    $customers = $customers->whereDate('created_at',today());
                } elseif ($fCustomers=='weekly') {
                    $customers = $customers->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                } elseif ($fCustomers=='monthly') {
                    $customers = $customers->whereMonth('created_at', today());
                } elseif ($fCustomers=='yearly') {
                    $customers = $customers->whereYear('created_at', today());
                } elseif ($fCustomers=='custom') {
                    if (!empty($fStart_date) && !empty($fEnd_date)) {
                        $customers = $customers->whereBetween('created_at',[$fStart_date, $fEnd_date]);
                    }
                }
            }

            $userOrLeader = (in_array($currentUserRoleId,[1,7])) ? 'match_user_lead_id' : 'match_user_id';
            if (!empty($fAssign)) {
                if ($fAssign==1) {
                    $customers = $customers->whereNotNull($userOrLeader);
                } else {
                    $customers = $customers->whereNull($userOrLeader);
                }
            }

            if (!empty($fUserId)) {
                $customers = $customers->where($userOrLeader,FakerURL::id_d($fUserId));
            }

            if (!empty($search)) {
                $customers = $customers->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%'. $search . '%');
                    $query->orWhere('email', 'like', '%'. $search . '%');
                    $query->orWhere('first_name', 'like', '%'. $search . '%');
                    $query->orWhere('last_name', 'like', '%'. $search . '%');
                });
            }
            $customers = $customers->orderBy($orderByColumn, $orderBy);
            $count = $customers->count();
            $customers = $customers->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $customers,
                'test' => $orderBy
            ], 200);
        }

        if ($currentUserRoleId==8) {
            $users = User::where([
                'deleted' => 0,
                'supervisor_id' => $currentUserId
            ])->get();
        } else {
            $users = User::where([
                'deleted' => 0,
                'role_id' => 8
            ])->get();
        }
        $countries = Country::where('deleted',0)->orderBy('order_at','asc')->get();
        return view('match.maker.customers',compact(
            'title',
            'currentUserId',
            'currentUserRoleId',
            'users',
            'countries'
        ));
    }

    public function getCustomerDetail($customerId)
    {
        $currentUserRoleId = auth()->guard('match')->user()->role_id;
        $customer = Customer::with([
            'customerOtherInfo',
            'customerPersonalInfo',
            'customerSearch',
            'customerReligionInfo',
            'customerNotificationPreference',
            'customerResidentialInfo',
            'customerFamilyInfo'
        ])->findOrFail(FakerURL::id_d($customerId));
        if (empty($customer)) {
            abort(404);
        }

        $callHistory = CallHistory::where('type', 'match')->where('customer_id',$customer->id)->get();
        $photos = CustomerImage::where('CustomerID',$customer->id)->get();
        $dataEntryUsers = User::where('role_id',5)->get();
        $title = 'Customer Detail';
        return view('match.maker.detail',compact('title','customer','callHistory','currentUserRoleId','photos','dataEntryUsers'));
    }

    public function customersAssign()
    {
        $assignUserId = request()->assign_user_id;
        $customerIds = request()->assign_check;
        if (!empty($assignUserId) && count($customerIds) > 0) {
            $user = User::findOrFail(FakerURL::id_d($assignUserId));
            if ($user->role_id==9) {
                Customer::whereIn('id',$customerIds)->update([
                    'match_user_id'         => $user->id,
                    'match_user_lead_id'    => $user->supervisor_id,
                    'match_assign_datetime' => date('Y-m-d H:i:s')
                ]);
            } elseif ($user->role_id==8) {
                Customer::whereIn('id',$customerIds)->update([
                    'match_user_lead_id'    => $user->id,
                    'match_assign_datetime' => date('Y-m-d H:i:s')
                ]);
            }
            return response()->json([
                'status' => 'success',
                'msg'    => 'Customer has been assigned successfully'
            ]);
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Customer has not been assigned'
        ]);
    }

    public function saveCallHistory()
    {
        $request = request()->all();
        if (!empty($request['comment']) && !empty($request['customer_id'])) {
            $request['user_id'] = auth()->guard('match')->id();
            $request['type'] = 'match';
            $callHistory = CallHistory::create($request);
            if (!empty($callHistory)) {
                Customer::findOrFail($callHistory->customer_id)->update([
                    'last_activity_datetime' => date('Y-m-d H:i:s')
                ]);
                $callHistory->date_with_format = date('d M Y h:i A',strtotime($callHistory->created_at));
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Comment has been saved successfully.',
                    'data'   => $callHistory
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Comment has not been saved.'
        ]);
    }

}
