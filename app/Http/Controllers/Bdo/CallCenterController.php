<?php

namespace App\Http\Controllers\Bdo;

use App\helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Models\CallHistory;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerImage;
use App\Models\CustomerNotificationPreference;
use App\Models\Package;
use App\Models\SupportMessage;
use App\Models\User;
use App\Services\TwoFactor\Authy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Image;

class CallCenterController extends Controller
{
    protected $authy;

    public function __construct(Authy $authy)
    {
        $this->authy = $authy;
    }

    public function index()
    {
        if (auth()->guard('bdo')->check()) {
            return redirect()->route('bdo.get.customers.center');
        } else {
            return redirect()->route('bdo.view.login');
        }
    }

    public function loginView()
    {
        if (auth()->guard('bdo')->check()) {
            return redirect()->route('bdo.get.customers.center');
        }
        return view('bdo.login');
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
        ])->whereIn('role_id',[1,2,3,4])->first();
        if($existingAdmin == null) {
            return redirect()->back()->withErrors(['errors'=>'User Not Exists'])->withInput();
        }
        $admin = auth()->guard('bdo')->attempt(['email' => $request['email'], 'password' => $request['password']]);
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
            return redirect()->route('bdo.get.customers.center');
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
        $user = auth()->guard('bdo')->user();
        $user->update([
            'authy_approval_id'     => '',
            'authy_approval_status' => 'pending'
        ]);
        auth()->guard('bdo')->logout();
        return redirect()->route('bdo.view.login');
    }

    public function getCustomers()
    {
        $request = request();

        $currentUserId = auth()->guard('bdo')->id();
        $currentUserRoleId = auth()->guard('bdo')->user()->role_id;
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
            $fType = $request->fType;
            $fStart_act_date = $request->fStart_act_date;
            $fEnd_act_date = $request->fEnd_act_date;
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

            if ($currentUserRoleId==3) {
                $customers = $customers->where('user_lead_id',$currentUserId);
//                if (!empty($fUserId)) {
//                    $customers = $customers->where('user_id',$fUserId);
//                }
            } elseif ($currentUserRoleId==4) {
                $customers = $customers->where('user_id',$currentUserId);
            }
//            else {
//                if (!empty($fUserId)) {
//                    $customers = $customers->where('user_lead_id',$fUserId);
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

            if (!empty($fStart_act_date) && !empty($fEnd_act_date)) {
                $customers = $customers->whereBetween('last_activity_datetime',[$fStart_act_date, $fEnd_act_date]);
            }

            $userOrLeader = (in_array($currentUserRoleId,[1,2])) ? 'user_lead_id' : 'user_id';
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

            if (!empty($fType)) {
                if ($fType=='cms') {
                    $customers = $customers->where('created_by','>',0);
                }
                if ($fType=='web') {
                    $customers = $customers->where('created_by','=',0);
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
//            $customers = $customers->orderBy($orderByColumn, $orderBy);
            $count = $customers->count();
            $customers = $customers->orderBy($orderByColumn, $orderBy)->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $customers
            ], 200);
        }
        $title = 'All Customers';
        if ($currentUserRoleId==3) {
            $users = User::where([
                'deleted' => 0,
                'supervisor_id' => $currentUserId
            ])->get();
        } else {
            $users = User::where([
                'deleted' => 0,
                'role_id' => 3
            ])->get();
        }

        $countries = Country::where('deleted',0)->orderBy('order_at','asc')->get();
        return view('bdo.call_center.customers',compact('title','users','currentUserRoleId','countries'));
    }

    public function getCustomerDetail($customerId)
    {
        $currentUserRoleId = auth()->guard('bdo')->user()->role_id;
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

        $callHistory = CallHistory::where('type', 'bdo')->where('customer_id',$customer->id)->get();
        $photos = CustomerImage::where('CustomerID',$customer->id)->get();
        $dataEntryUsers = User::where('role_id',5)->get();
        $title = 'Customer Detail';
        return view('bdo.call_center.detail',compact('title','customer','callHistory','currentUserRoleId','photos','dataEntryUsers'));
    }

    public function customersAssign()
    {
        $assignUserId = request()->assign_user_id;
        $customerIds = request()->assign_check;
        if (!empty($assignUserId) && count($customerIds) > 0) {
            $user = User::findOrFail(FakerURL::id_d($assignUserId));
            if ($user->role_id==4) {
                Customer::whereIn('id',$customerIds)->where('deleted',0)->update([
                    'user_id'         => $user->id,
                    'user_lead_id'    => $user->supervisor_id,
                    'assign_datetime' => date('Y-m-d H:i:s')
                ]);
            } elseif ($user->role_id==3) {
                Customer::whereIn('id',$customerIds)->where('deleted',0)->update([
                    'user_lead_id'    => $user->id,
                    'assign_datetime' => date('Y-m-d H:i:s')
                ]);
            }
            return response()->json([
                'status' => 'success',
                'msg'    => 'Customer has been assigned successfully'
            ]);
        } else {
            if (empty($assignUserId)) {
                Customer::whereIn('id',$customerIds)->where('deleted',0)->update([
                    'user_id'         => NULL,
                    'user_lead_id'    => NULL,
                    'assign_datetime' => NULL
                ]);
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Customer has been unassigned successfully'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Customer has not been assigned'
        ]);
    }

    public function customersRequest()
    {
        $requestNumber = request()->request_number;
        $currentUserId = auth()->guard('bdo')->id();
        $currentUserSupervisorId = auth()->guard('bdo')->user()->supervisor_id;
        if (!empty($currentUserSupervisorId)) {
            $pendingLeads = Customer::where([
                'deleted'                => 0,
                'user_id'                => $currentUserId,
//                'user_lead_id'           => $currentUserSupervisorId,
                'last_activity_datetime' => NULL
            ])->count();
        } else {
            $pendingLeads = Customer::where([
                'deleted'                => 0,
                'user_lead_id'           => $currentUserId,
                'last_activity_datetime' => NULL
            ])->count();
        }
        if ($pendingLeads >= 10) {
            return response()->json([
                'status' => 'warning',
                'msg'    => "Your total pending leads should be less than 10 <br> Your current pending leads ($pendingLeads)"
            ]);
        }

        $customerIds = Customer::where([
            'deleted'      => 0,
            'user_id'      => NULL,
            'user_lead_id' => NULL,
            'created_by'   => 0
        ])->limit($requestNumber)->orderBy('id','desc')->pluck('id')->toArray();

        if (count($customerIds) > 0) {
            if (!empty($currentUserSupervisorId)) {
                Customer::whereIn('id',$customerIds)->where('deleted',0)->update([
                    'user_id'      => $currentUserId,
                    'user_lead_id' => $currentUserSupervisorId,
                    'assign_datetime' => date('Y-m-d H:i:s')
                ]);
            } else {
                Customer::whereIn('id',$customerIds)->where('deleted',0)->update([
                    'user_lead_id'    => $currentUserId,
                    'assign_datetime' => date('Y-m-d H:i:s')
                ]);
            }

            return response()->json([
                'status' => 'success',
                'msg'    => "$requestNumber leads has been assigned successfully"
            ]);
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => "No new leads available right now.*"
        ]);
    }

    public function saveCallHistory()
    {
        $request = request()->all();
        if (!empty($request['comment']) && !empty($request['customer_id'])) {
            $request['user_id'] = auth()->guard('bdo')->id();
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

    public function saveCustomerOtherStatus()
    {
        $request = request()->all();
        if (!empty($request['customer_f']) && !empty($request['customer_id'])) {
            $fieldName = $request['customer_f'];
            $customer = Customer::findOrFail($request['customer_id']);
            $res = $customer->update([$fieldName => $request['customer_v']]);
            if (!empty($res)) {
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Status has been changed successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Status has not been changed.'
        ]);
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
            $customer = Customer::findOrFail($request->customer_id);
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) .time(). '.' . $extension;
                    $blur_percent = (isset($request->blur_percent) && $request->blur_percent > 0 ? $request->blur_percent : 0);

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

                    $customer->update(['image' => $imageName, 'blur_percent' => $blur_percent]);
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
                        $imageName = rand(111, 99999).time(). '.' . $extension;

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

    public function getSupport()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
//            $orderArray = ['id'];
//            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderByColumn = 'updated_at';
            $orderBy = $request->input('order.0.dir', 'asc');
            $issueType = (!empty($request->fType)) ? $request->fType : 'Pending';
            $agencies = SupportMessage::where('issue', $issueType);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->where('full_name', 'like', '%' . $search . '%');
                    $query->orWhere('mobile_number', 'like', '%' . $search . '%');
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
        $title = 'Customer Support';
        return view('bdo.call_center.support', compact('title'));
    }

    public function getSupportDetail($supportId='')
    {
        if (empty($supportId)) {
            abort(404);
        }
        $support = SupportMessage::with('getCustomer')->findOrFail(FakerURL::id_d($supportId));

        $callHistory = CallHistory::where('type', 'support')->where('customer_id',$support->id)->get();
        $title = 'Customer Support';
        return view('bdo.call_center.support_detail', compact('title','support','callHistory'));
    }

    public function supportStatus()
    {
        $issue = request()->issue;
        $supportId = request()->support_id;
        $supportRow = SupportMessage::findOrFail($supportId);
        $oldIssue = $supportRow->issue;
        $successRes = $supportRow->update(['issue' => $issue]);
        if (!empty($successRes)) {
            $callHistory = CallHistory::create([
                'type' => 'support',
                'user_id' => auth()->guard('bdo')->id(),
                'customer_id' => $supportRow->id,
                'comment'     => "Issue status changed ( $oldIssue to $issue )."
            ]);

            if (!empty($callHistory)) {
                $callHistory->date_with_format = date('d M Y h:i A',strtotime($callHistory->created_at));
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Support Status has been changed successfully.',
                    'data'   => $callHistory
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Support Status has not been changed.'
        ]);
    }

    public function saveSupportHistory()
    {
        $request = request()->all();
        if (!empty($request['comment']) && !empty($request['customer_id'])) {
            $request['user_id'] = auth()->guard('bdo')->id();
            $request['type'] = 'support';
            $callHistory = CallHistory::create($request);
            if (!empty($callHistory)) {
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

    public function getPackageRequest()
    {
        $request = request();
        if ($request->ajax()) {
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $status = (!empty($request->fStatus)) ? $request->fStatus : 0;
            $agencies = PackageRequest::where([
                'status' => $status,
                'user_id' => auth()->guard('bdo')->id()
            ]);
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Customer Package Request';
        return view('bdo.call_center.package_request', compact('title'));
    }

    public function packageRequestDelete($id)
    {
        $row = PackageRequest::findOrFail(FakerURL::id_d($id));
        if ($row->status==0) {
            $row->delete();
            return response()->json([
                'status' => 'success',
                'msg' => 'Request has been deleted successfully.'
            ], 200);
        }
        return response()->json([
            'status' => 'warning',
            'msg' => 'Request has not been deleted.'
        ], 200);
    }

    public function newPackageRequest()
    {
        $packages = Package::where('id','>',1)->get();
        $title = 'New Package Request Form';
        return view('bdo.call_center.new_package_request', compact('title','packages'));
    }

    public function fetchCustomer()
    {
        $request = request();
        $rules = [
            'search_by'    => 'required|in:Link,Email,Username,Phone',
            'search_value' => 'required|max:255',
            'package_id'   => 'required|numeric|exists:shaadi_packages,id'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }
        $customerWhere = [
            'deleted' => 0,
            'status'  => 1
        ];
        $searchValue = $request['search_value'];
        switch ($request['search_by']) {
            case "Link":
                $searchValue = explode("/",$searchValue);
                $searchValue = end($searchValue);
                $searchValue = explode("-",$searchValue);
                $searchValue = end($searchValue);
                $customerWhere['id'] = FakerURL::id_d($searchValue);
                break;
            case "Email":
                $customerWhere['email'] = $searchValue;
                break;
            case "Username":
                $customerWhere['name'] = $searchValue;
                break;
            case "Phone":
                $customerWhere['mobile'] = $searchValue;
                break;
            default:
                return response()->json([
                    'status' => 'warning',
                    'msg'    => 'Customer not found*'
                ]);
        }

        $customer = Customer::where($customerWhere)->first();
        if (empty($customer)) {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Customer not found*'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'msg'    => 'Customer has been fetched successfully.',
            'data'   => view('bdo.call_center.fetch_customer_detail', compact('customer'))->render()
        ]);
    }

    public function savePackageRequest()
    {
        $request = request()->all();
        $rules = [
            'search_by'    => 'required|in:Link,Email,Username,Phone',
            'search_value' => 'required|max:255',
            'package_id'   => 'required|numeric|exists:shaadi_packages,id',
            'approved_by'  => 'required|in:Sir,Madam,Both'
        ];

        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        $request['user_id'] = auth()->guard('bdo')->id();
        $packageRequest = PackageRequest::create($request);
        if (!empty($packageRequest)) {
            return response()->json([
                'status'  => 'success',
                'msg' => 'Package request has been send successfully.'
            ], 200);
        }

        return response()->json([
            'status'  => 'warning',
            'msg' => 'Package request has not been send.'
        ], 200);
    }

    public function getMediaPackageRequest()
    {
        $request = request()->all();
        $packageRequest = null;
        if (!empty($request['package_request_id'])) {
            $packageRequest = PackageRequest::with('allMedia')->findOrFail(FakerURL::id_d($request['package_request_id']));
        }
        return view('media_package_request',compact('packageRequest'))->render();
    }

    public function saveMediaPackageRequest()
    {
        $request = request();
        $rules = [
            'images_request.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        $packageRequestRow = PackageRequest::findOrFail(FakerURL::id_d($request->package_request_id));
        if ($request->hasFile('images_request')) {
            $image_tmp = $request->file('images_request');
            foreach ($image_tmp as $key => $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $imageName = rand(111, 99999).time(). '.' . $extension;
                    $main_image = public_path('home_page/payment-ss/' . $imageName);
                    Image::make($image)->save($main_image);
                    MediaPackageRequest::create([
                        'package_request_id' => $packageRequestRow->id,
                        'image'              => $imageName
                    ]);
                }
            }
            $packageRequest = PackageRequest::with('allMedia')->findOrFail($packageRequestRow->id);
            newPackageRequest(['user_name' => auth()->guard('bdo')->user()->name]);
            return response()->json([
                'status' => 'success',
                'msg'    => 'Media has been saved successfully',
                'data'   => view('media_package_request',compact('packageRequest'))->render()
            ], 200);
        }
        return response()->json([
            'status'  => 'warning',
            'msg' => 'Media has not been saved'
        ], 200);
    }

    public function deleteMediaPackageRequest()
    {
        $media = MediaPackageRequest::findOrFail(FakerURL::id_d(request()->image_id));

        if (file_exists(public_path('home_page/payment-ss/'.$media->image))) {
            unlink(public_path('home_page/payment-ss/'.$media->image));
        }
        $media->delete();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Media image has been deleted successfully'
        ], 200);
    }

    public function getCustomersManage()
    {
        $request = request();
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
            $fStart_act_date = $request->fStart_act_date;
            $fEnd_act_date = $request->fEnd_act_date;
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
            }])->where([
                ['deleted', '=', 0],
                ['created_by', '=', 0],
                ['email', 'NOT LIKE', '%shaadi.org.pk%']
            ]);

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

            if (!empty($fStart_act_date) && !empty($fEnd_act_date)) {
                $customers = $customers->whereBetween('last_activity_datetime',[$fStart_act_date, $fEnd_act_date]);
            }

            if (!empty($fAssign)) {
                if ($fAssign==1) {
                    $customers = $customers->whereNotNull('user_id');
                } else {
                    $customers = $customers->whereNull('user_id');
                }
            }

            if (!empty($fUserId)) {
                $customers = $customers->where('user_id',FakerURL::id_d($fUserId));
            }

            if (!empty($search)) {
                $customers = $customers->where(function ($query) use ($search) {
                    $query->orWhere('email', 'like', '%'. $search . '%');
                    $query->orWhere('mobile', 'like', '%'. $search . '%');
                    $query->orWhere('first_name', 'like', '%'. $search . '%');
                    $query->orWhere('last_name', 'like', '%'. $search . '%');
                });
            }
            $count = $customers->count();
            $customers = $customers->orderBy($orderByColumn, $orderBy)->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $customers
            ], 200);
        }
        if (!in_array(auth()->guard('bdo')->id(),[4])) {
            return redirect()->route('bdo.get.customers.center');
        }
        $title = 'Manage Customers';

        $users = User::where([
            'deleted' => 0,
            'role_id' => 4
        ])->get();


        $countries = Country::where('deleted',0)->orderBy('order_at','asc')->get();
        return view('bdo.call_center.customers-manage',compact('title','users','countries'));
    }

    public function saveCustomerBadges($customerId)
    {
        $request = request()->all();
        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail(FakerURL::id_d($customerId));
            $request['profile_status'] = (isset($request['profile_status'])) ? $request['profile_status'] : 0;
            $request['profile_pic_status'] = (isset($request['profile_pic_status'])) ? $request['profile_pic_status'] : 0;
            $request['profile_gallery_status'] = (isset($request['profile_gallery_status'])) ? 1 : 0;
            $request['profile_home_page_status'] = (isset($request['profile_home_page_status'])) ? 1 : 0;
            $request['is_highlight'] = (isset($request['is_highlight'])) ? 1 : 0;

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

}
