@extends('front.layouts.master')
@section('title','Social Connections')
@section('description', 'Join us now on our social media pages and interact with Shaadi.org.pk members to find the life partner for marriage.')

@push('style')
	{{--Style--}}
@endpush

@section('content')

<main>
	<div class="container-xxl">
		<br>
        <h2 class="align-center font-weight-600"> Social Connections </h2>
       	<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">
       	<br>
		<div class="row">
		    <div class="col-md-6">
		        <div class="card elite-text-content social-h p-40">
		            <div class="card-body">
		            	
		                    <h3 class="heading-section-3 text-dark mb-0">Social Connections</h3>
		                    <br>
		                    <div class="heading-text-2 lh-base text-dark">
		                    	<strong>Hi, looking for a life patner?</strong>
		                    	<br>
		                        <p>
		                           If you are an active user of social networks then you are in for some surprise. You can now join us on our social media pages and send your profile on AIR for everyone to see. The best part is that people will contact you personally and you can interact with them to find your perfect soul mate for marriage.
		                        </p>
		                    </div>
		                    <a class="btn btn-outline-primary font-weight-600 p-lr-30" href="tel:+923452444262"> <i class="fa fa-heart"></i> 100000 LAC PLUS LIKES</a>
		                    <a class="btn btn-outline-primary font-weight-600 p-lr-30" href="tel:+923452444262"> <i class="fa fa-heart"></i> 100000 LAC PLUS FOLLOWERS</a>
		            </div>
		        </div>
		        <!-- /.card-icon-component -->
		    </div>
		    <!-- /.col -->
		    <div class="col-md-6">
		        <div class="card social-h p-33" style="gap:21px;">
		            <div class="card-body">
		            	<img class="full-width" src="{{asset('web_images/shaadi-organization-social-meida.png')}}">
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