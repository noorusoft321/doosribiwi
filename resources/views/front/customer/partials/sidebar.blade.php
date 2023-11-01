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
		box-shadow: 5px 5px 5px #082f493d;
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
	.messengerBottomIconBtn {
		-webkit-border-radius: 60px;
		border-radius: 35px;
		color: #eeeeee;
		cursor: pointer;
		display: inline-block;
		font-family: sans-serif;
		font-size: 16px;
		padding: 10px 20px;
		text-align: center;
		text-decoration: none;
	}
	a.messengerBottomIconBtn:hover {
		color: #fff;
	}
	.messengerBottomIconBtn cm, .messengerBottomIconBtn svg {
		color: #ffffff;
		margin-top: -8px;
	}
	.messengerBottomIconBtn {
		animation: glowing 1300ms infinite;
	}
	.featured-label {
		--f: 10px;
		--r: 15px;
		--t: 10px;
		position: absolute;
		inset: var(--t) calc(-1*var(--f)) auto auto;
		padding: 0 10px var(--f) calc(10px + var(--r));
		clip-path: polygon(0 0,100% 0,100% calc(100% - var(--f)),calc(100% - var(--f)) 100%, calc(100% - var(--f)) calc(100% - var(--f)),0 calc(100% - var(--f)), var(--r) calc(50% - var(--f)/2));
		box-shadow: 0 calc(-1*var(--f)) 0 inset #0005;
	}
	.featured-label span {
		color: black;
		font-size: 12px;
		font-weight: 600;
	}
	.premium-button {
		display: flex;
		align-items: center;
		justify-content: center;
		line-height: 1;
		text-decoration: none;
		color: #ffffff;
		font-size: 18px;
		border-radius: 0px;
		width: 100%;
		height: 40px;
		font-weight: bold;
		background-image: linear-gradient(150deg, #DDAC17 10%, #ECC440 40%, #DDAC17 68%, #ECC440 90%);
		margin: 0 auto;
		border-left: 20px solid #ffd400;
		border-right: 20px solid #ffd400;
		animation: glowing 1300ms infinite;
		border-bottom: 10px groove #040F2E;
	}
	@media only screen and (max-width: 600px) {
		.section-card-heading {
			font-size: 15px !important;
		}
	}
</style>
<div class="card">
	<div class="card-body bg-blast">
		<div>
			<div class="profile-section">
				@if(file_exists(public_path('customer_images/'.$customer->image)))
					<img src="{{asset('customer_images/'.$customer->image)}}" alt="{{$customer->full_name}}">
				@else
					<img src="{{$customer->imageFullPath}}" alt="{{$customer->full_name}}">
				@endif

				@if(!empty($customer->featuredProfile==1))
					<a class="featured-label" style="background: linear-gradient(0deg, rgb(64, 168, 230) 0%, rgb(54, 184, 230) 100%);">
						<span class="text-white">Featured</span>
					</a>
				@endif
			</div>
			<h3 class="align-center profile-name text-white" style="line-height: 1;">{{$customer->full_name}}</h3>
			<p class="align-center profile-occupation text-white">
				{{(!empty($customer->getOccupationName)) ? $customer->getOccupationName->name : 'Occupation'}} from
				{{(!empty($customer->getCountryName)) ? $customer->getCountryName->name : 'Country'}}
			</p>

			@if(!empty($customer->package_id))
				@if(!empty($customer->getCountryName) && in_array($customer->getCountryName->name,['Pakistan','NA']))
					<div class="premium-button">Premium</div>
				@else
					<div class="premium-button">Abroad</div>
				@endif
			@endif

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
					<span style="font-size: 14px;font-weight: 500;color: #fff;">Profile Complete</span>
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
						<td class="text-white">{{(!empty($myPackage)) ? ($myPackage->id==3) ? 'Abroad' : 'Premium' : '----'}}</td>
					</tr>
					<tr>
						<td>Direct Messages ({{$messageLimit[0]}})</td>
						<td class="text-white">{{$messageLimit[1]}} Remains</td>
					</tr>
                    <tr>
                        <td>Profile Status</td>
                        <td class="text-white">
                            @if($customer->email_verified==1 &&
                                $customer->mobile_verified==1 &&
                                $customer->profile_pic_status==1 &&
                                $customer->meeting_verification==1 &&
                                $customer->age_verification==1 &&
                                $customer->education_verification==1 &&
                                $customer->location_verification==1 &&
                                $customer->nationality_verification==1)
                                Verified
                            @else
                                Not Verified
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Featured Profile</td>
                        <td class="text-white">{{($customer->featuredProfile==1) ? 'Yes' : 'No'}}</td>
                    </tr>
					</tbody>
				</table>
			</div>
			@if(!empty($myPackage))
				@if($customer->featuredProfile==0)
					<div class="text-center border-bottom pb-3">
						<a onclick="getFeaturedModal(this)" href="javascript:void(0);" class="messengerBottomIconBtn LoginToView" title="Get Featured">
							<svg style="color: white;width: 30px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. --><path d="M576 136c0 22.09-17.91 40-40 40c-.248 0-.4551-.1266-.7031-.1305l-50.52 277.9C482 468.9 468.8 480 453.3 480H122.7c-15.46 0-28.72-11.06-31.48-26.27L40.71 175.9C40.46 175.9 40.25 176 39.1 176c-22.09 0-40-17.91-40-40S17.91 96 39.1 96s40 17.91 40 40c0 8.998-3.521 16.89-8.537 23.57l89.63 71.7c15.91 12.73 39.5 7.544 48.61-10.68l57.6-115.2C255.1 98.34 247.1 86.34 247.1 72C247.1 49.91 265.9 32 288 32s39.1 17.91 39.1 40c0 14.34-7.963 26.34-19.3 33.4l57.6 115.2c9.111 18.22 32.71 23.4 48.61 10.68l89.63-71.7C499.5 152.9 496 144.1 496 136C496 113.9 513.9 96 536 96S576 113.9 576 136z" fill="white"></path></svg>
							<cm>Get Featured</cm>
						</a>
					</div>
				@endif
			@else
				<div class="text-center border-bottom pb-3">
					<a href="{{route('packages')}}" target="_blank" class="messengerBottomIconBtn LoginToView" title="Upgrade Account">
						<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sparkles" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-sparkles fa-fw fa-xl" style="width: 22px;"><path fill="currentColor" d="M327.5 85.2c-4.5 1.7-7.5 6-7.5 10.8s3 9.1 7.5 10.8L384 128l21.2 56.5c1.7 4.5 6 7.5 10.8 7.5s9.1-3 10.8-7.5L448 128l56.5-21.2c4.5-1.7 7.5-6 7.5-10.8s-3-9.1-7.5-10.8L448 64 426.8 7.5C425.1 3 420.8 0 416 0s-9.1 3-10.8 7.5L384 64 327.5 85.2zM205.1 73.3c-2.6-5.7-8.3-9.3-14.5-9.3s-11.9 3.6-14.5 9.3L123.3 187.3 9.3 240C3.6 242.6 0 248.3 0 254.6s3.6 11.9 9.3 14.5l114.1 52.7L176 435.8c2.6 5.7 8.3 9.3 14.5 9.3s11.9-3.6 14.5-9.3l52.7-114.1 114.1-52.7c5.7-2.6 9.3-8.3 9.3-14.5s-3.6-11.9-9.3-14.5L257.8 187.4 205.1 73.3zM384 384l-56.5 21.2c-4.5 1.7-7.5 6-7.5 10.8s3 9.1 7.5 10.8L384 448l21.2 56.5c1.7 4.5 6 7.5 10.8 7.5s9.1-3 10.8-7.5L448 448l56.5-21.2c4.5-1.7 7.5-6 7.5-10.8s-3-9.1-7.5-10.8L448 384l-21.2-56.5c-1.7-4.5-6-7.5-10.8-7.5s-9.1 3-10.8 7.5L384 384z" class="text-white"></path></svg>
						<cm>Upgrade Package</cm>
					</a>
				</div>
			@endif
			{{--@if($customer->featuredProfile==1)--}}
				{{--<div class="text-center border-bottom pb-3">--}}
					{{--<a href="{{route('packages')}}" target="_blank" class="messengerBottomIconBtn LoginToView" title="Upgrade Account">--}}
						{{--<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sparkles" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-sparkles fa-fw fa-xl" style="width: 22px;"><path fill="currentColor" d="M327.5 85.2c-4.5 1.7-7.5 6-7.5 10.8s3 9.1 7.5 10.8L384 128l21.2 56.5c1.7 4.5 6 7.5 10.8 7.5s9.1-3 10.8-7.5L448 128l56.5-21.2c4.5-1.7 7.5-6 7.5-10.8s-3-9.1-7.5-10.8L448 64 426.8 7.5C425.1 3 420.8 0 416 0s-9.1 3-10.8 7.5L384 64 327.5 85.2zM205.1 73.3c-2.6-5.7-8.3-9.3-14.5-9.3s-11.9 3.6-14.5 9.3L123.3 187.3 9.3 240C3.6 242.6 0 248.3 0 254.6s3.6 11.9 9.3 14.5l114.1 52.7L176 435.8c2.6 5.7 8.3 9.3 14.5 9.3s11.9-3.6 14.5-9.3l52.7-114.1 114.1-52.7c5.7-2.6 9.3-8.3 9.3-14.5s-3.6-11.9-9.3-14.5L257.8 187.4 205.1 73.3zM384 384l-56.5 21.2c-4.5 1.7-7.5 6-7.5 10.8s3 9.1 7.5 10.8L384 448l21.2 56.5c1.7 4.5 6 7.5 10.8 7.5s9.1-3 10.8-7.5L448 448l56.5-21.2c4.5-1.7 7.5-6 7.5-10.8s-3-9.1-7.5-10.8L448 384l-21.2-56.5c-1.7-4.5-6-7.5-10.8-7.5s-9.1 3-10.8 7.5L384 384z" class="text-white"></path></svg>--}}
						{{--<cm>Upgrade Package</cm>--}}
					{{--</a>--}}
				{{--</div>--}}
			{{--@else--}}
				{{--<div class="text-center border-bottom pb-3">--}}
					{{--<a href="{{route('packages')}}" target="_blank" class="messengerBottomIconBtn LoginToView" title="Upgrade Account">--}}
						{{--<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sparkles" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-sparkles fa-fw fa-xl" style="width: 22px;"><path fill="currentColor" d="M327.5 85.2c-4.5 1.7-7.5 6-7.5 10.8s3 9.1 7.5 10.8L384 128l21.2 56.5c1.7 4.5 6 7.5 10.8 7.5s9.1-3 10.8-7.5L448 128l56.5-21.2c4.5-1.7 7.5-6 7.5-10.8s-3-9.1-7.5-10.8L448 64 426.8 7.5C425.1 3 420.8 0 416 0s-9.1 3-10.8 7.5L384 64 327.5 85.2zM205.1 73.3c-2.6-5.7-8.3-9.3-14.5-9.3s-11.9 3.6-14.5 9.3L123.3 187.3 9.3 240C3.6 242.6 0 248.3 0 254.6s3.6 11.9 9.3 14.5l114.1 52.7L176 435.8c2.6 5.7 8.3 9.3 14.5 9.3s11.9-3.6 14.5-9.3l52.7-114.1 114.1-52.7c5.7-2.6 9.3-8.3 9.3-14.5s-3.6-11.9-9.3-14.5L257.8 187.4 205.1 73.3zM384 384l-56.5 21.2c-4.5 1.7-7.5 6-7.5 10.8s3 9.1 7.5 10.8L384 448l21.2 56.5c1.7 4.5 6 7.5 10.8 7.5s9.1-3 10.8-7.5L448 448l56.5-21.2c4.5-1.7 7.5-6 7.5-10.8s-3-9.1-7.5-10.8L448 384l-21.2-56.5c-1.7-4.5-6-7.5-10.8-7.5s-9.1 3-10.8 7.5L384 384z" class="text-white"></path></svg>--}}
						{{--<cm>Upgrade Package</cm>--}}
					{{--</a>--}}
				{{--</div>--}}
			{{--@endif--}}

            <div class="row" style="padding:20px; position:relative;">
                <h5 class="edit-profile-side-heading font-size14 text-white"> My Profile Link
                    <span class="badge badge-primary pull-right" style="float:right; cursor:pointer; background-color:#040F2E; padding:14px; position:absolute; right:20px; top:55px; z-index:2;" onclick="copyToClipBoard(this)">Copy</span>
                </h5>
                @php $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'NA').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'NA').'-'.$customer->faker_id; @endphp
                <input type="text" name="user__name"  value="{{route('search.by.slug',[$uniqueProfileSlug])}}" class="form-control">
            </div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-body bg-blast">
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
	<div class="card-body bg-blast">

		<a href="{{route('edit.personal.profile')}}">
			<div class="full-width-tabs bg-blast">
				<i class="fa fa-info-circle"></i>  Edit Personal Profile
			</div>
		</a>
		<a href="{{route('edit.profile')}}">
			<div class="full-width-tabs bg-blast">
				<i class="fa fa-pencil-square-o"></i>  Edit Profile
			</div>
		</a>
		<a href="{{route('edit.photo')}}">
			<div class="full-width-tabs bg-blast">
				<i class="fa fa-picture-o"></i> Gallery
			</div>
		</a>
		<a href="{{route('customer.like.save')}}">
			<div class="full-width-tabs bg-blast">
				<i class="fa fa-heart"></i>  Like / Save
			</div>
		</a>
		<a href="{{route('change.email.password')}}">
			<div class="full-width-tabs bg-blast">
				<i class="fa fa-user"></i>  Change Email / Password
			</div>
		</a>
		<a href="{{route('get.customer.block')}}">
			<div class="full-width-tabs bg-blast">
				<i class="fa fa-ban"></i>  Blocked Users
			</div>
		</a>
		<a href="{{route('contact.us')}}">
			<div class="full-width-tabs bg-blast">
				<i class="fa fa-phone-square"></i>  Contact Us
			</div>
		</a>
		<a onclick="deleteProfile(this,'{{$customer->faker_id}}')" href="javascript:void(0)">
			<div class="full-width-tabs bg-blast">
				<i class="fa fa-minus-circle"></i>  Delete Profile
			</div>
		</a>
	</div>
</div>

{{--<div class="card">--}}
	{{--<div class="card-body bg-blast">--}}
		{{--<div class="col-12" style="padding:20px; position:relative;">--}}
			{{--<h5 class="edit-profile-side-heading font-size14"> My Profile Link--}}
				{{--<span class="badge badge-primary pull-right" style="float:right; cursor:pointer; background-color:#040F2E; padding:14px; position:absolute; right:20px; top:55px; z-index:2;border-radius: 2px;" onclick="copyToClipBoard(this)">Copy</span>--}}
			{{--</h5>--}}
			{{--@php $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'NA').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'NA').'-'.$customer->faker_id; @endphp--}}
			{{--<input type="text" name="user__name"  value="{{route('search.by.slug',[$uniqueProfileSlug])}}" class="form-control">--}}
		{{--</div>--}}
	{{--</div>--}}
{{--</div>--}}