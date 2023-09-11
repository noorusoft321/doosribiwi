@extends('admin.layouts.master')

@section('title', 'Gallery')

@push('style')
    <style>

    </style>
@endpush

@section('content')

    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                Gallery
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <hr/>
            <div class="card">
                <div class="card-body">
                    <!-- gallery/index.blade.php -->
                    <h2>Gallery</h2>

                    <!-- Create Folder Form -->
                    <form action="{{ route('gallery.createFolder') }}" method="POST">
                        @csrf
                        <input type="text" name="folder_name" placeholder="Enter folder name" required>
                        <button type="submit">Create Folder</button>
                    </form>

                    <!-- Upload Images Form -->
                    <form action="{{ route('gallery.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <select name="folder" required>
                            <option disabled selected>Select folder</option>
                            @foreach ($folders as $folder)
                                <option value="{{ basename($folder) }}">{{ basename($folder) }}</option>
                            @endforeach
                        </select>
                        <input type="file" name="images[]" multiple required>
                        <button type="submit">Upload</button>
                    </form>

                    <!-- Display Images -->
                    @if (count($files) > 0)
                        <h3>Images</h3>
                        <div class="gallery-images">
                            @foreach ($files as $file)
                                <img src="{{ asset('gallery/' . basename(dirname($file)) . '/' . basename($file)) }}" alt="Gallery Image">
                            @endforeach
                        </div>
                    @else
                        <p>No images found.</p>
                    @endif

                </div>
            </div>
            <hr/>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset('shaadi-admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('shaadi-admin/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

    <script type="text/javascript">

    </script>
@endpush
