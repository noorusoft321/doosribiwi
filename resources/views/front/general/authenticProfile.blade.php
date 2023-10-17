@extends('front.layouts.master')
@section('title','Authentic Profile - Free Pakistani Rishta | Matrimonial Website | Matrimony Services | Marriage Bureau')
@section('description', 'Authentic Profile - Free Pakistani Rishta | Matrimonial Website | Matrimony Services | Marriage Bureau | DoosriBiwi.com')

@push('style')
    <style>
        ul.authentic-detail li {
            font-size: 16px;
        }
    </style>
@endpush

@section('content')

<main>
	<div class="container-xxl">
		<br>
        <h2 class="align-center font-weight-600"> 9-Points Verification Badges </h2>
       	<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">
       	<p class="align-center font-20">9-Points Verification Badges is the highest level of trust & protection system for safety of members. It display 9 badges on the member profiles after they pass the verification process. Fully verified members also get “The Famous Blue Tick” on their profile. These badges separate serious members from time pass people.</p>
       	<p class="align-center font-20">9-Point verification include: Photo, Phone, Email Address, Location/Home Address, Education, Age, Salary, Nationality, and Meeting.</p>
       	<p class="align-center font-20">Authentication is not a character certificate. All the communication with authentic and normal profile must be done with due care and under parents’ supervision.</p>
       	<p class="align-center font-20">9-Point verification require some processing time of our staff therefore we charge a small fee for it. Website is free and you can use it without any verification too.</p>

		<div class="row justify-content-md-center">
		    <div class="col-md-7">
		        <img class="align-center-img full-width" src="{{asset('web_images/rishtay-pakistan-badges-image.png')}}">
		        <!-- /.card-icon-component -->
		    </div>
		    <!-- /.col -->
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="card card-h">
                    <h4 class="text-dark mb-0">Verification charges are:</h4>
                    <ul class="authentic-detail">
                        <li> Rs. 3,000 for General Case (Single) </li>
                        <li> Rs. 5,000 for Divorce Case</li>
                        <li> Rs. 10,000 for 2nd Marriage Case</li>
                        <li> Rs. 15,000 for Abroad Case</li>
                    </ul>
                </div>
			</div>

			<div class="col-md-4">
				<div class="card card-h">
                    <h4 class="text-dark mb-0">Bank Al Habib Limited.</h4>
                    <ul class="authentic-detail">
                        <li>Account Title: MUHAMMAD ALI</li>
                        <li>Account Number: 50120081006932017</li>
                        <li>IBAN No.: PK02BAHL5012008100693201</li>
                        <li>Branch Code: 5012</li>
                        <li>SWIFT Code: BAHLPKKAXXX</li>
                        <li>Currency: PKR</li>
                        <li>Branch Name: Islamic Branch, Gulshan-e-Iqbal, Block 6, Karachi.</li>
                    </ul>
                </div>
			</div>

			<div class="col-md-4">
				<div class="card card-h">
                    <h4 class="text-dark mb-0">Dubai Islamic Bank Pakistan Ltd.</h4>
                    <ul class="authentic-detail">
                        <li>Account Title: SHAADI</li>
                        <li>Account Number: 0105282003</li>
                        <li>IBAN: PK45DUIB0000000105282003</li>
                        <li>Account Category: CURRENT</li>
                        <li>Account Type: CASA</li>
                        <li>Currency: PKR</li>
                        <li>Branch Karachi: Gulshan-e-Iqbal Branch</li>
                    </ul>
                </div>
			</div>
		</div>
	</div>
    <br>
    <div class="container-xxl">
        <div class="row justify-content-center mx-auto text-center">
            <div class="col-md-5">
                <p class="font-weight-500">Easy Paisa account/Telenor Microfinance Bank: 03452444262</p>
                <p class="font-weight-500">Please deposit verification fee and send payment proof on WhatsApp: +923452444262 </p>
                <a class="btn btn-outline-primary" href="https://wa.me/923452444262?text=I'm%20interested%20in%20Profile%20Verification" title="" target="_blank">  Verify Account WhatsApp 03452444262 </a>
            </div>
        </div>
    </div>
    <br>
</main>

@endsection
@push('script')
@endpush