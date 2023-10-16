@extends('front.layouts.master')

@section('title',$title)

@push('style')
	<link rel="stylesheet" href="{{asset('assets/css/progress-step-form.css')}}">
	<style>
		.heading-line {
			margin: 0 auto;
			display: block;

		}
		.select2-container {
			width: 100% !important;
		}
		@media only screen and (max-width: 600px) {
			.heading-line {
				width: 100%;
			}

			.card-h {
				height: auto;
			}

			.btn-cancel{
				width:100%;

			}
			.btn-update{
				width:100%;
				margin-bottom:10px;
				margin-top: 10px;
			}
			.drop-zone {
				max-width: 100%;
			}
			.reg-form {
				padding: 0px !important;
				display: block  !important;
			}
			#phone{
				width:100%;
			}


		}
	</style>
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
									<form id="msform">
										<ul id="progressbar">
											<li class="active" id="account"><strong>Verify</strong></li>
											<li id="education"><strong>Career</strong></li>
											<li id="personal"><strong>Personal</strong></li>
											<li id="religion"><strong>Religion</strong></li>
											<li id="expectations"><strong>Expectations</strong></li>
											<li id="uploadImage"><strong>Image</strong></li>
											<li id="confirm"><strong>Finish</strong></li>
										</ul>

										<!-- fieldsets -->
										<fieldset>
											<div class="form-card">
												<div class="row justify-content-md-center">
													<div class="col-md-5">
														<div class="border card">
															<h5 class="card-header">Email Verification</h5>
															<div class="card-body" style="padding: 25px;">
																@if(auth()->guard('customer')->user()->email_verified == 0)
																	<div class="row">
																		<div class="col-6">
																			<span>{{auth()->guard('customer')->user()->email}}</span>
																		</div>
																		<div class="col-6 text-end">
																			<img src="{{asset('assets/img/icons/red-x.svg')}}"
																				 width="20" height="22" alt="Not verified">
																			<span class="not-verify">Not verified</span>
																		</div>
																	</div>
																	<br>
																	<div class="row">
																		<div class="col-12">
																			<p class="verifyEmailSent">
																				Please check your email and click on the link we have sent you to verify your account then return here to proceed.
																			</p>
																			<button type="button" onclick="sendConfirmationEmail(this)" class="btn action-button"
																			    role="button">
																				Resend
																			</button>
																		</div>
																	</div>
																@else
																	<div class="row">
																		<div class="col-6">
																			<span>{{auth()->guard('customer')->user()->email}}</span>
																		</div>
																		<div class="col-6 text-end">
																			<img src="{{asset('assets/img/icons/icons-verified-account.png')}}"
																				 width="20" height="22" alt="Verified">
																			<span class="not-verify">Verified</span>
																		</div>
																	</div>
																	<br>
																	<div class="row">
																		<div class="col-12">
																			<p>
																				Thank you for verifying your email, now your account is verified, you can proceed further, thanks again.
																			</p>
																		</div>
																	</div>
																@endif
															</div>
														</div>
													</div>
												</div>


											</div>
											@if(auth()->guard('customer')->user()->email_verified == 1 || auth()->guard('customer')->user()->mobile_verified == 1)
												<a href="{{Route('education.form')}}" name="next"
												   class="btn action-button">Next</a>
											@endif
										</fieldset>

									</form>
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
		function sendConfirmationEmail(input) {
			$(input).attr('disabled',true);
            axios.get("{{route('confirmation.email')}}").then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                alertyFy('There is something wrong','warning',3000);
                $(input).attr('disabled',false);
            });
        }
	</script>
@endpush