@extends('front.layouts.master')
@section('title',$title)
@section('description', $title)

@push('style')
	<style>
		.main--content {
			text-align: center;
		}
		.container-image img {
			width: 120px;
			height: 120px;
			border-radius: 50%;
		}
		.container-image {
			position: relative;
			width: 50%;
			margin-right: 5px;
		}
		.overlay {
			position: absolute;
			top: -50px;
			bottom: 0;
			left: 0;
			right: 0;
			height: 120px;
			width: 120px;
			opacity: 0;
			transition: .5s ease;
			background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);
			border-radius: 50%;
		}
		.container-image:hover .overlay {
			opacity: 1;
		}
		.overlay .text {
			color: #fff;
			font-size: 15px;
			position: absolute;
			top: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			text-align: center;
		}

		.article-circle{
			background: #ddd;
			width: 120px;
			height: 120px;
			position: relative;
			box-sizing: border-box;
			border-radius: 50%;
			margin-right: 5px;
			margin-bottom: 5px;
		}
		.article-circle .circles-img {
			width: 120px;
			height: 120px;
			background: #bbb;
			border-radius: 50%;
			margin-left: -10px;
		}
		.article-circle .shimmer{
			position: absolute;
			top: 0;
			left: 0;
			width: 50%;
			height: 100%;
			background: linear-gradient(100deg,
			rgba(255,255,255,0) 20%,
			rgba(255,255,255,0.25) 50%,
			rgba(255,255,255,0) 80%);
			animation: shimmer 1s infinite linear;
		}
		@keyframes shimmer{
			from {
				transform: translateX(-200%);
			}
			to{
				transform: translateX(200%);
			}
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
					<div class="card">
						<h5 class="card-header">{{$title}}</h5>
						<div class="card-body">
							<h2 class="heading-section-4 text-dark mb-0">
								Like ({{$customerYouLiked}})
								<button onclick="fetchRelatedData(this,'youLike')" class="float-end bg-white" title="Like"><i class="fa fa-eye text-theme"></i></button>
							</h2>
							<hr>
							<h2 class="heading-section-4 text-dark mb-0">
								Save ({{$customerYouSaved}})
								<button onclick="fetchRelatedData(this,'youSave')" class="float-end bg-white" title="Save"><i class="fa fa-eye text-theme"></i></button>
							</h2>
							<hr>
							<h2 class="heading-section-4 text-dark mb-0">
								Interested in You ({{$customerOtherViews}})
								<button onclick="fetchRelatedData(this,'otherView')" class="float-end bg-white" title="Interested in you"><i class="fa fa-eye text-theme"></i></button>
							</h2>
							<hr>
							<h2 class="heading-section-4 text-dark mb-0">
								Like By Other ({{$customerOtherLiked}})
								<button onclick="fetchRelatedData(this,'otherLike')" class="float-end bg-white" title="View Profiles"><i class="fa fa-eye text-theme"></i></button>
							</h2>
							<hr>
							<h2 class="heading-section-4 text-dark mb-0">
								Save By Other ({{$customerOtherSaved}})
								<button onclick="fetchRelatedData(this,'otherSave')" class="float-end bg-white" title="View Profiles"><i class="fa fa-eye text-theme"></i></button>
							</h2>
						</div>
					</div>

					<div class="main--content"></div>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection

@push('script')
	<script>
		let shimmarHtml = `<div class="card">
								<div class="card-body">
									<div class="row text-center justify-content-around">
										<div class="article-circle">
											<div class="circles-img"></div>
											<div class="shimmer"></div>
										</div>
										<div class="article-circle">
											<div class="circles-img"></div>
											<div class="shimmer"></div>
										</div>
										<div class="article-circle">
											<div class="circles-img"></div>
											<div class="shimmer"></div>
										</div>
										<div class="article-circle">
											<div class="circles-img"></div>
											<div class="shimmer"></div>
										</div>
										<div class="article-circle">
											<div class="circles-img"></div>
											<div class="shimmer"></div>
										</div>
										<div class="article-circle">
											<div class="circles-img"></div>
											<div class="shimmer"></div>
										</div>
										<div class="article-circle">
											<div class="circles-img"></div>
											<div class="shimmer"></div>
										</div>
									</div>
								</div>
							</div>`;
		function fetchRelatedData(input,dataType) {
            $(input).attr('disabled',true);
            $('.main--content').empty().hide();
		    $('.main--content').html(shimmarHtml).show('slow');
		    axios.post("{{route('customer.like.save.view.profiles')}}", `data_type=${dataType}`).then(function (res) {
				(res.data) ? $('.main--content').html(res.data).show() : $('.main--content').empty().hide();
                setTimeout(function () {
                    $(input).attr('disabled',false);
                },1000)
            }).catch(function (error) {
                $('.main--content').empty().hide();
                $(input).attr('disabled',false);
            });
        }
	</script>
@endpush