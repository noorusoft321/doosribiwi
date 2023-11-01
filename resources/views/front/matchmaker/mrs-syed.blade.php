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
            margin: 24px 0;
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
            <div class="col-md-2"></div>
            <div class="col-md-4 mx-auto my-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="matchProfileImage text-center">
                            <img class="ceo-img" src="https://dummyimage.com/500x300/000/fff&text=Mrs.+Syed">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mx-auto my-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="matchProfileDetail">
                            <h4 class="heading-4 text-theme font-weight-600">Mrs. Syed</h4>
                            <p class="designation">Matchmaker, Doosri Biwi</p>
                            <p class="review">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </p>

                            <p style="margin-bottom: 1.3rem;">She is a serial entrepreneur and working for women empowerment since long time.</p>
                            <div class="matchProfileIcons">
                                <a href="https://api.whatsapp.com/send?phone=923452444262&text=Hi%20DoosriBiwi.com%2C%20I%20need%20more%20information." style="background: #25D366;">
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                </a>
                                <a href="tel:+923452444262" style="background: #e0aa3e;">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

    </div>
@endsection
@push('script')
    <script>

    </script>
@endpush