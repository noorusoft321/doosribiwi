@extends('front.layouts.master')
@section('title',$title)
@section('description', $title)

@push('style')
	<style>
		.btn-outline-primary i {
			color: #040F2E!important;
		}
		.btn-outline-primary:hover i {
			color: #ffffff!important;
		}
		.btn-outline-primary.btn-active, .btn-outline-primary.btn-active:hover, .btn-outline-primary.btn-active i {
			background: #040F2E!important;
			color: #ffffff!important;
		}
		.card-header {
			text-transform: uppercase;
		}
		.profile-section {
			width: 100%;
			margin-bottom:20px;
			height: 280px;
            border-radius: 50%;
            padding-top: 20px;
		}
		.profile-section img {
			width: 100%;
			object-fit: contain;
			height: 100%;
		}
		.card {
			border-radius: 10px;
			box-shadow: 5px 5px 5px #0000003d;
			border: none;
		}
        .section-card-heading {
            font-size: 20px;
            color: #D5AD6D;
            background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%);
            background: -o-linear-gradient(transparent, transparent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 600;
            text-align: center;
        }
        ul.verification-badge {
            padding: 10px;
        }
        ul.verification-badge li {
            text-align: center;
        }
        ul.verification-badge li span {
            font-size: 12px;
            color: #D5AD6D;
            font-weight: 500;
        }
        .blockButton {
            align-items: center;
            background-color: #fee6e3;
            border: 2px solid #040F2E;
            border-radius: 5px;
            box-sizing: border-box;
            color: #040F2E;
            font-size: 15px;
            height: 48px;
            justify-content: center;
            line-height: 24px;
            max-width: 100%;
            padding: 0 25px;
            position: relative;
            text-align: center;
            text-decoration: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            font-weight: 500;
        }
        .blockButton i {
            color: #040F2E;
            font-size: 16px;
        }

        .blockButton:active {
            background-color: #040F2E;
            border: 2px solid #fee6e3;
            color: #fee6e3;
        }
        .blockButton:active i {
            color: #fee6e3;
        }
        .card-header {
            border-radius: 5px 5px 0px 0px;
        }
        .profile-section img {
            position: relative;
        }
        .messengerIconBtn {
            -webkit-border-radius: 60px;
            border-radius: 50%;
            border: none;
            color: #eeeeee;
            cursor: pointer;
            display: inline-block;
            font-family: sans-serif;
            font-size: 25px;
            padding: 10px 14px;
            text-align: center;
            text-decoration: none;
            top: 0;
            right: 0;
            position: absolute;
            margin: 5px;
        }
        .messengerIconBtn i {
            color: #ffffff;
        }
        .messengerBottomIconBtn {
            -webkit-border-radius: 60px;
            border-radius: 20px;
            color: #eeeeee;
            cursor: pointer;
            display: inline-block;
            font-family: sans-serif;
            font-size: 20px;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            transition: all .5s ease-in-out;
        }
        a.messengerBottomIconBtn:hover {
            font-size: 23px;
            font-weight: 600;
            color: #fff;
        }
        .messengerBottomIconBtn i {
            color: #ffffff;
        }
        @keyframes glowing {
            0% {
                background-color: #11823b;
                box-shadow: 0 0 5px #004d25;
            }
            50% {
                background-color: #48bf53;
                box-shadow: 0 0 20px #48bf53;
            }
            100% {
                background-color: #008416;
                box-shadow: 0 0 5px #004d25;
            }
        }
        .messengerIconBtn, .messengerBottomIconBtn {
            animation: glowing 1300ms infinite;
        }
        span.btn:hover {
            background: #040F2E;
            color: #ffffff;
        }
        .bottomInfoMessage {
            font-size: 20px;
            font-weight: 500;
            text-align: center;
        }
        .bottomInfoMessage i {
            font-weight: 600;
            color: #040F2E;
        }

        .custom-btn {
            width: auto !important;
            padding: 10px 30px !important;
        }
        .btn-lets-chat {
            border: none;
            background: rgb(0, 132, 22) !important;
            background: linear-gradient(0deg, rgb(0, 77, 37) 0%, rgb(72, 191, 83) 100%) !important;
            color: #fff;
            overflow: hidden;
        }
        .fa-whatsapp:before{
            content:"\f232";
            font-family: FontAwesome;
        }
        .matchProfileImage{
            width: 95%;
            border-radius: 15px 50px;
            padding: 10px;
            background-image: linear-gradient(#F9F295,#E0AA3E,#E0AA3E,#B88A44);
        }
        @media only screen and (max-width: 600px) {
            .section-card-heading {
                font-size: 15px !important;
            }
            .bottomInfoMessage {
                font-size: 14px;
            }
        }
        .animated-button1 {
            /*background: linear-gradient(-30deg, #661d2f 50%, #040F2E 50%);*/
            padding: 20px 40px;
            margin: 12px;
            display: inline-block;
            -webkit-transform: translate(0%, 0%);
            transform: translate(0%, 0%);
            overflow: hidden;
            color: #f7d4d4;
            font-size: 20px;
            letter-spacing: 2.5px;
            text-align: center;
            text-transform: uppercase;
            text-decoration: none;
            -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        .animated-button1::before {
            content: '';
            position: absolute;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            background-color: #ad8585;
            opacity: 0;
            -webkit-transition: .2s opacity ease-in-out;
            transition: .2s opacity ease-in-out;
        }

        .animated-button1:hover::before {
            opacity: 0.2;
        }
        .animated-button1:hover {
            color: #ffffff;
        }

        .animated-button1 span {
            position: absolute;
        }

        .animated-button1 span:nth-child(1) {
            top: 0px;
            left: 0px;
            width: 100%;
            height: 4px;
            background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%) !important;
            -webkit-animation: 2s animateTop linear infinite;
            animation: 2s animateTop linear infinite;
        }

        @keyframes animateTop {
            0% {
                -webkit-transform: translateX(100%);
                transform: translateX(100%);
            }
            100% {
                -webkit-transform: translateX(-100%);
                transform: translateX(-100%);
            }
        }

        .animated-button1 span:nth-child(2) {
            top: 0px;
            right: 0px;
            height: 100%;
            width: 4px;
            background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%) !important;
            -webkit-animation: 2s animateRight linear -1s infinite;
            animation: 2s animateRight linear -1s infinite;
        }

        @keyframes animateRight {
            0% {
                -webkit-transform: translateY(100%);
                transform: translateY(100%);
            }
            100% {
                -webkit-transform: translateY(-100%);
                transform: translateY(-100%);
            }
        }

        .animated-button1 span:nth-child(3) {
            bottom: 0px;
            left: 0px;
            width: 100%;
            height: 4px;
            background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%) !important;
            -webkit-animation: 2s animateBottom linear infinite;
            animation: 2s animateBottom linear infinite;
        }

        @keyframes animateBottom {
            0% {
                -webkit-transform: translateX(-100%);
                transform: translateX(-100%);
            }
            100% {
                -webkit-transform: translateX(100%);
                transform: translateX(100%);
            }
        }

        .animated-button1 span:nth-child(4) {
            top: 0px;
            left: 0px;
            height: 100%;
            width: 4px;
            background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%) !important;
            -webkit-animation: 2s animateLeft linear -1s infinite;
            animation: 2s animateLeft linear -1s infinite;
        }

        @keyframes animateLeft {
            0% {
                -webkit-transform: translateY(-100%);
                transform: translateY(-100%);
            }
            100% {
                -webkit-transform: translateY(100%);
                transform: translateY(100%);
            }
        }

	</style>
@endpush

@section('content')

	<main>
		<div class="dashboard">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
                        <div class="side-bar-dashboard">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <div class="profile-section">
                                            <img src="{{$customer->imageFullPath}}" alt="{{$customer->full_name}}">
                                            <a class="messengerIconBtn LoginToView" href="{{route('messenger',[$customer->name])}}"><i class="fa fa-comments"></i></a>
                                        </div>
                                        <h3 class="align-center profile-name" style="line-height: 1;">{{$customer->full_name}}</h3>
                                        <p class="align-center profile-occupation text-theme">
                                            {{(!empty($customer->customerOtherInfo) && $customer->customerOtherInfo->OccupationID > 0 && $customer->customerOtherInfo->OccupationID!=243) ? genericQuery($customer->customerOtherInfo->OccupationID,'Occupation') : ''}}
                                        </p>
                                    </div>
                                    @if(auth()->guard('customer')->check() && auth()->guard('customer')->user()->email_verified==1)
                                        <div class="container text-center">
                                            <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm" title="Views"> <i class="fa fa-eye"></i> {{$profileViewsCount}}</a>
                                            <a onclick="likeUnlikeCustomer(this)" href="javascript:void(0);" class="btn btn-outline-primary btn-sm {{(!empty($customerLikedByMe)) ? 'btn-active' : ''}}" title="Like">
                                                <i class="fa fa-heart"></i>
                                                {{$profileLikesCount}}
                                            </a>
                                            <a onclick="saveUnsavedCustomer(this)" href="javascript:void(0);" class="btn btn-outline-primary btn-sm {{(!empty($customerSaveByMe)) ? 'btn-active' : ''}}" title="Save">
                                                <i class="fa fa-floppy-o"></i>
                                                {{$profileSavesCount}}
                                            </a>
                                        </div>
                                    @else
                                        <div class="container text-center">
                                            <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm" title="Views"> <i class="fa fa-eye"></i> {{$profileViewsCount}}</a>
                                            <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm {{(!empty($customerLikedByMe)) ? 'btn-active' : ''}}" title="Like">
                                                <i class="fa fa-heart"></i>
                                                {{$profileLikesCount}}
                                            </a>
                                            <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm {{(!empty($customerSaveByMe)) ? 'btn-active' : ''}}" title="Save">
                                                <i class="fa fa-floppy-o"></i>
                                                {{$profileSavesCount}}
                                            </a>
                                        </div>
                                    @endif
                                    <br>
                                </div>
                            </div>
                        </div>

                        @if($customer->profile_gallery_client_status==1 && $customer->profile_gallery_status==1 && count($customerImages) > 0)
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="section-card-heading">Gallery Photos</h3>
                                    <div class="container gallery-container">
                                        <div class="tz-gallery">
                                            <div class="row justify-content-center">
                                                @foreach($customerImages as $key => $val)
                                                    @if(file_exists(public_path('customer_images/'.$val->image)))
                                                        <div class="col-6">
                                                            <a class="lightbox" href="{{asset('customer_images/'.$val->image)}}">
                                                                <img src="{{asset('customer_images/'.$val->image)}}" alt="Gallery {{$key + 1}}" width="100" height="100">
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <h3 class="section-card-heading">Profile Verification Status</h3>
                                <ul class="verification-badge">
                                    <li>
                                        <img src="{{asset('customer_verification/email-'.($customer->email_verified==1 ? 'on' : 'off').'.png')}}" title="Email Verification">
                                        <span class="d-block">Email</span>
                                    </li>
                                    <li>
                                        <img src="{{asset('customer_verification/phone-'.($customer->mobile_verified==1 ? 'on' : 'off').'.png')}}" title="Phone Verification">
                                        <span class="d-block">Phone</span>
                                    </li>
                                    <li>
                                        <img src="{{asset('customer_verification/pic-'.($customer->profile_pic_status==1 ? 'on' : 'off').'.png')}}" title="Picture Verification">
                                        <span class="d-block">Picture</span>
                                    </li>
                                    <li>
                                        <img src="{{asset('customer_verification/meeting-'.($customer->meeting_verification==1 ? 'on' : 'off').'.png')}}" title="Meeting Verification">
                                        <span class="d-block">Meeting</span>
                                    </li>
                                    <li>
                                        <img src="{{asset('customer_verification/age-'.($customer->age_verification==1 ? 'on' : 'off').'.png')}}" title="Age Verification">
                                        <span class="d-block">Age</span>
                                    </li>
                                    <li>
                                        <img src="{{asset('customer_verification/edu-'.($customer->education_verification==1 ? 'on' : 'off').'.png')}}" title="Education Verification">
                                        <span class="d-block">Education</span>
                                    </li>
                                    <li>
                                        <img src="{{asset('customer_verification/location-'.($customer->location_verification==1 ? 'on' : 'off').'.png')}}" title="Location Verification">
                                        <span class="d-block">Location</span>
                                    </li>
                                    <li>
                                        <img src="{{asset('customer_verification/nationality-'.($customer->nationality_verification==1 ? 'on' : 'off').'.png')}}" title="Nationality Verification">
                                        <span class="d-block">Nationality</span>
                                    </li>
                                    <li>
                                        <img src="{{asset('customer_verification/salary-'.($customer->salary_verification==1 ? 'on' : 'off').'.png')}}" title="Salary Verification">
                                        <span class="d-block">Salary</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="col-12" style="padding:20px; position:relative;">
                                    <h5 class="edit-profile-side-heading font-size14"> Profile Link
                                        <span class="badge badge-primary pull-right" style="float:right; cursor:pointer; background-color:#040F2E; padding:14px; position:absolute; right:20px; top:55px; z-index:2;border-radius: 2px;" onclick="copyToClipBoard(this)">Copy</span>
                                    </h5>
                                    @php $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'NA').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'NA').'-'.$customer->faker_id; @endphp
                                    <input type="text" name="user__name"  value="{{route('search.by.slug',[$uniqueProfileSlug])}}" class="form-control">
                                </div>
                                <br>
                                <div class="col-12 text-center">
                                    <button class="blockButton" onclick="reportBlockModal(this,'report')">
                                        <i class="fas fa-solid fa-house-user"></i> Report
                                    </button>
                                    <button class="blockButton" onclick="reportBlockModal(this,'block')">
                                        <i class="fas fa-solid fa-house-user"></i> {{(!empty($customerBlockByMe)) ? 'Unblock' : 'Block'}}
                                    </button>
                                </div>
                            </div>
                        </div>
					</div>

                    <div class="col-md-9 main-dashboard">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{($customer->customerOtherInfo->gender==1) ? 'Male' : 'Female'}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Age </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{$customer->customerOtherInfo->age}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Country </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerOtherInfo->country_id,'Country','name')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> State </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerOtherInfo->state_id,'State')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> City </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerOtherInfo->city_id,'City')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Marital Status </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                        <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                            {{$customer->customerOtherInfo->childrenQuantity}}
                                                        </h5>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Mother Tongue </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerPersonalInfo->Caste,'Caste')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Country of Origin </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerPersonalInfo->CountryOfOrigin,'Country','name')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> State of Origin </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerPersonalInfo->StateOfOrigin,'State')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> City of Origin </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerPersonalInfo->CityOfOrigin,'City')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Willing To Relocate </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerPersonalInfo->WillingToRelocate,'WillingToRelocate')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> I Am Looking To Marry </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerPersonalInfo->IAmLookingToMarry,'IAmLookingToMarry')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Living Arrangement </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerPersonalInfo->MyLivingArrangements,'MyLivingArrangement')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Smoke </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerCareerInfo->University,'University')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Occupation </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerCareerInfo->Profession,'Occupation')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Job Post </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerCareerInfo->JobPost,'JobPost')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Monthly Income </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerCareerInfo->MonthlyIncome,'AnnualInCome')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Future Plan </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                        <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                            {{genericQuery($customer->customerOtherInfo->EducationID,'Education')}}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 class="edit-profile-side-heading font-size14"> University </h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                            N/A
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 class="edit-profile-side-heading font-size14"> Occupation </h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                            {{genericQuery($customer->customerOtherInfo->OccupationID,'Occupation')}}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 class="edit-profile-side-heading font-size14"> Job Post </h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                            N/A
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 class="edit-profile-side-heading font-size14"> Monthly Income </h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                            N/A
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 class="edit-profile-side-heading font-size14"> Future Plan </h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerPersonalInfo->Heights,'Height')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Weight (KG) </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerPersonalInfo->Weights,'Weight')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Complexion </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerPersonalInfo->Complexions,'Complexion')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> My Build </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerPersonalInfo->MyBuilds,'MyBuild')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Hair Color </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerPersonalInfo->HairColors,'HairColor')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Eye Color </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerPersonalInfo->EyeColors,'EyeColor')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Disability </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerReligionInfo->Religions,'Religion')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Sect </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerReligionInfo->Sects,'Sect')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Do You Prefer Hijaab </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerReligionInfo->DoYouPreferHijabs,'DoYouPreferHijab')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Do You Prefer Beard </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerReligionInfo->DoYouHaveBeards,'DoYouHaveBeard')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Are You Revert </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerReligionInfo->AreYouReverts,'AreYouRevert')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Do You Keep Halal </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        {{genericQuery($customer->customerReligionInfo->DoYouKeepHalal,'DoYouKeepHalal')}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14"> Do You Perform Salaah </h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        @php
                                                            $valNew = 'Any';
                                                            if (isset($customerSearch->state_id)) {
                                                                $valNew = genericQuery($customerSearch->state_id,'State');
                                                            }
                                                        @endphp
                                                        {{($valNew=='N/A') ? 'Any' : $valNew}}
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
                                                        @php
                                                            $valNew = 'Any';
                                                            if (isset($customerSearch->city_id)) {
                                                                $valNew = genericQuery($customerSearch->city_id,'City');
                                                            }
                                                        @endphp
                                                        {{($valNew=='N/A') ? 'Any' : $valNew}}
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                                                    <h5 class="edit-profile-side-heading font-size14 text-theme">
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
                        @if (!empty($customer->agent_mobile))
                            <div class="row">
                                <div class="col-md-12">
                                    {{--style="border: 3px solid #040F2E"--}}
                                    <div class="card animated-button1">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <div class="card-body">
                                            <p class="bottomInfoMessage">This profile user is taking <strong class="text-theme">Personalized Matchmaking Service.</strong> If you are interested then contact her <strong class="text-theme">Matchmaker</strong></p>
                                            <p class="bottomInfoMessage">یہ پروفائل صارف پرسنلائزڈ <strong class="text-theme"> میچ میکنگ سروس</strong>  لے رہا ہے۔ اگر آپ دلچسپی رکھتے ہیں تو اس کے <strong class="text-theme">میچ میکر</strong> سے رابطہ کریں۔</p>
                                            <div class="text-center pt-2">
                                                <a href="https://api.whatsapp.com/send?phone={{$customer->agent_mobile}}&text=Hi%20Shaadi.org.pk%2C%20I%20need%20more%20information." class="messengerBottomIconBtn LoginToView" title="Let's Chat"><i class="fa fa-whatsapp"></i> Contact Her </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card" style="border: 3px solid #040F2E">
                                        <div class="card-body">
                                            <p class="bottomInfoMessage">If you are interested in this profile, let's chat <a href="{{route('messenger',[$customer->name])}}" class="text-theme font-weight-600 LoginToView"> <i class="fa fa-comments"></i> </a></p>
                                            <p class="bottomInfoMessage"><a href="{{route('messenger',[$customer->name])}}" class="text-theme font-weight-600 LoginToView"> <i class="fa fa-comments"></i> </a>اگر آپ اس پروفائل میں دلچسپی رکھتے ہیں تو آئیے چیٹ کریں </p>
                                            <div class="text-center pt-2">
                                                <a href="{{route('messenger',[$customer->name])}}" class="messengerBottomIconBtn LoginToView" title="Let's Chat"><i class="fa fa-comments"></i> Let's Chat</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
				</div>
			</div>
		</div>
	</main>

	<!-- Report Modal -->
	<div class="modal fade" id="reportBlockModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" style="text-transform: capitalize;"><span id="reportBlockModalTitle">Report</span> Customer</h5>
				</div>
				<div class="modal-body">
					<form id="reportBlockForm">
						<input type="hidden" name="customer_id" value="{{$customer->faker_id}}">
						<textarea name="desc" cols="55" rows="5" placeholder="Please add over all description to mention particular reason thanks" class="from-control"></textarea>
					</form>
				</div>
				<div class="modal-footer">
					<button onclick="closeReportBlockModal()" type="button" class="btn btn-outline-primary">Close</button>
					<button onclick="actionForCustomer(this)" type="button" class="btn btn-outline-primary">Submit</button>
				</div>
			</div>
		</div>
	</div>

@endsection

@push('script')
	<script>
        $(function () {
            $(".LoginToView").on('click', function(e) {
                if (!authCheckGlobally) {
                    checkAuthLoginMessage();
                    return false;
                }
            });
        });

        let reportBlockUrl = '{{route('customer.block')}}';
        function reportBlockModal(input,action) {
            if (!authCheckGlobally) {
                checkAuthLoginMessage();
                return false;
            }
            reportBlockUrl = (action=='report') ? '{{route('customer.report')}}' : '{{route('customer.block')}}';
            $('#reportBlockModalTitle').text(action);
            $('#reportBlockModalTitle :input[name="desc"]').val('');
            $('#reportBlockModal').modal({backdrop:'static', keyboard:false});
        }

        function closeReportBlockModal() {
            $('#reportBlockModal').modal('hide');
        }

        function actionForCustomer(input) {
            $(input).attr('disabled',true);
            axios.post(reportBlockUrl, $('#reportBlockForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    setTimeout(function () {
                        location.reload();
                    },3000)
                }
                $(input).attr('disabled',false);
            }).catch(function (error) {
                alertyFy('Request has not been submitted','warning',3000);
                $(input).attr('disabled',false);
            });
        }

        function likeUnlikeCustomer(input) {
            if (!authCheckGlobally) {
                checkAuthLoginMessage();
                return false;
            }
            $(input).attr('disabled',false);
            axios.post('{{route('customer.like.unlike')}}', {
                customer_id: '{{$customer->faker_id}}'
            }).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    setTimeout(function () {
                        location.reload();
                    },3000)
                }
                $(input).attr('disabled',false);
            }).catch(function (error) {
                alertyFy('Request has not been submitted','warning',3000);
                $(input).attr('disabled',false);
            });
        }

        function saveUnsavedCustomer(input) {
            if (!authCheckGlobally) {
                checkAuthLoginMessage();
                return false;
            }
            $(input).attr('disabled',false);
            axios.post('{{route('customer.save.unsaved')}}', {
                customer_id: '{{$customer->faker_id}}'
            }).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    setTimeout(function () {
                        location.reload();
                    },3000)
                }
                $(input).attr('disabled',false);
            }).catch(function (error) {
                alertyFy('Request has not been submitted','warning',3000);
                $(input).attr('disabled',false);
            });
        }

	</script>
@endpush