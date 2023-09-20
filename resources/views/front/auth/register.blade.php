@extends('front.layouts.master')

@section('title',$title)

@push('style')
	{{--Style--}}
@endpush

@section('content')
	<main class="main position-relative">
		<div class="mt-xl-43"></div>
		<div class="container-xxl">
			<div class="row justify-content-md-center">
				<div class="col-md-9">
					<div class="card">
						<h5 class="card-header">{{$title}}</h5>
						<div class="card-body">
							<form method="post" class="row" id="shadiForm">
								@csrf
								<div class="col-6">
									<div class="form-group py-xl-10">
										<label for="gender">*Gender</label>
										<select class="form-control rounded-pill" name="gender">
											<option value="">Select Your Gender</option>
											<option value="1">Male</option>
											<option value="2">Female</option>
										</select>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group py-xl-10">
										<label for="first_name">*First Name</label>
										<input type="text" name="first_name" class="form-control rounded-pill">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group py-xl-10">
										<label for="last_name">*Last Name</label>
										<input type="text" name="last_name" class="form-control rounded-pill">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group py-xl-10">
										<label for="name">*Username</label>
										<input onchange="checkIfExists(this)" type="text" name="name" class="form-control rounded-pill">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group py-xl-10">
										<label for="DOB">*Date of Birth</label>
										<input type="date" name="DOB" class="form-control rounded-pill">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group py-xl-10">
										<label for="country_id">*Country</label>
										<select onchange="getStates(this,'state_id')" class="form-control rounded-pill" name="country_id">
											<option value="">Select</option>
											@foreach($countries as $val)
												<option value="{{$val->id}}">{{$val->name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group py-xl-10">
										<label for="state_id">*State</label>
										<select onchange="getCities(this,'city_id')" class="form-control rounded-pill" name="state_id">
											<option value="">Select</option>
										</select>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group py-xl-10">
										<label for="city_id">*City</label>
										<select class="form-control rounded-pill" name="city_id">
											<option value="">Select</option>
										</select>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group py-xl-10">
										<label for="MaritalStatusID">*Marital Status</label>
										<select onchange="checkAvailability(this)" class="form-control rounded-pill" name="MaritalStatusID">
											<option value="">Select</option>
											@foreach($maritalStatues as $val)
												<option value="{{$val->id}}">{{$val->title}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-6 divorceReasonDiv" style="display: none;">
									<div class="form-group py-xl-10">
										<label for="divorceReason">*Reason</label>
										<input type="text" name="divorceReason" class="form-control rounded-pill">
									</div>
								</div>
								<div class="col-6 childrenQuantityDiv" style="display: none;">
									<div class="form-group py-xl-10">
										<label for="childrenQuantity">*Children</label>
										<input type="number" name="childrenQuantity" class="form-control rounded-pill">
									</div>
								</div>
								{{--<div class="col-6">
									<div class="form-group py-xl-10">
										<label for="test">*Second Marriage</label>
										<select class="form-control rounded-pill" name="second_marraige">
											<option value="">Select</option>
											<option value="1">Male looking for 2nd Wife</option>
											<option value="2">Female Ready for 2nd Wife</option>
											<option value="3">Looking for Single</option>
										</select>
									</div>
								</div>--}}
								<div class="col-6">
									<div class="form-group py-xl-10">
										<label for="RegistrationsReasonsID">*Reason for Registering</label>
										<select class="form-control rounded-pill" name="RegistrationsReasonsID">
											<option value="">Select</option>
											@foreach($registrationReasons as $val)
												<option value="{{$val->id}}">{{$val->title}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group py-xl-10">
										<label for="mobile">*Mobile #</label>
										<input onchange="checkIfExists(this)" type="text" name="mobile" class="form-control rounded-pill">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group py-xl-10">
										<label for="email">*Email</label>
										<input onchange="checkIfExists(this)" type="text" name="email" class="form-control rounded-pill">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group py-xl-10">
										<label for="password">*Password</label>
										<input type="password" name="password" class="form-control rounded-pill">
										<i class="fa fa-eye" id="togglePassword"></i>
									</div>
								</div>
								<div class="col-12">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="read_policy" id="read_policy">
										<label class="form-check-label" for="read_policy">
											I agree with the
											<a href="{{route('terms.of.services')}}" target="_blank"><b>Terms of Services</b></a>,
											<a href="{{route('privacy.policy')}}" target="_blank"><b>Privacy Policy</b></a> and
											<a href="{{route('disclaimer')}}" target="_blank"><b>Disclaimer</b></a>
											.
										</label>
									</div>
								</div>

								<div class="col-12 text-end">
									<button type="button" onclick="authAct(this)" class="btn btn-outline-primary font-weight-600">Register</button>
								</div>
							</form>
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
        function authAct(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('register.process')}}", $('#shadiForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    location.href = res.data.redirectUrl;
				}
                setTimeout(function () {
                    $(input).attr('disabled',false);
                },2000);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#shadiForm :input[name="' + k + '"]').addClass("has-error");
                        if (k=='read_policy' || k=='g-recaptcha-response') {
                            $('#shadiForm :input[name="' + k + '"]').parent().after("<span class='text-danger'>" + v[0] + "</span>");
						} else {
                            $('#shadiForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
						}
                    });
				} else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }
        function checkAvailability(input) {
            let newVal = $(input).val();
            $('.divorceReasonDiv').hide();
            $('.childrenQuantityDiv').hide();
            if (newVal==12 || newVal==18 || newVal==19 || newVal==7) {
                $('.divorceReasonDiv').show('slow');
                $('.childrenQuantityDiv').show('slow');
            } else if (newVal==3 || newVal==4 || newVal==8 || newVal==16) {
                $('.divorceReasonDiv').show('slow');
            }
        }
	</script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
@endpush