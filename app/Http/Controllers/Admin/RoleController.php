<?php

namespace App\Http\Controllers\Admin;

use App\helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Route;
use App\Models\UserRole;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /*Roles*/
    public function getRoles()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = UserRole::where('deleted',0)->whereNotIn('id',[1,2,3,4,7,8,9]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
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
        $title = 'All Roles';
        return view('admin.user_settings.roles',compact('title'));
    }

    public function roleSave($roleId='')
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'title' => 'required|max:255'
        ],[
            'title' => 'The role name field is required.'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors(),
                'status'=>'error'
            ],422);
        }

        if (!empty($roleId)) {
            $role = UserRole::findOrFail(FakerURL::id_d($roleId));
            $requestRes = $role->update($request);
        } else {
            $requestRes = UserRole::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Role has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Role has not been saved.'
            ]);
        }
    }

    public function roleDelete($roleId='')
    {
        if ($roleId) {
            $role = UserRole::where('id',FakerURL::id_d($roleId))->first();
            if (!empty($role)) {
                $role->update(['deleted' => 1]);
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Role has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Role has not been deleted.'
        ]);
    }

    /*Roles*/
    public function getRoutes()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Route::where('deleted',0);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('route_name', 'like', '%'. $search . '%');
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
        $title = 'All Routes';
        return view('admin.user_settings.routes',compact('title'));
    }

    public function routeDetail($routeId)
    {
        $route = Route::findOrFail(FakerURL::id_d($routeId));
        return response()->json([
            'status' => 'success',
            'data' => $route
        ]);
    }

    public function routeSave($routeId='')
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'route_name'  => 'required|max:255',
            'route_views' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors(),
                'status'=>'error'
            ],422);
        }

        if (!empty($routeId)) {
            $route = Route::findOrFail(FakerURL::id_d($routeId));
            $requestRes = $route->update($request);
        } else {
            $requestRes = Route::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Route has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Route has not been saved.'
            ]);
        }
    }

    public function routeDelete($routeId='')
    {
        if ($routeId) {
            $route = Route::where('id',FakerURL::id_d($routeId))->first();
            if (!empty($route)) {
                $route->update(['deleted' => 1]);
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Route has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Role has not been deleted.'
        ]);
    }

    public function getPermissions()
    {
        $roles = UserRole::where('deleted',0)->whereNotIn('id',[1,2,3,4])->get();
        $title = 'Permissions';
        return view('admin.user_settings.permissions',compact('title','roles'));
    }

    public function getRelatedPermissions()
    {
        $roleId = request()->role_id;
        if (!empty($roleId)) {
            $permissions = Permission::where([
                'deleted' => 0,
                'role_id' => $roleId
            ])->first();
            $routes = Route::where('deleted',0)->get();
            return view('admin.user_settings.partial_permission', compact('routes','permissions'))->render();
        }
    }

    public function savePermissions()
    {
        $request = request()->all();
        $request['modules'] = json_encode($request['modules']);
        try {
            Permission::updateOrCreate([
                'role_id' => $request['role_id']
            ],$request);
            return response()->json([
                'status' => 'success',
                'msg'    => 'Permission has been saved successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Permission has not been saved'
            ], 200);
        }
    }

}
