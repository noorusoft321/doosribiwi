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
											<li id="expectations"><strong>Expectations</strong></li>
											<li id="uploadImage"><strong>Image</strong></li>
											<li id="confirm"><strong>Finish</strong></li>
										</ul>

										<!-- fieldsets -->
										<fieldset>
											<form id="formCustomerInfo">
												@if(!empty($customerReligionInfo))
													<div class="row">
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*Religion</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select onchange="getSects(this,'Sects')" class="form-control rounded-pill" name="Religions">
																			<option value="">Select</option>
																			@foreach($religions as $val)
																				<option value="{{$val->id}}" {{$customerReligionInfo->Religions==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*Sect</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="Sects">
																			<option value="">Select</option>
																			@foreach($sects as $val)
																				<option value="{{$val->id}}" {{$customerReligionInfo->Sects==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*Do You Prefer Beard?</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="DoYouHaveBeards">
																			<option value="">Select</option>
																			@foreach($beards as $val)
																				<option value="{{$val->id}}" {{$customerReligionInfo->DoYouHaveBeards==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*Do You Prefer Hijaab?</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="DoYouPreferHijabs">
																			<option value="">Select</option>
																			@foreach($preferHijabs as $val)
																				<option value="{{$val->id}}" {{$customerReligionInfo->DoYouPreferHijabs==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*Are You A Revert / Converted Religion?</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="AreYouReverts">
																			<option value="">Select</option>
																			@foreach($reverts as $val)
																				<option value="{{$val->id}}" {{$customerReligionInfo->AreYouReverts==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-3 my-auto">
																	<label class="fieldlabels">*Do You Keep Halal?</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="DoYouKeepHalal">
																			<option value="">Select</option>
																			@foreach($halals as $val)
																				<option value="{{$val->id}}" {{$customerReligionInfo->DoYouKeepHalal==$val->id ? 'selected' : ''}}>{{$val->title}}</option>
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
																	<label class="fieldlabels">*Religion</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select onchange="getSects(this,'Sects')" class="form-control rounded-pill" name="Religions">
																			<option value="">Select</option>
																			@foreach($religions as $val)
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
																	<label class="fieldlabels">*Sect</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="Sects">
																			<option value="">Select</option>
																			@foreach($sects as $val)
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
																	<label class="fieldlabels">*Do You Prefer Beard?</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="DoYouHaveBeards">
																			<option value="">Select</option>
																			@foreach($beards as $val)
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
																	<label class="fieldlabels">*Do You Prefer Hijaab?</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="DoYouPreferHijabs">
																			<option value="">Select</option>
																			@foreach($preferHijabs as $val)
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
																	<label class="fieldlabels">*Are You A Revert / Converted Religion?</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="AreYouReverts">
																			<option value="">Select</option>
																			@foreach($reverts as $val)
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
																	<label class="fieldlabels">*Do You Keep Halal?</label>
																</div>
																<div class="col-md-9 my-auto">
																	<div class="form-group py-xl-10">
																		<select class="form-control rounded-pill" name="DoYouKeepHalal">
																			<option value="">Select</option>
																			@foreach($halals as $val)
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
											<a href="{{route('personal.form')}}" type="button" class="btn action-button">Previous</a>
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
            axios.post("{{route('religion.save')}}", $('form#formCustomerInfo').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    setTimeout(function () {
                        location.href = "{{route('expectation.form')}}";
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