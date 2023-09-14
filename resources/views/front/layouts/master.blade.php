<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="@yield('description')">
	<title>@yield('title') - {{env('APP_NAME')}}</title>
	<link rel="icon" href="{{asset('shaadi-admin/images/favicon-32x32.png')}}" type="image/png" />
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
	<link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
	@stack('style')
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
			border-left: 5px solid #E0AA3E;
			border-right: 5px solid #E0AA3E;
			/*background: rgb(64, 168, 230);*/
			/*background: linear-gradient(0deg, rgb(64, 168, 230) 0%, rgb(54, 184, 230) 100%);*/
			/*background-image: linear-gradient(#F9F295,#E0AA3E,#E0AA3E,#B88A44);*/
			color: #fff;
			overflow: hidden;
		}
		.custom-btn:hover {
			text-decoration: none;
			color: #fff;
			opacity: .8;
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
		.mobileShow {
			display: none !important;
		}
		.mobileHide {
			display: block !important;
		}
		.main-header {
			background: #040F2E;
		}
		.nav-link:hover {
			color: #fff;
		}
		iframe {
			border: 0;
			border-radius: 6px;
			box-shadow: 6px 6px 12px 0px rgba(0,0,0,0.4);
			height: 270px;
		}
		@media only screen and (max-width: 600px) {
			.mobileShow {
				display: block !important;
			}
			.mobileHide {
				display: none !important;
			}
			.main-header {
				background: #040F2E;
			}
			.nav-link {
				color: #ffffff;
			}
			.nav-item {
				margin-left: 15px;
			}
			iframe {
				margin-bottom: 10px;
				height: 200px;
			}
		}
	</style>
</head>

<body>

<a id="goTopButton"></a>

{{-- Start Header --}}
@include('front.layouts.header')
{{-- End Header --}}

<!--start Main Content -->
@yield('content')
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
<script>
    baguetteBox.run('.tz-gallery');
</script>
<script>
    let authCheckGlobally = '{{auth()->guard('customer')->check()}}';

    var btn = $('#goTopButton');
    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });

    $(function () {

        $("button.btn-close").click(function() {
            $('div.alert-dismissible').hide('slow');
            $('div.alert-success').hide('slow');
            setTimeout(function () {
                $('div.alert-dismissible').remove();
                $('div.alert-success').remove();
            },1000)
        });

        $('i#togglePassword').click(function() {
            let checkInput = $(this).parent().find('input');
            checkInput.attr('type', (checkInput.attr('type')=='password' ? 'text' : 'password'));
        });

        // Profile Dropdown Start
        $(".profile-hover").click(function(){
            $(".profile-menu").toggle();
			$(".account .profile-menu.show").removeAttr('style');
			$(".account .profile-menu.show").css({
				'right': '0px',
				'display': 'block',
				'position': 'absolute',
				'will-change': 'transform',
				'top': '0px',
				'transform': 'translate3d(0px, 56px, 0px)'
			})
        });

        $(document).click(function(){
            $(".profile-menu").hide();
        });
    });

    function checkAuthLoginMessage() {
        Swal.fire({
            title: 'Please register or log in to view profile',
            icon: 'info',
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonColor: '#040F2E',
            confirmButtonText: 'Login',
            denyButtonText: `Register`,
        }).then((result) => {
            if (result.isConfirmed) {
                location = "{{route('view.login')}}";
            } else if (result.isDenied) {
                location = "{{route('view.register')}}";
            }
        });
        return false;
    }

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

    function getStates(input,putInField,selectName='Select') {
        let selectValue = selectName=='Select' ? '' : '0';
        let refrenceId = $(input).val();
        let fieldShortCode = $(`select[name="${putInField}"]`);
        let fieldTwoShortCode = $(`select[name="city_id"]`);
        if (putInField=='StateOfOrigin') {
            fieldTwoShortCode = $(`select[name="CityOfOrigin"]`);
        }
        if (refrenceId) {
            axios.get(`{{route('get.states')}}/${refrenceId}`).then(function (res) {
                fieldShortCode.empty();
                fieldShortCode.append(new Option(selectName, selectValue));
                fieldTwoShortCode.empty();
                fieldTwoShortCode.append(new Option(selectName, selectValue));
                if (res.data.data.length > 0) {
                    $.each(res.data.data, function (k, v) {
                        fieldShortCode.append(new Option(v.title, v.id));
                    });
                    return;
                }
            }).catch(function (error) {
                fieldShortCode.empty();
                fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
                fieldTwoShortCode.empty();
                fieldTwoShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
                return;
            });
        }
        fieldShortCode.empty();
        fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
        return;
    }

    function getCities(input,putInField,selectName='Select') {
        let selectValue = selectName=='Select' ? '' : '0';
        let refrenceId = $(input).val();
        let fieldShortCode = $(`select[name="${putInField}"]`);
        if (refrenceId) {
            axios.get(`{{route('get.cities')}}/${refrenceId}`).then(function (res) {
                if (res.data.data.length > 0) {
                    fieldShortCode.empty();
                    fieldShortCode.append(new Option(selectName, selectValue));
                    $.each(res.data.data, function (k, v) {
                        fieldShortCode.append(new Option(v.title, v.id));
                    });
                    return;
                }
            }).catch(function (error) {
                fieldShortCode.empty();
                fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
                return;
            });
        }
        fieldShortCode.empty();
        fieldShortCode.html(`<option value="${selectValue}">${selectName}</option>`);
        return;
    }

    function getSects(input,putInField) {
        let refrenceId = $(input).val();
        let fieldShortCode = $(`select[name="${putInField}"]`);
        if (refrenceId) {
            axios.get(`{{route('get.sects')}}/${refrenceId}`).then(function (res) {
                if (res.data.data.length > 0) {
                    fieldShortCode.empty();
                    fieldShortCode.append(new Option('Select', ''));
                    $.each(res.data.data, function (k, v) {
                        fieldShortCode.append(new Option(v.title, v.id));
                    });
                    return;
                }
            }).catch(function (error) {
                fieldShortCode.empty();
                fieldShortCode.html('<option value="">Select</option>');
                return;
            });
        }
        fieldShortCode.empty();
        fieldShortCode.html('<option value="">Select</option>');
        return;
    }

    function getMajorCourses(input,putInField) {
        let refrenceId = $(input).val();
        let fieldShortCode = $(`select[name="${putInField}"]`);
        if (refrenceId) {
            axios.get(`{{route('get.major.courses')}}/${refrenceId}`).then(function (res) {
                if (res.data.data.length > 0) {
                    fieldShortCode.empty();
                    fieldShortCode.append(new Option('Select', ''));
                    $.each(res.data.data, function (k, v) {
                        fieldShortCode.append(new Option(v.title, v.id));
                    });
                    return;
                }
            }).catch(function (error) {
                fieldShortCode.empty();
                fieldShortCode.html('<option value="">Select</option>');
                return;
            });
        }
        fieldShortCode.empty();
        fieldShortCode.html('<option value="">Select</option>');
        return;
    }

    function copyToClipBoard(input) {
        $(input).attr('disabled',false);
        var temp = $("<input>");
        $("body").append(temp);
        temp.val($('input[name="user__name"]').val()).select();
        document.execCommand("copy");
        temp.remove();
        alertyFy('Copied successfully','success',1500);
    }

    async function checkIfExists(input) {
        $(':input').removeClass('has-error');
        $('.text-danger').remove();
        let fieldName = $(input).attr('name');
        if (fieldName=='name') {
            await title_to_slug(input);
        }
        let fieldValue = $(input).val();
        if (fieldValue && fieldName) {
            await axios.post(`{{route('customer.check.exists')}}`,{
                fieldName:fieldName,
                fieldValue:fieldValue
            }).then(function (res) {
                if (res.data.status == 'warning') {
                    $(`:input[name="${fieldName}"]`).addClass("has-error");
                    $(`:input[name="${fieldName}"]`).after(`<span class="text-danger">${res.data.msg}</span>`);
                }
            }).catch(function (error) {
                console.log('error',error);
            });
        }
    }

    $(function(){
        $(window).scroll(function(){
            var winTop = $(window).scrollTop();
            if(winTop >= 30){
                $(".main-header").addClass("sticky-header");
            }else{
                $(".main-header").removeClass("sticky-header");
            }
        });
    });

    function title_to_slug(input) {
        let title = $(input).val();
        if (title) {
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

            $(input).val(title);
        }
    }

    function deleteProfile(input) {
        $(input).attr('disabled', true);
        if (confirm("Are you sure you want to delete your account?")) {
            $.get(`{{route('customer.delete.profile')}}`, function (res) {
                alertyFy(res.msg, res.status, 2000);
                if (res.status == 'success') {
                    setTimeout(function () {
						window.location.href = '{{route('landing.page')}}';
                    },3000);
                    $(input).attr('disabled', false);
                } else {
                    alertyFy(res.msg, res.status, 2000);
                    $(input).attr('disabled', false);
                }
            });
        }
    }

</script>
@stack('script')
</body>
</html>