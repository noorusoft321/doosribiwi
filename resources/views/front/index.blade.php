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
            background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);
            border-radius: 50%;
            font-size: 15px;
            color: #fff;
            font-weight: 500;
            float: right;
            padding: 6px;
        }
        .profile-boxes{
            width: 100%;
            background-image: linear-gradient(135deg, #075385 0%, #0c476e 100%);
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
            padding: 10px;
            position: relative;
            border-radius: 10px;
            box-shadow: 5px 5px 5px #082f493d;
        }
        .image-boxes{
            text-align: center;
            width: 150px;
            height: 150px;
            margin: 0 auto;
            box-shadow: 5px 5px 5px #082f493d;
            background-image: linear-gradient(#F9F295,#E0AA3E,#E0AA3E,#B88A44);
            border-radius: 50%;
            margin-top: 10px;
            position: relative;
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
            background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);
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
            background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);
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
            background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);
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
            box-shadow: 5px 5px 5px #082f493d;
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
            background-image: url('{{asset('images/islamic-second-marriage.jpg')}}');
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
            border-left: 10px solid #0c476e;
            border-right: 10px solid #075385;
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
            border-top: 10px solid #075385;
            border-bottom: 10px solid #0c476e;
            display: flex;
            align-items: center;
            height: 250px !important;
        }

        .card-container:hover .card-flip {
            transform: rotateY(180deg);
        }
        .featured-ribbon {
            position: absolute;
            width: 70%;
            top: 60px !important;
            left: 0 !important;
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
                background-image: url('{{asset('images/islamic-second-marriage-mobile.jpg')}}');
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
            .featured-ribbon {
                top: 52px !important;
            }
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
                    <img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-border.png')}}">
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
                    {{--<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-border.png')}}" style="transform: rotate(180deg);">--}}
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
                            <img src="{{asset('images/rishtay-pakistan-mrs-ali-dr-arif-alvi.jpg')}}" alt="The Most Trusted Marriage Bureau in Pakistan" width="100%">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-xl-43"></div>
        </section>
        <!--About Section End-->

        @if(!empty($oppositeGender))
            @if($oppositeGender=='Female')
                <!-- Benefits of Becoming a Second Wife Section Start -->
                    <div class="p-tb-50 bg-img ladu">
                        <div class="container">
                            <h2 class="align-center font-weight-600 white-color"> Benefits of Becoming a Second Wife? </h2>
                            <img class="img-align-center heading-border"
                                 src="{{asset('images/doosri-biwi-border.png')}}">
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
                             src="{{asset('images/doosri-biwi-border.png')}}">
                        <div class="row p-tb-10 justify-content-center data--males_looking">
                            @include('front.shimmer')
                        </div>
                        <div class="align-center p-tb-30">
                            <a href="{{route('search.by.slug',['males-Looking-for-second-Wife'])}}" class="button-theme-dark"> Explore further </a>
                        </div>
                    </div>
                </div>
                <!-- Males Looking for 2nd Wife Section End -->
            @else
                <!-- Why Consider a Second Wife Section Start -->
                <div class="p-tb-50 bg-img ladu">
                    <div class="container">
                        <h2 class="align-center font-weight-600 white-color"> Why Consider a Second Wife? </h2>
                        <img class="img-align-center heading-border"
                             src="{{asset('images/doosri-biwi-border.png')}}">
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
                             src="{{asset('images/doosri-biwi-border.png')}}">
                        <div class="row p-tb-10 justify-content-center data--females_ready">
                            @include('front.shimmer')
                        </div>
                        <div class="align-center p-tb-30">
                            <a href="{{route('search.by.slug',['females-Ready-for-second-marriage'])}}" class="button-theme-dark"> View More</a>
                        </div>
                    </div>
                </div>
                <!-- Females Ready for 2nd Marriage Section End -->
            @endif
        @else
            <!-- Benefits of Becoming a Second Wife Section Start -->
            <div class="p-tb-50 bg-img ladu">
                <div class="container">
                    <h2 class="align-center font-weight-600 white-color"> Benefits of Becoming a Second Wife? </h2>
                    <img class="img-align-center heading-border"
                         src="{{asset('images/doosri-biwi-border.png')}}">
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
                         src="{{asset('images/doosri-biwi-border.png')}}">
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
                         src="{{asset('images/doosri-biwi-border.png')}}">
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
                         src="{{asset('images/doosri-biwi-border.png')}}">
                    <div class="row p-tb-10 justify-content-center data--females_ready">
                        @include('front.shimmer')
                    </div>
                    <div class="align-center p-tb-30">
                        <a href="{{route('search.by.slug',['females-Ready-for-second-marriage'])}}" class="button-theme-dark"> View More</a>
                    </div>
                </div>
            </div>
            <!-- Females Ready for 2nd Marriage Section End -->
        @endif

        <!-- Legal Protection Section Start -->
        <div class="p-tb-50 bg-img ladu">
            <div class="container">
                <h2 class="align-center font-weight-600 white-color"> Legal Protection </h2>
                <img class="img-align-center heading-border"
                     src="{{asset('images/doosri-biwi-border.png')}}">
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
                                            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"><image width="512" height="512" xlink:href="data:image/png;base64,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"/></svg>
                                        </div>
                                        <h6 class="text-dark text-center mb-0">Family Mediation</h6>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
                                            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"><image width="512" height="512" xlink:href="data:image/png;base64,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"/></svg>
                                        </div>
                                        <h6 class="text-dark text-center mb-0">Islamic Counseling <br> & Guidance</h6>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
{{--                                            <img src="{{asset('assets/img/rishta_services/legal-assistance.png')}}" width="100%">--}}
                                            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"><image width="512" height="512" xlink:href="data:image/png;base64,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AICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABAAACEgAAICABACoy0HXdSd7fsdH6QsI7M3z87P3n5ItBryTNGi9826Ryazrurv0ddl13YMXlkgEAEo2H/Q/dV331rvECD52XXfedd2TF5sIBABKddp13b+9O4zsvuu6YyGACPQAUKITgz8TeZ+qTtA8FQBK9GCtn4n90HXdjTeBlqkAUJoTgz8FOPMm0DoBgNIce0cogN9DmicAUBr70ymBnSc0TwAAgIAEAErjMBaAEQgAlObOO0IB7r0JtE4AoDT2YFMCv4c0TwCgNPMT2C68K0zoUQAgAgcBUaq7dCobjGmWtgBaiqJ5KgCUav4QvvbuMCKDP6EIAJTqKZ0K+IuGLAY2S8tOhwZ/IrEEQC0OHBLEAJ4M+kQlAABAQJYAACAgAQAAAhIAACAgAQAAAhIAACAgAQAAAhIAACAgAQAAAhIAACAgAQAAAhIAACAgAQAAAhIAACAgAQAAAhIAACCgf2zxIx93XXfQdd2RX5SVbrque+q67q7Q7w+A+hymr4Us48yb5+fndf//+aB/2nXdSdd1b/3SbOyx67qrrusuu657qOR7rslx+upS6LqJ/oIAzdlk/L1Nz7+rXQLBqgAwTxqfuq773u/U3j52XXeeEhu7OUwfgvkH4scVf8N1LwyowAC1Ok1jxrstv//HNOn8tOl481IAOE1/iRl/PvfpdTUwbeYgDfaLQX/bD8IsJeJFIFCFAUo2f+adpa99x95ZGsPPX/sPlwPAfJD6t1+TQczSYCYEvOwoDfjzr/eZ/+77Xhi4UY0BCnGYBuohltkf05i+com0HwDmg9PvfisGNUtvuAHof69Df5Y/ZsXpdikQAIzpOM32Vy1p5nSxqhqwCAAHqUyq7D+8214DWzQnvQa+3LP8Xc16QeDKcgEwoNP0NXZ/3ef0735hEQDmTQM/e9dH81MabFp31Bvwx0i6OTwuBQLVGmAfB2nwPduhnymnr0LAPADMS7F/eHtHdd/oeQoHS7P8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"/></svg>
                                        </div>
                                        <h6 class="text-dark text-center mb-0">Legal Assistance</h6>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
                                            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"><image width="512" height="512" xlink:href="data:image/png;base64,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"/></svg>
                                        </div>
                                        <h6 class="text-dark text-center mb-0">Marriage Enrichment <br> Programs</h6>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
                                            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"><image width="512" height="512" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAYAAAD0eNT6AAAACXBIWXMAAAsSAAALEgHS3X78AAAgAElEQVR4nO3d/3XbxrLAceSe97/4KhBTgfgqEFOBeSswVYHlCiJXELkCixVEqiBSBSEriFhByAr8DuJBDNH8AYDA7vz4fs7Rke9799okQGJmZ2d3f/r69WsBAABi+Q/3GwCAeEgAAAAIiAQAAICASAAAAAjof7jpAJya7nlbm6IoltxwgAQAgD6joigm8qrG8rP75+o/X/b86leSJFSWtf/8Kj+lZz43sI5lgABSqwL8eM9P3wF9aKtaVaH+mwQB6pEAABhKFeCntT+Xgf8iyBXfSkKwlMrBcqeiAGRFAgCgD1Vwn0jAjxTo21pLQvC8kyAASZEAAOhiWvsh2J9vLYnAc+03MCgSAACnjHYC/hVXLIkXSQSeSQgwBBIAAPtUwX5GwFejTAgea1UC4CwkAAAKGeXP5GdKSV+9rSQDVUJAYyFaIwEA4hpLwJ8zyjfvSRKBRxoK0RQJABDLRAL+zOCaezRT7k3wQDKAU0gAAP+qkf4tQT8ckgEcRAIA+DSqBX3K+yhkmqDqG6BnACQAgDNVI997biwOqBoI71lNEBsJAGDfWOb155T40dJaEoEHqgLxkAAAdk2lxP+Oe4geLKgKxEICANhSze3fMdrHQF6kIvDABfaNBACwoSrz37JJDxJZSxJwz/SATyQAgG5jGe3T1IdctrVEgKWEjpAAADoxvw+NFpKQkgg4QAIA6DKVB+w19wWKkQg48J/oFwBQYip7uf9B8IcB5ZTUXzI1MOaG2UQFAMhrLA9Rgj4soyJgEBUAII8q8P9F8IcDVUXgXpaqwgAqAEBaIxkpfeC6w6mtJAIsH1SOBABI51aCP+v4EcFaPu9sKKQUCQAwvKk8BNm5DxG9SCLwzN3XhQQAGA4NfsB3C6mCMS2gBE2AQP+qeX4a/IDv3ssqgVuuiQ5UAIB+Ue4HTlvJ2RacPJgRFQCgH+Wo/1E28iH4A8ddFUXxJ8sG86ICAJxvJqN+uvvz2nYYUY5J2LJbSzWAJsHESACA7mjyG9aL/O1LaRzb7AT4oQLGpDYqrf95Wvu/kez177P0ztAkmAgJANDNXMqXBILuqhH7q/xUAd3KSLBKDqbye0JycDaqAQmRAADtjGTUzzG97awkyC/l4f7qeN/4ejJQ/VwpeF2WUA1IgAQAaI65/ma2EuSXtd88yL9VCia13/QeHLeW7xwrBQZCAgCcxv79x60l0FfBngd2M2NJBqofEoL9Psn3Dz0jAQCOm8ionxLuW087QR/nqxKCmfym0vTdi1wXKkk9IgEADqPR77u17HPwLL8xvCoZmFEd+MdWvpN8/npCAgD8aCSB/33wa1MF/QdG+dmNJRGYU436p0GQ7YR7QAIAvBW95E/Q149kgCmBXpAAAN9FLflvJejfE/TNmcjnNuI0wVamSfjMdkQCAHxzH7DL/0VG+g8KXgvOV1UFou1R8VG+v2iJBADRVYf4RNnOdysB/97xRjzRjWSOfB6oKrCQ94sWSAAQWaT5fkb7Mc0kGYiQ4K5kSoC+gIZIABDVVEb+3uf7FxL02Vs9trFspuN9ZQt9AS2QACCislT4xfH7rpr67ijzY0c1PXDrOPllv4CGSAAQzYPjUdBW5vbvKYPihAiJwA1TXseRACAKz5v7EPhxjrlUizw2DNIceAQJACIYyRy4t2Y/Aj/6dOe0IkAScAAJALzzGvw/EfgxAK9TA6wQ2IMEAJ5NJPh7epAtaO5DAh6PwCYJ2PEfVa8G6I+34F+u4/9FSpkEfwxtI1WAn+XoZw+u5Jkw5tPzDRUAeOQp+K/lQcySJuQ0lY56D42C7BUgqADAG0/B/5O8H4I/cqtGzh8lgFp2Ie9nEv1TRQUAnng5ze+FUj8UG8v3zPqhQ+ErASQA8MLD7n5bKfezeQks8DAtEDoJYAoAHngI/k8ysiL4w4qqjP7Z8B0LPR1ABQDWWQ/+7FsOD6xXA0JWAqgAwLKJzEVaVY36Cf6wzno1IGQlgAoArLLc7c+oH55ZrgaEqgSQAMAiy8G/7PCfsRsZnBtJEmBxpcBWnjHuV+EwBQBrLAf/T2xFiiA2kujeGNw34EKqcyMFr2VQVABgyUiycmvBfy0Pw/A7jyGkiVQDrB3I5f7sACoAsGJkdOT/JA9Agj+iWkogXRh7/9XZAW6RAMACq0f6fmK+H/jHRhpfb4xdjivPe3MwBQALyi/ge0N3aiuB3/XoAejIYh/PQhIYV6gAQDtrwX9Ve8AB+NFS9r9YGbo270kAgLTmxoL/k8x1cogPcNxGEmVLfQFfpLLnBlMA0KoMpH8Yujuf5SAfAO2U35vfjFwzVxsFkQBAI2tzhDcc4gOcZSbfIQvf+bU8o8w395IAQBtLHf80+wH9sZT4rzycG0APALR5NBT8pwR/oDdLCaoWmgNdLA8kAYAm5cl+1wbuyEq6mNncB+jXqyTWFpIA8ysDmAKAFlbO9Xe/PSigwEiqgRYGBP9ndTBAAgANrMz9EfyBtCzsA7KViqC55wJTAMhtZKT7d0HwB5KbG9groDo90BwSAOR2b6Dpr9oGlOAPpGchCSinKu4UvI5WmAJAThbm/V3uAQ4YZGE64BdLK4NIAJCLhXl/gj+gi/YkwFQ/AFMAyMHCvD/BH9BH+3SAqX4AEgDkcKd83p/gD+ilPQm4tnIuCFMASK3cOvd3xVedpX6ADdqnA9TvD0ACgJRGstOX1tI/wR+wZam4mqj+ecIUAFLSPO9P8Afs0bxt8JX2pYFUAJCK5iV/W1mV8KrgtQBoR/sJomqXBpIAIIXq4ByNo//qVD8O9gHs0ryseC2vT111kSkApKC59D8j+APmLSWR3yp8I5dapwJIADC0ueITvW44zx9wY6l4+d0HSVBUYQoAQ9Lc9f/ZylpdAK2Uo+1fFV6ytUyHqkEFAEPSWvp/IvgDbt0p3ShI3VQAFQAMpSx3/aHw6rLcD/BP88oANRsEkQBgCCP5gF8qu7p0/ANxaF199KKlH4ApAAzhVmHwL6QhkeAPxPAqq3y0udZy1ggVAPStzLr/UnhVP2nflQvAIMoByW/KLq2KY4OpAKBvDwqv6AvBHwjrXhp/NbnQ8EyiAoA+aTzpT0WmDSArrX1JWRsCqQCgT/cKr+aM4A+Et1HaD5D1mUkCgL7cKcyuP7HTHwCxlGeCJtc5ExOmANAHjTv+qVlqA0CVZ2Xbk2fbIZAKAPpwpyz4b7UsswGgzlzZoUGXuXYmpQKAc2lc9nejdDUCAB20NSxnaVamAoBzaVte90TwB3DCo7KlgRc5qgBUAHAObfv9s+QPQFPaepeSP7+oAOAc2kb/c4I/gIY2ynqFLlIvC6QCgK60jf6flK7zBaBbOR3wTtEr/FkqE4MjAUBXmpbSlKWzSaovDQBXtE0FLFJVJpgCQBdTZeto7wj+ADraKJvOfJ9qXwAqAOhC0+ifDX8A9EHTcy1JFYAEAG1pm/vPepgGADfKacQ/Fb2ZwXsBmAJAW5pKZZ8J/gB6spRnihaDP2upAKANTbv+seYfQN80NQQO/oyjAoA2NI3+bwn+AHq2ybUv/x6D7w5IBQBNaRr9r2S+DgCGUE4HXCm4soNWAagAoCktWXGh7LUA8EdTFWCwDc6oAKAJTfNiLPsDkIKWZYHrofYFoAKAJuaKdsninH8AKWipAlwOVQWgAoAmXuVDmFuyLTITmkp2X/8ppOqyOwe53Vn2+Fz7vWFJ5F6Hrm+xZ3S3e32Xtev6yvUN6UF25sttkMonCQBOKTPP35VcpWSHZAxkIl/i6vcQSdWLBKrnWmIQxViua3WNh2jiinx9I9LU/Nz7848EAKdoOSnL6uh/Jj9DBfxTXuQePjo9L2Ein4tZpuu7klGipes7kQpT9btSH2HuVpRed34i0VIF6P0ZSAKAY1xnvwOayPzhTFHvRCHB6l6CleWR67h2fTVMTVWqZOBB0fWtV5zGPVZFVpIgVNUQz9MjWp6DvS8JJAHAMeXGP78quEJWRv9zCUwa1g8fs5UkwNopinP50XQS5SELSbZSB8ZxreKUsnK3lUTg0UGCuY+WKsCNvJZekADgGC3Nf5pH/yMJ+nNlo9GmXiQReO7nrxvEXF4j13e/US050pJ8PjlLBrRUAXrdBI0EAIdoaf7TPPqfyyhPU5m/qxd5P5oSLcuBf9cQicBUrpGGkekhVbUpRzWkb1qqAL2dgEoCgEO0NP9pHP1P5WHgITDt+iyBKueobSqvwUKpv61FD+dYzOT6aJ9q2mWh2nSMlirA5772KGAjIOwzUtT5ryn4jyQx+sNp8C99kGueo+oykpHiH06DfyEjyNczH+CvQ+0MN7BrubfPRnfzfJWpjdx6+26SAGAfLSX3ewWvoTKTB4CGxGho5ZTGF3lQjxL9m1Mpa37I97aTKa/vb3J9uwTypVyvrdH3XyUCjwYTGQ3PpN7OByABwD4aEoAXJXOGIyn3/+5krr+Na0l6BjuMRNw7r6occi2f8S7Xd+ngTIx3UlLXdMz4Kc/ybMqtl2c0CQB2DbWDWlsaMu2JfOE1N1kN7UKSnyHuxzjQqP+Qc67vUpaFWfervBcrR3z3tgzvDO/6qM6RAGCXhtH/WsqDOc0k+FtrtBrKh56nBCaKzlzX4INcj7bX98FJElB+Dv40Ug14kGdUbmdX5kgAsGvocm8TuUf/86Al/1Ouz5i3rpvLw57r+9aVXN+2I+EHaZj14NfEvSddaagCnP2sZhkg6ibyYM7tfzMuQ7sPXpJuYltr2mtrLg2GOKzr9dVyfn0f1hLgtO4dUCYofyt4HWc9K6kAoE5D+X+RMfg/EPwbueg4UiX4N9P1+s4MrwzYdSnXQENFcp+NkqrLWdeHBAB1Gr5suUprWnb5sqJtkCL4t9MlCdgoDphdVA2SWncCNT8NwBQAKhrK/+tM64K1HHpkUZNyNcG/uy7TAR4/z70egtMjDeeldJ4GoAKAioYsO0fz35zgf5YLWbFxqGmL4H+eiw5NcXdyaIwnX5RWAkxXAagAoKJhSVbq5r+pbECD863ketbvn5amUg/2Xd9jvF57bZUADecDPHVNAqgAoJAPce7g/5Q4+I8V7DXgydVOBWdk+NAXjXav7yllQv/J4XXQVgl4VbAzYOftyUkAUChpHEoZjKtDfViH3q/3tUNunrm+vXvf8hCheyUb1vTtXtmugWanAUgAUCjYU3yb+Etk8ShVK36T5IrrO4zfWgS/TV/HxirTpS9iSBoqiZ2e4fQAoJT7Q7BIWNabydIiwKq1JAFNp8w8bRBUt1JUCXjMfFJopxVUVAAQqfw/UrqUCGjjsuWe+ZZO22ujbV/EkHJXAS5JANCFhvJ/qi/PHfPScOJDi9GvliNsh/BBybHIGqYBWg/mSACQ+8uT6oszZZtfONOmmuW1ClDIdcjdD7CRlUw5tX6WkwDENlLQrJVy9A94ctWid8ZzFaDtlMhQclcBSADQiobSWYq14nOnTVDAXYvRr5b58iFomArInQBctG2KJAGILfcXJtXmP4z+4dVli6V+j073Bajk/p5vFFRZWj3TSQBiy50ApBr95z6sAxjSLVWAf1wr2CXQ1DQA+wDEVT4w/s787n+WrTSHpOG0LmBoHxsGdw3f+yHlOlG0kvsMhm2bhkgqAHHlHv2vEgT/GcEfQTSdBtDQrT6ky8xVgGXmaZZWfQAkAHHl3kErVfkfiOCyxTpw74dg5e4FyH0IVuPBHQlAXN7n/8eZt+YEUmua8HpPAHJXAXJfXyoAOCn3srihEwBG/4jmXcP5X+/TAEXm73/uCgAJAI7KXf5/SbD8jwQAEVEF+OY6YzPgRnqccrlq2ghIAhCT9/n/Cc1/CKrNzoDe5TwK2UQVgAQgptwJwHLgv1/DCYdADk1Hf6/ONwUqMj8HTDQCkgDE5L0CQAKAyJp+/r1XAS4zPuuGHuScQgUAB+VsAFwNPP+v4YAjIKemK3wiTAPk6gXKXWFp1P9AAhCP9/K/hgOOgJyafgdyj1JTiDoN0GgQRAIQT85tMotEDYBAZJcN+wAiJACXGZ95ua/vyUSQBCAeKgCAf02/5zmXq6WS65mQOwE4mfiQAMTjPQGgAgA0D3pDn8ehQa4EIHePBQkAfpBzCmDos7JHchgGEF3TRDjCNEDOQUHOCgtTAPhBzg75oUcbjP6Bb5oeCTv0jpwa5Hzm5UywqADgjdwNgEN/GXK/P0CLpkt9I1QAioyDg5xTLCd3QyUBiIUEAEBETSsifVO9JTAJQCzeGwABfNckIY7QBFhkbATMfX2PJj4kALHkyoJL2wTzjVQAgO9IAPLLfX2PJj4kALHkXCOfYvRPAgBgn5zPvqFXP3VGAoBUGGkAiCjns48KAP6V8xAgEgAAEal99pEAIBUaAAFElDMBYBUA/pF7BUCEDUcAYFfOBODozqgkAHHkXAFQUAEAEJTaQ4FIAOLInQCkqABQZQCgTe7nEgkAQhyIQZUB+K5J6Tn3wCCKtcb3SQKAFBiZA+k1SQA4QCsNlY2AJABx5Mz0UyUAJBoA8NbBZz8JQBw5M/1UpXmmAIBvmk67Rdk9M/da/NyHAu1FAgAA/jSthpEA+McUALJKVZpXmWUDGTSthtEE6B9TAAgxBVBo7bYFEms64o3SBJh7cMAUALI6uiOUI5w5ADRPujlBMzASAHjDNADQPAG4DHKtIj8XmAJAVilH5awEQHTrhn03Oc/IT0nDtGDOJcpXh/4fJABIgQQASKfpdyDK/L+GZ4LK5xIJQAyROn1faQREcE3L3SQAwZEAxBBtu0/6ABAZCcBbPA8OIAGAR3zhEdW24Yh3dGxu2BkqAAeQAMAjEgBE1fSzH6UBcMUZIYeRAMAj+gAQ1WPD9x0lAWAwcAQJALxq+iAEPKEC8BYJwBEkAPDqgTuLYFYNl9xGmv8nATiCBABeLaUhCoiiadI7C3I9npj/P44EAJ5RBUAkTae9oiQAjP5PIAGAZyQAiKJp+b8INP9PH9AJJADwbMlqAARx3/BtzoKcDNomIQqLBADeUQVABJT/3+J73wAJALzjQQDvFg2b3UYkAKgjAYghcifsq3QDA1616f6PUP6n+78hEoAYou+FzWgAXq1bdLsz+scbJABIYZz5Kj/SDAin7hq+rfI7+C7Ah2CttPtf5cmLJABIIXcCULR4UAJWbFsEu3mQu6p19D/K+G8fHPyQACCKR3YGhDP3Lea6SQDiOrgckgQAUWxarJUGLGj6eS6D/2WAO7pg7X87JABxvGR8pxqmAAp5YFIFgAdNl/4VgUb/mhN8egAQlpYEgCoAvGja01IGnusAd/1F+WqnnD0ABxNFEgBEQxUA1rUpdd8Guds0+R52MDEiAYgj58YYWioABVUAONBm6d/7ADf8xcDJfyoPYCIBiCNneUxTAlBQBYBhn1qM/qOMihn9d0QCgIioAsCibYvPLaN/XXIOgg5eHxKAOHIuj9HYhHTP7oAwps26f0b/uqhchkkCEAfrY9/aUDqEIWvm/n9gZfSfcwVAwSoAaKCxCabcNWyl4HUAp7RJVqMktlZWOOTeA4BVADCRKecQZZkU7HppscVtlNH/wtApp7krAAeRACAVlctgJDFaKHgdwCFtktQIo/+tsfeZswJwdAdYEoBYcpa71WbB8oBlWSA0+txipDsNMvq/N9bTpG0Z9L9IAGLJuRmQyr2wBQ2B0KhN418R5DPc9ppokDMBOJo8kgDEwmZAh91nPjAJ2HXb8sCfCHv+WzzYKOd9Ofr5IQGIJWcFwMJxpDQEQounoigeG76WUZDR/5PBZubcU59HrxcJQCy5vzxaGwErS9lqFchp23KkexvgvP+t0QQ999QnFQD8K2cFoDAwDVDISIq9AZBTm9J/+Z36NcDdujO6mVnuQQ89APhX7nWzmhsB6yzOM8KHpxZr/ouW/12rXgyf3ZFz0HNyq3MSgHhy7n9vJQFgKgA5tC39R2j8a3tNtMn5zDtZMSEBiIdDgZphKgCpzVuU/kdBTrS0WvqvXGX8t09WfEkA4sndCGilClCasUEQElm06PovpPR/4fzmWC79Fwrm/6kA4Ae5s2lLCcArSwORwLrl56xMTN85vzHWS/+F5kOAKiQA8ZAAtPMgjVnAUGYtS/8RGv9uHRxhnvtZd7LaSwIQD3sBtDfP3DwJvz62XJ0TofTfdiWEVjmfdY2eVyQAMeVsbsvZFNPVRkZpQJ+eWs5xRyj9r50swx1l3pypUVJJAhBT7v0ALFYBljJaA/rQNtCNg5T+26yE0Ez1BkAVEoCYSAC6uZdubeBcbeb9iyCl/08G9/o/JPczrtF1JAGIiQSgu1v2B8CZblp+B+8CbPjz4uxAIxMVgJ++fv06/EuBRrlv/E86L0sjE8mwvY/I0L9Fy9J/+Vn70/l9WMv79FD6L2T+/++M//666RbEVADiyj2KtVwFWHJeADpYtVzvP2q5OZBVbadDtDMx+i9IAEJjOeB5HjkvAC1sO877ez/mt+10iAUm5v8LEoDQcn/pPCyru2OTIDQ0bbmxzW2AJX8Lpysbcj/bGj/b6QGIq5wj+ivzu/9fB6W/kWTcFvc3QBo3LQNdmSz84fzerAzuCtqEhudq4/4qKgBxvSrY3c5DFWDDoUE44nPL4B9h3n/rYArwkNzPtJc2/2USgNjoA+jHq7wXkgDUPXU4TMr76pIq+Htq+qszM/9fkACElzsB8LS97pKTA1Gz6rBS5CHAVNKtw6a/ykhB3wYJABrLnQBcOEsCHmS+F7GtO4xyy2ThvfOr9sn5dsYanmUkAGiMPoD+PbBdcGhdlvuVzXBfnF+0hbOd/vbJXf5vNf9fkACAPoBBzEkCQqrmt9uUuMeO9r8/pMt0iEW5BzOtm0dJAJD74XPpdDkQZwbE03Z+u+r499z0t3Lc8V83U3AfWz/LSQCgYcmRx+a5jTz4SAJiaLvWvwjQ9Oe9478u9+h/26W5kgQAGwVBylsfQKVKAnL3WWBYHzsGf887/UUK/iOL5f+CBAAidxXA22qAOjYK8q3s9bhv+Q69d/x36YWwzGT5vyABgNAwDeA1ASjkQchGQf60Pdq3kP++945/z2v999Hw7Or0DOcsAFReFZw85uFsgGMmAXZ6i6JL8I9wtn+XXgjLNOz9/9K10ZIKACpUAYZHJcCHrsHf+3K/aMG/sDz6L6gAoKb8IP+e+YJ4PSFsV4SRoFddPqMjqbB5rvx8CrDRzz4aKqc/tzxq+l9UAFB5VDAyvZKSmndLtgw2qcua9lGAaZ8Iu/ztM1UQ/Fddg39BAoAd7AmQDucG2LLqsKytCv6e1/p3mQ7xQsP7PmvKhSkA1GmYBthKFSDC+uEiSFe4dQT//SIH//L+/q3gdXQu/xdUALBDwzSA5z0B9qESoFuX4F/I3gAEf780vPezyv8FCQD2YBogPZIAnboG/wfnG/1ED/6FkmfU2SsuSACwS8MynqsgB4jUVUkASwR1eCH470Xw/1ahzN38V/QxWCMBwK5nJXvXR6sCFBI82CcgvwXBfy+C/zcank0v55b/CxIAHKBhGuBdkCWBu9gsKK+uQY7gH0P53bxW8E57qdSSAGCftoebDCXi2uKCJCAbgv9+BP/vNFyHbV+DNJYB4pClki5m7+cDHMPZAekQ/Pcj+H+nYd//os97QgUAh2ipAkTsBahUlYCVjpfj1ieC/14fCf5vaKlI9taoTQUAh2jZvzzaxkD7RNhUJpeuB9h4D/4RD/Y5Rsvof91nbxQVAByyUdIMeBG8ClDIvaAS0D+C/34E/x9pGf33WpmlAoBjtJxaRxXgm5E8ADwHnxS2spa7y/G8noP/VpJtgv9bWkb/Rd89UVQAcMxSyaiTKsA3G5mTXWh4MUZtpZpC8H+rui4E/x9pGf0v+h4EkQDgFE3NgCMFr0ODuTSuoZ1qa99lh+sWIfh3uS7ejRXd996TMxIAnPKgZD06VYC37jg/oJWuwX8k/xuvwX8lU30E//20jP5XHatWR5EAoAktVYBfg+4OeEiZnP3ChkEndd3a1/vqiyopOntLWac0jf4HeQaTAKAJTfOCUXcHPOSZXQOPqjZNIfi/1TUpikTLwGc71DOYBABNvCpqPHsvJUt8t5TRCssE37rpuJHNRNFOmEPomhRFMpXzSDQYLBFhGSCa0rIksKgd1Yq3RjJS0PLgymUrAa7LPhbet1/+qGhkq5mmBHCw7dCpAKCppQReDa5lHTfe2sh1+Rz4uqwlOewS/GeOg/9WKiIE/9PmioJ/70v/6qgAoI3ywfqHkivW65aYDpUPsS/B3vPqjHltz9eLZX7NadkCvfLzkE2aVADQxrOieeZLGgKPirZCYCHl+y7B/85x8GeZXzt3ioL/YugVGlQA0JamkdJWHm4sYzpsLOVwzwcJnTOv7XmDnyea/VrR1OdUDD36L6gAoIMHKb9rcMHWpSe9Svn3Sfnr7KJMAP/bMfhXy/y8Bv/P0tNA8G9OU3/EU4qBDQkAutBUeqch8LSqOdDT9sGrM5r9quB/PcDr0uCGXTNbmyv7PCRJRpgCQFevMg+vAacFNjeTqonlTvdzS9tlcPyt59ekAc1+3Whr/Eu2zJkKALrSVAW4oCGwsUd5uFjdNOhTD6Xte5k68NQguZIkmODfnraEOFn1hgoAzqGpClBI13vvB2Y4ZW3ToHM29zlkIn+fps9wF4uOOx7iWzL5u6LrkPRekgDgHJr2BSikObHrUrCo7uSQJc1W8lAcYnQ7kiTAaj8AO/t1p630X6To/K9jCgDneFa0O2DB3gCd3CnfL2Ax8Lz2Rv5+aw2S5f36P4L/WbSV/gdf97+LCgDOpa0KUDAV0InG0+9uEi/ztNIgec6Oh/hGW+k/y54mVABwrmeFa8wfJaChuY08gDScI7CW0W3qPR4e5RpobpD8zDTX2UYK9w+5z7GhGQkA+qBtzTEbBHV3m7lD/inz1rXVxklajr+ubFnf35tHZVWeba6pHBIA9OFV4Ql07y4DGhMAABGGSURBVHhYdpZrJPxRye51G2k6vFHSG1GV/Elqz3ersOHzNtdnnh4A9EVjRy0bo5yvHJl8GPjfWEvg13ifJhJ4c/VGLHIGCGe07fVf5D7VlAoA+rJR2IFfTQXQD9Dd7cCrBBbKT6tbZpoSqEr+HObTj1HPe0j0Jev+DSQA6NO9wgaqK5ZKne1ZRil9Lvm0FOBSTwlQ8u/fg8INn55yr1YiAUDfNM67v2entLNV6+U/9vB3rWqldUseEmyj/Jlpq97dKtzxcqvhWUkCgL49K+ygLn2RoIPz3MsSva5B8FOO9c49qqYE+m56rY42Zr6/X1OlBz9lWfa3iyZADEFjQ2DBqYG9a9MguJYqjKcNmvraOOhFro3VpEgrrc+hrI1/dVQAMASNDYGFPAjYIbA/VYPg+sTfWG1e4+3aP/bQG/FJRqkE/35VO1tq3NVRzXQkCQCGcq/snIDKFc1VvXqu7SC42yC3lgTBc1m73hvRpkFwJVMpnF0xjHtl21pXFpoSYaYAMCSN624rnKI2jKn8rZuAjWxN9wz4LIGfqahh3Cqd91c3BUkCgKFpPm72v0rXBsO2OwlCu+Vnj30Q2syl4Vcjdc8bEgCksFRajmOnQAxlJE2CVbPXkmRzcBPF8/5P8nlQhQQAKWieCshyDCeAXmkO/mpXH9EEiBSW0u2s0QXHBwOmjXpajjkUtbtdUgFASlqnAora9qs0ZgF2VMv9tD5XVJb+KyQASEnzVEAhyxanDf57AHTQPKhQv/EYUwBIadnTXvJDuWaPAMCMnMc0NzHTXlEkAUBqWjcIqrwnCQDUe5DvqlafLSz3ZAoAOWjdo7tuwQmCgErag//KysFjVACQw8ZAcKUSAOijPfhvLQ0cSACQy+MAR6r2jSQA0EN78C9kB0gzG4sxBYDcNHfxVpgOAPKyEPzNPSdIAJDbWJIAzf0ABUkAkI2F4G9yHxGmAJDbq+aNMmqYDgDSsxD8t5p3+zuGBAAaPCveKrjuPdsGA0lUO/xpD/6FBH+TB4oxBQBNyuD6zsAdYdtgYDjat/et+yTHP5tEAgBNLH3xSQKA/o1lIGDhGaB6n/8mSACgjeZjPXdtJQkwWf4DlLH03XcxAKAHANosDWXVF/LA4gAh4DwzY4m/yaa/XSQA0Kh8ENwYuTPlA+sPlggCnZWb5/xuJPgXkqy4qPqRAECrB1l7b8UXlgkCrZXfmd8MXbYbC4f8NEUPALSzsjKg8mLhGFAgM0sNv5XPUq1wgwQA2ll8UKw9lQmBnllq9qu43AmUKQBot5Emu7WhO3UpDzj6AoC3yu/En8aC/8rrd5kEABZsZES9NXS3LugLAP41ku/CF2OXZOV5lQ9TALDEYumwkIfITM49AKKZSPC3NI1XSNVx4rmfhwoALLG0R0Ddlbx2pgQQzdxgD08h1Ub3zbwkALDG0h4BdfUpAQ4TgncjWcHzxWDFLswOn0wBwKq5wfnEyro2MgK8mUqie2nwfYXa3psKAM41kbnt1KPaB6OVgEIejH9YPkUM2KN8BtzLZ5vgbwAVAJyj3pS3kv+cmuVKQFFbYsSeAbDM8qi/iHqwFxUAdLXbkX+Vacmb5UpAIdftT6kG0BsAa6yP+ovIp3pSAUAXx5bj3WRKBKxXAgp6A2CM9VF/Ef1IbyoAaOvUWvwvmTbOsF4JKGq9AawUgGZj6fC3POovhQ7+BQkAWmq6Ec9jpn4AD0lA6b00Vro6eAQu3ErAtHRA1z7hg3/BFABaaLsLX85dtDxMB1RW8tBlWgA5eSj3Vwj+ggoAmuiyBW91IE6OUraXSkAhTYLVtMBYwetBLF7K/RWCfw0JgC/j2mixHHl/lZ+NfInnHQLyOfvvX0mHcA5lwPzF2AFCx5TTAn+xWgCJVN39fzko91dWBP+3mALwYSSB/9cG72YrX+wmm9D0dfhOzrO0rR4gdEybewi0UT1Lbp19Z6rg73pv/7ZIAOwbdTxs4+XEYRd9B86PGasBE6mAeChh1q0lCeDIYfThzmHgLwj+hzEFYFvX4F+6lv/tvm79IUbNv2WsAizlPa0y/ftDuZRmx1dOGsQZ5vIZ+tVh8F94P9L3HFQA7Don+NftNsUMXTLPtVFQIdfswdGc5i4qAmiqKvXPHVbGKp9ZSnscCYBNfQX/yra2vjfFfPkvmZe1PUhTnVdVj8A9Ix/s8DrHvyvnQMMMEgB7+g7+ddtEDwUNS3E87RVwyFYegvdS4kVcY6kOeU58C/nMz9g3oxkSAFuGDP6paUgCptIc6HkkVHmSRIAHYywzGe1fB3jXnKzZEgmAHZ6Cf0VDEjCRUbKn63rMWhKBB6YH3BpJILx1PL+/60neM5/pFkgAbPAY/CsakgDvzYGHLOR9UxXwYSZBMNrn+BN7YnRDAqCf5+Bf0bI9513DzZS8WUsi8ECvgDkTCfqzQKP9ylbe+6OOl2MPCYBuEYJ/RUsSEKkvYJ+VJAKPJANqjWuj/ShTV7tWcg34jJ6BBECvSMG/oiUJqA5AifpwrZAM6EHQ/24h/Q3M95+JBECniMG/oum0rrJZ7oOC16HBShKBR7qsk5lK0I9Y3t+n2q+E9f09IQHQJ3Lwr2hKAmbywIk6JbDPVhKBZ/mhOtCPcS3oT/nMvcESvwGQAOhC8P9O04YeIwl4EdZSd7GqJQPPlGYbqwJ+9cMofz+29B0ICYAeBP/9NG3peSuHGuG4tXyWl7Xf+BbkJ/JDwD+NXf0GRgKgA8H/OE1JQLSNg/ryIonAay0x8GpUC/TVD5+XdtjYJwESgPwI/s1o2+wj6p4BfVpLQlBNG1QJgpWegkkt2I9rvxnZd8fa/oRIAPIi+LezUHbuPdWA4VTJwaY2hbCsjQiXA44Ox/Kz++d6wKdBr3+M+hMjAciH4N+NxocE1YD8tmf0GhDQ82LUnwkJQB4E//OspIlKUxIwkX0DWCkANMemPhn9J+w7z4fgf74rKQ9PFL2mpSQlH2VEA+CwcornF0r+eZEApEXw78+FXMuZstd1L3PGCwWvBdBmKw29Y5b35ccUQDoE/+F8lMCrzVReF/cc+Na/c8vOkXqQAKRB8B+e5rnEW2kUpNEMEa2l1M+IXxmmAIZH8E/jvVznsYYXs6OaFvis6lUBw9pKdY5yv1JUAIZF8E9vrTQJqIwlIXin4+UAg/gkn3Ma/BSjAjAcgn96W4VNgbte5TX+ItvjAp6UU3E/y5QXwV85KgDDIPinp+kI4Tamspsg28fCsheZ56fBzxAqAP0j+KdnNfgXtb6FG5m+ACx5kWrWlOBvDwlAvwj+6VkO/nUPJAIwpB74afAziimA/hD80/MS/PeZy/JBPk/QZCHJKkHfARKAfhD80/Mc/Oum0lDFGQPIaSGfQ8r8jpAAnI/gn16U4F83larAez0vCc5tZSnfA4HfJxKA8xD804sY/OvGMjUwZ2dBDGQto/1HlvL5RgLQHcE/vejBv24k+wnQJ4C+PMmIn/n9IEgAuiH4p0fwP2wiicCMqgBaWkuJnzJ/QCQA7RH80yP4N0NVAE09SdB/5IrFRQLQDsE/PYJ/N+NaVYBdBlFa1Ub7zO2DBKAFgn96BP9+zGo/TBHEspZR/j0lfuwiAWiG4J8ewX8YJAP+VUH/ge8PjiEBOI3gnwcJwPCqRGDKNIF5Kwn6j3xn0BQJwHEE/7y2MpfNfOXwJrWEgM+7DU/yfHqkvI8uSAAOI/jrsJIRKklAOqNaZYDqgB4reSY9072PPpAA7Efw14UkIK9xLSGYkBAkUw/4z3z+0TcSgB8R/HVayPa3yG9cqw5M+K705kWePUsCPlIgAXiL4K/bR1nOBH2qZGBCUtDIiwT6+g+QFAnAdwR//WgKtGUq92tc+3O06YOVNOhVgf6VLn1oQQLwDcHfjhtZ3wy7pvKdm+z8tvr9e5Hfz7Xfr3TmQzsSAIK/NU/SkAafqsSgqCUIu39OkSy81P5cD+bVnzeM5GFd9ASA4G/PWkrJwK5phytCIEdYkRMAgr9dP0W/AABwrv8EvYIEfwBAaBETAIK/bdvoFwAA+hAtASD428d8LQD0IFICQPD3gT3QAaAHUZoACf4+sBEQAPQkQgWA4O/HPcEfAPrhvQJA8PdjVdsgBgBwJs8VAIK/H6uOm7wAAA7wmgAQ/P2ogj+lfwDokccEgODvB8EfAAbiLQEg+PtB8AeAAXlKAAj+fhD8AWBgXhIAgr8fBH8ASMBDAkDw94PgDwCJWE8ACP5+EPwBICHLCQDB3w+CPwAkZjUBIPj7QfAHgAwsJgAEfz8I/gCQibUEgODvB8EfADKylAAQ/P0g+ANAZlYSAIK/HwR/AFDAQgJA8PeD4A8ASmhPAAj+fhD8AUARzQkAwd8Pgj8AKKM1ASD4+0HwBwCFNCYABH8/CP4AoJS2BIDg7wfBHwAU05QAEPz9IPgDgHJaEgCCvx8EfwAwQEMCQPD3g+APAEbkTgAI/n4Q/AHAkJwJAMHfD4I/ABiTKwEg+PtB8AcAg3IkAAR/Pwj+AGBU6gSA4O8HwR8ADEuZABD8/SD4A4BxqRIAgr8fBH8AcCBFAkDw94PgDwBODJ0AEPz9IPgDgCNDJgAEfz8I/gDgzFAJAMHfD4I/ADg0RAJA8PeD4A8ATvWdABD8/SD4A4BjfSYABH8/CP4A4FxfCQDB3w+CPwAE0EcCQPD3g+APAEGcmwAQ/P0g+ANAIOcmAI8EfxcI/gAQzDkJwH1RFNd8YMwj+ANAQD99/fq1y7ueFUXxOx8Y8wj+ABBUlwSgnPd/LYrigg+NaQR/AAisyxTAA8HfPII/AATXNgEoS//vol804wj+AIDWUwBl6f+Sy2YWwR8A8I82FYA7gr9pBH8AwL+aVgBo/LON4A8AeKNpBWBO8DeL4A8A+EHTCgBz/zYR/AEAezWpAMwI/iYR/AEABzVNAGALwR8AcNSpKYCy+e9vLqEpBH8AwEmnKgBTLqEpBH8AQCOnEgDK/3YQ/AEAjVEB8IHgDwBo5VgCMKb73wSCPwCgtWMJwITLqR7BHwDQCQmAXQR/AEBnJAA2EfwBAGc5lgCMuLQqEfwBAGc7thHQhgOA1CH4AwB6cSwBaHRKEJIh+AMAetP0OGDkRfAHAPSKBEA/gj8AoHckALoR/AEAgyAB0IvgDwAYDAmATgR/AMCgSAD0IfgDAAZHAqALwR8AkMSxBOCFW5AUwR8AkMyxBIBAlA7BHwCQ1LEEYMmtSILgDwBIjgQgL4I/ACALEoB8CP4AgGyOJQCvRVGsuTWDIPgDALI6tQzwmdvTO4I/ACC7UwnAI7eoVwR/AIAKP339evTY/1FRFH9zq3pB8AcAqHGqAlAGqydu19kI/gAAVZpsBfzALTsLwR8AoM6pKYBKuSLgktvXGsEfAKBS08OA7rl9rRH8AQBqNa0AjKQKcMGtbITgDwBQrWkFYEMVoDGCPwBAvaYVgEKqAEt6AY4i+AMATGhaASgkqN1xWw8i+AMAzGhTAaiU2wNfc4vfIPgDAEzpkgCMZSqAhsBvCP4AAHPaTAFUytUAt9zqfxD8AQAmdUkACtkdcBH8lhP8AQBmdZkCqIykH+Aq4O0n+AMATDsnASiCLg0k+AMAzOs6BVApg+CsKIptkI8CwR8A4MK5CUAhFYBpgCSA4A8AcKOPBKCoJQFrpx8Ngj8AwJW+EoBCkoCJBEtPXgj+AABv+kwACgmSU0dLBD8T/AEAHp27CuCYuZwgaHHHwK28/kcFrwUAgN4NmQAUsm3wg7GzA14k+L8qeC0AAAyi7ymAXa9SQr8xsEqgbGD8r7xegj8AwLWhKwB1IzlD4FbZtMBWpirumesHAESRMgGoaEkE1jI9QeAHAISTIwGom8tOgu8S/ptP0tz3kPDfBABAldwJQGUkicBM5uD7rAxs5dCiR/lhtA8ACE9LArBrsvMzanjq4EoC/HLnBwAA1GhNAE6pkoIq2AMAgBasJgAAAOAMQ+8DAAAAFCIBAAAgIBIAAAACIgEAACCaoij+H3hva6Tu4S8KAAAAAElFTkSuQmCC"/></svg>
                                        </div>
                                        <h6 class="text-dark text-center mb-0">Matchmaking Services</h6>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
                                            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"><image width="512" height="512" xlink:href="data:image/png;base64,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"/></svg>
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
                     src="{{asset('images/doosri-biwi-border.png')}}">
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
                            <img class="full-width" src="{{asset('events/nikah-ka-chuwara-latest-update.jpg')}}" alt="Nikah Ka Chuwara">
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
                     src="{{asset('images/doosri-biwi-border.png')}}">
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
                             src="{{asset('images/doosri-biwi-border.png')}}">
                        <p class="paragraph-1 align-center font-weight-500 text-white">We do not hide behind WhatsApp. We have real matchmakers & proper offices, where we sit 7 days a week and 12 hours a day to meet people and help with marriage proposals.</p>
                        <br>
                        <div class="ceoMainDetail" data-aos="zoom-in" data-aos-duration="1200">
                            <img class="ceo-img" src="{{asset('images/mrs-ali.jpg')}}" alt="Mrs. Ali">
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
                     src="{{asset('images/doosri-biwi-border.png')}}">
                <p class="align-center text-theme font-weight-500">
                    By the grace of Al Mighty Allah, Doosri Biwi successfully hosted an event where individuals can explore and embrace polygamous relationships within the framework of Islamic principles.
                </p>
                <div class="row gallery-light">
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('events/rishtay-pakistani-nikah-ka-chuwara-1.jpg')}}"
                             alt="Event Image 1"/>
                    </div>
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('events/rishtay-pakistani-nikah-ka-chuwara-2.jpg')}}"
                             alt="Event Image 2"/>
                    </div>
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('events/rishtay-pakistani-nikah-ka-chuwara-3.jpg')}}"
                             alt="Event Image 3"/>
                    </div>
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('events/rishtay-pakistani-nikah-ka-chuwara-4.jpg')}}"
                             alt="Event Image 4"/>
                    </div>
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('events/rishtay-pakistani-nikah-ka-chuwara-5.jpg')}}"
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
                     src="{{asset('images/doosri-biwi-border.png')}}">
                <p class="white-color align-center">
                    <strong class="white-color">DoosriBiwi.com</strong> is a devision of <strong class="white-color">Shaadi Organization Pakistan</strong>. A well-known, registered and recognized marriage bureau since 2003 from the Government of Pakistan having valid license, trademark and copyright certificates from the Government of Pakistan.
                </p>
                <div class="row gallery">
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('government-registered/certificate-1.png')}}" alt="Certificate 1">
                    </div>
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('government-registered/certificate-2.jpg')}}" alt="Certificate 2">
                    </div>
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('government-registered/certificate-3.png')}}" alt="Certificate 3">
                    </div>
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('government-registered/certificate-4.png')}}" alt="Certificate 4">
                    </div>
                    <div class="col-6 col-lg mx-auto my-auto">
                        <img src="{{asset('government-registered/certificate-5.png')}}" alt="Certificate 5">
                    </div>
                </div>
            </div>
        </div>
        <!-- Government Registered Marriage Bureau Section End -->

        <!-- Our partners Sites  Section Start -->
        <div class="p-tb-50 points">
            <div class="container">
                <h2 class="align-center font-weight-600"> Our Partners Sites </h2>
                <img class="img-align-center heading-border"
                     src="{{asset('images/doosri-biwi-border.png')}}">

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