<?php
namespace App\Http\Controllers\Admin;
use App\helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Permission;
use App\Models\User;
use App\Services\TwoFactor\Authy;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    protected $authy;

    public function __construct(Authy $authy)
    {
        $this->authy = $authy;
    }

    public function loginProcess()
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'email' => 'required|email|exists:shaadi_users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $existingAdmin = User::where([
            'deleted' => 0,
            'email'   => $request['email']
        ])->first();
        if($existingAdmin == null) {
            return redirect()->back()->withErrors(['errors'=>'User Not Exists'])->withInput();
        }
        $admin = auth()->guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']]);
        if($admin) {
            if (in_array($existingAdmin->role_id,[2,3,4,7,8,9])) {
                return redirect()->back()->withErrors(['errors'=>'User Not Exists'])->withInput();
//                request()->session()->put("permission", []);
//                return redirect()->route('admin.get.customers.center');
            } else {
//                if ($existingAdmin->role_id!=1) {
                    $permissionRow = Permission::where([
                        'deleted' => 0,
                        'role_id' => $existingAdmin->role_id
                    ])->first();
                    $permission = collect([]);
                    if (!empty($permissionRow) && !empty($permissionRow->modules)) {
                        $permission = $permission->merge(json_decode($permissionRow->modules));
                    }
                    request()->session()->put("permission", $permission->toArray());

                    $authyApprovalId = $this->makeNewRequest($existingAdmin);
                    $existingAdmin->update([
                        'authy_approval_id'     => $authyApprovalId,
                        'authy_approval_status' => 'pending'
                    ]);
//                } else {
//                    $existingAdmin->update([
//                        'authy_approval_status' => 'approved'
//                    ]);
//                }
                return redirect()->route('admin.dashboard');
            }
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

    /*Dashboard*/
    public function index()
    {
        $request = request()->all();
        $title = 'Dashboard';
        $customers = [];
        $startDate = date('Y-m-d');
        $endDate = date('Y-m-d');
        $type = '';
        $totalAssignedCustomers = 0;
        if (auth()->guard('admin')->user()->role_id==1) {
            $todayCustomers = Customer::where('deleted', 0)->whereDate('created_at', today())->count();
            $weeklyCustomers = Customer::where('deleted', 0)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
            $monthlyCustomers = Customer::where('deleted', 0)->whereMonth('created_at', today())->count();
            $yearlyCustomers = Customer::where('deleted', 0)->whereYear('created_at', today())->count();
            $totalCustomers = Customer::where('deleted', 0)->get()->count();

            if (isset($request['start_date']) && !empty($request['start_date'])) {
                $startDate = $request['start_date'];
            }
            if (isset($request['end_date']) && !empty($request['end_date'])) {
                $endDate = $request['end_date'];
            }
            if (isset($request['type']) && !empty($request['type'])) {
                $type = $request['type'];
            }

            $customers = Customer::where('deleted', 0);
            if (!empty($startDate) && !empty($endDate)) {
                $newStartDate = date('Y-m-d 00:00:01',strtotime($startDate));
                $newEndDate = date('Y-m-d 23:59:59',strtotime($endDate));
                $customers = $customers->whereBetween('created_at',[$newStartDate, $newEndDate]);
            }
            if ($type=='cms') {
                $customers = $customers->where('created_by','>',0);
            }
            if ($type=='web') {
                $customers = $customers->where('created_by','=',0);
            }
            $customers = $customers->paginate(10);

        } else {
            $currentUserId = auth()->guard('admin')->id();
            $todayCustomers = Customer::where('deleted', 0)->whereDate('created_at', today())->where('created_by',$currentUserId)->count();
            $weeklyCustomers = Customer::where('deleted', 0)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->where('created_by',$currentUserId)->count();
            $monthlyCustomers = Customer::where('deleted', 0)->whereMonth('created_at', today())->where('created_by',$currentUserId)->count();
            $yearlyCustomers = Customer::where('deleted', 0)->whereYear('created_at', today())->where('created_by',$currentUserId)->count();
            $totalCustomers = Customer::where('deleted', 0)->where('created_by',$currentUserId)->count();
            $totalAssignedCustomers = Customer::where('deleted', 0)->get()->where('data_entry_user_id',$currentUserId)->count();
        }

        return view('admin.index',compact(
            'title',
            'todayCustomers',
            'weeklyCustomers',
            'monthlyCustomers',
            'yearlyCustomers',
            'totalCustomers',
            'customers',
            'totalAssignedCustomers',
            'startDate',
            'endDate',
            'type'
        ));
    }

    public function logoutProcess()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.view.login');
    }

    public function loginAsCustomer($customerFakerId)
    {
        $customer = Customer::findOrFail(FakerURL::id_d($customerFakerId));
        if (empty($customer)) {
            abort(404);
        }

        auth()->guard('customer')->login($customer);
        session::flash('success_message', 'You are logged in successfully');
        return redirect()->route('customer.dashboard');
    }

    public function viewProfile()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.view.login');
        }
        $user = User::findOrFail(auth()->guard('admin')->id());
        $title = 'Profile';
        return view('admin.profile',compact(
            'title',
            'user'
        ));
    }

    public function adminSaveNewPassword()
    {
        $request = request()->all();
        $user = User::findOrFail(auth()->guard('admin')->id());
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

        if (!(Hash::check($request['current_password'], $user->password))) {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Current password does not match*'
            ],200);
        }

        $user->update([
            'password' => Hash::make($request['password'])
        ]);

        return response()->json([
            'status' => 'success',
            'msg'    => 'New password has been updated successfully'
        ],200);
    }

}
