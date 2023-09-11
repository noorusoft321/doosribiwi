@extends('front.layouts.master')
@section('title',$title)
@section('description', $title)

@push('style')
	<style>
        .img-container {
            position: relative;
            width: 100%;
            margin-bottom: 10px;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .img-container:hover .image {
            opacity: 0.3;
        }

        .img-container:hover .middle {
            opacity: 1;
        }

        .text {
            background-color: #040F2E;
            color: white;
            font-size: 16px;
            padding: 16px 32px;
        }
	</style>
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

                    @if($customer->profile_pic_status==2)
                        <div class="card">
                            <h5 class="card-header">Warning !</h5>
                            <div class="card-body">
                                <div class="d-grid gap-34">
                                    <div class="job-card-harizontal">
                                        <div class="row">
                                            <div class="col-md-2 mx-auto my-auto">
                                                @if(file_exists(public_path('customer_images/'.$customer->image)))
                                                    <a target="_blank" href="{{asset('customer_images/'.$customer->image)}}"><img src="{{asset('customer_images/'.$customer->image)}}" class="rounded-circle" alt="{{$customer->full_name}}" width="100%"></a>
                                                @else
                                                    <a target="_blank" href="{{$customer->imageFullPath}}"><img src="{{$customer->imageFullPath}}" class="rounded-circle" alt="{{$customer->full_name}}" width="100%"></a>
                                                @endif
                                            </div>
                                            <div class="col-md-10 mx-auto my-auto">
                                                <div class="alert alert-danger mx-auto">
                                                    <p class="text-danger">
                                                        <strong class="h2" style="color: #040F2E !important;">! </strong>
                                                        Your profile picture has been rejected, please updated your profile.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

					{{--Profile Image--}}
					<div class="card">
						<h5 class="card-header">Primary Photo <span style="color:#fff; font-size: 14px; margin-left: 35px;">(Your main picture)</span></h5>
						<div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col my-auto">
                                    You can blur picture:
                                    <p style="font-size: 12px;color: #040F2E">Blur picture reduces number of proposals.</p>
                                </div>
                                <div class="col-md-7">
                                    <select name="blur_percent" class="form-control">
                                        <option value="">Original</option>
                                        <option value="10" {{($customer->blur_percent=="10") ? 'selected' : ''}}>Soft</option>
                                        <option value="15" {{($customer->blur_percent=="15") ? 'selected' : ''}}>Medium</option>
                                        <option value="25" {{($customer->blur_percent=="25") ? 'selected' : ''}}>Heavy</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col my-auto">
                                    Who can see my profile picture:
                                </div>
                                <div class="col-md-7">
                                    <select name="profile_pic_client_status" class="form-control">
                                        <option value="1" {{($customer->profile_pic_client_status==1) ? 'selected' : ''}}>Everyone</option>
                                        <option value="0" {{($customer->profile_pic_client_status==0) ? 'selected' : ''}}>Only Me</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
							<div class="row">
								<div class="col-md-10 mb-2">
									<input type="file" name="image" id="image" title="Click to change image" class="form-control rounded-pill">
								</div>
								<div class="col-md-2 mb-2 text-center">
									<button onclick="saveImage(this)" class="btn btn-outline-primary font-weight-600 p-lr-30"> Update </button>
								</div>
							</div>
						</div>
					</div>
					{{--Gallery Images--}}
					<div class="card">
						<h5 class="card-header">Image Gallery</h5>
						<div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col my-auto">
                                    Who can see my gallery photos:
                                </div>
                                <div class="col-md-7">
                                    <select onchange="changeStatus(this)" name="profile_gallery_client_status" class="form-control">
                                        <option value="1" {{($customer->profile_gallery_client_status==1) ? 'selected' : ''}}>Everyone</option>
                                        <option value="0" {{($customer->profile_gallery_client_status==0) ? 'selected' : ''}}>Only Me</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
							<div class="row">
								<div class="col-md-10 mb-2">
									<input type="file" name="public_gallery[]" id="public_gallery" title="Click to add photos" class="form-control rounded-pill" multiple>
								</div>
								<div class="col-md-2 mb-2 text-center">
									<button onclick="savePhotos(this)" class="btn btn-outline-primary font-weight-600 p-lr-30"> Add Photos </button>
								</div>
							</div>
                            <hr>
                            <div class="row">
                                @forelse($photos as $key => $val)
                                    <div class="col-md-3">
                                        <div class="img-container">
                                            <img src="{{asset('customer_images/'.$val->image)}}" alt="Photo {{$key}}" class="image" style="width:100%;height: 100%">
                                            <div class="middle">
                                                <button onclick="deletePhoto(this)" data-image-id="{{$val->faker_id}}" type="button" class="text">
                                                    <i class="fa fa-trash fa-lg text-white"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-danger text-center">
                                        Info! No gallery photos found
                                    </div>
                                @endforelse
                            </div>
						</div>
					</div>
				</div>		
			</div>
		</div>
	</div>
</main>

@endsection

@push('script')
	<script>
        function saveImage(input){
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            let newImage = '';
            if ($('input[name="image"]').val()) {
                newImage = document.getElementById('image').files[0];
			}
            let formData = new FormData();
            formData.append('image', newImage);
            formData.append('profile_pic_client_status', $('select[name="profile_pic_client_status"] option:selected').val());
            formData.append('blur_percent', $('select[name="blur_percent"] option:selected').val());

            axios.post("{{route('profile.image.save')}}", formData).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    setTimeout(function () {
                        location.reload();
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

        function savePhotos(input){
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            let newImage = '';
            if ($('input[id="public_gallery"]').val()) {
                newImage = document.getElementById('public_gallery').files;
            }
            let formData = new FormData();
            if (newImage && newImage.length > 0) {
                $.each(newImage, function (k, v) {
                    formData.append('public_gallery[]', v);
                });
            } else {
                formData.append('public_gallery[]', newImage);
            }

            axios.post("{{route('gallery.photos.save')}}", formData).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    setTimeout(function () {
                        location.reload();
                    },2500);
                    return false;
                }
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $(':input[id="public_gallery"]').addClass("has-error");
                    $.each(error.response.data.errors, function (k, v) {
                        $(':input[id="public_gallery"]').after("<span class='text-danger d-block'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

        function deletePhoto(input) {
            $(input).attr('disabled',true);
            if(confirm('Are you sure, you want to delete this?')){
                axios.post("{{route('gallery.delete.photo')}}", {photo_id:$(input).attr('data-image-id')}).then(function (res) {
                    alertyFy(res.data.msg,res.data.status,3000);
                    if (res.data.status=='success') {
                        let imageParentDiv = $(input).parent().parent().parent();
                        imageParentDiv.hide('slow');
                        setTimeout(function () {
                            imageParentDiv.remove();
                        },2500);
                    }
                    $(input).attr('disabled',false);
                }).catch(function (error) {
                    alertyFy('There is something wrong','warning',3000);
                    $(input).attr('disabled',false);
                });
            }
        }
        
        function changeStatus(input) {
            if(confirm('Are you sure, you want to change status?')){
                let formData = { profile_pic_client_status: $(input).val() }
                if ($(input).attr('name')=='profile_gallery_client_status') {
                    formData = { profile_gallery_client_status: $(input).val() }
                }
                axios.post("{{route('save.profile.client.status')}}", formData).then(function (res) {
                    alertyFy(res.data.msg,res.data.status,3000);
                }).catch(function (error) {
                    alertyFy('Status has not been changed*','warning',3000);
                });
            } else {
                $(input).val($(input).val()==0 ? 1 : 0);
            }
        }
	</script>
	{{--Script--}}
@endpush