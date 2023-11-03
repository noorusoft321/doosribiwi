@extends('admin.layouts.master')

@section('title', $title)

@push('style')
    <style>
        table.general-info tr td{
            padding-top: 20px;
            height: 60px;
        }
        table.general-info tr td:first-child {
            width: 30% !important;
        }
        .form-switch .form-check-input {
            width: 4em!important;
            height: 2em!important;
            cursor: pointer;
        }
        .circle--image {
            text-align: center !important;
        }
        .circle--image img {
            width: 200px;
            height: 200px;
        }
        .edit-profile-side-heading {
            font-size: 15px;
            font-weight: normal;
        }
        .card-header {
            text-transform: uppercase;
        }
        .bg-red {
            box-shadow:inset 0px 1px 0px 0px #171717;
            background:linear-gradient(to bottom, #171717 5%, #082f49 100%);
            background-color:#171717;
            border-radius:11px;
            border:none;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-size:14px;
            padding:4px 9px;
            text-decoration:none;
            text-shadow:0px 1px 0px #cc9f52;
        }
        .img-container {
            position: relative;
            width: 100%;
            margin-bottom: 10px;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .img-container:hover .image {
            opacity: 0.3;
        }

        .img-container:hover .middle {
            opacity: 1;
        }

        .text {
            background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);
            color: white;
            font-size: 14px;
            padding: 8px 16px;
        }
    </style>
@endpush

@section('content')

    @php
        $hasPermissions = session()->get('permission');
        if (auth()->guard('admin')->user()->role_id==1) {
            $hasPermissions = 'all';
        }
    @endphp
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
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">General Info</h4>
                        </div>
                        <div class="card-body">
                            <div class="circle--image">
                                @if(file_exists(public_path('customer_images/original_images/'.$customer->image)))
                                    <a href="{{asset('customer_images/original_images/'.$customer->image)}}" target="_blank"><img src="{{asset('customer_images/original_images/'.$customer->image)}}" class="rounded-circle" alt="{{$customer->full_name}}"></a>
                                    <a href="{{asset('customer_images/'.$customer->image)}}" target="_blank"><img src="{{asset('customer_images/'.$customer->image)}}" class="rounded-circle" alt="{{$customer->full_name}}"></a>
                                @elseif(file_exists(public_path('customer_images/'.$customer->image)))
                                    <a href="{{asset('customer_images/'.$customer->image)}}" target="_blank"><img src="{{asset('customer_images/'.$customer->image)}}" class="rounded-circle" alt="{{$customer->full_name}}"></a>
                                @else
                                    <a href="{{$customer->imageFullPath}}" target="_blank"><img src="{{$customer->imageFullPath}}" class="rounded-circle" alt="{{$customer->full_name}}"></a>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover general-info">
                                    <tbody>
                                    <tr>
                                        <td>First Name</td>
                                        <td>{{$customer->first_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Last Name</td>
                                        <td>{{$customer->last_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>User Name</td>
                                        <td>{{$customer->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{$customer->email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{$customer->mobile}}</td>
                                    </tr>
                                    @if(!empty($customer->customerOtherInfo))
                                        <tr>
                                            <td>Gender</td>
                                            <td>
                                                {{$customer->gender_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Date of birth</td>
                                            <td>{{$customer->customerOtherInfo->DOB}}</td>
                                        </tr>
                                        <tr>
                                            <td>Age</td>
                                            <td>{{$customer->customerOtherInfo->age}}</td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td>
                                                {{genericQuery($customer->customerOtherInfo->country_id,'Country','name')}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>State</td>
                                            <td>
                                                {{genericQuery($customer->customerOtherInfo->state_id,'State')}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td>
                                                {{genericQuery($customer->customerOtherInfo->city_id,'City')}}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>
                                            <h5 class="edit-profile-side-heading font-size14"> Profile Link
                                                <span class="btn btn-sm btn-outline-primary" onclick="copyToClipBoard(this)">Copy</span>
                                            </h5>
                                        </td>
                                        <td>
                                            @php $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'NA').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'NA').'-'.$customer->faker_id; @endphp
                                            <input type="text" name="user__name"  value="{{route('search.by.slug',[$uniqueProfileSlug])}}" class="form-control">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            @if($hasPermissions=='all' || in_array('admin.personal.note.save', $hasPermissions))
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Personal Note</h4>
                                    </div>
                                    <div class="card-body">
                                        <form id="personalNoteForm">
                                            <textarea name="persona_note" id="persona_note" class="form-control" rows="7">{{!empty($customer->customerOtherInfo) ? $customer->customerOtherInfo->persona_note : ''}}</textarea>
                                            <br>
                                            <div class="row">
                                                <div class="col-6 my-auto">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" name="personal_note_approve" id="personal_note_approve"
                                                                {{!empty($customer->customerOtherInfo) && $customer->customerOtherInfo->personal_note_approve > 0 ? 'checked' : ''}} >
                                                        <label class="form-check-label" for="personal_note_approve">
                                                            Personal Note Approved
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 my-auto">
                                                    <button type="button" onclick="savePersonalNote(this)" class="float-end btn btn-outline-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif

                            @if($hasPermissions=='all' || in_array('admin.customer.package.save', $hasPermissions))
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Customer Package</h4>
                                    </div>
                                    <div class="card-body">
                                        <form id="customerPackageForm">
                                            <div class="form-group">
                                                <label for="package_id">Select Package</label>
                                                <select name="package_id" id="package_id" class="form-control">
                                                    <option value=""> -- Select Package -- </option>
                                                    @foreach($packages as $val)
                                                        <option value="{{$val->id}}" {{($customer->package_id==$val->id) ? 'selected' : ''}}>{{$val->package_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>
                                            <button type="button" onclick="saveCustomerPackage(this)" class="float-end btn btn-outline-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                @if($hasPermissions=='all' || in_array('admin.save.customer.badges', $hasPermissions))
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Profile / Badges / Verifications</h4>
                            </div>
                            <div class="card-body">
                                <form id="customerBadgesForm">
                                    @csrf
                                    <div class="table-responsive">
                                        <table class="table table-hover general-info">
                                            <tbody>
                                            @if(auth()->guard('admin')->user()->role_id==1)
                                                <tr>
                                                    <td>Change Blur Fuctionality</td>
                                                    <td><button onclick="blurChange(this)" class="btn btn-outline-primary">Blur Again</button></td>
                                                </tr>
                                                {{--<tr>--}}
                                                    {{--<td>Profile Status</td>--}}
                                                    {{--<td>--}}
                                                        {{--<div class="form-check form-switch" title="Profile Status">--}}
                                                            {{--<input class="form-check-input" type="checkbox" name="profile_status" id="profile_status" {{($customer->profile_status==1) ? 'checked' : ''}} >--}}
                                                        {{--</div>--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}
                                                <tr>
                                                    <td>Message Limit</td>
                                                    <td>
                                                        <input type="text" class="form-control" name="messagelimits" value="{{(!empty($customer->customerNotificationPreference)) ? $customer->customerNotificationPreference->messagelimits : 0}}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Age Verification</td>
                                                    <td>
                                                        <div class="form-check form-switch" title="Age Verification">
                                                            <input class="form-check-input" type="checkbox" name="age_verification" id="age_verification" {{($customer->age_verification==1) ? 'checked' : ''}} >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Education  Verification</td>
                                                    <td>
                                                        <div class="form-check form-switch" title="Education  Verification">
                                                            <input class="form-check-input" type="checkbox" name="education_verification" id="education_verification" {{($customer->education_verification==1) ? 'checked' : ''}} >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Location  Verification</td>
                                                    <td>
                                                        <div class="form-check form-switch" title="Location  Verification">
                                                            <input class="form-check-input" type="checkbox" name="location_verification" id="location_verification" {{($customer->location_verification==1) ? 'checked' : ''}} >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Meeting  Verification</td>
                                                    <td>
                                                        <div class="form-check form-switch" title="Meeting  Verification">
                                                            <input class="form-check-input" type="checkbox" name="meeting_verification" id="meeting_verification" {{($customer->meeting_verification==1) ? 'checked' : ''}} >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nationality  Verification</td>
                                                    <td>
                                                        <div class="form-check form-switch" title="Nationality  Verification">
                                                            <input class="form-check-input" type="checkbox" name="nationality_verification" id="nationality_verification" {{($customer->nationality_verification==1) ? 'checked' : ''}} >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Salary  Verification</td>
                                                    <td>
                                                        <div class="form-check form-switch" title="Salary  Verification">
                                                            <input class="form-check-input" type="checkbox" name="salary_verification" id="salary_verification" {{($customer->salary_verification==1) ? 'checked' : ''}} >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Lead Status</td>
                                                    <td>
                                                        <select name="lead_status" class="form-control">
                                                            <option value="New" {{($customer->lead_status=="New") ? 'selected' : ''}}>New</option>
                                                            <option value="Contacting" {{($customer->lead_status=="Contacting") ? 'selected' : ''}}>Contacting</option>
                                                            <option value="Connected" {{($customer->lead_status=="Connected") ? 'selected' : ''}}>Connected</option>
                                                            <option value="In Progress" {{($customer->lead_status=="In Progress") ? 'selected' : ''}}>In Progress</option>
                                                            <option value="Unqualified" {{($customer->lead_status=="Unqualified") ? 'selected' : ''}}>Unqualified</option>
                                                            <option value="Bad Timing" {{($customer->lead_status=="Bad Timing") ? 'selected' : ''}}>Bad Timing</option>
                                                            <option value="Converted" {{($customer->lead_status=="Converted") ? 'selected' : ''}}>Converted</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td>Second Marraige</td>
                                                <td>
                                                    <select name="second_marraige" id="second_marraige" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="1" {{($customer->second_marraige==1) ? 'selected' : ''}}>Male looking for 2nd Wife</option>
                                                        <option value="2" {{($customer->second_marraige==2) ? 'selected' : ''}}>Female Ready for 2nd Wife</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Profile Pic Status</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                        <input type="radio" class="btn-check" name="profile_pic_status" id="profile_pic_status1" autocomplete="off"
                                                         value="0" {{($customer->profile_pic_status==0) ? 'checked' : ''}} >
                                                        <label class="btn btn-outline-primary" for="profile_pic_status1">Pending</label>

                                                        <input type="radio" class="btn-check" name="profile_pic_status" id="profile_pic_status2" autocomplete="off"
                                                         value="1" {{($customer->profile_pic_status==1) ? 'checked' : ''}} >
                                                        <label class="btn btn-outline-primary" for="profile_pic_status2">Approved</label>

                                                        <input type="radio" class="btn-check" name="profile_pic_status" id="profile_pic_status3" autocomplete="off"
                                                         value="2" {{($customer->profile_pic_status==2) ? 'checked' : ''}} >
                                                        <label class="btn btn-outline-primary" for="profile_pic_status3">Rejected</label>
                                                    </div>
                                                    {{--<select name="profile_pic_status" id="profile_pic_status" class="form-control">--}}
                                                        {{--<option value="">Select</option>--}}
                                                        {{--<option value="0" {{($customer->profile_pic_status==0) ? 'selected' : ''}}>Pending</option>--}}
                                                        {{--<option value="1" {{($customer->profile_pic_status==1) ? 'selected' : ''}}>Approved</option>--}}
                                                        {{--<option value="2" {{($customer->profile_pic_status==2) ? 'selected' : ''}}>Rejected</option>--}}
                                                    {{--</select>--}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Profile Gallery Status</td>
                                                <td>
                                                    <div class="form-check form-switch" title="Profile Gallery Status">
                                                        <input class="form-check-input" type="checkbox" name="profile_gallery_status" id="profile_gallery_status" {{($customer->profile_gallery_status==1) ? 'checked' : ''}} >
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Profile Home Page Status</td>
                                                <td>
                                                    <div class="form-check form-switch" title="Profile Home Page Status">
                                                        <input class="form-check-input" type="checkbox" name="profile_home_page_status" id="profile_home_page_status" {{($customer->profile_home_page_status==1) ? 'checked' : ''}} >
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Email Verification</td>
                                                <td>
                                                    <div class="form-check form-switch" title="Email Verification">
                                                        <input class="form-check-input" type="checkbox" name="email_verified" id="email_verified" {{($customer->email_verified==1) ? 'checked' : ''}} >
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mobile / Phone Verification</td>
                                                <td>
                                                    <div class="form-check form-switch" title="Mobile / Phone Verification">
                                                        <input class="form-check-input" type="checkbox" name="mobile_verified" id="mobile_verified" {{($customer->mobile_verified==1) ? 'checked' : ''}} >
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Lead Source</td>
                                                <td>
                                                    <select name="source" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Website" {{($customer->source=="Website") ? 'selected' : ''}}>Website</option>
                                                        <option value="Facebook" {{($customer->source=="Facebook") ? 'selected' : ''}}>Facebook</option>
                                                        <option value="Instagram" {{($customer->source=="Instagram") ? 'selected' : ''}}>Instagram</option>
                                                        <option value="LinkedIn" {{($customer->source=="LinkedIn") ? 'selected' : ''}}>LinkedIn</option>
                                                        <option value="WalkIn" {{($customer->source=="WalkIn") ? 'selected' : ''}}>WalkIn</option>
                                                        <option value="WhatsApp" {{($customer->source=="WhatsApp") ? 'selected' : ''}}>WhatsApp</option>
                                                        <option value="Newspaper" {{($customer->source=="Newspaper") ? 'selected' : ''}}>Newspaper</option>
                                                        <option value="Event" {{($customer->source=="Event") ? 'selected' : ''}}>Event</option>
                                                        <option value="Application" {{($customer->source=="Application") ? 'selected' : ''}}>Application</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Client Status</td>
                                                <td>
                                                    <select name="client_status" class="form-control">
                                                        <option value="Free" {{($customer->client_status=="Free") ? 'selected' : ''}}>Free</option>
                                                        <option value="Paid" {{($customer->client_status=="Paid") ? 'selected' : ''}}>Paid</option>
                                                        <option value="Elite" {{($customer->client_status=="Elite") ? 'selected' : ''}}>Elite</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Who can see Profile</td>
                                                <td>
                                                    <select name="profile_pic_client_status" class="form-control">
                                                        <option value="1" {{($customer->profile_pic_client_status==1) ? 'selected' : ''}}>Everyone</option>
                                                        <option value="0" {{($customer->profile_pic_client_status==0) ? 'selected' : ''}}>Only Me</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Who can see Gallery</td>
                                                <td>
                                                    <select name="profile_gallery_client_status" class="form-control">
                                                        <option value="1" {{($customer->profile_gallery_client_status==1) ? 'selected' : ''}}>Everyone</option>
                                                        <option value="0" {{($customer->profile_gallery_client_status==0) ? 'selected' : ''}}>Only Me</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Profile Status</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                        <input type="radio" class="btn-check" name="profile_status" id="profile_status1" autocomplete="off"
                                                               value="0" {{($customer->profile_status==0) ? 'checked' : ''}} >
                                                        <label class="btn btn-outline-primary" for="profile_status1">Inactive</label>

                                                        <input type="radio" class="btn-check" name="profile_status" id="profile_status2" autocomplete="off"
                                                               value="1" {{($customer->profile_status==1) ? 'checked' : ''}} >
                                                        <label class="btn btn-outline-primary" for="profile_status2">Active</label>

                                                        <input type="radio" class="btn-check" name="profile_status" id="profile_status3" autocomplete="off"
                                                               value="2" {{($customer->profile_status==2) ? 'checked' : ''}} >
                                                        <label class="btn btn-outline-primary" for="profile_status3">Blocked</label>
                                                    </div>
                                                    {{--<select name="profile_status" class="form-control">--}}
                                                        {{--<option value="0" {{($customer->profile_status==0) ? 'selected' : ''}}>Pending</option>--}}
                                                        {{--<option value="1" {{($customer->profile_status==1) ? 'selected' : ''}}>Approved</option>--}}
                                                        {{--<option value="2" {{($customer->profile_status==2) ? 'selected' : ''}}>Blocked</option>--}}
                                                    {{--</select>--}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Personalized Matchmaker</td>
                                                <td>
                                                    <select name="agent_mobile" class="form-control">
                                                        <option value="" {{($customer->agent_mobile=='') ? 'selected' : ''}}>Not Personalized</option>
                                                        @foreach(config('services.matchmakers') as $name => $matchmaker)
                                                            <option value="{{$matchmaker}}" {{($customer->agent_mobile==$matchmaker) ? 'selected' : ''}}>{{$name.' ('.$matchmaker.')'}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" id="submit" class="btn btn-outline-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <hr/>

            <div class="row">

                <div class="col-md-6">

                    {{--Personal Information--}}
                    <div class="card">
                        <h5 class="card-header">Personal Information</h5>
                        <div class="card-body">
                            @if(!empty($customer->customerOtherInfo))
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Gender </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{$customer->gender_name}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Age </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{$customer->customerOtherInfo->age}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Country </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerOtherInfo->country_id,'Country','name')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14" data-state-id="862"> State </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerOtherInfo->state_id,'State')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14" data-city-id="45627"> City </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerOtherInfo->city_id,'City')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Marital Status </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerOtherInfo->MaritalStatusID,'MaritalStatus')}}
                                        </h5>
                                    </div>
                                </div>
                                @if($customer->customerOtherInfo->childrenQuantity > 0)
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14"> Children </h5>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14">
                                                {{$customer->customerOtherInfo->childrenQuantity}}
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14" data-city-id="45627"> Mother Tongue </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerOtherInfo->MyFirstLanguageMotherTonguesID,'MotherTongue')}}
                                        </h5>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($customer->customerPersonalInfo))
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Caste </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->Caste,'Caste')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Country of Origin </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->CountryOfOrigin,'Country','name')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14" data-state-id="862"> State of Origin </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->StateOfOrigin,'State')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14" data-city-id="45627"> City of Origin </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->CityOfOrigin,'City')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Willing To Relocate </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->WillingToRelocate,'WillingToRelocate')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> I Am Looking To Marry </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->IAmLookingToMarry,'IAmLookingToMarry')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14" data-city-id="45627"> Living Arrangement </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->MyLivingArrangements,'MyLivingArrangement')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14" data-city-id="45627"> Smoke </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->Smokes,'Smoke')}}
                                        </h5>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($customer->customerOtherInfo))
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14" data-city-id="45627"> Registration Reason </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerOtherInfo->RegistrationsReasonsID,'RegistrationsReason')}}
                                        </h5>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{--Career Information--}}
                    @if(!empty($customer->customerCareerInfo))
                        <div class="card">
                            <h5 class="card-header">Career Information</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Qualification </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerCareerInfo->Qualification,'Education')}}
                                            ({{genericQuery($customer->customerCareerInfo->major_course_id,'MajorCourse')}})
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> University </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerCareerInfo->University,'University')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Occupation </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerCareerInfo->Profession,'Occupation')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Job Post </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerCareerInfo->JobPost,'JobPost')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Monthly Income </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerCareerInfo->MonthlyIncome,'AnnualInCome')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Future Plan </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerCareerInfo->FuturePlans,'FuturePlan')}}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @if(!empty($customer->customerOtherInfo))
                            <div class="card">
                                <h5 class="card-header">Career Information</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14"> Qualification </h5>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14">
                                                {{genericQuery($customer->customerOtherInfo->EducationID,'Education')}}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14"> University </h5>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14">
                                                N/A
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14"> Occupation </h5>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14">
                                                {{genericQuery($customer->customerOtherInfo->OccupationID,'Occupation')}}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14"> Job Post </h5>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14">
                                                N/A
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14"> Monthly Income </h5>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14">
                                                N/A
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14"> Future Plan </h5>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14">
                                                N/A
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    {{--Appearance--}}
                    @if(!empty($customer->customerPersonalInfo))
                        <div class="card">
                            <h5 class="card-header">Appearance</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Height </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->Heights,'Height')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Weight (KG) </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->Weights,'Weight')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Complexion </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->Complexions,'Complexion')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> My Build </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->MyBuilds,'MyBuild')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Hair Color </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->HairColors,'HairColor')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Eye Color </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->EyeColors,'EyeColor')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Disability </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->Disabilities,'Disability')}}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>

                <div class="col-md-6">

                    {{--Religion--}}
                    @if(!empty($customer->customerReligionInfo))
                        <div class="card">
                            <h5 class="card-header">Religion</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Religion </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerReligionInfo->Religions,'Religion')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Sect </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerReligionInfo->Sects,'Sect')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Do You Prefer Hijaab </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerReligionInfo->DoYouPreferHijabs,'DoYouPreferHijab')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Do You Prefer Beard </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerReligionInfo->DoYouHaveBeards,'DoYouHaveBeard')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Are You Revert </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerReligionInfo->AreYouReverts,'AreYouRevert')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Do You Keep Halal </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerReligionInfo->DoYouKeepHalal,'DoYouKeepHalal')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Do You Perform Salaah </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerReligionInfo->DoYouPerformSalaah,'DoYouPerformSalaah')}}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($customer->customerOtherInfo))
                        <div class="card">
                            <h5 class="card-header">Hobbies & Interest</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {!! ($customer->customerOtherInfo->hobbiesAndInterest) ? getHobbiesAndInterest($customer->customerOtherInfo->hobbiesAndInterest) : 'N/A' !!}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{--Expectation--}}
                    @php $customerSearch = (!empty($customer->customerSearch)) ? json_decode($customer->customerSearch->title) : [] @endphp
                    @if(!empty($customerSearch))
                        <div class="card">
                            <h5 class="card-header">Life Partner Expectations</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Gender
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->gender) && $customerSearch->gender==1) ? 'Male' :'Female'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Age From
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->ageFrom)) ? $customerSearch->ageFrom : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Age To
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->ageTo)) ? $customerSearch->ageTo : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Country
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->country_id)) ? genericQuery($customerSearch->country_id,'Country','name') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            State
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->state_id)) ? genericQuery($customerSearch->state_id,'State') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            City
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->city_id)) ? genericQuery($customerSearch->city_id,'City') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Tongue
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->Tongue)) ? genericQuery($customerSearch->Tongue,'MotherTongue') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Religiousness
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->Religions)) ? genericQuery($customerSearch->Religions,'Religion') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Sect
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->Sects)) ? genericQuery($customerSearch->Sects,'Sect') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Qualification
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->EducationID)) ? genericQuery($customerSearch->EducationID,'Education') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Profession
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->OccupationID)) ? genericQuery($customerSearch->OccupationID,'Occupation') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Willing To Relocate
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->WillingToRelocate)) ? genericQuery($customerSearch->WillingToRelocate,'WillingToRelocate') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Income
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->MyIncome)) ? genericQuery($customerSearch->MyIncome,'AnnualInCome') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Marital Status
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->MaritalStatus)) ? genericQuery($customerSearch->MaritalStatus,'MaritalStatus') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Living Arrangements
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->MyLivingArrangements)) ? genericQuery($customerSearch->MyLivingArrangements,'MyLivingArrangement') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Heights
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->Heights)) ? genericQuery($customerSearch->Heights,'Height') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Builds
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->MyBuilds)) ? genericQuery($customerSearch->MyBuilds,'MyBuild') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Disabilities
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->Disabilities)) ? genericQuery($customerSearch->Disabilities,'Disability') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Caste
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(isset($customerSearch->Castes)) ? genericQuery($customerSearch->Castes,'Caste') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

            <br>

            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Gallery Photos</h4>
                        {{--<div class="row">--}}
                            {{--<div class="col-md-6">--}}
                                {{--<h4 class="card-title mb-0">Gallery Photos</h4>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<select onchange="changeStatus(this)" name="profile_gallery_client_status" id="profile_gallery_client_status" class="form-control">--}}
                                    {{--<option value="1" {{($customer->profile_gallery_client_status==1) ? 'selected' : ''}}>Everyone</option>--}}
                                    {{--<option value="0" {{($customer->profile_gallery_client_status==0) ? 'selected' : ''}}>Only Me</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label for="public_gallery">Who can see gallery photos</label>
                                <input type="file" name="public_gallery[]" id="public_gallery" title="Click to add photos" class="form-control rounded-pill" multiple>
                            </div>
                            <div class="col-auto pt-3">
                                <button onclick="savePhotos(this)" class="btn btn-outline-primary float-end">Save Gallery</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            @forelse($photos as $key => $val)
                                <div class="col">
                                    <div class="img-container">
                                        <img src="{{asset('customer_images/'.$val->image)}}" alt="Photo {{$key}}" class="image" style="width:100%;height: 100%">
                                        <div class="middle">
                                            <a onclick="deletePhoto(this)" href="javascript:void(0);" data-image-id="{{$val->faker_id}}" type="button" class="text">
                                                <i class="fa fa-trash fa-md text-white"></i>
                                            </a>
                                            <a href="{{asset('customer_images/'.$val->image)}}" target="_blank" class="text">
                                                <i class="fa fa-eye fa-md text-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-danger text-center">
                                    Info! No gallery photos found
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('script')
    <script>
        let newCustomerId = '{{$customer->id}}';
        $(function () {
            $('#customerBadgesForm').on('submit', function (e) {
                $('button[id="submit"]').attr('disabled', true);
                $(':input').removeClass('has-error');
                $('.text-danger').remove();
                e.preventDefault();
                $.ajax({
                    url: '{{route('admin.save.customer.badges', [$customer->faker_id])}}',
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
                        $('button[id="submit"]').attr('disabled', false);
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
                        }
                        $('button[id="submit"]').attr('disabled', false);
                    }
                });
            });
        });

        function savePersonalNote(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('admin.personal.note.save')}}", `${$('#personalNoteForm').serialize()}&RegistrationID=${newCustomerId}`).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#personalNoteForm :input[name="' + k + '"]').addClass("has-error");
                        $('#personalNoteForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
                $(input).attr('disabled',false);
            });
        }
        
        function saveCustomerPackage(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('admin.customer.package.save')}}", `${$('#customerPackageForm').serialize()}&customer_id=${newCustomerId}`).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#customerPackageForm :input[name="' + k + '"]').addClass("has-error");
                        $('#customerPackageForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
                $(input).attr('disabled',false);
            });
        }

        function savePhotos(input){
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            let newImage = '';
            if ($('input[id="public_gallery"]').val()) {
                newImage = document.getElementById('public_gallery').files;
            }
            let formData = new FormData();
            if (newImage && newImage.length > 0) {
                $.each(newImage, function (k, v) {
                    formData.append('public_gallery[]', v);
                    formData.append('customer_id', newCustomerId);
                });
            } else {
                formData.append('public_gallery[]', newImage);
                formData.append('customer_id', newCustomerId);
            }

            axios.post("{{route('admin.gallery.photos.save')}}", formData).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    setTimeout(function () {
                        location.reload();
                    },2500);
                    return false;
                }
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $(':input[id="public_gallery"]').addClass("has-error");
                    $.each(error.response.data.errors, function (k, v) {
                        $(':input[id="public_gallery"]').after("<span class='text-danger d-block'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

        function copyToClipBoard(input) {
            $(input).attr('disabled',false);
            var temp = $("<input>");
            $("body").append(temp);
            temp.val($('input[name="user__name"]').val()).select();
            document.execCommand("copy");
            temp.remove();
            alertyFy('Copied successfully','success',1500);
        }

        function deletePhoto(input) {
            if(confirm('Are you sure, you want to delete this?')){
                $(input).attr('disabled',true);
                axios.post("{{route('admin.gallery.delete.photo')}}", {photo_id:$(input).attr('data-image-id')}).then(function (res) {
                    alertyFy(res.data.msg,res.data.status,3000);
                    if (res.data.status=='success') {
                        let imageParentDiv = $(input).parent().parent().parent();
                        imageParentDiv.hide('slow');
                        setTimeout(function () {
                            imageParentDiv.remove();
                        },2500);
                    }
                    $(input).attr('disabled',false);
                }).catch(function (error) {
                    alertyFy('There is something wrong','warning',3000);
                    $(input).attr('disabled',false);
                });
            }
        }

        function blurChange(input) {
            if(confirm('Are you sure, you want to change this blur?')){
                $(input).attr('disabled',true);
                $(':input').removeClass('has-error');
                $('.text-danger').remove();
                axios.post("{{route('admin.change.profile.blur')}}", {
                    customerId: newCustomerId
                }).then(function (res) {
                    alertyFy(res.data.msg,res.data.status,2000);
                    if (res.data.status=='success') {
                        setTimeout(function () {
                            location.reload(true);
                        },2000)
                    }
                    $(input).attr('disabled',false);
                }).catch(function (error) {
                    console.log('error',error);
                    alertyFy('There is something wrong','warning',3000);
                    $(input).attr('disabled',false);
                });
            }
        }
        
    </script>
@endpush
