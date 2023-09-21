@extends('front.layouts.master')

@section('title',$title)

@push('style')
	<link rel="stylesheet" href="{{asset('assets/css/progress-step-form.css')}}">
	<style>
		.fit-image {
			width: 70%;
			object-fit: cover;
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
											<li class="active" id="education"><strong>Career</strong></li>
											<li class="active" id="personal"><strong>Personal</strong></li>
											<li class="active" id="religion"><strong>Religion</strong></li>
											<li class="active" id="expectations"><strong>Expectations</strong></li>
											<li class="active" id="uploadImage"><strong>Image</strong></li>
											<li class="active" id="confirm"><strong>Finish</strong></li>
										</ul>

										<!-- fieldsets -->
										<fieldset>
											<div class="form-card">
												<h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
												<div class="row justify-content-center">
													<div class="col-3"><img src="{{asset('assets/img/complete.png')}}" class="fit-image"></div>
												</div>
												<br><br>
												<div class="row justify-content-center">
													<div class="col-7 text-center">
														<h5 class="purple-text text-center">Your profile has been completed.</h5>
													</div>
												</div>
											</div>
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
		alertyFy("Your profile has been completed.","success",3000);
		setTimeout(function () {
            location.href = "{{route('landing.page')}}";
        },3000);
	</script>
@endpush