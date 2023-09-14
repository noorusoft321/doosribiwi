@extends('front.layouts.master')

@section('title','Rishta Pakistan, Shaadi Marriage Bureau, Best Muslima Matrimonial in Pakistan Karachi, Lahore, Islamabad, Faisalabad, Rawalpindi, Gujranwala, Peshawar, Multan, Hyderabad, Islamabad, Quetta. Shia Match available.')
@section('description', 'Doosri Biwi, Government Registered Marriage Bureau Best Rishta in Pakistan Contact for Zaroorat Rishta Pakistan Matrimony for Pakistanis in USA, Canada, UK, Australia, KSA, UAE Single Muslim Matrimony, personalized matchmakers, Sunni, Shia match, Ahle Hadees Rishtay, Doosri Shaadi, Late Marriage, Divorce Rishta, Widow, Separated, Abroad, 2nd Marriage Proposals')
@push('style')
@endpush
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
        /*position: absolute;*/
        /*width: 500px;*/
        /*padding: 50px;*/
        /*border-radius: 100%;*/
        border-radius: 100%;
        filter: drop-shadow(0px 0px 5px #ECC440);
        -webkit-filter: drop-shadow(0px 0px 5px #ECC440);
        /*left: 0;*/
        /*right: 0;*/
        /*margin: 0 auto;*/
        /*top: -250px;*/
        /*clip-path: polygon(0% 15%, 15% 15%, 15% 0%, 85% 0%, 85% 15%, 100% 15%, 100% 85%, 85% 85%, 85% 100%, 15% 100%, 15% 85%, 0% 85%);*/
        /*clip-path: polygon(0% 15%, 0 0, 15% 0%, 85% 0%, 85% 15%, 100% 15%, 100% 85%, 85% 85%, 85% 100%, 15% 100%, 0 100%, 0% 85%);*/
        width: 60%;
        box-shadow: 6px 6px 18px 0px rgba(0,0,0,0.4);
        /*clip-path: polygon(15% 0%, 85% 0%, 100% 15%, 100% 85%, 85% 100%, 15% 100%, 0% 85%, 0% 15%);*/
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
    }

</style>

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

        <div class="video-section">
            <img src="{{asset('assets/img/banner.png')}}" alt="Doosri Biwi" width="100%">
        </div>

        <!-- About Section Start-->
        <section class="">
            <div class="mt-xl-43"></div>
            <div class="container-xxl">
                <div class="row">
                    <div class="content-column col-md-5 mx-auto my-auto">
                        <div class="inner-column">
                            <div class="sec-title">
                                <h2>The Most Trusted Marriage Bureau in Pakistan</h2>
                            </div>
                            <div class="text">Doosri Biwi was established in 2003 and is a licenced, government compliant marriage bureau that operates by a strict code of conduct.</div>
                            <br>
                            <ul class="list-style-one">
                                <li><i class="fa fa-check-circle"></i> Always Speak Truth.</li>
                                <li><i class="fa fa-check-circle"></i> Always Keep Your Promise.</li>
                                <li><i class="fa fa-check-circle"></i> Always Proves to be Honest.</li>
                                <li><i class="fa fa-check-circle"></i> Always Guide with Sincerity / Properly / through the Heart</li>
                                <li><i class="fa fa-check-circle"></i> Always Search Proposal for the Clients as if They are Our Brothers, Sisters, Sons & Daughters.</li>
                            </ul>
                            <div class="p-tb-30">
                                <a href="{{route('view.register')}}" class="button-theme-dark"> Register Now </a>
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
                <h2 class="align-center font-weight-600 white-color"> Nikah Ka Chuwara </h2>
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
                    <a href="{{route('view.register')}}" class="button-theme-light"> View More </a>
                </div>

            </div>
        </div>
        <!-- Lado Section End -->

        <!-- Rishta Services Section Start -->
        <div class="p-tb-30">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto text-center">
                        <div class="rishta-services-box align-center">
                            <div class="rishta-services-inner-box">
                                <h3 class="text-dark mb-0 font-weight-600 mb-2">Rishta Services</h3>
                                <p class="rishta-expert">Doosri Biwi website is 100% Free Rishta Pakistani website based
                                    on self-service basis i.e. Do It Yourself basis or Find Rishta Yourself.</p>
                                <div class="row">
                                    <div class="col-6 col-md-3">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
                                            <img src="{{asset('assets/img/rishta_services/free_rishta_website.svg')}}">
                                        </div>
                                        <h6 class="text-dark text-center mb-0">Free Rishta <br>Website</h6>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
                                            <img src="{{asset('assets/img/rishta_services/personalized_matchmaking.svg')}}">
                                        </div>
                                        <h6 class="text-dark text-center mb-0">Personalized <br> Matchmaking</h6>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
                                            <img src="{{asset('assets/img/rishta_services/live_matchmaking.svg')}}">
                                        </div>
                                        <h6 class="text-dark text-center mb-0">Live <br> Matchmaking</h6>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="rishta-services-icon bg-mikado-main text-white">
                                            <img src="{{asset('assets/img/rishta_services/elite_matrimonial.svg')}}">
                                        </div>
                                        <h6 class="text-dark text-center mb-0"> Elite <br>Matrimonial </h6>
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
                    <div class="col-lg d-sm-block d-xs-block">
                        <img src="{{asset('home_page/shaadi-organization-pakistan-grand-event(1).jpg')}}"
                             alt="Event Image 1"/>
                    </div>
                    <div class="col-lg d-sm-block d-xs-block">
                        <img src="{{asset('home_page/shaadi-organization-pakistan-grand-event(2).jpg')}}"
                             alt="Event Image 2"/>
                    </div>
                    <div class="col-lg d-sm-block d-xs-block">
                        <img src="{{asset('home_page/shaadi-organization-pakistan-grand-event(3).jpg')}}"
                             alt="Event Image 3"/>
                    </div>
                    <div class="col-lg d-sm-block d-xs-block">
                        <img src="{{asset('home_page/shaadi-organization-pakistan-grand-event(4).jpg')}}"
                             alt="Event Image 4"/>
                    </div>
                    <div class="col-lg d-sm-block d-xs-block">
                        <img src="{{asset('home_page/shaadi-organization-pakistan-grand-event(5).jpg')}}"
                             alt="Event Image 5"/>
                    </div>
                </div>
                <div class="align-center p-tb-30">
                    <a href="{{route('our.events')}}" class="button-theme-light"> View More</a>
                </div>
            </div>
        </div>
        <!-- Match Making Section End -->

        <!-- Celebrity Testimonials Section Start -->
        <div class="p-tb-50">
            <div class="container">
                <h2 class="align-center font-weight-600">Celebrity Testimonials</h2>
                <img class="img-align-center heading-border"
                     src="{{asset('assets/img/shaadi-organization-pakistan-heading-border.png')}}">
                <div class="row p-tb-10">
                    <div class="col-md-4">
                        <iframe width="100%" src="https://www.youtube.com/embed/_jme1dLM6vw"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen=""></iframe>
                    </div>
                    <div class="col-md-4">
                        <iframe width="100%" src="https://www.youtube.com/embed/IFRk_Pek0so"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen=""></iframe>
                    </div>
                    <div class="col-md-4">
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
                        <div class="ceoMainDetail">
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

                {{--<div class="row">--}}
                    {{--<div class="col-md-4">--}}
                        {{--<img class="ceo-img" src="{{asset('web_images/mrs-ali.jpg')}}" alt="Mrs. Ali">--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        {{--<h2 class="name-team"> Mrs. Ali </h2>--}}
                        {{--<h3 class="text-start">Director, Doosri Biwi</h3>--}}
                        {{--<p class="text-start text-white">Sr. Consultant & Matchmaker for Elite & Upper Class</p>--}}
                        {{--<div class="ceo-mrs-ali">--}}
                            {{--<a target="_blank" href="{{route('shaadi.matchmakers',['mrs-ali'])}}" class="button-theme-light">Contact Her</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row parent-section">--}}
                    {{--<div class="col-md-4 mx-auto my-auto">--}}
                        {{--<img class="ceo-img" src="{{asset('web_images/mrs-ali.jpg')}}" alt="Mrs. Ali">--}}
                    {{--</div>--}}
                    {{--<div class="col-md-5 mx-auto my-auto">--}}
                        {{--<div class="text-white ceoMainDetail">--}}
                            {{--<h2 class="name-team"> Mrs. Ali </h2>--}}
                            {{--<h3 class="text-start">Director, Doosri Biwi</h3>--}}
                            {{--<p class="text-start text-white">Sr. Consultant & Matchmaker for Elite & Upper Class</p>--}}
                            {{--<div class="ceo-mrs-ali">--}}
                                {{--<a target="_blank" href="{{route('shaadi.matchmakers',['mrs-ali'])}}" class="button-theme-light">Contact Her</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

            </div>
        </div>
        <!-- Hire Personal Matchmaking Consultant Section End -->

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

        <!-- Call To Action Start -->
        <div class="p-tb-50 bg-img call-to-action">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 order-2 order-lg-0 my-auto onlyMobileCenter">
                        <p class="font-30 primary-color blink-soft white-color">
                            We work very closely with our clients. We profiles each member, helping them understand
                            themselves and who is compatible to them, which is the foundation to forming a long-lasting
                            partnership.
                        </p>
                        <div class="p-tb-30">
                            <a href="{{route('view.register')}}" class="button-theme-light"> Register Now </a>
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
                    <a href="{{route('search.by.slug',['males-Looking-for-second-Wife'])}}" class="button-theme-dark"> View More</a>
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
                <div class="row gallery">
                    @foreach($govermentRegisteredMarraigeBureau as $key => $val)
                        <div class="col-lg d-sm-block d-xs-block">
                            <img src="{{asset('govermentRegisteredMarraigeBureau/'.$val->main_image)}}" alt="Document {{$key+1}}">
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
                    <div class="col-md-6 order-2 order-lg-0 mx-auto my-auto onlyMobileCenter">
                        <h4 class="heading-4 text-theme font-weight-600">9-Points Verification System</h4>
                        <p class="paragraph-1">Doosri Biwi uses unique 9-Points Trust and Safety
                            features, for the security of our members, called “Verification Badges” that display on
                            member profiles after they pass the verification of Mobile, Email, Location, Photo, Age,
                            Education, Salary, Meeting, ID and Nationality. Fully verified members also get “The Famous
                            Blue Tick” on their profiles.</p>
                        <a href="{{route('authentic.profile')}}" class="button-theme-dark"> View More</a>
                    </div>
                    <div class="col-md-4 mx-auto my-auto">
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
    </script>
@endpush