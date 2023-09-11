<?php

namespace App\Http\Controllers\Admin;

use App\helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /*Users*/
    public function getUsers()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = User::where('deleted',0)->where('role_id','!=',1);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('name', 'like', '%'. $search . '%');
                    $query->orWhere('email', 'like', '%'. $search . '%');
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
        $title = 'All Users';
        $roles = UserRole::where('deleted',0)->where('id','!=',1)->get();
        $supervisors = User::where(['deleted' => 0, 'role_id' => 8])->get();
        return view('admin.user_settings.users',compact('title','roles','supervisors'));
    }

    public function userDetail($userId)
    {
        $user = User::findOrFail(FakerURL::id_d($userId));
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function userSave($userId='')
    {
        $request = request()->all();
        $roles = [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:shaadi_users,email',
            'role_id'  => 'required|numeric'
        ];
        if ($request['role_id']==4) {
            $roles['supervisor_id'] = 'required|numeric';
        }
        $validator = Validator::make($request, $roles);
        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors(),
                'status'=>'error'
            ],422);
        }

        if (!empty($userId)) {
            $user = User::findOrFail(FakerURL::id_d($userId));
            $requestRes = $user->update($request);
        } else {
            $request['password'] = Hash::make('shaadiorgpk');
            $requestRes = User::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'User has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'User has not been saved.'
            ]);
        }
    }

    public function userDelete($userId='')
    {
        if ($userId) {
            $user = User::where('id',FakerURL::id_d($userId))->first();
            if (!empty($user)) {
                $user->update(['deleted' => 1]);
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'User has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'User has not been deleted.'
        ]);
    }
}
