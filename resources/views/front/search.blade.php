@php
	$verified = false;
	$featured = false;
	$secondMarriage = false;
	$gender = '';
	$ageFrom = '';
	$ageTo = '';
	$country = '';
	$state = '';
	$city = '';
	$religion = '';
	$myIncome = '';
	if (!empty($slug)) {
		if ($slug=='verified-proposals') {
			$verified = true;
		}
		if ($slug=='featured-proposals') {
			$featured = true;
		}
		if ($slug=='elite-proposals') {
			$myIncome = 833;
		}
		/*if ($slug=='usa-proposals') {
			$country = 226;
		}
		if ($slug=='canada-proposals') {
			$country = 38;
		}
		if ($slug=='uk-proposals') {
			$country = 225;
		}
		if ($slug=='australia-proposals') {
			$country = 13;
		}
		if ($slug=='saudia-proposals') {
			$country = 187;
		}
		if ($slug=='uae-proposals') {
			$country = 224;
		}
		if ($slug=='france-italy-spain-germany-proposals') {
			$country = 73;
		}
		if ($slug=='oman-qatar-bahrain-kuwait-malaysia-proposals') {
			$country = 161;
		}*/
		if (in_array($slug,[
			'females-Ready-for-second-marriage',
			'males-Looking-for-second-Wife'
		])) {
			$secondMarriage = true;
		}
		if (in_array($slug,[
			'males-Looking-for-second-Wife',
			'male-proposals-karachi',
			'male-proposals-Lahore',
			'male-proposals-faisalabad',
			'male-proposals-islamabad-Rawalpindi',
			'male-rishta'
		])) {
			$gender = 1;
		}
		if (in_array($slug,[
			'females-Ready-for-second-marriage',
			'female-proposals-karachi',
			'female-proposals-Lahore',
			'female-proposals-faisalabad',
			'female-proposals-islamabad-Rawalpindi'
		])) {
			$gender = 2;
		}
		/*if (in_array($slug,[
			'female-proposals-karachi',
			'male-proposals-karachi',
		])) {
			$city = 551;
		}*/
		/*if (in_array($slug,[
			'female-proposals-Lahore',
			'male-proposals-Lahore',
		])) {
			$city = 1;
		}*/
		/*if (in_array($slug,[
			'female-proposals-faisalabad',
			'male-proposals-faisalabad',
		])) {
			$city = 591;
		}*/

		/*if (in_array($slug,[
			'female-proposals-islamabad-Rawalpindi',
			'male-proposals-islamabad-Rawalpindi',
		])) {
			$city = 592;
		}*/

		/*if (!empty($city)) {
			$country = 162;
			$cities = getRelatedCities($city);
		}*/

		if ($slug=='my-matches' && !empty($customerSearch)) {
			$gender = $customerSearch->gender;
			$ageFrom = $customerSearch->ageFrom;
			$ageTo = $customerSearch->ageTo;
			$country = $customerSearch->country_id;
			$state = $customerSearch->state_id;
			$city = $customerSearch->city_id;
			$religion = $customerSearch->Religions;
		}
	}
	$pageTitle = (!empty($slug)) ? makeSlugToTitle($slug) : 'Search';
	if (empty($gender) && auth()->guard('customer')->check() && isset(auth()->guard('customer')->user()->gender_name)) {
		$gender = (auth()->guard('customer')->user()->gender_name=='male') ? 2 : 1;
	}
@endphp

@extends('front.layouts.master')

@section('title','Proposals for Second Marriages')
@section('description', 'Find your ideal match through our search feature. Discover the beauty of Islamic second marriages on our proposal page.')

@push('style')
	<style>
		.radio-inline__label {
			border: 1px solid #0c476e;
		}
		.radio-inline__label {
			display: inline-block;
			padding: 0.4rem 0.6rem;
			margin-right: 5px;
			border-radius: 3px;
			transition: all .2s;
		}
		.radio-inline__input:checked + .radio-inline__label {
			/*background: #040F2E;*/
			background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);
			color: #fff;
			text-shadow: 0 0 1px rgba(0, 0, 0, .7);
		}
		.radio-inline__input {
			visibility: hidden;
		}
		.badge-corner-yellow span {
			top: -50px;
			left: 14px;
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
			border-bottom: 10px groove #075385;
		}
		.progress {
			height: 15px;
			border-radius: 10px;
		}
		.z-depth-1-top {
			border-radius: 10px;
			box-shadow: 5px 5px 5px #082f493d;
		}
		.card {
			border-radius: 10px;
			box-shadow: 5px 5px 5px #082f493d;
			border: none;
		}
		.badge-corner-blue {
			border-top-color: #40A8E6 !important;
		}
		.badge-corner-blue span {
			position: absolute;
			top: -50px;
			left: 12px;
			font-size: 14px !important;
			color: white;
			-ms-transform: rotate(-45deg);
			-webkit-transform: rotate(-45deg);
			transform: rotate(-45deg);
			margin-left: -14px;
			font-weight: 600;
		}
		.badge-corner3 {
			--f: 10px;
			--r: 15px;
			--t: 10px;
			position: absolute;
			inset: var(--t) calc(-1*var(--f)) auto auto;
			padding: 0 10px var(--f) calc(10px + var(--r));
			clip-path: polygon(0 0,100% 0,100% calc(100% - var(--f)),calc(100% - var(--f)) 100%, calc(100% - var(--f)) calc(100% - var(--f)),0 calc(100% - var(--f)), var(--r) calc(50% - var(--f)/2));
			box-shadow: 0 calc(-1*var(--f)) 0 inset #0005;
		}
		.badge-corner3 span {
			color: #fff;
			font-size: 12px;
			font-weight: 500;
		}
</style>
@endpush

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3" style="padding-right: 25px;">
				<div class="card">
					<div class="card-body">
						<div class="container">
							<div id="accordion" class="accordion">
								<form id="searchForm">
									<div class="card mb-0">
										{{-- Quick Search --}}
										<div class="card-header" data-toggle="collapse" href="#quicksearch">
											<a class="card-title">
												Quick Search
											</a>
										</div>
										<div id="quicksearch" class="card-body collapse show" data-parent="#accordion" >
											@if (auth()->guard('customer')->check())
												<input type="hidden" name="gender" value="{{$gender}}">
											@else
												<fieldset>
													<input id="email-1" class="radio-inline__input radioBtn" type="radio" name="gender" value="1" {{($gender=='1') ? 'checked' : ''}}>
													<label class="radio-inline__label" for="email-1" style="cursor:pointer;">
														Male
													</label>
													<input id="email-2" class="radio-inline__input radioBtn" type="radio" name="gender" value="2" {{($gender=='2') ? 'checked' : ''}}>
													<label class="radio-inline__label" for="email-2" style="cursor:pointer;">
														Female
													</label>
												</fieldset>
												<br>
											@endif
											<input id="featuredProfile" class="checkbox-new" type="checkbox" name="featuredProfile" value="1" {{(!empty($featured)) ? 'checked' : ''}}>
											<label class="mb-2" for="featuredProfile">
												Only Featured Profiles
											</label>
											<br>
											<input id="percentageFilter" class="checkbox-new" type="checkbox" name="percentageFilter" value="1" {{(!empty($verified)) ? 'checked' : ''}}>
											<label class="mb-2" for="percentageFilter">
												Only Verified Profiles
											</label>
											<br>
											{{--<input id="secondMarraige" class="checkbox-new" type="checkbox" name="secondMarraige" value="14" {{(!empty($secondMarriage)) ? 'checked' : ''}}>--}}
											{{--<label class="mb-2" for="secondMarraige">--}}
												{{--Second Marriage--}}
											{{--</label>--}}
											{{--<br>--}}
											{{--<input id="divorcedMarraige" class="checkbox-new" type="checkbox" name="divorcedMarraige" value="14" {{(!empty($secondMarriage)) ? 'checked' : ''}}>--}}
											{{--<label class="mb-2" for="divorcedMarraige">--}}
												{{--Divorced Marriage--}}
											{{--</label>--}}
											{{--<br>--}}
											<div class="row">
												<div class="col-md-6">
													<label class="fieldlabels"> Age From </label>
													<select class="form-select form-control" id="ageFrom" name="ageFrom">
														<option value="">Select</option>
														@for($i=18; $i<=100; $i++)
															<option value="{{$i}}" {{($ageFrom==$i) ? 'selected' : ''}}>{{$i}}</option>
														@endfor
													</select>
												</div>
												<div class="col-md-6">
													<label class="fieldlabels"> Age To </label>
													<select class="form-select form-control" id="ageTo" name="ageTo">
														<option value="">Select</option>
														@for($i=18; $i<=100; $i++)
															<option value="{{$i}}" {{($ageTo==$i) ? 'selected' : ''}}>{{$i}}</option>
														@endfor
													</select>
												</div>
											</div>
											<br>
											<label class="fieldlabels"> Country </label>
											<select onchange="getStates(this,'state_id','Any')" class="form-select form-control" name="country_id" id="country_id">
												<option value="">Select</option>
												@foreach($countries as $val)
													<option value="{{$val->id}}" {{($country==$val->id) ? 'selected' : ''}}>{{$val->name}}</option>
												@endforeach
											</select>
											<br>
											<label class="fieldlabels"> State </label>
											<select onchange="getCities(this,'city_id','Any')" class="form-select form-control" id="state_id" name="state_id">
												<option value="0">Any</option>
												@foreach($states as $val)
													<option value="{{$val->id}}" {{($state==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
												@endforeach
											</select>
											<br>
											<label class="fieldlabels"> City </label>
											<select class="form-select form-control" id="city_id" name="city_id">
												<option value="0">Any</option>
												@foreach($cities as $val)
													<option value="{{$val->id}}" {{($city==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
												@endforeach
											</select>
										</div>

										{{-- Career Information --}}
										<div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#education">
											<a class="card-title">
												Career Info
											</a>
										</div>
										<div id="education" class="collapse" data-parent="#accordion">
											<div class="container">
												<br>
												<label class="fieldlabels"> Qualification </label>
												<select class="form-select select-icon icon-mark form-control from-tab" name="EducationID" id="EducationID">
													<option value="0">Any</option>
													@foreach($educations as $val)
														<option value="{{$val->id}}">{{$val->title}}</option>
													@endforeach
												</select>
												<br>
												<label class="fieldlabels"> Profession </label>
												<select class="form-select select-icon icon-mark form-control from-tab" name="OccupationID" id="OccupationID">
													<option value="0">Any</option>
													@foreach($occupations as $val)
														<option value="{{$val->id}}">{{$val->title}}</option>
													@endforeach
												</select>
												<br>
												<label class="fieldlabels"> Income </label>
												<select class="form-select select-icon icon-mark form-control from-tab" name="MyIncome" id="MyIncome">
													<option value="0">Any</option>
													@foreach($incomes as $val)
														<option value="{{$val->id}}" {{($myIncome==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
													@endforeach
												</select>
												<br>
											</div>
										</div>

										{{-- Religion Form --}}
										<div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#religion">
											<a class="card-title">
												Religion Info
											</a>
										</div>
										<div id="religion" class="card-body collapse" data-parent="#accordion">
											<label class="fieldlabels"> Religiousness </label>
											<select onchange="getSects(this,'Sects')" class="form-select select-icon icon-mark form-control from-tab" name="Religions" id="Religions">
												<option value="">Select</option>
												@foreach($religions as $val)
													<option value="{{$val->id}}" {{($religion==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
												@endforeach
											</select>
											<br>
											<label class="fieldlabels"> Sect </label>
											<select class="form-select select-icon icon-mark form-control from-tab" name="Sects" id="Sects">
												<option value="0">Any</option>
												@foreach($sects as $val)
													<option value="{{$val->id}}">{{$val->title}}</option>
												@endforeach
											</select>
											<br>
										</div>

										{{-- Personal Form --}}
										<div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#personal">
											<a class="card-title">
												Personal Info
											</a>
										</div>
										<div id="personal" class="collapse" data-parent="#accordion" >
											<div class="card-body">
												<div class="container">
													<label class="fieldlabels"> Caste</label>
													<select name="Castes" class="form-select form-control">
														<option value="0">Any</option>
														@foreach($castes as $val)
															<option value="{{$val->id}}">{{$val->title}}</option>
														@endforeach
													</select>
													<br>

													<label class="fieldlabels"> Tongue</label>
													<select name="MyFirstLanguageMotherTonguesID" class="form-select form-control">
														<option value="0">Any</option>
														@foreach($tongues as $val)
															<option value="{{$val->id}}">{{$val->title}}</option>
														@endforeach
													</select>
													<br>
													{{--<label class="fieldlabels"> Willing To Relocate</label>--}}
													{{--<select name="WillingToRelocate" class="form-select form-control">--}}
														{{--<option value="">Select</option>--}}
														{{--@foreach($willingToRelocate as $val)--}}
															{{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
														{{--@endforeach--}}
													{{--</select>--}}
													{{--<br>--}}
													{{--<label class="fieldlabels"> Builds</label>--}}
													{{--<select name="MyBuilds" class="form-select form-control ">--}}
														{{--<option value="">Select</option>--}}
														{{--@foreach($myBuilds as $val)--}}
															{{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
														{{--@endforeach--}}
													{{--</select>--}}
													{{--<br>--}}
													<label class="fieldlabels"> Marital Status</label>
													<select name="MaritalStatus" class="form-select form-control">
														<option value="0">Any</option>
														@foreach($maritalStatuses as $val)
															<option value="{{$val->id}}">{{$val->title}}</option>
														@endforeach
													</select>
													<br>
													<label class="fieldlabels"> Living Arrangements</label>
													<select name="MyLivingArrangements" class="form-select form-control">
														<option value="">Select</option>
														@foreach($livingArrangement as $val)
															<option value="{{$val->id}}">{{$val->title}}</option>
														@endforeach
													</select>
													<br>
													<label class="fieldlabels"> Heights</label>
													<select name="Heights" class="form-select form-control">
														<option value="0">Any</option>
														@foreach($heights as $val)
															<option value="{{$val->id}}">{{$val->title}}</option>
														@endforeach
													</select>
													<br>
													<label class="fieldlabels"> Disabilities</label>
													<select name="Disabilities" class="form-select form-control">
														<option value="">Select</option>
														@foreach($disabilities as $val)
															<option value="{{$val->id}}">{{$val->title}}</option>
														@endforeach
													</select>
													<br>
												</div>
											</div>
										</div>

										{{-- Username --}}
										{{--<div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#username">--}}
											{{--<a class="card-title">--}}
												{{--Username--}}
											{{--</a>--}}
										{{--</div>--}}
										{{--<div id="username" class="collapse" data-parent="#accordion" >--}}
											{{--<div class="card-body">--}}
												{{--<div class="container">--}}
													{{--<label class="fieldlabels">Username</label>--}}
													{{--<input type="text" placeholder="UserName" name="name" class="form-control">--}}
												{{--</div>--}}
											{{--</div>--}}
										{{--</div>--}}

									</div>
								</form>
							</div>
							<div class="align-center">
								<button onclick="searchMembers(this)" type="button" class="button-theme-dark search--btn mb-2 full-width">Search</button>
								<a type="button" href="{{route('customer.search')}}" class="button-theme-dark full-width full-width">Reset</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="d-grid mx-auto gap-12 mt-2">
					<h2 class="heading-section-3 text-dark text-center mb-0">{{ $pageTitle }}</h2>
					<img src="{{asset('images/doosri-biwi-thin-border.png')}}" class="img-align-center heading-border">
				</div>
				<div class="search-list">
					@include('front.customer.partials.search_members')
				</div>
				<div class="d-flex justify-content-center">
					<button onclick="searchMembers(this, true)" type="button" class="btn btn-outline-primary font-weight-600 p-lr-30 search--btn load-more--btn">Load More</button>
				</div>
				<br>
			</div>
		</div>
	</div>


@endsection

@push('script')
	<script>
        $(function (){
            $('form#searchForm').on('submit', function (e) {
                e.preventDefault();
			});
        });

        let hasSlug = '{{$slug}}';
        let page=0;
        function searchMembers(input,hasLoadMore=false) {
            $('button.search--btn').attr('disabled',true);
            page = (hasLoadMore) ? parseFloat(page) + 1 : 0;
            axios.post("{{route('customer.search.process')}}", `${$('#searchForm').serialize()}&page=${page}&slug=${hasSlug}`).then(function (res) {
                console.log('check',hasLoadMore,res.data);
                if (res.data) {
                    if (hasLoadMore==false) {
                        $('.search-list').empty();
                    }
                    $('.search-list').append(res.data);
                    $('button.load-more--btn:hidden').show();
                    $('button.search--btn').attr('disabled',false);
                } else {
                    if (hasLoadMore==false) {
                        $('.search-list').empty().append(`<br><div class="alert alert-danger text-center">Profiles not found search again...</div>`);
                        $('button.load-more--btn').hide();
                        $("html, body").animate({scrollTop: 0}, 500);
                        $('button.search--btn').attr('disabled',false);
                    } else {
                        alertyFy('No more profiles found*','warning',3000);
                        $('button.load-more--btn').hide();
                        $('button.search--btn').attr('disabled',false);
                    }
                }
            }).catch(function (error) {
                $('.search-list').empty().append(`<br><div class="alert alert-danger text-center">Profiles not found search again...</div>`);
                $('button.load-more--btn').hide();
                $("html, body").animate({scrollTop: 0}, 500);
                $('button.search--btn').attr('disabled',false);
            });
        }
        
        function showProfileMatch(input,matchPercent,profileUrl,fullName) {
            Swal.fire({
                title: 'Looking for Match?',
				text: `Your profile is matching ${matchPercent}% with ${fullName}.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4caf50',
                cancelButtonColor: '#ff0000',
                confirmButtonText: 'Interested',
                cancelButtonText: 'Not Interested',
            }).then((result) => {
                if (result.isConfirmed) {
                    location = profileUrl;
                }
            });
        }
	</script>
@endpush