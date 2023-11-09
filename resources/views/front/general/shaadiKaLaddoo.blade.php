@extends('front.layouts.master')
@section('title','Shaadi Ka Laddu')
@section('description', 'Shaadi Ka Laddu')

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
			background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);
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
			color: #082f49;
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
			box-shadow: 5px 5px 5px #082f493d;
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
			<h1 class="align-center font-weight-600">Shaadi Ka Laddu</h1>
			<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-thin-border.png')}}">
			{{--<h2 class="align-center text-theme font-weight-600" style="font-size: 22px;">Season-3, Coming Soon ...</h2>--}}
			<h2 class="align-center" style="font-size: 18px;">Direct Family to Family Rishta Meeting Event</h2>
			{{--<p class="align-center text-theme font-weight-600">Sunday, 27 August, 2023 | 6 pm to 11 pm</p>--}}
			<br>

			<div class="row">
				<div class="col-md-6 my-auto mx-auto text-center">
					<h4 class="heading-4 text-theme font-weight-600">Rishta Milna Hua Aasan</h4>
					<p class="paragraph-1">By the Grace of Allah Almighty <strong>Shaadi Organization® Pakistan</strong> is the biggest and most trusted marriage bureau in Pakistan and we are the pioneer of Direct Family to Family Rishta Meetings and Grand Matchmaking Events in Pakistan.</p>

					<p class="paragraph-1">One of its kind Matchmaking events in Pakistan where we arrange 'Direct Family to Family Rishta Meeting' between the families and candidates so they can find their soulmates faster and easily.</p>

					<p class="paragraph-1">We are registered and recognized organization in Pakistan and the only organization having given the award of "<strong>The Most Trusted Matrimonial Service in Pakistan®</strong>".</p>
				</div>
				<div class="col-md-6 my-auto mx-auto">
					<!--<div class="director-img">-->
				<!--	<img class="full-width" src="{{asset('assets/img/call_action_images/shaadi-orginzation-pakistan-Shadi-ka-ladu-season-3.jpg')}}" alt="Shaadi Ka Laddu">-->
					<!--</div>-->
					<!--<iframe width="100%" height="400px" src="https://www.youtube.com/embed/Y4MRGmUyvio" title="Shaadi Ka Laddu Season II - Sunday, July 16, 2023 | Direct Family to Family Rishta | DoosriBiwi.com" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
					{{--<iframe width="100%" height="400px" src="https://www.youtube.com/embed/VzvsMAErcag" title="Shaadi Ka Laddu - Season 3 | Family to Family Rishta Meeting | Best Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>--}}
					<iframe width="100%" height="400px" src="https://www.youtube.com/embed/IiUjZEfLJwI" title="Shaadi Ka Laddu - Season 3 Highlights | Family to Family Rishta Meeting Event | Best Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
				</div>
			</div>
			<br>
			{{--<div class="row">--}}
			{{--<div class="col-md-12">--}}
			{{--<div class="counter-laddoo">--}}
			{{--<div id="timer"></div>--}}
			{{--</div>--}}
			{{--</div>--}}
			{{--</div>--}}
			<br>
			<br>
		</div>

		<div class="p-tb-50 bg-img call-to-action">
			<div class="container">
				<div class="row">
					<div class="col-md-8 order-md-2 my-auto text-center">
						<h4 class="section-heading">Girls: Say NO to Rishta Tea Tray Culture</h4>
						<p class="section-paragraph">Our Daughters and Sisters are not for bringing Tea Tray in front of every stranger and then getting rejected. We love our daughters and sisters and we will not allow anyone to break their hearts.</p>
					</div>
					<div class="col-md-4 order-md-1 my-auto partial-image">
						<img src="{{asset('shaadikaladdu/rishtay-pakistan-girls-say-no-to-rishta-tea-tray-culture.png')}}" alt="Girls: Say NO to Rishta Tea Tray Culture">
					</div>
				</div>
			</div>
		</div>

		<br>

		<div class="container">
			<div class="row">
				<div class="col-md-8 my-auto text-center">
					<h4 class="heading-4 text-theme font-weight-600">Boys: Say NO to Filter Wali Pictures for Rishta</h4>
					<p class="paragraph-1">Our Sons and Brothers are working professionals and they are not free to go at every girl’s home after seeing 'Filter Wali Picture' and then come home disappointed because girl in the picture looks very different from the actual person due to beauty filters used on mobile phones.</p>
				</div>
				<div class="col-md-4 my-auto partial-image">
					<img src="{{asset('shaadikaladdu/rishtay-pakistan-boys-say-no-to-filter-wali-pictures-for-rishta.png')}}" alt="Boys: Say NO to Filter Wali Pictures for Rishta">
				</div>
			</div>
		</div>

		<br>

		<div class="p-tb-50 bg-img call-to-action">
			<div class="container">
				<div class="row">
					<div class="col-md-8 order-md-2 my-auto text-center">
						<h4 class="section-heading">Parents: Say NO to Traditional Rishta Wali Aunty</h4>
						<p class="section-paragraph">We want our sons and daughters to find soulmates fast and easy without going through rejections and time waste. We only want to meet only those people who are genuine, educated have a good family background and very much interested in our sons and daughters.</p>
					</div>
					<div class="col-md-4 order-md-1 my-auto partial-image">
						<img src="{{asset('shaadikaladdu/rishtay-pakistan-parents-say-no-to-traditional-rishta-wali-aunty.png')}}" alt="Parents: Say NO to Traditional Rishta Wali Aunty">
					</div>
				</div>
			</div>
		</div>

		<br>

		<div class="container-xxl">
			<br>
			<h2 class="align-center font-weight-600">Shaadi Ka Laddu (Season 3) </h2>
			<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-thin-border.png')}}">
			<h4 class="align-center font-weight-500 mt-1">Sunday, 27 August, 2023</h4>
			<br>
			<div class="card">
				<div class="card-body">
					<h3 class="section-card-heading">Season 3 Videos Highlights</h3>
					<br>
					<div class="row">
						<div class="col-md-2 mx-auto"></div>
                        <div class="col-md-4 mx-auto">
							<iframe width="100%" height="270px" src="https://www.youtube.com/embed/IiUjZEfLJwI" title="Shaadi Ka Laddu - Season 3 Highlights | Family to Family Rishta Meeting Event | Best Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
						<div class="col-md-4 mx-auto">
							<iframe width="100%" height="270px" src="https://www.youtube.com/embed/VzvsMAErcag" title="Shaadi Ka Laddu - Season 3 | Family to Family Rishta Meeting | Best Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
						</div>
						<div class="col-md-2 mx-auto"></div>
					</div>
				</div>
			</div>
			<br>
			<div class="card">
			<div class="card-body">
			<h3 class="section-card-heading">Season 3 Pictures Highlights</h3>
			<div class="career_slider">
			@foreach($thirdSeasonImages as $key => $val)
			<img class="full-width" src="{{asset('ourEvents/'.$val)}}" alt="Shaadi Ka Laddu Season 3 {{$key+1}}" width="100%">
			@endforeach
			</div>
			</div>
			</div>

			<br>
			<h2 class="align-center font-weight-600">Shaadi Ka Laddu (Season 2) </h2>
			<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-thin-border.png')}}">
			<h4 class="align-center font-weight-500 mt-1">Sunday, 16 July, 2023</h4>
			<br>
			<div class="card">
				<div class="card-body">
					<h3 class="section-card-heading">Season 2 Videos Highlights</h3>
					<br>
					<div class="row">
						<div class="col-md-4 mx-auto">
							<iframe width="100%" height="270px" src="https://www.youtube.com/embed/EbFub7qoMMA" title="Shaadi Ka Laddu  Season - 2 Highlights | 300+ Rishtey Done | Family Event | Best Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
						</div>
						<div class="col-md-4 mx-auto">
							<iframe width="100%" height="270px" src="https://www.youtube.com/embed/Y4MRGmUyvio" title="Shaadi Ka Laddu Season II - Sunday, July 16, 2023 | Direct Family to Family Rishta | DoosriBiwi.com" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
						</div>
						<div class="col-md-4 mx-auto">
							<iframe width="100%" height="270px" src="https://www.youtube.com/embed/CXTPSKy9ok8" title="Shaadi Ka Laddu Season II - Sunday July 16, 2023 | Direct Family to Family Rishta | DoosriBiwi.com" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="card">
				<div class="card-body">
					<h3 class="section-card-heading">Season 2 Pictures Highlights</h3>
					<div class="career_slider">
						@foreach($secondSeasonImages as $key => $val)
							<img class="full-width" src="{{asset('ourEvents/'.$val)}}" alt="Shaadi Ka Laddu Season 2 {{$key+1}}" width="100%">
						@endforeach
					</div>
				</div>
			</div>

			<br>
			<h2 class="align-center font-weight-600">Shaadi Ka Laddu (Season 1) </h2>
			<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-thin-border.png')}}">
			<h4 class="align-center font-weight-500 mt-1">Sunday, 14 May, 2023</h4>
			<br>
			<div class="card">
				<div class="card-body">
					<h3 class="section-card-heading">Season 1 Videos Highlights</h3>
					<br>
					<div class="row">
						<div class="col-md-4 my-auto">
							<iframe width="100%" height="270px" src="https://www.youtube.com/embed/gIeYEqS5ySo" title="Shaadi Ka Laddoo Event Highlights | Family to Family Free Rishta | Doosri Biwi" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
						</div>
						<div class="col-md-4 my-auto">
							<iframe width="100%" height="270px" src="https://www.youtube.com/embed/w-lJiIzOPg0" title="Find your Life Partner | Free Rishta Meeting | Best Matchmakers | Doosri Biwi." frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
						</div>
						<div class="col-md-4 my-auto">
							<iframe width="100%" height="270px" src="https://www.youtube.com/embed/amm8hZTuMX8" title="Free Rishta Meeting | Direct Family to Family Rishta | Doosri Biwi, Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="card">
				<div class="card-body">
					<h3 class="section-card-heading">Season 1 Pictures Highlights</h3>
					<div class="career_slider">
						@foreach($firstSeasonImages as $key => $val)
							<img class="full-width" src="{{asset('ourEvents/'.$val)}}" alt="Shaadi Ka Laddu Season 1 {{$key+1}}" width="100%">
						@endforeach
					</div>
				</div>
			</div>
			<br>

			<h2 class="align-center font-weight-600"> Benefits </h2>
			<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-thin-border.png')}}">
			<br>
			<div class="row">
				<div class="col-md-12">
					<div class="card p-40">
						<div class="card-body">
							<ul>
								<li>See dozens of proposals (rishtay) at our Rishta Meeting Events.</li>
								<li>Meet people before you invite strangers at home.</li>
								<li>Invite only those families at home who you like in the event.</li>
								<li>Safe your daughter from bringing Tea Tray in front of everyone.</li>
								<li>Safe your son and your time from traveling and going to every house.</li>
								<li>Stop breaking your daughter's heart from coming people at home and rejecting her.</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<br>
			<h2 class="align-center font-weight-600"> WhatsApp Us </h2>
			<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-thin-border.png')}}">
			<p class="align-center">
				نوٹ  : برائےمہربانی صرف ان ہی نمبرز پر رابطہ کریں جو ہماری ویب سائٹ اور فیس بک پیج پر درج ہیں۔
			</p>
			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="number-list">
										UAN / WhatsApp
										<a href="https://api.whatsapp.com/send?phone=923481117861&amp;text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information.">+923481117861</a>
									</div>
								</div>
								<div class="col-md-6">
									<div class="number-list">
										Mrs. Siddiqui
										<a href="https://api.whatsapp.com/send?phone=923488800022&amp;text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information.">+923488800022</a>
									</div>
								</div>
								<div class="col-md-6">
									<div class="number-list">
										Mrs. Arain
										<a href="https://api.whatsapp.com/send?phone=923428504242&amp;text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information.">+923428504242</a>
									</div>
								</div>
								<div class="col-md-6">
									<div class="number-list">
										Mrs. Syed
										<a href="https://api.whatsapp.com/send?phone=923460025624&amp;text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information.">+923460025624</a>
									</div>
								</div>
								<div class="col-md-6">
									<div class="number-list">
										Mrs. Hashmi
										<a href="https://api.whatsapp.com/send?phone=923102658315&amp;text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information.">+923102658315</a>
									</div>
								</div>
								<div class="col-md-6">
									<div class="number-list">
										Mrs. Fariya
										<a href="https://api.whatsapp.com/send?phone=923491007310&amp;text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information.">+923491007310</a>
									</div>
								</div>
								<div class="col-md-6">
									<div class="number-list">
										Mrs. Fiza
										<a href="https://api.whatsapp.com/send?phone=923491007317&amp;text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information.">+923491007317</a>
									</div>
								</div>
								<div class="col-md-6">
									<div class="number-list">
										Mrs. Anila
										<a href="https://api.whatsapp.com/send?phone=923491007316&amp;text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information.">+923491007316</a>
									</div>
								</div>
								<div class="col-md-6">
									<div class="number-list">
										Mrs. Khan
										<a href="https://api.whatsapp.com/send?phone=923432435092&amp;text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information.">+923432435092</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<br>
			<div class="special-note">
				<p>
					رشتہ ملنا ہوا آسان، شادی آرگنائزیشن پاکستان
					<br>
					پاکستان کی سب سے بڑی اور بھروسہ مند رشتہ سروس
				</p>
			</div>



		</div>
	</main>

@endsection

@push('script')
	<script type="text/javascript">

        // // Set the date we're counting down to
        // var countDownDate = new Date("August 27, 2023 18:00:00").getTime();
        //
        // // Update the count down every 1 second
        // var x = setInterval(function() {
        //
        //     // Get today's date and time
        //     var now = new Date().getTime();
        //
        //     // Find the distance between now and the count down date
        //     var distance = countDownDate - now;
        //
        //     // Time calculations for days, hours, minutes and seconds
        //     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        //     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        //     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        //     var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        //
        //     // Display the result in the element with id="demo"
        //     let timerHtml = '';
        //     if (days > 0) {
        //         timerHtml += `<div>${days}<span>Days</span></div>`;
        //     }
        //     if (hours > 0) {
        //         timerHtml += `<div>${hours}<span>Hours</span></div>`;
        //     }
        //     if (hours > 0 && minutes > 0) {
        //         timerHtml += `<div>${minutes}<span>Minutes</span></div>`;
        //     } else if (minutes > 0) {
        //         timerHtml += `<div>${minutes}<span>Minutes</span></div>`;
        //     }
        //     timerHtml += `<div>${seconds}<span>Seconds</span></div>`;
        //     document.getElementById("timer").innerHTML = timerHtml;
        //
        //     // If the count down is finished, write some text
        //     if (distance < 0) {
        //         clearInterval(x);
        //         $('.counter-laddoo').hide();
        //     }
        // }, 1000);

        $('.career_slider').slick({
            dots: false,
            infinite: true,
            speed: 600,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1000,
            arrows: false,
            responsive: [
                {
                    breakpoint: 600,
                    settings: {
                        arrows: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 400,
                    settings: {
                        arrows: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('.videos_slider').slick({
            dots: false,
            infinite: true,
            speed: 600,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 1000,
            arrows: true,
            responsive: [
                {
                    breakpoint: 600,
                    settings: {
                        arrows: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 400,
                    settings: {
                        arrows: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
	</script>
@endpush