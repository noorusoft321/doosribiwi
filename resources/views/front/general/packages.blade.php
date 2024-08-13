@extends('front.layouts.master')
@section('title',$title)
@section('description', $title)

@push('style')
	<style>
		.bg-shaadi-ladoo{
			border-radius: 8px;
			background-image: url("{{asset('web_images/Rishtay-Pakistani-Shaadi-Ka-Laddu.jpg')}}");
			background-repeat: no-repeat;
			background-size: cover;
			height: 400px;
		}
		.bg-shaadi-ladoo .card-body {
			padding: 0;
		}
		.counter-laddoo{
			background: #0c476e;
			text-align: center;
			padding: 5px;
			border-radius: 8px;
			width: fit-content;
			margin: 0 auto;
		}
		div.tables {
			width: 100%;
			height: 485px;
			text-align: center;
			border-radius: 3px;
			background-color: white;
			box-shadow: 0 3px 5px rgba(0,0,0,0.3);
			transition-duration: 300ms;
			padding: 15px;
		}
		#headerStandard {
			background-color: #d0cd94;
		}
		#headerPro {
			background-color: #967995;
		}
		ul.packageParent {
			width: 100%;
			margin: 0 auto;
		}
		.packageParent li.textData {
			list-style-type: none;
			font-size: 1.3rem;
			font-weight: 300;
			padding-top: .5rem;
			padding-bottom: .5rem;
			border-bottom: 2px solid #ccd1ce;
			color: #241623;
			margin-left: -32px;
		}
		.packageParent li.price {
			list-style-type: none;
			font-weight: bold;
			font-size: 3rem;
			padding-top: 0px;
			color: #d0cd94;
			margin-left: -32px;
		}
		.packageParent li span {
			display: inline-block;
			font-size: 2rem;
			padding-right: 5px;
		}
		.packageParent li.perMonth {
			list-style-type: none;
			font-size: 1rem;
			margin-top: -7px;
			text-transform: lowercase;
			color: #a8a8a8;
		}
		.buttons {
			height: 50px;
			width: 220px;
			margin-top: 0px;
			color: white;
			font-size: 1.2rem;
			font-weight: bold;
			border: none;
			border-radius: 3px;
		}
		div.tables:hover {
			transform: scale(1.05);
		}
		.buttons:hover {
			cursor: pointer;
		}
		.buttonBasic {
			background-color: #3c6e71;
		}
		.packageParent li.basic {
			color: #3c6e71;
		}
		#headerBasic {
			padding: 25px 0 20px;
			margin-bottom: 25px;
			text-transform: uppercase;
			border-top-left-radius: 3px;
			border-top-right-radius: 3px;
			position: relative;
		}
		#headerBasic h2 {
			color: white;
			font-weight: 700;
			font-size: 2rem;
		}
		#headerBasic span {
			color: white;
			font-weight: 700;
			font-size: .9rem;
		}
		.badge-corner {
			position: absolute;
			top: 0;
			left: 0;
			width: 0;
			height: 0;
			border-top: 80px solid goldenrod;
			border-top-color: rgba(0, 0, 0, 0.3);
			border-right: 80px solid transparent;
			padding: 0;
			background-color: transparent;
			border-radius: 0;
			cursor: default !important;
			z-index: 2;
		}
		.badge-corner-yellow span {
			position: absolute;
			top: -58px;
			left: 12px;
			font-size: 15px !important;
			color: darkblue !important;
			-ms-transform: rotate(-45deg);
			-webkit-transform: rotate(-45deg);
			transform: rotate(-45deg);
			margin-left: -14px;
			font-weight: 600;
		}
		.card {
			border-radius: 3px;
			box-shadow: 0 3px 5px rgba(0,0,0,0.3);
			border: none;
		}
		.section-card-heading {
			font-size: 40px;
			color: #D5AD6D;
			background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%);
			background: -o-linear-gradient(transparent, transparent);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			font-weight: 700;
			text-align: center;
			text-transform: uppercase;
		}
		.buttonBasicLast {
			background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%) !important;
		}
		thead {
			background: #075385;
		}
		thead tr th {
			color: #fff;
			font-size: 16px;
			font-weight: 600;
		}
		tr {
			text-align: center;
		}
		.headingUrdu {
			font-size: 30px;
			font-weight: 500;
		}
		.animated-button1 {
			background: linear-gradient(-30deg, #075385 50%, #0c476e 50%);
			padding: 20px 40px;
			margin: 12px;
			display: inline-block;
			-webkit-transform: translate(0%, 0%);
			transform: translate(0%, 0%);
			overflow: hidden;
			color: #f7d4d4;
			font-size: 20px;
			letter-spacing: 2.5px;
			text-align: center;
			text-transform: uppercase;
			text-decoration: none;
			-webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
			box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
		}

		.animated-button1::before {
			content: '';
			position: absolute;
			top: 0px;
			left: 0px;
			width: 100%;
			height: 100%;
			background-color: #ad8585;
			opacity: 0;
			-webkit-transition: .2s opacity ease-in-out;
			transition: .2s opacity ease-in-out;
		}

		.animated-button1:hover::before {
			opacity: 0.2;
		}
		.animated-button1:hover {
			color: #ffffff;
		}

		.animated-button1 span {
			position: absolute;
		}

		.animated-button1 span:nth-child(1) {
			top: 0px;
			left: 0px;
			width: 100%;
			height: 4px;
			background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%) !important;
			-webkit-animation: 2s animateTop linear infinite;
			animation: 2s animateTop linear infinite;
		}

		@keyframes animateTop {
			0% {
				-webkit-transform: translateX(100%);
				transform: translateX(100%);
			}
			100% {
				-webkit-transform: translateX(-100%);
				transform: translateX(-100%);
			}
		}

		.animated-button1 span:nth-child(2) {
			top: 0px;
			right: 0px;
			height: 100%;
			width: 4px;
			background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%) !important;
			-webkit-animation: 2s animateRight linear -1s infinite;
			animation: 2s animateRight linear -1s infinite;
		}

		@keyframes animateRight {
			0% {
				-webkit-transform: translateY(100%);
				transform: translateY(100%);
			}
			100% {
				-webkit-transform: translateY(-100%);
				transform: translateY(-100%);
			}
		}

		.animated-button1 span:nth-child(3) {
			bottom: 0px;
			left: 0px;
			width: 100%;
			height: 4px;
			background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%) !important;
			-webkit-animation: 2s animateBottom linear infinite;
			animation: 2s animateBottom linear infinite;
		}

		@keyframes animateBottom {
			0% {
				-webkit-transform: translateX(-100%);
				transform: translateX(-100%);
			}
			100% {
				-webkit-transform: translateX(100%);
				transform: translateX(100%);
			}
		}

		.animated-button1 span:nth-child(4) {
			top: 0px;
			left: 0px;
			height: 100%;
			width: 4px;
			background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%) !important;
			-webkit-animation: 2s animateLeft linear -1s infinite;
			animation: 2s animateLeft linear -1s infinite;
		}

		@keyframes animateLeft {
			0% {
				-webkit-transform: translateY(-100%);
				transform: translateY(-100%);
			}
			100% {
				-webkit-transform: translateY(100%);
				transform: translateY(100%);
			}
		}

		#new-columns {
			column-count: 2;
			column-gap: 15px;
			width: 95%;
			margin: 50px auto;
			margin-top: 0px;
			text-align: center;
		}

		div#new-columns figure {
			background: #fefefe;
			border: 2px solid #fcfcfc;
			box-shadow: 0 5px 10px rgba(35, 35, 35, 0.7);
			border-radius: 10px;
			margin: 0 2px 15px;
			padding: 15px;
			padding-bottom: 0px;
			transition: opacity .4s ease-in-out;
			display: inline-block;
			column-break-inside: avoid;
		}

		div#new-columns figure .bank-logo {
			width: 150px;
			height: 150px;
			border-bottom: 2px solid #9B2C47;
			margin-bottom: 5px;
		}

		div#new-columns figure figcaption {
			font-size: .9rem;
			color: #444;
			line-height: 1.5;
		}

		div#new-columns small {
			font-size: 1rem;
			float: right;
			text-transform: uppercase;
			color: #aaa;
		}

		div#new-columns small a {
			color: #666;
			text-decoration: none;
			transition: .4s color;
		}

		div#new-columns:hover figure:not(:hover) {
			opacity: 0.4;
		}
		.other-bank-icons img {
			width: 40%;
			margin: 5px;
			border: 2px solid #9B2C47;
			border-radius: 5px;
		}
		@media screen and (max-width: 750px) {
			#new-columns { column-gap: 0px; }
			#new-columns figure { width: 100%; }
		}

		@media only screen and (max-width: 600px) {
			#new-columns {
				column-count: 1;
				width: 100%;
			}
			.invisible {
				display: none;
			}
		}

		@media only screen and (max-width: 600px) {
			h1,h2 {
				font-size: 20px;
			}
			.paragraph-1 {
				font-size: 18px;
			}
			.p-5 {
				padding: 0.8rem!important;
			}
			.buttons {
				margin-top: 18px;
			}
			div.tables {
				margin-bottom: 30px;
				height: 500px;
			}
			.section-card-heading {
				font-size: 25px !important;
			}
			thead tr th, tr td {
				font-size: 13px;
			}
			.headingUrdu {
				font-size: 20px;
			}
			.animated-button1 {
				font-size: 14px;
				padding: 15px 20px;
			}
			#headerBasic h2 {
				font-size: 1.8rem;
			}
		}
	</style>
@endpush

@section('content')

	<main>
		<div class="container-xxl">
			<br>
			<h1 class="align-center font-weight-600"> {{$title}} (رشتہ پیکجز)</h1>
			<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-thin-border.png')}}">
			<br>
			<div class="row">
				<div class="col-md-8 mx-auto">
					<p class="text-center paragraph-1 m-0">Doosri Biwi offers mainly two types of rishta services. Website Based Only and Personalized Matchmaking.</p>
					<p class="text-center paragraph-1 text-theme">شادی آرگنائزیشن پاکستان بنیادی طور پر دو قسم کی رشتہ خدمات فراھم کرتی ہے۔ صرف ویب سائٹ پر مبنی رشتہ سروس اور ذاتی نوعیت کی میچ میکنگ۔</p>
					<p class="text-center paragraph-1 m-0">In Website Based Only Packages you can use our matrimonial website to find proposals on self-service basis i.e., you will use our website to find proposal for yourself directly.</p>
					<p class="text-center paragraph-1 text-theme">ویب سائٹ پر مبنی پیکجز میں آپ ہماری ویب سائٹ کو سیلف سروس کی بنیاد پر رشتہ تلاش کرنے کے لیے استعمال کر سکتے ہیں، یعنی رشتہ تلاش کرنے کے لیے آپ براہ راست  ہماری ویب سائٹ کا استعمال کریں گے۔</p>
					<p class="text-center paragraph-1 m-0">In Personalized Matchmaking, our office-based marriage consultants will show you proposals as per your requirements.</p>
					<p class="text-center paragraph-1 text-theme">پرسنلائزڈ (ذاتی نوعیت) کی میچ میکنگ میں ہماری رشتہ  کنسلٹنٹ (میچ میکز) آپ کو آپ کی ضرورت کے مطابق رشتے دکھائیں گے۔</p>
				</div>
			</div>
			<br>

			<h2 class="align-center font-weight-600">
				Which Type of Rishta Service Do You Need? <br>
				<span class="headingUrdu">آپ کو کس قسم کی رشتہ سروس کی ضرورت ہے؟</span>
			</h2>
			<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-thin-border.png')}}">
			<br>

			<div class="text-center">
				<a href="#allPackageList" class="animated-button1 mb-2">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					Website Based Packages <br>
					ویب سائٹ پر مبنی پیکیجز
				</a>
				<a href="#personalizedMatching" class="animated-button1 mb-2">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					Personalized Matchmaking <br>
					ذاتی نوعیت کی میچ میکنگ
				</a>
			</div>

			<div class="row">
				@for($i = 0; $i < count($packages); $i++)
					<div class="col-md-4 p-5 mx-auto">
						<div class="tables">
							<div id="headerBasic" style="background: {{$packages[$i]['background_color']}};">
								<h2>{{$packages[$i]['package_name']}}</h2>
								@if($packages[$i]['id']==3)
									<span>(Out of Pakistan)</span>
								@else
									<span>(Only Pakistan)</span>
								@endif

								<a class="badge-corner badge-corner-yellow">
									<span>Premium</span>
								</a>
							</div>
							<ul class="packageParent">
								<li class="textData">
									<strong>Direct Messages: </strong> {{$packages[$i]['direct_messages']}} <br>
									{{$packages[$i]['direct_messages']}} <cm>:براہ راست میسج </cm>
								</li>
								<li class="textData">
									<strong>Duration: </strong> {{$packages[$i]['duration']}} Days <br>
									<cm>مدت: </cm> {{$packages[$i]['duration']}} دن
								</li>
								<li class="textData">
									<strong>Profile Status: </strong> {{$packages[$i]['profile_status']}} <br>
									<cm>پروفائل کی حیثیت: </cm>{{$packages[$i]['profile_status_urdu']}}
								</li>
								<li class="price basic" style="color: {{$packages[$i]['color']}};"><span>RS.</span>{{$packages[$i]['price']}}</li>
							</ul>
							@if(!empty($isLogin))
								<button onclick="window.location.href = '#paymentDetailSection'" class="buttons buttonBasic" style="background: {{$packages[$i]['color']}};">Buy Now</button>
							@else
								<button onclick="window.location.href = '{{route('view.register')}}'" class="buttons buttonBasic" style="background: {{$packages[$i]['color']}};">Register Now</button>
							@endif
						</div>
					</div>
				@endfor
			</div>

			<br>

			<div class="row" id="personalizedMatching">
				<div class="col-md-8 mx-auto">
					<h2 class="align-center font-weight-600">
						Personalized Matchmaking <br>
						<span class="headingUrdu">ذاتی نوعیت کی میچ میکنگ</span>
					</h2>
					<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-thin-border.png')}}">
					<br>

					<div class="card">
						<div class="card-body text-center">
							<p class="paragraph-1 text-start">In Personalized Matchmaking, our office-based marriage consultants will show you proposals as per your requirements.</p>
							<p class="paragraph-1 text-end text-theme">پرسنلائزڈ (ذاتی نوعیت) کی میچ میکنگ میں ہماری رشتہ  کنسلٹنٹ (میچ میکز) آپ کو آپ کی ضرورت کے مطابق رشتے دکھائیں گے۔</p>
							<p class="paragraph-1 text-start">Personalized Matchmaking Fee is different for each case. Fee starts from minimum Rs. 200,000 for the lower class proposals and goes higher as per class and rishta requirements.</p>
							<p class="paragraph-1 text-end text-theme">براہ راست پرسنلائزڈ (ذاتی نوعیت) کی میچ میکنگ فیس ہر کیس کے لیے مختلف ہے۔ فیس کم از کم  200،000 روپے سے شروع ہوتی ہے اور رشتے کی ضروریات کے مطابق زیادہ ہوتی جاتی ہے۔</p>
							<p class="paragraph-1 text-start">Please create your profile on the website and send link of your profile to consultants to discuss about your case.</p>
							<p class="paragraph-1 text-end text-theme">براہ کرم ویب سائٹ پر اپنا پروفائل بنائیں اور اپنے کیس کے بارے میں بات کرنے کے لیے اپنے پروفائل کا لنک کنسلٹنٹس کو بھیجیں۔</p>
							<br>
							@if(!empty($isLogin))
								<button onclick="window.location.href = '#paymentDetailSection'" class="buttons buttonBasicLast">Buy Now</button>
							@else
								<button onclick="window.location.href = '{{route('view.register')}}'" class="buttons buttonBasicLast">Register Now</button>
							@endif
						</div>
					</div>
				</div>
			</div>
			<br>
			<br>

			{{-- Start Payment Options Section --}}
			<div class="row" id="paymentDetailSection">
				<div class="col-md-8 mx-auto">
					<h2 class="align-center font-weight-600">
						Payment Options <br>
						<span class="headingUrdu">آدائیگی کے طریقے</span>
					</h2>
					<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-thin-border.png')}}">
					<br>
					<p class="paragraph-1">For payment only use the following bank accounts and always send payment's screenshot on the Senior Consultant WhatsApp:
						<a class="text-dark font-weight-500" href="https://api.whatsapp.com/send?phone=923452444262&text=Hi%20Shaadi.org.pk%2C%20I%20need%20more%20information.">+923452444262</a>. We will not be responsible if payment is sent on any other account or to any other person. Make sure to communicate only on the official numbers which are mentioned on our website and Facebook page. In case of any issue contact Senior Consultant WhatsApp:
						<a class="text-dark font-weight-500" href="https://api.whatsapp.com/send?phone=923452444262&text=Hi%20Shaadi.org.pk%2C%20I%20need%20more%20information.">+923452444262</a>.
					</p>
					<p class="paragraph-1 text-end text-theme m-0">ادائیگی کے لیے صرف درج ذیل بینک اکاؤنٹس استعمال کریں اور ہمیشہ سینئر کنسلٹنٹ واٹس ایپ پر ادائیگی کا اسکرین شاٹ بھیجیں:
						<a href="https://api.whatsapp.com/send?phone=923452444262&text=Hi%20Shaadi.org.pk%2C%20I%20need%20more%20information.">923452444262+</a>۔ اگر ادائیگی کسی دوسرے اکاؤنٹ یا کسی دوسرے شخص کو بھیجی جاتی ہے تو ہم ذمہ دار نہیں ہوں گے۔ اس بات کو یقینی بنائیں کہ صرف ان آفیشل نمبرز پر رابطہ کریں جن کا ذکر ہماری ویب سائٹ اور فیس بک پیج پر ہے۔ کسی بھی مسئلے کی صورت میں سینئر کنسلٹنٹ واٹس ایپ سے رابطہ کریں
					</p>
					<p class="paragraph-1 text-end text-theme"><a href="https://api.whatsapp.com/send?phone=923452444262&text=Hi%20Shaadi.org.pk%2C%20I%20need%20more%20information.">+923452444262</a></p>
					<br>
				</div>
			</div>

			{{-- Start Banks Info Section --}}
			<div id="new-columns">
				{{--Bank Al Habib Limited--}}
				<figure>
					<img class="bank-logo" src="{{asset('assets/img/bank/bank-al-habib-image.png')}}">
					<figcaption>
						<h4 class="text-theme font-weight-600">Bank Al Habib Limited</h4>
						<table class="table table-hover">
							<tr class="text-start">
								<td>Account Title</td>
								<td>MUHAMMAD ALI</td>
							</tr>
							<tr class="text-start">
								<td>Account Number</td>
								<td>50120081006932017</td>
							</tr>
							<tr class="text-start">
								<td>IBAN No.</td>
								<td>PK02BAHL5012008100693201</td>
							</tr>
							<tr class="text-start">
								<td>Branch Code</td>
								<td>5012</td>
							</tr>
							<tr class="text-start">
								<td>SWIFT Code</td>
								<td>BAHLPKKAXXX</td>
							</tr>
							<tr class="text-start">
								<td>Currency</td>
								<td>PKR</td>
							</tr>
							<tr class="text-start">
								<td>Branch Name</td>
								<td>Islamic Branch, Gulshan-e-Iqbal, Block 6, Karachi.</td>
							</tr>
						</table>
						<p class="invisible m-0">Office A, 1st Floor, JF Business Bay, Block D, North Nazimabad, Karachi, Sindh, Pakistan</p>
					</figcaption>
				</figure>
				{{--Faysal Bank Pakistan Ltd--}}
				<figure>
					<img class="bank-logo" src="{{asset('assets/img/bank/faysal-bank.png')}}">
					<figcaption>
						<h4 class="text-theme font-weight-600">Faysal Bank Pakistan Ltd</h4>
						<table class="table table-hover">
							<tr class="text-start">
								<td>Account Title</td>
								<td>Shaadi Organization® PAKISTAN</td>
							</tr>
							<tr class="text-start">
								<td>Account Number</td>
								<td>3059787000005183</td>
							</tr>
							<tr class="text-start">
								<td>IBAN</td>
								<td>PK47FAYS3059787000005183</td>
							</tr>
							<tr class="text-start">
								<td>Account Category</td>
								<td>CURRENT</td>
							</tr>
							<tr class="text-start">
								<td>SWIFT Code</td>
								<td>FAYSPKKAXXX</td>
							</tr>
							<tr class="text-start">
								<td>Branch Code</td>
								<td>3059</td>
							</tr>
							<tr class="text-start">
								<td>Currency</td>
								<td>PKR</td>
							</tr>
							<tr class="text-start">
								<td>BRANCH</td>
								<td>IBB Nagan Chowrangi North Karachi</td>
							</tr>
						</table>
						<p class="invisible m-0">Office A, 1st Floor, JF Business Bay, Block D, North Nazimabad, Karachi, Sindh, Pakistan</p>
					</figcaption>
				</figure>
				{{--United Bank Limited (UBL)--}}
				<figure>
					<img class="bank-logo" src="{{asset('assets/img/bank/united-bank-limited.png')}}">
					<figcaption>
						<h4 class="text-theme font-weight-600">United Bank Limited (UBL)</h4>
						<table class="table table-hover">
							<tr class="text-start">
								<td>Account Title</td>
								<td>Shaadi Organization® PAKISTAN</td>
							</tr>
							<tr class="text-start">
								<td>Account Number</td>
								<td>299327208</td>
							</tr>
							<tr class="text-start">
								<td>Branch Code</td>
								<td>1052</td>
							</tr>
							<tr class="text-start">
								<td>Account Number with Branch Code</td>
								<td>1052299327208</td>
							</tr>
							<tr class="text-start">
								<td>IBAN Number</td>
								<td>PK95UNIL0109000299327208</td>
							</tr>
							<tr class="text-start">
								<td>SWIFT Code</td>
								<td>UNILPKKAXXX</td>
							</tr>
							<tr class="text-start">
								<td>Branch</td>
								<td>North Nazimabad Branch, Karachi, Sindh, Pakistan</td>
							</tr>
						</table>
						<p class="invisible m-0">Office A, 1st Floor, JF Business Bay, Block D, North Nazimabad, Karachi, Sindh, Pakistan</p>
					</figcaption>
				</figure>
				{{--Dubai Islamic Bank Pakistan Ltd--}}
				<figure>
					<img class="bank-logo" src="{{asset('assets/img/bank/dubai-islamic-bank.png')}}">
					<figcaption>
						<h4 class="text-theme font-weight-600">Dubai Islamic Bank Pakistan Ltd</h4>
						<table class="table table-hover">
							<tr class="text-start">
								<td>Account Title</td>
								<td>SHAADI</td>
							</tr>
							<tr class="text-start">
								<td>Account Number</td>
								<td>0105282003</td>
							</tr>
							<tr class="text-start">
								<td>IBAN</td>
								<td>PK45DUIB0000000105282003</td>
							</tr>
							<tr class="text-start">
								<td>Account Category</td>
								<td>CURRENT</td>
							</tr>
							<tr class="text-start">
								<td>Account Type</td>
								<td>CASA</td>
							</tr>
							<tr class="text-start">
								<td>Currency</td>
								<td>PKR</td>
							</tr>
							<tr class="text-start">
								<td>Branch Karachi</td>
								<td>Gulshan-e-Iqbal Branch</td>
							</tr>
						</table>
						<p class="invisible m-0">Office A, 1st Floor, JF Business Bay, Block D, North Nazimabad, Karachi, Sindh, Pakistan</p>
					</figcaption>
				</figure>
				{{--Easy Paisa--}}
				<figure>
					<img class="bank-logo" src="{{asset('assets/img/bank/easypaisa.png')}}">
					<figcaption>
						<h4 class="text-theme font-weight-600">Easy Paisa</h4>
						<table class="table table-hover">
							<tr>
								<td>Account Number</td>
								<td>03452444262</td>
							</tr>
						</table>
						<p class="invisible m-0">Office A, 1st Floor, JF Business Bay, Block D, North Nazimabad, Karachi, Sindh, Pakistan</p>
					</figcaption>
				</figure>
				{{--JazzCash--}}
				<figure>
					<img class="bank-logo" src="{{asset('assets/img/bank/jazzcash.png')}}">
					<figcaption>
						<h4 class="text-theme font-weight-600">JazzCash</h4>
						<table class="table table-hover">
							<tr>
								<td>Account Number</td>
								<td>03008237720</td>
							</tr>
						</table>
						<p class="invisible m-0">Office A, 1st Floor, JF Business Bay, Block D, North Nazimabad, Karachi, Sindh, Pakistan</p>
					</figcaption>
				</figure>
				{{--NayaPay--}}
				<figure>
					<img class="bank-logo" src="{{asset('assets/img/bank/nayapay.png')}}">
					<figcaption>
						<h4 class="text-theme font-weight-600">NayaPay</h4>
						<table class="table table-hover">
							<tr>
								<td>Account Number</td>
								<td>03008237720</td>
							</tr>
						</table>
						<p class="invisible m-0">Office A, 1st Floor, JF Business Bay, Block D, North Nazimabad, Karachi, Sindh, Pakistan</p>
					</figcaption>
				</figure>
				{{--SadaPay--}}
				<figure>
					<img class="bank-logo" src="{{asset('assets/img/bank/sadapay.png')}}">
					<figcaption>
						<h4 class="text-theme font-weight-600">SadaPay</h4>
						<table class="table table-hover">
							<tr>
								<td>Account Number</td>
								<td>03008237720</td>
							</tr>
						</table>
						<p class="invisible m-0">Office A, 1st Floor, JF Business Bay, Block D, North Nazimabad, Karachi, Sindh, Pakistan</p>
					</figcaption>
				</figure>
				{{--Cash Deposit at Office--}}
				<figure>
					<img class="bank-logo" src="{{asset('assets/img/bank/cash-deposit-at-office.png')}}">
					<figcaption>
						<h4 class="text-theme font-weight-600">Cash Deposit at Office</h4>
						<p>2nd Floor, FL 4/20, Malik Chambers, Main Rashid Minhas Road, Below NIPA Flyover, Block 5, Gulshan-e-Iqbal, Karachi.</p>
						<p>Office A, 1st Floor, JF Business Bay, Block D, Five Star Chowrangi, North Nazimabad, Karachi.</p>
						<p class="invisible m-0">Office A, 1st Floor, JF Business Bay, Block D, North Nazimabad, Karachi, Sindh, Pakistan</p>
					</figcaption>
				</figure>
				{{--Out of Pakistan Payment Options--}}
				<figure>
					<img class="bank-logo" src="{{asset('assets/img/bank/out-of-pakistan-payment-method.png')}}">
					<figcaption>
						<h4 class="text-theme font-weight-600">Out of Pakistan Payment Options</h4>
						<p>If you are out of Pakistan you can use these for sending payments. Please use the option to deposit payment in the bank account of Bank Al Habib Limited.</p>

						<div class="other-bank-icons">
							<a href="https://www.remitly.com" target="_blank">
								<img src="{{asset('assets/img/bank/remitly-logo.png')}}" alt="Image">
							</a>
							<a href="https://www.riamoneytransfer.com" target="_blank">
								<img src="{{asset('assets/img/bank/ria-logo.png')}}" alt="Image">
							</a>
							<a href="https://www.moneygram.com" target="_blank">
								<img src="{{asset('assets/img/bank/ria-money-logo.png')}}" alt="Image">
							</a>
							<a href="https://www.westernunion.com" target="_blank">
								<img src="{{asset('assets/img/bank/western-union-logo.png')}}" alt="Image">
							</a>
							<a href="https://www.xpressmoney.com" target="_blank">
								<img src="{{asset('assets/img/bank/xpress-money-logo.png')}}" alt="Image">
							</a>
							<a href="https://www.worldremit.com" target="_blank">
								<img src="{{asset('assets/img/bank/world-remit-logo.png')}}" alt="Image">
							</a>
						</div>
						<p>Overseas Pakistani: When you send payment through Western Union or Riya or any other online method please use deposit in bank account. Do Not Use Cash Pickup.</p>
						<p class="invisible m-0">Office A, 1st Floor, JF Business Bay, Block D, North Nazimabad, Karachi, Sindh, Pakistan</p>
					</figcaption>
				</figure>
			</div>

{{--			<div class="row" id="paymentDetailSection">--}}
{{--				<div class="col-md-8 mx-auto">--}}
{{--					<h2 class="align-center font-weight-600">--}}
{{--						Payment Options <br>--}}
{{--						<span class="headingUrdu">آدائیگی کے طریقے</span>--}}
{{--					</h2>--}}
{{--					<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-thin-border.png')}}">--}}
{{--					<br>--}}
{{--					<p class="paragraph-1">For payment only use the following bank accounts and always send payment's screenshot on the Senior Consultant WhatsApp:--}}
{{--						<a class="text-dark font-weight-500" href="https://api.whatsapp.com/send?phone=923452444262&text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information.">+923452444262</a>. We will not be responsible if payment is sent on any other account or to any other person. Make sure to communicate only on the official numbers which are mentioned on our website and Facebook page. In case of any issue contact Senior Consultant WhatsApp:--}}
{{--						<a class="text-dark font-weight-500" href="https://api.whatsapp.com/send?phone=923452444262&text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information.">+923452444262</a>.--}}
{{--					</p>--}}
{{--					<p class="paragraph-1 text-end text-theme m-0">ادائیگی کے لیے صرف درج ذیل بینک اکاؤنٹس استعمال کریں اور ہمیشہ سینئر کنسلٹنٹ واٹس ایپ پر ادائیگی کا اسکرین شاٹ بھیجیں:--}}
{{--						<a href="https://api.whatsapp.com/send?phone=923452444262&text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information.">923452444262+</a>۔ اگر ادائیگی کسی دوسرے اکاؤنٹ یا کسی دوسرے شخص کو بھیجی جاتی ہے تو ہم ذمہ دار نہیں ہوں گے۔ اس بات کو یقینی بنائیں کہ صرف ان آفیشل نمبرز پر رابطہ کریں جن کا ذکر ہماری ویب سائٹ اور فیس بک پیج پر ہے۔ کسی بھی مسئلے کی صورت میں سینئر کنسلٹنٹ واٹس ایپ سے رابطہ کریں--}}
{{--					</p>--}}
{{--					<p class="paragraph-1 text-end text-theme"><a href="https://api.whatsapp.com/send?phone=923452444262&text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information.">+923452444262</a></p>--}}
{{--					<br>--}}
{{--				</div>--}}
{{--			</div>--}}

{{--			<div class="row">--}}
{{--				<div class="col-md-6 mx-auto">--}}
{{--					<div class="card">--}}
{{--						<h5 class="card-header">Bank Al Habib Limited.</h5>--}}
{{--						<div class="card-body">--}}
{{--							<p>Account Title: MUHAMMAD ALI </p>--}}
{{--							<p>Account Number: 50120081006932017 </p>--}}
{{--							<p>IBAN No.: PK02BAHL5012008100693201 </p>--}}
{{--							<p>Branch Code: 5012 </p>--}}
{{--							<p>SWIFT Code: BAHLPKKAXXX </p>--}}
{{--							<p>Currency: PKR </p>--}}
{{--							<p>Branch Name: Islamic Branch, Gulshan-e-Iqbal, Block 6, Karachi.</p>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--				<div class="col-md-6 mx-auto">--}}
{{--					<div class="card">--}}
{{--						<h5 class="card-header">Dubai Islamic Bank Pakistan Ltd.</h5>--}}
{{--						<div class="card-body">--}}
{{--							<p>Account Title: SHAADI </p>--}}
{{--							<p>Account Number: 0105282003 </p>--}}
{{--							<p>IBAN: PK45DUIB0000000105282003 </p>--}}
{{--							<p>Account Category: CURRENT </p>--}}
{{--							<p>Account Type: CASA </p>--}}
{{--							<p>Currency: PKR </p>--}}
{{--							<p>Branch Karachi: Gulshan-e-Iqbal Branch </p>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--				<div class="col-md-6 mx-auto">--}}
{{--					<div class="card">--}}
{{--						<h5 class="card-header">Faysal Bank Pakistan Ltd.</h5>--}}
{{--						<div class="card-body">--}}
{{--							<p>Account Title: SHAADI ORGANIZATION PAKISTAN </p>--}}
{{--							<p>Account Number: 3059787000005183 </p>--}}
{{--							<p>IBAN: PK47FAYS3059787000005183 </p>--}}
{{--							<p>Account Category: CURRENT </p>--}}
{{--							<p>SWIFT Code: FAYSPKKAXXX </p>--}}
{{--							<p>Branch Code: 3059 </p>--}}
{{--							<p>Currency: PKR </p>--}}
{{--							<p>BRANCH: IBB Nagan Chowrangi North Karachi</p>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--				<div class="col-md-6 mx-auto">--}}
{{--					<div class="card">--}}
{{--						<h5 class="card-header">United Bank Limited (UBL) </h5>--}}
{{--						<div class="card-body">--}}
{{--							<p>Account Title: SHAADI ORGANIZATION PAKISTAN</p>--}}
{{--							<p>Account Number: 299327208</p>--}}
{{--							<p>Branch Code: 1052</p>--}}
{{--							<p>Account Number with Branch Code: 1052299327208</p>--}}
{{--							<p>IBAN Number: PK95UNIL0109000299327208</p>--}}
{{--							<p>SWIFT Code: UNILPKKAXXX</p>--}}
{{--							<p>United Bank Limited (UBL)</p>--}}
{{--							<p>North Nazimabad Branch,</p>--}}
{{--							<p>Karachi, Sindh, Pakistan</p>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--				<div class="col-md-6 mx-auto">--}}
{{--					<div class="card">--}}
{{--						<h5 class="card-header">Easy Paisa / Telenor Microfinance Bank </h5>--}}
{{--						<div class="card-body">--}}
{{--							<p>Account Number: 03452444262 </p>--}}

{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--				<div class="col-md-6 mx-auto">--}}
{{--					<div class="card">--}}
{{--						<h5 class="card-header">JazzCash / NayaPay / SadaPay </h5>--}}
{{--						<div class="card-body">--}}
{{--							<p>Account Number: 03008237720 </p>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--				<div class="col-md-6 mx-auto">--}}
{{--					<div class="card">--}}
{{--						<h5 class="card-header">Cash Deposit at Office </h5>--}}
{{--						<div class="card-body">--}}
{{--							<p>2nd Floor, FL 4/20, Malik Chambers, Main Rashid Minhas Road, Below NIPA Flyover, Block 5, Gulshan-e-Iqbal, Karachi.</p>--}}
{{--							<p>Office A, 1st Floor, JF Business Bay, Block D, Five Star Chowrangi, North Nazimabad, Karachi. </p>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--				<div class="col-md-6 mx-auto">--}}
{{--					<div class="card">--}}
{{--						<h5 class="card-header">Out of Pakistan Payment Options:</h5>--}}
{{--						<div class="card-body">--}}
{{--							<p>If you are out of Pakistan you can use these for sending payments. Please use the option to deposit payment in the bank account of Bank Al Habib Limited. </p>--}}
{{--							<p>https://www.remitly.com </p>--}}
{{--							<p>https://www.riamoneytransfer.com </p>--}}
{{--							<p>https://www.moneygram.com </p>--}}
{{--							<p>https://www.xpressmoney.com </p>--}}
{{--							<p>https://www.worldremit.com </p>--}}
{{--							<p>https://www.westernunion.com </p>--}}
{{--							<p>Overseas Pakistani: When you send payment through Western Union or Riya or any other online method please use deposit in bank account. Do Not Use Cash Pickup.</p>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}

			{{--<div class="row">--}}
				{{--<div class="col-md-4 mx-auto">--}}
					{{--<div class="card">--}}
						{{--<h5 class="card-header">Bank Al Habib Limited.</h5>--}}
						{{--<div class="card-body">--}}
							{{--<p>Account Title: MUHAMMAD ALI </p>--}}
							{{--<p>    Account Number: 50120081006932017 </p>--}}
							{{--<p>    IBAN No.: PK02BAHL5012008100693201 </p>--}}
							{{--<p>    Branch Code: 5012 </p>--}}
							{{--<p>    SWIFT Code: BAHLPKKAXXX </p>--}}
							{{--<p>    Currency: PKR </p>--}}
							{{--<p>    Branch Name: Islamic Branch, Gulshan-e-Iqbal, Block 6, Karachi.</p>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="col-md-4 mx-auto">--}}
					{{--<div class="card">--}}
						{{--<h5 class="card-header">Dubai Islamic Bank Pakistan Ltd.</h5>--}}
						{{--<div class="card-body">--}}
							{{--<p> Account Title: SHAADI </p>--}}
							{{--<p> Account Number: 0105282003 </p>--}}
							{{--<p> IBAN: PK45DUIB0000000105282003 </p>--}}
							{{--<p> Account Category: CURRENT </p>--}}
							{{--<p>    Account Type: CASA </p>--}}
							{{--<p>    Currency: PKR </p>--}}
							{{--<p>  Branch Karachi: Gulshan-e-Iqbal Branch </p>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="col-md-4 mx-auto">--}}
					{{--<div class="card">--}}
						{{--<h5 class="card-header">Faysal Bank Pakistan Ltd.</h5>--}}
						{{--<div class="card-body">--}}
							{{--<p> Account Title: Doosri Biwi </p>--}}
							{{--<p> Account Number: 3059787000005183 </p>--}}
							{{--<p> IBAN: PK47FAYS3059787000005183 </p>--}}
							{{--<p> Account Category: CURRENT </p>--}}
							{{--<p> SWIFT Code: FAYSPKKAXXX </p>--}}
							{{--<p> Branch Code: 3059 </p>--}}
							{{--<p>  Currency: PKR </p>--}}
							{{--<p> BRANCH: IBB Nagan Chowrangi North Karachi</p>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="col-md-4 mx-auto">--}}
					{{--<div class="card">--}}
						{{--<h5 class="card-header">Easy Paisa / Telenor Microfinance Bank </h5>--}}
						{{--<div class="card-body">--}}
							{{--<p> Account Number: 03452444262 </p>--}}

						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="col-md-4 mx-auto">--}}
					{{--<div class="card">--}}
						{{--<h5 class="card-header">JazzCash / NayaPay / SadaPay </h5>--}}
						{{--<div class="card-body">--}}
							{{--<p> Account Number: 03008237720 </p>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="col-md-4 mx-auto">--}}
					{{--<div class="card">--}}
						{{--<h5 class="card-header">Cash Deposit at Office </h5>--}}
						{{--<div class="card-body">--}}
							{{--<p> 2nd Floor, FL 4/20, Malik Chambers, Main Rashid Minhas Road, Below NIPA Flyover, Block 5, Gulshan-e-Iqbal, Karachi. </p>--}}
							{{--<p> Office A, 1st Floor, JF Business Bay, Block D, Five Star Chowrangi, North Nazimabad, Karachi. </p>--}}

						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="col-md-4 mx-auto">--}}
					{{--<div class="card">--}}
						{{--<h5 class="card-header">Out of Pakistan Payment Options:</h5>--}}
						{{--<div class="card-body">--}}
							{{--<p> If you are out of Pakistan you can use these for sending payments. Please use the option to deposit payment in the bank account of Bank Al Habib Limited. </p>--}}
							{{--<p>   https://www.remitly.com </p>--}}
							{{--<p>    https://www.riamoneytransfer.com </p>--}}
							{{--<p>    https://www.moneygram.com </p>--}}
							{{--<p>    https://www.xpressmoney.com </p>--}}
							{{--<p>    https://www.worldremit.com </p>--}}
							{{--<p>   https://www.westernunion.com </p>--}}


							{{--<p>   Overseas Pakistani: When you send payment through Western Union or Riya or any other online method please use deposit in bank account. Do Not Use Cash Pickup.</p>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}

{{--			<div class="row text-center">--}}
{{--				<div class="col-md-8 mx-auto">--}}
{{--					<div class="card" style="border: 3px solid #075385">--}}
{{--						<div class="card-body text-center">--}}
{{--							<p class="bottomInfoMessage">Doosri Biwi is a registered trademark & protected under the copyright laws of the Government of Pakistan.</p>--}}
{{--							<p class="bottomInfoMessage">شادی آرگنائزیشن پاکستان ایک رجسٹرڈ ٹریڈ مارک ہے اور حکومت پاکستان کے کاپی رائٹ قوانین کے تحت محفوظ ہے۔</p>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}

		</div>
	</main>

@endsection

@push('script')
	<script type="text/javascript">

	</script>
@endpush