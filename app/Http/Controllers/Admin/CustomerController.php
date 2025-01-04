<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\CustomerImage;
use App\Models\CustomerNotificationPreference;
use App\Models\CustomerOtherInfo;
use App\Models\CustomerPersonalInfo;
use App\Models\CustomerReligionInfo;
use App\Models\CustomerReport;
use App\Models\CustomerSearch;
use App\Models\Disability;
use App\Models\DoYouHaveBeard;
use App\Models\DoYouKeepHalal;
use App\Models\DoYouPerformSalaah;
use App\Models\DoYouPreferHijab;
use App\Models\Education;
use App\Models\EyeColor;
use App\Models\FuturePlan;
use App\Models\HairColor;
use App\Models\Height;
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
use App\Models\Sect;
use App\Models\Smoke;
use App\Models\State;
use App\Models\University;
use App\Models\Weight;
use App\Models\WillingToRelocate;
use App\Rules\Adult;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;

class CustomerController extends Controller
{
    /*Customers*/
    public function getCustomers($fromToData='today')
    {
        $request = request();
        $currentUserId = auth()->guard('admin')->id();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
//            $agencies = Customer::with('unreadMessageNumber')->where('deleted',0);

            switch ($fromToData) {
                case 'today':
                    $agencies = Customer::with('unreadMessageNumber')->where('deleted',0)->whereDate('created_at', today());
                    break;
                case 'weekly':
                    $agencies = Customer::with('unreadMessageNumber')->where('deleted',0)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'monthly':
                    $agencies = Customer::with('unreadMessageNumber')->where('deleted',0)->whereMonth('created_at', today());
                    break;
                case 'yearly':
                    $agencies = Customer::with('unreadMessageNumber')->where('deleted',0)->whereYear('created_at', today());
                    break;
                case 'assign':
                    $agencies = Customer::with('unreadMessageNumber')->where('deleted',0)->where('data_entry_user_id', $currentUserId);
                    break;
                default:
                    $agencies = Customer::with('unreadMessageNumber')->where('deleted',0);
            }

            if (auth()->guard('admin')->user()->role_id > 1) {
                $agencies = $agencies->where('created_by', $currentUserId);
            }

            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%'. $search . '%');
                    $query->orWhere('email', 'like', '%'. $search . '%');
                    $query->orWhere('first_name', 'like', '%'. $search . '%');
                    $query->orWhere('last_name', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'All Customers';
        return view('admin.customers.index',compact('title','fromToData'));
    }

    public function getFiltersCustomers()
    {
        $request = request();
        $startDate = date('Y-m-d');
        $endDate = date('Y-m-d');
        $emailVerified = '';
        $profileImage = '';
        $profileStatus = '';
        $approvalChanges = '';
        $type = 'web';
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');

            if (!empty($request->fStart_date)) {
                $startDate = $request->fStart_date;
            }
            if (!empty($request->fEnd_date)) {
                $endDate = $request->fEnd_date;
            }
            if (!empty($request->fType)) {
                $type = $request->fType;
            }
            if (!empty($request->fEmailVerified)) {
                $emailVerified = $request->fEmailVerified;
            }
            if (!empty($request->fProfileImage)) {
                $profileImage = $request->fProfileImage;
            }
            if (!empty($request->fProfileStatus)) {
                $profileStatus = $request->fProfileStatus;
            }

            if (!empty($request->fApprovalChanges)) {
                $approvalChanges = $request->fApprovalChanges;
            }

            $agencies = Customer::where('deleted',0);
            if (!empty($startDate) && !empty($endDate) && $approvalChanges != 1) {
                $newStartDate = date('Y-m-d 00:00:01',strtotime($startDate));
                $newEndDate = date('Y-m-d 23:59:59',strtotime($endDate));
                $agencies = $agencies->whereBetween('created_at',[$newStartDate, $newEndDate]);
            }
            if ($type=='cms') {
                $agencies = $agencies->where('created_by','>',0);
            }
            if ($type=='web') {
                $agencies = $agencies->where('created_by','=',0);
            }
            if ($emailVerified) {
                $agencies = $agencies->where('email_verified',$emailVerified);
            }
            if ($profileImage==0) {
                $agencies = $agencies->whereIn('image',['default-female.jpg','default-male.jpg','default-user.png']);
            }
            if ($profileImage==1) {
                $agencies = $agencies->whereNotIn('image',['default-female.jpg','default-male.jpg','default-user.png']);
            }
            if ($profileStatus) {
                $agencies = $agencies->where('profile_pic_status',$profileStatus);
            }
            if ($approvalChanges) {
                $agencies = $agencies->where('changes_approval',$approvalChanges);
            }
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%'. $search . '%');
                    $query->orWhere('email', 'like', '%'. $search . '%');
                    $query->orWhere('first_name', 'like', '%'. $search . '%');
                    $query->orWhere('last_name', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'All Filters Customers';
        return view('admin.customers.filters',compact('title','startDate','endDate','type'));
    }

    public function changeCustomerStatus()
    {
        $request = request()->all();
        $statusName = $request['statusName'];
        $customer = Customer::findOrFail(FakerURL::id_d($request['customerId']));
        if ($statusName=='verified') {
            $successRes = $customer->update([
                'status' => ($customer->status==1) ? 0 : 1,
                'email_verified' => ($customer->email_verified==1) ? 0 : 1,
                'email_verified_at' => date('Y-m-d')
            ]);
            if (!empty($successRes)) {
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Status has been changed successfully'
                ]);
            }
        } else {
            if (isset($customer->$statusName)) {
                $newStatus = ($customer->$statusName==1) ? 0 : 1;
                $successRes = $customer->update([$statusName => $newStatus]);
                if (!empty($successRes)) {
                    return response()->json([
                        'status' => 'success',
                        'msg'    => 'Status has been changed successfully'
                    ]);
                }
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Status has not been changed'
        ]);
    }

    public function deleteCustomer($customerId)
    {
        if ($customerId) {
            $customer = Customer::where('id',FakerURL::id_d($customerId))->first();
            if (!empty($customer)) {
                $customer->update([
                    'deleted'        => 1,
                    'profile_status' => 2,
                    'email'          => $customer->email.$customer->id,
                    'mobile'         => $customer->mobile.$customer->id,
                    'name'           => $customer->name.$customer->id
                ]);
//                $customer->update(['deleted' => 1,'profile_status' => 2]);
                CustomerCareerInfo::where(['deleted' => 0, 'CustomerID' => $customer->id])->update(['deleted' => 1]);
                CustomerOtherInfo::where(['deleted' => 0, 'RegistrationID' => $customer->id])->update(['deleted' => 1]);
                CustomerPersonalInfo::where(['deleted' => 0, 'CustomerID' => $customer->id])->update(['deleted' => 1]);
                CustomerSearch::where(['deleted' => 0, 'CustomerID' => $customer->id])->update(['deleted' => 1]);
                CustomerReligionInfo::where(['deleted' => 0, 'CustomerID' => $customer->id])->update(['deleted' => 1]);
                CustomerNotificationPreference::where(['deleted' => 0, 'CustomerID' => $customer->id])->update(['deleted' => 1]);
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Customer has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Customer has not been deleted.'
        ]);
    }

    public function getCustomerDetail($customerId)
    {
        $customer = Customer::with([
            'customerOtherInfo',
            'customerPersonalInfo',
            'customerSearch',
            'customerReligionInfo',
            'customerNotificationPreference'
        ])->findOrFail(FakerURL::id_d($customerId));
        if (empty($customer)) {
            abort(404);
        }
        $title = 'Customer Detail';
        $photos = CustomerImage::where('CustomerID',$customer->id)->get();
        $packages = Package::where('status',1)->get();
        return view('admin.customers.detail',compact('title','customer','photos','packages'));
    }

    public function saveCustomerBadges($customerId)
    {
        $request = request()->all();
        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail(FakerURL::id_d($customerId));
            if (auth()->guard('admin')->user()->role_id==1) {
                $request['profile_status'] = (isset($request['profile_status'])) ? $request['profile_status'] : 0;
            }
            $request['profile_pic_status'] = (isset($request['profile_pic_status'])) ? $request['profile_pic_status'] : 0;
            $request['profile_gallery_status'] = (isset($request['profile_gallery_status'])) ? 1 : 0;
            $request['profile_home_page_status'] = (isset($request['profile_home_page_status'])) ? 1 : 0;
            $request['email_verified'] = (isset($request['email_verified'])) ? 1 : 0;
            $request['mobile_verified'] = (isset($request['mobile_verified'])) ? 1 : 0;
            $request['age_verification'] = (isset($request['age_verification'])) ? 1 : 0;
            $request['education_verification'] = (isset($request['education_verification'])) ? 1 : 0;
            $request['location_verification'] = (isset($request['location_verification'])) ? 1 : 0;
            $request['meeting_verification'] = (isset($request['meeting_verification'])) ? 1 : 0;
            $request['nationality_verification'] = (isset($request['nationality_verification'])) ? 1 : 0;
            $request['salary_verification'] = (isset($request['salary_verification'])) ? 1 : 0;
            $request['is_highlight'] = (isset($request['is_highlight'])) ? 1 : 0;

            if (isset($request['profile_pic_status']) || isset($request['profile_gallery_status'])) {
                $request['changes_approval'] = 0;
            }

            $customer->update($request);

            CustomerNotificationPreference::updateOrCreate([
                'customerID' => $customer->id
            ],$request);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg'    => 'Customer badges has been updated successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Customer badges has not been updated.',
                'error'  => $e
            ]);
        }
    }

    public function getAllBlockCustomers()
    {
        $request = request()->all();
        $fBy = (isset($request['f_by'])) ? $request['f_by'] : null;
        $fSd = (isset($request['f_sd'])) ? $request['f_sd'] : null;
        $fEd = (isset($request['f_ed'])) ? $request['f_ed'] : null;

        $fBy = (!empty($fBy)) ? $fBy : 'today';

        switch ($fBy) {
            case "today":
                $blockCustomers = CustomerBlock::where('deleted',0)->whereDate('created_at',today())->paginate();
                break;
            case "weekly":
                $blockCustomers = CustomerBlock::where('deleted',0)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->paginate();
                break;
            case "monthly":
                $blockCustomers = CustomerBlock::where('deleted',0)->whereMonth('created_at', today())->paginate();
                break;
            case "yearly":
                $blockCustomers = CustomerBlock::where('deleted',0)->whereYear('created_at', today())->paginate();
                break;
            case "custom":
                if (!empty($fSd) && !empty($fEd)) {
                    $fSd = date('Y-m-d 00:00:01',strtotime($fSd));
                    $fEd = date('Y-m-d 23:59:59',strtotime($fEd));
                    $blockCustomers = CustomerBlock::where('deleted',0)->whereBetween('created_at', [$fSd, $fEd])->paginate();
                }
                break;
        }
        $title = 'Block Customers List';
        return view('admin.customers.block',compact('title','blockCustomers','fBy','fSd','fEd'));
    }

    public function getAllReportCustomers()
    {
        $request = request()->all();
        $fBy = (isset($request['f_by'])) ? $request['f_by'] : null;
        $fSd = (isset($request['f_sd'])) ? $request['f_sd'] : null;
        $fEd = (isset($request['f_ed'])) ? $request['f_ed'] : null;

        $fBy = (!empty($fBy)) ? $fBy : 'today';

        switch ($fBy) {
            case "today":
                $reportCustomers = CustomerReport::where('deleted',0)->whereDate('created_at',today())->paginate();
                break;
            case "weekly":
                $reportCustomers = CustomerReport::where('deleted',0)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->paginate();
                break;
            case "monthly":
                $reportCustomers = CustomerReport::where('deleted',0)->whereMonth('created_at', today())->paginate();
                break;
            case "yearly":
                $reportCustomers = CustomerReport::where('deleted',0)->whereYear('created_at', today())->paginate();
                break;
            case "custom":
                if (!empty($fSd) && !empty($fEd)) {
                    $fSd = date('Y-m-d 00:00:01',strtotime($fSd));
                    $fEd = date('Y-m-d 23:59:59',strtotime($fEd));
                    $reportCustomers = CustomerReport::where('deleted',0)->whereBetween('created_at', [$fSd, $fEd])->paginate();
                }
                break;
        }
        $title = 'Report Customers List';
        return view('admin.customers.report',compact('title','reportCustomers','fBy','fSd','fEd'));
    }

    public function getAllCustomersMessages()
    {
        $request = request()->all();
        $fBy = (isset($request['f_by'])) ? $request['f_by'] : null;
        $fSd = (isset($request['f_sd'])) ? $request['f_sd'] : null;
        $fEd = (isset($request['f_ed'])) ? $request['f_ed'] : null;

        $fBy = (!empty($fBy)) ? $fBy : 'today';

        switch ($fBy) {
            case "today":
                $messages = CustomerChatting::with(['getReceiverCustomer','getSenderCustomer'])->where('deleted',0)->whereDate('created_at',today())->get();
                break;
            case "weekly":
                $messages = CustomerChatting::with(['getReceiverCustomer','getSenderCustomer'])->where('deleted',0)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->get();
                break;
            case "monthly":
                $messages = CustomerChatting::with(['getReceiverCustomer','getSenderCustomer'])->where('deleted',0)->whereMonth('created_at', today())->get();
                break;
            case "yearly":
                $messages = CustomerChatting::with(['getReceiverCustomer','getSenderCustomer'])->where('deleted',0)->whereYear('created_at', today())->get();
                break;
            case "custom":
                if (!empty($fSd) && !empty($fEd)) {
                    $fSd = date('Y-m-d 00:00:01',strtotime($fSd));
                    $fEd = date('Y-m-d 23:59:59',strtotime($fEd));
                    $messages = CustomerChatting::with(['getReceiverCustomer','getSenderCustomer'])->where('deleted',0)->whereBetween('created_at', [$fSd, $fEd])->get();
                }
                break;
        }
        $title = 'Customers Messages Ono to One';
        return view('admin.customers.messages',compact('title','messages','fBy','fSd','fEd'));
    }

    public function personalNoteSave()
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'persona_note'   => 'required',
            'RegistrationID' => 'required|numeric'
        ],[
            'persona_note'   => 'The personal note field is required.'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        $request['personal_note_approve'] = (isset($request['personal_note_approve']) && !empty($request['personal_note_approve'])) ? 1 : 0;

        CustomerOtherInfo::updateOrCreate([
            'RegistrationID' => $request['RegistrationID']
        ],$request);

        return response()->json([
            'status' => 'success',
            'msg'    => 'Personal note has been saved successfully',
        ]);
    }

    public function customerPackageSave()
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'package_id'   => 'required'
        ],[
            'package_id'   => 'Please first select package.'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        DB::beginTransaction();
        try {
            $package = Package::findOrFail($request['package_id']);

            $customer = Customer::findOrFail($request['customer_id']);
            $duration = $package->duration;
            $startDate = date('Y-m-d 00:00:00');
            $endDate = date('Y-m-d 23:59:59',strtotime("+$duration days"));
            $customer->update([
                'user_package'       => $package->package_name,
                'user_package_color' => $package->color,
                'package_id'         => $package->id,
                'package_expiry_date'=> $endDate
            ]);
            CustomerNotificationPreference::updateOrCreate([
                'customerID' => $customer->id
            ],[
                'customerID'       => $customer->id,
                'messagelimits'    => $package->direct_messages,
                'limit_start_date' => $startDate,
                'limit_end_date'   => $endDate
            ]);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg'    => 'Customer package has been saved successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Customer package has not been saved',
            ]);
        }
    }

    public function addEditCustomer($customerId='')
    {
        $customer = null;
        $title = 'Add Customer';
        $countries = Country::where('deleted',0)->orderBy('order_at','asc')->get();
        $registrationReasons = RegistrationsReason::where('deleted',0)->orderBy('order_at','asc')->get();
        $maritalStatuses = MaritalStatus::where('deleted',0)->orderBy('order_at','asc')->get();

        $educations = Education::where('deleted',0)->orderBy('order_at','asc')->get();
        $occupations = Occupation::where('deleted',0)->orderBy('order_at','asc')->get();
        $tongues = MotherTongue::where('deleted',0)->orderBy('order_at','asc')->get();
        $incomes = AnnualInCome::where('deleted',0)->orderBy('order_at','asc')->get();
//        $universities = University::where('deleted',0)->orderBy('order_at','asc')->get();
//        $jobPosts = JobPost::where('deleted',0)->orderBy('order_at','asc')->get();
//        $futurePlans = FuturePlan::where('deleted',0)->orderBy('order_at','asc')->get();

//        $willingToRelocates = WillingToRelocate::where('deleted',0)->orderBy('order_at','asc')->get();
        $lookingToMarries = IAmLookingToMarry::where('deleted',0)->orderBy('order_at','asc')->get();
        $livingArrangements = MyLivingArrangement::where('deleted',0)->orderBy('order_at','asc')->get();
        $heights = Height::where('deleted',0)->orderBy('order_at','asc')->get();
        $weights = Weight::where('deleted',0)->orderBy('order_at','asc')->get();
        $complexions = Complexion::where('deleted',0)->orderBy('order_at','asc')->get();
//        $myBuilds = MyBuild::where('deleted',0)->orderBy('order_at','asc')->get();
        $hairColors = HairColor::where('deleted',0)->orderBy('order_at','asc')->get();
        $eyeColors = EyeColor::where('deleted',0)->orderBy('order_at','asc')->get();
        $smokes = Smoke::where('deleted',0)->orderBy('order_at','asc')->get();
        $disabilities = Disability::where('deleted',0)->orderBy('order_at','asc')->get();
        $castes = Caste::where('deleted',0)->orderBy('order_at','asc')->get();

        $religions = Religion::where('deleted',0)->orderBy('order_at','asc')->get();
        $preferHijabs = DoYouPreferHijab::where('deleted',0)->orderBy('order_at','asc')->get();
        $reverts = AreYouRevert::where('deleted',0)->orderBy('order_at','asc')->get();
//        $performSalaahs = DoYouPerformSalaah::where('deleted',0)->orderBy('order_at','asc')->get();
        $beards = DoYouHaveBeard::where('deleted',0)->orderBy('order_at','asc')->get();
        $halals = DoYouKeepHalal::where('deleted',0)->orderBy('order_at','asc')->get();

        $sects = [];
        $states = [];
        $cities = [];
        $areas = [];

//        $statesOfOrigin = [];
//        $citiesOfOrigin = [];
        $statesExpectation = [];
        $citiesExpectation = [];
        $sectsExpectation = [];
//        $majorCourses = [];
        if (!empty($customerId)) {
            $customer = Customer::with([
                'customerOtherInfo',
                'customerPersonalInfo',
                'customerSearch',
                'customerReligionInfo',
                'customerCareerInfo'
            ])->findOrFail(FakerURL::id_d($customerId));
            $title = 'Edit Customer';

            if (!empty($customer->customerOtherInfo)) {
                $states = State::where('country_id',$customer->customerOtherInfo->country_id)->where('deleted',0)->orderBy('order_at','asc')->get();
                $cities = City::where('state_id',$customer->customerOtherInfo->state_id)->where('deleted',0)->orderBy('order_at','asc')->get();
            }

//            if (!empty($customer->customerPersonalInfo)) {
//                $statesOfOrigin = State::where('country_id',$customer->customerPersonalInfo->CountryOfOrigin)->where('deleted',0)->orderBy('order_at','asc')->get();
//                $citiesOfOrigin = City::where('state_id',$customer->customerPersonalInfo->StateOfOrigin)->where('deleted',0)->orderBy('order_at','asc')->get();
//            }

            if (!empty($customer->customerReligionInfo)) {
                $sects = Sect::where('religions_id',$customer->customerReligionInfo->Religions)->where('deleted',0)->orderBy('order_at','asc')->get();
            }

            if (!empty($customer->customerSearch) && !empty($customer->customerSearch->title)) {
                $customerSearch = json_decode($customer->customerSearch->title);
                $statesExpectation = State::where('country_id',$customerSearch->country_id)->where('deleted',0)->orderBy('order_at','asc')->get();
                $citiesExpectation = City::where('state_id',$customerSearch->state_id)->where('deleted',0)->orderBy('order_at','asc')->get();
                $sectsExpectation = Sect::where('religions_id',$customerSearch->Religions)->where('deleted',0)->orderBy('order_at','asc')->get();
            }

//            if (!empty($customer->customerCareerInfo)) {
//                $majorCourses = MajorCourse::where('education_id',$customer->customerCareerInfo->Qualification)->where('deleted',0)->orderBy('order_at','asc')->get();
//            }
        }
        return view('admin.customers.add_edit',compact(
            'title',
            'customer',
            'countries',
            'registrationReasons',
            'maritalStatuses',
            'educations',
            'occupations',
            'tongues',
            'incomes',
//            'universities',
//            'jobPosts',
//            'futurePlans',
//            'willingToRelocates',
            'lookingToMarries',
            'livingArrangements',
            'heights',
            'weights',
            'complexions',
//            'myBuilds',
            'hairColors',
            'eyeColors',
            'smokes',
            'disabilities',
            'castes',
            'religions',
            'preferHijabs',
            'reverts',
//            'performSalaahs',
            'sects',
            'beards',
            'halals',
            'states',
            'cities',
            'areas',
//            'statesOfOrigin',
//            'citiesOfOrigin',
            'statesExpectation',
            'citiesExpectation',
            'sectsExpectation'
//            'majorCourses'
        ));
    }

    public function makeBlurImage($imageName,$blur_percent='25')
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
        if (file_exists($imageNewPath)) {
            unlink($imageNewPath);
        }
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

    public function createUpdateCustomer($customerId='')
    {
        $request = request()->all();
        $rules = [
            'gender'                         => 'required|numeric',
//            'name'                           => 'required|max:255',
            'first_name'                     => 'required|max:255',
            'last_name'                      => 'required|max:255',
            'MaritalStatusID'                => 'required|numeric',
            'DOB'                            => ['required','date_format:Y-m-d', new Adult],
            'country_id'                     => 'required|numeric',
            'state_id'                       => 'required|numeric',
            'city_id'                        => 'required|numeric',
            'mobile'                         => 'required|max:255',
            'RegistrationsReasonsID'         => 'required|numeric',
//            'second_marraige'                => 'required|numeric',
            'email'                          => 'required|email|max:255',
            'Qualification'                  => 'required|numeric',
//            'major_course_id'                => 'required|numeric',
//            'University'                     => 'required|numeric',
            'Profession'                     => 'required|numeric',
//            'JobPost'                        => 'required|numeric',
            'MonthlyIncome'                  => 'required|numeric',
//            'FuturePlans'                    => 'required|numeric',
//            'CountryOfOrigin'                => 'required|numeric',
//            'StateOfOrigin'                  => 'required|numeric',
//            'CityOfOrigin'                   => 'required|numeric',
//            'WillingToRelocate'              => 'required|numeric',
            'IAmLookingToMarry'              => 'required|numeric',
            'MyLivingArrangements'           => 'required|numeric',
            'Heights'                        => 'required|numeric',
            'Weights'                        => 'required|numeric',
            'Complexions'                    => 'required|numeric',
//            'MyBuilds'                       => 'required|numeric',
            'HairColors'                     => 'required|numeric',
            'EyeColors'                      => 'required|numeric',
            'Smokes'                         => 'required|numeric',
            'Disabilities'                   => 'required|numeric',
            'Caste'                          => 'required|numeric',
            'MyFirstLanguageMotherTonguesID' => 'required|numeric',
            'Religions'                      => 'required|numeric',
            'Sects'                          => 'required|numeric',
            'DoYouPreferHijabs'              => 'required|numeric',
            'DoYouHaveBeards'                => 'required|numeric',
            'AreYouReverts'                  => 'required|numeric',
            'DoYouKeepHalal'                 => 'required|numeric',
//            'DoYouPerformSalaah'             => 'required|numeric',
        ];
        if (empty($customerId)) {
//            $rules['name'] = 'required|max:255|unique:shaadi_customers,name';
            $rules['mobile'] = 'required|max:255|unique:shaadi_customers,mobile';
            $rules['email'] = 'required|email|max:255|unique:shaadi_customers,email';
            $rules['password'] = 'required|min:6';
        }
        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        DB::beginTransaction();
        try {
            $request['dob_date'] = date('d',strtotime($request['DOB']));
            $request['dob_month'] = date('m',strtotime($request['DOB']));
            $request['dob_year'] = date('Y',strtotime($request['DOB']));
            $request['age'] = date("Y") - $request['dob_year'];
            $request['second_marraige'] = ($request['gender']==1) ? 1 : 2;

            $request['EducationID'] = $request['Qualification'];
            $request['OccupationID'] = $request['Profession'];
            $request['MaritalStatus'] = $request['MaritalStatusID'];
            $request['ReligionsID'] = $request['Religions'];
            $request['SectID'] = $request['Sects'];
            $request['MySecondLanguageMotherTonguesID'] = $request['MyFirstLanguageMotherTonguesID'];
            $request['email_verified'] = 1;
            $request['email_verified_at'] = date('Y-m-d');
            $request['mobile_verified'] = 1;
            $request['mobile_verified_at'] = date('Y-m-d');
            $request['status'] = 1;
            $request['profile_status'] = 1;
//            $request['profile_pic_status'] = 1;
//            $request['profile_home_page_status'] = 1;
            $newImage = '';
            if (request()->hasFile('image')) {
                $image_tmp = request()->file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
//                    $imageName = rand(111, 99999) .time(). '.' . $extension;
                    $uniqueKeyword = getUniqueKeyword();
                    $imageName = $uniqueKeyword.'-'.date('YmdHis').'.'.$extension;

                    if ($request['blur_percent'] > 0) {
                        $main_image = public_path('customer-images/original_images/' . $imageName);
                        Image::make($image_tmp)->resize(500, 500, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($main_image,60);

                        $this->makeBlurImage($imageName,$request['blur_percent']);
                    } else {
                        $main_image = public_path('customer-images/' . $imageName);
                        Image::make($image_tmp)->resize(500, 500, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($main_image,60);
                    }
                    $newImage = $imageName;
                }
            }
            $expectationData['title'] = json_encode($request['expectation']);
            unset($request['expectation']);
            if (!empty($customerId)) {
                $request['updated_by'] = auth()->guard('admin')->id();
                $customer = Customer::findOrFail(FakerURL::id_d($customerId));
                $request['image'] = $customer->image;
                if (!empty($newImage)) {
                    $request['image'] = $newImage;
                    if (!in_array($customer->image,['default-female.jpg','default-male.jpg','default-user.png']) && file_exists(public_path('customer-images/'.$customer->image))) {
                        unlink(public_path('customer-images/'.$customer->image));
                    }
                    if (!in_array($customer->image,['default-female.jpg','default-male.jpg','default-user.png']) && file_exists(public_path('customer-images/original_images/'.$customer->image))) {
                        unlink(public_path('customer-images/original_images/'.$customer->image));
                    }
                }
                $customer->update($request);
            } else {
                $request['created_by'] = auth()->guard('admin')->id();
                $request['password'] = Hash::make($request['password']);
                $request['image'] = ($request['gender']==1) ? 'default-male.jpg' : 'default-female.jpg';
                if (!empty($newImage)) {
                    $request['image'] = $newImage;
                }
                $customer = Customer::create($request);
            }
            if (!empty($customer)) {
                $request['RegistrationID'] = $customer->id;
                $request['CustomerID'] = $customer->id;
                $expectationData['customerID'] = $customer->id;

                CustomerOtherInfo::updateOrCreate([
                    'RegistrationID' => $customer->id
                ],$request);

                CustomerPersonalInfo::updateOrCreate([
                    'CustomerID' => $customer->id
                ],$request);

                CustomerCareerInfo::updateOrCreate([
                    'CustomerID' => $customer->id
                ],$request);

                CustomerReligionInfo::updateOrCreate([
                    'CustomerID' => $customer->id
                ],$request);

                CustomerSearch::updateOrCreate([
                    'customerID' => $customer->id
                ],$expectationData);
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Customer has been saved successfully'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Customer has not been saved',
                'error'   => $e
            ]);
        }

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
            $customer = Customer::findOrFail($request->customer_id);
            if ($request->hasFile('public_gallery')) {
                $image_tmp = $request->file('public_gallery');
                if (count($image_tmp) > 5) {
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

    public function changeProfileBlur()
    {
        $customerId = request()->customerId;
        $customer = Customer::findOrFail($customerId);
        $res = $this->makeBlurImage($customer->image);
        if (!empty($res)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Image has been changed with new blur successfully'
            ]);
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Image has not been changed'
        ]);
    }

    public function changeProfilesBlur()
    {
        $customers = Customer::where('id','>=',33546)
            ->where('id','<=',38464)
            ->where('deleted',0)
            ->where('blur_percent','>',0)
            ->where('profile_pic_status',1)
            ->where('profile_pic_client_status',1)
            ->where('profile_home_page_status',1)
            ->inRandomOrder()
            ->limit(50)
            ->get();
        $activityCountIds = [];
        foreach($customers as $customer) {
            if (file_exists(public_path('customer-images/original_images/'.$customer->image))) {
                $this->makeBlurImage($customer->image);
                if ($customer->created_by > 0) {
                    Customer::findOrFail($customer->id)->update(['profile_home_page_status' => 0]);
                    array_push($activityCountIds,$customer->id);
                }
            }
        }
        dd("Blur has been changed for these profiles ".count($activityCountIds),$activityCountIds);
    }

}
