@extends('front.layouts.master')
@section('title','Block Profiles')
@section('description', 'Customer Block | Doosri Biwi')

@push('style')
	<style>
		.event-card {
			background-color: #FFFFFF;
			height: 100%;
			border-radius: 30px;
			-webkit-box-shadow: 0px 7px 22px rgba(143, 134, 196, 0.07);
			box-shadow: 0px 7px 22px rgba(143, 134, 196, 0.07);
			overflow: hidden;
			box-shadow: 5px 5px 15px 2px #082f493d;
		}

		.event-card .event-thumb {
			position: relative;
			width: 100%;
			height: 250px;
			overflow: hidden
		}

		.event-card .event-thumb img {
			position: absolute;
			width: 100%;
			height: 100%;
			-o-object-fit: contain;
			object-fit: contain;
			-o-object-position: center center;
			object-position: center center;
			top: 0;
			left: 0;
			-webkit-user-drag: none;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none
		}

		.event-card .event-content {
			padding: 25px 25px
		}

		.event-card .event-content .event-content-header {
			position: relative
		}

		.event-card .event-content .event-content-header .event-content-date-book {
			position: absolute;
			display: -ms-grid;
			display: grid;
			background-color: #363848;
			padding: 13px 13px;
			bottom: 0;
			left: 0;
			gap: 10px;
			border-radius: 50rem
		}

		.event-card .event-content .event-content-header .event-content-date-book .event-date {
			display: -ms-grid;
			display: grid;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			justify-content: center;
			font-size: calc(1.3rem + 0.6vw);
			font-weight: 700;
			color: #FFFFFF;
			padding: 5px 0;
			text-align: center
		}

		@media (min-width: 1200px) {
			.event-card .event-content .event-content-header .event-content-date-book .event-date {
				font-size: 1.75rem
			}
		}

		.event-card .event-content .event-content-header .event-content-date-book .event-date span {
			font-size: 1rem;
			font-weight: 600;
			color: rgba(255, 255, 255, 0.44)
		}

		.event-card .event-content .event-content-header .event-content-date-book .btn-event-book {
			display: -webkit-inline-box;
			display: -ms-inline-flexbox;
			display: inline-flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			justify-content: center;
			background-color: rgba(255, 255, 255, 0.11);
			color: #FFFFFF;
			padding: 16px 16px;
			border-radius: 50rem;
			-webkit-box-shadow: none;
			box-shadow: none
		}

		.event-card .event-content .event-content-header .event-content-date-book .btn-event-book:hover {
			background-color: #FF477E;
			color: #FFFFFF
		}

		.event-card .event-content .event-content-header .event-content-date-book .btn-event-book svg {
			width: 25px;
			height: 25px
		}

		/*.event-card .event-content .event-content-header .event-content-info {*/
			/*padding-left: 98px*/
		/*}*/

		.event-card .event-content .event-content-header .event-content-info .event-categories {
			font-size: 1rem;
			font-weight: 600;
			letter-spacing: 2px;
			text-transform: uppercase
		}

		.event-card .event-content .event-content-header .event-content-info .event-categories .event-categories-link {
			color: #082f49;
			text-decoration: none
		}

		.event-card .event-content .event-content-header .event-content-info .event-title {
			font-size: 1.25rem;
			font-weight: 600;
			line-height: 1.5;
			margin-bottom: 0;
			margin-top: 5px
		}

		.event-card .event-content .event-content-header .event-content-info .event-title .event-title-link {
			color: #363848;
			text-decoration: none
		}

		.event-card .event-content .event-content-footer {
			margin-top: 14px
		}

		.event-card .event-content .event-content-footer .event-summary {
			font-size: 0.9375rem;
			font-weight: 400;
			line-height: 1.5;
			color: #363848
		}

		.event-card .event-content .event-content-footer .event-summary p:last-child {
			margin-bottom: 0
		}

		.event-card.complete .event-content-date-book {
			background-color: #30C736 !important
		}

		.event-card.complete .event-content-date-book .btn-event-book {
			background-color: #FFFFFF !important;
			color: #30C736 !important
		}

		.event-card.cancelled .event-content-date-book {
			background-color: #FF5353 !important
		}

		.event-card.cancelled .event-content-date-book .btn-event-book {
			background-color: #FFFFFF !important;
			color: #FF5353 !important
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
						<h5 class="card-header">Block Profiles</h5>
						<div class="card-body">
							<div class="row mt-60">
								@forelse($blockCustomers as $val)
									@php $uniqueProfileSlug = $val->gender_name.'-proposal-'.(!empty($val->getCitySlug)?$val->getCitySlug->slug:'na').'-'.(!empty($val->getCountrySlug)?$val->getCountrySlug->slug:'na').'-'.$val->id; @endphp
									<div class="col-md-4 mtb-20">
										<div class="event-card complete">
											<div class="event-thumb">
												<a href="{{route('search.by.slug',[$uniqueProfileSlug])}}">
													<img src="{{$val->imageFullPath}}" alt="{{$val->full_name}}"/>
												</a>
											</div>
											<div class="event-content">
												<div class="event-content-header">
													<div class="event-content-info text-center">
														<h2 class="event-title">
															<a class="event-title-link"
															   href="{{route('search.by.slug',[$uniqueProfileSlug])}}">{{$val->full_name}}</a>
														</h2>
														<div class="event-categories">
															<a class="event-categories-link"
															   href="{{route('search.by.slug',[$uniqueProfileSlug])}}">
																{{(!empty($val->getOccupationName)) ? $val->getOccupationName->name : 'Occupation'}}
															</a>
															<br>
															<br>
															<button onclick="unblockCustomer(this,'{{$val->faker_id}}')" class="btn btn-outline-primary">Unblock User</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								@empty
									<div class="col-md-4 mtb-20">
										<div class="event-card complete">
											<div class="event-content">
												<div class="alert alert-danger mx-auto">Info! No blocked profile found</div>
											</div>
										</div>
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
        function unblockCustomer(input, customerId) {
            if(confirm('Are you sure, you want to unblock this user?')){
                $(input).attr('disabled',true);
                axios.post("{{route('customer.block')}}", {customer_id:customerId}).then(function (res) {
                    alertyFy(res.data.msg,res.data.status,3000);
                    if (res.data.status=='success') {
                        location.reload();
                    }
                    setTimeout(function () {
                        $(input).attr('disabled',false);
                    },2000);
                }).catch(function (error) {
                    alertyFy('There is something wrong','warning',3000);
                    $(input).attr('disabled',false);
                });
			}
        }
	</script>
@endpush