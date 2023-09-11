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
			background: #040F2E;
			text-align: center;
			padding: 5px;
			border-radius: 8px;
			width: fit-content;
			margin: 0 auto;
		}
		div.tables {
			width: 100%;
			height: 550px;
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
			background-color: #3c6e71;
			padding: 25px 0 20px;
			margin-bottom: 25px;
			text-transform: uppercase;
			border-top-left-radius: 3px;
			border-top-right-radius: 3px;
			color: white;
			font-weight: 700;
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
			background: #040F2E;
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
			background: linear-gradient(-30deg, #661d2f 50%, #040F2E 50%);
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
				margin-bottom: 20px;
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
			#headerBasic {
				font-size: 25px;
			}
		}
	</style>
@endpush

@section('content')

	<main>
		<div class="container-xxl">
			<br>
			<h1 class="align-center font-weight-600"> {{$title}} (رشتہ پیکجز)</h1>
			<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">
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
			<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">
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

			<div class="row" id="allPackageList">
				<div class="col-md-4 p-5 mx-auto">
					<div class="tables">
						<h1 id="headerBasic" style="background: linear-gradient(300deg, #040F2E 50%, #84152f 50%);">Free</h1>
						<ul class="packageParent">
							<li class="textData">
								<strong> Direct Messages: </strong> 10 <br>
								10 <cm>:براہ راست میسج </cm>
							</li>
							<li class="textData">
								<strong> Duration: </strong> 30 Days <br>
								<cm>مدت: </cm> 30 دن
							</li>
							<li class="textData">
								<strong>Profile Status: </strong> Not Verified <br>
								<cm>پروفائل کی حیثیت: </cm> غیر تصدیق شدہ
							</li>
							<li class="textData">
								<strong>Featured Profile: </strong> No <br>
								<cm>خصوصی پروفائل: </cm>نہیں
							</li>
							<li class="price basic" style="color: #040F2E;"><span>RS.</span>0.00</li>
						</ul>
						@if(!empty($isLogin))
							<button onclick="window.location.href = '#paymentDetailSection'" class="buttons buttonBasic" style="background: #040F2E;">Buy Now</button>
						@else
							<button onclick="window.location.href = '{{route('view.register')}}'" class="buttons buttonBasic" style="background: #040F2E;">Register Now</button>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				@for($i = 1; $i < count($packages); $i++)
					<div class="col-md-4 p-5 mx-auto">
						<div class="tables">
							<h1 id="headerBasic" style="background: {{$packages[$i]['background_color']}};">{{$packages[$i]['package_name']}}</h1>
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
								<li class="textData">
									<strong>Featured Profile: </strong> {{$packages[$i]['vip_status']}} <br>
									<cm>خصوصی پروفائل: </cm>{{$packages[$i]['vip_status_urdu']}}
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

			<div class="row">
				<div class="col-md-12 p-5">
					<div class="card">
						<div class="card-body">
							<h2 class="align-center font-weight-600">Website Based Packages Comparison <br> <span>ویب سائٹ پر مبنی پیکیجز کا موازنہ</span> </h2>
							<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">
							<br>
							<div class="table-responsive-sm">
								<table class="table table-striped table-responsive">
									<thead>
									<tr>
										<th>Packages</th>
										<th>Direct Messages</th>
										<th>Duration (Days)</th>
										<th>Profile Status</th>
										<th>Featured Profile</th>
										<th>Price - Rs.</th>
									</tr>
									</thead>
									<tbody>
									@foreach($packages as $package)
										<tr>
											<td>{{$package['package_name']}}</td>
											<td>{{$package['direct_messages']}}</td>
											<td>{{$package['duration']}}</td>
											<td>{{$package['profile_status']}}</td>
											<td>{{$package['vip_status']}}</td>
											<td>{{$package['price']}}</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="row" id="personalizedMatching">
				<div class="col-md-8 mx-auto">
					<h2 class="align-center font-weight-600">
						Personalized Matchmaking <br>
						<span class="headingUrdu">ذاتی نوعیت کی میچ میکنگ</span>
					</h2>
					<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">
					<br>

					<div class="card">
						<div class="card-body text-center">
							<p class="paragraph-1 text-start">In Personalized Matchmaking, our office-based marriage consultants will show you proposals as per your requirements.</p>
							<p class="paragraph-1 text-end text-theme">پرسنلائزڈ (ذاتی نوعیت) کی میچ میکنگ میں ہماری رشتہ  کنسلٹنٹ (میچ میکز) آپ کو آپ کی ضرورت کے مطابق رشتے دکھائیں گے۔</p>
							<p class="paragraph-1 text-start">Personalized Matchmaking Fee is different for each case. Fee starts from minimum Rs. 35,000 for the lower class proposals and goes higher as per class and rishta requirements.</p>
							<p class="paragraph-1 text-end text-theme">براہ راست پرسنلائزڈ (ذاتی نوعیت) کی میچ میکنگ فیس ہر کیس کے لیے مختلف ہے۔ فیس کم از کم  35،000 روپے سے شروع ہوتی ہے اور رشتے کی ضروریات کے مطابق زیادہ ہوتی جاتی ہے۔</p>
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

			<div class="row" id="paymentDetailSection">
				<div class="col-md-8 mx-auto">
					<h2 class="align-center font-weight-600">
						Payment Options <br>
						<span class="headingUrdu">آدائیگی کے طریقے</span>
					</h2>
					<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">
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

			<div class="row">
				<div class="col-md-4 mx-auto">
					<div class="card">
						<h5 class="card-header">Bank Al Habib Limited.</h5>
						<div class="card-body">
							<p>Account Title: MUHAMMAD ALI </p>
							<p>    Account Number: 50120081006932017 </p>
							<p>    IBAN No.: PK02BAHL5012008100693201 </p>
							<p>    Branch Code: 5012 </p>
							<p>    SWIFT Code: BAHLPKKAXXX </p>
							<p>    Currency: PKR </p>
							<p>    Branch Name: Islamic Branch, Gulshan-e-Iqbal, Block 6, Karachi.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 mx-auto">
					<div class="card">
						<h5 class="card-header">Dubai Islamic Bank Pakistan Ltd.</h5>
						<div class="card-body">
							<p> Account Title: SHAADI </p>
							<p> Account Number: 0105282003 </p>
							<p> IBAN: PK45DUIB0000000105282003 </p>
							<p> Account Category: CURRENT </p>
							<p>    Account Type: CASA </p>
							<p>    Currency: PKR </p>
							<p>  Branch Karachi: Gulshan-e-Iqbal Branch </p>
						</div>
					</div>
				</div>
				<div class="col-md-4 mx-auto">
					<div class="card">
						<h5 class="card-header">Faysal Bank Pakistan Ltd.</h5>
						<div class="card-body">
							<p> Account Title: Doosri Biwi </p>
							<p> Account Number: 3059787000005183 </p>
							<p> IBAN: PK47FAYS3059787000005183 </p>
							<p> Account Category: CURRENT </p>
							<p> SWIFT Code: FAYSPKKAXXX </p>
							<p> Branch Code: 3059 </p>
							<p>  Currency: PKR </p>
							<p> BRANCH: IBB Nagan Chowrangi North Karachi</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 mx-auto">
					<div class="card">
						<h5 class="card-header">Easy Paisa / Telenor Microfinance Bank </h5>
						<div class="card-body">
							<p> Account Number: 03452444262 </p>

						</div>
					</div>
				</div>
				<div class="col-md-4 mx-auto">
					<div class="card">
						<h5 class="card-header">JazzCash / NayaPay / SadaPay </h5>
						<div class="card-body">
							<p> Account Number: 03008237720 </p>
						</div>
					</div>
				</div>
				<div class="col-md-4 mx-auto">
					<div class="card">
						<h5 class="card-header">Cash Deposit at Office </h5>
						<div class="card-body">
							<p>  B-83, Block 10, Gulshan e Iqbal, Karachi, Sindh, Pakistan </p>
							<p> Office A, 1st Floor, JF Business Bay, Block D, Five Star Chowrangi, North Nazimabad, Karachi. </p>

						</div>
					</div>
				</div>
				<div class="col-md-4 mx-auto">
					<div class="card">
						<h5 class="card-header">Out of Pakistan Payment Options:</h5>
						<div class="card-body">
							<p> If you are out of Pakistan you can use these for sending payments. Please use the option to deposit payment in the bank account of Bank Al Habib Limited. </p>
							<p>   https://www.remitly.com </p>
							<p>    https://www.riamoneytransfer.com </p>
							<p>    https://www.moneygram.com </p>
							<p>    https://www.xpressmoney.com </p>
							<p>    https://www.worldremit.com </p>
							<p>   https://www.westernunion.com </p>


							<p>   Overseas Pakistani: When you send payment through Western Union or Riya or any other online method please use deposit in bank account. Do Not Use Cash Pickup.</p>
						</div>
					</div>
				</div>
			</div>

			<div class="row text-center">
				<div class="col-md-8 mx-auto">
					<div class="card" style="border: 3px solid #040F2E">
						<div class="card-body text-center">
							<p class="bottomInfoMessage">Doosri Biwi is a registered trademark & protected under the copyright laws of the Government of Pakistan.</p>
							<p class="bottomInfoMessage">شادی آرگنائزیشن پاکستان ایک رجسٹرڈ ٹریڈ مارک ہے اور حکومت پاکستان کے کاپی رائٹ قوانین کے تحت محفوظ ہے۔</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</main>

@endsection

@push('script')
	<script type="text/javascript">

	</script>
@endpush