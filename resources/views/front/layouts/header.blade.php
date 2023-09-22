<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg_color_primary sticky-top d-flex justify-content-between main-header">
		<div class="d-flex justify-content-between">
			<div class="d-flex align-items-center my-auto">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
			<div class="navbar-nav col-4 align-items-start">
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
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="{{route('about.us')}}" data-bs-toggle="dropdown"> ABOUT US </a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="{{route('about.us')}}">About Us</a></li>
						<li><a class="dropdown-item" href="{{route('our.vision')}}">Our Vision</a></li>
						<li><a class="dropdown-item" href="{{route('we.care')}}">We Care</a></li>
						<li><a class="dropdown-item" href="{{route('why.us')}}">Why Us</a></li>
						<li><a class="dropdown-item" href="{{route('leadership')}}">Leadership</a></li>
						<li><a class="dropdown-item" href="{{route('wedding.planning.services')}}">Wedding Planning Services</a></li>
						<li><a class="dropdown-item" href="{{route('support.marriage')}}">Support a Marriage</a></li>
						<li><a class="dropdown-item" href="{{route('special.cases')}}">Special Cases</a></li>
						<li><a class="dropdown-item" href="{{route('safety.security')}}">Safety and Security</a></li>
						<li><a class="dropdown-item" href="{{route('brides.guide')}}">Brides Guide</a></li>
						<li><a class="dropdown-item" href="{{route('groom.guide')}}">Groom guide</a></li>
						<li><a class="dropdown-item" href="{{route('our.affiliates')}}">Our Affiliates</a></li>
						<li><a class="dropdown-item" href="{{route('blog')}}">Blog</a></li>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('customer.search')}}"> SEARCH </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('elite.matrimonial.service')}}"> ELITE PROPOSAL </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('search.by.slug',['foreign-proposals'])}}"> ABROAD PROPOSAL </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('contact.us')}}"> CONTACT US </a>
				</li>
				<li class="nav-item">
					@if(auth()->guard('customer')->check())
						<a class="nav-link" href="{{route('logout.process')}}"> Sign Out </a>
					@else
						<a class="nav-link" href="{{route('view.login')}}"> Sign In </a>
					@endif
				</li>
			</ul>
		</div> <!-- navbar-collapse.// -->
	</nav>
</header>