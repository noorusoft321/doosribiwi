@extends('front.layouts.master')
@section('title','Pakistans Most Trusted Matchmaking Service')
@section('description', 'Pakistani One Stop Destination for Perfect Matchmaking - DoosriBiwi.com - Let us help you find the Love of your Life and the Soulmate you Desire.')

@push('style')
	<style>
		.card {
			border-radius: 10px;
			box-shadow: 5px 5px 5px #0000003d;
			border: none;
			margin-bottom: 20px !important;
            border-left: 3px solid #0000003d;
            border-top: 3px solid #0000003d;
		}

        .card-dark {
            background: #222f52;
            color: #ffffff;
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
        .services-point {
            padding-left: 15px;
        }
        .services-point li {
			list-style-type: none;
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
		}
	</style>
@endpush

@section('content')

<main>
	<div class="container-xxl">
		<br>
		<div class="row">
			<div class="col-md-8 mx-auto">
				<h2 class="align-center font-weight-600"> About Us </h2>
				<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">
				<h3 class="section-card-heading text-center mt-2 mb-2">Welcome to DoosriBiwi.com</h3>
                <p class="align-center">This platform dedicated to helping individuals embrace the practice of polygamy while upholding strong Islamic values.</p>
                <p class="align-center">Our mission is to provide a range of services and support that empower our users to lead harmonious life, rooted in the teachings of Islam.</p>
                <p class="align-center font-weight-600">Here's an in-depth look at what we stand for:</p>
			</div>
		</div>

        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card card-dark">
                    <div class="card-body">
                        <h3 class="section-card-heading">
                            Our Vision
                        </h3>
                        <ul class="services-point">
                            <li class="text-white">At DoosriBiwi.com, our vision is simple yet profound: we aim to create a world where individuals can explore and embrace polygamous relationships within the framework of Islamic principles. </li>
                            <li class="text-white">We believe that with the right guidance and support, polygamy can be a path to a more fulfilling and harmonious life.</li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3 class="section-card-heading">
                            Our Services
                        </h3>
                        <ul class="services-point">
                            <li>Our platform offers a comprehensive suite of services tailored to your needs. </li>
                            <li>We provide a secure and supportive environment for individuals to connect, share experiences, and find like-minded individuals who share their values and vision for polygamous relationships.</li>
                        </ul>
                    </div>
                </div>

                <div class="card card-dark">
                    <div class="card-body">
                        <h3 class="section-card-heading">
                            Guidance and Support
                        </h3>
                        <ul class="services-point">
                            <li class="text-white">We understand that practicing polygamy can be a complex and personal journey. That's why we offer guidance and support to assist you every step of the way. </li>
                            <li class="text-white">Whether you're new to polygamy or have experience, our team is here to provide the assistance you need.</li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3 class="section-card-heading">
                            Empowering Your Choices
                        </h3>
                        <ul class="services-point">
                            <li>We believe in empowering individuals to make informed decisions about their relationships. </li>
                            <li>Our platform provides the resources and tools to help you navigate the world of polygamy while adhering to Islamic values.</li>
                        </ul>
                    </div>
                </div>

                <div class="card card-dark">
                    <div class="card-body">
                        <h3 class="section-card-heading">
                            A Harmonious Life
                        </h3>
                        <ul class="services-point">
                            <li class="text-white">Harmony in relationships is at the core of our philosophy. Through DoosriBiwi.com, you can connect with individuals who share your desire for unity, respect, and understanding in a polygamous context. </li>
                            <li class="text-white">We are committed to promoting harmonious lives and lasting connections.</li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3 class="section-card-heading">
                            Embracing Islamic Values
                        </h3>
                        <ul class="services-point">
                            <li>Our foundation is built upon the core principles of Islam. Our commitment to Islamic values is unwavering. </li>
                            <li>We believe that it's possible to practice polygamy while adhering to the teachings of Islam. </li>
                            <li>DoosriBiwi.com is dedicated to ensuring that every interaction on our platform is respectful and in accordance with these values.</li>
                        </ul>
                    </div>
                </div>

                <div class="card card-dark">
                    <div class="card-body">
                        <h3 class="section-card-heading">
                            Consultation and Exploration
                        </h3>
                        <ul class="services-point">
                            <li class="text-white">We provide consultation services for individuals seeking expert advice on polygamous relationships. </li>
                            <li class="text-white">Whether you're exploring the concept or ready to take the next step, our experts are here to guide you.</li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3 class="section-card-heading">
                            Exploring New Beginnings
                        </h3>
                        <ul class="services-point">
                            <li>DoosriBiwi.com is an invitation to explore the potential for meaningful connections. </li>
                            <li>We encourage you to engage with our community and discover companionship that complements your lifestyle.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

	</div>
</main>

@endsection

@push('script')

@endpush