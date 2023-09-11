<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>404 Not Found - {{env('APP_NAME')}}</title>
    <link rel="icon" href="{{asset('shaadi-admin/images/favicon-32x32.png')}}" type="image/png" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <style>
        .alert-dismissible {
            background: #ff2100 !important;
            color: #fff !important;
        }
        .form-group i#togglePassword {
            float: right;
            padding-right: 5px;
            margin-top: -28px;
            cursor: pointer;
            color: #040F2E;
            font-size: 15px;
            transition-delay: 250ms;
        }
        .form-group i#togglePassword:hover {
            font-size: 18px;
            transition-delay: 250ms;
        }

        .social-btn-group {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            padding-left: 0;
            list-style: none;
        }
        .social-btn-group .social-item .social-link i {
            display: inline-flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50rem;
            -webkit-transition: color 0.25s ease-in-out, background-color 0.25s ease-in-out, border-color 0.25s ease-in-out;
            transition: color 0.25s ease-in-out, background-color 0.25s ease-in-out, border-color 0.25s ease-in-out;
            color: #FFFFFF !important;
            font-size: 22px;
        }
        #goTopButton {
            display: inline-block;
            background-color: #040F2E;
            width: 50px;
            height: 50px;
            text-align: center;
            border-radius: 4px;
            position: fixed;
            bottom: 30px;
            right: 30px;
            transition: background-color .3s,
            opacity .5s, visibility .5s;
            opacity: 0;
            visibility: hidden;
            z-index: 1000;
        }
        #goTopButton::after {
            content: "\f077";
            font-family: FontAwesome;
            font-weight: normal;
            font-style: normal;
            font-size: 2em;
            line-height: 50px;
            color: #fff;
        }
        #goTopButton:hover {
            cursor: pointer;
            background-color: #930224;
        }
        #goTopButton:active {
            background-color: #930224;
        }
        #goTopButton.show {
            opacity: 1;
            visibility: visible;
        }
        .text-golden {
            color: #D5AD6D;
            background: -webkit-linear-gradient(transparent, transparent), -webkit-linear-gradient(top, rgba(213,173,109,1) 0%, rgba(213,173,109,1) 26%, rgba(226,186,120,1) 35%, rgb(202 170 117) 45%, rgb(255 216 155) 61%, rgba(213,173,109,1) 100%);
            background: -o-linear-gradient(transparent, transparent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }
        .custom-btn {
            width: 100%;
            height: 30px;
            color: #fff;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 14px;
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
            box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
            7px 7px 20px 0px rgba(0,0,0,.1),
            4px 4px 5px 0px rgba(0,0,0,.1);
            outline: none;
        }
        .btn-match {
            border: none;
            background: rgb(230, 46, 4);
            background: linear-gradient(0deg, rgb(230, 46, 4) 0%, rgb(242, 97, 65) 100%);
            color: #fff;
            overflow: hidden;
        }
        .btn-view-profile {
            border: none;
            background: rgb(64, 168, 230);
            background: linear-gradient(0deg, rgb(64, 168, 230) 0%, rgb(54, 184, 230) 100%);
            color: #fff;
            overflow: hidden;
        }
        .custom-btn:hover {
            text-decoration: none;
            color: #fff;
        }
        .custom-btn:before {
            position: absolute;
            content: '';
            display: inline-block;
            top: -180px;
            left: 0;
            width: 30px;
            height: 100%;
            background-color: #fff;
            animation: shiny-btn1 3s ease-in-out infinite;
        }
        .custom-btn:hover{
            opacity: .7;
        }
        .custom-btn:active{
            box-shadow:  4px 4px 6px 0 rgba(255,255,255,.3),
            -4px -4px 6px 0 rgba(116, 125, 136, .2),
            inset -4px -4px 6px 0 rgba(255,255,255,.2),
            inset 4px 4px 6px 0 rgba(0, 0, 0, .2);
        }
        @-webkit-keyframes shiny-btn1 {
            0% { -webkit-transform: scale(0) rotate(45deg); opacity: 0; }
            80% { -webkit-transform: scale(0) rotate(45deg); opacity: 0.5; }
            81% { -webkit-transform: scale(4) rotate(45deg); opacity: 1; }
            100% { -webkit-transform: scale(50) rotate(45deg); opacity: 0; }
        }
    </style>
</head>

<body>
<a id="goTopButton"></a>

{{-- Start Header --}}
@include('front.layouts.header')
{{-- End Header --}}

<!--start Main Content -->
<br><br>
<div class="d-flex align-items-center justify-content-center">
    <div class="text-center row">
        <div class=" col-md-6">
            <img src="https://cdn.pixabay.com/photo/2017/03/09/12/31/error-2129569__340.jpg" alt="404 Not Found"
                 class="img-fluid">
        </div>
        <div class=" col-md-6 mt-5">
            <p class="fs-3"> <span class="text-danger">Oops!</span> Page not found.</p>
            <p class="lead">
                The page you’re looking for doesn’t exist.
            </p>
            <a href="/" class="btn btn-outline-primary">Go Home</a>
        </div>

    </div>
</div>
<br><br>
<!--end Main Content -->

{{-- Start Footer --}}
@include('front.layouts.footer')
{{-- End Footer --}}

<script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/slick.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.5/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
</body>
</html>