@extends('bdo.layouts.master')

@section('title', $title)

@push('style')
    <link href="{{ asset('shaadi-admin/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"/>
    <style>
        .form-check-input {
            width: 1.5em!important;
            height: 1.5em!important;
            cursor: pointer;
        }
        button.close {
            border: 1px solid red;
            background: red;
            color: #fff;
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
                    <button onclick="showAssignModal()" class="btn btn-primary">Assign</button>
                </div>
            </div>

            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="filter mb-3">
                        <h5>Filters by:</h5>
                        <div class="row">
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="f_customers">Filter Dates</label>
                                    <select onchange="checkCustom(this)" name="f_customers" id="f_customers" class="form-control">
                                        <option value=""> -- All Customers -- </option>
                                        <option value="today">Today</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="data--custom col-3 pb-2" style="display: none;">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="f_start_date">From</label>
                                            <input type="date" name="f_start_date" id="f_start_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="f_end_date">To</label>
                                            <input type="date" name="f_end_date" id="f_end_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="f_assign">Assign/Pending</label>
                                    <select name="f_assign" id="f_assign" class="form-control">
                                        <option value=""> -- All Customers -- </option>
                                        <option value="1">Assigned</option>
                                        <option value="2">Pending Assign</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="f_user_id">BDO User</label>
                                    <select name="f_user_id" id="f_user_id" class="form-control">
                                        <option value=""> -- All Users -- </option>
                                        @foreach($users as $val)
                                            <option value="{{$val->faker_id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="f_gender">Gender</label>
                                    <select name="f_gender" id="f_gender" class="form-control">
                                        <option value=""> -- All -- </option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="f_country_id">Country</label>
                                    <select onchange="getStates(this,'f_state_id')" name="f_country_id" id="f_country_id" class="form-control">
                                        <option value=""> -- All -- </option>
                                        @foreach($countries as $val)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="f_state_id">State</label>
                                    <select onchange="getCities(this,'f_city_id')" name="f_state_id" id="f_state_id" class="form-control">
                                        <option value=""> -- All -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="f_city_id">City</label>
                                    <select name="f_city_id" id="f_city_id" class="form-control">
                                        <option value=""> -- All -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="f_start_act_date">Activity From</label>
                                    <input type="date" name="f_start_act_date" id="f_start_act_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="f_end_act_date">Activity To</label>
                                    <input type="date" name="f_end_act_date" id="f_end_act_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-3 pb-2 pt-4">
                                <button onclick="searchBy(this)" type="button" class="btn btn-primary">Search</button>
                                <a href="" type="button" class="btn btn-success">Reset</a>
                            </div>
                        </div>
                    </div>
                    <form id="assignUserForm">
                        <div class="table-responsive">
                            <table class="table table-hover viewTableData">
                                <thead>
                                <tr>
                                    <th data-sortable="false">
                                        <input onchange="checkUnCheck(this)" class="form-check-input" type="checkbox" id="assign_check_all">
                                    </th>
                                    <th data-sortable="true">ID #</th>
                                    <th data-sortable="true">Created</th>
                                    <th data-sortable="true">Assigned Date</th>
                                    <th data-sortable="true">Last Activity</th>
                                    <th data-sortable="false">Client Status</th>
                                    <th data-sortable="false">Assigned</th>
                                    <th data-sortable="false">Fullname</th>
                                    <th data-sortable="false">Gender</th>
                                    <th data-sortable="false">Location</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
            <hr/>
        </div>
    </div>

    <!-- Assign Modal -->
    <div class="modal fade" id="assignModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Assign Customer</h4>
                    <button type="button" class="close closeModal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="assign_user_id">User</label>
                        <select name="assign_user_id" id="assign_user_id" class="form-control">
                            <option value="">Select</option>
                            @foreach($users as $val)
                                <option value="{{$val->faker_id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="assignUser(this)" type="button" class="btn btn-primary">Assign</button>
                    <button type="button" class="btn btn-danger closeModal">Close</button>
                </div>
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
                        fCustomers: $('select[name="f_customers"] option:selected').val(),
                        fStart_date: $('input[name="f_start_date"]').val(),
                        fEnd_date: $('input[name="f_end_date"]').val(),
                        fAssign: $('select[name="f_assign"] option:selected').val(),
                        fUserId: $('select[name="f_user_id"] option:selected').val(),
                        fGender: $('select[name="f_gender"] option:selected').val(),
                        fCountryId: $('select[name="f_country_id"] option:selected').val(),
                        fStateId: $('select[name="f_state_id"] option:selected').val(),
                        fCityId: $('select[name="f_city_id"] option:selected').val(),
                        fStart_act_date: $('input[name="f_start_act_date"]').val(),
                        fEnd_act_date: $('input[name="f_end_act_date"]').val()
                    });
                }
            },
            columns: [
                {
                    data: 'id',
                    render: function (data, type, full, meta) {
                        return `<input class="form-check-input" type="checkbox" id="assign_check_${data}" name="assign_check[]" value="${data}">`;
                    }
                },
                {
                    data: 'faker_id',
                    render: function (data, type, full, meta) {
                        return (
                            `
                                <a target="_blank" class="fs-3" target="_blank" href="{{route('bdo.get.customer.center.detail')}}/${data}" title="View Detail ${full.id}"><i class="fa fa-eye"></i> </a>
                            `
                        );
                    }
                },
                {
                    data: 'created_at',
                    render: function (data, type, full, meta) {
                        return moment(data).format('Do MMM YYYY h:mm A');
                    }
                },
                {
                    data: 'assign_datetime',
                    render: function (data, type, full, meta) {
                        return (data) ? moment(data).format('Do MMM YYYY h:mm A') : '';
                    }
                },
                {
                    data: 'last_activity_datetime',
                    render: function (data, type, full, meta) {
                        return (data) ? moment(data).format('Do MMM YYYY h:mm A') : '';
                    }
                },
                {
                    data: 'faker_id',
                    render: function (data, type, full, meta) {
                        return full.client_status;
                    }
                },
                {
                    data: 'faker_id',
                    render: function (data, type, full, meta) {
                        return full.assign_user_name;
                    }
                },
                {
                    data: 'full_name'
                },
                {
                    data: 'gender_name'
                },
                {
                    data: 'faker_id',
                    render: function (data, type, full, meta) {
                        return `${(full.get_country_name) ? full.get_country_name.name : 'N/A'}, ${(full.get_cities_name) ? full.get_cities_name.name : 'N/A'}`
                    }
                }
            ],
        });
        
        function assignUser(input) {
            let assignUserId = $('select[name="assign_user_id"]').val();
            if(confirm('Are you sure you want to assign?')){
                $(input).attr('disabled',false);
                axios.post("{{route('bdo.customers.assign')}}", `${$('#assignUserForm').serialize()}&assign_user_id=${assignUserId}`).then(function (res) {
                    alertyFy(res.data.msg,res.data.status,3000);
                    if (res.data.status=='success') {
                        listTable.ajax.reload();
                        $('#assignModal').modal('hide');
                    }
                    $(input).attr('disabled',false);
                }).catch(function (error) {
                    alertyFy('There is something wrong','warning',3000);
                    $(input).attr('disabled',false);
                });
            }
        }

        function checkUnCheck(input) {
            $('input[name="assign_check[]"]').prop('checked', $(input).is(':checked'));
        }

        function showAssignModal() {
            if ($('input[name="assign_check[]"]:checked').length == 0) {
                alertyFy('Please select at least one*','warning',3000);
                return false;
            }
            $('#assignModal').modal('show');
        }

        function checkCustom(input) {
            $('.data--custom').hide();
            if ($(input).val()=='custom') { $('.data--custom').show('slow'); }
        }

        function searchBy(input) {
            $(input).attr('disabled',true);
            setTimeout(function () {
                $(input).attr('disabled',false);
            },2000);
            listTable.ajax.reload();
        }

        function getStates(input,putInField,selectName=' -- All -- ') {
            let selectValue = selectName==' -- All -- ' ? '' : '0';
            let refrenceId = $(input).val();
            let fieldShortCode = $(`select[name="${putInField}"]`);
            let fieldTwoShortCode = $(`select[name="city_id"]`);
            if (putInField=='expectation[state_id]') {
                fieldTwoShortCode = $(`select[name="expectation[city_id]"]`);
            }
            if (putInField=='StateOfOrigin') {
                fieldTwoShortCode = $(`select[name="CityOfOrigin"]`);
            }
            if (refrenceId) {
                axios.get(`{{route('get.states')}}/${refrenceId}`).then(function (res) {
                    fieldShortCode.empty();
                    fieldShortCode.append(new Option(selectName, selectValue));
                    fieldTwoShortCode.empty();
                    fieldTwoShortCode.append(new Option(selectName, selectValue));
                    if (res.data.data.length > 0) {
                        $.each(res.data.data, function (k, v) {
                            fieldShortCode.append(new Option(v.title, v.id));
                        });
                        return;
                    }
                }).catch(function (error) {
                    fieldShortCode.empty();
                    fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
                    fieldTwoShortCode.empty();
                    fieldTwoShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
                    return;
                });
            }
            fieldShortCode.empty();
            fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
            return;
        }

        function getCities(input,putInField,selectName=' -- All -- ') {
            let selectValue = selectName==' -- All -- ' ? '' : '0';
            let refrenceId = $(input).val();
            let fieldShortCode = $(`select[name="${putInField}"]`);
            if (refrenceId) {
                axios.get(`{{route('get.cities')}}/${refrenceId}`).then(function (res) {
                    if (res.data.data.length > 0) {
                        fieldShortCode.empty();
                        fieldShortCode.append(new Option(selectName, selectValue));
                        $.each(res.data.data, function (k, v) {
                            fieldShortCode.append(new Option(v.title, v.id));
                        });
                        return;
                    }
                }).catch(function (error) {
                    fieldShortCode.empty();
                    fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
                    return;
                });
            }
            fieldShortCode.empty();
            fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
            return;
        }

    </script>
@endpush
