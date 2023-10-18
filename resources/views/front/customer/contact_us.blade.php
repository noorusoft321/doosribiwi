@extends('front.layouts.master')
@section('title',$title)
@section('description', $title)

@push('style')
@endpush
<style>
	.section-card-heading {
		font-size: 2.2rem;
		color: #D5AD6D;
		background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%);
		background: -o-linear-gradient(transparent, transparent);
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		font-weight: 600;
		text-align: left;
	}
	.iframe-main {
		width: 100%;
		border: 5px solid #3e507c;
		margin: 10px 0 10px 0;
		box-shadow: 6px 6px 12px 0px rgba(0,0,0,0.4);
		border-radius: 10px;
		margin-bottom: 40px;
	}
	/*.n-sec-img img {*/
		/*width: 100%;*/
		/*box-shadow: 6px 6px 12px 0px rgba(0,0,0,0.4);*/
		/*border-radius: 50%;*/
	/*}*/
	.n-sec-img img {
		border-radius: 15px;
		filter: drop-shadow(0px 0px 5px #131f3f);
		-webkit-filter: drop-shadow(0px 0px 5px #081844);
		width: 100%;
		box-shadow: 6px 6px 18px 0px rgba(0,0,0,0.4);
		background-image: linear-gradient(#040F2E,#131f3f,#181e2d,#081844);
		padding: 5px 0px 5px 5px;
	}
	.questionary-msg {
		font-size: 1.1rem;
	}
	.divider:after, .divider:before {
		content: "";
		flex: 1;
		height: 3px;
		background: #040F2E;
	}

	.n-bg-img {
		/* background: #040F2E; */
		background-image: url(/assets/img/legal-protection.jpg);
		background-repeat: repeat;
		-webkit-text-size-adjust: 100%;
		-webkit-tap-highlight-color: rgba(31, 33, 49, 0);
		background-color: #040F2E;
		background-size: cover;
	}
	.newInfoStyle p {
		font-size: 1.2rem;
		color: #ffffff;
		text-align: center;
	}

	@media only screen and (max-width: 600px) {
		.section-card-heading {
			font-size: 1.3rem !important;
			text-align: center;
			margin-top: 10px;
		}
	}
</style>

@section('content')

<main>
	<div class="container">
		<br>
		<div class="row">

			<div class="col-md-8 mx-auto">
				<h2 class="align-center font-weight-600"> Contact Us </h2>
				<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">
				<h3 class="section-card-heading text-center mt-2 mb-2">Welcome to DoosriBiwi.com</h3>
				<p class="align-center">DoosriBiwi.com is the only destination for people looking for a second female life partner or looking for a better male life partner who can give them all the happiness in the world.</p>
			</div>

			<div class="col-md-10 mx-auto">
				<div class="row">
					<div class="col-md-6 mx-auto my-auto">
						<div class="n-sec-img">
							<img src="{{asset('assets/img/call_action_images/shaadi-orginzation-pakistan-male.png')}}" alt="Image">
						</div>
					</div>
					<div class="col-md-6 mx-auto my-auto">
						<h3 class="section-card-heading text-center">Are you Male?</h3>
						<p class="questionary-msg text-center">Are you a well-established male and looking for a beautiful and intelligent female as a 2nd wife in presence of 1st wife (Doosri Biwi)?</p>
						<p class="questionary-msg text-center">کیا آپ ایک اچھی طرح سے قائم شدہ مرد ہیں اور پہلی بیوی (دوسری بیوی) کی موجودگی میں دوسری بیوی کے طور پر ایک خوبصورت اور ذہین خاتون کی تلاش کر رہے ہیں؟</p>
					</div>
				</div>

				<div class="divider d-flex align-items-center my-4">
					<p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
				</div>

				<div class="row">
					<div class="col-md-6 mx-auto my-auto">
						<div class="n-sec-img">
							<img src="{{asset('assets/img/call_action_images/shaadi-orginzation-pakistan-female.png')}}" alt="Image">
						</div>
					</div>
					<div class="col-md-6 mx-auto my-auto order-lg-first order-md-first">
						<h3 class="section-card-heading text-center">Are you Female?</h3>
						<p class="questionary-msg text-center">Are you a beautiful, smart and intelligent female and looking for a well-established, handsome and successful male and ready to become his Doosri Biwi (2nd wife in presence of 1st wife)?</p>
						<p class="questionary-msg text-center">کیا آپ ایک خوبصورت، ہوشیار اور ذہین خاتون ہیں اور ایک اچھی طرح سے قائم، خوبصورت اور کامیاب مرد کی تلاش میں ہیں اور اس کی دوسری بیوی (پہلی بیوی کی موجودگی میں دوسری بیوی) بننے کے لیے تیار ہیں؟</p>
					</div>
				</div>
			</div>

		</div>
		<br>
	</div>

	<!-- Legal Protection Section Start -->
	<div class="p-tb-50 n-bg-img">
		<div class="container">
			<h2 class="align-center font-weight-600 white-color"> Legal Protection </h2>
			<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">
			<br>
			<div class="row newInfoStyle">
				<div class="col-md-6 mx-auto my-auto">
					<p>
						Our organization is registered with the government of Pakistan and we have a team of lawyers and advocates. Al Haqq Law Firm to protect your rights and to ensure you both start your life with full confidence and enjoy your new journey. Our associate advocates and lawyers at Al Haqq Law Firm will ensure that everything is legal and binding on both parties and ensure a safe and joyful start to a new marriage life.
					</p>
				</div>
				<div class="col-md-6 mx-auto my-auto">
					<p>
						ہماری تنظیم حکومت پاکستان کے ساتھ رجسٹرڈ ہے اور ہمارے پاس وکلاء اور وکلاء کی ایک ٹیم ہے۔ الحق لاء فرم آپ کے حقوق کے تحفظ اور اس بات کو یقینی بنانے کے لیے کہ آپ دونوں اپنی زندگی کا آغاز پورے اعتماد کے ساتھ کریں اور اپنے نئے سفر سے لطف اندوز ہوں۔ الحاق لاء فرم میں ہمارے ساتھی وکلاء اس بات کو یقینی بنائیں گے کہ ہر چیز قانونی اور دونوں فریقوں کے لیے پابند ہے اور نئی ازدواجی زندگی کے لیے ایک محفوظ اور خوشگوار آغاز کو یقینی بنائیں گے۔
					</p>
				</div>
			</div>

			<div class="align-center p-tb-30">
				<a target="_blank" href="https://api.whatsapp.com/send?phone=923452444262&text=Hi%20Doosri.biwi.com%2C%20I%20need%20more%20information." class="button-theme-light"> Contact Us </a>
			</div>

		</div>
	</div>
	<!-- Legal Protection Section End -->

	<br>
	<div class="container">
		<div class="iframe-main">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3618.5567091644552!2d67.09543801136503!3d24.913098043056248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb338caa499dcc7%3A0x620468db22f4cf7f!2sDoosriBiwi.com%2C%20Marriage%20Bureau%2C%20Rishta%20Pakistan%2C%20Matrimony%2C%20Karachi%20Lahore%20Islamabad!5e0!3m2!1sen!2s!4v1683993914205!5m2!1sen!2s" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="border:0"></iframe>
		</div>
	</div>

</main>

@endsection

@push('script')
	{{--Script--}}
@endpush