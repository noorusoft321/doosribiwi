@extends('front.layouts.master')
@section('title','Notification Preferences')
@section('description', 'Notification Preferences | Doosri Biwi')

@push('style')
	<style>
		.radio-inline__label {
			border: 1px solid #040F2E;
		}
		.radio-inline__label {
			display: inline-block;
			padding: 0.5rem 1rem;
			margin-right: 18px;
			border-radius: 3px;
			transition: all .2s;
		}
		.radio-inline__input:checked + .radio-inline__label {
			background: #040F2E;
			color: #fff;
			text-shadow: 0 0 1px rgba(0, 0, 0, .7);
		}
		.radio-inline__input {
			visibility: hidden;
		}
	</style>
@endpush

@section('content')

<main>
	<div class="dashboard">
		<div class="container">
			<div class="row">
				<div class="col-md-3 side-bar-dashboard">
					@include('front.customer.partials.sidebar')
				</div>
				<div class="col-md-9 main-dashboard">
					<div class="card">
						<h5 class="card-header">{{$title}}</h5>
						<div class="card-body">
							<form id="customerInfoForm">
								<div class="inner-div">
									<h4> General Preferences </h4>
									<p>Change general options here, such as whether your profile is live or hidden.</p>
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<label class="fieldlabels"> Profile Status</label>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<fieldset>
												<input id="item-1" class="radio-inline__input radioBtn" type="radio" name="profileStatus" value="1"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->profileStatus==1) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="item-1" style="cursor:pointer;">Live</label>
												<input id="item-2" class="radio-inline__input radioBtn" type="radio" name="profileStatus" value="0"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->profileStatus==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="item-2" style="cursor:pointer;">
													Hidden </label>
											</fieldset>
										</div>

										<hr class="edit-profile-hr">

										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<label class="fieldlabels"> Show Picture(s) Guidelines</label>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<fieldset>
												<input id="show-1" class="radio-inline__input radioBtn" type="radio" name="showPictureGuidelines" value="1"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->showPictureGuidelines==1) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="show-1" style="cursor:pointer;">
													Show
												</label>
												<input id="show-2" class="radio-inline__input radioBtn" type="radio" name="showPictureGuidelines" value="0"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->showPictureGuidelines==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="show-2" style="cursor:pointer;">
													Hide
												</label>
											</fieldset>
										</div>

										<hr class="edit-profile-hr">

										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<label class="fieldlabels"> Show Profile Picture</label>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<fieldset>
												<input id="showProfilePicture-1" class="radio-inline__input radioBtn" type="radio" name="showProfilePicture" value="1"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->showProfilePicture==1) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="showProfilePicture-1" style="cursor:pointer;">
													Show
												</label>
												<input id="showProfilePicture-2" class="radio-inline__input radioBtn" type="radio" name="showProfilePicture" value="0"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->showProfilePicture==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="showProfilePicture-2" style="cursor:pointer;">
													Hide
												</label>
											</fieldset>
										</div>
									</div>
								</div>

								<hr class="edit-profile-hr">

								<div class="inner-div">
									<h4> Notifications </h4>
									<p>Change your Single Muslim notifications such as which emails and alerts ( Mobile App )
										you receive and how often you receive these.</p>
									<div class="row">

										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<label class="fieldlabels"> Someone views your profile (Alerts Only)</label>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<fieldset>
												<input id="views-1" class="radio-inline__input radioBtn" type="radio" name="someOneViewsYourProfile" value="1"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->someOneViewsYourProfile==1) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="views-1" style="cursor:pointer;">
													Yes
												</label>
												<input id="views-2" class="radio-inline__input radioBtn" type="radio" name="someOneViewsYourProfile" value="0"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->someOneViewsYourProfile==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="views-2" style="cursor:pointer;">
													No
												</label>
											</fieldset>
										</div>

										<hr class="edit-profile-hr">

										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<label class="fieldlabels"> A favourite user is online (Alert Only) </label>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<fieldset>
												<input id="user-1" class="radio-inline__input radioBtn" type="radio" name="aFavouriteUserIsOnline" value="1"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->aFavouriteUserIsOnline==1) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="user-1" style="cursor:pointer;">
													Yes
												</label>
												<input id="user-2" class="radio-inline__input radioBtn" type="radio" name="aFavouriteUserIsOnline" value="0"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->aFavouriteUserIsOnline==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="user-2" style="cursor:pointer;">
													No
												</label>
											</fieldset>
										</div>

										<hr class="edit-profile-hr">

										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<label class="fieldlabels"> Profile is approved </label>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<fieldset>
												<input id="profile-1" class="radio-inline__input radioBtn" type="radio" name="profileIsApproved" value="1"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->profileIsApproved==1) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="profile-1" style="cursor:pointer;">
													Yes
												</label>
												<input id="profile-2" class="radio-inline__input radioBtn" type="radio" name="profileIsApproved" value="0"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->profileIsApproved==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="profile-2" style="cursor:pointer;">
													No
												</label>
											</fieldset>
										</div>

										<hr class="edit-profile-hr">

										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<label class="fieldlabels"> Picture(s) are approved </label>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<fieldset>
												<input id="approved-1" class="radio-inline__input radioBtn" type="radio" name="pictureAreApproved" value="1"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->pictureAreApproved==1) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="approved-1" style="cursor:pointer;">
													Yes
												</label>
												<input id="approved-2" class="radio-inline__input radioBtn" type="radio" name="pictureAreApproved" value="0"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->pictureAreApproved==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="approved-2" style="cursor:pointer;">
													No
												</label>
											</fieldset>
										</div>

										<hr class="edit-profile-hr">

										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<label class="fieldlabels"> New messages </label>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<select class="selectBox form-select select-icon icon-mark form-control rounded-pill" name="newMesssages" id="inputEmailaddress">
												<option value="">Select</option>
												<option value="1"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->newMesssages==1) ? 'selected' : ''}}>
													Summary, once per day
												</option>
												<option value="2"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->newMesssages==2) ? 'selected' : ''}}>
													Summary, once per Week
												</option>
												<option value="3"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->newMesssages==3) ? 'selected' : ''}}>
													Summary, once per month
												</option>
												<option value="4"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->newMesssages==4) ? 'selected' : ''}}>
													Never
												</option>
											</select>
										</div>

										<hr class="edit-profile-hr">

										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<label class="fieldlabels"> New Search Matches </label>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<select class="selectBox form-select select-icon icon-mark form-control rounded-pill" name="newSearchMatches" id="inputEmailaddress">
												<option value="">Select</option>
												<option value="1"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->newSearchMatches==1) ? 'selected' : ''}}>
													Summary, once per day
												</option>
												<option value="2"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->newSearchMatches==2) ? 'selected' : ''}}>
													Summary, once per week
												</option>
												<option value="3"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->newSearchMatches==3) ? 'selected' : ''}}>
													Summary, once per month
												</option>
												<option value="4"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->newSearchMatches==4) ? 'selected' : ''}}>
													Never
												</option>
												<option value="5"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->newSearchMatches==5) ? 'selected' : ''}}>
													Every Time I receive a new message
												</option>
											</select>
										</div>

										<hr class="edit-profile-hr">

										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<label class="fieldlabels"> Private gallery requests approved/declined </label>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<fieldset>
												<input id="requests-1" class="radio-inline__input radioBtn" type="radio" name="privateGalleryRequestsApprovedDeclined" value="1"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->test==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="requests-1" style="cursor:pointer;">
													Yes
												</label>
												<input id="requests-2" class="radio-inline__input radioBtn" type="radio" name="privateGalleryRequestsApprovedDeclined" value="0"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->test==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="requests-2" style="cursor:pointer;">
													No
												</label>
											</fieldset>
										</div>

										<hr class="edit-profile-hr">

										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<label class="fieldlabels" style="cursor:pointer;"> Someone Likes You (Alert
												Only) </label>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<fieldset>
												<input id="likes-1" class="radio-inline__input radioBtn" type="radio" name="someoneLikesYou" value="1"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->test==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="likes-1" style="cursor:pointer;">
													Yes
												</label>
												<input id="likes-2" class="radio-inline__input radioBtn" type="radio" name="someoneLikesYou" value="0"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->test==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="likes-2" style="cursor:pointer;">
													No
												</label>
											</fieldset>
										</div>

										<hr class="edit-profile-hr">

										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<label class="fieldlabels" style="cursor:pointer;"> Someone Matched With
												You </label>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<fieldset>
												<input id="matched-1" class="radio-inline__input radioBtn" type="radio" name="someoneMatchedWithYou" value="1"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->test==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="matched-1" style="cursor:pointer;">
													Yes
												</label>
												<input id="matched-2" class="radio-inline__input radioBtn" type="radio" name="someoneMatchedWithYou" value="0"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->test==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="matched-2" style="cursor:pointer;">
													No
												</label>
											</fieldset>
										</div>

										<hr class="edit-profile-hr">

										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<label class="fieldlabels" style="cursor:pointer;"> See your
												recommendations </label>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<fieldset>
												<input id="recommendations-1" class="radio-inline__input radioBtn" type="radio" name="seeYourRecommendations" value="1"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->test==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="recommendations-1" style="cursor:pointer;">
													Yes
												</label>
												<input id="recommendations-2" class="radio-inline__input radioBtn" type="radio" name="seeYourRecommendations" value="0"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->test==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="recommendations-2" style="cursor:pointer;">
													No
												</label>
											</fieldset>
										</div>

										<hr class="edit-profile-hr">

										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<label class="fieldlabels" style="cursor:pointer;"> Email Opt-in </label>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 py-xl-10">
											<fieldset>
												<input id="email-1" class="radio-inline__input radioBtn" type="radio" name="emailOptIn" value="1"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->test==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="email-1" style="cursor:pointer;">
													Yes
												</label>
												<input id="email-2" class="radio-inline__input radioBtn" type="radio" name="emailOptIn" value="0"
														{{(!empty($customer->customerNotificationPreference) && $customer->customerNotificationPreference->test==0) ? 'checked' : ''}}>
												<label class="radio-inline__label" for="email-2" style="cursor:pointer;">
													No
												</label>
											</fieldset>
										</div>

										<div class="col-12 text-end">
											<button onclick="saveRecord(this)" type="button" class="btn btn-outline-primary font-weight-600">Update</button>
										</div>

									</div>
								</div>
							</form>
						</div>
					</div>
				</div>		
			</div>
		</div>
	</div>
</main>

@endsection

@push('script')
	<script>
        function saveRecord(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('save.notification.preferences')}}", $('#customerInfoForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#customerInfoForm :input[name="' + k + '"]').addClass("has-error");
                        $('#customerInfoForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }
	</script>
@endpush