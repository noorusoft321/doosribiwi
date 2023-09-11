@extends('front.layouts.master')
@section('title','Family Rishta Meeting')
@section('description', 'Meet with multiple families of various backgrounds live, and choose the match best suited for you. Shaadi.org delivers you best Rishta Consultancy Marriages are Made In Heaven But are Celebrated On Earth.')

@push('style')
	{{--Style--}}
@endpush

@section('content')

	<div class="mt-xl-43"></div>

	<div class="container-xxl">
		<div class="d-grid w-md-80 w-xl-54 mb-10 mx-auto gap-12">
			<h1 class="heading-section-3 text-center mb-0">Family
				Meetings</h1>
			<img src="{{asset('home_page/heading-border.png')}}" class="img-align-center heading-border">
			<div class="heading-text-2 lh-base text-center">

                <?php

                $familyRishtaMeetingDescription = App\Models\footerContent::select('familyRishtaMeetingDescription')->where('deleted', 0)->first();

                ?>
				@if(!empty($familyRishtaMeetingDescription) && !empty($familyRishtaMeetingDescription['familyRishtaMeetingDescription']))

					{{$familyRishtaMeetingDescription['familyRishtaMeetingDescription']}}

				@else
					Doosri Biwi is thankful
					to
					our Chief Guests who visited us or participated in our events of matchmaking and encouraged
					us
					to
					keep doing the good social work.

				@endif


			</div>
		</div>
	</div>
	<!-- /.heading-section -->

	<div class="container-xxl py-60 overflow-hidden overflow-xxl-visible">
		<div class="portfolio">
			@foreach($familyRishtaMeetings as $val)
				<a class="card-g">
					<div class="content">
						<span class="title">{{$val->title}}</span>
					</div>
					<div class="image">
						<img src="{{asset('familyRishtaMeetings/'.$val->main_image)}}" alt="{{$val->title}}">
					</div>
				</a>
			@endforeach
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Promoting Obligations</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}familyRishtaMeetings/23621.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Counseling Session</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}familyRishtaMeetings/62605.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Verified Profiles Meetup</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}familyRishtaMeetings/69548.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Counseling Session</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}familyRishtaMeetings/96649.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Verified Profiles Meetup</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}familyRishtaMeetings/70339.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Authenticity Checkup</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}familyRishtaMeetings/19043.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Desirable Assembly</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}familyRishtaMeetings/82284.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Family Oriented Proposals</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}familyRishtaMeetings/61585.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Authenticity Checkup</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}familyRishtaMeetings/31121.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Disability Awareness Session</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}familyRishtaMeetings/9543.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Weekly Meetup</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}familyRishtaMeetings/95788.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">One on One Talk</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}familyRishtaMeetings/47303.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
		</div>
	</div>

@endsection

@push('script')

@endpush