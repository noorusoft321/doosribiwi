@extends('front.layouts.master')
@section('title',$title)
@section('description', $title)

@push('style')
	{{--Style--}}
@endpush

@section('content')

<main>
	<div class="dashboard">
		<div class="container">
			<div class="row">
				<div class="col-md-3 side-bar-dashboard">
					@include('front.customer.partials.sidebar')
				</div>
				<div class="col-md-9 main-dashboard">
					{{--Change Email--}}
					<div class="card">
						<h5 class="card-header">Change Email</h5>
						<div class="card-body">
							<form id="emailUpdateForm">
								<div class="col-6">
									<div class="mb-2">
										<label class="fieldlabels" for="email">* New Email</label>
										<input type="email" name="email" id="email" class="form-control rounded-pill">
									</div>

									<div class="mb-2">
										<label class="fieldlabels" for="confirm_email">* Confirm Email</label>
										<input type="email" name="confirm_email" id="confirm_email" class="form-control rounded-pill">
									</div>

									<div class="mb-2">
										<label class="fieldlabels" for="current_password">* Current Password</label>
										<input type="text" name="current_password" id="current_password" class="form-control rounded-pill">
									</div>
								</div>
								<div class="col-12 text-end">
									<button onclick="changeEmail(this)" type="button" class="btn btn-outline-primary font-weight-600">Update Email</button>
								</div>
							</form>
						</div>
					</div>

					{{--Change Password--}}
					<div class="card">
						<h5 class="card-header">Change Password</h5>
						<div class="card-body">
							<form id="passwordUpdateForm">
								<div class="col-6">
									<div class="mb-2">
										<label class="fieldlabels" for="password">* New Password</label>
										<input type="text" name="password" id="password" class="form-control rounded-pill">
									</div>

									<div class="mb-2">
										<label class="fieldlabels" for="confirm_password">* Confirm Password</label>
										<input type="text" name="confirm_password" id="confirm_password" class="form-control rounded-pill">
									</div>

									<div class="mb-2">
										<label class="fieldlabels" for="current_password">* Current Password</label>
										<input type="text" name="current_password" id="current_password" class="form-control rounded-pill">
									</div>
								</div>
								<div class="col-12 text-end">
									<button onclick="changePassword(this)" type="button" class="btn btn-outline-primary font-weight-600">Update Password</button>
								</div>
							</form>
						</div>
					</div>

					{{--Change Username--}}
					{{--<div class="card">--}}
						{{--<h5 class="card-header">Change Username</h5>--}}
						{{--<div class="card-body">--}}
							{{--<form id="nameUpdateForm">--}}
								{{--<div class="col-6">--}}
									{{--<div class="mb-2">--}}
										{{--<label class="fieldlabels" for="name">* New Username</label>--}}
										{{--<input onchange="title_to_slug(this)" type="text" name="name" id="name" class="form-control rounded-pill">--}}
									{{--</div>--}}

									{{--<div class="mb-2">--}}
										{{--<label class="fieldlabels" for="confirm_name">* Confirm Username</label>--}}
										{{--<input onchange="title_to_slug(this)" type="text" name="confirm_name" id="confirm_name" class="form-control rounded-pill">--}}
									{{--</div>--}}

									{{--<div class="mb-2">--}}
										{{--<label class="fieldlabels" for="current_password">* Current Password</label>--}}
										{{--<input type="text" name="current_password" id="current_password" class="form-control rounded-pill">--}}
									{{--</div>--}}
								{{--</div>--}}
								{{--<div class="col-12 text-end">--}}
									{{--<button onclick="changeName(this)" type="button" class="btn btn-outline-primary font-weight-600">Update Username</button>--}}
								{{--</div>--}}
							{{--</form>--}}
						{{--</div>--}}
					{{--</div>--}}
				</div>		
			</div>
		</div>
	</div>
</main>

@endsection

@push('script')
	<script>
		function changeEmail(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('save.new.email')}}", $('#emailUpdateForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    $('#emailUpdateForm :input').val('');
                }
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#emailUpdateForm input[name="' + k + '"]').addClass("has-error");
                        $('#emailUpdateForm input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

        function changePassword(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('save.new.password')}}", $('#passwordUpdateForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    $('#passwordUpdateForm :input').val('');
                }
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#passwordUpdateForm input[name="' + k + '"]').addClass("has-error");
                        $('#passwordUpdateForm input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

        function changeName(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('save.new.name')}}", $('#nameUpdateForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    $('#nameUpdateForm :input').val('');
                }
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#nameUpdateForm input[name="' + k + '"]').addClass("has-error");
                        $('#nameUpdateForm input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }
	</script>
@endpush