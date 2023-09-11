@extends('admin.layouts.master')

@section('title', $title)

@push('style')
    <link href="{{ asset('shaadi-admin/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"/>
    <style>
        .modal-backdrop {
            position: unset !important;
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
                <a href="javascript:void(0)" onclick="addEditModal(this)"
                   class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table viewTableData">
                            <thead>
                            <tr>
                                <th data-sortable="true">ID #</th>
                                <th data-sortable="false">Name</th>
                                <th data-sortable="false">Messages</th>
                                <th data-sortable="false">Duration</th>
                                <th data-sortable="false">Price</th>
                                <th data-sortable="false">Actions</th>
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

    <!-- Add edit modal -->
    <div class="modal fade" id="addEditModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="addEditModalLabel">Add</span> Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addEditForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="package_name">Package Name</label>
                            <input type="text" name="package_name" id="package_name" class="form-control" placeholder="Package Name">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="direct_messages">Direct Messages</label>
                            <input type="text" name="direct_messages" id="direct_messages" class="form-control" placeholder="Direct Messages">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="text" name="duration" id="duration" class="form-control" placeholder="Duration">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="profile_status">Profile Status</label>
                            <input type="text" name="profile_status" id="profile_status" class="form-control" placeholder="Profile Status">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="profile_status_urdu">Profile Status Urdu</label>
                            <input type="text" name="profile_status_urdu" id="profile_status_urdu" class="form-control" placeholder="Profile Status Urdu">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="background_color">Background Color</label>
                            <input type="text" name="background_color" id="background_color" class="form-control" placeholder="Background Color">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="color">Color</label>
                            <input type="text" name="color" id="color" class="form-control" placeholder="Color">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="vip_status">Vip Status</label>
                            <input type="text" name="vip_status" id="vip_status" class="form-control" placeholder="Vip Status">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="vip_status_urdu">Vip Status Urdu</label>
                            <input type="text" name="vip_status_urdu" id="vip_status_urdu" class="form-control" placeholder="Vip Status Urdu">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset('shaadi-admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('shaadi-admin/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

    <script>

        let listTable = '';
        let createUpdateUrl = '';

        listTable = $('.viewTableData').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, "desc"]
            ],
            ajax: "{{url()->current()}}",
            columns: [
                {
                    data: 'id'
                },
                {
                    data: 'package_name',
                },
                {
                    data: 'direct_messages',
                },
                {
                    data: 'duration',
                },
                {
                    data: 'price',
                },
                {
                    data: 'faker_id',
                    render: function (data, type, full, meta) {
                        return (
                            `
                                <a class="fs-3" onclick="addEditModal(this,'${data}')" href="javascript:void(0)"><i class="fa fa-edit"></i></a>
                                <a class="fs-3" onclick="deleteRecord(this,'${data}')" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                            `
                        );
                    }
                }
            ],
        });

        function addEditModal(input, mainId = '') {
            if (mainId) {
                $('#addEditModal #addEditModalLabel').text('Edit');
                createUpdateUrl = '{{route('admin.package.save')}}/' + mainId;
                $.get(`{{route('admin.package.detail')}}/${mainId}`, function (res) {
                    if (res.status == 'success') {
                        $(':input[name="package_name"]').val(res.data.package_name);
                        $(':input[name="direct_messages"]').val(res.data.direct_messages);
                        $(':input[name="duration"]').val(res.data.duration);
                        $(':input[name="profile_status"]').val(res.data.profile_status);
                        $(':input[name="profile_status_urdu"]').val(res.data.profile_status_urdu);
                        $(':input[name="price"]').val(res.data.price);
                        $(':input[name="background_color"]').val(res.data.background_color);
                        $(':input[name="color"]').val(res.data.color);
                        $(':input[name="vip_status"]').val(res.data.vip_status);
                        $(':input[name="vip_status_urdu"]').val(res.data.vip_status_urdu);
                    } else {
                        alertyFy('There is something wrong*', 'warning', 2000);
                        return false;
                    }
                });
            } else {
                $('#addEditModal #addEditModalLabel').text('Add');
                createUpdateUrl = '{{route('admin.package.save')}}';
                $(':input[name="package_name"]').val('');
                $(':input[name="direct_messages"]').val('');
                $(':input[name="duration"]').val('');
                $(':input[name="profile_status"]').val('');
                $(':input[name="profile_status_urdu"]').val('');
                $(':input[name="price"]').val('');
                $(':input[name="background_color"]').val('');
                $(':input[name="color"]').val('');
                $(':input[name="vip_status"]').val('');
                $(':input[name="vip_status_urdu"]').val('');
            }
            $('#addEditModal').modal('show');
        }

        function deleteRecord(input, mainId) {
            $(input).attr('disabled', true);
            if (confirm("Are you sure you want to delete this?")) {
                $.get(`{{route('admin.package.delete')}}/${mainId}`, function (res) {
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

        $(function () {

            $('#addEditModal #addEditForm').on('submit', function (e) {
                $(this).find('#submit').attr('disabled', true);
                $(':input').removeClass('has-error');
                $('.text-danger').remove();
                e.preventDefault();
                $.ajax({
                    url: createUpdateUrl,
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        if (res.status == 'success') {
                            alertyFy(res.msg, res.status, 2000);
                        } else {
                            alertyFy(res.msg, res.status, 2000);
                        }
                        $('#addEditModal').modal('hide');
                        listTable.ajax.reload();
                        $(this).find('#submit').removeAttr('disabled');
                    },
                    error: function (request, status, error) {
                        if (request.status===422) {
                            $.each(request.responseJSON.errors, function (k, v) {
                                $(`:input[name="${k}"]`).addClass("has-error");
                                $(`:input[name="${k}"]`).after(`<span class="text-danger">${v[0]}</span>`);
                            });
                        } else {
                            console.log('error', request.responseText);
                            alertyFy('There is something wrong*', 'warning', 2000);
                            $('#addEditModal').modal('hide');
                            listTable.ajax.reload();
                        }
                        $(this).find('#submit').removeAttr('disabled');
                    }
                });
            });
        });

    </script>
@endpush
