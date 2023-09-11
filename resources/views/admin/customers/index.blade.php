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
        .badgesNotify {
            width: 23px;
            height: 23px;
            background: red;
            color: white;
            font-size: 12px;
            padding: 2px;
            border-radius: 50%;
            position: absolute;
            text-align: center;
            font-weight: bold;
            margin-left: -9px;
        }
        .badgesNotify {
            animation: glowing 1300ms infinite;
        }
        @keyframes glowing {
            0% {
                background-color: #a83f03;
                box-shadow: 0 0 3px #a81000;
            }
            50% {
                background-color: #e80049;
                box-shadow: 0 0 10px #e80052;
            }
            100% {
                background-color: #a80100;
                box-shadow: 0 0 3px #a83a5f;
            }
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
            <div class="mb-3 text-uppercase">
                <div class="row">
                    <div class="col-6">
                        <a href="{{route('admin.add.edit.customer')}}" class="btn btn-primary radius-30 mt-2 mt-lg-0" title="Add Customer"><i class="bx bxs-plus-square"></i>Add New</a>
                    </div>
                    <div class="col-6 float-end text-end">
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <a href="{{route('admin.get.customers',['today'])}}" type="button" class="btn btn-outline-primary {{($fromToData=='today') ? 'active' : ''}}">Today</a>
                            <a href="{{route('admin.get.customers',['weekly'])}}" type="button" class="btn btn-outline-primary {{($fromToData=='weekly') ? 'active' : ''}}">This Week</a>
                            <a href="{{route('admin.get.customers',['monthly'])}}" type="button" class="btn btn-outline-primary {{($fromToData=='monthly') ? 'active' : ''}}">This Month</a>
                            <a href="{{route('admin.get.customers',['yearly'])}}" type="button" class="btn btn-outline-primary {{($fromToData=='yearly') ? 'active' : ''}}">This Year</a>
                            <a href="{{route('admin.get.customers',['all'])}}" type="button" class="btn btn-outline-primary {{($fromToData=='all') ? 'active' : ''}}">All</a>
                            <a href="{{route('admin.get.customers',['assign'])}}" type="button" class="btn btn-outline-primary {{($fromToData=='assign') ? 'active' : ''}}">Assigned</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table viewTableData">
                            <thead>
                            <tr>
                                <th data-sortable="true">ID #</th>
                                <th data-sortable="false">Action</th>
                                <th data-sortable="false">Image</th>
                                <th data-sortable="false">Fullname</th>
                                <th data-sortable="false">Username</th>
                                <th data-sortable="false">Email Verified</th>
                                <th data-sortable="false">PF Status</th>
                                <th data-sortable="false">PF Pic Status</th>
                                <th data-sortable="false">PF Home Pg Status</th>
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
            ajax: "{{url()->current()}}",
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
                        accessButtons += `<a class="fs-3" href="{{route('admin.add.edit.customer')}}/${data}" title="Edit Customer"><i class="fa fa-edit"></i></a>`;
                        if (hasPermissions.includes("admin.delete.customer") || hasPermissions.includes("all")) {
                            accessButtons += `<a class="fs-3" onclick="deleteRecord(this,'${data}')" href="javascript:void(0)" title="Delete Customer"><i class="fa fa-trash"></i></a>`;
                        }
                        if (hasPermissions.includes("admin.login.as.customer") || hasPermissions.includes("all")) {
                            accessButtons += `<a class="fs-3" onclick="return confirm('Are you sure you want to login as a customer?');return false;" href="{{route('admin.login.as.customer')}}/${data}" target="_blank" title="Login as Customer"><i class="fa fa-user"></i>`;
                            if (full.unread_message_number.length > 0) {
                                accessButtons += `<span class="badgesNotify">12</span>`;
                            }
                            accessButtons += `</a>`;
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
                {
                    data: 'name'
                },
                {
                    data: 'faker_id',
                    render: function (data, type, full, meta) {
                        if (hasPermissions.includes("admin.change.customer.status") || hasPermissions.includes("all")) {
                            return (
                                `<div class="form-check form-switch" title="Profile Email Verified">
                                <input class="form-check-input" type="checkbox" onclick="changeStatus(this,'verified')" ${full.email_verified==1 && full.status==1 ? 'checked' : ''} id="${data}" >
                            </div>`
                            )
                        } else {
                            return ((full.email_verified==1 && full.status==1) ? 'Active' : 'Deactive');
                        }
                    }
                },
                {
                    data: 'faker_id',
                    render: function (data, type, full, meta) {
                        if (hasPermissions.includes("admin.change.customer.status") || hasPermissions.includes("all")) {
                            return (
                                `<div class="form-check form-switch" title="Profile Status">
                                <input class="form-check-input" type="checkbox" onclick="changeStatus(this,'profile_status')" ${full.profile_status==1 ? 'checked' : ''} id="${data}" >
                            </div>`
                            )
                        } else {
                            return ((full.profile_status==1) ? 'Active' : 'Deactive');
                        }
                    }
                },
                {
                    data: 'faker_id',
                    render: function (data, type, full, meta) {
                        if (hasPermissions.includes("admin.change.customer.status") || hasPermissions.includes("all")) {
                            return (
                                `<div class="form-check form-switch" title="Profile picture Status">
                                <input class="form-check-input" type="checkbox" onclick="changeStatus(this,'profile_pic_status')" ${full.profile_pic_status==1 ? 'checked' : ''} id="${data}" >
                            </div>`
                            )
                        } else {
                            return ((full.profile_pic_status==1) ? 'Active' : 'Deactive');
                        }
                    }
                },
                {
                    data: 'faker_id',
                    render: function (data, type, full, meta) {
                        if (hasPermissions.includes("admin.change.customer.status") || hasPermissions.includes("all")) {
                            return (
                                `<div class="form-check form-switch" title="Profile Home Page Status">
                                <input class="form-check-input" type="checkbox" onclick="changeStatus(this,'profile_home_page_status')" ${full.profile_home_page_status==1 ? 'checked' : ''} id="${data}" >
                            </div>`
                            )
                        } else {
                            return ((full.profile_home_page_status==1) ? 'Active' : 'Deactive');
                        }
                    }
                },
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
        
        function changeStatus(input,statusName) {
            let customerId = $(input).attr('id');
            let oldValue = $(input).is(':checked') ? false : true;
            if(confirm('Are you sure you want to change status?')){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    url: "{{route('admin.change.customer.status')}}",
                    type: "post",
                    data: {statusName,customerId}
                }).done(function (res){
                    alertyFy(res.msg,res.status);
                }).fail(function (jqXHR, textStatus, errorThrown){
                    alertyFy('There is something wrong.*','warning');
                    $(input).prop('checked',oldValue);
                });
            } else {
                $(input).prop('checked',oldValue);
            }
        }

        function deleteRecord(input, mainId) {
            $(input).attr('disabled', true);
            if (confirm("Are you sure you want to delete this?")) {
                $.get(`{{route('admin.delete.customer')}}/${mainId}`, function (res) {
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

    </script>
@endpush
