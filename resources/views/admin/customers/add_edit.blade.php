@extends('admin.layouts.master')

@section('title', $title)

@push('style')
    <link href="{{asset('shaadi-admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('shaadi-admin/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
    <style>
        .form-group {
            margin-bottom: 10px;
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
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    @if(!empty($customer))
                        <form action="{{route('admin.create.update.customer',[$customer->faker_id])}}" id="addEditForm" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            {{-- Register Form --}}
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxl-blogger me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Register Form</h5>
                            </div>

                            <div class="row">
                                {{--<div class="col-6">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="name">*Username</label>--}}
                                        {{--<input onchange="checkIfExists(this)" type="text" data-name="name" name="name" value="{{$customer->name}}" class="form-control">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first_name">*First Name</label>
                                        <input type="text" name="first_name" value="{{$customer->first_name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="last_name">*Last Name</label>
                                        <input type="text" name="last_name" value="{{$customer->last_name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="mobile">*Mobile #</label>
                                        <input onchange="checkIfExists(this)" type="text" data-name="mobile" name="mobile" class="form-control" value="{{$customer->mobile}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email">*Email</label>
                                        <input onchange="checkIfExists(this)" type="text" data-name="email" name="email" class="form-control" value="{{$customer->email}}">
                                    </div>
                                </div>
                                @if(!empty($customer->customerOtherInfo))
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="gender">*Gender</label>
                                            <select class="multiple-select form-control" name="gender">
                                                <option value="">Select Your Gender</option>
                                                <option value="1" {{($customer->customerOtherInfo->gender==1) ? 'selected' : ''}}>Male</option>
                                                <option value="2" {{($customer->customerOtherInfo->gender==2) ? 'selected' : ''}}>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="MaritalStatusID">*Marital Status</label>
                                            <select onchange="checkAvailability(this)" class="multiple-select form-control" name="MaritalStatusID">
                                                <option value="">Select</option>
                                                @foreach($maritalStatuses as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerOtherInfo->MaritalStatusID==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="DOB">*Date of Birth</label>
                                            <input type="date" name="DOB" class="form-control" value="{{$customer->customerOtherInfo->DOB}}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="country_id">*Country</label>
                                            <select onchange="getStates(this,'state_id')" class="multiple-select form-control" name="country_id">
                                                <option value="">Select</option>
                                                @foreach($countries as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerOtherInfo->country_id==$val->id) ? 'selected' : ''}}>{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="state_id">*State</label>
                                            <select onchange="getCities(this,'city_id')" class="multiple-select form-control" name="state_id">
                                                <option value="">Select</option>
                                                @foreach($states as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerOtherInfo->state_id==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="city_id">*City</label>
                                            <select class="multiple-select form-control" name="city_id">
                                                <option value="">Select</option>
                                                @foreach($cities as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerOtherInfo->city_id==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="RegistrationsReasonsID">*Reason for Registering</label>
                                            <select class="multiple-select form-control" name="RegistrationsReasonsID">
                                                <option value="">Select</option>
                                                @foreach($registrationReasons as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerOtherInfo->RegistrationsReasonsID==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-6">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="test">*Second Marriage</label>--}}
                                            {{--<select class="multiple-select form-control" name="second_marraige">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--<option value="1" {{($customer->second_marraige==1) ? 'selected' : ''}}>Male looking for 2nd Wife</option>--}}
                                                {{--<option value="2" {{($customer->second_marraige==2) ? 'selected' : ''}}>Female Ready for 2nd Wife</option>--}}
                                                {{--<option value="3" {{($customer->second_marraige==3) ? 'selected' : ''}}>Looking for Single</option>--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-6">
                                        <div class="form-group divorceReasonDiv" style="display: none;">
                                            <label for="divorceReason">*Reason</label>
                                            <input type="text" name="divorceReason" value="{{$customer->customerOtherInfo->divorceReason}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group childrenQuantityDiv" style="display: none;">
                                            <label for="childrenQuantity">*Children</label>
                                            <input type="number" name="childrenQuantity" value="{{$customer->customerOtherInfo->childrenQuantity}}" class="form-control">
                                        </div>
                                    </div>
                                @else
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="MaritalStatusID">*Marital Status</label>
                                            <select onchange="checkAvailability(this)" class="multiple-select form-control" name="MaritalStatusID">
                                                <option value="">Select</option>
                                                @foreach($maritalStatuses as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="DOB">*Date of Birth</label>
                                            <input type="date" name="DOB" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="country_id">*Country</label>
                                            <select onchange="getStates(this,'state_id')" class="multiple-select form-control" name="country_id">
                                                <option value="">Select</option>
                                                @foreach($countries as $val)
                                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="state_id">*State</label>
                                            <select onchange="getCities(this,'city_id')" class="multiple-select form-control" name="state_id">
                                                <option value="">Select</option>
                                                @foreach($states as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="city_id">*City</label>
                                            <select class="multiple-select form-control" name="city_id">
                                                <option value="">Select</option>
                                                @foreach($cities as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="RegistrationsReasonsID">*Reason for Registering</label>
                                            <select class="multiple-select form-control" name="RegistrationsReasonsID">
                                                <option value="">Select</option>
                                                @foreach($registrationReasons as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-6">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="test">*Second Marriage</label>--}}
                                            {{--<select class="multiple-select form-control" name="second_marraige">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--<option value="1">Male looking for 2nd Wife</option>--}}
                                                {{--<option value="2">Female Ready for 2nd Wife</option>--}}
                                                {{--<option value="3">Looking for Single</option>--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-6">
                                        <div class="form-group divorceReasonDiv" style="display: none;">
                                            <label for="divorceReason">*Reason</label>
                                            <input type="text" name="divorceReason" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group childrenQuantityDiv" style="display: none;">
                                            <label for="childrenQuantity">*Children</label>
                                            <input type="number" name="childrenQuantity" class="form-control">
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <hr>

                            {{-- Career Form --}}
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxl-blogger me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Career Form</h5>
                            </div>

                            @if(!empty($customer->customerCareerInfo))
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Qualification">*Qualification</label>
                                            <select onchange="getMajorCourses(this,'major_course_id')" name="Qualification" id="Qualification" class="multiple-select form-control">
                                                <option value="">Select</option>
                                                @foreach($educations as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerCareerInfo->Qualification==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="major_course_id">*Major Course</label>--}}
                                            {{--<select name="major_course_id" id="major_course_id" class="multiple-select form-control">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($majorCourses as $val)--}}
                                                    {{--<option value="{{$val->id}}" {{($customer->customerCareerInfo->major_course_id==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="University">*University</label>--}}
                                            {{--<select name="University" class="multiple-select form-control">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($universities as $val)--}}
                                                    {{--<option value="{{$val->id}}" {{($customer->customerCareerInfo->University==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Profession">*Profession</label>
                                            <select name="Profession" id="Profession" class="multiple-select form-control">
                                                <option value="">Select</option>
                                                @foreach($occupations as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerCareerInfo->Profession==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="JobPost">*Job Post</label>--}}
                                            {{--<select name="JobPost" class="multiple-select form-control">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($jobPosts as $val)--}}
                                                    {{--<option value="{{$val->id}}" {{($customer->customerCareerInfo->JobPost==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="MonthlyIncome">*Monthly Income</label>
                                            <select name="MonthlyIncome" class="multiple-select form-control">
                                                <option value="">Select</option>
                                                @foreach($incomes as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerCareerInfo->MonthlyIncome==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="FuturePlans">*Future Plan</label>--}}
                                            {{--<select name="FuturePlans" class="multiple-select form-control">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($futurePlans as $val)--}}
                                                    {{--<option value="{{$val->id}}" {{($customer->customerCareerInfo->FuturePlans==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Qualification">*Qualification</label>
                                            <select onchange="getMajorCourses(this,'major_course_id')" name="Qualification" id="Qualification" class="multiple-select form-control">
                                                <option value="">Select</option>
                                                @foreach($educations as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="major_course_id">*Major Course</label>--}}
                                            {{--<select name="major_course_id" id="major_course_id" class="multiple-select form-control">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($majorCourses as $val)--}}
                                                    {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="University">*University</label>--}}
                                            {{--<select name="University" class="multiple-select form-control">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($universities as $val)--}}
                                                    {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Profession">*Profession</label>
                                            <select name="Profession" id="Profession" class="multiple-select form-control">
                                                <option value="">Select</option>
                                                @foreach($occupations as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="JobPost">*Job Post</label>--}}
                                            {{--<select name="JobPost" class="multiple-select form-control">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($jobPosts as $val)--}}
                                                    {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="MonthlyIncome">*Monthly Income</label>
                                            <select name="MonthlyIncome" class="multiple-select form-control">
                                                <option value="">Select</option>
                                                @foreach($incomes as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="FuturePlans">*Future Plan</label>--}}
                                            {{--<select name="FuturePlans" class="multiple-select form-control">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($futurePlans as $val)--}}
                                                    {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            @endif

                            <hr>

                            {{-- Personal Form --}}
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxl-blogger me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Personal Form</h5>
                            </div>
                            @if(!empty($customer->customerPersonalInfo))
                                <div class="row">
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="CountryOfOrigin">*Country of Origin</label>--}}
                                            {{--<select onchange="getStates(this,'StateOfOrigin')" class="multiple-select form-control" name="CountryOfOrigin">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($countries as $val)--}}
                                                    {{--<option value="{{$val->id}}" {{($customer->customerPersonalInfo->CountryOfOrigin==$val->id) ? 'selected' : ''}}>{{$val->name}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="StateOfOrigin">*State of Origin</label>--}}
                                            {{--<select onchange="getCities(this,'CityOfOrigin')" class="multiple-select form-control" name="StateOfOrigin">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($statesOfOrigin as $val)--}}
                                                    {{--<option value="{{$val->id}}" {{($customer->customerPersonalInfo->StateOfOrigin==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="CityOfOrigin">*City of Origin</label>--}}
                                            {{--<select class="multiple-select form-control" name="CityOfOrigin">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($citiesOfOrigin as $val)--}}
                                                    {{--<option value="{{$val->id}}" {{($customer->customerPersonalInfo->CityOfOrigin==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="WillingToRelocate">*Willing to Relocate</label>--}}
                                            {{--<select class="multiple-select form-control" name="WillingToRelocate">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($willingToRelocates as $val)--}}
                                                    {{--<option value="{{$val->id}}" {{($customer->customerPersonalInfo->WillingToRelocate==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="IAmLookingToMarry">*I am Looking to Marry</label>
                                            <select class="multiple-select form-control" name="IAmLookingToMarry">
                                                <option value="">Select</option>
                                                @foreach($lookingToMarries as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerPersonalInfo->IAmLookingToMarry==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="MyLivingArrangements">*Living Arrangement</label>
                                            <select class="multiple-select form-control" name="MyLivingArrangements">
                                                <option value="">Select</option>
                                                @foreach($livingArrangements as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerPersonalInfo->MyLivingArrangements==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Heights">*Height</label>
                                            <select class="multiple-select form-control" name="Heights">
                                                <option value="">Select</option>
                                                @foreach($heights as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerPersonalInfo->Heights==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Weights">*Weight</label>
                                            <select class="multiple-select form-control" name="Weights">
                                                <option value="">Select</option>
                                                @foreach($weights as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerPersonalInfo->Weights==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Complexions">*Complexion</label>
                                            <select class="multiple-select form-control" name="Complexions">
                                                <option value="">Select</option>
                                                @foreach($complexions as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerPersonalInfo->Complexions==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="MyBuilds">*My Build</label>--}}
                                            {{--<select class="multiple-select form-control" name="MyBuilds">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($myBuilds as $val)--}}
                                                    {{--<option value="{{$val->id}}" {{($customer->customerPersonalInfo->MyBuilds==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="HairColors">*Hair Color</label>
                                            <select class="multiple-select form-control" name="HairColors">
                                                <option value="">Select</option>
                                                @foreach($hairColors as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerPersonalInfo->HairColors==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="EyeColors">*Eye Color</label>
                                            <select class="multiple-select form-control" name="EyeColors">
                                                <option value="">Select</option>
                                                @foreach($eyeColors as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerPersonalInfo->EyeColors==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Smokes">*Smoke</label>
                                            <select class="multiple-select form-control" name="Smokes">
                                                <option value="">Select</option>
                                                @foreach($smokes as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerPersonalInfo->Smokes==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Disabilities">*Disability</label>
                                            <select class="multiple-select form-control" name="Disabilities">
                                                <option value="">Select</option>
                                                @foreach($disabilities as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerPersonalInfo->Disabilities==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Caste">*Caste</label>
                                            <select class="multiple-select form-control" name="Caste">
                                                <option value="">Select</option>
                                                @foreach($castes as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerPersonalInfo->Caste==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="MyFirstLanguageMotherTonguesID">*Mother Tongue</label>
                                            <select class="multiple-select form-control" name="MyFirstLanguageMotherTonguesID">
                                                <option value="">Select</option>
                                                @foreach($tongues as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerOtherInfo->MyFirstLanguageMotherTonguesID==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="CountryOfOrigin">*Country of Origin</label>--}}
                                            {{--<select onchange="getStates(this,'StateOfOrigin')" class="multiple-select form-control" name="CountryOfOrigin">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($countries as $val)--}}
                                                    {{--<option value="{{$val->id}}">{{$val->name}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="StateOfOrigin">*State of Origin</label>--}}
                                            {{--<select onchange="getCities(this,'CityOfOrigin')" class="multiple-select form-control" name="StateOfOrigin">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($states as $val)--}}
                                                    {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="CityOfOrigin">*City of Origin</label>--}}
                                            {{--<select class="multiple-select form-control" name="CityOfOrigin">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($cities as $val)--}}
                                                    {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="WillingToRelocate">*Willing to Relocate</label>--}}
                                            {{--<select class="multiple-select form-control" name="WillingToRelocate">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($willingToRelocates as $val)--}}
                                                    {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="IAmLookingToMarry">*I am Looking to Marry</label>
                                            <select class="multiple-select form-control" name="IAmLookingToMarry">
                                                <option value="">Select</option>
                                                @foreach($lookingToMarries as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="MyLivingArrangements">*Living Arrangement</label>
                                            <select class="multiple-select form-control" name="MyLivingArrangements">
                                                <option value="">Select</option>
                                                @foreach($livingArrangements as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Heights">*Height</label>
                                            <select class="multiple-select form-control" name="Heights">
                                                <option value="">Select</option>
                                                @foreach($heights as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Weights">*Weight</label>
                                            <select class="multiple-select form-control" name="Weights">
                                                <option value="">Select</option>
                                                @foreach($weights as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Complexions">*Complexion</label>
                                            <select class="multiple-select form-control" name="Complexions">
                                                <option value="">Select</option>
                                                @foreach($complexions as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="MyBuilds">*My Build</label>--}}
                                            {{--<select class="multiple-select form-control" name="MyBuilds">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($myBuilds as $val)--}}
                                                    {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="HairColors">*Hair Color</label>
                                            <select class="multiple-select form-control" name="HairColors">
                                                <option value="">Select</option>
                                                @foreach($hairColors as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="EyeColors">*Eye Color</label>
                                            <select class="multiple-select form-control" name="EyeColors">
                                                <option value="">Select</option>
                                                @foreach($eyeColors as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Smokes">*Smoke</label>
                                            <select class="multiple-select form-control" name="Smokes">
                                                <option value="">Select</option>
                                                @foreach($smokes as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Disabilities">*Disability</label>
                                            <select class="multiple-select form-control" name="Disabilities">
                                                <option value="">Select</option>
                                                @foreach($disabilities as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Caste">*Caste</label>
                                            <select class="multiple-select form-control" name="Caste">
                                                <option value="">Select</option>
                                                @foreach($castes as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="MyFirstLanguageMotherTonguesID">*Mother Tongue</label>
                                            <select class="multiple-select form-control" name="MyFirstLanguageMotherTonguesID">
                                                <option value="">Select</option>
                                                @foreach($tongues as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <hr>

                            {{-- Religion Form --}}
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxl-blogger me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Religion Form</h5>
                            </div>

                            @if(!empty($customer->customerReligionInfo))
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Religions">*Religion</label>
                                            <select onchange="getSects(this,'Sects')" class="multiple-select form-control" name="Religions">
                                                <option value="">Select</option>
                                                @foreach($religions as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerReligionInfo->Religions==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Sects">*Sect</label>
                                            <select class="multiple-select form-control" name="Sects">
                                                <option value="">Select</option>
                                                @foreach($sects as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerReligionInfo->Sects==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="DoYouPreferHijabs">*Do You Prefer Hijab?</label>
                                            <select class="multiple-select form-control" name="DoYouPreferHijabs">
                                                <option value="">Select</option>
                                                @foreach($preferHijabs as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerReligionInfo->DoYouPreferHijabs==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="DoYouHaveBeards">*Do You Prefer Beard?</label>
                                            <select class="multiple-select form-control" name="DoYouHaveBeards">
                                                <option value="">Select</option>
                                                @foreach($beards as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerReligionInfo->DoYouHaveBeards==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="AreYouReverts">*Are You A Revert / Converted Religion?</label>
                                            <select class="multiple-select form-control" name="AreYouReverts">
                                                <option value="">Select</option>
                                                @foreach($reverts as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerReligionInfo->AreYouReverts==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="DoYouKeepHalal">*Do You Keep Halal?</label>
                                            <select class="multiple-select form-control" name="DoYouKeepHalal">
                                                <option value="">Select</option>
                                                @foreach($halals as $val)
                                                    <option value="{{$val->id}}" {{($customer->customerReligionInfo->DoYouKeepHalal==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="DoYouPerformSalaah">*Do You Perform Salaah?</label>--}}
                                            {{--<select class="multiple-select form-control" name="DoYouPerformSalaah">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($performSalaahs as $val)--}}
                                                    {{--<option value="{{$val->id}}" {{($customer->customerReligionInfo->DoYouPerformSalaah==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Religions">*Religion</label>
                                            <select onchange="getSects(this,'Sects')" class="multiple-select form-control" name="Religions">
                                                <option value="">Select</option>
                                                @foreach($religions as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Sects">*Sect</label>
                                            <select class="multiple-select form-control" name="Sects">
                                                <option value="">Select</option>
                                                @foreach($sects as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="DoYouPreferHijabs">*Do You Prefer Hijab?</label>
                                            <select class="multiple-select form-control" name="DoYouPreferHijabs">
                                                <option value="">Select</option>
                                                @foreach($preferHijabs as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="DoYouHaveBeards">*Do You Prefer Beard?</label>
                                            <select class="multiple-select form-control" name="DoYouHaveBeards">
                                                <option value="">Select</option>
                                                @foreach($beards as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="AreYouReverts">*Are You A Revert / Converted Religion?</label>
                                            <select class="multiple-select form-control" name="AreYouReverts">
                                                <option value="">Select</option>
                                                @foreach($reverts as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group py-xl-10">
                                            <label for="DoYouKeepHalal">*Do You Keep Halal?</label>
                                            <select class="multiple-select form-control" name="DoYouKeepHalal">
                                                <option value="">Select</option>
                                                @foreach($halals as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="DoYouPerformSalaah">*Do You Perform Salaah?</label>--}}
                                            {{--<select class="multiple-select form-control" name="DoYouPerformSalaah">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($performSalaahs as $val)--}}
                                                    {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            @endif

                            <hr>

                            {{-- Expectation Form --}}
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxl-blogger me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Expectation Form</h5>
                            </div>

                            @if(!empty($customer->customerSearch) && !empty($customer->customerSearch->title))
                                @php $customerSearch = json_decode($customer->customerSearch->title); @endphp
                            {{--@dd($customerSearch)--}}
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="gender">Gender</label>
                                            <select class="multiple-select form-control" required name="expectation[gender]">
                                                <option value="">Select</option>
                                                <option value="1" {{($customerSearch->gender==1) ? 'selected' : ''}}>Male</option>
                                                <option value="2" {{($customerSearch->gender==2) ? 'selected' : ''}}>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="ageFrom">Age From</label>
                                            <select class="multiple-select form-control" required name="expectation[ageFrom]">
                                                <option value="">Select</option>
                                                @for($i=18; $i<=100; $i++)
                                                    <option value="{{$i}}" {{($customerSearch->ageFrom==$i) ? 'selected' : ''}}>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="ageTo">Age To</label>
                                            <select class="multiple-select form-control" required name="expectation[ageTo]">
                                                <option value="">Select</option>
                                                @for($i=18; $i<=100; $i++)
                                                    <option value="{{$i}}" {{($customerSearch->ageTo==$i) ? 'selected' : ''}}>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="country_id">Country</label>
                                            <select onchange="getStates(this,'expectation[state_id]')" class="multiple-select form-control" required name="expectation[country_id]">
                                                <option value="">Select</option>
                                                @foreach($countries as $val)
                                                    <option value="{{$val->id}}" {{($customerSearch->country_id==$val->id) ? 'selected' : ''}}>{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="state_id">State</label>
                                            <select onchange="getCities(this,'expectation[city_id]')" class="multiple-select form-control" required name="expectation[state_id]">
                                                <option value="">Select</option>
                                                @foreach($statesExpectation as $val)
                                                    <option value="{{$val->id}}" {{($customerSearch->state_id==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="city_id">City</label>
                                            <select class="multiple-select form-control" required name="expectation[city_id]">
                                                <option value="">Select</option>
                                                @foreach($citiesExpectation as $val)
                                                    <option value="{{$val->id}}" {{($customerSearch->city_id==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Tongue">Tongue</label>
                                            <select class="multiple-select form-control" required name="expectation[Tongue]">
                                                <option value="">Select</option>
                                                @foreach($tongues as $val)
                                                    <option value="{{$val->id}}" {{($customerSearch->Tongue==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Religions">Religiousness</label>
                                            <select onchange="getSects(this,'expectation[Sects]')" class="multiple-select form-control" required name="expectation[Religions]">
                                                <option value="">Select</option>
                                                @foreach($religions as $val)
                                                    <option value="{{$val->id}}" {{($customerSearch->Religions==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Sects">Sect</label>
                                            <select class="multiple-select form-control" required name="expectation[Sects]">
                                                <option value="">Select</option>
                                                @foreach($sectsExpectation as $val)
                                                    <option value="{{$val->id}}" {{($customerSearch->Sects==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="EducationID">Qualification</label>
                                            <select class="multiple-select form-control" required name="expectation[EducationID]">
                                                <option value="">Select</option>
                                                @foreach($educations as $val)
                                                    <option value="{{$val->id}}" {{($customerSearch->EducationID==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="OccupationID">Profession</label>
                                            <select class="multiple-select form-control" required name="expectation[OccupationID]">
                                                <option value="">Select</option>
                                                @foreach($occupations as $val)
                                                    <option value="{{$val->id}}" {{($customerSearch->OccupationID==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="MyIncome">Income</label>
                                            <select class="multiple-select form-control" required name="expectation[MyIncome]">
                                                <option value="">Select</option>
                                                @foreach($incomes as $val)
                                                    <option value="{{$val->id}}" {{($customerSearch->MyIncome==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="WillingToRelocate">Willing To Relocate</label>--}}
                                            {{--<select class="multiple-select form-control" required name="expectation[WillingToRelocate]">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($willingToRelocates as $val)--}}
                                                    {{--<option value="{{$val->id}}" {{($customerSearch->WillingToRelocate==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="MyBuilds">Builds</label>--}}
                                            {{--<select class="multiple-select form-control" required name="expectation[MyBuilds]">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($myBuilds as $val)--}}
                                                    {{--<option value="{{$val->id}}" {{($customerSearch->MyBuilds==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="MaritalStatus">Marital Status</label>
                                            <select class="multiple-select form-control" required name="expectation[MaritalStatus]">
                                                <option value="">Select</option>
                                                @foreach($maritalStatuses as $val)
                                                    <option value="{{$val->id}}" {{($customerSearch->MaritalStatus==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="MyLivingArrangements">Living Arrangements</label>
                                            <select class="multiple-select form-control" required name="expectation[MyLivingArrangements]">
                                                <option value="">Select</option>
                                                @foreach($livingArrangements as $val)
                                                    <option value="{{$val->id}}" {{($customerSearch->MyLivingArrangements==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Heights">Heights</label>
                                            <select class="multiple-select form-control" required name="expectation[Heights]">
                                                <option value="">Select</option>
                                                @foreach($heights as $val)
                                                    <option value="{{$val->id}}" {{($customerSearch->Heights==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Disabilities">Disabilities</label>
                                            <select class="multiple-select form-control" required name="expectation[Disabilities]">
                                                <option value="">Select</option>
                                                @foreach($disabilities as $val)
                                                    <option value="{{$val->id}}" {{($customerSearch->Disabilities==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Castes">Caste</label>
                                            <select class="multiple-select form-control" required name="expectation[Castes]">
                                                <option value="">Select</option>
                                                @foreach($castes as $val)
                                                    <option value="{{$val->id}}" {{($customerSearch->Castes==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="gender">Gender</label>
                                            <select class="multiple-select form-control" required name="expectation[gender]">
                                                <option value="">Select</option>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="ageFrom">Age From</label>
                                            <select class="multiple-select form-control" required name="expectation[ageFrom]">
                                                <option value="">Select</option>
                                                @for($i=18; $i<=100; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="ageTo">Age To</label>
                                            <select class="multiple-select form-control" required name="expectation[ageTo]">
                                                <option value="">Select</option>
                                                @for($i=18; $i<=100; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="country_id">Country</label>
                                            <select onchange="getStates(this,'expectation[state_id]')" class="multiple-select form-control" required name="expectation[country_id]">
                                                <option value="">Select</option>
                                                @foreach($countries as $val)
                                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="state_id">State</label>
                                            <select onchange="getCities(this,'expectation[city_id]')" class="multiple-select form-control" required name="expectation[state_id]">
                                                <option value="">Select</option>
                                                @foreach($statesExpectation as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="city_id">City</label>
                                            <select class="multiple-select form-control" required name="expectation[city_id]">
                                                <option value="">Select</option>
                                                @foreach($citiesExpectation as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Tongue">Tongue</label>
                                            <select class="multiple-select form-control" required name="expectation[Tongue]">
                                                <option value="">Select</option>
                                                @foreach($tongues as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Religions">Religiousness</label>
                                            <select onchange="getSects(this,'expectation[Sects]')" class="multiple-select form-control" required name="expectation[Religions]">
                                                <option value="">Select</option>
                                                @foreach($religions as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Sects">Sect</label>
                                            <select class="multiple-select form-control" required name="expectation[Sects]">
                                                <option value="">Select</option>
                                                @foreach($sectsExpectation as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="EducationID">Qualification</label>
                                            <select class="multiple-select form-control" required name="expectation[EducationID]">
                                                <option value="">Select</option>
                                                @foreach($educations as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="OccupationID">Profession</label>
                                            <select class="multiple-select form-control" required name="expectation[OccupationID]">
                                                <option value="">Select</option>
                                                @foreach($occupations as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="MyIncome">Income</label>
                                            <select class="multiple-select form-control" required name="expectation[MyIncome]">
                                                <option value="">Select</option>
                                                @foreach($incomes as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="WillingToRelocate">Willing To Relocate</label>--}}
                                            {{--<select class="multiple-select form-control" required name="expectation[WillingToRelocate]">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($willingToRelocates as $val)--}}
                                                    {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-6">--}}
                                        {{--<div class="form-group py-xl-10">--}}
                                            {{--<label for="MyBuilds">Builds</label>--}}
                                            {{--<select class="multiple-select form-control" required name="expectation[MyBuilds]">--}}
                                                {{--<option value="">Select</option>--}}
                                                {{--@foreach($myBuilds as $val)--}}
                                                    {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="MaritalStatus">Marital Status</label>
                                            <select class="multiple-select form-control" required name="expectation[MaritalStatus]">
                                                <option value="">Select</option>
                                                @foreach($maritalStatuses as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="MyLivingArrangements">Living Arrangements</label>
                                            <select class="multiple-select form-control" required name="expectation[MyLivingArrangements]">
                                                <option value="">Select</option>
                                                @foreach($livingArrangements as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Heights">Heights</label>
                                            <select class="multiple-select form-control" required name="expectation[Heights]">
                                                <option value="">Select</option>
                                                @foreach($heights as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Disabilities">Disabilities</label>
                                            <select class="multiple-select form-control" required name="expectation[Disabilities]">
                                                <option value="">Select</option>
                                                @foreach($disabilities as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group py-xl-10">
                                            <label for="Castes">Caste</label>
                                            <select class="multiple-select form-control" required name="expectation[Castes]">
                                                <option value="">Select</option>
                                                @foreach($castes as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <hr>

                            {{-- Profile Image Form --}}
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxl-blogger me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Profile Image Form</h5>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="blur_percent">Blur Percent</label>
                                        <select name="blur_percent" id="blur_percent" class="form-control">
                                            <option value="0" {{($customer->blur_percent==0) ? 'selected' : ''}}>Original</option>
                                            <option value="10" {{($customer->blur_percent==10) ? 'selected' : ''}}>Soft</option>
                                            <option value="15" {{($customer->blur_percent==15) ? 'selected' : ''}}>Medium</option>
                                            <option value="25" {{($customer->blur_percent==25) ? 'selected' : ''}}>Heavy</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="profile_pic_client_status">Who can see profile picture?</label>
                                        <select name="profile_pic_client_status" id="profile_pic_client_status" class="form-control">
                                            <option value="1" {{($customer->blur_percent==1) ? 'selected' : ''}}>Everyone</option>
                                            <option value="0" {{($customer->blur_percent==0) ? 'selected' : ''}}>Only Me</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="image">Profile Image</label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/png, image/gif, image/jpeg, image/jpg">
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5 float-end mx-1">Save</button>
                                    <a href="{{route('admin.get.customers')}}" type="button" class="btn btn-secondary px-5 float-end">Cancel</a>
                                </div>
                            </div>
                        </form>
                    @else
                        <form action="{{route('admin.create.update.customer')}}" id="addEditForm" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            {{-- Register Form --}}
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxl-blogger me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Register Form</h5>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="gender">*Gender</label>
                                        <select class="multiple-select form-control" name="gender">
                                            <option value="">Select Your Gender</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                </div>
                                {{--<div class="col-6">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="name">*Username</label>--}}
                                        {{--<input onchange="checkIfExists(this)" type="text" data-name="name" name="name" class="form-control">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first_name">*First Name</label>
                                        <input type="text" name="first_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="last_name">*Last Name</label>
                                        <input type="text" name="last_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="MaritalStatusID">*Marital Status</label>
                                        <select onchange="checkAvailability(this)" class="multiple-select form-control" name="MaritalStatusID">
                                            <option value="">Select</option>
                                            @foreach($maritalStatuses as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="DOB">*Date of Birth</label>
                                        <input type="date" name="DOB" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="country_id">*Country</label>
                                        <select onchange="getStates(this,'state_id')" class="multiple-select form-control" name="country_id">
                                            <option value="">Select</option>
                                            @foreach($countries as $val)
                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="state_id">*State</label>
                                        <select onchange="getCities(this,'city_id')" class="multiple-select form-control" name="state_id">
                                            <option value="">Select</option>
                                            @foreach($states as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="city_id">*City</label>
                                        <select class="multiple-select form-control" name="city_id">
                                            <option value="">Select</option>
                                            @foreach($cities as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="mobile">*Mobile #</label>
                                        <input onchange="checkIfExists(this)" type="text" data-name="mobile" name="mobile" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="RegistrationsReasonsID">*Reason for Registering</label>
                                        <select class="multiple-select form-control" name="RegistrationsReasonsID">
                                            <option value="">Select</option>
                                            @foreach($registrationReasons as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--<div class="col-6">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="test">*Second Marriage</label>--}}
                                        {{--<select class="multiple-select form-control" name="second_marraige">--}}
                                            {{--<option value="">Select</option>--}}
                                            {{--<option value="1">Male looking for 2nd Wife</option>--}}
                                            {{--<option value="2">Female Ready for 2nd Wife</option>--}}
                                            {{--<option value="3">Looking for Single</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email">*Email</label>
                                        <input onchange="checkIfExists(this)" type="text" data-name="email" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="password">*Password</label>
                                        <input type="text" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group divorceReasonDiv" style="display: none;">
                                        <label for="divorceReason">*Reason</label>
                                        <input type="text" name="divorceReason" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group childrenQuantityDiv" style="display: none;">
                                        <label for="childrenQuantity">*Children</label>
                                        <input type="number" name="childrenQuantity" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            {{-- Career Form --}}
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxl-blogger me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Career Form</h5>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Qualification">*Qualification</label>
                                        <select onchange="getMajorCourses(this,'major_course_id')" name="Qualification" id="Qualification" class="multiple-select form-control">
                                            <option value="">Select</option>
                                            @foreach($educations as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group py-xl-10">--}}
                                        {{--<label for="major_course_id">*Major Course</label>--}}
                                        {{--<select name="major_course_id" id="major_course_id" class="multiple-select form-control">--}}
                                            {{--<option value="">Select</option>--}}
                                            {{--@foreach($majorCourses as $val)--}}
                                                {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group py-xl-10">--}}
                                        {{--<label for="University">*University</label>--}}
                                        {{--<select name="University" class="multiple-select form-control">--}}
                                            {{--<option value="">Select</option>--}}
                                            {{--@foreach($universities as $val)--}}
                                                {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Profession">*Profession</label>
                                        <select name="Profession" id="Profession" class="multiple-select form-control">
                                            <option value="">Select</option>
                                            @foreach($occupations as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group py-xl-10">--}}
                                        {{--<label for="JobPost">*Job Post</label>--}}
                                        {{--<select name="JobPost" class="multiple-select form-control">--}}
                                            {{--<option value="">Select</option>--}}
                                            {{--@foreach($jobPosts as $val)--}}
                                                {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="MonthlyIncome">*Monthly Income</label>
                                        <select name="MonthlyIncome" class="multiple-select form-control">
                                            <option value="">Select</option>
                                            @foreach($incomes as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group py-xl-10">--}}
                                        {{--<label for="FuturePlans">*Future Plan</label>--}}
                                        {{--<select name="FuturePlans" class="multiple-select form-control">--}}
                                            {{--<option value="">Select</option>--}}
                                            {{--@foreach($futurePlans as $val)--}}
                                                {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>

                            <hr>

                            {{-- Personal Form --}}
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxl-blogger me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Personal Form</h5>
                            </div>

                            <div class="row">
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group py-xl-10">--}}
                                        {{--<label for="CountryOfOrigin">*Country of Origin</label>--}}
                                        {{--<select onchange="getStates(this,'StateOfOrigin')" class="multiple-select form-control" name="CountryOfOrigin">--}}
                                            {{--<option value="">Select</option>--}}
                                            {{--@foreach($countries as $val)--}}
                                                {{--<option value="{{$val->id}}">{{$val->name}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group py-xl-10">--}}
                                        {{--<label for="StateOfOrigin">*State of Origin</label>--}}
                                        {{--<select onchange="getCities(this,'CityOfOrigin')" class="multiple-select form-control" name="StateOfOrigin">--}}
                                            {{--<option value="">Select</option>--}}
                                            {{--@foreach($states as $val)--}}
                                                {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group py-xl-10">--}}
                                        {{--<label for="CityOfOrigin">*City of Origin</label>--}}
                                        {{--<select class="multiple-select form-control" name="CityOfOrigin">--}}
                                            {{--<option value="">Select</option>--}}
                                            {{--@foreach($cities as $val)--}}
                                                {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group py-xl-10">--}}
                                        {{--<label for="WillingToRelocate">*Willing to Relocate</label>--}}
                                        {{--<select class="multiple-select form-control" name="WillingToRelocate">--}}
                                            {{--<option value="">Select</option>--}}
                                            {{--@foreach($willingToRelocates as $val)--}}
                                                {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="IAmLookingToMarry">*I am Looking to Marry</label>
                                        <select class="multiple-select form-control" name="IAmLookingToMarry">
                                            <option value="">Select</option>
                                            @foreach($lookingToMarries as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="MyLivingArrangements">*Living Arrangement</label>
                                        <select class="multiple-select form-control" name="MyLivingArrangements">
                                            <option value="">Select</option>
                                            @foreach($livingArrangements as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Heights">*Height</label>
                                        <select class="multiple-select form-control" name="Heights">
                                            <option value="">Select</option>
                                            @foreach($heights as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Weights">*Weight</label>
                                        <select class="multiple-select form-control" name="Weights">
                                            <option value="">Select</option>
                                            @foreach($weights as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Complexions">*Complexion</label>
                                        <select class="multiple-select form-control" name="Complexions">
                                            <option value="">Select</option>
                                            @foreach($complexions as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group py-xl-10">--}}
                                        {{--<label for="MyBuilds">*My Build</label>--}}
                                        {{--<select class="multiple-select form-control" name="MyBuilds">--}}
                                            {{--<option value="">Select</option>--}}
                                            {{--@foreach($myBuilds as $val)--}}
                                                {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="HairColors">*Hair Color</label>
                                        <select class="multiple-select form-control" name="HairColors">
                                            <option value="">Select</option>
                                            @foreach($hairColors as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="EyeColors">*Eye Color</label>
                                        <select class="multiple-select form-control" name="EyeColors">
                                            <option value="">Select</option>
                                            @foreach($eyeColors as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Smokes">*Smoke</label>
                                        <select class="multiple-select form-control" name="Smokes">
                                            <option value="">Select</option>
                                            @foreach($smokes as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Disabilities">*Disability</label>
                                        <select class="multiple-select form-control" name="Disabilities">
                                            <option value="">Select</option>
                                            @foreach($disabilities as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Caste">*Caste</label>
                                        <select class="multiple-select form-control" name="Caste">
                                            <option value="">Select</option>
                                            @foreach($castes as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="MyFirstLanguageMotherTonguesID">*Mother Tongue</label>
                                        <select class="multiple-select form-control" name="MyFirstLanguageMotherTonguesID">
                                            <option value="">Select</option>
                                            @foreach($tongues as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            {{-- Religion Form --}}
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxl-blogger me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Religion Form</h5>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Religions">*Religion</label>
                                        <select onchange="getSects(this,'Sects')" class="multiple-select form-control" name="Religions">
                                            <option value="">Select</option>
                                            @foreach($religions as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Sects">*Sect</label>
                                        <select class="multiple-select form-control" name="Sects">
                                            <option value="">Select</option>
                                            @foreach($sects as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="DoYouPreferHijabs">*Do You Prefer Hijab?</label>
                                        <select class="multiple-select form-control" name="DoYouPreferHijabs">
                                            <option value="">Select</option>
                                            @foreach($preferHijabs as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="DoYouHaveBeards">*Do You Prefer Beard?</label>
                                        <select class="multiple-select form-control" name="DoYouHaveBeards">
                                            <option value="">Select</option>
                                            @foreach($beards as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="AreYouReverts">*Are You A Revert / Converted Religion?</label>
                                        <select class="multiple-select form-control" name="AreYouReverts">
                                            <option value="">Select</option>
                                            @foreach($reverts as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group py-xl-10">
                                        <label for="DoYouKeepHalal">*Do You Keep Halal?</label>
                                        <select class="multiple-select form-control" name="DoYouKeepHalal">
                                            <option value="">Select</option>
                                            @foreach($halals as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group py-xl-10">--}}
                                        {{--<label for="DoYouPerformSalaah">*Do You Perform Salaah?</label>--}}
                                        {{--<select class="multiple-select form-control" name="DoYouPerformSalaah">--}}
                                            {{--<option value="">Select</option>--}}
                                            {{--@foreach($performSalaahs as $val)--}}
                                                {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>

                            <hr>

                            {{-- Expectation Form --}}
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxl-blogger me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Expectation Form</h5>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="gender">Gender</label>
                                        <select class="multiple-select form-control" required name="expectation[gender]">
                                            <option value="">Select</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="ageFrom">Age From</label>
                                        <select class="multiple-select form-control" required name="expectation[ageFrom]">
                                            <option value="">Select</option>
                                            @for($i=18; $i<=100; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="ageTo">Age To</label>
                                        <select class="multiple-select form-control" required name="expectation[ageTo]">
                                            <option value="">Select</option>
                                            @for($i=18; $i<=100; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="country_id">Country</label>
                                        <select onchange="getStates(this,'expectation[state_id]')" class="multiple-select form-control" required name="expectation[country_id]">
                                            <option value="">Select</option>
                                            @foreach($countries as $val)
                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="state_id">State</label>
                                        <select onchange="getCities(this,'expectation[city_id]')" class="multiple-select form-control" required name="expectation[state_id]">
                                            <option value="">Select</option>
                                            @foreach($states as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="city_id">City</label>
                                        <select class="multiple-select form-control" required name="expectation[city_id]">
                                            <option value="">Select</option>
                                            @foreach($cities as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Tongue">Tongue</label>
                                        <select class="multiple-select form-control" required name="expectation[Tongue]">
                                            <option value="">Select</option>
                                            @foreach($tongues as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Religions">Religiousness</label>
                                        <select onchange="getSects(this,'expectation[Sects]')" class="multiple-select form-control" required name="expectation[Religions]">
                                            <option value="">Select</option>
                                            @foreach($religions as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Sects">Sect</label>
                                        <select class="multiple-select form-control" required name="expectation[Sects]">
                                            <option value="">Select</option>
                                            @foreach($sects as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="EducationID">Qualification</label>
                                        <select class="multiple-select form-control" required name="expectation[EducationID]">
                                            <option value="">Select</option>
                                            @foreach($educations as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="OccupationID">Profession</label>
                                        <select class="multiple-select form-control" required name="expectation[OccupationID]">
                                            <option value="">Select</option>
                                            @foreach($occupations as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="MyIncome">Income</label>
                                        <select class="multiple-select form-control" required name="expectation[MyIncome]">
                                            <option value="">Select</option>
                                            @foreach($incomes as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--<div class="col-6">--}}
                                    {{--<div class="form-group py-xl-10">--}}
                                        {{--<label for="WillingToRelocate">Willing To Relocate</label>--}}
                                        {{--<select class="multiple-select form-control" required name="expectation[WillingToRelocate]">--}}
                                            {{--<option value="">Select</option>--}}
                                            {{--@foreach($willingToRelocates as $val)--}}
                                                {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-6">--}}
                                    {{--<div class="form-group py-xl-10">--}}
                                        {{--<label for="MyBuilds">Builds</label>--}}
                                        {{--<select class="multiple-select form-control" required name="expectation[MyBuilds]">--}}
                                            {{--<option value="">Select</option>--}}
                                            {{--@foreach($myBuilds as $val)--}}
                                                {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="MaritalStatus">Marital Status</label>
                                        <select class="multiple-select form-control" required name="expectation[MaritalStatus]">
                                            <option value="">Select</option>
                                            @foreach($maritalStatuses as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="MyLivingArrangements">Living Arrangements</label>
                                        <select class="multiple-select form-control" required name="expectation[MyLivingArrangements]">
                                            <option value="">Select</option>
                                            @foreach($livingArrangements as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Heights">Heights</label>
                                        <select class="multiple-select form-control" required name="expectation[Heights]">
                                            <option value="">Select</option>
                                            @foreach($heights as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Disabilities">Disabilities</label>
                                        <select class="multiple-select form-control" required name="expectation[Disabilities]">
                                            <option value="">Select</option>
                                            @foreach($disabilities as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group py-xl-10">
                                        <label for="Castes">Caste</label>
                                        <select class="multiple-select form-control" required name="expectation[Castes]">
                                            <option value="">Select</option>
                                            @foreach($castes as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            {{-- Expectation Form --}}
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxl-blogger me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Profile Image Form</h5>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="blur_percent">Blur Percent</label>
                                        <select name="blur_percent" id="blur_percent" class="form-control">
                                            <option value="0" selected>Original</option>
                                            <option value="10">Soft</option>
                                            <option value="15">Medium</option>
                                            <option value="25">Heavy</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="profile_pic_client_status">Who can see profile picture?</label>
                                        <select name="profile_pic_client_status" id="profile_pic_client_status" class="form-control">
                                            <option value="1">Everyone</option>
                                            <option value="0">Only Me</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="image">Profile Image</label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/png, image/gif, image/jpeg, image/jpg">
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" id="submit" class="btn btn-primary px-5 float-end mx-1">Save</button>
                                    <a href="{{route('admin.get.customers')}}" type="button" class="btn btn-secondary px-5 float-end">Cancel</a>
                                </div>
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
    {{--<script src="{{asset('shaadi-admin/plugins/select2/js/select2.min.js')}}"></script>--}}
    <script>

        // $('.multiple-select').select2({
        //     theme: 'bootstrap4',
        //     width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        //     placeholder: $(this).data('placeholder'),
        //     allowClear: Boolean($(this).data('allow-clear')),
        // });

        $(function () {
            /*Customers Save */
            $('#addEditForm').on('submit', function (e) {
                $('button#submit').attr('disabled', true);
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
                        alertyFy(res.msg, res.status, 3000);
                        if (res.status == 'success') {
                            setTimeout(function () {
                                location.href = "{{route('admin.get.customers')}}";
                            },3000);
                        }
                        $('button#submit').attr('disabled', false);
                    },
                    error: function (request, status, error) {
                        if (request.status===422) {
                            $.each(request.responseJSON.errors, function (k, v) {
                                $(`:input[name="${k}"]`).addClass("has-error");
                                $(`:input[name="${k}"]`).after(`<span class="text-danger">${v[0]}</span>`);
                            });
                            $('html, body').animate({scrollTop:0}, '300');
                        } else {
                            alertyFy('There is something wrong*', 'warning', 2000);
                        }
                        // $(this).find('#submit').removeAttr('disabled');
                        $('button#submit').attr('disabled', false);
                    }
                });
            });
        });

        function checkAvailability(input) {
            let newVal = $(input).val();
            $('.divorceReasonDiv').hide();
            $('.childrenQuantityDiv').hide();
            if (newVal==12 || newVal==18 || newVal==19 || newVal==7) {
                $('.divorceReasonDiv').show('slow');
                $('.childrenQuantityDiv').show('slow');
            } else if (newVal==3 || newVal==4 || newVal==8 || newVal==16) {
                $('.divorceReasonDiv').show('slow');
            }
        }

        function checkIfExists(input) {
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            let fieldName = $(input).attr('data-name');
            let fieldValue = $(input).val();
            if (fieldValue && fieldName) {
                axios.post(`{{route('customer.check.exists')}}`,{
                    fieldName:fieldName,
                    fieldValue:fieldValue
                }).then(function (res) {
                    if (res.data.status == 'warning') {
                        $(`:input[name="${fieldName}"]`).addClass("has-error");
                        $(`:input[name="${fieldName}"]`).after(`<span class="text-danger">${res.data.msg}</span>`);
                    }
                }).catch(function (error) {
                    // alertyFy('There is something wrong','warning',3000);
                });
            }
        }

        function getStates(input,putInField,selectName='Select') {
            let selectValue = selectName=='Select' ? '' : '0';
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

        function getCities(input,putInField,selectName='Select') {
            let selectValue = selectName=='Select' ? '' : '0';
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

        function getSects(input,putInField) {
            let refrenceId = $(input).val();
            let fieldShortCode = $(`select[name="${putInField}"]`);
            if (refrenceId) {
                axios.get(`{{route('get.sects')}}/${refrenceId}`).then(function (res) {
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
