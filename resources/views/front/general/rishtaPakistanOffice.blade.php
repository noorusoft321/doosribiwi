@extends('front.layouts.master')
@section('title','Rishta Pakistan Office  - Free Pakistani Rishta | Matrimonial Website | Matrimony Services | Marriage Bureau')
@section('description', 'The Most Trusted Matrimonial Service in Pakistan Join Doosri Biwi')

@push('style')
	{{--Style--}}
@endpush

@section('content')

	<div class="mt-xl-43"></div>

	<div class="container-xxl">
		<div class="d-grid w-md-80 w-xl-54 mb-10 mx-auto gap-12">
			<h1 class="heading-section-3 text-center mb-0">Our Offices</h1>
			<img src="{{asset('images/doosri-biwi-thin-border.png')}}" class="img-align-center heading-border">
			<div class="heading-text-2 lh-base text-center">
				@if(!empty($ourOfficeDescription) && !empty($ourOfficeDescription['ourOfficeDescription']))

					{{$ourOfficeDescription['ourOfficeDescription']}}
				@else
					If you're looking for a life partner and don't know where to start,
					visit our offices today and our professional matchmakers
					will guide you by your preferences.
				@endif


			</div>
		</div>
	</div>
	<!-- /.heading-section -->

	<div class="container-xxl py-60 overflow-hidden overflow-xxl-visible">
		<div class="portfolio">
			@foreach($ourOffices as $val)
				<a class="card-g">
					<div class="content">
						<span class="title">{{$val->title}}</span>
					</div>
					<div class="image">
						<img src="{{asset('ourOffices/'.$val->main_image)}}" alt="{{$val->title}}">
					</div>
				</a>
			@endforeach
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Meeting Lounge</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}ourOffices/62537.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Service Checkers</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}ourOffices/78706.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Operational Unit</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}ourOffices/181.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Waiting Area</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}ourOffices/29686.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Surveillance Team</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}ourOffices/81650.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Shaadi  Representatives</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}ourOffices/61612.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Place to Meet &amp; Greet</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}ourOffices/48134.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">obligation Guiders</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}ourOffices/72465.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Matchmakers Badge</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}ourOffices/77222.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Consultant's Team</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}ourOffices/64244.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Rapid Responders</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}ourOffices/69718.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
			{{--<a class="card-g">--}}

				{{--<div class="content">--}}
					{{--<span class="title">Administrative Circle</span>--}}
				{{--</div>--}}
				{{--<div class="image">--}}

					{{--<img src="{{asset('')}}ourOffices/34647.png" alt="">--}}


				{{--</div>--}}
			{{--</a>--}}
		</div>
	</div>

@endsection

@push('script')

@endpush