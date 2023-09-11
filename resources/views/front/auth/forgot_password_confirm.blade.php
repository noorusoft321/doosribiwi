@extends('front.layouts.master')

@section('title','Update your password')

@push('style')
	{{--Style--}}
@endpush

@section('content')
	<main class="main position-relative">
		<div class="mt-xl-43"></div>
		<div class="container-xxl">
			<div class="row justify-content-md-center">
				<div class="col-md-5">
					<div class="card">
						<h5 class="card-header">Update your password</h5>
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
								<div class="col-12">
									<div class="form-group mb-4">
										<label for="email">* Enter your Email</label>
										<input type="email" name="email" placeholder="Enter your Email Address" class="form-control rounded-pill" value="{{$email}}" readonly>
									</div>
									<div class="form-group mb-4">
										<label for="password">* Password</label>
										<input type="text" name="password" placeholder="Password" class="form-control rounded-pill">
									</div>
									<div class="form-group mb-4">
										<label for="confirm_password">* Confirm Password</label>
										<input type="text" name="confirm_password" placeholder="Confirm Password" class="form-control rounded-pill">
									</div>
								</div>
								<div class="col-md-12 text-end">
									<button type="button" onclick="authAct(this)" class="btn btn-outline-primary font-weight-600">Submit</button>
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
            axios.post("{{route('forget.password.confirm.process')}}", $('#signInForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    setTimeout(function () {
						location.href = "{{route('view.login')}}";
                    },3000);
					return false;
				}
                $(input).attr('disabled',false);
            }).catch(function (error) {
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#signInForm input[name="' + k + '"]').addClass("has-error");
                        $('#signInForm input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
				} else {
                    alertyFy('There is something wrong','warning',3000);
                }
                $(input).attr('disabled',false);
            });
        }
	</script>
@endpush