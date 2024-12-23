@extends('front.layouts.master')

@section('title',$title)

@push('style')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
	<style>
		label.gender {
			width: 100%;
		}
		.card-input-element {
			display: none;
		}
		.card-input {
			margin: 10px;
			padding: 0px;
		}
		.card-input:hover {
			cursor: pointer;
		}
		.card-input-element + .card-input {
			box-shadow: 0 0 3px 0 #0c476e;
		}
		.card-input-element:checked + .card-input {
			box-shadow: 0 0 5px 4px #0c476e;
			background: #075385;
		}
		.section-card-heading {
			font-size: 1.4rem;
			color: #D5AD6D;
			background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%);
			background: -o-linear-gradient(transparent, transparent);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			font-weight: 600;
			text-align: center;
		}
		.gender-icon {
			text-align: center;
		}
		.gender-icon img {
			width: 120px;
			border-radius: 50%;
			border-bottom: 2px solid #082f49;
			margin: 0 auto !important;
		}
		iframe {
			height: 100% !important;
		}

		.g-recaptcha iframe {
			height: 78px !important;
		}

		.iti--allow-dropdown input, .iti--allow-dropdown input[type=text], .iti--allow-dropdown input[type=tel], .iti--separate-dial-code input, .iti--separate-dial-code input[type=text], .iti--separate-dial-code input[type=tel] {
			padding-right: 160px;
		}
		.iti.iti--allow-dropdown.iti--separate-dial-code {
			width: 100%;
		}
		@media only screen and (max-width: 600px) {
			.section-card-heading {
				font-size: 16px !important;
				text-align: center;
				margin-top: 10px;
			}
			.gender-icon img {
				width: 80px;
			}
			iframe {
				height: 100% !important;
			}
		}
	</style>
@endpush

@section('content')
	<main class="main position-relative">
		<div class="mt-xl-43"></div>
		<div class="container-xxl">
			<div class="row justify-content-md-center">
				<div class="col-md-9">
					<h2 class="align-center font-weight-600"> Create an account </h2>
					<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-thin-border.png')}}">
					{{--<br>--}}
					<h3 class="section-card-heading text-center mb-2">Welcome to a community that understands and supports your choices.</h3>
					<form method="post" id="shadiForm">
						@csrf
						<div class="row">
							<div class="col-6">
								<label class="gender">
									<input type="radio" name="gender" class="card-input-element" value="1" />
									<div class="card card-default card-input">
										<div class="card-body">
											<div class="gender-icon">
												<img src="{{asset('assets/img/default-male.svg')}}" width="100%">
											</div>
											<p class="section-card-heading">Male - Looking for 2nd Wife</p>
											<p class="section-card-heading">مرد - دوسری بیوی کی تلاش میں</p>
										</div>
									</div>
								</label>
							</div>
							<div class="col-6">
								<label class="gender">
									<input type="radio" name="gender" class="card-input-element" value="2" />
									<div class="card card-default card-input">
										<div class="card-body">
											<div class="gender-icon">
												<img src="{{asset('assets/img/default-female.svg')}}" width="100%">
											</div>
											<p class="section-card-heading">Female - Ready to become 2nd Wife</p>
											<p class="section-card-heading">خاتون - دوسری بیوی بننے کے لیے تیار</p>
										</div>
									</div>
								</label>
							</div>
						</div>

						<div class="card registerOtherPart" style="display: none;">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group py-xl-10">
											<label for="first_name">*First Name</label>
											<input type="text" name="first_name" class="form-control ">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group py-xl-10">
											<label for="last_name">Last Name</label>
											<input type="text" name="last_name" class="form-control ">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group py-xl-10">
											<label for="DOB">*Date of Birth</label>
											<input type="date" name="DOB" class="form-control ">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group py-xl-10">
											<label for="country_id">*Country</label>
											<select onchange="getStates(this,'state_id')" class="form-control " name="country_id">
												<option value="">Select</option>
												@foreach($countries as $val)
													<option value="{{$val->id}}" data--iso="{{$val->iso}}">{{$val->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group py-xl-10">
											<label for="state_id">*State</label>
											<select onchange="getCities(this,'city_id')" class="form-control " name="state_id">
												<option value="">Select</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group py-xl-10">
											<label for="city_id">*City</label>
											<select onchange="getAreas(this,'area_id')" class="form-control " name="city_id">
												<option value="">Select</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group py-xl-10">
											<label for="area_id">Area</label>
											<select class="multiple-select form-control" name="area_id">
												<option value="">Select</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group py-xl-10">
											<label for="MaritalStatusID">*Marital Status</label>
											<select onchange="checkAvailability(this)" class="form-control " name="MaritalStatusID">
												<option value="">Select</option>
												@foreach($maritalStatues as $val)
													<option value="{{$val->id}}">{{$val->title}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6 divorceReasonDiv" style="display: none;">
										<div class="form-group py-xl-10">
											<label for="divorceReason">Reason</label>
											<input type="text" name="divorceReason" class="form-control ">
										</div>
									</div>
									<div class="col-md-6 childrenQuantityDiv" style="display: none;">
										<div class="form-group py-xl-10">
											<label for="childrenQuantity">Children</label>
											<input type="number" name="childrenQuantity" class="form-control ">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group py-xl-10">
											<label for="RegistrationsReasonsID">*Reason for Registering</label>
											<select class="form-control " name="RegistrationsReasonsID">
												<option value="">Select</option>
												@foreach($registrationReasons as $val)
													<option value="{{$val->id}}">{{$val->title}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="hidden" name="mobile_country_code" id="mobile_country_code">
											<label for="mobile">*Mobile #</label>
											<div class="form-group mobile-parent-input py-xl-10">
												<input id="mobile_code" type="text" name="mobile" class="form-control">
											</div>
{{--											<input onchange="checkIfExists(this)" type="text" name="mobile" class="form-control ">--}}
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group py-xl-10">
											<label for="email">*Email</label>
											<input onchange="checkIfExists(this)" type="email" name="email" class="form-control ">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group py-xl-10">
											<label for="password">*Password</label>
											<input type="password" name="password" class="form-control ">
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

									<div class="col-12">
										<div class="form-group my-3">
											<strong>*ReCaptcha</strong>
											<div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
											@if ($errors->has('g-recaptcha-response'))
												<span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
											@endif
										</div>
									</div>

									<div class="col-12 mt-2 text-end">
										<button type="button" onclick="authAct(this)" class="btn btn-outline-primary font-weight-600">Register</button>
									</div>
								</div>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
		<div class="mt-xl-43"></div>
	</main>
@endsection

@push('script')
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
	<script>
		$(function () {
            $('input[name="gender"]').change(function() {
                $('select[name="MaritalStatusID"]').val('');
                $('.registerOtherPart').hide();
                $(':input').removeClass('has-error');
                $('.text-danger').remove();
                let gender = $('input[name="gender"]:checked').val();
				if (gender) {
                    if (gender=="1") {
                        $('select[name="MaritalStatusID"] option[value="16"]').removeAttr('disabled');
                        $('select[name="MaritalStatusID"] option[value="7"]').removeAttr('disabled');
                        $('select[name="MaritalStatusID"] option[value="1"]').attr('disabled', true);
                        $('select[name="MaritalStatusID"] option[value="17"]').attr('disabled', true);
                    } else {
                        $('select[name="MaritalStatusID"] option[value="1"]').removeAttr('disabled');
                        $('select[name="MaritalStatusID"] option[value="17"]').removeAttr('disabled');
                        $('select[name="MaritalStatusID"] option[value="16"]').attr('disabled', true);
                        $('select[name="MaritalStatusID"] option[value="7"]').attr('disabled', true);
                    }
                    $('.registerOtherPart').show('slow');
				}
            });

			$('select[name="country_id"]').on('change', function(){
				let countryIso = $('select[name="country_id"] option:selected').attr('data--iso');
				$('.mobile-parent-input').html('<input id="mobile_code" type="text" name="mobile" class="form-control">');
				$("#mobile_code").intlTelInput({
					initialCountry: countryIso,
					separateDialCode: true,
					utilsScript:"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
				});
			});
        });
        function authAct(input) {
            $('input[name="mobile_country_code"]').val($('.iti__selected-dial-code').text());
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
                grecaptcha.reset();
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
@endpush