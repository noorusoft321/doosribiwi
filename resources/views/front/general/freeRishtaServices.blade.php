@extends('front.layouts.master')
@section('title','Free Rishta Matrimony Services in Karachi, Lahore, Islamabad, Rawalpindi, Pakistan')
@section('description', 'Free Pakistani Rishta Services in Karachi, Lahore, Islamabad, Rawalpindi, Hyderabad, Faisalabad. Online Matrimony Matchmaking Website, Best Marriage Bureau for Muslim Boys and Girls.')

@push('style')
	<style>
		.card {
			border-radius: 20px;
			box-shadow: 5px 5px 5px #0000003d;
			border: none;
			margin-bottom: 20px !important;
			height: 250px;
		}
		.card .card-body {
			display: flex;
			align-items: center;
			padding: 0 15px;
		}
		.section-card-heading {
			font-size: 30px;
			color: #D5AD6D;
			background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%);
			background: -o-linear-gradient(transparent, transparent);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			font-weight: 600;
			text-align: left;
		}
		.services-point li {
			list-style-type: circle;
			font-size: 1.1rem;
			margin-bottom: 10px;
		}
		.services-point li:before {
			color: khaki;
		}
		.rishta-services-description-icon {
			width: 100px;
			padding: 16px;
			border-radius: 50%;
			margin: 0 auto;
		}
		@media only screen and (max-width: 600px) {
			.section-card-heading {
				font-size: 22px !important;
				text-align: center;
				margin-top: 10px;
			}
			.card {
				height: auto;
			}
		}
	</style>
@endpush

@section('content')

<main>
	<div class="container-xxl">
		<br>

		<div class="row">
			<div class="col-md-8 mx-auto">
				<h2 class="align-center font-weight-600"> Doosri Biwi Services in Pakistan </h2>
				<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">
				<br>
				<h3 class="section-card-heading text-center mb-2">Embracing Polygamy the Islamic Way for a Fulfilling Life</h3>
				{{--<br>--}}
				<p class="align-center">Welcome to our platform dedicated to offering services related to polygamy, specifically addressing the concept of "doosri biwi" or second wife, within the framework of Islamic principles.</p>
				<p class="align-center">We believe that when practiced in accordance with Islamic teachings, polygamy can be a means to lead a balanced and fulfilling life.</p>
				<p class="align-center">Our mission is to provide guidance and support to individuals considering or already practicing polygamy while upholding Islamic values.</p>
			</div>
		</div>

		<div class="row">
			{{--Islamic Counseling and Guidance:--}}
			<div class="col-md-6 my-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-2 mx-auto">
								<div class="rishta-services-description-icon bg-mikado-main text-white">
									<img src="{{asset('assets/img/rishta_services/islamic-counseling-and-guidance.png')}}" width="100%">
								</div>
							</div>
							<div class="col-md-10 mx-auto my-auto">
								<h3 class="section-card-heading" style="margin-left: 14px;">Islamic Counseling and Guidance</h3>
								<ul class="services-point">
									<li>Our platform offers confidential consultations with knowledgeable Islamic scholars and counselors who can provide insights into the religious, legal, and emotional aspects of polygamy in Islam.</li>
									<li>We help individuals and couples navigate the complexities of polygamous relationships while upholding their faith.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{--Legal Assistance:--}}
			<div class="col-md-6 my-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-2 mx-auto">
								<div class="rishta-services-description-icon bg-mikado-main text-white">
									<img src="{{asset('assets/img/rishta_services/legal-assistance.png')}}" width="100%">
								</div>
							</div>
							<div class="col-md-10 mx-auto my-auto">
								<h3 class="section-card-heading" style="margin-left: 14px;">Legal Assistance</h3>
								<ul class="services-point">
									<li>Our team of legal experts can assist you in understanding the legal requirements and processes for entering into a polygamous marriage in accordance with local laws and Islamic principles.</li>
									<li>We provide guidance on obtaining the necessary documentation and ensuring compliance with legal norms.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{--Matchmaking Services:--}}
			<div class="col-md-6 my-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-2 mx-auto">
								<div class="rishta-services-description-icon bg-mikado-main text-white">
									<img src="{{asset('assets/img/rishta_services/matchmaking-services.png')}}" width="100%">
								</div>
							</div>
							<div class="col-md-10 mx-auto my-auto">
								<h3 class="section-card-heading" style="margin-left: 14px;">Matchmaking Services</h3>
								<ul class="services-point">
									<li>For individuals seeking a second spouse, our discreet and confidential matchmaking service connects them with like-minded partners who share their Islamic values and vision for a harmonious polygamous marriage.</li>
									<li>Our platform respects your preferences and ensures privacy throughout the process.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{--Family Mediation:--}}
			<div class="col-md-6 my-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-2 mx-auto">
								<div class="rishta-services-description-icon bg-mikado-main text-white">
									<img src="{{asset('assets/img/rishta_services/family-mediation.png')}}" width="100%">
								</div>
							</div>
							<div class="col-md-10 mx-auto my-auto">
								<h3 class="section-card-heading" style="margin-left: 14px;">Family Mediation</h3>
								<ul class="services-point">
									<li>We understand that introducing a second wife into a family can be a delicate matter. Our skilled mediators can facilitate open and respectful discussions to maintain family harmony.</li>
									<li>We aim to bridge communication gaps and find solutions that align with Islamic principles.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{--Marriage Enrichment Programs:--}}
			<div class="col-md-6 my-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-2 mx-auto">
								<div class="rishta-services-description-icon bg-mikado-main text-white">
									<img src="{{asset('assets/img/rishta_services/marriage-enrichment-programs.png')}}" width="100%">
								</div>
							</div>
							<div class="col-md-10 mx-auto my-auto">
								<h3 class="section-card-heading" style="margin-left: 14px;">Marriage Enrichment Programs</h3>
								<ul class="services-point">
									<li>We offer educational resources and workshops to help couples thrive in polygamous marriages. </li>
									<li>These resources cover topics such as effective communication, time management, and financial planning while adhering to Islamic values.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{--Supportive Community:--}}
			<div class="col-md-6 my-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-2 mx-auto">
								<div class="rishta-services-description-icon bg-mikado-main text-white">
									<img src="{{asset('assets/img/rishta_services/supportive-community.png')}}" width="100%">
								</div>
							</div>
							<div class="col-md-10 mx-auto my-auto">
								<h3 class="section-card-heading" style="margin-left: 14px;">Supportive Community</h3>
								<ul class="services-point">
									<li>Join our compassionate community of individuals who are either considering or already practicing polygamy. Here, you can share experiences, seek advice, and find understanding peers who share your journey.</li>
									<li>We foster a non-judgmental and supportive environment to address the unique challenges and joys of polygamous marriages.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		{{--<div class="w-85">--}}
			{{--<br>--}}
			{{--<h2 class="align-center font-weight-600">Help others by sharing this page and Allah will also help you in finding good match.</h2>--}}
	       	{{--<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">--}}
	       	{{--<br>--}}
		{{--</div>			--}}
		{{----}}
       	{{--<div class="row w-85">--}}
		    {{--<div class="col-md-12">--}}
		    	{{--<div class="card">--}}
		    		{{--<div class="card-body">--}}
	                    {{--Doosri Biwi <br>--}}
	                    {{--The Most Trusted Matrimonial Service in Pakistan <br>--}}
	                    {{--Official WhatsApp (Manager): +923452444262 <br>--}}
	                    {{--Consultants WhatsApp for Paid Personalized Matchmaking / Premium Matrimonial Service: <br>--}}
	                    {{--+923452444262, +923344444962, +923462141786, +923488800889 <br>--}}
	                    {{--Landline: +922134830811 <br>--}}
	                    {{--Office Time: Monday to Saturday – 11 am to 6 pm <br>--}}
	                    {{--Office opens on alternate Sunday for Family Rishta Meeting at 4 pm. <br>--}}
		    		{{--</div>--}}
		    	{{--</div>--}}
		        {{----}}
		    {{--</div>--}}
		{{--</div>--}}

	</div>
</main>

@endsection

@push('script')

@endpush