<!doctype html>
<html lang="en" class="semi-dark">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title') - Shaadi Admin Portal</title>
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
	{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />--}}
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
	@php
		$hasPermissions = session()->get('permission');
		if (auth()->guard('admin')->user()->role_id==1) {
			$hasPermissions = 'all';
		}
	@endphp
	<!--wrapper-->
	<div class="wrapper">

		<!--sidebar wrapper -->
		@include('admin.layouts.sidebar')
		<!--end sidebar wrapper -->

		<!--start header -->
		@include('admin.layouts.header')
		<!--end header -->

		<!--start page wrapper -->
		@yield('content')
		<!--end page wrapper -->

		<!--start Footer -->
		@include('admin.layouts.footer')
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
	<script src="//cdnjs.cloudflare.com/ajax/libs/mousetrap/1.4.6/mousetrap.min.js"></script>
	<script>
		let hasPermissions = '{{json_encode($hasPermissions)}}';
        hasPermissions = hasPermissions.replace(/&quot;/g, '').replace('[', '').replace(']', '').split(",");
		$(function () {
            $(".closeModal").click(function() {
                $('div.modal').modal('hide');
            });

            Mousetrap.bind('ctrl+alt', function(e) {
                window.top.close();
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
        function title_to_slug(title) {
            title = title.replace(/^\s+|\s+$/g, '');
            title = title.toLowerCase();
            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to   = "aaaaeeeeiiiioooouuuunc------";
            for (var i=0, l=from.length ; i<l ; i++) {
                title = title.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }
            title = title.replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            return title;
        }
	</script>
	@stack('script')
</body>
</html>