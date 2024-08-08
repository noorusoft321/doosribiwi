@extends('match.layouts.master')

@section('title', $title)

@push('style')
    <link href="{{ asset('shaadi-admin/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"/>
    <link href="{{asset('shaadi-admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('shaadi-admin/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
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
                    <a href="{{route('match.get.customers.center')}}"><i class="bx bx-home-alt"></i></a>
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
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="gender">Customer Type</label>
                                    <select class="form-control" name="customer_type">
                                        <option value=""> -- All -- </option>
                                        <option value="featured">Featured</option>
                                        <option value="verified">Verified</option>
                                        <option value="semi_verified">Semi Verified</option>
                                        <option value="not_verified">Not Verified</option>
                                        <option value="second">Second Marriage</option>
                                        <option value="divorced">Divorced Marriage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" name="gender">
                                        <option value=""> -- All -- </option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="ageFrom">Age From</label>
                                            <select class="form-control" name="ageFrom">
                                                <option value=""> -- All -- </option>
                                                @for($i=18; $i<=100; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="ageTo">Age To</label>
                                            <select class="form-control" name="ageTo">
                                                <option value=""> -- All -- </option>
                                                @for($i=18; $i<=100; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="country_id">Country</label>
                                    <select onchange="getStates(this,'state_id')" class="form-control search-select" name="country_id">
                                        <option value=""> -- All -- </option>
                                        @foreach($countries as $val)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="state_id">State</label>
                                    <select onchange="getCities(this,'city_id')" class="form-control search-select" name="state_id">
                                        <option value=""> -- All -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="city_id">City</label>
                                    <select onchange="getAreas(this, 'area_id')" class="form-control search-select" name="city_id">
                                        <option value=""> -- All -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="area_id">Area</label>
                                    <select class="multiple-select form-control" name="area_id">
                                        <option value=""> -- All -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="Tongue">Tongue</label>
                                    <select class="form-control search-select" name="Tongue">
                                        <option value=""> -- All -- </option>
                                        @foreach($tongues as $val)
                                            <option value="{{$val->id}}">{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="Religions">Religion</label>
                                    <select onchange="getSects(this,'Sects')" class="form-control search-select" name="Religions">
                                        <option value=""> -- All -- </option>
                                        @foreach($religions as $val)
                                            <option value="{{$val->id}}">{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="Sects">Sect</label>
                                    <select class="form-control search-select" name="Sects">
                                        <option value=""> -- All -- </option>
                                        @foreach($sects as $val)
                                            <option value="{{$val->id}}">{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="EducationID">Qualification</label>
                                    <select onchange="getMajorCourses(this,'job_post')" class="multiple-select form-control" name="EducationID">
                                        <option value=""> -- All -- </option>
                                        @foreach($educations as $val)
                                            <option value="{{$val->id}}">{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="job_post">Job Post</label>
                                    <select class="form-control" name="job_post">
                                        <option value=""> -- All -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="OccupationID">Profession</label>
                                    <select class="form-control search-select" name="OccupationID">
                                        <option value=""> -- All -- </option>
                                        @foreach($occupations as $val)
                                            <option value="{{$val->id}}">{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="MyIncome">Income</label>
                                    <select class="form-control" name="MyIncome">
                                        <option value=""> -- All -- </option>
                                        @foreach($incomes as $val)
                                            <option value="{{$val->id}}">{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="MaritalStatus">Marital Status</label>
                                    <select class="form-control" name="MaritalStatus">
                                        <option value=""> -- All -- </option>
                                        @foreach($maritalStatues as $val)
                                            <option value="{{$val->id}}">{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="Heights">Height</label>
                                    <select class="form-control" name="Heights">
                                        <option value=""> -- All -- </option>
                                        @foreach($heights as $val)
                                            <option value="{{$val->id}}">{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="Disabilities">Disabilities</label>
                                    <select class="form-control" name="Disabilities">
                                        <option value=""> -- All -- </option>
                                        @foreach($disabilities as $val)
                                            <option value="{{$val->id}}">{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="Castes">Caste</label>
                                    <select class="form-control search-select" name="Castes">
                                        <option value=""> -- All -- </option>
                                        @foreach($castes as $val)
                                            <option value="{{$val->id}}">{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="ResidenceStatus">Residence Status</label>
                                    <select class="form-control search-select" name="ResidenceStatus">
                                        <option value=""> -- All -- </option>
                                        @foreach($residenceStatus as $val)
                                            <option value="{{$val->id}}">{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="FamilyValues">Family Status</label>
                                    <select class="form-control search-select" name="FamilyValues">
                                        <option value=""> -- All -- </option>
                                        @foreach($familyStatus as $val)
                                            <option value="{{$val->id}}">{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="armed_forces">Armed Forces</label>
                                    <select class="form-control " name="armed_forces">
                                        <option value=""> -- All -- </option>
                                        <option value="1"> Yes </option>
                                        <option value="0"> No </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-group">
                                    <label for="profile_link">Profile Link</label>
                                    <input type="text" class="form-control" name="profile_link" placeholder="Customer Profile Link">
                                </div>
                            </div>

                            <div class="col-3 pt-4 pb-2">
                                <button onclick="searchBy(this)" type="button" class="btn btn-primary">Search</button>
                                <a href="" type="button" class="btn btn-danger">Reset</a>
                            </div>
                        </div>
                    </div>

                    <form id="assignUserForm">
                        <div class="table-responsive">
                            <table class="table table-hover viewTableData">
                                <thead>
                                <tr>
                                    <th data-sortable="true">ID #</th>
                                    <th data-sortable="false">Fullname</th>
                                    <th data-sortable="false">Username</th>
                                    <th data-sortable="false">Gender</th>
                                    <th data-sortable="false">Location</th>
                                    <th data-sortable="false">Mobile #</th>
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

@endsection

@push('script')
    <script src="{{ asset('shaadi-admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('shaadi-admin/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="{{asset('shaadi-admin/plugins/select2/js/select2.min.js')}}"></script>

    <script>
        let listTable = '';
        let areas = [];
        let educations = [];

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
                        customer_type: $('select[name="customer_type"] option:selected').val(),
                        gender: $('select[name="gender"] option:selected').val(),
                        ageFrom: $('select[name="ageFrom"] option:selected').val(),
                        ageTo: $('select[name="ageTo"] option:selected').val(),
                        country_id: $('select[name="country_id"] option:selected').val(),
                        state_id: $('select[name="state_id"] option:selected').val(),
                        city_id: $('select[name="city_id"] option:selected').val(),
                        area_id: areas,
                        Tongue: $('select[name="Tongue"] option:selected').val(),
                        Religions: $('select[name="Religions"] option:selected').val(),
                        Sects: $('select[name="Sects"] option:selected').val(),
                        // EducationID: $('select[name="EducationID"] option:selected').val(),
                        EducationID: educations,
                        OccupationID: $('select[name="OccupationID"] option:selected').val(),
                        MyIncome: $('select[name="MyIncome"] option:selected').val(),
                        MaritalStatus: $('select[name="MaritalStatus"] option:selected').val(),
                        Heights: $('select[name="Heights"] option:selected').val(),
                        Disabilities: $('select[name="Disabilities"] option:selected').val(),
                        Castes: $('select[name="Castes"] option:selected').val(),
                        ResidenceStatus: $('select[name="ResidenceStatus"] option:selected').val(),
                        FamilyValues: $('select[name="FamilyValues"] option:selected').val(),
                        armed_forces: $('select[name="armed_forces"] option:selected').val(),
                        profile_link: $('input[name="profile_link"]').val(),
                    });
                }
            },
            columns: [
                {
                    data: 'faker_id',
                    render: function (data, type, full, meta) {
                        return (
                            `
                                <a target="_blank" href="{{route('match.get.customer.center.detail')}}/${data}" title="Customer Detail">${full.id}</a>
                            `
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
                    data: 'gender_name'
                },
                {
                    data: 'faker_id',
                    render: function (data, type, full, meta) {
                        return `${(full.get_cities_name) ? full.get_cities_name.name : 'N/A'}, ${(full.get_country_name) ? full.get_country_name.name : 'N/A'}`
                    }
                },
                {
                    data: 'mobile'
                }
            ],
        });

        $('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
            multiple: true
        });

        $('.search-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear'))
        });

        function searchBy(input) {
            $(input).attr('disabled',true);
            setTimeout(function () {
                $(input).attr('disabled',false);
            },2000);
            areas = [];
            $('select[name="area_id"] :selected').map(function(i, el) {
                if ($(el).val()) {
                    return areas.push($(el).val());
                }
            });
            educations = [];
            $('select[name="EducationID"] :selected').map(function(i, el) {
                if ($(el).val()) {
                    return educations.push($(el).val());
                }
            });
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

        function getAreas(input,putInField,selectName='Select') {
            let selectValue = selectName=='Select' ? '' : '0';
            let refrenceId = $(input).val();
            let fieldShortCode = $(`select[name="${putInField}"]`);
            if (refrenceId) {
                axios.get(`{{route('get.areas')}}/${refrenceId}`).then(function (res) {
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

        function getSects(input,putInField) {
            let refrenceId = $(input).val();
            let fieldShortCode = $(`select[name="${putInField}"]`);
            if (refrenceId) {
                axios.get(`<?php echo e(route('get.sects')); ?>/${refrenceId}`).then(function (res) {
                    if (res.data.data.length > 0) {
                        fieldShortCode.empty();
                        fieldShortCode.append(new Option(' -- All -- ', ''));
                        $.each(res.data.data, function (k, v) {
                            fieldShortCode.append(new Option(v.title, v.id));
                        });
                        return;
                    }
                }).catch(function (error) {
                    fieldShortCode.empty();
                    fieldShortCode.html('<option value=""> -- All -- </option>');
                    return;
                });
            }
            fieldShortCode.empty();
            fieldShortCode.html('<option value=""> -- All -- </option>');
            return;
        }

        function getMajorCourses(input,putInField) {
            let refrenceId = $(input).val();
            let fieldShortCode = $(`select[name="${putInField}"]`);
            if (refrenceId) {
                axios.get(`{{route('get.major.courses')}}/${refrenceId}`).then(function (res) {
                    if (res.data.data.length > 0) {
                        fieldShortCode.empty();
                        fieldShortCode.append(new Option('Select', ''));
                        $.each(res.data.data, function (k, v) {
                            fieldShortCode.append(new Option(v.title, v.id));
                        });
                        return;
                    }
                }).catch(function (error) {
                    fieldShortCode.empty();
                    fieldShortCode.html('<option value="">Select</option>');
                    return;
                });
            }
            fieldShortCode.empty();
            fieldShortCode.html('<option value="">Select</option>');
            return;
        }

    </script>
@endpush
