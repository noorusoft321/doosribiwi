<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg_color_primary sticky-top d-flex justify-content-between main-header" style="padding: 5px;">
		<div class="d-flex justify-content-between">
			<div class="d-flex align-items-center my-auto">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
			<div class="navbar-nav col-4 align-items-end">
				<a href="{{route('landing.page')}}">
					<img src="{{asset('assets/img/Shaadi-Organization-Pakistan-Rishta-Logo.png')}}" width="100%">
				</a>
			</div>
		</div>

		<div class="collapse navbar-collapse col-auto mx-auto my-auto" id="main_nav">
			<ul class="navbar-nav mx-auto my-auto">
				<li class="nav-item active">
					<a class="nav-link" href="{{route('landing.page')}}"> HOME </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('about.us')}}"> ABOUT US </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('customer.search')}}"> SEARCH </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('free.rishta.services')}}"> SERVICES </a>
				</li>
				{{--<li class="nav-item">--}}
					{{--<a class="nav-link" href="{{route('elite.matrimonial.service')}}"> ELITE PROPOSAL </a>--}}
				{{--</li>--}}
				{{--<li class="nav-item">--}}
					{{--<a class="nav-link" href="{{route('search.by.slug',['foreign-proposals'])}}"> ABROAD PROPOSAL </a>--}}
				{{--</li>--}}
				<li class="nav-item">
					<a class="nav-link" href="{{route('contact.us')}}"> CONTACT US </a>
				</li>
				<li class="nav-item">
					@if(auth()->guard('customer')->check())
						<div class="account mobileHide">
							<ul class="navbar-nav after-login">
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										@if(file_exists(public_path('customer_images/'.auth()->guard('customer')->user()->image)))
											<img src="{{asset('customer_images/'.auth()->guard('customer')->user()->image)}}" width="40" height="40" class="rounded-circle">
										@endif
										<span></span>
									</a>
									<div class="dropdown-menu profile-menu" aria-labelledby="navbarDropdownMenuLink" style="right: 0px; position: absolute; will-change: transform; top: 0px; transform: translate3d(0px, 56px, 0px); display: none;">
										<a class="dropdown-item" href="{{route('customer.dashboard')}}"> Dashboard </a>
										<a class="dropdown-item" href="{{route('logout.process')}}"> Sign Out </a>
									</div>
								</li>
							</ul>
						</div>
						<a class="nav-link mobileShow" href="{{route('customer.dashboard')}}"> Dashboard </a>
						<a class="nav-link mobileShow" href="{{route('logout.process')}}"> Sign Out </a>
					@else
						<a class="nav-link" href="{{route('view.login')}}"> Sign In </a>
					@endif
				</li>
			</ul>
		</div> <!-- navbar-collapse.// -->
	</nav>
</header>