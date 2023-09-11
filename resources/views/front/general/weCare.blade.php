@extends('front.layouts.master')
@section('title','We Care')
@section('description', 'In Addition To Our Online Marriage Services, We Also Provide Educational And Matrimonial Support To Those In Need With The Help Of Our Valued Members.')

@push('style')
	{{--Style--}}
@endpush

@section('content')

<main>
	<div class="container-xxl">
		<br>
        <h2 class="align-center font-weight-600"> We Care </h2>
       	<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">

		<div class="row">
		    <div class="col-md-9">
		        <div class="card about-height-hero">
		            <div class="card-body">
		                <p>The happiness of your life depends upon the quality of your thoughts: therefore, guard accordingly, and take care that you entertain no notions unsuitable to virtue and reasonable nature. Doosri Biwi helps people in finding a perfect match. For this purpose we have a 100% Free Online Matrimonial website Shaadi.org.pk based on purely eastern values. With hundreds of monthly satisfied customers, we are progressing through the heights of success and generating more happiness than anyone else in this industry. We are not a commercial marriage bureau which runs purely on profit. We are an organization and our motive is to help people. To achieve this purpose we are offering many free services to people such as this 100% Free Online Rishta Pakistani Website, free rishta meetings, free place for engagement, free place for nikkah, support for simple nikkah, etc. We only charge fee from those who want to hire us for personalized matchmaking in which our time and energy is spend to find a good match. This personalized matchmaking is a time taking process but it saves time of our client so we only charge fee for this service.</p>
		            </div>
		        </div>
		        <!-- /.card-icon-component -->
		    </div>
		    <!-- /.col -->
		    <div class="col-md-3">
		        <div class="card about-height-hero">
		            <div class="card-body">
		                <img src="{{asset('customPages/normal/32881.png')}}" class="event-thumb" alt="">
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
						<h3>Community Services</h3>
						<p>Shaadi.org.pk believes in being active in the community in every way. Apart from our&nbsp;<strong>Pakistan matrimony</strong>&nbsp;services, we as a company lend a helping hand to multiple social work organizations occasionally. From providing for the needy to donating for the social and international causes, we offer whatever we can as Allah Almighty enables us to do.</p>
						<p>Want to Join a Cause? Contact us now at info@shaadi.org.pk</p>
						<h3>Educational Support</h3>
						<p>We are strong believers of the fact that no nation can prosper without its youth being educated.&nbsp;<strong>www.shaadi.org.pk&nbsp;</strong>offers young deserving children with a chance to study.Buy a course, stationary, support a local small charitable school and be a part of this amazing opportunity to thank for&nbsp;what Allah has blessed you with. Contact us at info@shaadi.org.pk for more details.</p>
						<p><a href="{{route('donation')}}" target="_self"><em>&nbsp;</em>&nbsp; Join The Cause</a></p>
						<h3>Marriage Support</h3>
						<p>Allah tabarak o t’aala has blessed human life with a wonderful relationship known as a&nbsp;<strong>Marriage</strong>. A relationship in which you are bonded with a person who lives to love you and support you always. Our mission is to bring together individuals and families and help them tie into this beautiful bond. We aim to support individuals in selecting their dream life partners through this&nbsp;<strong>shaadi&nbsp;online</strong>&nbsp;portal and make an informed decision to make their life a heaven on earth.</p>
						<p><a href="{{route('donation')}}" target="_self"><em>&nbsp;</em>&nbsp; Join The Cause</a></p>
						<h3>Assisted Marriage</h3>
						<p><strong>Shaadi.org.pk&nbsp;</strong>offers to provide its members with assistance in all the wedding planning and services through this&nbsp;<strong>Pakistan matrimony</strong>&nbsp;platform. Our partners are offering amazing discounts to the premium members of the site in every product and service which a wedding ceremony demands!</p>
						<h3>Free Match Making</h3>
						<p><strong>Shaadi.org.pk</strong>&nbsp;is a portal which offers you free&nbsp;<strong>rishta online</strong>&nbsp;services. Singles can register for a free account online and browse through the profiles to find the perfect match for them.</p>
					</div>
				</div>
		    </div>
		    <!-- /.col -->
		</div>
	</div>
</main>

@endsection

@push('script')

@endpush