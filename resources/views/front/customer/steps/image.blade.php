@extends('front.layouts.master')

@section('title',$title)

@push('style')
	<link rel="stylesheet" href="{{asset('assets/css/progress-step-form.css')}}">
	<style>
		.button {
			background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
		}
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

		}
		.red {
			color: white;
			background: red;
			padding: 2px;
		}
		.green{
			color: white;
			background: green;
			padding: 2px;
		}
		.full-width {
			width: 100%;
		}
		.drop-zone {
			max-width: 200px;
			height: 200px;
			padding: 25px;
			display: flex;
			align-items: center;
			justify-content: center;
			text-align: center;
			font-family: "Quicksand", sans-serif;
			font-weight: 500;
			font-size: 20px;
			cursor: pointer;
			color: #cccccc;
			border: 4px dashed #009578;
			border-radius: 10px;
		}
		ul.image-notallowed {
			list-style-type: none;
			margin: 0;
			padding: 0;
			overflow: hidden;
		}
		ul.image-notallowed li {
			float: left;
			margin-right: 10px;
			text-align: center;
		}
		.radio-inline__label {
			border: 1px solid #082f49;
		}
		.radio-inline__label {
			display: inline-block;
			padding: 0.5rem 1rem;
			margin-right: 18px;
			border-radius: 3px;
			transition: all .2s;
		}
		.radio-inline__input:checked + .radio-inline__label {
			/*background: #040F2E;*/
			background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);
			color: #fff;
			text-shadow: 0 0 1px rgba(0, 0, 0, .7);
		}
		.radio-inline__input {
			visibility: hidden;
		}
		input.radio-inline__input {
			display: none;
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
									<div id="msform">
										<ul id="progressbar">
											<li class="active" id="account"><strong>Verify</strong></li>
											<li class="active" id="education"><strong>Career</strong></li>
											<li class="active" id="personal"><strong>Personal</strong></li>
											<li class="active" id="religion"><strong>Religion</strong></li>
											<li class="active" id="expectations"><strong>Expectations</strong></li>
											<li class="active" id="uploadImage"><strong>Image</strong></li>
											<li id="confirm"><strong>Finish</strong></li>
										</ul>

										<!-- fieldsets -->
										<fieldset>
											<div class="form-card">
												<div class="row">

													<div class="col-md-6 mtb-20">
														<div class="row">
															<div class="col-md-4">
																<img class="full-width"
																	 src="{{asset('assets/img/sample-profile-photo.png')}}" >
															</div>
															<div class="col-md-8">
																<h4>Guidelines</h4>
																<p><i class="fa fa-solid fa-check green"
																	  aria-hidden="true"></i> Passport Style</p>
																<p><i class="fa fa-solid fa-check green"
																	  aria-hidden="true"></i> Clear face Image</p>
																<p><i class="fa fa-solid fa-times red" aria-hidden="true"></i>
																	No sun Glasses</p>
																<p><i class="fa fa-solid fa-times red" aria-hidden="true"></i>
																	No Snapchat filters</p>
																<p><i class="fa fa-solid fa-times red" aria-hidden="true"></i>
																	No Blurry</p>
																<p><i class="fa fa-solid fa-times red" aria-hidden="true"></i>
																	No Bodyshot</p>
																<p><i class="fa fa-solid fa-times red" aria-hidden="true"></i>
																	No Cartoon</p>
																<p><i class="fa fa-solid fa-times red" aria-hidden="true"></i>
																	No Group</p>
																<p><i class="fa fa-solid fa-times red" aria-hidden="true"></i>
																	No Offensive</p>
																<p><i class="fa fa-solid fa-times red" aria-hidden="true"></i>
																	No Scenic</p>
															</div>
														</div>
													</div>

													<div class="col-md-6 mtb-20 box-padding">
														<div class="row">
															<div class="col-md-6 my-auto">
																You can blur picture:
																<p style="font-size: 12px;color: #082f49">Blur picture reduces number of proposals.</p>
															</div>
															<div class="col-md-6 my-auto">
																<div class="form-group">
																	<select onchange="makeBlur()" name="blur_percent" id="blur_percent" class="form-control">
																		<option value="" selected>Original</option>
																		<option value="10" {{($customer->blur_percent=="10") ? 'selected' : ''}}>Soft</option>
																		<option value="15" {{($customer->blur_percent=="15") ? 'selected' : ''}}>Medium</option>
																		<option value="25" {{($customer->blur_percent=="25") ? 'selected' : ''}}>Heavy</option>
																	</select>
																</div>
															</div>
															<div class="col-md-6 my-auto">
																<p>Who can see my profile picture:</p>
															</div>
															<div class="col-md-6 my-auto">
																<div class="form-group">
																	<fieldset style="padding-left: 0;">
																		<input id="radio1" class="radio-inline__input" type="radio" name="profile_pic_client_status" value="1"
																				{{($customer->profile_pic_client_status==1) ? 'checked' : ''}}>
																		<label class="radio-inline__label" for="radio1">
																			Everyone
																		</label>

																		<input id="radio2" class="radio-inline__input" type="radio" name="profile_pic_client_status" value="0"
																				{{($customer->profile_pic_client_status==0) ? 'checked' : ''}}>
																		<label class="radio-inline__label" for="radio2">
																			Only Me
																		</label>
																	</fieldset>
																</div>
															</div>
														</div>
														<div class="drop-zone">
															@if(!empty($customer->image))
																<span class="drop-zone__prompt">
                                                            		<img class="full-width" src="{{asset('customer-images')}}/{{$customer->image}}" id="main_image_view">
                                                        		</span>
															@else
																<span class="drop-zone__prompt"><img class="full-width" src="{{asset('customer-images/default-user.png')}}" id="main_image_view"></span>
															@endif
														</div>
														<br>
														<div class="form-group">
															<input type="file" name="image" id="image"  title="Click to change image" accept="image/png, image/gif, image/jpeg, image/jpg"  required>
														</div>
													</div>
												</div>
											</div>

											<button onclick="saveForm(this)" type="button" class="btn action-button">Next</button>
											<a href="{{route('expectation.form')}}" type="button" class="btn action-button">Previous</a>
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
        let formData = new FormData();
        let imageFile = '';
		$(function () {
            $('input[name="image"]').change(function() {
                imageFile = this;
                readURL(this);
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                formData.append('image', input.files[0]);
                formData.append('profile_pic_client_status', $(':input[name="profile_pic_client_status"]:checked').val());
                formData.append('blur_percent', $(':input[name="blur_percent"] option:selected').val());
                reader.onload = function (e) {
                    $(':input').removeClass('has-error');
                    $('.text-danger').remove();
                    $('img#main_image_view').attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
                makeBlur();
            }
        }
        
        function makeBlur() {
            if (imageFile.files && imageFile.files[0]) {
                formData.append('blur_percent', $(':input[name="blur_percent"] option:selected').val());
                axios.post("{{route('image.preview.pixelate')}}", formData).then(function (res) {
                    if (res.data.status=='success') {
                        $('img#main_image_view').attr('src',res.data.imageFile);
                    }
                    console.log('response',res.data)
                }).catch(function (error) {
                    console.log('errors',error.response.data.errors);
                });
            }
        }

        function saveForm(input){
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            
            if ($(':input[name="blur_percent"]').val()) {
                Swal.fire({
                    title: 'Are you sure you want to Blur?',
                    text: "It will decreases your profile visibility",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0c476e',
                    cancelButtonColor: '#075385',
                    confirmButtonText: 'Agree'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post("{{route('profile.image.save')}}", formData).then(function (res) {
                            alertyFy(res.data.msg,res.data.status,3000);
                            if (res.data.status=='success') {
                                setTimeout(function () {
                                    location.href = "{{route('finish.form')}}";
                                },2500);
                                return false;
                            }
                            $(input).attr('disabled',false);
                        }).catch(function (error) {
                            $(input).attr('disabled',false);
                            if (error.response.status==422) {
                                $.each(error.response.data.errors, function (k, v) {
                                    $(':input[name="' + k + '"]').addClass("has-error");
                                    $(':input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                                });
                            } else {
                                alertyFy('There is something wrong','warning',3000);
                            }
                        });
                    }
                    $(input).attr('disabled',false);
                });
			} else {
                axios.post("{{route('profile.image.save')}}", formData).then(function (res) {
                    alertyFy(res.data.msg,res.data.status,3000);
                    if (res.data.status=='success') {
                        setTimeout(function () {
                            location.href = "{{route('finish.form')}}";
                        },2500);
                        return false;
                    }
                    $(input).attr('disabled',false);
                }).catch(function (error) {
                    $(input).attr('disabled',false);
                    if (error.response.status==422) {
                        $.each(error.response.data.errors, function (k, v) {
                            $(':input[name="' + k + '"]').addClass("has-error");
                            $(':input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                        });
                    } else {
                        alertyFy('There is something wrong','warning',3000);
                    }
                });
			}
            $(input).attr('disabled',false);
        }
	</script>
@endpush