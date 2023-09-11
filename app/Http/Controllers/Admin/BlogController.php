<?php

namespace App\Http\Controllers\Admin;

use App\helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Str;
use Image;

class BlogController extends Controller
{
    /*Categories*/
    public function getCategories()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = BlogCategory::where(['deleted'=>0]);
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
        $title = 'Blog Categories';
        return view('admin.blogs.categories',compact('title'));
    }

    public function categoryDetail($categoryId)
    {
        $category = BlogCategory::findOrFail(FakerURL::id_d($categoryId));
        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }

    public function categorySave(CategoryRequest $request,$categoryId='')
    {
        $request = $request->all();
        $request['slug'] = Str::slug($request['title']);
        if (!empty($categoryId)) {
            $category = BlogCategory::findOrFail(FakerURL::id_d($categoryId));
            $requestRes = $category->update($request);
        } else {
            $requestRes = BlogCategory::create($request);
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

    public function categoryDelete($categoryId='')
    {
        if ($categoryId) {
            $category = BlogCategory::where('id',FakerURL::id_d($categoryId))->first();
            if (!empty($category)) {
                $category->update(['deleted' => 1]);
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Category has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Category has not been deleted.'
        ]);
    }

    /*Blogs*/
    public function getBlogs()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Blog::where(['deleted'=>0]);
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
        $title = 'Blogs';
        return view('admin.blogs.index',compact('title'));
    }

    public function addEditBlog($blogId='')
    {
        $blog = [];
        if (!empty($blogId)) {
            $blog = Blog::findOrFail(FakerURL::id_d($blogId));
            $title = 'Edit Blog';
        } else {
            $title = 'Add Blog';
        }
        $categories = BlogCategory::where('deleted',0)->get();
        return view('admin.blogs.add_edit',compact('title','blog','categories'));
    }

    public function blogDelete($blogId='')
    {
        if ($blogId) {
            $blog = Blog::where('id',FakerURL::id_d($blogId))->first();
            if (!empty($blog)) {
                $blog->update(['deleted' => 1]);
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Blog has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Blog has not been deleted.'
        ]);
    }

    public function blogSave(BlogRequest $request, $blogId='')
    {
        $imageName = '';
        if ($request->hasFile('main_image')) {
            $image_tmp = $request->file('main_image');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $image_name = $image_tmp->getClientOriginalName();
                $imageName = rand(111, 99999) . '.' . $extension;
                $main_image = public_path('blogs-images/' . $imageName);
                Image::make($image_tmp)->save($main_image);
            }
        }
        $request = $request->all();
        if (empty($imageName)) {
            unset($request['main_image']);
        } else {
            $request['main_image'] = $imageName;
        }
        $request['categoryId'] = implode(',',$request['categoryId']);
        if (!empty($blogId)) {
            $blog = Blog::findOrFail(FakerURL::id_d($blogId));
            $requestRes = $blog->update($request);
        } else {
            $requestRes = Blog::create($request);
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
}
