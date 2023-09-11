@extends('front.layouts.master')

@section('title',$title)

@push('style')
	<link rel="stylesheet" href="{{asset('assets/css/progress-step-form.css')}}">
@endpush

@section('content')
	<main class="main position-relative">
		<div class="mt-xl-43"></div>
		<div class="container-xxl">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-12 col-xl-12">
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

					<div class="card">
						<h5 class="card-header">{{$title}}</h5>
						<div class="card-body">
							<div class="container-fluid">
								<div class="card px-0 pt-4 pb-0 mb-3">
									<div id="msform">
										<ul id="progressbar">
											<li class="active" id="account"><strong>Verify</strong></li>
											<li class="active" id="education"><strong>Career Information</strong></li>
											<li id="personal"><strong>Personal Information</strong></li>
											<li id="religion"><strong>Religion</strong></li>
											<li id="expectations"><strong>Expectations</strong></li>
											<li id="uploadImage"><strong>Upload Image</strong></li>
											<li id="confirm"><strong>Finish</strong></li>
										</ul>

										<!-- fieldsets -->
										<fieldset>
											<form id="formCustomerInfo">
												@if(!empty($customerCareerInfo))
													<div class="row">
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label>*Qualification</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select onchange="getMajorCourses(this,'major_course_id')" name="Qualification" id="Qualification" class="form-control rounded-pill">
																			<option value="">Select</option>
																			@foreach($educations as $val)
																				<option value="{{$val->id}}" {{($customerCareerInfo->Qualification==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label>*Major Course</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select name="major_course_id" id="major_course_id" class="form-control rounded-pill">
																			<option value="">Select</option>
																			@foreach($majorCourses as $val)
																				<option value="{{$val->id}}" {{($customerCareerInfo->major_course_id==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label>*University</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select name="University" class="form-control rounded-pill">
																			<option value="">Select</option>
																			@foreach($universities as $val)
																				<option value="{{$val->id}}" {{($customerCareerInfo->University==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label>*Profession</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select name="Profession" id="Profession" class="form-control rounded-pill">
																			<option value="">Select</option>
																			@foreach($occupations as $val)
																				<option value="{{$val->id}}" {{($customerCareerInfo->Profession==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label>*Job Post</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select name="JobPost" class="form-control rounded-pill">
																			<option value="">Select</option>
																			@foreach($jobPosts as $val)
																				<option value="{{$val->id}}" {{($customerCareerInfo->JobPost==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label>*Monthly Income</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select name="MonthlyIncome" class="form-control rounded-pill">
																			<option value="">Select</option>
																			@foreach($incomes as $val)
																				<option value="{{$val->id}}" {{($customerCareerInfo->MonthlyIncome==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label>*Future Plan</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select name="FuturePlans" class="form-control rounded-pill">
																			<option value="">Select</option>
																			@foreach($futurePlans as $val)
																				<option value="{{$val->id}}" {{($customerCareerInfo->FuturePlans==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
													</div>
												@else
													<div class="row">
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label>*Qualification</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select onchange="getMajorCourses(this,'major_course_id')" name="Qualification" id="Qualification" class="form-control rounded-pill">
																			<option value="">Select</option>
																			@foreach($educations as $val)
																				<option value="{{$val->id}}">{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label>*Major Course</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select name="major_course_id" id="major_course_id" class="form-control rounded-pill">
																			<option value="">Select</option>
																			@foreach($majorCourses as $val)
																				<option value="{{$val->id}}">{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label>*University</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select name="University" class="form-control rounded-pill">
																			<option value="">Select</option>
																			@foreach($universities as $val)
																				<option value="{{$val->id}}">{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label>*Profession</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select name="Profession" id="Profession" class="form-control rounded-pill">
																			<option value="">Select</option>
																			@foreach($occupations as $val)
																				<option value="{{$val->id}}">{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label>*Job Post</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select name="JobPost" class="form-control rounded-pill">
																			<option value="">Select</option>
																			@foreach($jobPosts as $val)
																				<option value="{{$val->id}}">{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label>*Monthly Income</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select name="MonthlyIncome" class="form-control rounded-pill">
																			<option value="">Select</option>
																			@foreach($incomes as $val)
																				<option value="{{$val->id}}">{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label>*Future Plan</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select name="FuturePlans" class="form-control rounded-pill">
																			<option value="">Select</option>
																			@foreach($futurePlans as $val)
																				<option value="{{$val->id}}">{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
													</div>
												@endif
											</form>
											<button onclick="saveForm(this)" type="button" class="btn action-button">Next</button>
											<a href="{{route('auth.verify')}}" type="button" class="btn action-button">Previous</a>
										</fieldset>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mt-xl-43"></div>
	</main>
@endsection

@push('script')
	<script>
		function saveForm(input){
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('education.save')}}", $('form#formCustomerInfo').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    setTimeout(function () {
                        location.href = "{{route('personal.form')}}";
                    },2500);
                    return false;
                }
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#formCustomerInfo :input[name="' + k + '"]').addClass("has-error");
                        $('#formCustomerInfo :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
		}
	</script>
@endpush

{{--Sign in with google remaining field--}}
{{--@if(empty($customerOtherInfo) || !empty($customerOtherInfo->gender) || $customerOtherInfo->gender==0)
    <h3 class="text-start">General Info: </h3>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3 my-auto">
                <label>*Gender</label>
            </div>
            <div class="col-md-9 my-auto">
                <div class="form-group py-xl-10">
                    <select name="gender" class="form-control rounded-pill">
                        <option value="">Select Your Gender</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3 my-auto">
                <label>*Country</label>
            </div>
            <div class="col-md-9 my-auto">
                <div class="form-group py-xl-10">
                    <select name="country_id" onchange="getStates(this,'state_id')" class="form-control rounded-pill">
                        <option value="">Select</option>
                        @foreach($countries as $val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3 my-auto">
                <label>*State</label>
            </div>
            <div class="col-md-9 my-auto">
                <div class="form-group py-xl-10">
                    <select name="state_id" onchange="getCities(this,'city_id')" class="form-control rounded-pill">
                        <option value=""> -- Select -- </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3 my-auto">
                <label>*City</label>
            </div>
            <div class="col-md-9 my-auto">
                <div class="form-group py-xl-10">
                    <select name="city_id" class="form-control rounded-pill">
                        <option value=""> -- Select -- </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3 my-auto">
                <label>*Marital Status</label>
            </div>
            <div class="col-md-9 my-auto">
                <div class="form-group py-xl-10">
                    <select name="MaritalStatusID" class="form-control rounded-pill">
                        <option value="">Select</option>
                        @foreach($maritalStatues as $val)
                            <option value="{{$val->id}}">{{$val->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3 my-auto">
                <label>*Reason for Registering</label>
            </div>
            <div class="col-md-9 my-auto">
                <div class="form-group py-xl-10">
                    <select name="RegistrationsReasonsID" class="form-control rounded-pill">
                        <option value="">Select</option>
                        @foreach($registrationReasons as $val)
                            <option value="{{$val->id}}">{{$val->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3 my-auto">
                <label>*Mobile #</label>
            </div>
            <div class="col-md-9 my-auto">
                <div class="form-group py-xl-10">
                    <input type="text" name="mobile" class="form-control rounded-pill">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3 my-auto">
                <label>*Date of Birth</label>
            </div>
            <div class="col-md-9 my-auto">
                <div class="form-group py-xl-10">
                    <input type="date" name="DOB" class="form-control rounded-pill">
                </div>
            </div>
        </div>
    </div>
@endif--}}