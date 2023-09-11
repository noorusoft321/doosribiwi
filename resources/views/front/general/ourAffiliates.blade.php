@extends('front.layouts.master')
@section('title','Our Affiliates')
@section('description', 'Grow with us through our Affiliate Program. Be an affiliate of our Shaadi online business and benefit from our affiliate packages.')

@push('style')
	{{--Style--}}
@endpush

@section('content')

<main>
	<div class="container-xxl">
		<br>
        <h2 class="align-center font-weight-600"> Our Affiliates </h2>
       	<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">

		<div class="row">
		    <div class="col-md-9">
		        <div class="card about-height-hero">
		            <div class="card-body">
		                <p>Many people who get into affiliate marketing do so with the same mindset: making money first, and thinking of their audience second (if they think of them at all!). That’s a recipe for disaster or at least lousy results Doosri Biwi helps people in finding a perfect match. For this purpose we have a 100% Free Online Matrimonial website Shaadi.org.pk based on purely eastern values. With hundreds of monthly satisfied customers, we are progressing through the heights of success and generating more happiness than anyone else in this industry. We are not a commercial marriage bureau which runs purely on profit. We are an organization and our motive is to help people. To achieve this purpose we are offering many free services to people such as this 100% Free Online Rishta Pakistani Website, free rishta meetings, free place for engagement, free place for nikkah, support for simple nikkah, etc. We only charge fee from those who want to hire us for personalized matchmaking in which our time and energy is spend to find a good match. This personalized matchmaking is a time taking process but it saves time of our client so we only charge fee for this service.</p>
		            </div>
		        </div>
		        <!-- /.card-icon-component -->
		    </div>
		    <!-- /.col -->
		    <div class="col-md-3">
		        <div class="card about-height-hero">
		            <div class="card-body">
		                <img src="{{asset('customPages/normal/69704.png')}}" class="event-thumb" alt="">
		            </div>
		        </div>
		        <!-- /.card-icon-component -->
		    </div>
		    <!-- /.col -->
		</div>
		<div class="row">
		    <div class="col-md-12">
		        <div class="card">
		            <div class="card-body">
                        <h2>Working Women Welfare Trust</h2>
                        <p>Working Women Welfare Trust believes in taking approporiate measures; they are striving to equip working women with value based knowledge, technical skills, awareness about their legal, economic and social rights as well as responsibilites to acquire honorable secure and congenial working environment.<br>
                            Their moto is “Helping Hand For Relief &amp; Development”</p>
                    </div>
		        </div>
		        <!-- /.card-icon-component -->
		    </div>
		    <!-- /.col -->
		</div>
	</div>
</main>

@endsection

@push('script')

@endpush