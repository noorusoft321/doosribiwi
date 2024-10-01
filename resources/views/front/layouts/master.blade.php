<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="@yield('description')">
	<title>@yield('title') | {{config('services.app_name')}}</title>

	@if(Route::current()->getName()=="landing.page")
		<link rel="canonical" href="https://doosribiwi.com/" />
	@endif

	@if(env('APP_ENV')=='production')
	<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=AW-969297351">
		</script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'AW-969297351');
		</script>
	@endif

	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="@yield('title') | {{config('services.app_name')}}" />
	<meta property="og:description" content="@yield('description')" />
	<meta property="og:url" content="{{url()->full()}}" />
	<meta property="og:site_name" content="{{config('services.app_name')}}" />
	<meta property="og:image" content="{{asset('images/rishta-pakistan-doosri-biwi.jpg')}}" />
	<meta property="og:image:secure_url" content="{{asset('images/rishta-pakistan-doosri-biwi.jpg')}}" />
	<meta property="og:image:width" content="640" />
	<meta property="og:image:height" content="640" />

	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:description" content="@yield('description')" />
	<meta name="twitter:title" content="@yield('title') | {{config('services.app_name')}}" />
	<meta name="twitter:site" content="@ShaadiOrgPk" />
	<meta name="twitter:image" content="{{asset('images/rishta-pakistan-doosri-biwi.jpg')}}" />
	<meta name="twitter:creator" content="@ShaadiOrgPk" />

	<link rel='dns-prefetch' href='//platform.twitter.com' />
	<link rel='dns-prefetch' href='//fonts.googleapis.com' />
	<link rel='dns-prefetch' href='//s.w.org' />

	<link rel="icon" href="{{asset('shaadi-admin/images/favicon-32x32.png')}}" type="image/png" />
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
	<link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
	<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
	@stack('style')
	<style>
		.alert-dismissible {
			background: #ff2100 !important;
			color: #fff !important;
		}
		.form-group i#togglePassword {
			float: right;
			padding-right: 5px;
			margin-top: -28px;
			cursor: pointer;
			color: #0c476e;
			font-size: 15px;
			transition-delay: 250ms;
		}
		.form-group i#togglePassword:hover {
			font-size: 18px;
			transition-delay: 250ms;
		}

		.social-btn-group {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			padding-left: 0;
			list-style: none;
		}
		.social-btn-group .social-item .social-link i {
			display: inline-flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			justify-content: center;
			width: 45px;
			height: 45px;
			border-radius: 50rem;
			-webkit-transition: color 0.25s ease-in-out, background-color 0.25s ease-in-out, border-color 0.25s ease-in-out;
			transition: color 0.25s ease-in-out, background-color 0.25s ease-in-out, border-color 0.25s ease-in-out;
			color: #FFFFFF !important;
			font-size: 22px;
		}
		#goTopButton {
			display: inline-block;
			/*background-color: #040F2E;*/
			background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);
			width: 50px;
			height: 50px;
			text-align: center;
			border-radius: 4px;
			position: fixed;
			bottom: 10px;
			right: 70px;
			transition: background-color .3s,
			opacity .5s, visibility .5s;
			opacity: 0;
			visibility: hidden;
			z-index: 1000;
		}
		#goTopButton::after {
			content: "\f077";
			font-family: FontAwesome;
			font-weight: normal;
			font-style: normal;
			font-size: 2em;
			line-height: 50px;
			color: #fff;
		}
		#goTopButton:hover {
			cursor: pointer;
			background-color: #004085;
		}
		#goTopButton:active {
			background-color: #004085;
		}
		#goTopButton.show {
			opacity: 1;
			visibility: visible;
		}
		.text-golden {
			color: #D5AD6D;
			background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(255 216 155) 61%, rgba(213,173,109,1) 100%);
			background: -o-linear-gradient(transparent, transparent);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			text-align: center;
		}
		.custom-btn {
			width: 100%;
			height: 30px;
			color: #fff;
			border-radius: 5px;
			font-family: 'Poppins', sans-serif;
			font-weight: 500;
			font-size: 14px;
			background: transparent;
			cursor: pointer;
			transition: all 0.3s ease;
			position: relative;
			display: inline-block;
			box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
			7px 7px 20px 0px rgba(0,0,0,.1),
			4px 4px 5px 0px rgba(0,0,0,.1);
			outline: none;
		}
		.btn-match {
			border: none;
			background: rgb(230, 46, 4);
			background: linear-gradient(0deg, rgb(230, 46, 4) 0%, rgb(242, 97, 65) 100%);
			color: #fff;
			overflow: hidden;
		}
        .btn-view-profile {
            border: none;
            background: rgb(64, 168, 230);
            background: linear-gradient(0deg, rgb(64, 168, 230) 0%, rgb(54, 184, 230) 100%);
            color: #fff;
            overflow: hidden;
        }
		.btn-view-call {
			border: none;
			background: green;
			background: linear-gradient(0deg, green 0%, #13B955 100%);
			color: #fff;
			overflow: hidden;
		}
		.custom-btn:hover {
			text-decoration: none;
			color: #fff;
			opacity: .8;
		}
		.custom-btn:before {
			position: absolute;
			content: '';
			display: inline-block;
			top: -180px;
			left: 0;
			width: 30px;
			height: 100%;
			background-color: #fff;
			animation: shiny-btn1 3s ease-in-out infinite;
		}
		.custom-btn:active{
			box-shadow:  4px 4px 6px 0 rgba(255,255,255,.3),
			-4px -4px 6px 0 rgba(116, 125, 136, .2),
			inset -4px -4px 6px 0 rgba(255,255,255,.2),
			inset 4px 4px 6px 0 rgba(0, 0, 0, .2);
		}
		@-webkit-keyframes shiny-btn1 {
			0% { -webkit-transform: scale(0) rotate(45deg); opacity: 0; }
			80% { -webkit-transform: scale(0) rotate(45deg); opacity: 0.5; }
			81% { -webkit-transform: scale(4) rotate(45deg); opacity: 1; }
			100% { -webkit-transform: scale(50) rotate(45deg); opacity: 0; }
		}
		.mobileShow {
			display: none !important;
		}
		.mobileHide {
			display: block !important;
		}
		.main-header {
			background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);
			box-shadow: 0px 5px 5px #082f493d;
		}
		.nav-link:hover {
			color: #fff;
		}
		iframe {
			border: 0;
			border-radius: 6px;
			box-shadow: 6px 6px 12px 0px rgba(0,0,0,0.4);
			height: 270px;
		}
		.alert.alert-success, .alert.alert-success strong {
			color: #0b0a0f !important;
		}
		.alert.alert-success button {
			float: right;
		}
		.toggle-main {
			display: none !important;
		}
		.featured-detail {
			text-align: center;
		}
		.featured-detail p {
			font-size: 1.1rem;
			color: #ffffff;
		}
		.featured-detail p strong {
			font-size: 1.2rem;
			color: goldenrod;
		}
		.featured-detail h3 {
			font-size: 1.5rem;
			color: #ffffff;
		}
		.featured-detail h3 strong {
			font-size: 2rem;
			color: goldenrod;
		}
		.bg-blast {
			background: #075385;
			background: linear-gradient(90deg, #075385 0%, #0c476e 52%, #075385 100%);
			/*background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);*/
		}
		@keyframes glowing {
			0% {
				background-color: #DDAC17;
				box-shadow: 0 0 5px #ECC440;
			}
			50% {
				background-color: #ECC440;
				box-shadow: 0 0 20px #DDAC17;
			}
			100% {
				background-color: #DDAC17;
				box-shadow: 0 0 5px #DDAC17;
			}
		}
		.packageTable td:first-child {
			font-weight: 500;
			color: #ccc;
		}

		/* Button used to open the chat form - fixed at the bottom of the page */
		.open-button {
			display: inline-block;
			background-color: #13B955;
			width: 50px;
			height: 50px;
			border-radius: 25px;
			text-align: center;
			position: fixed;
			bottom: 10px;
			right: 10px;
			z-index: 1000;
		}

		/* The popup chat - hidden by default */
		.chat-popup {
			display: none;
			/*display: block;*/
			position: fixed;
			bottom: 10px;
			right: 10px;
			border-radius: 10px;
			box-shadow: -10px -5px 20px #0000003d;
			border: none;
			z-index: 1000;
			width: 350px;
			max-width: 100%;
			padding: 10px;
			background: #ffffff;
			height: max-content;
			/*max-height: max-content;*/
			text-align: center;
		}
		.chat-popup p {
			font-size: .9rem;
			color: #767676;
			padding-bottom: 5px;
			/*border-top: 2px solid #9B2C47;*/
			/*border-bottom: 2px solid #9B2C47;*/
		}
		.chat-popup p b {
			font-size: 1rem;
			color: #767676;
			font-weight: 600;
		}
		.support-buttons button {
			margin-top: 10px;
			padding: 10px 25px;
			border: none;
			border-radius: 20px;
			margin-left: 10px;
			color: #fff;
			font-weight: 600;
		}
		.support-buttons button:nth-child(1) {
			background: #13B955;
		}
		.support-buttons button:nth-child(2) {
			background: #9B2C47;
		}
		/* General GDPR Banner Styling */
		.gdpr-banner {
			position: fixed;
			bottom: 0;
			width: 100%;
			background-color: #fff;
			color: #000;
			padding: 20px;
			z-index: 9999;
			box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.2);
		}

		.gdpr-banner-content {
			align-items: center;
			justify-content: center;
			margin: auto;
		}

		.gdpr-logo {
			text-align: center;
		}

		.gdpr-logo-img {
			width: 60%;
			height: auto;
			text-align: center;
		}

		.gdpr-text-section {
			flex: 1;
		}

		/* Text Styling */
		.gdpr-banner-text {
			font-size: 16px;
			line-height: 1.5;
			margin-bottom: 20px;
		}

		.gdpr-link {
			color: #085282;
			text-decoration: underline;
			font-weight: 500;
		}
		.gdpr-link:hover {
			font-weight: 600;
		}

		/* GDPR Categories Styling */
		.gdpr-categories {
			display: flex;
			gap: 20px;
			margin-bottom: 20px;
		}

		.gdpr-category {
			display: flex;
			align-items: center;
			font-size: 14px;
		}

		.gdpr-category span {
			margin-right: 10px;
			font-weight: 500;
		}

		/* Toggle Switch Styling */
		.toggle-switch {
			position: relative;
			display: inline-block;
			width: 50px;
			height: 20px;
		}

		.toggle-switch input {
			opacity: 0;
			width: 0;
			height: 0;
		}

		.slider-gdpr {
			position: absolute;
			cursor: pointer;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: #ccc;
			border-radius: 34px;
			transition: 0.4s;
		}

		.slider-gdpr:before {
			position: absolute;
			content: "";
			height: 14px;
			width: 14px;
			border-radius: 50%;
			left: 4px;
			bottom: 3px;
			background-color: white;
			transition: 0.4s;
		}

		input:checked + .slider-gdpr {
			background-color: #085282;
		}

		input:checked + .slider-gdpr:before {
			transform: translateX(18px);
		}
		.hidden {
			display: none;
		}
		@media only screen and (max-width: 600px) {
			html, body {
				width: 100% !important;
				overflow-x: hidden !important;
			}
			.mobileShow {
				display: block !important;
			}
			.mobileHide {
				display: none !important;
			}
			.nav-link {
				color: #ffffff;
			}
			.nav-item {
				margin-left: 15px;
			}
			iframe {
				margin-bottom: 10px;
				height: 200px;
			}
			.toggle-main {
				display: flex !important;
			}
			/* GDPR Categories Styling */
			.gdpr-categories {
				display: grid;
			}
			.gdpr-banner-text {
				font-size: 14px;
			}
		}
	</style>
</head>

<body>

<div id="gdpr-consent-banner" class="gdpr-banner hidden">
	<div class="gdpr-banner-content row">
		<div class="col-auto">
			<div class="gdpr-logo">
				<img src="{{ asset('images/doosri-biwi-dark-logo.png') }}" alt="DoosriBiwi.Com" class="gdpr-logo-img">
			</div>
		</div>
		<div class="col">
			<div class="gdpr-text-section">
				<h4 class="font-weight-600">This website uses cookies</h4>
				<p class="gdpr-banner-text">
					We use cookies to personalize content and ads, provide social media features, and analyze our traffic. We also share information about your use of our site with our social media, advertising, and analytics partners, who may combine it with other information that you have provided to them or that they have collected from your use of their services.
					<a target="_blank" href="{{ route('privacy.policy') }}" class="gdpr-link">Learn more</a>
				</p>

				<div class="gdpr-categories">
					<div class="gdpr-category">
						<span>Necessary</span>
						<label class="toggle-switch">
							<input type="checkbox" id="necessary-cookies" checked disabled>
							<span class="slider-gdpr"></span>
						</label>
					</div>
					<div class="gdpr-category">
						<span>Preferences</span>
						<label class="toggle-switch">
							<input type="checkbox" id="preferences-cookies">
							<span class="slider-gdpr"></span>
						</label>
					</div>
					<div class="gdpr-category">
						<span>Statistics</span>
						<label class="toggle-switch">
							<input type="checkbox" id="statistics-cookies">
							<span class="slider-gdpr"></span>
						</label>
					</div>
					<div class="gdpr-category">
						<span>Marketing</span>
						<label class="toggle-switch">
							<input type="checkbox" id="marketing-cookies">
							<span class="slider-gdpr"></span>
						</label>
					</div>
				</div>

				<div class="gdpr-buttons">
					<button id="accept-all-gdpr" class="btn btn-outline-primary font-weight-600 p-lr-30 mb-2">Allow All</button>
					<button id="save-gdpr" class="btn btn-outline-primary font-weight-600 p-lr-30 mb-2">Allow Selection</button>
					<button id="deny-gdpr" class="btn btn-outline-primary font-weight-600 p-lr-30 mb-2">Deny</button>
				</div>
			</div>
		</div>
	</div>
</div>

<a id="goTopButton" title="Go to top"></a>
<button class="open-button" title="Website Support" onclick="openSupportBox()">
	<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-hipchat" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17.802 17.292s.077 -.055 .2 -.149c1.843 -1.425 3 -3.49 3 -5.789c0 -4.286 -4.03 -7.764 -9 -7.764c-4.97 0 -9 3.478 -9 7.764c0 4.288 4.03 7.646 9 7.646c.424 0 1.12 -.028 2.088 -.084c1.262 .82 3.104 1.493 4.716 1.493c.499 0 .734 -.41 .414 -.828c-.486 -.596 -1.156 -1.551 -1.416 -2.29z" /><path d="M7.5 13.5c2.5 2.5 6.5 2.5 9 0" /></svg>
</button>
<div class="chat-popup">
	<form id="chatSupportForm">
		<h5 class="text-theme font-weight-600">Website Support</h5>
		<p>
			If you have any query regarding the website, please ask.
			<br>
			<b>اگر آپ کو ویب سائٹ کے بارے میں کوئی سوال ہے، تو براہ کرم پوچھیں۔</b>
		</p>
		<hr>
		<div class="form-group my-3">
			<label class="float-start" for="full_name">Full Name*</label>
			<input type="text" name="full_name" id="full_name" class="form-control">
		</div>
		<div class="form-group my-3">
			<label class="float-start" for="mobile_number">Mobile Number* <sub>(Use country code)</sub> </label>
			<input type="text" name="mobile_number" id="mobile_number" class="form-control">
		</div>
		<div class="form-group my-3">
			<label class="float-start" for="discussion">Message*</label>
			<textarea name="discussion" id="discussion" class="form-control" rows="2"></textarea>
		</div>
		<div class="support-buttons">
			<button type="button" onclick="sendSupportMessage(this)">Send</button>
			<button type="button" onclick="closeSupportBox()">Close</button>
		</div>
	</form>
</div>
{{-- Start Header --}}
@include('front.layouts.header')
{{-- End Header --}}

<!--start Main Content -->
@yield('content')
<!--end Main Content -->

{{-- Start Footer --}}
@include('front.layouts.footer')
{{-- End Footer --}}

<!-- Featured Modal -->
@php
$packageExpiryDate = (auth()->guard('customer')->check()) ? auth()->guard('customer')->user()->package_expiry_date : null;
@endphp
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		{{--style="background: rgb(4,15,46);background: linear-gradient(90deg, rgba(4,15,46,1) 0%, rgba(16,78,79,1) 52%, rgba(4,15,46,1) 100%);"--}}
		<div class="modal-content bg-blast">
			<div class="modal-header">
				<h1 class="modal-title fs-5 text-white" id="staticBackdropLabel" style="margin: 0 auto;">Get Featured your Account</h1>
			</div>
			<div class="modal-body">
				<div class="featured-detail">
					<svg style="color: rgb(218, 165, 32);width:30%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. --><path d="M576 136c0 22.09-17.91 40-40 40c-.248 0-.4551-.1266-.7031-.1305l-50.52 277.9C482 468.9 468.8 480 453.3 480H122.7c-15.46 0-28.72-11.06-31.48-26.27L40.71 175.9C40.46 175.9 40.25 176 39.1 176c-22.09 0-40-17.91-40-40S17.91 96 39.1 96s40 17.91 40 40c0 8.998-3.521 16.89-8.537 23.57l89.63 71.7c15.91 12.73 39.5 7.544 48.61-10.68l57.6-115.2C255.1 98.34 247.1 86.34 247.1 72C247.1 49.91 265.9 32 288 32s39.1 17.91 39.1 40c0 14.34-7.963 26.34-19.3 33.4l57.6 115.2c9.111 18.22 32.71 23.4 48.61 10.68l89.63-71.7C499.5 152.9 496 144.1 496 136C496 113.9 513.9 96 536 96S576 113.9 576 136z" fill="#daa520"></path></svg>

					<h3>RS. <strong>10,000</strong></h3>

					<p class="m-0">Being <strong>Featured</strong> boosts your profile's visibility.</p>
					<p> <strong>نمایاں</strong> ہونے سے آپ کے پروفائل کی مرئیت بڑھ جاتی ہے۔</p>

					<hr class="border-bottom border-white">

					<h3 class="m-1"> NOTE <span style="color:goldenrod;font-weight: 800;">&#33;</span> </h3>

					<p class="m-0 text-center"><strong>Featured</strong> limit will expire with your package</p>
					<p class="text-center"><strong>نمایاں</strong> کی حد آپ کے پیکیج کے ساتھ ختم ہو جائے گی۔</p>

					@if(!empty($packageExpiryDate))
						<hr class="border-bottom border-white">
						<p class="m-0 text-center fs-6">Your package expires on <strong class="fs-5">{{date('d F Y',strtotime($packageExpiryDate))}}</strong></p>
					@endif
				</div>
				<br>
				<div class="text-center">
					<a target="_blank" href="https://api.whatsapp.com/send?phone=923452444262&text=Hi%20Doosri.biwi.com%2C%20I%20need%20more%20information." type="button" class="button-theme-dark">Get Featured</a>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/slick.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.5/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    let authCheckGlobally = '{{auth()->guard('customer')->check()}}';

    var btn = $('#goTopButton');

    baguetteBox.run('.tz-gallery');

    AOS.init();

    document.addEventListener('DOMContentLoaded', function () {
        const banner = document.getElementById('gdpr-consent-banner');
        const acceptAllBtn = document.getElementById('accept-all-gdpr');
        const denyBtn = document.getElementById('deny-gdpr');
        const savePreferencesBtn = document.getElementById('save-gdpr');

        const preferencesCheckbox = document.getElementById('preferences-cookies');
        const statisticsCheckbox = document.getElementById('statistics-cookies');
        const marketingCheckbox = document.getElementById('marketing-cookies');

        // Check if user already accepted cookies
        if (localStorage.getItem('gdprPreferences')) {
            banner.classList.add('hidden');
        } else {
            banner.classList.remove('hidden');
        }

        // Accept all cookies
        acceptAllBtn.addEventListener('click', function () {
            localStorage.setItem('gdprPreferences', JSON.stringify({
                necessary: true,
                preferences: true,
                statistics: true,
                marketing: true
            }));
            banner.classList.add('hidden');
        });

        // Deny all cookies except necessary
        denyBtn.addEventListener('click', function () {
            localStorage.setItem('gdprPreferences', JSON.stringify({
                necessary: true,
                preferences: false,
                statistics: false,
                marketing: false
            }));
            banner.classList.add('hidden');
        });

        // Save preferences
        savePreferencesBtn.addEventListener('click', function () {
            localStorage.setItem('gdprPreferences', JSON.stringify({
                necessary: true,
                preferences: preferencesCheckbox.checked,
                statistics: statisticsCheckbox.checked,
                marketing: marketingCheckbox.checked
            }));
            banner.classList.add('hidden');
        });
    });

    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });

    $(function () {
        $("button.btn-close").click(function() {
            $('div.alert-dismissible').hide('slow');
            $('div.alert-success').hide('slow');
            setTimeout(function () {
                $('div.alert-dismissible').remove();
                $('div.alert-success').remove();
            },1000)
        });
        $('i#togglePassword').click(function() {
            let checkInput = $(this).parent().find('input');
            checkInput.attr('type', (checkInput.attr('type')=='password' ? 'text' : 'password'));
        });
    });

    // Profile Dropdown Start
    $("#navbarDropdownMenuLink").click(function(){
        $(".profile-menu").toggle();
    });

    $(document).click(function(){
        $(".profile-menu").hide();
    });

    function checkAuthLoginMessage() {
        Swal.fire({
            title: 'Please register or log in to view profile',
            icon: 'info',
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonColor: '#075385',
            confirmButtonText: 'Login',
            denyButtonText: `Register`,
        }).then((result) => {
            if (result.isConfirmed) {
                location = "{{route('view.login')}}";
            } else if (result.isDenied) {
                location = "{{route('view.register')}}";
            }
        });
        return false;
    }

    function alertyFy(message,icon,timer=3000) {
        Swal.fire({
            title: message,
            icon: icon,
            showConfirmButton: false,
            position: 'top-right',
            timer: timer
        });
        return false;
    }

    function getStates(input,putInField,selectName='Select') {
        let selectValue = selectName=='Select' ? '' : '0';
        let refrenceId = $(input).val();
        let fieldShortCode = $(`select[name="${putInField}"]`);
        let fieldTwoShortCode = $(`select[name="city_id"]`);
        if (putInField=='StateOfOrigin') {
            fieldTwoShortCode = $(`select[name="CityOfOrigin"]`);
        }
        if (refrenceId) {
            axios.get(`{{route('get.states')}}/${refrenceId}`).then(function (res) {
                fieldShortCode.empty();
                fieldShortCode.append(new Option(selectName, selectValue));
                fieldTwoShortCode.empty();
                fieldTwoShortCode.append(new Option(selectName, selectValue));
                if (res.data.data.length > 0) {
                    $.each(res.data.data, function (k, v) {
                        fieldShortCode.append(new Option(v.title, v.id));
                    });
                    return;
                }
            }).catch(function (error) {
                fieldShortCode.empty();
                fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
                fieldTwoShortCode.empty();
                fieldTwoShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
                return;
            });
        }
        fieldShortCode.empty();
        fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
        return;
    }

    function getCities(input,putInField,selectName='Select') {
        let selectValue = selectName=='Select' ? '' : '0';
        let refrenceId = $(input).val();
        let fieldShortCode = $(`select[name="${putInField}"]`);
        if (refrenceId) {
            axios.get(`{{route('get.cities')}}/${refrenceId}`).then(function (res) {
                if (res.data.data.length > 0) {
                    fieldShortCode.empty();
                    fieldShortCode.append(new Option(selectName, selectValue));
                    $.each(res.data.data, function (k, v) {
                        fieldShortCode.append(new Option(v.title, v.id));
                    });
                    return;
                }
            }).catch(function (error) {
                fieldShortCode.empty();
                fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
                return;
            });
        }
        fieldShortCode.empty();
        fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
        return;
    }

	function getAreas(input,putInField,selectName='Select') {
		let selectValue = selectName=='Select' ? '' : '0';
		let refrenceId = $(input).val();
		let fieldShortCode = $(`select[name="${putInField}"]`);
		if (refrenceId) {
			axios.get(`{{route('get.areas')}}/${refrenceId}`).then(function (res) {
				if (res.data.data.length > 0) {
					fieldShortCode.empty();
					fieldShortCode.append(new Option(selectName, selectValue));
					$.each(res.data.data, function (k, v) {
						fieldShortCode.append(new Option(v.title, v.id));
					});
					return;
				}
			}).catch(function (error) {
				fieldShortCode.empty();
				fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
				return;
			});
		}
		fieldShortCode.empty();
		fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
		return;
	}

    function getSects(input,putInField,selectName='Select') {
        let selectValue = selectName=='Select' ? '' : '0';
        let refrenceId = $(input).val();
        let fieldShortCode = $(`select[name="${putInField}"]`);
        if (refrenceId) {
            axios.get(`{{route('get.sects')}}/${refrenceId}`).then(function (res) {
                if (res.data.data.length > 0) {
                    fieldShortCode.empty();
                    fieldShortCode.append(new Option(selectName, selectValue));
                    $.each(res.data.data, function (k, v) {
                        fieldShortCode.append(new Option(v.title, v.id));
                    });
                    return;
                }
            }).catch(function (error) {
                fieldShortCode.empty();
                fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
                return;
            });
        }
        fieldShortCode.empty();
        fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
        return;
    }

    {{--function getMajorCourses(input,putInField) {--}}
        {{--let refrenceId = $(input).val();--}}
        {{--let fieldShortCode = $(`select[name="${putInField}"]`);--}}
        {{--if (refrenceId) {--}}
            {{--axios.get(`{{route('get.major.courses')}}/${refrenceId}`).then(function (res) {--}}
                {{--if (res.data.data.length > 0) {--}}
                    {{--fieldShortCode.empty();--}}
                    {{--fieldShortCode.append(new Option('Select', ''));--}}
                    {{--$.each(res.data.data, function (k, v) {--}}
                        {{--fieldShortCode.append(new Option(v.title, v.id));--}}
                    {{--});--}}
                    {{--return;--}}
                {{--}--}}
            {{--}).catch(function (error) {--}}
                {{--fieldShortCode.empty();--}}
                {{--fieldShortCode.html('<option value="">Select</option>');--}}
                {{--return;--}}
            {{--});--}}
        {{--}--}}
        {{--fieldShortCode.empty();--}}
        {{--fieldShortCode.html('<option value="">Select</option>');--}}
        {{--return;--}}
    {{--}--}}

    function copyToClipBoard(input) {
        $(input).attr('disabled',false);
        var temp = $("<input>");
        $("body").append(temp);
        temp.val($('input[name="user__name"]').val()).select();
        document.execCommand("copy");
        temp.remove();
        alertyFy('Copied successfully','success',1500);
    }

    async function checkIfExists(input) {
        $(':input').removeClass('has-error');
        $('.text-danger').remove();
        let fieldName = $(input).attr('name');
        if (fieldName=='name') {
            await title_to_slug(input);
        }
        let fieldValue = $(input).val();
        if (fieldValue && fieldName) {
            await axios.post(`{{route('customer.check.exists')}}`,{
                fieldName:fieldName,
                fieldValue:fieldValue
            }).then(function (res) {
                if (res.data.status == 'warning') {
                    $(`:input[name="${fieldName}"]`).addClass("has-error");
                    $(`:input[name="${fieldName}"]`).after(`<span class="text-danger">${res.data.msg}</span>`);
                }
            }).catch(function (error) {
                console.log('error',error);
            });
        }
    }

    $(function(){
        $(window).scroll(function(){
            var winTop = $(window).scrollTop();
            if(winTop >= 30){
                $(".main-header").addClass("sticky-header");
            }else{
                $(".main-header").removeClass("sticky-header");
            }
        });
    });

    function title_to_slug(input) {
        let title = $(input).val();
        if (title) {
            title = title.replace(/^\s+|\s+$/g, '');
            title = title.toLowerCase();
            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to   = "aaaaeeeeiiiioooouuuunc------";
            for (var i=0, l=from.length ; i<l ; i++) {
                title = title.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }
            title = title.replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            $(input).val(title);
        }
    }

    function deleteProfile(input) {
        $(input).attr('disabled', true);
        if (confirm("Are you sure you want to delete your account?")) {
            $.get(`{{route('customer.delete.profile')}}`, function (res) {
                alertyFy(res.msg, res.status, 2000);
                if (res.status == 'success') {
                    setTimeout(function () {
						window.location.href = '{{route('landing.page')}}';
                    },3000);
                    $(input).attr('disabled', false);
                } else {
                    alertyFy(res.msg, res.status, 2000);
                    $(input).attr('disabled', false);
                }
            });
        }
    }

    function getFeaturedModal(input) {
		$('#staticBackdrop').modal('show');
    }
    
    function closeFeaturedModal(input) {
        $('#staticBackdrop').modal('hide');
    }

	function openSupportBox() {
		$(':input').removeClass('has-error');
		$('span.text-danger').remove();
		$('.chat-popup :input').val('');
		$('.chat-popup').show();
	}

	function closeSupportBox() {
		$('.chat-popup').hide();
	}

	function sendSupportMessage(input) {
		$(':input').removeClass('has-error');
		$('span.text-danger').remove();
		$(input).attr('disabled',true);
		axios.post("{{route('send.support.message')}}", $('#chatSupportForm').serialize()).then(function (res) {
			if (res.data.status=='success') {
				alertyFy(res.data.msg,res.data.status,10000);
				closeSupportBox();
			} else {
				alertyFy(res.data.msg,res.data.status,3000);
			}
			$(input).attr('disabled',false);
		}).catch(function (error) {
			$(input).attr('disabled',false);
			if (error.response.status==422) {
				$.each(error.response.data.errors, function (k, v) {
					$(`#chatSupportForm :input[name="${k}"]`).addClass("has-error");
					$(`#chatSupportForm :input[name="${k}"]`).after(`<span class="text-danger float-start">${v[0]}</span>`);
				});
			} else {
				alertyFy('There is something wrong','warning',3000);
			}
		});
	}

</script>
@stack('script')
</body>
</html>