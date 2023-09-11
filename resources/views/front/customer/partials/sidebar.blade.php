<style>
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
	.card-header {
		border-radius: 5px 5px 0px 0px;
	}
	.progress {
		height: 13px;
	}
	@media only screen and (max-width: 600px) {
		.section-card-heading {
			font-size: 15px !important;
		}
	}
</style>
<div class="card">
	<div class="card-body">
		<div>
			<div class="profile-section">
				@if(file_exists(public_path('customer_images/'.$customer->image)))
					<img src="{{asset('customer_images/'.$customer->image)}}" alt="{{$customer->full_name}}">
				@else
					<img src="{{$customer->imageFullPath}}" alt="{{$customer->full_name}}">
				@endif
			</div>
			<h3 class="align-center profile-name" style="line-height: 1;">{{$customer->full_name}}</h3>
			<p class="align-center profile-occupation text-theme">
				{{(!empty($customer->getOccupationName)) ? $customer->getOccupationName->name : 'Occupation'}} from
				{{(!empty($customer->getCountryName)) ? $customer->getCountryName->name : 'Country'}}
			</p>
            @php
                $myPackage = null;
                if (!empty($customer->package_id) && $customer->package_id > 0) {
                    $myPackage = getMyPackage($customer->package_id);
                }
                $messageLimit = checkMessageLimit($customer->id,true);
				$profileComplete = checkProfileCompletePercent($customer);
            @endphp
			<div class="row border-top p-2">
				<div class="col-auto mx-auto my-auto">
					<span style="font-size: 14px;font-weight: 500;">Profile Complete</span>
				</div>
				<div class="col mx-auto my-auto">
					<div class="progress">
						<div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-label="Success striped example" style="width: {{$profileComplete}}%;font-weight: 600;" aria-valuenow="{{$profileComplete}}" aria-valuemin="0" aria-valuemax="100">
							{{$profileComplete}}%
						</div>
					</div>
				</div>
			</div>
			{{--<div class="border-top p-2">--}}
				{{--<p class="m-0">Profile Complete</p>--}}
				{{--<div class="progress">--}}
					{{--<div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-label="Success striped example" style="width: {{$profileComplete}}%;font-weight: 600;" aria-valuenow="{{$profileComplete}}" aria-valuemin="0" aria-valuemax="100">--}}
						{{--{{$profileComplete}}%--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
			<div class="table-responsive">
				<table class="table table-bordered packageTable">
					<tbody>
					<tr>
						<td>Package Type</td>
						<td>{{(!empty($myPackage)) ? $myPackage->package_name : 'Free'}}</td>
					</tr>
					<tr>
						<td>Direct Messages ({{$messageLimit[0]}})</td>
						<td>{{$messageLimit[1]}} Remains</td>
					</tr>
                    <tr>
                        <td>Profile Status</td>
                        <td>
                            @if($customer->email_verified==1 &&
                                $customer->mobile_verified==1 &&
                                $customer->profile_pic_status==1 &&
                                $customer->meeting_verification==1 &&
                                $customer->age_verification==1 &&
                                $customer->education_verification==1 &&
                                $customer->location_verification==1 &&
                                $customer->nationality_verification==1)
                                Verified
                            @elseif($customer->email_verified==1 &&
                                $customer->mobile_verified==1 &&
                                $customer->profile_pic_status==1 &&
                                $customer->meeting_verification==1)
                                Semi Verified
                            @else
                                Not Verified
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Featured Profile</td>
                        <td>{{($customer->featuredProfile==1) ? 'Yes' : 'No'}}</td>
                    </tr>
					</tbody>
				</table>
			</div>
            <div class="text-center border-bottom pb-3">
                <a href="{{route('packages')}}" target="_blank" class="messengerBottomIconBtn LoginToView" title="Upgrade Account">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sparkles" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-sparkles fa-fw fa-xl" style="width: 22px;"><path fill="currentColor" d="M327.5 85.2c-4.5 1.7-7.5 6-7.5 10.8s3 9.1 7.5 10.8L384 128l21.2 56.5c1.7 4.5 6 7.5 10.8 7.5s9.1-3 10.8-7.5L448 128l56.5-21.2c4.5-1.7 7.5-6 7.5-10.8s-3-9.1-7.5-10.8L448 64 426.8 7.5C425.1 3 420.8 0 416 0s-9.1 3-10.8 7.5L384 64 327.5 85.2zM205.1 73.3c-2.6-5.7-8.3-9.3-14.5-9.3s-11.9 3.6-14.5 9.3L123.3 187.3 9.3 240C3.6 242.6 0 248.3 0 254.6s3.6 11.9 9.3 14.5l114.1 52.7L176 435.8c2.6 5.7 8.3 9.3 14.5 9.3s11.9-3.6 14.5-9.3l52.7-114.1 114.1-52.7c5.7-2.6 9.3-8.3 9.3-14.5s-3.6-11.9-9.3-14.5L257.8 187.4 205.1 73.3zM384 384l-56.5 21.2c-4.5 1.7-7.5 6-7.5 10.8s3 9.1 7.5 10.8L384 448l21.2 56.5c1.7 4.5 6 7.5 10.8 7.5s9.1-3 10.8-7.5L448 448l56.5-21.2c4.5-1.7 7.5-6 7.5-10.8s-3-9.1-7.5-10.8L448 384l-21.2-56.5c-1.7-4.5-6-7.5-10.8-7.5s-9.1 3-10.8 7.5L384 384z" class="text-white"></path></svg>
                    <cm>Upgrade Package</cm>
                </a>
            </div>

            <div class="row" style="padding:20px; position:relative;">
                <h5 class="edit-profile-side-heading font-size14"> My Profile Link
                    <span class="badge badge-primary pull-right" style="float:right; cursor:pointer; background-color:#040F2E; padding:14px; position:absolute; right:20px; top:55px; z-index:2;border-radius: 2px;" onclick="copyToClipBoard(this)">Copy</span>
                </h5>
                @php $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'NA').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'NA').'-'.$customer->faker_id; @endphp
                <input type="text" name="user__name"  value="{{route('search.by.slug',[$uniqueProfileSlug])}}" class="form-control">
            </div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<br>
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

		<a href="{{route('edit.personal.profile')}}">
			<div class="full-width-tabs">
				<i class="fa fa-info-circle"></i>  Edit Personal Profile
			</div>
		</a>
		<a href="{{route('edit.profile')}}">
			<div class="full-width-tabs">
				<i class="fa fa-pencil-square-o"></i>  Edit Profile
			</div>
		</a>
		<a href="{{route('edit.photo')}}">
			<div class="full-width-tabs">
				<i class="fa fa-picture-o"></i> Gallery
			</div>
		</a>
		<a href="{{route('customer.like.save')}}">
			<div class="full-width-tabs">
				<i class="fa fa-heart"></i>  Like / Save
			</div>
		</a>
		<a href="{{route('change.email.password')}}">
			<div class="full-width-tabs">
				<i class="fa fa-user"></i>  Change Email / Password
			</div>
		</a>
		<a href="{{route('get.customer.block')}}">
			<div class="full-width-tabs">
				<i class="fa fa-ban"></i>  Blocked Users
			</div>
		</a>
		<a href="{{route('contact.us')}}">
			<div class="full-width-tabs">
				<i class="fa fa-phone-square"></i>  Contact Us
			</div>
		</a>
		<a onclick="deleteProfile(this,'{{$customer->faker_id}}')" href="javascript:void(0)">
			<div class="full-width-tabs">
				<i class="fa fa-minus-circle"></i>  Delete Profile
			</div>
		</a>
	</div>
</div>

{{--<div class="card">--}}
	{{--<div class="card-body">--}}
		{{--<div class="col-12" style="padding:20px; position:relative;">--}}
			{{--<h5 class="edit-profile-side-heading font-size14"> My Profile Link--}}
				{{--<span class="badge badge-primary pull-right" style="float:right; cursor:pointer; background-color:#040F2E; padding:14px; position:absolute; right:20px; top:55px; z-index:2;border-radius: 2px;" onclick="copyToClipBoard(this)">Copy</span>--}}
			{{--</h5>--}}
			{{--@php $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'NA').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'NA').'-'.$customer->faker_id; @endphp--}}
			{{--<input type="text" name="user__name"  value="{{route('search.by.slug',[$uniqueProfileSlug])}}" class="form-control">--}}
		{{--</div>--}}
	{{--</div>--}}
{{--</div>--}}