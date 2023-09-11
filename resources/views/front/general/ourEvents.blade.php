@extends('front.layouts.master')
@section('title','Rishta Pakistan, Shaadi Marriage Bureau, Best Muslima Matrimonial in Pakistan Karachi, Lahore, Islamabad, Faisalabad, Rawalpindi, Gujranwala, Peshawar, Multan, Hyderabad, Islamabad, Quetta. Shia Match available.')
@section('description', 'Rishta Pakistan, Shaadi Marriage Bureau, Best Muslima Matrimonial in Pakistan Karachi, Lahore, Islamabad, Faisalabad, Rawalpindi, Gujranwala, Peshawar, Multan, Hyderabad, Islamabad, Quetta. Shia Match available.')

@push('style')
	<style>
		.events-heading {
			text-align: center !important;
			font-weight: bold;
		}
		.img-fluid {
			box-shadow: 6px 6px 12px 0px rgba(0,0,0,0.4);
			border-radius: 5px;
			margin-bottom: 20px;
			width: 100%;
		}
		.card {
			border-radius: 20px;
			box-shadow: 5px 5px 5px #0000003d;
			border: none;
		}
		.section-card-heading {
			font-size: 25px;
			color: #D5AD6D;
			background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%);
			background: -o-linear-gradient(transparent, transparent);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			font-weight: 600;
			text-align: center;
			margin: 10px 0px 15px 0px;
		}
		@media only screen and (max-width: 600px) {
			.section-card-heading {
				font-size: 20px !important;
			}
			.container-xxl {
				padding: 10px !important;
			}
		}
	</style>
@endpush

@section('content')
	<br>
	<div class="container-xxl p-tb-20">
		<div class="d-grid mx-auto gap-12">
			<h1 class="heading-section-3 text-dark text-center mb-0">Our Events</h1>
			<img src="{{asset('home_page/heading-border.png')}}" class="img-align-center heading-border">
		</div>
	</div>

	@if(!empty($ourEvents))
		@foreach($ourEvents as $ourEvent)
			<div class="container-xxl p-tb-20">
				<div class="card">
					<div class="card-body">
						<div class="row mx-auto">
							<h3 class="section-card-heading">{{$ourEvent['title']}}</h3>
						</div>
						<div class="row">
                            <?php $ourEventArr = explode('|', $ourEvent['main_image']); ?>
							@if(!empty($ourEventArr))
								@foreach($ourEventArr as $ourEventAr)
									@if(!empty($ourEventAr))
										<div class="col-md-2 mx-auto my-auto text-center" data-image-name="{{$ourEventAr}}">
											<img src="{{asset('ourEvents')}}/{{$ourEventAr}}" class="img-fluid">
										</div>
									@endif
								@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@endif
@endsection
@push('script')
@endpush