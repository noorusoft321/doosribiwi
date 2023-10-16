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
											<li id="religion"><strong>Religion</strong></li>
											<li id="expectations"><strong>Expectations</strong></li>
											<li id="uploadImage"><strong>Image</strong></li>
											<li id="confirm"><strong>Finish</strong></li>
										</ul>

										<!-- fieldsets -->
										<fieldset>
											<form id="formCustomerInfo">
												@if(!empty($customerPersonalInfo))
													<div class="row">
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*I am Looking to Marry</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="IAmLookingToMarry">
																			<option value="">Select</option>
																			@foreach($lookingToMarry as $val)
																				<option value="{{$val->id}}" {{$customerPersonalInfo->IAmLookingToMarry==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*Living Arrangement</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="MyLivingArrangements">
																			<option value="">Select</option>
																			@foreach($livingArrangement as $val)
																				<option value="{{$val->id}}" {{$customerPersonalInfo->MyLivingArrangements==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*Height</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="Heights">
																			<option value="">Select</option>
																			@foreach($heights as $val)
																				<option value="{{$val->id}}" {{$customerPersonalInfo->Heights==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*Weight</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="Weights">
																			<option value="">Select</option>
																			@foreach($weights as $val)
																				<option value="{{$val->id}}" {{$customerPersonalInfo->Weights==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*Complexion</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="Complexions">
																			<option value="">Select</option>
																			@foreach($complexions as $val)
																				<option value="{{$val->id}}" {{$customerPersonalInfo->Complexions==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*Hair Color</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="HairColors">
																			<option value="">Select</option>
																			@foreach($hairColors as $val)
																				<option value="{{$val->id}}" {{$customerPersonalInfo->HairColors==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*Eye Color</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="EyeColors">
																			<option value="">Select</option>
																			@foreach($eyeColors as $val)
																				<option value="{{$val->id}}" {{$customerPersonalInfo->EyeColors==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*Smoke</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="Smokes">
																			<option value="">Select</option>
																			@foreach($smokes as $val)
																				<option value="{{$val->id}}" {{$customerPersonalInfo->Smokes==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*Disability</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="Disabilities">
																			<option value="">Select</option>
																			@foreach($disabilities as $val)
																				<option value="{{$val->id}}" {{$customerPersonalInfo->Disabilities==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-3 my-auto">
                                                                    <label class="fieldlabels">*Caste</label>
                                                                </div>
                                                                <div class="col-md-9 my-auto">
                                                                    <div class="form-group py-xl-10">
                                                                        <select class="form-control rounded-pill" name="Caste">
                                                                            <option value="">Select</option>
                                                                            @foreach($castes as $val)
                                                                                <option value="{{$val->id}}" {{$customerPersonalInfo->Smokes==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
														</div>
														<div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-3 my-auto">
                                                                    <label class="fieldlabels">*Mother Tongue</label>
                                                                </div>
                                                                <div class="col-md-9 my-auto">
                                                                    <div class="form-group py-xl-10">
                                                                        <select class="form-control rounded-pill" name="MyFirstLanguageMotherTonguesID">
                                                                            <option value="">Select</option>
                                                                            @foreach($tongues as $val)
                                                                                <option value="{{$val->id}}" {{($customerOtherInfo->MyFirstLanguageMotherTonguesID==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
																	<label class="fieldlabels">*I am Looking to Marry</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="IAmLookingToMarry">
																			<option value="">Select</option>
																			@foreach($lookingToMarry as $val)
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
																	<label class="fieldlabels">*Living Arrangement</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="MyLivingArrangements">
																			<option value="">Select</option>
																			@foreach($livingArrangement as $val)
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
																	<label class="fieldlabels">*Height</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="Heights">
																			<option value="">Select</option>
																			@foreach($heights as $val)
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
																	<label class="fieldlabels">*Weight</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="Weights">
																			<option value="">Select</option>
																			@foreach($weights as $val)
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
																	<label class="fieldlabels">*Complexion</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="Complexions">
																			<option value="">Select</option>
																			@foreach($complexions as $val)
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
																	<label class="fieldlabels">*Hair Color</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="HairColors">
																			<option value="">Select</option>
																			@foreach($hairColors as $val)
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
																	<label class="fieldlabels">*Eye Color</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="EyeColors">
																			<option value="">Select</option>
																			@foreach($eyeColors as $val)
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
																	<label class="fieldlabels">*Smoke</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="Smokes">
																			<option value="">Select</option>
																			@foreach($smokes as $val)
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
																	<label class="fieldlabels">*Disability</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="Disabilities">
																			<option value="">Select</option>
																			@foreach($disabilities as $val)
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
                                                                    <label class="fieldlabels">*Caste</label>
                                                                </div>
                                                                <div class="col-md-9 my-auto">
                                                                    <div class="form-group py-xl-10">
                                                                        <select class="form-control rounded-pill" name="Caste">
                                                                            <option value="">Select</option>
                                                                            @foreach($castes as $val)
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
                                                                    <label class="fieldlabels">*Mother Tongue</label>
                                                                </div>
                                                                <div class="col-md-9 my-auto">
                                                                    <div class="form-group py-xl-10">
                                                                        <select class="form-control rounded-pill" name="MyFirstLanguageMotherTonguesID">
                                                                            <option value="">Select</option>
                                                                            @foreach($tongues as $val)
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
											<a href="{{route('education.form')}}" type="button" class="btn action-button">Previous</a>
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
            axios.post("{{route('personal.save')}}", $('form#formCustomerInfo').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    setTimeout(function () {
                        location.href = "{{route('religion.form')}}";
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