@extends('admin.layouts.master')

@section('title', $title)

@push('style')
    <link rel="stylesheet" href="{{asset('shaadi-admin/css/fileinput.min.css')}}">
    <link rel="stylesheet" href="{{asset('shaadi-admin/css/vendor-file-upload.css')}}">
    <link rel="stylesheet" href="{{asset('shaadi-admin/css/jquery.fancybox.min.css')}}">
    <link href="{{asset('shaadi-admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('shaadi-admin/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
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
                                {{$title}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <hr/>
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxl-blogger me-1 font-22 text-primary"></i></div>
                        <h5 class="mb-0 text-primary">{{$title}}</h5>
                    </div>
                    <hr>
                    @if(!empty($blog))
                        <form action="{{route('admin.blog.save',[$blog->faker_id])}}" id="addEditForm" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            <div class="col-8 border-primary border-end">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" onkeyup="make_slug(this)" class="form-control" id="title" name="title" value="{{$blog->title}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{$blog->slug}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Select Categories</label>
                                    <select class="multiple-select" data-placeholder="Select Categories" name="categoryId[]" multiple="multiple">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{(in_array($category->id,$blog->arr_category)) ? 'selected' : ''}}>{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="desc" class="form-label">Description</label>
                                    <textarea name="desc" id="editor">{{$blog->desc}}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Meta Description" rows="2">{{$blog->meta_description}}</textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <input type="file" class="file-input-ajax" id="url" name="main_image" />
                                </div>
                                @if(!empty($blog->main_image))
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="uploaded-img--wrapper row">
                                                <div class="item-img--wrapper">
                                                    <div class="item-img--overlay">
                                                        <div class="container">
                                                            <div class="row overlay-row-room">
                                                                <div class="col-md-6"><a href="#"></a></div>
                                                                <div class="col-md-6 text-right">
                                                                    <a data-fancybox="gallery"
                                                                       href="{{asset('blogs-images/'.$blog->main_image)}}">
                                                                        <i class="fas fa-image fa-2x" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <img src="{{asset('blogs-images/'.$blog->main_image)}}" alt="N/A" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-5 float-end mx-1">Save</button>
                                <button type="button" class="btn btn-secondary px-5 float-end">Cancel</button>
                            </div>
                        </form>
                    @else
                        <form action="{{route('admin.blog.save')}}" id="addEditForm" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            <div class="col-8 border-primary border-end">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" onkeyup="make_slug(this)" class="form-control" id="title" name="title">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Select Categories</label>
                                    <select class="multiple-select" data-placeholder="Select Categories" name="categoryId[]" multiple="multiple">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="desc" class="form-label">Description</label>
                                    <textarea name="desc" id="editor"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Meta Description" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="file" class="file-input-ajax" id="url" name="main_image" />
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-5 float-end mx-1">Save</button>
                                <button type="button" class="btn btn-secondary px-5 float-end">Cancel</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <hr/>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{asset('shaadi-admin/js/fileinput.min.js')}}"></script>
    <script src="{{asset('shaadi-admin/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('shaadi-admin/plugins/select2/js/select2.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        var customToolbar = [
            { name: 'document', items : [ 'Source','-','Save','NewPage','Preview','-','Templates' ] },
            { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
            { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
            { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
            { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
            { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
            { name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
            { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
            { name: 'colors', items : [ 'TextColor','BGColor' ] },
        ];
        CKEDITOR.replace('editor', {
            toolbar: customToolbar,
            height: 200
        });

        $(function () {
            $('.note-popover').remove();
            let previewZoomButtonClasses = {
                toggleheader: 'btn btn-light btn-icon btn-header-toggle btn-sm',
                fullscreen: 'btn btn-light btn-icon btn-sm',
                borderless: 'btn btn-light btn-icon btn-sm',
                close: 'btn btn-light btn-icon btn-sm'
            };
            // Icons inside zoom modal classes
            let previewZoomButtonIcons = {
                prev: '<i class="icon-arrow-left32"></i>',
                next: '<i class="icon-arrow-right32"></i>',
                toggleheader: '<i class="icon-menu-open"></i>',
                fullscreen: '<i class="icon-screen-full"></i>',
                borderless: '<i class="icon-alignment-unalign"></i>',
                close: '<i class="icon-cross2 font-size-base"></i>'
            };
            $('.file-input-ajax').fileinput({
                browseLabel: 'Browse',
                uploadUrl: $("#upload_path").val(), // server upload action
                uploadExtraData: {
                    '_token': $('input[name="_token"]').val(),
                },
                success: function () {
                },
                uploadAsync: true,
                maxFileCount: 20,
                initialPreview: [],
                dropZoneEnabled: true,
                browseIcon: '<i class="icon-file-plus mr-2"></i>',
                uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
                removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
                fileActionSettings: {
                    removeIcon: '<i class="icon-bin"></i>',
                    uploadIcon: '<i class="icon-upload"></i>',
                    uploadClass: '',
                    zoomIcon: '<i class="icon-zoomin3"></i>',
                    zoomClass: '',
                    indicatorNew: '<i class="icon-file-plus text-success"></i>',
                    indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
                    indicatorError: '<i class="icon-cross2 text-danger"></i>',
                    indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
                },
                layoutTemplates: {
                    icon: '<i class="icon-file-check"></i>',
                },
                initialCaption: 'Browse your file*',
                previewZoomButtonClasses: previewZoomButtonClasses,
                previewZoomButtonIcons: previewZoomButtonIcons
            });

            $('.file-input-ajax').on('fileuploaded', function (event, data, previewId, index) {
                let form = data.form, files = data.files, extra = data.extra,
                    response = data.response, reader = data.reader;
                if (response.hasOwnProperty("success")) {
                    imgfiles = data.filescount;
                    if(++index == files.length) {
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                }
            });

            $('input[class="file-caption-name"]').attr('readonly',true);

            /*Blog form Save */
            $('#addEditForm').on('submit', function (e) {
                $(this).find('#submit').attr('disabled', true);
                $(':input').removeClass('has-error');
                $('.text-danger').remove();
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        alertyFy(res.msg, res.status, 2000);
                        if (res.status == 'success') {
                            setTimeout(function () {
                                location.href = "{{route('admin.get.blogs')}}";
                            },2500);
                        }
                    },
                    error: function (request, status, error) {
                        if (request.status===422) {
                            $.each(request.responseJSON.errors, function (k, v) {
                                $(`:input[name="${k}"]`).addClass("has-error");
                                if (k=='main_image') {
                                    $(`:input[name="${k}"]`).parent().parent().parent().before(`<p class="text-danger">${v[0]}</p>`);
                                } else {
                                    $(`:input[name="${k}"]`).after(`<span class="text-danger">${v[0]}</span>`);
                                }
                            });
                        } else {
                            console.log('error', request.responseText);
                            alertyFy('There is something wrong*', 'warning', 2000);
                        }
                        $(this).find('#submit').removeAttr('disabled');
                    }
                });
            });

        });
        $(document).on("click", function(event){
            $('.fileinput-upload').remove();
            $('.fileinput-cancel').remove();
        });

        $('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

        function make_slug(input) {
            $('input[name="slug"]').val(title_to_slug($(input).val()));
        }
    </script>
@endpush
