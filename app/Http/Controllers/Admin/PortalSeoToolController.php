<?php
namespace App\Http\Controllers\Admin;
use App\helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\SeoTool;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Image;

class PortalSeoToolController extends Controller
{
    public function index()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = SeoTool::orderBy($orderByColumn, $orderBy);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->where('page_url', 'like', '%'. $search . '%');
                });
            }
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Seo Pages List';
        return view('admin.seo_tools.index',compact('title'));
    }

    public function addEditSeoTool($id='')
    {
        $seoTool = null;
        $title = 'Add Seo Tool';
        if (!empty($id)) {
            $seoTool = SeoTool::findOrFail(FakerURL::id_d($id));
            $title = 'Edit Seo Tool';
        }
        $customers = Customer::where('deleted',0)->where('profile_status','!=',2)->where('status',1)->get();
        return view('admin.seo_tools.add_edit',compact('title','customers','seoTool'));
    }

    public function fetchSeoRelatedImages()
    {
        $request = request()->all();
        if ($request['type']=='Profile' && !empty($request['customer_id'])) {
            $customer = Customer::with('customerImages')->findOrFail($request['customer_id']);
            return view('admin.seo_tools.customer_images',compact('customer'))->render();
        }
        if ($request['type']=='Page') {
            $files = File::allFiles(public_path('gallery'));
            arsort($files);
            return view('admin.seo_tools.seo_images',compact('files'))->render();
        }
        return '';
    }

    public function seoPhotosSave()
    {
        $request = request();
        $rules = [
            'public_gallery.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        if ($request->hasFile('seo_images')) {
            $image_tmp = $request->file('seo_images');
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

                    $main_image = public_path('gallery/' . $imageName);

                    Image::make($image)->save($main_image);
                }
            }
            $files = File::allFiles(public_path('gallery'));
            return response()->json([
                'status' => 'success',
                'msg'    => 'Seo Photos has been saved successfully',
                'data'   => view('admin.seo_tools.seo_images',compact('files'))->render()
            ], 200);
        }
        return response()->json([
            'status'  => 'warning',
            'msg' => 'Seo Photos has not been saved'
        ], 200);
    }

    public function createUpdateSeoTool($id='')
    {
        $request = request()->all();
        $rules = [
            'type'          => 'required|in:Page,Profile',
//            'page_url'      => 'required|max:255',
            'site_name'     => 'required|max:255',
            'title'         => 'required|max:255',
            'description'   => 'required',
            'schema_script' => 'required',
            'image'         => 'required'
        ];
        if ($request['type']=='Profile') {
            $rules['customer_id'] = 'required|exists:shaadi_customers,id';
            $request['page_url'] = 'customer.profile.detail';
        } else {
            $rules['page_url'] = 'required|max:255';
        }
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }
        if (!empty($id)) {
            $seoToolRow = SeoTool::findOrFail(FakerURL::id_d($id));
            $seoToolRow->update($request);
        } else {
                SeoTool::updateOrCreate([
                'type'        => $request['type'],
                'page_url'    => $request['page_url'],
                'customer_id' => $request['customer_id']
            ],$request);
        }
        return response()->json([
            'status' => 'success',
            'msg'    => 'Record has been saved successfully.'
        ]);
    }

    public function deleteSeoTool($id='')
    {
        $seoTool = SeoTool::findOrFail(FakerURL::id_d($id));
        $seoTool->delete();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Record has been deleted successfully.'
        ]);
    }

}
