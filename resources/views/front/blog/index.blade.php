@extends('front.layouts.master')

@section('title','Shaadi - Tips and Articles')
@section('description', 'Browse through our informative blogs and articles to get enlightened with valuable and supportive tips related to online marriage in Pakistan.')

@push('style')
	<style>
		.section-heading-blog {
			color: #082F6F;
			font-size: 2.2rem;
			font-weight: 600;
			text-align: center;
		}
		.card {
			border-radius: 20px;
			box-shadow: 0 6px 11px #0000003d;
			border: 5px solid #fff;
			padding: 20px;
			background: #f2f7fb;
		}
		.blog-card h4 {
			font-size: 1.5rem;
			color: #082F6F !important;
			font-weight: 600;
		}
		.blog-card p {
			font-size: 1rem;
			text-align: justify-all;
			color: grey;
		}
		.blog-card img {
			box-shadow: 4px 4px 12px 0px rgba(0,0,0,0.5);
			border-top-left-radius: 10px;
			border-top-right-radius: 10px;
			margin-bottom: 15px;
		}
		.blog-social-link i {
			font-size: 1.6rem;
			color: #082F6F;
		}
		.blog-card h5 {
			font-size: 1.2rem;
			font-weight: 600;
			background-image: linear-gradient(150deg, #082F6F, #063f6f 40%);
			-webkit-text-fill-color: transparent;
			-webkit-background-clip: text;
			background-clip: text;
		}
	</style>
@endpush

@section('content')
	<div class="container py-60">
		<br>
		<h1 class="section-heading-blog"> Our Blogs </h1>
		<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-border.png')}}">
		<br>

		<div class="row">
			<div class="col-md-4 mx-auto d-flex align-items-stretch">
				<div class="card">
					<div class="blog-card">
						<img src="{{asset('blogs-images/what-is-it-like-being-a-second-wife-in-islam.jpg')}}" alt="What's it Like Being a Second Wife in Islam?" class="full-width">
						<h4>What's it Like Being a Second Wife in Islam?</h4>
						<h5>Exploring the Joys and Trails</h5>
						<p>Have you ever found yourself in the middle of a lively debate about what it's like to be a second wife in Islam?</p>
						<div class="row">
							<div class="col-auto my-auto">
								<a target="_blank" class="btn btn-outline-primary font-weight-600 p-lr-30" href="{{route('what.like.being.second.wife')}}">Read More</a>
							</div>
							<div class="col my-auto text-end">
								<div class="row justify-content-end">
									<div class="col-auto">
										<a target="_blank" class="blog-social-link" href="https://www.facebook.com/DoosriBiwi">
											<i class="fab fa-facebook" aria-hidden="true"></i>
										</a>
									</div>
									<div class="col-auto">
										<a target="_blank" class="blog-social-link" href="https://instagram.com/shaadipakistan?igshid=MzRlODBiNWFlZA==">
											<i class="fab fa-instagram" aria-hidden="true"></i>
										</a>
									</div>
									<div class="col-auto">
										<a target="_blank" class="blog-social-link" href="https://www.youtube.com/channel/UC55neowM_i2A_tZQLKh0NMw">
											<i class="fab fa-youtube-play" aria-hidden="true"></i>
										</a>
									</div>
									<div class="col-auto"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script')
	<script></script>
@endpush