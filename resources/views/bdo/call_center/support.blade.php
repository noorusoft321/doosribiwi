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
            </div>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="filter mb-3">
                        <h5>Filters by:</h5>
                        <div class="row">
                            <div class="col-md-4 my-auto">
                                <div class="form-group">
                                    <label for="f_issue">Support Issue Status</label>
                                    <select name="f_issue" id="f_issue" class="form-control">
                                        <option value="Pending">Pending</option>
                                        <option value="Progress">Progress</option>
                                        <option value="Fake">Fake</option>
                                        <option value="Fixed">Fixed</option>
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
                                <th data-sortable="true">Created At</th>
                                <th data-sortable="false">Actions</th>
                                <th data-sortable="false">Full Name</th>
                                <th data-sortable="false">Mobile Number</th>
                                <th data-sortable="false">Issue Status</th>
                                <th data-sortable="false">Message</th>
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
                        fType: $('select[name="f_issue"] option:selected').val(),
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
                        return `<a target="_blank" class="fs-3" href="{{route('bdo.get.support.detail')}}/${data}" title="View Detail"><i class="fa fa-eye"></i></a>`;
                    }
                },
                {
                    data: 'full_name'
                },
                {
                    data: 'mobile_number'
                },
                {
                    data: 'issue',
                    render: function (data, type, full, meta) {
                        return `<span class="issue-button">${data}</span>`;
                    }
                },
                {
                    data: 'discussion',
                    render: function (data, type, full, meta) {
                        return data.length > 70 ? data.substr(0, data.lastIndexOf(' ', 67)) + '...' : data;
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
