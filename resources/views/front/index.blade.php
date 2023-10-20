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
            background: #040F2E;
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
            padding: 10px;
            position: relative;
            border-radius: 10px;
            box-shadow: 5px 5px 5px #0000003d;
        }
        .image-boxes{
            text-align: center;
            width: 150px;
            height: 150px;
            margin: 0 auto;
            box-shadow: 5px 5px 5px #0000003d;
            background-image: linear-gradient(#F9F295,#E0AA3E,#E0AA3E,#B88A44);
            border-radius: 50%;
            margin-top: 10px;
        }
        .image-boxes img{
            width: 150px;
            height: 150px;
            border-radius: 50%;
            padding: 3px;
        }
        .image-boxes-icon {
            padding: 10px 0px 5px 0px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin: 0 auto;
            border: 1px solid #F9F295;
        }
        .image-boxes-icon i{
            color:#F9F295;
            font-weight: bold;
            font-size:18px;
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
        .profile-details-boxes {
            width: 100%;
            text-align: center;
            color: white;
        }
        .profile-details-boxes h3{
            font-size: 1rem;
            font-weight: 600;
            /*padding-right: 30px;*/
            color: #ffffff !important;
            text-align: center;
            margin-top: 10px;
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
            font-size: 1rem;
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
            color: black;
            font-size: 12px;
            font-weight: 600;
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
            /*color: #ffffff;*/
            /*font-weight: bold;*/
            /*text-align: center;*/
            font-size: 2.5rem;

            /*font-size: 25px;*/
            color: #D5AD6D;
            background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%);
            background: -o-linear-gradient(transparent, transparent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            text-align: center;
            margin-top: 15px;
        }
        .pss-10 img{
            padding:10px;
            border-radius: 50%;
        }
        .ceo-mrs-ali{
            /*width: 100%;*/
            text-align: center;
            /*background: #040F2E;*/
            /*padding-bottom: 10px;*/
            padding: 20px 0px;
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
            width: 60%;
            border-radius: 50px;
            border: none;
            text-align: center !important;
            margin: 0 auto;
            padding: 15px;
            border-left: 2px solid goldenrod;
            border-right: 2px solid goldenrod;
        }
        .parent-section {
            border: 5px solid #E0AA3E !important;
            width: 50%;
            height: 100%;
        }
        .ceo-img {
            border-radius: 100%;
            filter: drop-shadow(0px 0px 5px #ECC440);
            -webkit-filter: drop-shadow(0px 0px 5px #ECC440);
            width: 60%;
            box-shadow: 6px 6px 18px 0px rgba(0,0,0,0.4);
            background-image: linear-gradient(#F9F295,#E0AA3E,#E0AA3E,#B88A44);
            padding: 5px 0px 5px 5px;
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
            color: #ffffff;
            margin-top: 10px;
        }
        .ceoMainDetail p {
            font-size: 18px;
            text-align: center;
            margin: 10px 0px;
            /*padding:10px;*/
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
        .banner-image {
            background-image: url('{{asset('assets/img/banner.jpg')}}');
            height: 100%;
            background-size: cover;
        }
        .banner-text {
            height: fit-content;
            width: 50%;
            border-radius: 50px;
            border: none;
            text-align: center !important;
            padding: 20px;
            margin: 20px;
            border-left: 4px solid goldenrod;
            border-right: 4px solid goldenrod;
        }
        .banner-title, .banner-text p {
            font-style: italic;
            font-size: 2rem;
            color: #D5AD6D;
            background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(213,173,109,1) 26%, rgba(255,255,255,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(255,255,255,1) 100%);
            background: -o-linear-gradient(transparent, transparent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 600;
            text-align: center;
            margin: 10px 0px 15px 0px;
            font-family: auto;
        }
        .banner-title{
            font-size: 2.2rem;
        }
        .bannerHeight {
            height: 100vh;
        }
        .slick-dots {
            position: absolute;
            bottom: -45px;
            list-style: none;
            display: block;
            text-align: center;
            padding: 0;
            width: 100%;
        }
        .slick-dots li {
            position: relative;
            display: inline-block;
            height: 20px;
            width: 20px;
            margin: 0 5px;
            padding: 0;
            cursor: pointer;
        }
        .slick-dots li button {
            border: 1px solid goldenrod;
            height: 10px;
            width: 10px;
            border-radius: 25px;
            color: transparent !important;
            padding: 5px;
            cursor: pointer;
        }
        .slick-dots li.slick-active button {
            background: goldenrod !important;
        }
        .newInfoStyle {
            border-style: solid;
            border-width: 0px 7px 0px 7px;
            border-radius: 40px;
            border-color: #E0AA3E;
            transition: background .3s,border .3s,border-radius .3s,box-shadow .3s;
            padding: 30px;
            font-size: 1.3rem;
        }
        .fs-card-text {
            padding-left: 0;
            text-align:start;
            color: #ffffff;
            font-weight: 500;
            font-size: .7rem;
        }
        @media only screen and (max-width: 600px) {
            .profile-boxes {
                width: 80%;
                margin: 0 auto;
            }
            .image-boxes {
                height: 130px;
                width: 130px;
                margin: 0 auto;
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
            .contact-number-ceo {
                font-size: 12px !important;
                padding: 8px 30px;
            }
            .ceo-img {
                width: 250px;
                /*top: -150px;*/
            }
            .ceoMainDetail {
                width: 100%;
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
            .list-style-one {
                margin-bottom: 0px !important;
            }
            .banner-image {
                background-image: url('{{asset('assets/img/banner-mobile.jpg')}}');
                height: fit-content;
            }
            .banner-text {
                /*width: 100%;*/
                /*margin: 0px;*/
                width: 92%;
                margin: 0 auto;
                margin-top: 10px;
                margin-bottom: 10px;
            }
            .banner-title, .banner-text p {
                font-size: 1.4rem;
                color: #D5AD6D;
                background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(255,255,255,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%);
                background: -o-linear-gradient(transparent, transparent);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .bannerHeight {
                height: 100%;
            }
        }
        .card-container {
            perspective: 1400px;
        }
        .card-flip {
            position: relative;
            width: 100%;
            transform-style: preserve-3d;
            height: auto;
            transition: all 1s ease-out;
            color: #ffffff;
            background: #ffffff;
            border: none;
        }

        .card-flip div {
            backface-visibility: hidden;
            transform-style: preserve-3d;
            width: 100%;
            border-radius: 50px;
        }

        .card-flip .front {
            position: relative;
            z-index: 1;
            padding: 20px;
            border-left: 10px solid #040F2E;
            border-right: 10px solid #040F2E;
            display: flex;
            align-items: center;
            height: 250px !important;
        }
        .card-flip .front h4 {
            font-size: 2rem;
        }

        .card-flip .back {
            position: relative;
            z-index: 0;
            transform: rotateY(-180deg);
            padding: 20px;
            border-top: 10px solid #040F2E;
            border-bottom: 10px solid #040F2E;
            display: flex;
            align-items: center;
            height: 250px !important;
        }

        .card-container:hover .card-flip {
            transform: rotateY(180deg);
        }
    </style>
@endpush

@section('content')
    <main>
        @if(session()->has('error_message'))
            <div class="alert alert-secondary dark alert-dismissible fade show" role="alert"><strong>Info! </strong> {{session()->get('error_message')}}.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                ></button>
            </div>
        @endif

        @if(session()->has('success_message'))
            <div class="alert alert-success text-dark fade show" role="alert"><strong>Success! </strong>
                {{session()->get('success_message')}}.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                ></button>
            </div>
        @endif

        <!-- Background image -->
        <div class="banner-image">
            <div class="d-flex align-items-center bannerHeight">
                <div class="banner-text">
                    <h2 class="banner-title">Find Someone Better!</h2>
                    <img class="img-align-center heading-border" src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                    <div class="bannerSlider">
                        <div>
                            <p>Connect Hearts, Finding Matches at Doosri Biwi - Your Path to Happily Ever After</p>
                            <br>
                            <p>دلوں کو جوڑیں، دوسری بیوی پر میچز تلاش کریں - آپ کی خوشی کا راستہ</p>
                        </div>
                        <div>
                            <p>Find Your Perfect Match at Doosri Biwi: Where Hearts Find compatibility</p>
                            <br>
                            <p>دوسری بیوی پر اپنا پرفیکٹ میچ تلاش کریں: جہاں دلوں کو مطابقت ملتی ہے</p>
                        </div>
                        <div>
                            <p>Find Your Forever Love on Doosri Biwi</p>
                            <br>
                            <p>دوسری بیوی پر اپنی ہمیشہ کی محبت تلاش کریں۔</p>
                        </div>
                        <div>
                            <p>Find Your Perfect Match at Doosri Biwi</p>
                            <br>
                            <p>دوسری بیوی پر اپنا پرفیکٹ میچ تلاش کریں۔</p>
                        </div>
                        <div>
                            <p>Find Your Forever Partner at Doosri Biwi: Where Love Begins</p>
                            <br>
                            <p>دوسری بیوی میں اپنے ہمیشہ کے لیے ساتھی تلاش کریں: جہاں سے محبت شروع ہوتی ہے</p>
                        </div>
                    </div>
                    <br>
                    {{--<img class="img-align-center heading-border" src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}" style="transform: rotate(180deg);">--}}
                </div>
            </div>
        </div>
        <!-- Background image -->

        <!-- About Section Start-->
        <section class="">
            <div class="mt-xl-43"></div>
            <div class="container">
                <div class="row">
                    <div class="content-column col-md-7 mx-auto my-auto">
                        <div class="inner-column" data-aos="fade-right" data-aos-duration="1200">
                            <div class="sec-title">
                                <h2>Welcome to DoosriBiwi.com which understands & supports your choices.</h2>
                            </div>
                            <div class="text">Doosri Biwi is a licensed, government-compliant marriage bureau that operates by a strict code of conduct within the framework of Islamic values.</div>
                            <br>
                            <ul class="list-style-one">
                                <li><i class="fa fa-check-circle"></i> Always Speak Truth.</li>
                                <li><i class="fa fa-check-circle"></i> Always Keep Your Promise.</li>
                                <li><i class="fa fa-check-circle"></i> Always Proves to be Honest.</li>
                                <li><i class="fa fa-check-circle"></i> Always Guide with Sincerity / Properly / through the Heart</li>
                                <li><i class="fa fa-check-circle"></i> Always Search Proposal for the Clients as if They are Our Brothers, Sisters, Sons & Daughters.</li>
                            </ul>
                            <div class="p-tb-30">
                                <a href="{{route('view.register')}}" class="button-theme-dark"> Let’s begin </a>
                            </div>
                        </div>
                    </div>

                    <!-- Image Column -->
                    <div class="image-column col-md-5 mx-auto my-auto">
                        <div class="about-image" data-aos="fade-left" data-aos-duration="1200">
                            <img src="{{asset('specialGuests/rishtay-pakistan-mrs-ali-dr-arif-alvi.jpg')}}" alt="The Most Trusted Marriage Bureau in Pakistan" width="100%">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-xl-43"></div>
        </section>
        <!--About Section End-->

        <!-- Benefits of Becoming a Second Wife Section Start -->
        <div class="p-tb-50 bg-img ladu">
            <div class="container">
                <h2 class="align-center font-weight-600 white-color"> Benefits of Becoming a Second Wife? </h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                <div class="row newInfoStyle" data-aos="flip-down" data-aos-duration="1200">
                    <div class="col-md-6 mx-auto my-auto">
                        <p class="text-white">
                            Choosing to be a second wife in Islam may provide a loving and stable family environment, while also offering companionship and the opportunity to strengthen faith through shared responsibilities and devotion.
                        </p>
                    </div>
                    <div class="col-md-6 mx-auto my-auto">
                        <p class="text-white text-end">
                            اسلام میں دوسری بیوی بننے کا انتخاب ایک محبت بھرا اور مستحکم خاندانی ماحول فراہم کر سکتا ہے، جبکہ صحبت اور مشترکہ ذمہ داریوں اور عقیدت کے ذریعے ایمان کو مضبوط کرنے کا موقع بھی فراہم کرتا ہے۔
                        </p>
                    </div>
                </div>

                <div class="align-center p-tb-30">
                    <a href="{{route('view.register')}}" class="button-theme-light"> Let’s begin </a>
                </div>

            </div>
        </div>
        <!-- Benefits of Becoming a Second Wife Section End -->

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
                    <a href="{{route('search.by.slug',['males-Looking-for-second-Wife'])}}" class="button-theme-dark"> Explore further </a>
                </div>
            </div>
        </div>
        <!-- Males Looking for 2nd Wife Section End -->

        <!-- Why Consider a Second Wife Section Start -->
        <div class="p-tb-50 bg-img ladu">
            <div class="container">
                <h2 class="align-center font-weight-600 white-color"> Why Consider a Second Wife? </h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                <div class="row newInfoStyle" data-aos="flip-down" data-aos-duration="1200">
                    <div class="col-md-6 mx-auto my-auto">
                        <p class="text-white">
                            In Islam, a second marriage can be a solution to fulfill responsibilities, provide support, and offer love to another deserving woman.
                        </p>
                    </div>
                    <div class="col-md-6 mx-auto my-auto">
                        <p class="text-white text-end">
                            اسلام میں، دوسری شادی ذمہ داریوں کو پورا کرنے، مدد فراہم کرنے اور دوسری مستحق عورت کو محبت کی پیشکش کرنے کا حل ہو سکتی ہے۔
                        </p>
                    </div>
                </div>

                <div class="align-center p-tb-30">
                    <a href="{{route('view.register')}}" class="button-theme-light"> Let’s begin </a>
                </div>

            </div>
        </div>
        <!-- Why Consider a Second Wife Section End -->

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
                    <a href="{{route('search.by.slug',['females-Ready-for-second-marriage'])}}" class="button-theme-dark"> View More</a>
                </div>
            </div>
        </div>
        <!-- Females Ready for 2nd Marriage Section End -->

        <!-- Legal Protection Section Start -->
        <div class="p-tb-50 bg-img ladu">
            <div class="container">
                <h2 class="align-center font-weight-600 white-color"> Legal Protection </h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                <div class="row newInfoStyle" data-aos="flip-down" data-aos-duration="1200">
                    <div class="col-md-6 mx-auto my-auto">
                        <p class="text-white">
                            Family Legal matters are emotional and complicated. We understand that every family is unique and we provide sympathetic guidance and effective solutions tailored to your needs.
                        </p>
                    </div>
                    <div class="col-md-6 mx-auto my-auto">
                        <p class="text-white text-end">
                            خاندانی قانونی معاملات جذباتی اور پیچیدہ ہوتے ہیں۔ ہم سمجھتے ہیں کہ ہر خاندان منفرد ہے اور ہم آپ کی ضروریات کے مطابق ہمدردانہ رہنمائی اور موثر حل فراہم کرتے ہیں۔
                        </p>
                    </div>
                </div>

                <div class="align-center p-tb-30">
                    <a href="{{route('view.register')}}" class="button-theme-light"> Let’s begin </a>
                </div>

            </div>
        </div>
        <!-- Legal Protection Section End -->

        <!-- Doosri Biwi Services Section Start -->
        <div class="p-tb-30">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto text-center">
                        <div class="rishta-services-box align-center">
                            <div class="rishta-services-inner-box">
                                <h3 class="text-dark mb-0 font-weight-600 mb-2">Doosri Biwi Services</h3>
                                <p class="rishta-expert">Embracing Polygamy the Islamic Way for a Fulfilling Lifes.</p>
                                <div class="row">
                                    <div class="col-6 col-md-2">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
                                            <img src="{{asset('assets/img/rishta_services/family-mediation.png')}}" width="100%">
                                        </div>
                                        <h6 class="text-dark text-center mb-0">Family Mediation</h6>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
                                            <img src="{{asset('assets/img/rishta_services/islamic-counseling-and-guidance.png')}}" width="100%">
                                        </div>
                                        <h6 class="text-dark text-center mb-0">Islamic Counseling <br> & Guidance</h6>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
                                            <img src="{{asset('assets/img/rishta_services/legal-assistance.png')}}" width="100%">
                                        </div>
                                        <h6 class="text-dark text-center mb-0">Legal Assistance</h6>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
                                            <img src="{{asset('assets/img/rishta_services/marriage-enrichment-programs.png')}}" width="100%">
                                        </div>
                                        <h6 class="text-dark text-center mb-0">Marriage Enrichment <br> Programs</h6>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
                                            <img src="{{asset('assets/img/rishta_services/matchmaking-services.png')}}" width="100%">
                                        </div>
                                        <h6 class="text-dark text-center mb-0">Matchmaking Services</h6>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
                                            <img src="{{asset('assets/img/rishta_services/supportive-community.png')}}" width="100%">
                                        </div>
                                        <h6 class="text-dark text-center mb-0">Supportive Community</h6>
                                    </div>
                                </div>
                                <br>
                                <div class="align-center p-tb-30">
                                    <a href="{{route('free.rishta.services')}}" class="button-theme-dark"> View More</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Doosri Biwi Services Section End -->

        <!-- Nikkah ka chuwara Section Start -->
        <div class="p-tb-50 bg-img ladu">
            <div class="container">
                <h2 class="align-center font-weight-600 white-color"> Nikah Ka Chuwara </h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                {{--<h2 class="align-center text-white font-weight-600" style="font-size: 22px;">Season-4, Coming Soon ...</h2>--}}
                <h2 class="align-center text-white" style="font-size: 18px;">Direct Family to Family Rishta Meeting Event</h2>
                {{--<p class="align-center text-white font-weight-600">Sunday, 1 October, 2023 | 6 pm to 11 pm</p>--}}
                <div class="row">
                    <div class="col-md-6 mx-auto my-auto" data-aos="fade-right" data-aos-duration="1200">
                        <h2 class="title-w">Find Someone Better!</h2>
                        <div class="detail">
                            <p class="text-white">By the grace of Al Mighty Allah, Doosri Biwi successfully hosted an event "Nikah Ka Chuwara" where individuals can explore and embrace polygamous relationships within the framework of Islamic principles.</p>
                            <br>
                            <ul class="number-icon">
                                <li>
                                    <a href="https://api.whatsapp.com/send?phone=923452444262&amp;text=Hi%20Doosri Biwi%2C%20I%20need%20more%20information."><i class="fa fa-phone"></i> Contact Us </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 mx-auto my-auto" data-aos="fade-left" data-aos-duration="1200">
                        <div class="director-img">
                            {{--<iframe width="100%" height="400px" src="https://www.youtube.com/embed/IiUjZEfLJwI" title="Shaadi Ka Laddu - Season 3 Highlights | Family to Family Rishta Meeting Event | Best Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>--}}
                            <img class="full-width" src="{{asset('assets/img/call_action_images/shaadi-orginzation-pakistan-Shadi-ka-ladu-season-4.jpg')}}" alt="Shaadi Ka Laddu">
                        </div>
                    </div>
                </div>

                <div class="align-center p-tb-30">
                    <a href="{{route('view.register')}}" class="button-theme-light"> Let’s begin </a>
                </div>

            </div>
        </div>
        <!-- Nikkah ka chuwara Section End -->

        <!-- Celebrity Testimonials Section Start -->
        <div class="p-tb-50">
            <div class="container">
                <h2 class="align-center font-weight-600">Celebrity Testimonials</h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                <div class="row p-tb-10">
                    <div class="col-md-4" data-aos="zoom-in-right" data-aos-duration="1200">
                        <iframe width="100%" src="https://www.youtube.com/embed/_jme1dLM6vw"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen=""></iframe>
                    </div>
                    <div class="col-md-4" data-aos="zoom-in" data-aos-duration="1200">
                        <iframe width="100%" src="https://www.youtube.com/embed/IFRk_Pek0so"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen=""></iframe>
                    </div>
                    <div class="col-md-4" data-aos="zoom-in-left" data-aos-duration="1200">
                        <iframe width="100%" src="https://www.youtube.com/embed/Jh2ur0RI8OU"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- Celebrity Testimonials Section End -->

        <!-- Hire Personal Matchmaking Consultant Section Start -->
        <div class="p-tb-50 bg-img consultant">
            <div class="container">

                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h2 class="align-center text-white font-weight-600">Hire Personal Matchmaking Consultant</h2>
                        <img class="img-align-center heading-border"
                             src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                        <p class="paragraph-1 align-center font-weight-500 text-white">We do not hide behind WhatsApp. We have real matchmakers & proper offices, where we sit 7 days a week and 12 hours a day to meet people and help with marriage proposals.</p>
                        <br>
                        <div class="ceoMainDetail" data-aos="zoom-in" data-aos-duration="1200">
                            <img class="ceo-img" src="{{asset('web_images/mrs-ali.jpg')}}" alt="Mrs. Ali">
                            <h2 class="name-team"> Mrs. Ali </h2>
                            <h3>Director, Doosri Biwi</h3>
                            <p class=" text-white">Sr. Consultant & Matchmaker for Elite & Upper Class</p>
                            <div class="ceo-mrs-ali">
                                <a target="_blank" href="{{route('shaadi.matchmakers',['mrs-ali'])}}" class="button-theme-light">Contact Her</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Hire Personal Matchmaking Consultant Section End -->

        <!-- Match Making Section Start -->
        <div class="matchmaking-event p-tb-30">
            <div class="container">
                <h2 class="align-center font-weight-600"> Events Highlights </h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                <p class="align-center text-theme font-weight-500">
                    By the grace of Al Mighty Allah, Doosri Biwi successfully hosted an event where individuals can explore and embrace polygamous relationships within the framework of Islamic principles.
                </p>
                <div class="row gallery-light">
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('ourEvents/rishtay-pakistani-shaadi-ka-laddu-02.jpg')}}"
                             alt="Event Image 1"/>
                    </div>
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('ourEvents/rishtay-pakistani-shaadi-ka-laddu-3-1.jpg')}}"
                             alt="Event Image 2"/>
                    </div>
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('ourEvents/rishtay-pakistani-shaadi-ka-laddu-05.jpg')}}"
                             alt="Event Image 3"/>
                    </div>
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('ourEvents/rishtay-pakistani-shaadi-ka-laddu-08.jpg')}}"
                             alt="Event Image 4"/>
                    </div>
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('ourEvents/Shaadi-Laddu-06.png')}}"
                             alt="Event Image 5"/>
                    </div>
                </div>
                <div class="align-center p-tb-30">
                    {{--<a href="{{route('our.events')}}" class="button-theme-dark"> View More</a>--}}
                    <a href="{{route('view.register')}}" class="button-theme-dark"> Let’s begin </a>
                </div>
            </div>
        </div>
        <!-- Match Making Section End -->

        <!-- Government Registered Marriage Bureau Section Start -->
        <div class="p-tb-50 bg-img">
            <div class="container">
                <h2 class="align-center font-weight-600 white-color">Government Registered Marriage Bureau</h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                <p class="white-color align-center">
                    <strong class="white-color">DoosriBiwi.com</strong> is a devision of <strong class="white-color">Shaadi Organization Pakistan</strong>. A well-known, registered and recognized marriage bureau since 2003 from the Government of Pakistan having valid license, trademark and copyright certificates from the Government of Pakistan.
                </p>
                <div class="row gallery">
                    @foreach($govermentRegisteredMarraigeBureau as $key => $val)
                        <div class="col-6 col-lg mx-auto my-auto">
                            <img src="{{asset('govermentRegisteredMarraigeBureau/'.$val->main_image)}}" alt="Document {{$key+1}}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Government Registered Marriage Bureau Section End -->

        <!-- Our partners Sites  Section Start -->
        <div class="p-tb-50 points">
            <div class="container">
                <h2 class="align-center font-weight-600"> Our Partners Sites </h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">

                <div class="row text-center">
                    <div class="col-md-1 mx-auto my-auto"></div>
                    <div class="col-md-5 mx-auto my-auto card-container" data-aos="flip-left" data-aos-duration="1200">
                        <div class="card card-flip container d-flex h-100">
                            <div class="front card-block row justify-content-center align-self-center">
                                <img src="{{asset('assets/img/partners/Shaadi-Organization-Pakistan-Rishta-Logo.svg')}}" alt="DoosriBiwi.com" style="width: 70%;">
                                <h4>Shaadi.org.pk</h4>
                            </div>
                            <div class="back card-block row justify-content-center align-self-center">
                                <p>Shaadi Organization Pakistan is designed to bring you a number of choices in selecting a life partner.</p>
                                <div class="align-center">
                                    <a target="_blank" href="http://www.shaadi.org.pk" class="button-theme-dark"> View More </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 mx-auto my-auto card-container" data-aos="flip-right" data-aos-duration="1200">
                        <div class="card card-flip container d-flex h-100">
                            <div class="front card-block row justify-content-center align-self-center">
                                <img src="{{asset('assets/img/partners/elite-matrimony-logo.svg')}}" alt="EliteMatrimony.Pk" style="width: 70%;">
                                <h4>EliteMatrimony.Pk</h4>
                            </div>
                            <div class="back card-block row justify-content-center align-self-center">
                                <p>Elite Matrimony Pakistan provides the most exclusive, personalized, and private matchmaking services to the upper class of Pakistan either living in the country or abroad.</p>
                                <div class="align-center">
                                    <a target="_blank" href="https://elitematrimony.pk" class="button-theme-dark"> View More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 mx-auto my-auto"></div>

                    {{--<div class="col-md-4 card-container">--}}
                        {{--<div class="card card-flip container d-flex h-100">--}}
                            {{--<div class="front card-block row justify-content-center align-self-center">--}}
                                {{--<img src="{{asset('assets/img/partners/Doosri-shaadi-Logo.png')}}" alt="DoosriShaadi.Pk" style="width: 70%;">--}}
                                {{--<h4>DoosriShaadi.Pk</h4>--}}
                            {{--</div>--}}
                            {{--<div class="back card-block row justify-content-center align-self-center">--}}
                                {{--<p>DoosriShaadi.Pk offers a platform where you can search for your soulmate discretely and privately by yourself.</p>--}}
                                {{--<div class="align-center">--}}
                                    {{--<a href="https://doosrishaadi.pk/" class="button-theme-dark"> View More</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>

            </div>
        </div>
        <!-- Our partners Sites  Section End -->

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

            var front = document.getElementsByClassName("front");
            var back = document.getElementsByClassName("back");

            var highest = 0;
            var absoluteSide = "";

            for (var i = 0; i < front.length; i++) {
                if (front[i].offsetHeight > back[i].offsetHeight) {
                    if (front[i].offsetHeight > highest) {
                        highest = front[i].offsetHeight;
                        absoluteSide = ".front";
                    }
                } else if (back[i].offsetHeight > highest) {
                    highest = back[i].offsetHeight;
                    absoluteSide = ".back";
                }
            }
            $(".front").css("height", highest);
            $(".back").css("height", highest);
            $(absoluteSide).css("position", "absolute");
        });

        $('.bannerSlider').slick({
            dots: true,
            infinite: true,
            speed: 1500,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false,
            pauseOnHover:true,
            responsive: [
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 400,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>
@endpush