<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryPath = public_path('gallery');
        $folders = File::directories($galleryPath);
//        $files = File::files($galleryPath);
        $files = File::allFiles($galleryPath);
        // Get only the directories within the directory
        $directories = File::directories($galleryPath);

        // Iterate over the files
        foreach ($files as $file) {
            // Check if the file is an image (you can modify this condition based on your requirements)
            if (preg_match("/\.(jpg|jpeg|png|gif)$/i", $file)) {
                // Do something with the image file
                echo $file->getPathname() . PHP_EOL;
                echo '<br>';
            }
        }

        // Iterate over the directories
        foreach ($directories as $directory) {
            // Do something with the directory
            echo $directory . PHP_EOL;
            echo '<br>';
        }

//        dd($folders,$files,$abcd);

//        return view('admin.gallery.index', compact('folders', 'files'));
    }

    public function createFolder(Request $request)
    {
        $folderName = $request->input('folder_name');
        $galleryPath = public_path('gallery') . '/' . $folderName;

        File::makeDirectory($galleryPath);

        return redirect()->back()->with('success', 'Folder created successfully.');
    }

    public function upload(Request $request)
    {
        $folderName = $request->input('folder');
        $galleryPath = public_path('gallery') . '/' . $folderName;

        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image->move($galleryPath, $image->getClientOriginalName());
            }
        }

        return redirect()->back()->with('success', 'Images uploaded successfully.');
    }
}
