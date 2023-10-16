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
											<li class="active" id="education"><strong>Career</strong></li>
											<li class="active" id="personal"><strong>Personal</strong></li>
											<li class="active" id="religion"><strong>Religion</strong></li>
											<li class="active" id="expectations"><strong>Expectations</strong></li>
											<li id="uploadImage"><strong>Image</strong></li>
											<li id="confirm"><strong>Finish</strong></li>
										</ul>

										<!-- fieldsets -->
										<fieldset>
											<form id="formCustomerInfo">
												@if(!empty($customerSearch))
													<div class="row">
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Gender</label>
																<select class="form-control rounded-pill" name="gender">
																	<option value="">Select</option>
																	<option value="1"
																			{{isset($customerSearch->gender) && $customerSearch->gender==1 ? 'selected' : ''}}
																			{{($customer->gender_name=='Male') ? 'disabled' : ''}}
																	>Male</option>
																	<option value="2"
																			{{isset($customerSearch->gender) && $customerSearch->gender==2 ? 'selected' : ''}}
																			{{($customer->gender_name=='Female') ? 'disabled' : ''}}
																	>Female</option>
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Age From</label>
																<select class="form-control rounded-pill" name="ageFrom">
																	<option value="">Select</option>
																	@for($i=18; $i<=100; $i++)
																		<option value="{{$i}}" {{isset($customerSearch->ageFrom) && $customerSearch->ageFrom==$i ? 'selected' : ''}}>{{$i}}</option>
																	@endfor
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Age To</label>
																<select class="form-control rounded-pill" name="ageTo">
																	<option value="">Select</option>
																	@for($i=18; $i<=100; $i++)
																		<option value="{{$i}}" {{isset($customerSearch->ageTo) && $customerSearch->ageTo==$i ? 'selected' : ''}}>{{$i}}</option>
																	@endfor
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Country</label>
																<select onchange="getStates(this,'state_id','Any')" class="form-control rounded-pill" name="country_id">
																	<option value="">Select</option>
																	@foreach($counties as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->country_id) && $customerSearch->country_id==$val->id ? 'selected' : ''}}>{{$val->name}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">State</label>
																<select onchange="getCities(this,'city_id','Any')" class="form-control rounded-pill" name="state_id">
																	<option value="0">Any</option>
																	@foreach($states as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->state_id) && $customerSearch->state_id==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">City</label>
																<select class="form-control rounded-pill" name="city_id">
																	<option value="0">Any</option>
																	@foreach($cities as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->city_id) && $customerSearch->city_id==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Tongue</label>
																<select class="form-control rounded-pill" name="Tongue">
																	<option value="">Select</option>
																	@foreach($tongues as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->Tongue) && $customerSearch->Tongue==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Religiousness</label>
																<select onchange="getSects(this,'Sects')" class="form-control rounded-pill" name="Religions">
																	<option value="">Select</option>
																	@foreach($religions as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->Religions) && $customerSearch->Religions==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Sect</label>
																<select class="form-control rounded-pill" name="Sects">
																	<option value="">Select</option>
																	@foreach($sects as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->Sects) && $customerSearch->Sects==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Qualification</label>
																<select class="form-control rounded-pill" name="EducationID">
																	<option value="">Select</option>
																	@foreach($educations as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->EducationID) && $customerSearch->EducationID==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Profession</label>
																<select class="form-control rounded-pill" name="OccupationID">
																	<option value="">Select</option>
																	@foreach($occupations as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->OccupationID) && $customerSearch->OccupationID==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Income</label>
																<select class="form-control rounded-pill" name="MyIncome">
																	<option value="">Select</option>
																	@foreach($incomes as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->MyIncome) && $customerSearch->MyIncome==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Builds</label>
																<select class="form-control rounded-pill" name="MyBuilds">
																	<option value="">Select</option>
																	@foreach($myBuilds as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->MyBuilds) && $customerSearch->MyBuilds==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Marital Status</label>
																<select class="form-control rounded-pill" name="MaritalStatus">
																	<option value="">Select</option>
																	@foreach($maritalStatues as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->MaritalStatus) && $customerSearch->MaritalStatus==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Living Arrangements</label>
																<select class="form-control rounded-pill" name="MyLivingArrangements">
																	<option value="">Select</option>
																	@foreach($livingArrangements as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->MyLivingArrangements) && $customerSearch->MyLivingArrangements==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Heights</label>
																<select class="form-control rounded-pill" name="Heights">
																	<option value="">Select</option>
																	@foreach($heights as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->Heights) && $customerSearch->Heights==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Disabilities</label>
																<select class="form-control rounded-pill" name="Disabilities">
																	<option value="">Select</option>
																	@foreach($disabilities as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->Disabilities) && $customerSearch->Disabilities==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Caste</label>
																<select class="form-control rounded-pill" name="Castes">
																	<option value="">Select</option>
																	@foreach($castes as $val)
																		<option value="{{$val->id}}" {{isset($customerSearch->Castes) && $customerSearch->Castes==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
													</div>
												@else
													<div class="row">
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Gender</label>
																<select class="form-control rounded-pill" name="gender">
																	<option value="">Select</option>
																	<option value="1"
																			{{($customer->gender_name=='Male') ? 'disabled' : ''}}
																	>Male</option>
																	<option value="2"
																			{{($customer->gender_name=='Female') ? 'disabled' : ''}}
																	>Female</option>
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Age From</label>
																<select class="form-control rounded-pill" name="ageFrom">
																	<option value="">Select</option>
																	@for($i=18; $i<=100; $i++)
																		<option value="{{$i}}">{{$i}}</option>
																	@endfor
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Age To</label>
																<select class="form-control rounded-pill" name="ageTo">
																	<option value="">Select</option>
																	@for($i=18; $i<=100; $i++)
																		<option value="{{$i}}">{{$i}}</option>
																	@endfor
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Country</label>
																<select onchange="getStates(this,'state_id')" class="form-control rounded-pill" name="country_id">
																	<option value="">Select</option>
																	@foreach($counties as $val)
																		<option value="{{$val->id}}">{{$val->name}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">State</label>
																<select onchange="getCities(this,'city_id')" class="form-control rounded-pill" name="state_id">
																	<option value="">Select</option>
																	@foreach($states as $val)
																		<option value="{{$val->id}}">{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">City</label>
																<select class="form-control rounded-pill" name="city_id">
																	<option value="">Select</option>
																	@foreach($cities as $val)
																		<option value="{{$val->id}}">{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Tongue</label>
																<select class="form-control rounded-pill" name="Tongue">
																	<option value="">Select</option>
																	@foreach($tongues as $val)
																		<option value="{{$val->id}}">{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Religiousness</label>
																<select onchange="getSects(this,'Sects')" class="form-control rounded-pill" name="Religions">
																	<option value="">Select</option>
																	@foreach($religions as $val)
																		<option value="{{$val->id}}">{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Sect</label>
																<select class="form-control rounded-pill" name="Sects">
																	<option value="">Select</option>
																	@foreach($sects as $val)
																		<option value="{{$val->id}}">{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Qualification</label>
																<select class="form-control rounded-pill" name="EducationID">
																	<option value="">Select</option>
																	@foreach($educations as $val)
																		<option value="{{$val->id}}">{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Profession</label>
																<select class="form-control rounded-pill" name="OccupationID">
																	<option value="">Select</option>
																	@foreach($occupations as $val)
																		<option value="{{$val->id}}">{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Income</label>
																<select class="form-control rounded-pill" name="MyIncome">
																	<option value="">Select</option>
																	@foreach($incomes as $val)
																		<option value="{{$val->id}}">{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Builds</label>
																<select class="form-control rounded-pill" name="MyBuilds">
																	<option value="">Select</option>
																	@foreach($myBuilds as $val)
																		<option value="{{$val->id}}">{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Marital Status</label>
																<select class="form-control rounded-pill" name="MaritalStatus">
																	<option value="">Select</option>
																	@foreach($maritalStatues as $val)
																		<option value="{{$val->id}}">{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Living Arrangements</label>
																<select class="form-control rounded-pill" name="MyLivingArrangements">
																	<option value="">Select</option>
																	@foreach($livingArrangements as $val)
																		<option value="{{$val->id}}">{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Heights</label>
																<select class="form-control rounded-pill" name="Heights">
																	<option value="">Select</option>
																	@foreach($heights as $val)
																		<option value="{{$val->id}}">{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Disabilities</label>
																<select class="form-control rounded-pill" name="Disabilities">
																	<option value="">Select</option>
																	@foreach($disabilities as $val)
																		<option value="{{$val->id}}">{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group py-xl-10">
																<label class="fieldlabels">Caste</label>
																<select class="form-control rounded-pill" name="Castes">
																	<option value="">Select</option>
																	@foreach($castes as $val)
																		<option value="{{$val->id}}">{{$val->title}}</option>
																	@endforeach
																</select>
															</div>
														</div>
													</div>
												@endif
											</form>
											<button onclick="saveForm(this)" type="button" class="btn action-button">Next</button>
											<a href="{{route('religion.form')}}" type="button" class="btn action-button">Previous</a>
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
            axios.post("{{route('expectation.save')}}", $('form#formCustomerInfo').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    setTimeout(function () {
                        location.href = "{{route('profile.image.form')}}";
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