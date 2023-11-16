@extends('admin.layouts.master')

@section('title', $title)

@push('style')
    <link href="{{ asset('shaadi-admin/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"/>
    <style>
        .form-switch .form-check-input {
            width: 4em!important;
            height: 2em!important;
            cursor: pointer;
        }
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
                                {{$title}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="filter mb-3">
                        <h5>Filters by:</h5>
                        <div class="row">
                            <div class="col my-auto">
                                <div class="form-group">
                                    <label for="f_start_date">From</label>
                                    <input type="date" name="f_start_date" id="f_start_date" class="form-control" value="{{$startDate}}">
                                </div>
                            </div>
                            <div class="col my-auto">
                                <div class="form-group">
                                    <label for="f_end_date">To</label>
                                    <input type="date" name="f_end_date" id="f_end_date" class="form-control" value="{{$endDate}}">
                                </div>
                            </div>
                            <div class="col my-auto">
                                <div class="form-group">
                                    <label for="f_type">Type</label>
                                    <select name="f_type" id="f_type" class="form-control">
                                        <option value=""> -- All Customers -- </option>
                                        <option value="web" {{($type=="web") ? 'selected' : ''}}>Website Registration</option>
                                        <option value="cms" {{($type=="cms") ? 'selected' : ''}}>CMS Portal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col my-auto">
                                <div class="form-group">
                                    <label for="f_email_verified">Email Verified</label>
                                    <select name="f_email_verified" id="f_email_verified" class="form-control">
                                        <option value=""> -- All Customers -- </option>
                                        <option value="1" {{($type=="1") ? 'selected' : ''}}>Verified</option>
                                        <option value="0" {{($type=="0") ? 'selected' : ''}}>Not Verified</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3 my-auto">
                                <div class="form-group">
                                    <label for="f_profile_image">Profile Image</label>
                                    <select name="f_profile_image" id="f_profile_image" class="form-control">
                                        <option value=""> -- All Customers -- </option>
                                        <option value="1" {{($type=="1") ? 'selected' : ''}}>Valid Images</option>
                                        <option value="0" {{($type=="0") ? 'selected' : ''}}>Default Images</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 my-auto">
                                <div class="form-group">
                                    <label for="f_profile_status">Profile Status</label>
                                    <select name="f_profile_status" id="f_profile_status" class="form-control">
                                        <option value=""> -- All Customers -- </option>
                                        <option value="1" {{($type=="1") ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{($type=="0") ? 'selected' : ''}}>In-Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 my-auto">
                                <div class="form-group">
                                    <label for="f_approval_changes">Approval Changes</label>
                                    <select name="f_approval_changes" id="f_approval_changes" class="form-control">
                                        <option value=""> -- All Customers -- </option>
                                        <option value="1" {{($type=="1") ? 'selected' : ''}}>Only Approval Changes</option>
                                        <option value="0" {{($type=="0") ? 'selected' : ''}}>Except Approval Changes</option>
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
                    </div>

                    <div class="table-responsive">

                        <table class="table viewTableData">
                            <thead>
                            <tr>
                                <th data-sortable="true">ID #</th>
                                <th data-sortable="false">Action</th>
                                <th data-sortable="false">Image</th>
                                <th data-sortable="false">Fullname</th>
                                {{--<th data-sortable="false">Username</th>--}}
                                <th data-sortable="false">Email</th>
                                <th data-sortable="false">Created At</th>
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

@endsection

@push('script')
    <script src="{{ asset('shaadi-admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('shaadi-admin/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>

    <script>

        let listTable = '';

        listTable = $('.viewTableData').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, "desc"]
            ],
            ajax: {
                url: "{{url()->current()}}",
                data: function (d) {
                    return $.extend({}, d, {
                        fStart_date: $('input[name="f_start_date"]').val(),
                        fEnd_date: $('input[name="f_end_date"]').val(),
                        fType: $('select[name="f_type"] option:selected').val(),
                        fEmailVerified: $('select[name="f_email_verified"] option:selected').val(),
                        fProfileImage: $('select[name="f_profile_image"] option:selected').val(),
                        fProfileStatus: $('select[name="f_profile_status"] option:selected').val(),
                        fApprovalChanges: $('select[name="f_approval_changes"] option:selected').val(),
                    });
                }
            },
            columns: [
                {
                    data: 'id',
                },
                {
                    data: 'faker_id',
                    render: function (data, type, full, meta) {
                        let accessButtons = '';
                        if (hasPermissions.includes("admin.get.customer.detail") || hasPermissions.includes("all")) {
                            accessButtons += `<a class="fs-3" href="{{route('admin.get.customer.detail')}}/${data}" title="View Customer Detail"><i class="fa fa-eye"></i></a>`;
                        }
                        return accessButtons;
                    }
                },
                {
                    data: 'imageFullPath',
                    render: function (data, type, full, meta) {
                        return (
                            `<img src="${data}" class="rounded-circle" width="80" />`
                        );
                    }
                },
                {
                    data: 'full_name'
                },
                // {
                //     data: 'name'
                // },
                {
                    data: 'email'
                },
                {
                    data: 'created_at',
                    render: function (data, type, full, meta) {
                        return moment(data).format('Do MMM YYYY h:mm A');
                    }
                }
            ],
        });

        function searchBy(input) {
            $(input).attr('disabled',true);
            setTimeout(function () {
                $(input).attr('disabled',false);
            },2000);
            listTable.ajax.reload();
        }

    </script>
@endpush
