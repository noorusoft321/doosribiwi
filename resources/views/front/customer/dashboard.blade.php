@extends('front.layouts.master')
@section('title',$title)
@section('description', $title)

@push('style')
	<style>
		.job-card-grid {
			position: relative;
			background-color: #FFFFFF;
			padding: 40px 30px;
			border-radius: 18px;
			-webkit-box-shadow: 0px 2px 28px 0px rgba(62, 53, 120, 0.04);
			box-shadow: 0px 2px 28px 0px rgba(62, 53, 120, 0.04);
			-webkit-transition: 0.25s ease-in-out;
			transition: 0.25s ease-in-out
		}

		.job-card-grid:hover {
			-webkit-box-shadow: 0px 19px 29px rgba(62, 53, 120, 0.14);
			box-shadow: 0px 19px 29px rgba(62, 53, 120, 0.14)
		}

		.job-card-grid .job-info {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			-webkit-box-orient: vertical;
			-webkit-box-direction: normal;
			-ms-flex-direction: column;
			flex-direction: column;
			margin-bottom: 40px
		}

		.job-card-grid .job-info .job-image {
			margin-bottom: 20px
		}

		.job-card-grid .job-info .job-image img {
			width: 115px;
			height: 115px;
			border-radius: 50rem
		}

		.job-card-grid .job-info .job-title {
			font-size: 1.25rem;
			font-weight: 600;
			margin-bottom: 14px;
			text-align: center
		}

		.job-card-grid .job-info .job-title a {
			color: #363848;
			text-decoration: none
		}

		.job-card-grid .job-info .job-author {
			font-size: 1rem;
			font-weight: 400;
			text-align: center
		}

		.job-card-grid .job-info .job-author a {
			color: #082f49;
			text-decoration: none
		}

		.job-card-grid .job-detail {
			list-style: none;
			padding-left: 0;
			margin-bottom: 0
		}

		.job-card-grid .job-detail .job-detail-item {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			-webkit-box-pack: justify;
			-ms-flex-pack: justify;
			justify-content: space-between
		}

		.job-card-grid .job-detail .job-detail-item:not(:first-child) {
			margin-top: 18px
		}

		.job-card-grid .job-detail .job-detail-item .svg-icon {
			color: #A9A9A9;
			width: 24px;
			height: 24px
		}

		.job-card-grid .job-detail .job-detail-item .job-detail-first {
			text-align: left
		}

		.job-card-grid .job-detail .job-detail-item .job-detail-center {
			text-align: center
		}

		.job-card-grid .job-detail .job-detail-item .job-detail-center .job-detail-text {
			font-size: 0.9375rem;
			font-weight: 500;
			color: #2E2E2E
		}

		.job-card-grid .job-detail .job-detail-item .job-detail-end {
			text-align: right
		}

		.job-card-grid .job-detail .job-detail-item .job-detail-end .job-detail-text {
			font-size: 0.9375rem;
			font-weight: 400;
			color: #A9A9A9
		}

		.job-card-grid .job-action {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			margin-top: 40px
		}

		.job-card-grid .job-action .btn.btn-apply {
			width: 100%;
			margin-left: 15px
		}

		.job-card-grid .job-action .btn:hover {
			-webkit-box-shadow: none;
			box-shadow: none
		}

		.job-card-grid .job-dropdown {
			position: absolute;
			top: 40px;
			right: 30px
		}

		.job-card-grid .job-dropdown .job-dropdown-btn {
			display: -webkit-inline-box;
			display: -ms-inline-flexbox;
			display: inline-flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			background-color: transparent;
			color: #363848;
			border: 0;
			padding: 0;
			padding-bottom: 10px
		}

		.job-card-grid .job-dropdown .dropdown-menu {
			border: 0;
			border-radius: 5px;
			-webkit-box-shadow: 0px 19px 29px rgba(62, 53, 120, 0.14);
			box-shadow: 0px 19px 29px rgba(62, 53, 120, 0.14)
		}

		.job-card-grid .job-dropdown .dropdown-menu .dropdown-item {
			font-size: 0.875rem;
			font-weight: 400;
			color: #363848;
			padding: 5px 20px
		}

		.job-card-grid .job-dropdown .dropdown-menu .dropdown-item:hover {
			background-color: #F0EEFF;
			color: #082f49
		}

		.job-card-harizontal {
			position: relative;
			display: -ms-grid;
			display: grid;
			background-color: #FFFFFF;
			padding: 20px 20px;
			border-radius: 18px;
			-webkit-box-shadow: 0px 7px 22px rgba(143, 134, 196, 0.07);
			box-shadow: 0px 7px 22px rgba(143, 134, 196, 0.07);
			-webkit-transition: -webkit-box-shadow 0.25s ease-in-out;
			transition: -webkit-box-shadow 0.25s ease-in-out;
			transition: box-shadow 0.25s ease-in-out;
			transition: box-shadow 0.25s ease-in-out, -webkit-box-shadow 0.25s ease-in-out
		}

		.job-card-harizontal:hover {
			-webkit-box-shadow: 0px 19px 29px rgba(62, 53, 120, 0.14);
			box-shadow: 0px 19px 29px rgba(62, 53, 120, 0.14)
		}

		.job-card-harizontal .job-info {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center
		}

		.job-card-harizontal .job-info .job-image {
			margin-right: 20px
		}

		.job-card-harizontal .job-info .job-image img {
			width: 60px;
			height: 60px;
			-o-object-fit: cover;
			object-fit: cover;
			-o-object-position: center;
			object-position: center;
			border-radius: 15px
		}

		.job-card-harizontal .job-info .job-info-inner {
			display: -ms-grid;
			display: grid;
			gap: 10px
		}

		.job-card-harizontal .job-info .job-info-inner .job-title {
			font-size: 1rem;
			font-weight: 600;
			margin-bottom: 0
		}

		.job-card-harizontal .job-info .job-info-inner .job-title a {
			color: #082f49;
			text-decoration: none
		}

		.job-card-harizontal .job-info .job-info-inner .job-author {
			font-size: 0.9375rem;
			font-weight: 500
		}

		.job-card-harizontal .job-info .job-info-inner .job-author a {
			color: #082f49;
			text-decoration: none
		}

		.job-card-harizontal .job-info-card-collapse .job-info-card {
			display: -ms-grid;
			display: grid;
			gap: 15px
		}

		.job-card-harizontal .job-info-card-collapse .job-info-card .info-card {
			-webkit-box-flex: 1;
			-ms-flex: 1 1 50%;
			flex: 1 1 50%
		}

		.job-card-harizontal .job-action {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			gap: 15px
		}
		.job-card-harizontal .job-action .btn:hover {
			-webkit-box-shadow: none;
			box-shadow: none
		}
		.profileWrp {
			position: relative;
		}
		.matchprofiles {
			position: absolute;
			line-height: 1;
			border: 2px dotted #fff;
			padding: 0px;
			font-size: 10px;
			border-radius: 78px;
			color: white;
			background: #e62e04;
			text-align: center;
			margin-top: 0px;
			padding-top: 12px;
			width: 50px;
			height: 50px;
			z-index: 2;
		}
		.progress {
			height: 15px;
			border-radius: 10px;
		}

		@media (max-width: 767.98px) {
			.job-card-harizontal .job-action {
				margin-top: 15px
			}
		}

		@media (min-width: 768px) and (max-width: 1199.98px) {
			.job-card-harizontal .job-action {
				margin-left: auto
			}
		}

		@media (min-width: 1200px) {
			.job-card-harizontal .job-action {
				-webkit-box-pack: end;
				-ms-flex-pack: end;
				justify-content: end;
				-webkit-box-flex: 1;
				-ms-flex: 1 1 30%;
				flex: 1 1 30%
			}
		}

		@media (max-width: 1199.98px) {
			.job-card-harizontal .job-info-card-collapse .job-info-card {
				margin-top: 20px
			}
		}

		@media (min-width: 1200px) {
			.job-card-harizontal .job-info-card-collapse .job-info-card {
				display: -webkit-box;
				display: -ms-flexbox;
				display: flex;
				width: 100%;
				gap: 20px
			}
		}
		@media (max-width: 1199.98px) {
			.job-card-harizontal .job-info-card-collapse {
				width: 100%;
				-webkit-box-ordinal-group: 4;
				-ms-flex-order: 3;
				order: 3
			}
		}

		@media (min-width: 1200px) {
			.job-card-harizontal .job-info-card-collapse {
				display: -webkit-box;
				display: -ms-flexbox;
				display: flex;
				-ms-flex-preferred-size: auto;
				flex-basis: auto;
				-webkit-box-flex: 1;
				-ms-flex: 1 1 40%;
				flex: 1 1 40%
			}
		}
		@media (min-width: 1200px) {
			.job-card-harizontal .job-info {
				-webkit-box-flex: 1;
				-ms-flex: 1 1 30%;
				flex: 1 1 30%
			}
		}
		@media (min-width: 768px) {
			.job-card-harizontal {
				display: -webkit-box;
				display: -ms-flexbox;
				display: flex;
				-ms-flex-wrap: wrap;
				flex-wrap: wrap
			}
		}

		@media (min-width: 1200px) {
			.job-card-harizontal {
				-webkit-box-pack: justify;
				-ms-flex-pack: justify;
				justify-content: space-between
			}
		}
		@media (min-width: 1200px) {
			.job-card-grid .job-detail .job-detail-item .job-detail-center {
				margin-left: 10px;
				margin-right: 10px
			}
		}
		/*.button-theme-dark {*/
			/*padding: 7px 30px;*/
		/*}*/
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
					@if(session()->has('error_message'))
						<div class="alert alert-secondary dark alert-dismissible fade show" role="alert"><strong>Info
								! </strong> {{session()->get('error_message')}}.
							<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
							></button>
						</div>
					@endif

					@if(session()->has('success_message'))
						<div class="alert alert-success dark alert-success fade show" role="alert"><strong>Success
								! </strong> {{session()->get('success_message')}}.
							<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
							></button>
						</div>
					@endif
					@if($customer->profile_pic_status==2)
						<div class="card">
							<h5 class="card-header bg-blast">Warning !</h5>
							<div class="card-body">
								<div class="d-grid gap-34">
									<div class="job-card-harizontal">
										<div class="row">
											<div class="col-md-2 mx-auto my-auto">
												@if(file_exists(public_path('customer-images/'.$customer->image)))
													<a target="_blank" href="{{asset('customer-images/'.$customer->image)}}"><img src="{{asset('customer-images/'.$customer->image)}}" class="rounded-circle" alt="{{$customer->full_name}}" width="100%"></a>
												@else
													<a target="_blank" href="{{$customer->imageFullPath}}"><img src="{{$customer->imageFullPath}}" class="rounded-circle" alt="{{$customer->full_name}}" width="100%"></a>
												@endif
											</div>
											<div class="col-md-10 mx-auto my-auto">
												<div class="alert alert-danger">
													<p class="text-danger">
														<strong class="h2" style="color: #082f49 !important;">! </strong>
														Your profile picture has been rejected, please updated your profile picture.
														<a href="{{route('edit.photo')}}" class="button-theme-dark float-end">Upload</a>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endif

					<div class="card">
						<h5 class="card-header bg-blast">Unread Messages</h5>
						<div class="card-body">
							@forelse($newMessages as $val)
								<div class="d-grid gap-34 mb-1" style="box-shadow: 0 3px 5px rgba(0,0,0,0.3);border-radius: 10px;">
									<div class="job-card-harizontal">
										<div class="job-info">
											<div class="job-image">
												<img src="{{$val->getSenderCustomer->imageFullPath}}" alt="{{$val->getSenderCustomer->full_name}}" width="100">
											</div>
											<div class="job-info-inner">
												<h5 class="job-title">
													<a href="{{route('messenger',[$val->getSenderCustomer->faker_id])}}">{{$val->getSenderCustomer->full_name}}</a>
												</h5>
												<div class="job-author" style="color: #a8a8a8;font-weight: normal;">
													@if(strlen($val->message) > 20)
														{{substr($val->message, 0, 20)}}...<a class="font-weight-500" href="{{route('messenger',[$val->getSenderCustomer->faker_id])}}">Read More</a>
													@else
														{{$val->message}}
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							@empty
								<div class="d-grid gap-34">
									<div class="job-card-harizontal">
										<div class="alert alert-danger mx-auto">No new message.!</div>
									</div>
								</div>
							@endforelse
						</div>
						<div class="align-center p-tb-10">
							<a href="{{route('messenger')}}" class="button-theme-dark"> View More </a>
						</div>
						<br>
					</div>

					<div class="card">
						{{--<h5 class="card-header bg-blast">Latest Proposals</h5>--}}
						<h5 class="card-header bg-blast">Recommended for You</h5>
						<div class="card-body">
							<div class="row p-tb-10">
								@foreach($customersVerified as $val)
									@php
                                        $uniqueProfileSlug = $val->gender_name.'-proposal-'.(!empty($val->getCitySlug)?$val->getCitySlug->slug:'na').'-'.(!empty($val->getCountrySlug)?$val->getCountrySlug->slug:'na').'-'.$val->id;
                                        $customerMatchesPercentage = customerMatchesPercentage($val);
                                    @endphp
									<div class="col-md-3">
										<div class="profileWrp">
                                            <span class="matchprofiles">{{$customerMatchesPercentage}}%<br>Match</span>
                                            <div class="profileImg">
												<a class="LoginToView" href="{{route('search.by.slug',[$uniqueProfileSlug])}}">
													<img src="{{$val->imageFullPath}}" data-image-name="user-image" alt="{{$val->full_name}}" title="{{$val->full_name}}">
												</a>
											</div>
											<div class="profile-detail" style="padding: 0px; border-radius: 0px 0px 8px 8px;">
												<div class="name" style="font-size: 15px; text-align: center;">
													<a class="LoginToView">
														<div class="profile-details">
															<p>{{$val->full_name}}</p>
														</div>
													</a>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
						<div class="align-center p-tb-10">
							<a href="{{route('search.by.slug',['my-matches'])}}" class="button-theme-dark"> View More </a>
						</div>
						<br>
					</div>
				</div>		
			</div>
		</div>
	</div>
</main>

@endsection

@push('script')
	{{--Script--}}
@endpush