@extends('admin.layouts.master')

@section('title', $title)

@push('style')
    <link href="{{ asset('shaadi-admin/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"/>
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
                                {{$title}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <hr/>
            <div class="mb-3 text-uppercase">
                <a href="{{route('add.edit.portal.seo.tool')}}" class="btn btn-primary radius-30 mt-2 mt-lg-0" title="Add Customer"><i class="bx bxs-plus-square"></i>Add New</a>
            </div>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table viewTableData">
                            <thead>
                            <tr>
                                <th data-sortable="true">ID #</th>
                                <th data-sortable="false">Type</th>
                                <th data-sortable="false">Page Url</th>
                                <th data-sortable="false">Title</th>
                                <th data-sortable="false">Site Name</th>
                                <th data-sortable="false">Created At</th>
                                <th data-sortable="false">Action</th>
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

    <script type="text/javascript">
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
                    data: 'type'
                },
                {
                    data: 'page_url'
                },
                {
                    data: 'title',
                    render: function (data, type, full, meta) {
                        return data.length > 40 ? data.substr(0, data.lastIndexOf(' ', 37)) + '...' : data;
                    }
                },
                {
                    data: 'site_name',
                    render: function (data, type, full, meta) {
                        return data.length > 40 ? data.substr(0, data.lastIndexOf(' ', 37)) + '...' : data;
                    }
                },
                {
                    data: 'created_at',
                    render: function (data, type, full, meta) {
                        return moment(data).format('Do MMM YYYY h:mm A');
                    }
                },
                {
                    data: 'faker_id',
                    render: function (data, type, full, meta) {
                        return `
                                <a class="fs-3" href="{{route('add.edit.portal.seo.tool')}}/${data}" title="Edit Page"><i class="fa fa-edit"></i></a>
                                <a class="fs-3" onclick="deleteRecord(this,'${data}')" href="javascript:void(0)" title="Delete Customer"><i class="fa fa-trash"></i></a>
                        `;
                    }
                }
            ],
        });

        function deleteRecord(input, mainId) {
            $(input).attr('disabled', true);
            if (confirm("Are you sure you want to delete this?")) {
                $.get(`{{route('admin.delete.seo.tool')}}/${mainId}`, function (res) {
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
