@extends('front.layouts.master')
@section('title',$title)
@section('description', $title)

@push('style')
	<style>
		.btn-outline-primary i {
			color: #082f49!important;
		}
		.btn-outline-primary:hover i {
			color: #ffffff!important;
		}
		.btn-outline-primary.btn-active, .btn-outline-primary.btn-active:hover, .btn-outline-primary.btn-active i {
            background-image: linear-gradient(to left, #075385 0%, #0c476e 100%) !important;
			color: #ffffff!important;
		}
		.card-header {
			text-transform: uppercase;
		}
		.profile-section {
			width: 100%;
			margin-bottom:20px;
			height: 320px;
			background: #040F2E;
		}
		.profile-section img {
			width: 100%;
			object-fit: fill;
			height: 320px;
			border-radius: 100% 0% 100% 0% / 7% 0% 7% 0%;
		}
	</style>
@endpush

@section('content')

	<main>
		<div class="dashboard">
			<div class="container">
				<div class="row">
					<div class="col-md-3 side-bar-dashboard">
						<div class="card">
							<div class="card-body">
								<div>
									<div class="profile-section">
										<img src="{{$customer->imageFullPath}}">
									</div>
									<h3 class="align-center profile-name" style="line-height: 1;">{{$customer->full_name}}</h3>
									<p class="align-center profile-occupation text-theme">
										{{(!empty($customer->customerOtherInfo) && $customer->customerOtherInfo->OccupationID > 0 && $customer->customerOtherInfo->OccupationID!=243) ? genericQuery($customer->customerOtherInfo->OccupationID,'Occupation') : ''}}
									</p>
								</div>

								@if($customer->profile_gallery_client_status==1 && count($customerImages) > 0)
									<div class="card">
										<div class="container gallery-container">
											<div class="tz-gallery">
												<h4 class="align-center text-theme">Gallery Photos</h4>
												<div class="row justify-content-center">
													@foreach($customerImages as $key => $val)
														@if(file_exists(public_path('customer-images/'.$val->image)))
															<div class="col-sm-6 col-md-4">
																<a class="lightbox" href="{{asset('customer-images/'.$val->image)}}">
																	<img src="{{asset('customer-images/'.$val->image)}}" alt="Gallery {{$key + 1}}" width="100" height="100">
																</a>
															</div>
														@endif
													@endforeach
												</div>
											</div>
										</div>
									</div>
								@endif

								<div class="container">
									<div class="row">
										<div class="col-md-6 m-tb-10">
											<a href="javascript:void(0);" class="btn btn-outline-primary btn-sm full-width"> <i class="fa fa-eye"></i> {{$profileViewsCount}} Views</a>
										</div>
										<div class="col-md-6 m-tb-10">
											<a onclick="likeUnlikeCustomer(this)" href="javascript:void(0);" class="btn btn-outline-primary btn-sm full-width {{(!empty($customerLikedByMe)) ? 'btn-active' : ''}}"> <i class="fa fa-heart"></i> {{$profileLikesCount}} Like</a>
										</div>
										<div class="col-md-6 m-tb-10">
											<a onclick="saveUnsavedCustomer(this)" href="javascript:void(0);" class="btn btn-outline-primary btn-sm full-width {{(!empty($customerSaveByMe)) ? 'btn-active' : ''}}">  <i class="fa fa-floppy-o"></i> {{$profileSavesCount}} Save</a>
										</div>
										<div class="col-md-6 m-tb-10">
											<a href="{{route('messenger',[$customer->name])}}" class="btn btn-outline-primary btn-sm full-width LoginToView"> <i class="fa fa-comments"></i> Messages</a>
										</div>
									</div>

									<h4 class="align-center text-theme mt-2">Profile Verification Status</h4>

									<ul class="verification-badge">
										<li>
											<img src="{{asset('customer-verification/age-'.($customer->age_verification==1 ? 'on' : 'off').'.png')}}" title="Age Verification">
										</li>
										<li>
											<img src="{{asset('customer-verification/edu-'.($customer->education_verification==1 ? 'on' : 'off').'.png')}}" title="Education Verification">
										</li>
										<li>
											<img src="{{asset('customer-verification/email-'.($customer->email_verified==1 ? 'on' : 'off').'.png')}}" title="Email Verification">
										</li>
										<li>
											<img src="{{asset('customer-verification/location-'.($customer->location_verification==1 ? 'on' : 'off').'.png')}}" title="Location Verification">
										</li>
										<li>
											<img src="{{asset('customer-verification/meeting-'.($customer->meeting_verification==1 ? 'on' : 'off').'.png')}}" title="Meeting Verification">
										</li>
										<li>
											<img src="{{asset('customer-verification/nationality-'.($customer->nationality_verification==1 ? 'on' : 'off').'.png')}}" title="Nationality Verification">
										</li>
										<li>
											<img src="{{asset('customer-verification/phone-'.($customer->mobile_verified==1 ? 'on' : 'off').'.png')}}" title="Phone Verification">
										</li>
										<li>
											<img src="{{asset('customer-verification/pic-'.($customer->profile_pic_status==1 ? 'on' : 'off').'.png')}}" title="Picture Verification">
										</li>
										<li>
											<img src="{{asset('customer-verification/salary-'.($customer->salary_verification==1 ? 'on' : 'off').'.png')}}" title="Salary Verification">
										</li>
									</ul>

									<div class="profile-side-details">
										<div class="row">
											<div class="col-6">
												<a onclick="reportBlockModal(this,'report')" class="link-text" href="javascript:void(0)">
													<i class="fas fa-solid fa-house-user" aria-hidden="true" style="color: #082f49;"></i> Report
												</a>
											</div>
											<div class="col-6">
												<a onclick="reportBlockModal(this,'block')" class="link-text" href="javascript:void(0)">
													<i class="fas fa-solid fa-house-user" aria-hidden="true" style="color: #082f49;"></i> {{(!empty($customerBlockByMe)) ? 'Unblock' : 'Block'}}
												</a>
											</div>
											<hr class="edit-profile-hr2">

											<div class="col-12" style="padding:20px; position:relative;">
												<h5 class="edit-profile-side-heading font-size14"> Profile Link
													<span class="badge badge-primary pull-right" style="float: right;cursor: pointer;background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);padding: 10px;     position: absolute; right: 24px;top: 59px;z-index: 2;" onclick="copyToClipBoard(this)">Copy</span>
												</h5>
												@php $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'NA').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'NA').'-'.$customer->faker_id; @endphp
												<input type="text" name="user__name"  value="{{route('search.by.slug',[$uniqueProfileSlug])}}" class="form-control">
											</div>
										</div>
									</div>
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
										<h5 class="card-header">Expectations</h5>
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
            $(input).attr('disabled',false);
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