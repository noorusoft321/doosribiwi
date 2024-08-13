<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<img src="{{asset('shaadi-admin/images/favicon-32x32.png')}}" class="logo-icon" alt="logo icon">
		</div>
		<div>
			<h4 class="logo-text">BDO Portal</h4>
		</div>
		<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
		</div>
	</div>

	<ul class="metismenu" id="menu">
		{{--Manage All Customers--}}
		@if(in_array(auth()->guard('bdo')->id(),[4]))
		<li>
			<a href="{{route('bdo.get.customers.manage')}}">
				<div class="parent-icon"><i class='bx bxs-user-account'></i></div>
				<div class="menu-title">Manage Customers</div>
			</a>
		</li>
		@endif
		{{--Call Center Customers--}}
		<li>
			<a href="{{route('bdo.get.customers.center')}}">
				<div class="parent-icon"><i class='bx bx-user-check'></i></div>
				<div class="menu-title">Customers</div>
			</a>
		</li>

{{--		 Customer Support--}}
		<li>
			<a href="{{route('bdo.get.support')}}">
				<div class="parent-icon"><i class='bx bx-support'></i></div>
				<div class="menu-title">Customer Support</div>
			</a>
		</li>

{{--		--}}{{-- Package Request --}}
{{--		<li>--}}
{{--			<a href="{{route('bdo.get.package.request')}}">--}}
{{--				<div class="parent-icon"><i class='bx bx-package'></i></div>--}}
{{--				<div class="menu-title">Package Request</div>--}}
{{--			</a>--}}
{{--		</li>--}}

{{--		--}}{{--Site--}}
{{--		<li>--}}
{{--			<a href="{{env('APP_URL')}}" target="_blank">--}}
{{--				<div class="parent-icon"><i class='bx bx-world'></i></div>--}}
{{--				<div class="menu-title">Site</div>--}}
{{--			</a>--}}
{{--		</li>--}}

		{{--Logout--}}
		<li>
			<a href="{{route('bdo.logout.process')}}">
				<div class="parent-icon"><i class='bx bx-log-out'></i></div>
				<div class="menu-title">Logout</div>
			</a>
		</li>

	</ul>
</div>