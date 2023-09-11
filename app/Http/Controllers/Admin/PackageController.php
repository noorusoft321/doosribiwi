<?php

namespace App\Http\Controllers\Admin;

use App\helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{

    /*Packages*/
    public function getPackages()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Package::where(['status'=>1]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('package_name', 'like', '%'. $search . '%');
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
        $title = 'Packages';
        return view('admin.packages.index',compact('title'));
    }

    public function packageDetail($packageId)
    {
        $package = Package::findOrFail(FakerURL::id_d($packageId));
        return response()->json([
            'status' => 'success',
            'data' => $package
        ]);
    }

    public function packageSave($packageId='')
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'package_name' => 'required',
            'direct_messages' => 'required',
            'duration' => 'required',
            'profile_status' => 'required',
            'profile_status_urdu' => 'required',
            'price' => 'required',
            'background_color' => 'required',
            'color' => 'required',
            'vip_status' => 'required',
            'vip_status_urdu' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        if (!empty($packageId)) {
            $package = Package::findOrFail(FakerURL::id_d($packageId));
            $requestRes = $package->update($request);
        } else {
            $requestRes = Package::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function packageDelete($packageId='')
    {
        if ($packageId) {
            $package = Package::where('id',FakerURL::id_d($packageId))->first();
            if (!empty($package)) {
                $package->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

}
