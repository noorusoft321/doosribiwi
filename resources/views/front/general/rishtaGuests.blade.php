@extends('front.layouts.master')
@section('title','Special Guest')
@section('description', 'Special Guest Doosri Biwi')

@push('style')
	{{--Style--}}
@endpush

@section('content')

	<div class="mt-xl-43"></div>

	<div class="container-xxl">
		<div class="d-grid w-md-80 w-xl-54 mb-10 mx-auto gap-12">
			<h1 class="heading-section-3 text-center mb-0">Our Special
				Guests</h1>
			<img src="{{asset('home_page/heading-border.png')}}" class="img-align-center heading-border">
			<div class="heading-text-2 lh-base text-center">
				@if(!empty($ourSpecialGuestDescription) && !empty($ourSpecialGuestDescription['ourSpecialGuestDescription']))

					{{$ourSpecialGuestDescription['ourSpecialGuestDescription']}}
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



			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Yahya Hussaini</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/17779.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Sarim Burney</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/34782.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Mirza Ikhtiar Baig</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/76962.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Sarfaraz Ahmed Khan</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/29233.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Babar Abbasi</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/35967.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Ali Raza Abidi</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/26085.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Shakeel Siddiqui</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/81845.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Shamoon Abbasi</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/11694.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Ms. Sabahat Ali Bhukhari</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/29227.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Zakir Mastana</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/64637.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Yogi Wajahat</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/11852.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Kashif Shah</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/82083.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Nasir Hussain Shah</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/23949.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Nisar Ahmed Khuhro</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/91998.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Gulzar Hussain</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/66135.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Ms. Sabi Arsh</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/54221.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Syed Aminul Haque</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/65766.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Dr. Farhan Essa</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/1679.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Akbar Shahbaz</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/41512.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Ms. Syeda Shehla Raza</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/80744.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Ali Noonari</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/28836.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Farhan Ally Agha</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/97750.jpg " alt="">


				</div>
			</a>




			<a class="card-g">
				<div class="content">
					<span class="title">Mr. Ahmed Chinoy</span>

				</div>
				<div class="image">

					<img src="{{asset('')}}/specialGuests/required_image/72773.jpg " alt="">


				</div>
			</a>





		</div>
	</div>

@endsection

@push('script')

@endpush