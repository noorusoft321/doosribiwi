@extends('bdo.layouts.master')

@section('title', $title)

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" />
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
            border: 3px solid #D55B60;
            margin-right: 5px;
        }
        .edit-profile-side-heading {
            font-size: 15px;
            font-weight: normal;
        }
        .call-his-height{
            height: 520px;
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
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">General Info</h4>
                        </div>
                        <div class="card-body">
                            <div class="circle--image gallery">
{{--                                @dd(file_exists(public_path('customer-images/original_images/'.$customer->image)),public_path('customer-images/original_images/'.$customer->image))--}}
                                @if(file_exists(public_path('customer-images/original_images/'.$customer->image)))
{{--                                    @dd(1,$customer->image)--}}
                                    <a href="{{asset('customer-images/original_images/'.$customer->image)}}" data-lightbox="mygallery" data-title="Original Image">
                                        <img src="{{asset('customer-images/original_images/'.$customer->image)}}" alt="Original Image">
                                    </a>
                                    <a href="{{asset('customer-images/'.$customer->image)}}" data-lightbox="mygallery" data-title="Blur Image">
                                        <img src="{{asset('customer-images/'.$customer->image)}}" alt="Original Image">
                                    </a>
                                @elseif(file_exists(public_path('customer-images/'.$customer->image)))
{{--                                    @dd(2,$customer->image)--}}
                                    <a href="{{asset('customer-images/'.$customer->image)}}" data-lightbox="mygallery" data-title="Original Image">
                                        <img src="{{asset('customer-images/'.$customer->image)}}" alt="Original Image">
                                    </a>
                                @else
{{--                                    @dd(3,$customer->image)--}}
                                    <a href="{{$customer->imageFullPath}}" data-lightbox="mygallery" data-title="Original Image">
                                        <img src="{{$customer->imageFullPath}}" alt="Original Image">
                                    </a>
                                @endif
                            </div>
                            <div class="">
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
                                        <td>Lead Status</td>
                                        <td>
                                            <select onchange="changeStatus(this)" name="lead_status" class="form-control">
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
                                    <tr>
                                        <td>Lead Source</td>
                                        <td>
                                            <select onchange="changeStatus(this)" name="source" class="form-control">
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
                                            <select onchange="changeStatus(this)" name="client_status" class="form-control">
                                                <option value="Free" {{($customer->client_status=="Free") ? 'selected' : ''}}>Free</option>
                                                <option value="Paid" {{($customer->client_status=="Paid") ? 'selected' : ''}}>Paid</option>
                                                <option value="Elite" {{($customer->client_status=="Elite") ? 'selected' : ''}}>Elite</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Assign to data entry</td>
                                        <td>
                                            <select onchange="changeStatus(this)" name="data_entry_user_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach($dataEntryUsers as $val)
                                                    <option value="{{$val->id}}" {{($customer->data_entry_user_id==$val->id) ? 'selected' : ''}}>{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="edit-profile-side-heading font-size14"> Profile Link
                                                <span class="btn btn-sm btn-outline-primary" onclick="copyToClipBoard(this)">Copy</span>
                                            </h5>
                                        </td>
                                        <td>
                                            @php $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'na').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'na').'-'.$customer->id; @endphp
                                            <input type="text" name="user__name"  value="{{config('services.app_main_url').'/'.$uniqueProfileSlug}}" class="form-control">
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
                            <h4 class="card-title mb-0">Call Center History</h4>
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
                                            </td>
                                        </tr>
                                        <tr style="background: #afafaf;">
                                            <td class="text-white">Rejected Reason</td>
                                            <td>
                                                <select name="rejected_reason" id="rejected_reason" class="form-control">
                                                    <option value=""> -- Select -- </option>
                                                    <option value="Fake Image" {{($customer->rejected_reason=="Fake Image") ? 'selected': ''}}>Fake Image</option>
                                                    <option value="Not Passport Style" {{($customer->rejected_reason=="Not Passport Style") ? 'selected': ''}}>Not Passport Style</option>
                                                    <option value="Face Not Clearly Visible" {{($customer->rejected_reason=="Face Not Clearly Visible") ? 'selected': ''}}>Face Not Clearly Visible</option>
                                                    <option value="Wearing Sun Glasses" {{($customer->rejected_reason=="Wearing Sun Glasses") ? 'selected': ''}}>Wearing Sun Glasses</option>
                                                    <option value="Filter Used (e.g., Snapchat)" {{($customer->rejected_reason=="Filter Used (e.g., Snapchat)") ? 'selected': ''}}>Filter Used (e.g., Snapchat)</option>
                                                    <option value="Image Blurry or Unclear" {{($customer->rejected_reason=="Image Blurry or Unclear") ? 'selected': ''}}>Image Blurry or Unclear</option>
                                                    <option value="Body Shot Present" {{($customer->rejected_reason=="Body Shot Present") ? 'selected': ''}}>Body Shot Present</option>
                                                    <option value="Cartoon/Animated Image" {{($customer->rejected_reason=="Cartoon/Animated Image") ? 'selected': ''}}>Cartoon/Animated Image</option>
                                                    <option value="Group Photo Detected" {{($customer->rejected_reason=="Group Photo Detected") ? 'selected': ''}}>Group Photo Detected</option>
                                                    <option value="Offensive Content" {{($customer->rejected_reason=="Offensive Content") ? 'selected': ''}}>Offensive Content</option>
                                                    <option value="Scenic/Background Image" {{($customer->rejected_reason=="Scenic/Background Image") ? 'selected': ''}}>Scenic/Background Image</option>
                                                    <option value="other" {{(!empty($customer->rejected_reason) && !in_array($customer->rejected_reason,["Fake Image","Not Passport Style","Face Not Clearly Visible","Wearing Sun Glasses","Filter Used (e.g., Snapchat)","Image Blurry or Unclear","Body Shot Present","Cartoon/Animated Image","Group Photo Detected","Offensive Content","Scenic/Background Image"])) ? 'selected' : ''}}>Other</option>
                                                </select>
                                                <br>
                                                <textarea name="rejected_reason_other" id="rejected_reason_other" rows="2" class="form-control" style="display: {{(!empty($customer->rejected_reason) && !in_array($customer->rejected_reason,["Fake Image","Not Passport Style","Face Not Clearly Visible","Wearing Sun Glasses","Filter Used (e.g., Snapchat)","Image Blurry or Unclear","Body Shot Present","Cartoon/Animated Image","Group Photo Detected","Offensive Content","Scenic/Background Image"])) ? 'block' : 'none'}};">{{$customer->rejected_reason}}</textarea>
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
                                            <td>Highlight List</td>
                                            <td>
                                                <div class="form-check form-switch" title="Show on Highlight List">
                                                    <input class="form-check-input" type="checkbox" name="is_highlight" id="is_highlight" {{($customer->is_highlight==1) ? 'checked' : ''}} >
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
                                            </td>
                                        </tr>
                                        <tr style="background: #afafaf;">
                                            <td class="text-white">Blocked Reason</td>
                                            <td>
                                                <select name="blocked_reason" id="blocked_reason" class="form-control">
                                                    <option value=""> -- Select -- </option>
                                                    <option value="Incomplete Profile Information" {{($customer->blocked_reason=="Incomplete Profile Information") ? 'selected' : ''}}>Incomplete Profile Information</option>
                                                    <option value="Underage User" {{($customer->blocked_reason=="Underage User") ? 'selected' : ''}}>Underage User</option>
                                                    <option value="Fake or Suspicious Identity" {{($customer->blocked_reason=="Fake or Suspicious Identity") ? 'selected' : ''}}>Fake or Suspicious Identity</option>
                                                    <option value="Impersonation or Fake Identity" {{($customer->blocked_reason=="Impersonation or Fake Identity") ? 'selected' : ''}}>Impersonation or Fake Identity</option>
                                                    <option value="Violent or Threatening Content" {{($customer->blocked_reason=="Violent or Threatening Content") ? 'selected' : ''}}>Violent or Threatening Content</option>
                                                    <option value="Harassment/Bullying" {{($customer->blocked_reason=="Harassment/Bullying") ? 'selected' : ''}}>Harassment/Bullying</option>
                                                    <option value="Misuse of Platform Features" {{($customer->blocked_reason=="Misuse of Platform Features") ? 'selected' : ''}}>Misuse of Platform Features</option>
                                                    <option value="Promotion of Illegal Activities" {{($customer->blocked_reason=="Promotion of Illegal Activities") ? 'selected' : ''}}>Promotion of Illegal Activities</option>
                                                    <option value="Violates Community Guidelines" {{($customer->blocked_reason=="Violates Community Guidelines") ? 'selected' : ''}}>Violates Community Guidelines</option>
                                                    <option value="Promotion/Advertisement Content" {{($customer->blocked_reason=="Promotion/Advertisement Content") ? 'selected' : ''}}>Promotion/Advertisement Content</option>
                                                    <option value="Spam or Bot Account" {{($customer->blocked_reason=="Spam or Bot Account") ? 'selected' : ''}}>Spam or Bot Account</option>
                                                    <option value="Inappropriate Language/Behavior" {{($customer->blocked_reason=="Inappropriate Language/Behavior") ? 'selected' : ''}}>Inappropriate Language/Behavior</option>
                                                    <option value="Multiple Accounts Detected" {{($customer->blocked_reason=="Multiple Accounts Detected") ? 'selected' : ''}}>Multiple Accounts Detected</option>
                                                    <option value="Suspicious Activity Detected" {{($customer->blocked_reason=="Suspicious Activity Detected") ? 'selected' : ''}}>Suspicious Activity Detected</option>
                                                    <option value="other" {{(!empty($customer->rejected_reason) &&
	!in_array($customer->rejected_reason,[
		"Incomplete Profile Information",
		"Underage User",
		"Fake or Suspicious Identity",
		"Impersonation or Fake Identity",
		"Violent or Threatening Content",
		"Harassment/Bullying",
		"Misuse of Platform Features",
		"Promotion of Illegal Activities",
		"Violates Community Guidelines",
		"Promotion/Advertisement Content",
		"Spam or Bot Account",
		"Inappropriate Language/Behavior",
		"Multiple Accounts Detected",
		"Suspicious Activity Detected"
	])) ? 'selected' : ''}}>Other</option>
                                                </select>
                                                <br>
                                                <textarea name="blocked_reason_other" id="blocked_reason_other" rows="2" class="form-control" style="display: {{(!empty($customer->rejected_reason) &&
	!in_array($customer->rejected_reason,["Incomplete Profile Information",
		"Incomplete Profile Information",
		"Underage User",
		"Fake or Suspicious Identity",
		"Impersonation or Fake Identity",
		"Violent or Threatening Content",
		"Harassment/Bullying",
		"Misuse of Platform Features",
		"Promotion of Illegal Activities",
		"Violates Community Guidelines",
		"Promotion/Advertisement Content",
		"Spam or Bot Account",
		"Inappropriate Language/Behavior",
		"Multiple Accounts Detected",
		"Suspicious Activity Detected"
	])) ? 'block' : 'none'}};">{{$customer->blocked_reason}}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Personalized Matchmaker</td>
                                            <td>
                                                <select name="agent_mobile" class="form-control">
                                                    <option value="" {{($customer->agent_mobile=='') ? 'selected' : ''}}>Not Personalized</option>
                                                    <optgroup label="Match Makers">
                                                        @foreach(config('services.matchmakers') as $name => $matchmaker)
                                                            <option value="{{$matchmaker}}" {{($customer->agent_mobile==$matchmaker) ? 'selected' : ''}}>{{$name.' ('.$matchmaker.')'}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                    <optgroup label="BDO's">
                                                        @foreach(config('services.bdos') as $name => $matchmaker)
                                                            <option value="{{$matchmaker}}" {{($customer->agent_mobile==$matchmaker) ? 'selected' : ''}}>{{$name.' ('.$matchmaker.')'}}</option>
                                                        @endforeach
                                                    </optgroup>
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

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title mb-0">Profile Photo</h4>
                                </div>
                                <div class="col-md-6">
                                    <select onchange="changeStatus(this)" name="profile_pic_client_status" id="profile_pic_client_status" class="form-control">
                                        <option value="1" {{($customer->profile_pic_client_status==1) ? 'selected' : ''}}>Everyone</option>
                                        <option value="0" {{($customer->profile_pic_client_status==0) ? 'selected' : ''}}>Only Me</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 my-auto">
                                    <div class="mb-2">
                                        <label for="blur_percent">Blur profile picture</label>
                                        <select onchange="makeBlur()" name="blur_percent" id="blur_percent" class="form-control">
                                            <option value="" selected>Original</option>
                                            <option value="10" {{($customer->blur_percent=="10") ? 'selected' : ''}}>Soft</option>
                                            <option value="15" {{($customer->blur_percent=="15") ? 'selected' : ''}}>Medium</option>
                                            <option value="25" {{($customer->blur_percent=="25") ? 'selected' : ''}}>Heavy</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="image">Who can see profile picture</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>

                                    <button onclick="saveImage(this)" class="btn btn-outline-primary float-end">Save Profile</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title mb-0">Gallery Photos</h4>
                                </div>
                                <div class="col-md-6">
                                    <select onchange="changeStatus(this)" name="profile_gallery_client_status" id="profile_gallery_client_status" class="form-control">
                                        <option value="1" {{($customer->profile_gallery_client_status==1) ? 'selected' : ''}}>Everyone</option>
                                        <option value="0" {{($customer->profile_gallery_client_status==0) ? 'selected' : ''}}>Only Me</option>
                                    </select>
                                </div>
                            </div>
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
                                    <div class="col-md-4 mx-auto my-auto">
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

        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script>
        let customerId = '{{$customer->id}}';
        let formData = new FormData();
        let imageFile = '';
        $(function (){
            $('#customerBadgesForm').on('submit', function (e) {
                $('button[id="submit"]').attr('disabled', true);
                $(':input').removeClass('has-error');
                $('.text-danger').remove();
                e.preventDefault();
                $.ajax({
                    url: '{{route('bdo.save.customer.badges', [$customer->faker_id])}}',
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

            $('select[name="blocked_reason"]').change(function(){
                $('textarea[name="blocked_reason_other"]').hide();
                if ($(this).val()=='other') {
                    $('textarea[name="blocked_reason_other"]').show();
                }
            });

            $('select[name="rejected_reason"]').change(function(){
                $('textarea[name="rejected_reason_other"]').hide();
                if ($(this).val()=='other') {
                    $('textarea[name="rejected_reason_other"]').show();
                }
            });

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

            /* right click popup block */
            $(document).on("contextmenu", function(e) {
                e.preventDefault();
            });

            /* select text block */
            $(document).on("selectstart", function(e) {
                e.preventDefault();
            });

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                formData.append('image', input.files[0]);
                formData.append('blur_percent', $(':input[name="blur_percent"] option:selected').val());
                formData.append('customer_id', customerId);
                reader.onload = function (e) {
                    $(':input').removeClass('has-error');
                    $('.text-danger').remove();
                    $('img#main_image_view').attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
                makeBlur();
            }
        }

        function makeBlur() {
            if (imageFile.files && imageFile.files[0]) {
                formData.append('blur_percent', $(':input[name="blur_percent"] option:selected').val());
                axios.post("{{route('image.preview.pixelate')}}", formData).then(function (res) {
                    if (res.data.status=='success') {
                        $('img#main_image_view').attr('src',res.data.imageFile);
                    }
                    console.log('response',res.data)
                }).catch(function (error) {
                    console.log('errors',error.response.data.errors);
                });
            }
        }

        function saveImage(input){
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            let newImage = '';
            if ($('input[name="image"]').val()) {
                newImage = document.getElementById('image').files[0];
            }
            let formData = new FormData();
            formData.append('image', newImage);
            formData.append('blur_percent', $('select[name="blur_percent"] option:selected').val());
            formData.append('customer_id', customerId);

            axios.post("{{route('bdo.profile.image.save')}}", formData).then(function (res) {
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
                    $.each(error.response.data.errors, function (k, v) {
                        $(':input[name="' + k + '"]').addClass("has-error");
                        $(':input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
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
                    formData.append('customer_id', customerId);
                });
            } else {
                formData.append('public_gallery[]', newImage);
                formData.append('customer_id', customerId);
            }

            axios.post("{{route('bdo.gallery.photos.save')}}", formData).then(function (res) {
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

        function deletePhoto(input) {
            $(input).attr('disabled',true);
            if(confirm('Are you sure, you want to delete this?')){
                axios.post("{{route('bdo.gallery.delete.photo')}}", {photo_id:$(input).attr('data-image-id')}).then(function (res) {
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

        function saveComment(comment) {
            axios.post('{{route('bdo.save.call.history')}}', {
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

        function changeStatus(input) {
            let inputName = $(input).attr('name');
            let previousVal = $(`input[name="${inputName}"] option:selected`).val();
            if (confirm("Are you sure you want to change status?")) {
                axios.post('{{route('bdo.save.customer.other.status')}}', {
                    customer_f:inputName,
                    customer_v:$(input).val(),
                    customer_id: customerId
                }).then(function (res) {
                    alertyFy(res.data.msg,res.data.status,3000);
                    if (res.data.status=='warning') {
                        $(input).val(previousVal);
                    }
                }).catch(function (error) {
                    alertyFy('There is something wrong*','warning',3000);
                });
            } else {
                $(input).val(previousVal);
            }
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
