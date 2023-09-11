@extends('front.layouts.master')

@section('title','Rishta Pakistan, Shaadi Marriage Bureau, Best Muslima Matrimonial in Pakistan Karachi, Lahore, Islamabad, Faisalabad, Rawalpindi, Gujranwala, Peshawar, Multan, Hyderabad, Islamabad, Quetta. Shia Match available.')
@section('description', 'Doosri Biwi, Government Registered Marriage Bureau Best Rishta in Pakistan Contact for Zaroorat Rishta Pakistan Matrimony for Pakistanis in USA, Canada, UK, Australia, KSA, UAE Single Muslim Matrimony, personalized matchmakers, Sunni, Shia match, Ahle Hadees Rishtay, Doosri Shaadi, Late Marriage, Divorce Rishta, Widow, Separated, Abroad, 2nd Marriage Proposals')
@push('style')
    <style>
        .about-section:after{
            content: "";
            display: block;
            height: 70px;
            background-image: url({{asset('assets/img/call_action_images/shaadi-organization-pakistan-border-hr.png')}});
            background-repeat: repeat-x;
            background-position: center bottom -10px;
        }
        .about-section:before{
            content: "";
            display: block;
            height: 47px;
            background-image: url({{asset('assets/img/call_action_images/shaadi-organization-pakistan-border-hr.png')}});
            transform: rotate(180deg);
            background-repeat: repeat-x;
            background-position: center top;
            margin-top: -23px;
        }
        .ceo-detail:after{
            content: "";
            display: block;
            height: 70px;
            background-image: url({{asset('assets/img/call_action_images/shaadi-organization-pakistan-border-hr.png')}});
            background-repeat: repeat-x;
            background-position: center bottom;
            margin-bottom: -10px;
        }
        .ceo-detail:before{
            content: "";
            display: block;
            height: 47px;
            background-image: url({{asset('assets/img/call_action_images/shaadi-organization-pakistan-border-hr.png')}});
            transform: rotate(180deg);
            background-repeat: repeat-x;
            background-position: center top;
            margin-top: -23px;
        }

        .customerAge {
            height: 30px;
            width: 30px;
            background: #040F2E;
            border-radius: 50%;
            font-size: 15px;
            color: #fff;
            font-weight: 500;
            float: right;
            padding: 6px;
        }

        .profile-boxes{
            width: 100%;
            background: #fff;
            /*box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);*/
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
            /*border-radius: 2px;*/
            padding: 10px;
            position: relative;
            border-radius: 10px;
            box-shadow: 5px 5px 5px #0000003d;
        }
        .image-boxes{
            position: relative;
            text-align: center;
        }
        .image-boxes img{
            width: 150px;
            height: 150px;
            margin-top: 10px;
            border-radius: 50%;
            border: 2px solid #040F2E;
            filter: drop-shadow(0px 0px 5px #9b3854);
            -webkit-filter: drop-shadow(0px 0px 5px #9b3854);
        }
        .image-boxes span {
            background: green;
            padding: 10px 0px 5px 10px;
            border-radius: 50%;
            position: absolute;
            width: 40px;
            text-align: justify;
            bottom: 5px;
            left: 15px;
        }
        .image-boxes span i{
            color:#fff;
            font-weight: bold;
            font-size:20px;
        }
        .badge-corner {
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-top: 66px solid #888;
            border-top-color: rgba(0, 0, 0, 0.3);
            border-left: 66px solid transparent;
            padding: 0;
            background-color: transparent;
            border-radius: 0;
            cursor: default !important;
        }
        .badge-corner span {
            position: absolute;
            top: -55px;
            left: -30px;
            font-size: 16px;
            color: #fff;
            text-align: center;
            line-height: 1;
        }
        .badge-corner1 {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 2;
            width: 0;
            height: 0;
            border-top: 66px solid #dbde12;
            border-top-color: rgba(0, 0, 0, 0.3);
            border-right: 66px solid transparent;
            padding: 0;
            background-color: transparent;
            border-radius: 0;
            cursor: default !important;
        }
        .badge-corner-red {
            border-top-color: green !important;
        }
        .badge-corner-red span {
            top: -48px !important;
            font-size: 11px !important;
            font-weight: bold;
        }
        .badge-corner-default {
            border-top-color: darkgrey !important;
        }
        .badge-corner-yellow {
            border-top-color: orange !important;
        }
        .badge-corner1 span {
            position: absolute;
            top: -52px;
            left: 15px;
            font-size: 13px !important;
            color: #fff;
        }
        .profile-details-boxes h3{
            font-size: 1.2rem;
            font-weight: 600;
            padding-right: 30px;
            color: #040F2E;
        }
        .age-circle{
            width: 50px;
            height: 50px;
            background: #040F2E;
            border-radius: 50%;
            padding: 10px;
            color: #fff;
            font-weight: bold;
            position: absolute;
            bottom: 24px;
            right: 24px;
            text-align: center;
            line-height: 2;
        }
        .profile-boxes-icons i {
            color: #ccc !important;
        }
        .badge-corner2 {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 0;
            border-top: 66px solid #888;
            border-top-color: rgba(0, 0, 0, 0.3);
            border-right: 66px solid transparent;
            padding: 0;
            background-color: transparent;
            border-radius: 0;
            cursor: default !important;
        }
        .badge-corner2 span {
            position: absolute;
            top: -55px;
            left: 16px;
            font-size: 16px;
            color: #fff;
            text-align: center;
            line-height: 1;
        }
        .custom-btn {
            width: auto !important;
            padding: 5px 20px !important;
        }
        .badge-corner3 {
            --f: 10px;
            --r: 15px;
            --t: 10px;
            position: absolute;
            inset: var(--t) calc(-1*var(--f)) auto auto;
            padding: 0 10px var(--f) calc(10px + var(--r));
            clip-path: polygon(0 0,100% 0,100% calc(100% - var(--f)),calc(100% - var(--f)) 100%, calc(100% - var(--f)) calc(100% - var(--f)),0 calc(100% - var(--f)), var(--r) calc(50% - var(--f)/2));
            box-shadow: 0 calc(-1*var(--f)) 0 inset #0005;
        }
        .badge-corner3 span {
            color: #fff;
            font-size: 12px;
            font-weight: 500;
        }
        .contact-number-team {
            position: absolute;
            background: #040F2E;
            color: #fff;
            padding: 4px 16px;
            font-weight: 500;
            border-radius: 5px;
            font-size: .8rem;
            bottom: -12px;
            left: 0%;
            right: 0%;
            margin: 0 auto;
            width: 130px;
        }
        .contact-number-team:hover{
            color: #fdebf0 !important;
        }
        .name-team{
            color: #040F2E;
            font-weight: bold;
            text-align: center;
        }
        .pss-10 img{
            padding:10px;
            border-radius: 50%;
        }
        .ceo-mrs-ali{
            /*width: 100%;*/
            text-align: center;
            /*background: #040F2E;*/
            padding-bottom: 10px;
        }
        .contact-number-ceo {
            font-size: .8rem !important;
            background: #040F2E;
            border-radius: 5px;
            padding: 8px 24px;
            font-weight: 500;
            color: #fff;
        }
        .contact-number-ceo:hover{
            color: #fdebf0 !important;
        }
        .ceoMainDetail {
            position: relative;
            border-radius: 10px;
            box-shadow: 5px 5px 5px #0000003d;
            border: none;
            height: 370px;
            margin-top: 220px;
            padding-top: 220px;
        }
        .ceo-img {
            position: absolute;
            width: 500px;
            padding: 50px;
            border-radius: 100%;
            filter: drop-shadow(0px 0px 5px #ECC440);
            -webkit-filter: drop-shadow(0px 0px 5px #ECC440);
            left: 0;
            right: 0;
            margin: 0 auto;
            top: -250px;
        }
        .ourTeamMember {
            position: relative;
            border-radius: 10px;
            box-shadow: 5px 5px 5px #0000003d;
            border: none;
            height: 250px;
            margin-bottom: 25px;
        }
        .ourTeamMember img {
            width: 85%;
            border-radius: 50%;
            filter: drop-shadow(0px 0px 5px #ECC440);
            -webkit-filter: drop-shadow(0px 0px 5px #ECC440);
        }
        .ceoMainDetail h3 {
            font-size: 15px;
            text-align:center;
            color: #8D8B8B;
        }
        .ceoMainDetail p {
            font-size:18px;
            text-align: center;
            padding:10px;
        }
        .ourGuest {
            position: relative;
            width: 100%;
            height: auto;
        }
        .ourGuestAbout {
            position: absolute;
            height: 50px;
            width: 100%;
            background: #D8A62A;
            background-image: linear-gradient(#B88A44,#E0AA3E,#E0AA3E,#F9F295);
            border-radius: 4px;
            bottom: 14px;
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
            margin: 0;
        }
        .ourGuestAbout p {
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            text-align: center;
            width: 100%;
            color: white;
            font-size: 14px;
            font-weight: 500;
        }

        .ourGuest img {
            box-shadow: 6px 6px 12px 0px rgba(0,0,0,0.4);
            margin-bottom: 20px;
            width: 100%;
            border-radius: 5px 50px;
            padding: 4px;
            background-image: linear-gradient(#F9F295,#E0AA3E,#E0AA3E,#B88A44);
        }

        .ourOffices {
            position: relative;
            width: 100%;
            height: auto;
        }
        .ourOfficesAbout {
            position: absolute;
            height: 50px;
            width: 100%;
            background: #D8A62A;
            background-image: linear-gradient(#040F2E,#9D344B,#A8425C,#A8496B);
            border-radius: 4px;
            bottom: 14px;
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
            margin: 0;
        }
        .ourOfficesAbout p {
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            text-align: center;
            width: 100%;
            color: white;
            font-size: 14px;
            font-weight: 500;
        }

        .ourOffices img {
            box-shadow: 6px 6px 12px 0px rgba(0,0,0,0.4);
            margin-bottom: 20px;
            width: 100%;
            border-radius: 50px 5px;
            padding: 4px;
            background-image: linear-gradient(#A8496B,#A8425C,#9D344B,#040F2E);
        }

        @media only screen and (max-width: 600px) {
            .trusted_slider {
                margin-top: 10px;
            }
            .image-boxes img{
                height: 130px;
                width: 130px;
            }
            .age-circle {
                width: 40px;
                height: 40px;
                bottom: 4px;
                right: 6px;
                line-height: 1.5;
            }
            .image-boxes span {
                bottom: 0;
                left: 5px;
            }
            .image-boxes{
                margin-left: 10px;
            }
            .contact-number-ceo {
                font-size: 12px !important;
                padding: 8px 30px;
            }
            .ceo-img {
                width: 300px;
                top: -150px;
            }
            .ceoMainDetail {
                margin-top: 115px;
                padding-top: 115px;
                height: 275px;
            }
            .ceoMainDetail h3 {
                font-size:14px;
            }
            .ceoMainDetail p {
                font-size:15px;
            }
            .contact-number-team {
                padding: 5px 10px;
                font-size: 12px;
            }
            .ourTeamMember {
                height: 225px;
            }
            .ourTeamMember img {
                width: 100%;
            }
            .videoContentDiv h3,.videoContentDiv h3 span {
                font-size: 1rem;
            }
            .video-quote img {
                width: 50px;
            }
            .trusted_slider iframe {
                height: 255px !important;
                margin-top: 30px!important;
            }
        }

    </style>

    <style>
        /**, *::before, *::after {*/
            /*box-sizing: border-box;*/
        /*}*/

        .mp-responsive{
            width:100%;
            height:auto;
            overflow: hidden;
        }
        /*effect zoom*/
        .mp-carousel span{
            display: block;
            transform: translate(-45%, 0) scale(.8);
            transition: all .4s ease;
            opacity: .5;
        }
        .slick-slide.lt2 span {
            transform: translate(45%, 0) scale(.8);
        }
        .slick-slide.lt1 span {
            opacity: .7;
            transform: translate(45%, 0) scale(.8);
        }
        .slick-slide.gt1 span {
            opacity: .7;
            transform: translate(-45%, 0) scale(.8);
        }
        .slick-slide.gt2 span {
            transform: translate(-45%, 0) scale(0.8);
        }

        .slick-slide.slick-center span {
            z-index: 1;
            transform: scale(1);
            opacity: 1;
            color: #e67e22;
        }
        /*FIN effect zoom*/

        .slick-slide{
            overflow:hidden;
        }

        .slick-slide span:before {
            content: '';
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .slick-slide span.no-before:before {
            display: none;
        }
        .slick-active img{
            width:640px !important;
            height: 310px !important;
            margin-top:10% !important;
        }
        .slick-active img{
            width:640px !important;
            height: 410px !important;
            margin-top:0 !important;
            z-index:999;
        }
    </style>
@endpush

@section('content')
    <main>
        @if(session()->has('error_message'))
            <div class="alert alert-secondary dark alert-dismissible fade show" role="alert"><strong>Info
                    ! </strong> {{session()->get('error_message')}}.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                ></button>
            </div>
        @endif

        @if(session()->has('success_message'))
            <div class="alert alert-success dark alert-success fade show" role="alert"><strong>Success
                    ! </strong> {{session()->get('success_message')}}.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                ></button>
            </div>
        @endif

    <!-- Shaadi Video Section Start -->
        {{--<div class="video-section slick">--}}
            {{--<img class="full-width" src="{{asset('blogs-images/Pakistan-Rishta-Sites.jpg')}}" alt="Shaadi Ka Laddu Season 2" width="100%">--}}
            {{--<img class="full-width" src="{{asset('blogs-images/Pakistan-Rishta-Sites.jpg')}}" alt="Shaadi Ka Laddu Season 2" width="100%">--}}
            {{--<img class="full-width" src="{{asset('blogs-images/Pakistan-Rishta-Sites.jpg')}}" alt="Shaadi Ka Laddu Season 2" width="100%">--}}
            {{--<img class="full-width" src="{{asset('blogs-images/Pakistan-Rishta-Sites.jpg')}}" alt="Shaadi Ka Laddu Season 2" width="100%">--}}
            {{--<img class="full-width" src="{{asset('blogs-images/Pakistan-Rishta-Sites.jpg')}}" alt="Shaadi Ka Laddu Season 2" width="100%">--}}
        {{--</div>--}}
            <div class="mp-carousel">
                <div class="mp-carousel-img">
                    <span>
                        <img class="full-width" src="{{asset('blogs-images/Pakistan-Rishta-Sites.jpg')}}" alt="Shaadi Ka Laddu Season 2" width="100%">
                    </span>
                </div>
                <div class="mp-carousel-img">
                    <span>
                        <img class="full-width" src="{{asset('blogs-images/Pakistan-Rishta-Sites.jpg')}}" alt="Shaadi Ka Laddu Season 2" width="100%">
                    </span>
                </div>
                <div class="mp-carousel-img">
                    <span>
                        <img class="full-width" src="{{asset('blogs-images/Pakistan-Rishta-Sites.jpg')}}" alt="Shaadi Ka Laddu Season 2" width="100%">
                    </span>
                </div>
                <div class="mp-carousel-img">
                    <span>
                        <img class="full-width" src="{{asset('blogs-images/Pakistan-Rishta-Sites.jpg')}}" alt="Shaadi Ka Laddu Season 2" width="100%">
                    </span>
                </div>
                <div class="mp-carousel-img">
                    <span>
                        <img class="full-width" src="{{asset('blogs-images/Pakistan-Rishta-Sites.jpg')}}" alt="Shaadi Ka Laddu Season 2" width="100%">
                    </span>
                </div>
            </div>
        <!-- Shaadi Video Section End -->

        <!-- About Section Start-->
        <section class="about-section">
            <div class="mt-xl-43"></div>
            <div class="container-xxl">
                <div class="row">
                    <div class="content-column col-md-5 mx-auto my-auto">
                        <div class="inner-column">
                            <div class="sec-title">
                                <span class="title">Doosri Biwi</span>
                                <h2>The Most Trusted Marriage Bureau in Pakistan</h2>
                            </div>
                            <div class="text">Doosri Biwi was established in 2003 and is a licenced, government compliant marriage bureau that operates by a strict code of conduct.</div>
                            <ul class="list-style-one">
                                <li><i class="fa fa-check-circle"></i> Always Speak Truth.</li>
                                <li><i class="fa fa-check-circle"></i> Always Keep Your Promise.</li>
                                <li><i class="fa fa-check-circle"></i> Always Proves to be Honest.</li>
                                <li><i class="fa fa-check-circle"></i> Always Guide with Sincerity / Properly / through the Heart</li>
                                <li><i class="fa fa-check-circle"></i> Always Search Proposal for the Clients as if They are Our Brothers, Sisters, Sons & Daughters.</li>
                            </ul>
                            <div class="btn-box">
                                <a href="{{route('view.register')}}" class="btn btn-outline-primary font-weight-600 p-lr-30 mb-2">Register Now</a>
                            </div>
                        </div>
                    </div>

                    <!-- Image Column -->
                    <div class="image-column col-md-7 order-2">
                        <div class="about-image">
                            <img class="mobileHide" src="{{asset('specialGuests/rishtay-pakistan-mrs-ali-dr-arif-alvi.png')}}" alt="The Most Trusted Marriage Bureau in Pakistan" width="100%">
                            <img class="mobileShow" src="{{asset('specialGuests/rishtay-pakistan-mrs-ali-dr-arif-alvi.jpg')}}" alt="The Most Trusted Marriage Bureau in Pakistan" width="100%">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-xl-43"></div>
        </section>
        <!--About Section End-->

        <!-- Lado Section Start -->
        <div class="p-tb-50 bg-img ladu">
            <div class="container">
                <h2 class="align-center font-weight-600 white-color"> Nikah ka chuwara </h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                {{--<h2 class="align-center text-white font-weight-600" style="font-size: 22px;">Season-4, Coming Soon ...</h2>--}}
                <h2 class="align-center text-white" style="font-size: 18px;">Direct Family to Family Rishta Meeting Event</h2>
                {{--<p class="align-center text-white font-weight-600">Sunday, 1 October, 2023 | 6 pm to 11 pm</p>--}}
                <div class="row">
                    <div class="col-md-7 mx-auto my-auto">
                        <h2 class="title-w">Rishta Milna Hua Aasan</h2>
                        <div class="detail">
                            <p class="text-white">We do not hide behind WhatsApp. We are real matchmakers. We have proper offices, where we sit 7 days a week and 12 hours a day to meet people and help in marriage proposals.</p>
                            <ul class="number-icon">
                                <li>
                                    <a href="https://api.whatsapp.com/send?phone=923481117861&amp;text=Hi%20Doosri Biwi%2C%20I%20need%20more%20information."><i class="fa fa-phone"></i> Contact Us </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5 mx-auto my-auto">
                        <div class="director-img">
                            {{--<iframe width="100%" height="400px" src="https://www.youtube.com/embed/IiUjZEfLJwI" title="Shaadi Ka Laddu - Season 3 Highlights | Family to Family Rishta Meeting Event | Best Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>--}}
                            <img class="full-width" src="{{asset('assets/img/call_action_images/shaadi-orginzation-pakistan-Shadi-ka-ladu-season-4.jpg')}}" alt="Shaadi Ka Laddu">
                        </div>
                    </div>
                </div>

                <div class="align-center p-tb-30">
                    <a href="{{route('view.register')}}" class="btn btn-white"> Register Now </a>
                </div>

            </div>
        </div>
        <!-- Lado Section End -->

        <!-- Rishta Services Section Start -->
        <div class="p-tb-30">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="rishta-services-box align-left rishta-heading-box">
                            <h3 class="text-dark mb-0">Rishta Services</h3>
                            <p class="rishta-expert">Doosri Biwi website is 100% Free Rishta Pakistani website based
                                on self-service basis i.e. Do It Yourself basis or Find Rishta Yourself.</p>
                        </div>
                        <!-- /.card-icon-component -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-2">
                        <div class="rishta-services-box">
                            <div class="rishta-services-icon bg-mikado-main text-white">
                                <img src="{{asset('assets/img/rishta_services/free_rishta_website.svg')}}">
                            </div>
                            <h6 class="text-dark text-center mb-0">Free Rishta <br>Website</h6>
                        </div>
                        <!-- /.card-icon-component -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-2">
                        <div class="rishta-services-box">
                            <div class="rishta-services-icon bg-mikado-main text-white">
                                <img src="{{asset('assets/img/rishta_services/personalized_matchmaking.svg')}}">
                            </div>
                            <h6 class="text-dark text-center mb-0">Personalized <br> Matchmaking</h6>
                        </div>
                        <!-- /.card-icon-component -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-2">
                        <div class="rishta-services-box">
                            <div class="rishta-services-icon bg-mikado-main text-white">
                                <img src="{{asset('assets/img/rishta_services/live_matchmaking.svg')}}">
                            </div>
                            <h6 class="text-dark text-center mb-0">Live <br> Matchmaking</h6>
                        </div>
                        <!-- /.card-icon-component -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-2">
                        <div class="rishta-services-box">
                            <div class="rishta-services-icon bg-mikado-main text-white">
                                <img src="{{asset('assets/img/rishta_services/elite_matrimonial.svg')}}">
                            </div>
                            <h6 class="text-dark text-center mb-0"> Elite <br>Matrimonial </h6>
                        </div>
                        <!-- /.card-icon-component -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="align-center p-tb-30">
                    <a href="{{route('free.rishta.services')}}" class="btn btn-outline-primary font-weight-600 p-lr-30"> View More</a>
                </div>
            </div>
        </div>
        <!-- Rishta Services Section End -->

        <!-- Match Making Section Start -->
        <div class="matchmaking-event bg-img p-tb-30">
            <div class="container">
                <h2 class="align-center font-weight-600 white-color"> Events Highlights </h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                <p class="align-center text-theme font-weight-500"> By the grace of Al Mighty Allah, Doosri Biwi successfully
                    hosted 5th grand matchmaking event attended by 200+ families and 500+ candidates. Please visit the
                    link below to see event pictures. </p>
                <div class="row gallery">
                    <div class="col-md-2">
                        <img src="{{asset('home_page/shaadi-organization-pakistan-grand-event(1).jpg')}}"
                             alt="Event Image 1"/>
                    </div>
                    <div class="col-md-2">
                        <img src="{{asset('home_page/shaadi-organization-pakistan-grand-event(2).jpg')}}"
                             alt="Event Image 2"/>
                    </div>
                    <div class="col-md-2">
                        <img src="{{asset('home_page/shaadi-organization-pakistan-grand-event(3).jpg')}}"
                             alt="Event Image 3"/>
                    </div>
                    <div class="col-md-2">
                        <img src="{{asset('home_page/shaadi-organization-pakistan-grand-event(4).jpg')}}"
                             alt="Event Image 4"/>
                    </div>
                    <div class="col-md-2">
                        <img src="{{asset('home_page/shaadi-organization-pakistan-grand-event(5).jpg')}}"
                             alt="Event Image 5"/>
                    </div>
                    <div class="col-md-2">
                        <img src="{{asset('home_page/shaadi-organization-pakistan-grand-event(6).jpg')}}"
                             alt="Event Image 6"/>
                    </div>
                </div>
                <div class="align-center p-tb-30">
                    <a href="{{route('our.events')}}" class="btn btn-white"> View More</a>
                </div>
            </div>
        </div>
        <!-- Match Making Section End -->

        <!-- Hire Personal Matchmaking Consultant Section Start -->
        <div class="p-tb-50 consultant">
            <div class="container">

                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h2 class="align-center font-weight-600">Hire Personal Matchmaking Consultant</h2>
                        <img class="img-align-center heading-border"
                             src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                        <p class="paragraph-1 align-center font-weight-500 text-theme">We do not hide behind WhatsApp. We are real matchmakers. We have proper offices, where we sit 7 days a week and 12 hours a day to meet people and help in marriage proposals.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 mx-auto my-auto">
                        <div class="text-secondary bg-light ceoMainDetail">
                            <img class="ceo-img" src="{{asset('web_images/mrs-ali.jpg')}}" alt="Mrs. Ali">
                            <h2 class="name-team"> Mrs. Ali </h2>
                            <h3>Director, Doosri Biwi</h3>
                            <p>Sr. Consultant & Matchmaker for Elite & Upper Class</p>
                            <div class="ceo-mrs-ali">
                                <a target="_blank" href="{{route('shaadi.matchmakers',['mrs-ali'])}}" class="contact-number-ceo">Contact Her</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Hire Personal Matchmaking Consultant Section End -->

        <!-- Celebrity Testimonials Section Start -->
        <div class="p-tb-50 bg-img">
            <div class="container">
                <h2 class="align-center text-white font-weight-600">Celebrity Testimonials</h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                <div class="row p-tb-10">
                    <div class="col-md-4">
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/_jme1dLM6vw"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen=""></iframe>
                    </div>
                    <div class="col-md-4">
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/IFRk_Pek0so"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen=""></iframe>
                    </div>
                    <div class="col-md-4">
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/Jh2ur0RI8OU"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- Celebrity Testimonials Section End -->

        <!-- Females Ready for 2nd Marriage Section Start -->
        <div class="p-tb-30">
            <div class="container">
                <h2 class="align-center font-weight-600">Females Ready for 2nd Marriage</h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                <div class="row p-tb-10 justify-content-center data--females_ready">
                    @include('front.shimmer')
                </div>
                <div class="align-center p-tb-30">
                    <a href="{{route('search.by.slug',['females-Ready-for-second-marriage'])}}" class="btn btn-outline-primary font-weight-600 p-lr-30"> View More</a>
                </div>
            </div>
        </div>
        <!-- Females Ready for 2nd Marriage Section End -->

        <!-- Call To Action Start -->
        <div class="p-tb-50 bg-img call-to-action">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 my-auto">
                        <p class="font-30 primary-color blink-soft white-color">
                            We work very closely with our clients. We profiles each member, helping them understand
                            themselves and who is compatible to them, which is the foundation to forming a long-lasting
                            partnership.
                        </p>
                        <div class="p-tb-30">
                            <a href="{{route('view.register')}}" class="btn btn-white"> Register Now </a>
                        </div>
                    </div>
                    <div class="col-md-4 my-auto">
                        <div class="profile-each">
                            <img src="{{asset('assets/img/call_action_images/shaadi-organization-pakistan-We-work-very-closely-with-our-clients.-min.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call To Action End -->

        <!-- Males Looking for 2nd Wife Section Start -->
        <div class="p-tb-30">
            <div class="container">
                <h2 class="align-center font-weight-600">Males Looking for 2nd Wife</h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                <div class="row p-tb-10 justify-content-center data--males_looking">
                    @include('front.shimmer')
                </div>
                <div class="align-center p-tb-30">
                    <a href="{{route('search.by.slug',['males-Looking-for-second-Wife'])}}" class="btn btn-outline-primary font-weight-600 p-lr-30"> View More</a>
                </div>
            </div>
        </div>
        <!-- Males Looking for 2nd Wife Section End -->

        <!-- Government Registered Marriage Bureau Section Start -->
        <div class="p-tb-50 bg-img">
            <div class="container">
                <h2 class="align-center font-weight-600 white-color">Government Registered Marriage Bureau</h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                <p class="white-color align-center">
                    Shaadi Organization® Pakistan is a licensed, registered and recognized marriage bureau from Government of Pakistan. Our name, logo, events' name, taglines are all registered under the Trademark and Copyright Acts of Government of Pakistan. We are also registered and associated with a number of local, provincial and federal departments of Government of Pakistan, media personalities and media channels. You can see certificates, photos and videos on our website and social media pages.
                </p>
                <div class="row">
                    @foreach($govermentRegisteredMarraigeBureau as $val)
                        <div class="col-md-2 mx-auto my-auto text-center">
                            <div class="ourGuest">
                                <img src="{{asset('govermentRegisteredMarraigeBureau/'.$val->main_image)}}" alt="{{$val->title}}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Government Registered Marriage Bureau Section End -->

        <!-- 9-Points Verification System Section Start -->
        <div class="p-tb-50 points">
            <div class="container">
                <h2 class="align-center font-weight-600"> Verification System </h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="heading-4 text-theme font-weight-600">9-Points Verification System</h4>
                        <p class="paragraph-1">Doosri Biwi uses unique 9-Points Trust and Safety
                            features, for the security of our members, called “Verification Badges” that display on
                            member profiles after they pass the verification of Mobile, Email, Location, Photo, Age,
                            Education, Salary, Meeting, ID and Nationality. Fully verified members also get “The Famous
                            Blue Tick” on their profiles.</p>
                        <a href="{{route('authentic.profile')}}" class="btn btn-outline-primary font-weight-600 p-lr-30"> View More</a>
                    </div>
                    <div class="col-md-6">
                        <img class="points-img" src="{{asset('assets/img/verification_system/rishtay-pakistan-badges-image.png')}}">
                    </div>
                </div>
            </div>
        </div>
        <!-- 9-Points Verification System Section End -->

    </main>
@endsection

@push('script')
    <script>
        $(function() {
            axios.get('{{route('get.all.proposals')}}').then(function (res) {
                $('.data--females_ready').html(res.data.females_ready);
                $('.data--males_looking').html(res.data.males_looking);

                $(".LoginToView").on('click', function(e) {
                    if (!authCheckGlobally) {
                        checkAuthLoginMessage();
                        return false;
                    }
                });

            }).catch(function (error) {
                // console.log('Something went wrong*')
            });
        });

        $('.mp-carousel')
            .on('init', () => {
                $('.slick-slide[data-slick-index="-2"]').addClass('lt2');
                $('.slick-slide[data-slick-index="-1"]').addClass('lt1');
                $('.slick-slide[data-slick-index="1"]').addClass('gt1');
                $('.slick-slide[data-slick-index="2"]').addClass('gt2');
            })
            .slick({
                centerMode: true,
                centerPadding: 0,
                slidesToShow: 3,
                dots:true,
                focusOnSelect:true,
            }).on('beforeChange', (event, slick, current, next) => {
            $('.slick-slide.gt2').removeClass('gt2');
            $('.slick-slide.gt1').removeClass('gt1');
            $('.slick-slide.lt1').removeClass('lt1');
            $('.slick-slide.lt2').removeClass('lt2');

            const lt2 = (current < next && current > 0) ? current - 1 : next - 2;
            const lt1 = (current < next && current > 0) ? current : next - 1;
            const gt1 = (current < next || next === 0) ? next + 1 : current;
            const gt2 = (current < next || next === 0) ? next + 2 : current + 1;

            $(`.slick-slide[data-slick-index="${lt2}"]`).addClass('lt2');
            $(`.slick-slide[data-slick-index="${lt1}"]`).addClass('lt1');
            $(`.slick-slide[data-slick-index="${gt1}"]`).addClass('gt1');
            $(`.slick-slide[data-slick-index="${gt2}"]`).addClass('gt2');

            // Clone processing when moving from 5 to 0
            if (current === 5 && next === 0) {
                $(`.slick-slide[data-slick-index="${current - 1}"]`).addClass('lt2');
                $(`.slick-slide[data-slick-index="${current}"]`).addClass('lt1');
                $(`.slick-slide[data-slick-index="${current + 2}"]`).addClass('gt1');
                $(`.slick-slide[data-slick-index="${current + 3}"]`).addClass('gt2');
            }

            // Clone processing when moving from 0 to 5
            if (current === 0 && next === 5) {
                $(`.slick-slide[data-slick-index="${current - 1}"]`).addClass('gt2');
                $(`.slick-slide[data-slick-index="${current}"]`).addClass('gt1');
                $(`.slick-slide[data-slick-index="${current - 2}"]`).addClass('lt1');
                $(`.slick-slide[data-slick-index="${current - 3}"]`).addClass('lt2');
            }

            console.log('beforeChange', current, ':', lt2, lt1, next, gt1, gt2);
        });

        // $('.bannerSlider').slick({
        //     centerMode: true,
        //     centerPadding: '250px',
        //     slidesToShow: 1,
        //     autoplay: false,
        //     autoplaySpeed: 2000,
        //     responsive: [
        //         {
        //             breakpoint: 768,
        //             settings: {
        //                 arrows: false,
        //                 centerMode: true,
        //                 centerPadding: '140px',
        //                 slidesToShow: 1
        //             }
        //         },
        //         {
        //             breakpoint: 480,
        //             settings: {
        //                 arrows: false,
        //                 centerMode: true,
        //                 centerPadding: '140px',
        //                 slidesToShow: 1
        //             }
        //         }
        //     ]
        // });
    </script>
@endpush