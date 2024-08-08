@extends('bdo.layouts.master')

@section('title', $title)

@push('style')
    <link href="{{ asset('shaadi-admin/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"/>
    <style>
        .form-switch .form-check-input {
            width: 4em!important;
            height: 2em!important;
            cursor: pointer;
        }
        .issue-button {
            border-radius: 10px;
            border: 1px solid grey;
            padding: 5px 10px;
            font-weight: 600;
        }
    </style>
@endpush

@section('content')

    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{route('bdo.get.customers.center')}}"><i class="bx bx-home-alt"></i></a>
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
                <div class="ms-auto">
                    <a href="{{route('bdo.new.package.request')}}" class="btn btn-success">Add New Request</a>
                </div>
            </div>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="filter mb-3">
                        <h5>Filters by:</h5>
                        <div class="row">
                            <div class="col-md-4 my-auto">
                                <div class="form-group">
                                    <label for="f_status">Request Status</label>
                                    <select name="f_status" id="f_status" class="form-control">
                                        <option value="0">Pending</option>
                                        <option value="1">Approved</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto text-end float-end my-auto pt-3">
                                <div class="float-end">
                                    <button onclick="searchBy(this)" type="button" class="btn btn-primary">Search</button>
                                    <a href="" type="button" class="btn btn-success">Reset</a>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class="table-responsive">

                        <table class="table viewTableData">
                            <thead>
                            <tr>
                                <th data-sortable="false">Created At</th>
                                <th data-sortable="false">Actions</th>
                                <th data-sortable="false">Customer</th>
                                <th data-sortable="false">Package</th>
                                <th data-sortable="false">Status</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr/>
        </div>
    </div>

    <!-- Images Modal -->
    <div class="modal fade" id="imagesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="imagesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagesModalLabel">Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body data--main-content"></div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset('shaadi-admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('shaadi-admin/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>

    <script>

        let listTable = '';
        let packageRequestId = '';

        listTable = $('.viewTableData').DataTable({
            processing: true,
            serverSide: true,
            searching:false,
            order: [
                [0, "desc"]
            ],
            ajax: {
                url: "{{url()->current()}}",
                data: function (d) {
                    return $.extend({}, d, {
                        fStatus: $('select[name="f_status"] option:selected').val(),
                    });
                }
            },
            columns: [
                {
                    data: 'created_at',
                    render: function (data, type, full, meta) {
                        return moment(data).format('Do MMM YYYY h:mm A');
                    }
                },
                {
                    data: 'faker_id',
                    render: function (data, type, full, meta) {
                        let accessButtons = '';
                        if (full.status==0) {
                            accessButtons += `<a class="fs-3" onclick="deleteRecord(this,'${data}')" href="javascript:void(0)" title="Delete Request"><i class="fa fa-trash"></i></a>`;
                        } else {
                            accessButtons += '<button class="btn btn-primary" title="Request has Approved">Approved</button>';
                        }

                        accessButtons += `&nbsp;&nbsp;<button class="fs-3" onclick="showGallery(this,'${data}')" href="javascript:void(0)" title="Request Media" style="border: none;background: none;"><i class="fa fa-file"></i></button>`;
                        return accessButtons;

                    }
                },
                {
                    data: 'customer_name'
                },
                {
                    data: 'package_name'
                },
                {
                    data: 'status',
                    render: function (data, type, full, meta) {
                        return `<span class="issue-button">${(data==0) ? 'Pending' : 'Approved'}</span>`;
                    }
                }
            ],
        });

        function deleteRecord(input, mainId) {
            $(input).attr('disabled', true);
            if (confirm("Are you sure you want to delete this?")) {
                $.get(`{{route('bdo.package.request.delete')}}/${mainId}`, function (res) {
                    if (res.status == 'success') {
                        alertyFy(res.msg, res.status, 2000);
                        listTable.ajax.reload();
                    } else {
                        alertyFy(res.msg, res.status, 2000);
                        listTable.ajax.reload();
                    }
                });
            }
        }

        function searchBy(input) {
            $(input).attr('disabled',true);
            setTimeout(function () {
                $(input).attr('disabled',false);
            },2000);
            listTable.ajax.reload();
        }
        
        function showGallery(input, mainId) {
            $(input).attr('disabled',true);
            packageRequestId = mainId;
            axios.post("{{route('get.media.package.request')}}", {
                package_request_id:packageRequestId
            }).then(function (res) {
                $('#imagesModal .data--main-content').empty();
                if (res.data) {
                    $('#imagesModal .data--main-content').html(res.data);
                    $('#imagesModal').modal('show');
                }
                $(input).attr('disabled',false);
            }).catch(function (error) {
                alertyFy('There is something wrong','warning',3000);
                $(input).attr('disabled',false);
            });
        }

        function saveMedia(input){
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            let newImage = '';
            if ($('input[id="images_request"]').val()) {
                newImage = document.getElementById('images_request').files;
            }
            let formData = new FormData();
            formData.append('package_request_id', packageRequestId);
            if (newImage && newImage.length > 0) {
                $.each(newImage, function (k, v) {
                    formData.append('images_request[]', v);
                });
            } else {
                formData.append('images_request[]', newImage);
            }

            axios.post("{{route('save.media.package.request')}}", formData).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $('#imagesModal .data--main-content').empty();
                if (res.data.status=='success' && res.data.data) {
                    $('#imagesModal .data--main-content').html(res.data.data);
                }
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $(':input[id="images_request"]').addClass("has-error");
                    $.each(error.response.data.errors, function (k, v) {
                        $(':input[id="images_request"]').after("<span class='text-danger d-block'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }
        
        function deleteMedia(input,imageId) {
            if(confirm('Are you sure you want to delete?')){
                $(input).attr('disabled',true);
                axios.post("{{route('delete.media.package.request')}}", {
                    image_id:imageId
                }).then(function (res) {
                    alertyFy(res.data.msg,res.data.status,3000);
                    if (res.data.status=='success') {
                        $(input).parent().parent().remove();
                    }
                    $(input).attr('disabled',false);
                }).catch(function (error) {
                    alertyFy('There is something wrong','warning',3000);
                    $(input).attr('disabled',false);
                });
            }
            return;
        }

    </script>
@endpush