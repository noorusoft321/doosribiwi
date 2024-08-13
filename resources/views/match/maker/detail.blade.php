@extends('match.layouts.master')

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
        .call-his-height{
            height: 717px;
            overflow-y: auto;
        }
        .card-header {
            text-transform: uppercase;
        }
        .bg-red {
            box-shadow:inset 0px 1px 0px 0px #171717;
            background:linear-gradient(to bottom, #171717 5%, #000000 100%);
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
            background-color: #9B2C47;
            color: white;
            font-size: 14px;
            padding: 8px 16px;
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
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">General Info</h4>
                        </div>
                        <div class="card-body">
                            <div class="circle--image">
                                @if(file_exists(public_path('customer-images/original_images/'.$customer->image)))
                                    <a target="_blank" href="{{asset('customer-images/original_images/'.$customer->image)}}"><img src="{{asset('customer-images/original_images/'.$customer->image)}}" class="rounded-circle" alt="{{$customer->full_name}}"></a>
                                @elseif(file_exists(public_path('customer-images/'.$customer->image)))
                                    <a target="_blank" href="{{asset('customer-images/'.$customer->image)}}"><img src="{{asset('customer-images/'.$customer->image)}}" class="rounded-circle" alt="{{$customer->full_name}}"></a>
                                @else
                                    <a target="_blank" href="{{$customer->imageFullPath}}"><img src="{{$customer->imageFullPath}}" class="rounded-circle" alt="{{$customer->full_name}}"></a>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover general-info">
                                    <tbody>
                                    <tr>
                                        <td>Full Name</td>
                                        <td>{{$customer->full_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>User Name</td>
                                        <td>{{$customer->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Mobile # <a onclick="showDivContact(this)" href="javascript:void(0);"><i class="fa fa-eye"></i></a></td>
                                        <td>
                                            <strong style="display: none;">
                                                {{($customer->mobile_country_code > 0) ? "(+".$customer->mobile_country_code.") - " : ''}} {{$customer->mobile}}
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email <a onclick="showDivContact(this)" href="javascript:void(0);"><i class="fa fa-eye"></i></a></td>
                                        <td>
                                            <strong style="display: none;">{{$customer->email}}</strong>
                                        </td>
                                    </tr>
                                    @if(!empty($customer->customerOtherInfo))
                                        <tr>
                                            <td>Gender</td>
                                            <td>{{($customer->customerOtherInfo->gender==1) ? 'Male' : 'Female'}}</td>
                                        </tr>
                                        <tr>
                                            <td>Date of birth (Age)</td>
                                            <td>{{$customer->customerOtherInfo->DOB}} ({{$customer->customerOtherInfo->age}})</td>
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
                                        <tr>
                                            <td>Area</td>
                                            <td>
                                                {{($customer->customerOtherInfo->area_id > 0) ? genericQuery($customer->customerOtherInfo->area_id,'Area') : 'N/A'}}
                                            </td>
                                        </tr>
                                        @if(!empty($customer->customerOtherInfo->persona_note))
                                            <tr>
                                                <td>
                                                    <h5 class="edit-profile-side-heading font-size14"> Personal Note </h5>
                                                </td>
                                                <td>
                                                    {{$customer->customerOtherInfo->persona_note}}
                                                </td>
                                            </tr>
                                        @endif
                                        @if(!empty($customer->customerOtherInfo->private_note))
                                            <tr class="bg-dark">
                                                <td>
                                                    <h5 class="edit-profile-side-heading font-size14 text-white"> Private Note <sub>For Internal Staff Only</sub> </h5>
                                                </td>
                                                <td class=" text-white">
                                                    {{$customer->customerOtherInfo->private_note}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                    <tr>
                                        <td>Profile Verification</td>
                                        <td>
                                            @if($customer->email_verified==1 &&
                                                $customer->mobile_verified==1 &&
                                                $customer->profile_pic_status==1 &&
                                                $customer->meeting_verification==1 &&
                                                $customer->age_verification==1 &&
                                                $customer->education_verification==1 &&
                                                $customer->location_verification==1 &&
                                                $customer->nationality_verification==1)
                                                <span style="color: green;">Verified</span>
                                            @elseif($customer->email_verified==1 &&
                                                    $customer->mobile_verified==1 &&
                                                    $customer->profile_pic_status==1 &&
                                                    $customer->meeting_verification==1)
                                                <span style="color: orange;">Semi Verified</span>
                                            @else
                                                <span style="color: darkgrey;">Not Verified</span>
                                            @endif
                                        </td>
                                    </tr>
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
                                    <tr>
                                        <td>
                                            <h5 class="edit-profile-side-heading font-size14"> Created At </h5>
                                        </td>
                                        <td>
                                            {{date('d M Y h:i A', strtotime($customer->created_at))}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Match Making History</h4>
                        </div>
                        <div class="card-body call-his-height" id="callHisHeight">
                            @foreach($callHistory as $val)
                                <div class="chat-message-right mb-4">
                                    <div class="flex-shrink-1 bg-light rounded border  border-1 border-primary py-2 px-3 mr-3">
                                        <div class="mb-1 font-18">{{$val->user_name}} <span class="float-end">{{date('d M Y h:i A',strtotime($val->created_at))}}</span></div>
                                        {{$val->comment}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="message" id="message" placeholder="Type your comment here...">
                                <span id="send_message" class="input-group-text bg-primary" role="button">
                                    <i class="bx bx-send text-white" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
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
                                            {{($customer->customerOtherInfo->gender==1) ? 'Male' : 'Female'}}
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
                                        <h5 class="edit-profile-side-heading font-size14"> City </h5>
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
                                @if($customer->customerOtherInfo->divorceReason)
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14"> Reason </h5>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="edit-profile-side-heading font-size14">
                                                {{$customer->customerOtherInfo->divorceReason}}
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Mother Tongue </h5>
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
                                            {{genericQuery($customer->customerOtherInfo->CountryOfOrigin,'Country','name')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14" data-state-id="862"> State of Origin </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerOtherInfo->StateOfOrigin,'State')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> City of Origin </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerOtherInfo->CityOfOrigin,'City')}}
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
                                        <h5 class="edit-profile-side-heading font-size14"> Living Arrangement </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{genericQuery($customer->customerPersonalInfo->MyLivingArrangements,'MyLivingArrangement')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14"> Smoke </h5>
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
                                        <h5 class="edit-profile-side-heading font-size14"> Registration Reason </h5>
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
                                        <h5 class="edit-profile-side-heading font-size14"> Is Armed Forces </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{($customer->armed_forces==1) ? 'Yes' : 'No'}}
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
                            <h5 class="card-header">Expectations</h5>
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

                @if(!empty($customer->customerResidentialInfo))
                    <div class="col-md-6">
                        <div class="card">
                            <h5 class="card-header">Residence Information</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Residence Status
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(!empty($customer->customerResidentialInfo->ResidenceStatus)) ? genericQuery($customer->customerResidentialInfo->ResidenceStatus,'ResidenceStatus') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            House Size
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{$customer->customerResidentialInfo->HouseSize}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Residence Area
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(!empty($customer->customerResidentialInfo->ResidenceArea)) ? genericQuery($customer->customerResidentialInfo->ResidenceArea,'ResidenceArea') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Family Status
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(!empty($customer->customerResidentialInfo->FamilyValues)) ? genericQuery($customer->customerResidentialInfo->FamilyValues,'FamilyValue') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Complete Address
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{$customer->customerResidentialInfo->CompleteAddress}}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(!empty($customer->customerFamilyInfo))
                    <div class="col-md-6">
                        <div class="card">
                            <h5 class="card-header">Family Information</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Father Name
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{$customer->customerFamilyInfo->fatherName}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Father Profession
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(!empty($customer->customerFamilyInfo->fatherProfession)) ? genericQuery($customer->customerFamilyInfo->fatherProfession,'Occupation') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Mother Name
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{$customer->customerFamilyInfo->motherName}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Mother Profession
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{(!empty($customer->customerFamilyInfo->motherProfession)) ? genericQuery($customer->customerFamilyInfo->motherProfession,'Occupation') : 'N/A'}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Total No. of Sister
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{$customer->customerFamilyInfo->totalNoOfSisters}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Total No. of Brother
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{$customer->customerFamilyInfo->totalNoOfBrothers}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Married Sisters
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{$customer->customerFamilyInfo->marriedSisters}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            Married Brothers
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="edit-profile-side-heading font-size14">
                                            {{$customer->customerFamilyInfo->marriedBrothers}}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Gallery Photos</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse($photos as $key => $val)
                                    <div class="col">
                                        <div class="img-container">
                                            <img src="{{asset('customer-images/'.$val->image)}}" alt="Photo {{$key}}" class="image" style="width:100%;height: 100%">
                                            <div class="middle">
                                                <a onclick="deletePhoto(this)" href="javascript:void(0);" data-image-id="{{$val->faker_id}}" type="button" class="text">
                                                    <i class="fa fa-trash fa-md text-white"></i>
                                                </a>
                                                <a href="{{asset('customer-images/'.$val->image)}}" target="_blank" class="text">
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
    </div>
@endsection

@push('script')
    <script>
        let customerId = '{{$customer->id}}';
        {{--let hasPermitCopy = '{{in_array(auth()->guard('match')->user()->role_id,[1,7])}}';--}}

        let imageFile = '';
        $(function (){
            $('#message').on('keyup', function (e) {
                if (e.key === 'Enter') {
                    if (e.target.value.trim()) {
                        saveComment(e.target.value.trim());
                    }
                }
                return false;
            });
            $('#send_message').on('click', function (e) {
                if ($('#message').val().trim()) {
                    saveComment($('#message').val().trim());
                }
                return false;
            });

            var objDiv = document.getElementById("callHisHeight");
            objDiv.scrollTop = objDiv.scrollHeight;

            $('input[name="image"]').change(function() {
                imageFile = this;
                readURL(this);
            });

            // if (!hasPermitCopy) {
            //     /* right click popup block */
            //     $(document).on("contextmenu", function(e) {
            //         e.preventDefault();
            //     });
            //
            //     /* select text block */
            //     $(document).on("selectstart", function(e) {
            //         e.preventDefault();
            //     });
            // }

        });

        function saveComment(comment) {
            axios.post('{{route('match.save.call.history')}}', {
                comment:comment,
                customer_id: customerId
            }).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    let newMes = `
                        <div class="chat-message-right mb-4">
                            <div class="flex-shrink-1 bg-light rounded border  border-1 border-primary py-2 px-3 mr-3">
                                <div class="mb-1 font-18">${res.data.data.user_name} <span class="float-end">${res.data.data.date_with_format}</span></div>
                                ${res.data.data.comment}
                            </div>
                        </div>`;
                    $('#callHisHeight').append(newMes);
                    $('#message').val('');
                    setTimeout(function(){
                        var objDiv = document.getElementById("callHisHeight");
                        objDiv.scrollTop = objDiv.scrollHeight;
                    }, 500);
                }
            }).catch(function (error) {
                alertyFy('There is something wrong*','warning',3000);
            });
        }

        
        function showDivContact(input) {
            $(input).parent().parent().find('strong').toggle();
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

    </script>
@endpush
