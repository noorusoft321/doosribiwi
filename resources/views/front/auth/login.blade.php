@extends('front.layouts.master')

@section('title','Sign In - Free Pakistani Rishta | Matrimonial Website | Matrimony Services | Marriage Bureau')
@section('description',"If you're looking for a life partner and don't know where to start, visit our offices today and our professional matchmakers will guide you in accordance with your preferences Join Shaadi.org")

@push('style')
	{{----}}
@endpush

@section('content')
	<main class="main position-relative">
		<div class="mt-xl-43"></div>
		<div class="container-xxl">
			<div class="row justify-content-md-center">
				<div class="col-md-5">
					<div class="card">
						<h5 class="card-header">Sign In</h5>
						<div class="card-body">

							@if(session()->has('error_message'))
								<div class="alert alert-secondary dark alert-dismissible fade show" role="alert"><strong>Info
										! </strong> {{session()->get('error_message')}}.
									<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
											data-bs-original-title="" title=""></button>
								</div>
							@endif
							@if(session()->has('success_message'))
								<div class="alert alert-success dark alert-success fade show" role="alert"><strong>Success
										! </strong> {{session()->get('success_message')}}.
									<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
											data-bs-original-title="" title=""></button>
								</div>
							@endif
							@if(session()->has('info_message'))
								<div class="alert alert-info dark alert-dismissible fade show" role="alert"> {{session()->get('info_message')}}.
									<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
											data-bs-original-title="" title=""></button>
								</div>
							@endif

							<form method="post" class="row" id="signInForm">
								@csrf
								<div class="col-12 my-1">
									<div class="form-group">
										<label class="email">* Enter your Email Address / Mobile Number</label>
										<input type="text" name="email" placeholder="Enter your Email Address / Mobile Number" class="form-control rounded-pill">
									</div>
								</div>
								<div class="col-12 my-1">
									<div class="form-group">
										<label class="password">* Password</label>
										<input type="password" name="password" id="password" placeholder="Password" minlength="6" class="form-control rounded-pill">
										<i class="fa fa-eye" id="togglePassword"></i>
									</div>
								</div>

								<br>
								<a class="link font-weight-600 m-2" href="{{route('view.forgot.password')}}">Forgot your password?</a>
								<div class="col-12 col-lg mx-auto my-auto">
									<a type="button" onclick="authAct()" class="btn--login btn btn-outline-primary font-weight-600 w-100 heading-5">Sign In</a>
								</div>
								<br>
								{{--<div class="divider d-flex align-items-center my-4">--}}
									{{--<p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>--}}
								{{--</div>--}}

								{{--<div class="col-12">--}}
									{{--<div class="row center my-auto">--}}
										{{--<div class="col-12 col-lg mx-auto my-auto">--}}
											{{--<a type="button" href="{{route('social.login',['google'])}}" class="btn btn-outline-primary font-weight-600 mb-2 w-100 heading-5"> Sign In With Google</a>--}}
										{{--</div>--}}
										{{--<div class="col-12 col-lg mx-auto my-auto">--}}
											{{--<a type="button" href="{{route('social.login',['facebook'])}}" class="btn btn-outline-primary font-weight-600 mb-2 w-100 heading-5"> Sign In With Facebook</a>--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--</div>--}}

								<div class="col-12 text-center mt-2">
									<p class="m-1">Don't have an account? <a class="link font-weight-600" href="{{route('view.register')}}">Register</a></p>
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
		$(function () {
            $('#signInForm :input').on('keypress',function(e) {
                if(e.which == 13) {
                    authAct();
                }
            });
        });
        function authAct() {
            $('button.btn--login').attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('login.process')}}", $('#signInForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    location.href = res.data.redirectUrl;
				}
                setTimeout(function () {
                    $('button.btn--login').attr('disabled',false);
                },2000);
            }).catch(function (error) {
                $('button.btn--login').attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#signInForm input[name="' + k + '"]').addClass("has-error");
                        $('#signInForm input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
				} else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }
	</script>
@endpush