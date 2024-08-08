<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<img src="{{asset('shaadi-admin/images/favicon-32x32.png')}}" class="logo-icon" alt="logo icon">
		</div>
		<div>
			<h4 class="logo-text">Match Portal</h4>
		</div>
		<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
		</div>
	</div>

	<ul class="metismenu" id="menu">
		{{--All Customers--}}
		<li>
			<a href="{{route('match.get.all.customers')}}">
				<div class="parent-icon"><i class='bx bx-user-plus'></i></div>
				<div class="menu-title">All Customers</div>
			</a>
		</li>

		{{--My Customers--}}
		<li>
			<a href="{{route('match.get.customers.center')}}">
				<div class="parent-icon"><i class='bx bx-user-check'></i></div>
				<div class="menu-title">My Customers</div>
			</a>
		</li>

		{{--Site--}}
		<li>
			<a href="{{env('APP_URL')}}" target="_blank">
				<div class="parent-icon"><i class='bx bx-world'></i></div>
				<div class="menu-title">Site</div>
			</a>
		</li>

		{{--Logout--}}
		<li>
			<a href="{{route('match.logout.process')}}">
				<div class="parent-icon"><i class='bx bx-log-out'></i></div>
				<div class="menu-title">Logout</div>
			</a>
		</li>

	</ul>
</div>