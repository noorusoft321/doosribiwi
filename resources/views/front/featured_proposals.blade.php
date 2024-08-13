@extends('front.layouts.master')

@section('title',$title)
@section('description', 'See best Pakistani & Abroad Proposals (Rishtay) from Pakistan, USA, Canada, UK, Australia, Germany, UAE, KSA. Find your life partner fast and easy.')

@push('style')
	<style>
		.radio-inline__label {
			border: 1px solid #9d2b48;
		}
		.radio-inline__label {
			display: inline-block;
			padding: 0.4rem 0.6rem;
			margin-right: 5px;
			border-radius: 3px;
			transition: all .2s;
		}
		.radio-inline__input:checked + .radio-inline__label {
			background: #9d2b48;
			color: #fff;
			text-shadow: 0 0 1px rgba(0, 0, 0, .7);
		}
		.radio-inline__input {
			visibility: hidden;
		}
		.badge-corner-yellow span {
			top: -50px;
			left: 12px;
		}
		.progress {
			height: 15px;
			border-radius: 10px;
		}
		.z-depth-1-top {
			border-radius: 10px;
			box-shadow: 7px 7px 5px #0000003d;
		}
		.card {
			border-radius: 10px;
			box-shadow: 5px 5px 5px #0000003d;
			border: none;
		}
		.badge-corner3 {
			--f: 10px;
			--r: 15px;
			--t: 10px;
			position: absolute !important;
			inset: var(--t) calc(-1*var(--f)) auto auto !important;
			padding: 0 10px var(--f) calc(10px + var(--r)) !important;
			clip-path: polygon(0 0,100% 0,100% calc(100% - var(--f)),calc(100% - var(--f)) 100%, calc(100% - var(--f)) calc(100% - var(--f)),0 calc(100% - var(--f)), var(--r) calc(50% - var(--f)/2)) !important;
			box-shadow: 0 calc(-1*var(--f)) 0 inset #0005 !important;

		}
		.badge-corner3 span {
			color: #fff;
			font-size: 12px;
			font-weight: 500;
		}
		.card-body {
			padding: 7px;
		}
		.listing-image {
			background-repeat: no-repeat;
			background-position: center;
			background-size: contain;
			border-radius: 3px;
			padding: 0;
			height: 210px !important;
			overflow: hidden;
		}
        .search-box {
            margin-bottom: 0px;
        }
        .active>.page-link, .page-link.active {
            z-index: 3;
            color: #fff;
            background-color: #9B2C47;
            border-color: #9B2C47;
        }
        .page-link {
            color: #9B2C47;
            font-weight: 600;
        }
		.search-box {
			margin-bottom: 2rem;
			border-radius: 20px;
			box-shadow: 0 6px 11px #0000003d;
			border: 5px solid #fff;
			padding: 15px;
			background: #fdf3f4;
		}
		#flag-container {
			height: 50px;
			float: right;
			padding: 5px 10px 5px 10px;
		}
		#flag-container img {
			height: 40px;
		}
		.messenger-icon {
			background: green;
			padding: 7px 11px;
			border-radius: 50%;
			width: 40px;
		}
</style>
@endpush

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">

                <div class="d-grid mx-auto gap-12 mt-2">
					<h1 class="heading-section-3 text-dark text-center mb-0"> Best Pakistani & Abroad Proposals </h1>
					<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-thin-border.png')}}">
				</div>

				<div class="card">
					<div class="card-body" style="padding: 20px;">

						<form id="searchForm">
							<div class="row">

								<div class="col-lg d-sm-block d-xs-block mx-auto my-auto ">
									<div class="mt-3">
										<label for="gender">Gender</label>
										<select name="gender" class="form-control rounded-3">
											<option value="">All</option>
											<option value="1" {{($data['gender']==1) ? 'selected' : ''}}> Male </option>
											<option value="2" {{($data['gender']==2) ? 'selected' : ''}}> Female </option>
										</select>
									</div>
								</div>

								<div class="col-lg d-sm-block d-xs-block mx-auto my-auto ">
									<div class="mt-3">
										<label for="country">Country</label>
										<select name="country" onchange="getStates(this,'state','Any')" class="form-control rounded-3">
											<option value="">Any</option>
											@foreach($countries as $val)
												<option value="{{$val->id}}" {{($data['country']==$val->id) ? 'selected' : ''}}>{{$val->name}}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-lg d-sm-block d-xs-block mx-auto my-auto ">
									<div class="mt-3">
										<label for="state">State</label>
										<select onchange="getCities(this,'city','Any')" name="state" class="form-control rounded-3">
											<option value="">Any</option>
											@foreach($states as $val)
												<option value="{{ $val->id }}" {{($data['state']==$val->id) ? 'selected' : ''}}>{{ $val->title }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-lg d-sm-block d-xs-block mx-auto my-auto ">
									<div class="mt-3">
										<label for="city">City</label>
										<select name="city" class="form-control rounded-3">
											<option value="">Any</option>
											@foreach($cities as $val)
												<option value="{{ $val->id }}" {{($data['city']==$val->id) ? 'selected' : ''}}>{{ $val->title }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-lg d-sm-block d-xs-block mx-auto my-auto ">
									<div class="mt-3">
										<label for="marital_status">Marital Status</label>
										<select name="marital_status" class="form-control rounded-3">
											<option value="">All</option>
											@foreach($maritalStatuses as $val)
												<option value="{{$val->id}}" {{($data['marital_status']==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
											@endforeach
										</select>
									</div>
								</div>

							</div>

							<div class="row">

								<div class="col-lg d-sm-block d-xs-block mx-auto my-auto ">
									<div class="mt-3">
										<label for="age_from">Age From</label>
										<select name="age_from" class="form-control rounded-3">
											<option value="">Any</option>
											@for($i=18; $i<=100; $i++)
												<option value="{{$i}}" {{($data['age_from']==$i) ? 'selected' : ''}}>{{$i}}</option>
											@endfor
										</select>
									</div>
								</div>

								<div class="col-lg d-sm-block d-xs-block mx-auto my-auto ">
									<div class="mt-3">
										<label for="age_to">Age To</label>
										<select name="age_to" class="form-control rounded-3">
											<option value="">Any</option>
											@for($i=18; $i<=100; $i++)
												<option value="{{$i}}" {{($data['age_to']==$i) ? 'selected' : ''}}>{{$i}}</option>
											@endfor
										</select>
									</div>
								</div>

								<div class="col-lg d-sm-block d-xs-block mx-auto my-auto ">
									<div class="mt-3">
										<label for="religion">Religion</label>
										<select name="religion" class="form-control rounded-3">
											<option value="">Any</option>
											@foreach($religions as $val)
												<option value="{{$val->id}}" {{($data['religion']==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-lg d-sm-block d-xs-block mx-auto my-auto ">
									<div class="mt-3">
										<label for="caste">Caste</label>
										<select name="caste" class="form-control rounded-3">
											<option value="">Any</option>
											@foreach($castes as $val)
												<option value="{{$val->id}}" {{($data['caste']==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
											@endforeach
										</select>
									</div>
								</div>

								<input type="hidden" name="page" value="{{(isset($data['page']) && !empty($data['page'])) ? $data['page'] : 1}}">

								<div class="col-lg d-sm-block d-xs-block mx-auto my-auto">
									<div class="align-center" style="margin-top: 38px;">
										<button onclick="customSearch(this)" type="button" class="btn btn-outline-primary font-weight-600 search--btn" style="margin-right: 20px;">Search</button>
										<a type="button" href="{{route('featured.proposals')}}" class="btn btn-outline-primary font-weight-600">Reset</a>
									</div>
								</div>

							</div>
						</form>

					</div>
				</div>

                <br>

                <div class="search-list">
					<div class="row">
						@forelse ($customers as $customer)
							@php $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'NA').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'NA').'-'.$customer->id; @endphp
							<div class="col-md-4 mx-auto d-flex align-items-stretch">
								<strong class="search-box">
									@php
										$customerVerificationStatus = config('services.verification_status.'.$customer->verification_status);
                                        $verificationStatusColor = 'darkgrey';
										if ($customerVerificationStatus=="Verified") {
											$verificationStatusColor = 'green';
										} elseif ($customerVerificationStatus=="Semi Verified") {
											$verificationStatusColor = 'orange';
										}
									@endphp
									@if($customer->featuredProfile==1)
										<a class="badge-corner1 badge-corner-yellow">
											<span>Featured</span>
										</a>
									@endif
									@if(!empty($customer->package_id))
										<a class="badge-corner3" style="z-index:99;background: {{$customer->user_package_color}};">
											<span>{{$customer->user_package}}</span>
										</a>
									@else
										<a class="badge-corner3" style="z-index:99;background: #9b2c47;">
											<span>Free</span>
										</a>
									@endif
									<div class="list z-depth-1-top" id="block_393">
										<div class="block-image">
											<a class="c-base-1" href="{{route('search.by.slug',[$uniqueProfileSlug])}}" style="cursor:pointer; ">
												<div class="listing-image" style="background-image: url({{$customer->imageFullPath}});background-position: top;"></div>
											</a>
										</div>
										<div class="block-title-wrapper">
											<strong>
												<div class="row">
													<div class="col-auto my-auto">
														<h3 class="heading heading-5 strong-500 mt-1">
															<a href="{{route('search.by.slug',[$uniqueProfileSlug])}}" class="c-base-1" style="cursor:pointer;font-weight: 500;">{{$customer->full_name}}</a>
														</h3>
													</div>
													<div class="col my-auto">
														<span id="flag-container" data--country-name="{{(!empty($customer->getCountryName)) ? $customer->getCountryName->name : ''}}"></span>
													</div>
												</div>
												<table class="table-striped table-bordered mb-2" style="font-size: 12px;">
													<tbody>
													<tr>
														<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Age</b></td>
														<td width="120" height="30" style="padding-left: 5px;" class="font-dark">{{$customer->age}} Years old</td>
														<td width="120" height="30" style="padding-left: 5px;"><b>Marital Status</b></td>
														<td width="120" height="30" style="padding-left: 5px;" class="font-dark">
															{{(!empty($customer->getMaritalStatusName)) ? $customer->getMaritalStatusName->name : 'N/A'}}
														</td>
													</tr>
													<tr>
														<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Religion</b></td>
														<td width="120" height="30" style="padding-left: 5px;" class="font-dark">
															{{(!empty($customer->getReligionName)) ? $customer->getReligionName->name : 'N/A'}}
														</td>
														<td width="120" height="30" style="padding-left: 5px;"><b>Caste</b></td>
														<td width="120" height="30" data-sect-id="0" style="padding-left: 5px;" class="font-dark">
															{{(!empty($customer->getCasteName)) ? $customer->getCasteName->name : 'N/A'}}
														</td>
													</tr>
													<tr>
														<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Location</b></td>
														<td height="30" style="padding-left: 5px;" class="font-dark">
															{{(!empty($customer->getCitiesName)) ? $customer->getCitiesName->name : 'N/A'}},
															{{(!empty($customer->getCountryName)) ? $customer->getCountryName->name : 'N/A'}}
														</td>
														<td width="120" height="30" style="padding-left: 5px;"><b>Verification Status</b></td>
														<td width="120" height="30">
															<div style="padding: 8px;margin:7px;background: {{$verificationStatusColor}};border-radius: 100px;text-align: center;">
															<strong style="color:#ffffff;font-weight: 600;">{{$customerVerificationStatus}}</strong>
															</div>
														</td>
													</tr>
													</tbody>
												</table>
											</strong>
											<div class="row mb-2" style="padding: 5px 15px">
												<div class="col my-auto p-0 m-0">
													<a class="custom-btn btn-view-call text-center LoginToView" href="{{route('messenger',[$customer->name])}}" style="margin-top: 7px;padding-top: 5px;"><i class="fa fa-phone text-white"></i></a>
												</div>
												<div class="col my-auto p-0 m-0">
													<button onclick="window.location.href = '{{route('search.by.slug',[$uniqueProfileSlug])}}'" class="custom-btn btn-view-profile" title="View Profile Detail">View Profile</button>
												</div>
											</div>
										</div>
									</div>
								</strong>
							</div>
						@empty
							<div class="col-md-12 text-center">
								<div class="alert alert-danger">
									<span class="text-theme"><b class="text-theme">Info: </b>No Proposals Found.</span>
								</div>
							</div>
						@endforelse
					</div>
				</div>

				<div class="d-flex justify-content-center">
					@if ($customers->hasPages())
						<div class="pagination-wrapper">
							{{ $customers->onEachSide(1)->links() }}
						</div>
					@endif
				</div>

				<br>

			</div>

		</div>
	</div>


@endsection

@push('script')
	<script>
        $(function (){
            $('ul.pagination li a').click(
                function(e) {
                    e.preventDefault();
                    const strArray = this.href.split("?");
                    const pageNumber = strArray[1].replace("page=", "");
                    $('input[name="page"]').val(pageNumber);
                    $('form#searchForm').submit();
                }
            );

            $(".LoginToView").on('click', function(e) {
                if (!authCheckGlobally) {
                    checkAuthLoginMessage();
                    return false;
                }
            });

            // https://restcountries.com/v3.1/name/
            // https://restcountries.com/v2/name/
            $("span[id='flag-container']").each( async function() {
                let countryName = $(this).attr('data--country-name');
                let countryFlag = null;
				if (countryName) {
                    await $.getJSON(`https://restcountries.com/v3.1/name/${countryName}`, function(data) {
                        let index = (data.length > 0) ? data.length - 1 : 0;
                        if (data[index].flags.svg) {
                            countryFlag = `<img src="${data[index].flags.svg}"  alt="Flag of ${countryName}">`;
                        }
                    });
				}
                $(this).html(countryFlag);
            });

            $(window).resize(function() {
                if ($(window).width() < 600) {
                    $('ul.pagination').addClass('pagination-sm');
				} else {
                    $('ul.pagination').removeClass('pagination-sm');
				}
			});

        });
        
        function customSearch(input) {
			$(input).attr('disabled',true);
            $('input[name="page"]').val(1);
            $('form#searchForm').submit();
        }
	</script>
@endpush