@extends('front.layouts.master')
@section('title', $title)
@section('description', $title)

@push('style')
    <style>
        .events-heading {
            text-align: center !important;
            font-weight: bold;
        }
        .img-fluid {
            box-shadow: 6px 6px 12px 0px rgba(0,0,0,0.4);
            border-radius: 5px;
            margin-bottom: 20px;
            width: 100%;
        }
        .card {
            border-radius: 20px;
            box-shadow: 5px 5px 5px #082f493d;
            border: none;
        }
        .section-card-heading {
            font-size: 25px;
            color: #D5AD6D;
            background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(179 143 86) 61%, rgba(213,173,109,1) 100%);
            background: -o-linear-gradient(transparent, transparent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 600;
            text-align: center;
            margin: 10px 0px 15px 0px;
        }
        .matchProfileImage img {
            width: 95%;
            border-radius: 15px 50px;
            padding: 10px;
            background-image: linear-gradient(#F9F295,#E0AA3E,#E0AA3E,#B88A44);
        }
        .matchProfileDetail .designation {
            font-weight: 500;
            color: #8D8B8B;
        }
        .matchProfileDetail .review i{
            color: #E0AA3E;
        }
        .matchProfileIcons {
            margin: 20px 0;
        }
        .matchProfileIcons a {
            box-shadow:inset 0px 1px 0px 0px #fce2c1;
            border-radius:11px;
            border:none;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-size:16px;
            font-weight:bold;
            padding:8px 18px;
            text-decoration:none;
        }
        .matchProfileIcons a img {
            width: 15px;
        }
        .matchProfileIcons a i {
            color: #fff;
        }
        .section-card-heading {
            text-align: left !important;
        }
        .fa-whatsapp:before{content:"\f232"}
        @media only screen and (max-width: 600px) {
            .section-card-heading {
                font-size: 20px !important;
            }
            .container-xxl {
                padding: 10px !important;
            }
        }
        .fa-whatsapp:before{
            content:"\f232";
            font-family: FontAwesome;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl p-tb-20">
        <div class="row">
            <div class="col-md-4 mx-auto d-flex align-items-stretch">
                <div class="card">
                    <div class="card-body">
                        <div class="matchProfileImage text-center">
                            <img class="ceo-img" src="{{asset('web_images/mrs-ali.jpg')}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mx-auto d-flex align-items-stretch">
                <div class="card">
                    <div class="card-body">
                        <div class="matchProfileDetail">
                            <h4 class="heading-4 text-theme font-weight-600">Mrs. Ali</h4>
                            <p class="designation">Director, Doosri Biwi</p>
                            <p class="review">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </p>

                            {{--<p>Hi,</p>--}}
                            {{--<p>Mrs. Ali is the Director of Doosri Biwi.</p>--}}
                            {{--<p>Mrs. Ali deals in Celebrities, Politicians, Industrialists, Elite Class and Upper Class proposals.</p>--}}
                            <p>She is a serial entrepreneur and working for women empowerment since long time.</p>
                            <p class="mb-0">Her vision is to build a world in which women are respected, empowered, uplifted and equal partners in society.</p>
                            <p style="visibility: hidden;">society.</p>
                            <div class="matchProfileIcons">
                                <a href="https://api.whatsapp.com/send?phone=923410895555&text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information." style="background: #25D366;">
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                </a>
                                <a href="tel:+923410895555" style="background: #e0aa3e;">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mx-auto d-flex align-items-stretch">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h4 class="section-card-heading">Director's Message</h4>
                        <br>
                        <iframe width="100%" height="350px" src="https://www.youtube.com/embed/YqON8MnynXk" title="How Doosri Biwi Works | Best Marriage Bureau | Best Matchmaker in Pakistan" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3 class="section-card-heading">Profile: </h3>
                <ul class="authentic-detail">
                    <li>Mrs. Ali deals in Celebrities, Politicians, Industrialists, Elite Class and Upper Class proposals.</li>
                    <li>Before Doosri Biwi she was managing Mega Marketing Network and Talent Agency in Pakistan.</li>
                    <li>She has deep interest in the matchmaking and helped hundreds of Pakistani people around the world find their life partners.</li>
                    <li>At Doosri Biwi she conducts Grand Matchmaking Events every year in which 800+ people participate to find their life partners and do direct family to family meeting.</li>
                    <li>She also conducts Shaadi Ka Laddu Family Rishta Meeting every month in DoosriBiwi.com office in which 250+ people participate every month to find life partner fast and easy.</li>
                    <li>She has specialized skills in Local, Abroad and Second Marriage Cases and mostly deal in educated family proposals.</li>
                    <li>She also helps poor girls from under privilege class in finding the right life partner through their Free Rishta Services.</li>
                    <li>She also conducts personal grooming sessions for boys and girls and help them overcome challenges in their personal and social life.</li>
                    <li>She has appeared in a number of TV programs in PTV, Hum TV, Metro One, Suno TV, GTV, etc.</li>
                    <li>At the moment she is managing a network of 200+ matchmakers from all over Pakistan and Abroad and two offices. One in Gulshan-e-Iqbal and second in North Nazimabad, Karachi.</li>
                    <li>Her interest include: Women Empowerment, Matchmaking, Rishta Counseling, and Personal Grooming.</li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3 class="section-card-heading">Media Interviews:</h3>
                <div class="row">
                    <div class="col-md-4">
                        <iframe width="100%" height="270px" src="https://www.youtube.com/embed/AXcHAIsb4dY" title="Mrs. Ali - Director of @ShaadiOrgPk  at @PTVNationalOfficial | Discussion on Rishta Services" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="col-md-4">
                        <iframe width="100%" height="270px" src="https://www.youtube.com/embed/G_A_uOchyJc" title="Mrs.Ali | Shadi Organization Pakistan | Muskurati Subha | 24 5 23" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="col-md-4">
                        <iframe width="100%" height="270px" src="https://www.youtube.com/embed/YmkvgY0N7JQ" title="How important is counseling for boys and girls before Marriage? | G Utha Pakistan with Nusrat Haris" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>

    </script>
@endpush