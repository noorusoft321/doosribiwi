@extends('admin.layouts.master')

@section('title', $title)

@push('style')
    <link href="{{ asset('shaadi-admin/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"/>
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
                                <th data-sortable="false">Role Name</th>
                                <th data-sortable="false">Role Views</th>
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
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Route Name</label>
                            <input type="text" name="route_name" id="route_name" class="form-control" placeholder="Route Name">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="title">Route Views</label>
                            <textarea name="route_views" id="route_views" rows="6" placeholder="Route Views" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button onclick="saveRoute(this);" type="button" class="btn btn-primary">Save changes</button>
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
                    data: 'route_name'
                },
                {
                    data: 'route_views'
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
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            if (mainId) {
                $('#addEditModal #addEditModalLabel').text('Edit');
                createUpdateUrl = '{{route('admin.route.save')}}/' + mainId;
                $.get(`{{route('admin.route.detail')}}/${mainId}`, function (res) {
                    if (res.status == 'success') {
                        $(':input[name="route_name"]').val(res.data.route_name);
                        $(':input[name="route_views"]').val(res.data.route_views);
                    } else {
                        alertyFy('There is something wrong*', 'warning', 2000);
                        return false;
                    }
                });
            } else {
                $('#addEditModal #addEditModalLabel').text('Add');
                createUpdateUrl = '{{route('admin.route.save')}}';
                $('#addEditModal :input').val('');
            }
            $('#addEditModal').modal('show');
        }

        function deleteRecord(input, mainId) {
            $(input).attr('disabled', true);
            if (confirm("Are you sure you want to delete this?")) {
                $.get(`{{route('admin.route.delete')}}/${mainId}`, function (res) {
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

        function saveRoute(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post(createUpdateUrl, $('#addEditForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                listTable.ajax.reload();
                $('#addEditModal').modal('hide');
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#addEditForm :input[name="' + k + '"]').addClass("has-error");
                        $('#addEditForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

    </script>
@endpush
