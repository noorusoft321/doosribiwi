<!doctype html>
<html lang="en" class="semi-dark">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title') - Shaadi Match Maker Portal</title>
	{{--All Styles--}}
	<link rel="icon" href="{{asset('shaadi-admin/images/favicon-32x32.png')}}" type="image/png" />
	<link href="{{asset('shaadi-admin/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
	<link href="{{asset('shaadi-admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet"/>
	<link href="{{asset('shaadi-admin/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet"/>
	<link href="{{asset('shaadi-admin/css/pace.min.css')}}" rel="stylesheet"/>
	<link href="{{asset('shaadi-admin/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('shaadi-admin/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{asset('shaadi-admin/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('shaadi-admin/css/icons.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('shaadi-admin/css/dark-theme.css')}}"/>
	<link rel="stylesheet" href="{{asset('shaadi-admin/css/semi-dark.css')}}"/>
	<link rel="stylesheet" href="{{asset('shaadi-admin/css/header-colors.css')}}"/>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
	<style>
		.has-error {
			border: 1px solid red!important;
		}
		.swal2-popup {
			width: auto!important;
		}
		.swal2-modal .swal2-title {
			font-size: 14px;
		}
	</style>
	@stack('style')
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">

		<!--sidebar wrapper -->
		@include('match.layouts.sidebar')
		<!--end sidebar wrapper -->

		<!--start header -->
		@include('match.layouts.header')
		<!--end header -->

		<!--start page wrapper -->
		@yield('content')
		<!--end page wrapper -->

		<!--start Footer -->
		@include('match.layouts.footer')
		<!--end Footer -->

	</div>
	<!--end wrapper-->

	{{--All Scripts--}}
	<script src="{{asset('shaadi-admin/js/jquery.min.js')}}"></script>
	<script src="{{asset('shaadi-admin/js/pace.min.js')}}"></script>
	<script src="{{asset('shaadi-admin/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('shaadi-admin/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('shaadi-admin/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('shaadi-admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{asset('shaadi-admin/js/app.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.5/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
		$(function () {
            $(".closeModal").click(function() {
                $('div.modal').modal('hide');
            });
        });
        function alertyFy(message,icon,timer=3000) {
            Swal.fire({
                title: message,
                icon: icon,
                showConfirmButton: false,
                position: 'top-right',
                timer: timer
            });
            return false;
        }
	</script>
	@stack('script')
</body>
</html>