@extends('admin.layouts.master')

@section('title',$title)

@push('style')
	<style></style>
@endpush

@section('content')
	<div class="page-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-6">
					<div class="card radius-10">
						<div class="card-body">
							<h4>Profile Detail</h4>
							<div class="table-responsive">
								<table class="table table-hover">
									<tbody>
									<tr>
										<td>Name</td>
										<td>{{$user->name}}</td>
									</tr>
									<tr>
										<td>Email</td>
										<td>{{$user->email}}</td>
									</tr>
									<tr>
										<td>Role</td>
										<td>{{$user->role_name}}</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card radius-10">
						<div class="card-body">
							<h4>Change Password</h4>
							<form id="passwordUpdateForm">
								<div class="mb-3">
									<label for="password">* New Password</label>
									<input type="text" name="password" id="password" class="form-control rounded-pill">
								</div>

								<div class="mb-3">
									<label for="confirm_password">* Confirm Password</label>
									<input type="text" name="confirm_password" id="confirm_password" class="form-control rounded-pill">
								</div>

								<div class="mb-3">
									<label for="current_password">* Current Password</label>
									<input type="text" name="current_password" id="current_password" class="form-control rounded-pill">
								</div>
							</form>
							<button onclick="changePassword(this)" type="button" class="btn btn-outline-dark float-end">Update</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script')
	<script>
        function changePassword(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('admin.save.new.password')}}", $('#passwordUpdateForm').serialize()).then(function (res) {
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
	</script>
@endpush