@extends('front.layouts.master')

@section('title','FAQs - Free Pakistani Rishta | Matrimonial Website | Matrimony Services | Marriage Bureau')
@section('description', 'FAQs - Free Pakistani Rishta | Matrimonial Website | Matrimony Services | Marriage Bureau | Shaadi.org.pk')

@push('style')
	<style></style>
@endpush

@section('content')

	<main class="main">
		<div class="container-xxl">
			<br>
			<h2 class="align-center font-weight-600"> FAQ'S </h2>
			<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">
			<!-- /.heading-section -->
			<div class="row">
				<div class="col-md-12">
					<div id="accordion" class="accordion">
						<div class="card mb-0">
							<div class="card-header" data-toggle="collapse" href="#one">
								<a class="card-title">
									Q. What is the procedure to
									create a profile on Shaadi.org.pk?
								</a>
							</div>
							<div id="one" class="card-body collapse show" data-parent="#accordion" >
								To post your profile on shaadi.org.pk, you just need to fill out our FREE Registration Form which is easy and completely FREE of cost.
							</div>


							<div class="card-header collapsed" data-toggle="collapse" href="#second">
								<a class="card-title">Q. Can I edit my Profile? If yes, then what will be the procedure?
								</a>
							</div>
							<div id="second" class="card-body collapse" data-parent="#accordion" >
								You can edit your profile anytime you want. Simply log in to your account and click on the edit settings option.
							</div>


							<div class="card-header collapsed" data-toggle="collapse" href="#third">
								<a class="card-title">Q. How can I change my email address after getting registered with Shaadi.org.pk?
								</a>
							</div>
							<div id="third" class="card-body collapse" data-parent="#accordion" >
								After getting registered with Shaadi.org.pk, you can change your email at any time by logging into your account and using the Settings option.
							</div>


							<div class="card-header collapsed" data-toggle="collapse" href="#four">
								<a class="card-title">Q. Is it safe to add a photo to my profile?
								</a>
							</div>
							<div id="four" class="card-body collapse" data-parent="#accordion" >
								Yes, of course. Shaadi.org.pk ensures that your photograph is watermarked. This way, your photo is protected from being tampered with.
							</div>

							<div class="card-header collapsed" data-toggle="collapse" href="#five">
								<a class="card-title">Q. I have a problem with uploading my photograph. An error message is displayed which says that the image must be in jpg, gif, bmp, tiff or png format. What should I do now?
								</a>
							</div>
							<div id="five" class="card-body collapse" data-parent="#accordion" >
								Jpg, gif, bmp, tiff, and png are actually the popular image formats which are compatible online, so Shaadi.org.pk only accepts these formats for your profile photo.
							</div>

							<div class="card-header collapsed" data-toggle="collapse" href="#six">
								<a class="card-title">Q. Can I remove my photo from my Profile?
								</a>
							</div>
							<div id="six" class="card-body collapse" data-parent="#accordion" >
								Yes, you can remove your photo from your profile anytime you want.
							</div>


							<div class="card-header collapsed" data-toggle="collapse" href="#seven">
								<a class="card-title">Q. How can I search for a match on Shaadi.org.pk?
								</a>
							</div>
							<div id="seven" class="card-body collapse" data-parent="#accordion" >
								You can search for a match by specifying your criteria such as age, education, marital status, religion, location, height, and so on.
							</div>


							<div class="card-header collapsed" data-toggle="collapse" href="#eight">
								<a class="card-title">Q. Can I shortlist a profile that I like?
								</a>
							</div>
							<div id="eight" class="card-body collapse" data-parent="#accordion" >
								Yes, you can shortlist profiles. Simply add them to your friend list by sending them a Friend Request.
							</div>


						</div>
					</div>
					<!-- /.accordion-number-component -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container -->
		<!-- = /. Why Us Section = -->

		<div class="mt-xl-43"></div>
		<!-- = /. Gap Section = -->

	</main>

@endsection

@push('script')
	<script></script>
@endpush