@extends('front.layouts.master')
@section('title', $title)
@section('description', $title)

@push('style')
	<style>
		.bg-shaadi-ladoo{
			border-radius: 8px;
			background-image: url("{{asset('web_images/Rishtay-Pakistani-Shaadi-Ka-Laddu.jpg')}}");
			background-repeat: no-repeat;
			background-size: cover;
			height: 400px;
			/*box-shadow: inset 0 0 0 2000px rgba(255, 0, 150, 0.3);*/
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

		#timer {
			font-size: 3em;
			font-weight: 100;
			color: white;
			text-shadow: 0 0 20px #ffb5c7;
			display: block;
			margin: 0 auto;
			text-align: center;
		}

		#timer div {
			display: inline-block;
			min-width: 90px;
			color:#fff;
		}
		#timer div span {
			color: #fff;
			display: block;
			font-size: .35em;
			font-weight: 400;
		}
		.ladoo-thumb{
			border-radius: 8px;
			padding: 0;
			margin: 0;
		}
		.ladoo-thumb .card-body{
			padding: 0;
			margin: 0;
		}
		.special-note {
			background: transparent;
			text-align: center;
		}
		.special-note p:nth-child(1) {
			font-size: 20px;
			font-weight: 600;
			color: #040F2E;
			margin-bottom: 0;
		}
		.special-note p:nth-child(2) {
			font-size: 18px;
			font-weight: 600;
		}
		.number-list {
			border: 1px solid lightgray;
			padding: 5px 10px;
		}
		.partial-image img {
			width: 80%;
		}
		.section-heading {
			font-size: 40px;
			color: #D5AD6D;
			background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(255 227 183) 61%, rgba(213,173,109,1) 100%);
			background: -o-linear-gradient(transparent, transparent);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			font-weight: 600;
		}
		.section-paragraph {
			font-size: 22px;
			color: #fff;
			font-weight: 500;
		}
		.card {
			border-radius: 20px;
			box-shadow: 5px 5px 5px #0000003d;
			border: none;
		}
		.career_slider img {
			box-shadow: 6px 6px 12px 0px rgba(0,0,0,0.4);
			border-radius: 5px;
		}
		.section-card-heading {
			font-size: 30px;
			color: #D5AD6D;
			background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%);
			background: -o-linear-gradient(transparent, transparent);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			font-weight: 600;
			text-align: center;
		}
		@media only screen and (max-width: 600px) {
			.bg-shaadi-ladoo {
				height: 100px;
			}
			#timer {
				font-size: 2em;
			}
			#timer div {
				min-width: 60px;
			}
			.counter-laddoo {
				width: 100%;
			}
			.p-40 {
				padding: 0px;
			}
			.partial-image img {
				width: 100% !important;
			}
			.slick-arrow.slick-prev {
				left: 0;
			}
			.slick-arrow.slick-next {
				right: 0;
			}
			.section-card-heading {
				font-size: 20px !important;
			}
		}
	</style>
@endpush

@section('content')

	<main>
		<div class="container-xxl">
			<br>
			<h1 class="align-center font-weight-600">{{$title}}</h1>
			<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">
			<h2 class="align-center text-theme font-weight-600" style="font-size: 22px;">Doosri Biwi is presenting</h2>
			<h2 class="align-center" style="font-size: 18px;">Direct Family to Family Rishta Meeting Event. Find Life Partner, Fast & Easy</h2>
			<p class="align-center text-theme font-weight-600">Sunday, 29 October, 2023</p>
			<br>

			<div class="row">
				<div class="col-md-7 my-auto mx-auto text-center">
					<h4 class="heading-4 text-theme font-weight-600">Rishta Milna Hua Aasan</h4>
					<p class="paragraph-1">By the Grace of Allah Almighty <strong>Shaadi Organization® Pakistan</strong> is the biggest and most trusted marriage bureau in Pakistan and we are the pioneer of Direct Family to Family Rishta Meetings and Grand Matchmaking Events in Pakistan.</p>

					<p class="paragraph-1">One of its kind Matchmaking events in Pakistan where we arrange 'Direct Family to Family Rishta Meeting' between the families and candidates so they can find their soulmates faster and easily.</p>

					<p class="paragraph-1">We are registered and recognized organization in Pakistan and the only organization having given the award of "<strong>The Most Trusted Matrimonial Service in Pakistan®</strong>".</p>

					<p class="paragraph-1">One of its kind Matchmaking events in Pakistan where we arrange 'Direct Family to Family Rishta Meeting' between the families and candidates so they can find their soulmates faster and easily.</p>

					<p class="paragraph-1">By the Grace of Allah Almighty <strong>Shaadi Organization® Pakistan</strong> is the biggest and most trusted marriage bureau in Pakistan and we are the pioneer of Direct Family to Family Rishta Meetings and Grand Matchmaking Events in Pakistan.</p>
				</div>
				<div class="col-md-5 my-auto mx-auto">
					<div class="director-img">
						<img class="full-width" src="{{asset('assets/img/call_action_images/shaadi-orginzation-pakistan-elite-family-rishta-meetup.png')}}" alt="Elite Rishta Family Meetup">
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12">
					<div class="counter-laddoo">
						<div id="timer"></div>
					</div>
				</div>
			</div>
			<br>
		</div>

	</main>

@endsection

@push('script')
	<script type="text/javascript">

        // Set the date we're counting down to
        var countDownDate = new Date("October 29, 2023 18:00:00").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            let timerHtml = '';
            if (days > 0) {
                timerHtml += `<div>${days}<span>Days</span></div>`;
            }
            if (hours > 0) {
                timerHtml += `<div>${hours}<span>Hours</span></div>`;
            }
            if (hours > 0 && minutes > 0) {
                timerHtml += `<div>${minutes}<span>Minutes</span></div>`;
            } else if (minutes > 0) {
                timerHtml += `<div>${minutes}<span>Minutes</span></div>`;
            }
            timerHtml += `<div>${seconds}<span>Seconds</span></div>`;
            document.getElementById("timer").innerHTML = timerHtml;

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                $('.counter-laddoo').hide();
            }
        }, 1000);
	</script>
@endpush