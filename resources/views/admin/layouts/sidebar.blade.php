<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<img src="{{asset('shaadi-admin/images/favicon-32x32.png')}}" class="logo-icon" alt="logo icon">
		</div>
		<div>
			<h4 class="logo-text">Shaadi CMS</h4>
		</div>
		<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
		</div>
	</div>

	<ul class="metismenu" id="menu">
		{{--Dashboard--}}
		<li>
			<a href="{{route('admin.dashboard')}}">
				<div class="parent-icon"><i class='bx bx-home'></i></div>
				<div class="menu-title"> Dashboard </div>
			</a>
		</li>

		{{--Customers--}}
		@if($hasPermissions=='all' || array_intersect(['admin.get.customers','admin.get.filters.customers','admin.get.all.block.customers','admin.get.all.report.customers','admin.get.all.customers.messages'],$hasPermissions))
			<li>
				<a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
					<div class="parent-icon"><i class="bx bxs-user-plus"></i>
					</div>
					<div class="menu-title">Customers</div>
				</a>
				<ul class="mm-collapse">
					@if($hasPermissions=='all' || in_array('admin.get.customers', $hasPermissions))
						<li><a href="{{route('admin.get.customers')}}"><i class="bx bx-right-arrow-alt"></i>View All</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.filters.customers', $hasPermissions))
						<li><a href="{{route('admin.get.filters.customers')}}"><i class="bx bx-right-arrow-alt"></i>Filter</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.all.block.customers', $hasPermissions))
						<li><a href="{{route('admin.get.all.block.customers')}}"><i class="bx bx-right-arrow-alt"></i>Blocked</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.all.report.customers', $hasPermissions))
						<li><a href="{{route('admin.get.all.report.customers')}}"><i class="bx bx-right-arrow-alt"></i>Reported</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.all.customers.messages', $hasPermissions))
						<li><a href="{{route('admin.get.all.customers.messages')}}"><i class="bx bx-right-arrow-alt"></i>Messages History</a></li>
					@endif
				</ul>
			</li>
		@endif

		{{--Optimize clear--}}
		@if($hasPermissions=='all' || in_array('admin.get.packages', $hasPermissions))
			<li>
				<a href="{{route('admin.get.packages')}}">
					<div class="parent-icon"><i class='bx bx-package'></i></div>
					<div class="menu-title">Packages</div>
				</a>
			</li>
		@endif

		{{--Set ups--}}
		@if($hasPermissions=='all' || array_intersect(['admin.get.countries','admin.get.states','admin.get.cities','admin.get.religions','admin.get.sects','admin.get.castes','admin.get.maritalStatuses','admin.get.hobbiesInterests','admin.get.onBehalfs','admin.get.motherTongues','admin.get.familyValues','admin.get.educations','admin.get.occupations','admin.get.monthlyInComes','admin.get.complexions','admin.get.disabilities','admin.get.whereDidYouHearAbouts','admin.get.registrationsReasons','admin.get.heights','admin.get.weights','admin.get.universities','admin.get.residenceStatuses','admin.get.houseSizes','admin.get.residenceAreas','admin.get.jobPosts','admin.get.futurePlans','admin.get.eyeColors','admin.get.hairColors','admin.get.smokes','admin.get.drinks','admin.get.doYouPreferHijabs','admin.get.doYouHaveBeards','admin.get.areYouReverts','admin.get.doYouKeepHalals','admin.get.doYouPerformSalaahs','admin.get.willingToRelocates','admin.get.iAmLookingToMarries','admin.get.myLivingArrangements','admin.get.myBuilds'],$hasPermissions))
			<li>
				<a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
					<div class="parent-icon"><i class="bx bx-cog bx-spin"></i>
					</div>
					<div class="menu-title">Set Ups</div>
				</a>
				<ul class="mm-collapse">
					@if($hasPermissions=='all' || in_array('admin.get.countries', $hasPermissions))
						<li><a href="{{route('admin.get.countries')}}"><i class="bx bx-right-arrow-alt"></i>Countries</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.states', $hasPermissions))
						<li><a href="{{route('admin.get.states')}}"><i class="bx bx-right-arrow-alt"></i>States</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.cities', $hasPermissions))
						<li><a href="{{route('admin.get.cities')}}"><i class="bx bx-right-arrow-alt"></i>Cities</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.religions', $hasPermissions))
						<li><a href="{{route('admin.get.religions')}}"><i class="bx bx-right-arrow-alt"></i>Religions</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.sects', $hasPermissions))
						<li><a href="{{route('admin.get.sects')}}"><i class="bx bx-right-arrow-alt"></i>Sects</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.castes', $hasPermissions))
						<li><a href="{{route('admin.get.castes')}}"><i class="bx bx-right-arrow-alt"></i>Castes</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.maritalStatuses', $hasPermissions))
						<li><a href="{{route('admin.get.maritalStatuses')}}"><i class="bx bx-right-arrow-alt"></i>Marital Status</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.hobbiesInterests', $hasPermissions))
						<li><a href="{{route('admin.get.hobbiesInterests')}}"><i class="bx bx-right-arrow-alt"></i>Hobbies &amp; Interest </a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.onBehalfs', $hasPermissions))
						<li><a href="{{route('admin.get.onBehalfs')}}"><i class="bx bx-right-arrow-alt"></i>On Behalfs</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.motherTongues', $hasPermissions))
						<li><a href="{{route('admin.get.motherTongues')}}"><i class="bx bx-right-arrow-alt"></i>Mother Tongues</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.familyValues', $hasPermissions))
						<li><a href="{{route('admin.get.familyValues')}}"><i class="bx bx-right-arrow-alt"></i>Family Values</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.educations', $hasPermissions))
						<li><a href="{{route('admin.get.educations')}}"><i class="bx bx-right-arrow-alt"></i>Educations</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.occupations', $hasPermissions))
						<li><a href="{{route('admin.get.occupations')}}"><i class="bx bx-right-arrow-alt"></i>Occupations</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.monthlyInComes', $hasPermissions))
						<li><a href="{{route('admin.get.monthlyInComes')}}"><i class="bx bx-right-arrow-alt"></i>Monthly InComes</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.complexions', $hasPermissions))
						<li><a href="{{route('admin.get.complexions')}}"><i class="bx bx-right-arrow-alt"></i>Complexions</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.disabilities', $hasPermissions))
						<li><a href="{{route('admin.get.disabilities')}}"><i class="bx bx-right-arrow-alt"></i>Disabilities</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.whereDidYouHearAbouts', $hasPermissions))
						<li><a href="{{route('admin.get.whereDidYouHearAbouts')}}"><i class="bx bx-right-arrow-alt"></i>Where Did You Hear About Us</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.registrationsReasons', $hasPermissions))
						<li><a href="{{route('admin.get.registrationsReasons')}}"><i class="bx bx-right-arrow-alt"></i>Registrations Reasons</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.heights', $hasPermissions))
						<li><a href="{{route('admin.get.heights')}}"><i class="bx bx-right-arrow-alt"></i>Heights</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.weights', $hasPermissions))
						<li><a href="{{route('admin.get.weights')}}"><i class="bx bx-right-arrow-alt"></i>Weights</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.universities', $hasPermissions))
						<li><a href="{{route('admin.get.universities')}}"><i class="bx bx-right-arrow-alt"></i>University</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.residenceStatuses', $hasPermissions))
						<li><a href="{{route('admin.get.residenceStatuses')}}"><i class="bx bx-right-arrow-alt"></i>Residence Status</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.houseSizes', $hasPermissions))
						<li><a href="{{route('admin.get.houseSizes')}}"><i class="bx bx-right-arrow-alt"></i>House Size</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.residenceAreas', $hasPermissions))
						<li><a href="{{route('admin.get.residenceAreas')}}"><i class="bx bx-right-arrow-alt"></i>Residence Area</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.jobPosts', $hasPermissions))
						<li><a href="{{route('admin.get.jobPosts')}}"><i class="bx bx-right-arrow-alt"></i>Job Post</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.futurePlans', $hasPermissions))
						<li><a href="{{route('admin.get.futurePlans')}}"><i class="bx bx-right-arrow-alt"></i>Future Plans</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.eyeColors', $hasPermissions))
						<li><a href="{{route('admin.get.eyeColors')}}"><i class="bx bx-right-arrow-alt"></i>Eye Colors</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.hairColors', $hasPermissions))
						<li><a href="{{route('admin.get.hairColors')}}"><i class="bx bx-right-arrow-alt"></i>Hair Colors</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.smokes', $hasPermissions))
						<li><a href="{{route('admin.get.smokes')}}"><i class="bx bx-right-arrow-alt"></i>Smokes</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.drinks', $hasPermissions))
						<li><a href="{{route('admin.get.drinks')}}"><i class="bx bx-right-arrow-alt"></i>Drinks</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.doYouPreferHijabs', $hasPermissions))
						<li><a href="{{route('admin.get.doYouPreferHijabs')}}"><i class="bx bx-right-arrow-alt"></i>Do You Prefer Hijabs</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.doYouHaveBeards', $hasPermissions))
						<li><a href="{{route('admin.get.doYouHaveBeards')}}"><i class="bx bx-right-arrow-alt"></i>Do You Have Beards</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.areYouReverts', $hasPermissions))
						<li><a href="{{route('admin.get.areYouReverts')}}"><i class="bx bx-right-arrow-alt"></i>Are You Reverts</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.doYouKeepHalals', $hasPermissions))
						<li><a href="{{route('admin.get.doYouKeepHalals')}}"><i class="bx bx-right-arrow-alt"></i>Do You Keep Halal</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.doYouPerformSalaahs', $hasPermissions))
						<li><a href="{{route('admin.get.doYouPerformSalaahs')}}"><i class="bx bx-right-arrow-alt"></i>Do You Perform Salaah</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.willingToRelocates', $hasPermissions))
						<li><a href="{{route('admin.get.willingToRelocates')}}"><i class="bx bx-right-arrow-alt"></i>Willing To Relocate</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.iAmLookingToMarries', $hasPermissions))
						<li><a href="{{route('admin.get.iAmLookingToMarries')}}"><i class="bx bx-right-arrow-alt"></i>I Am Looking To Marry</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.myLivingArrangements', $hasPermissions))
						<li><a href="{{route('admin.get.myLivingArrangements')}}"><i class="bx bx-right-arrow-alt"></i>My Living Arrangements</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.myBuilds', $hasPermissions))
						<li><a href="{{route('admin.get.myBuilds')}}"><i class="bx bx-right-arrow-alt"></i>My Builds</a></li>
					@endif
				</ul>
			</li>
		@endif

		{{--Users--}}
		@if($hasPermissions=='all' || array_intersect(['admin.get.users','admin.get.roles','admin.get.routes','admin.get.permissions'],$hasPermissions))
			<li>
				<a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
					<div class="parent-icon"><i class="bx bx-cog bx-spin"></i>
					</div>
					<div class="menu-title">User Setting</div>
				</a>
				<ul class="mm-collapse">
					@if($hasPermissions=='all' || in_array('admin.get.users', $hasPermissions))
						<li><a href="{{route('admin.get.users')}}"><i class="bx bx-right-arrow-alt"></i>Users</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.roles', $hasPermissions))
						<li><a href="{{route('admin.get.roles')}}"><i class="bx bx-right-arrow-alt"></i>Roles</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.routes', $hasPermissions))
						<li><a href="{{route('admin.get.routes')}}"><i class="bx bx-right-arrow-alt"></i>Routes</a></li>
					@endif
					@if($hasPermissions=='all' || in_array('admin.get.permissions', $hasPermissions))
						<li><a href="{{route('admin.get.permissions')}}"><i class="bx bx-right-arrow-alt"></i>Permission</a></li>
					@endif
				</ul>
			</li>
		@endif

		{{--Optimize clear--}}
		@if($hasPermissions=='all' || in_array('optimize.clear.all', $hasPermissions))
			<li>
				<a href="{{route('optimize.clear.all')}}">
					<div class="parent-icon"><i class='bx bx-world'></i></div>
					<div class="menu-title">Optimize Web</div>
				</a>
			</li>
		@endif

		{{--Optimize clear--}}
		@if($hasPermissions=='all' || in_array('admin.customer.portal.seo.tool', $hasPermissions))
			<li>
				<a href="{{route('admin.customer.portal.seo.tool')}}">
					<div class="parent-icon"><i class='bx bx-world'></i></div>
					<div class="menu-title">Seo Tools</div>
				</a>
			</li>
		@endif

		{{--Blogs--}}
		{{--<li>
			<a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
				<div class="parent-icon"><i class="bx bxl-blogger"></i>
				</div>
				<div class="menu-title">Blogs</div>
			</a>
			<ul class="mm-collapse">
				<li><a href="{{route('admin.get.categories')}}"><i class="bx bx-right-arrow-alt"></i>Categories</a></li>
				<li><a href="{{route('admin.get.blogs')}}"><i class="bx bx-right-arrow-alt"></i>Blogs</a></li>
			</ul>
		</li>

		Site CMS
		<li>
			<a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
				<div class="parent-icon"><i class="bx bxs-webcam"></i>
				</div>
				<div class="menu-title">Site CMS</div>
			</a>
			<ul class="mm-collapse">
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>Header</a></li>
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>About Us</a></li>
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>Rishta Services</a></li>
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>Customer Says</a></li>
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>Premium Plans</a></li>
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>Faqs</a></li>
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>Custom Pages</a></li>
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>Special Guests</a></li>
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>Our Offices</a></li>
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>Family Rishta Meetings</a></li>
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>Government Registered Marraige Bureau</a></li>
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>Grand Matchmaking Events</a></li>
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>Our Events</a></li>
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>Personal Matchmaking Consultant</a></li>
				<li><a href="javascript:void(0)"><i class="bx bx-right-arrow-alt"></i>Footer Content</a></li>
			</ul>
		</li>

		<li>
			<a href="{{route('admin.get.users')}}">
				<div class="parent-icon"><i class='bx bx-user-circle'></i></div>
				<div class="menu-title">Users</div>
			</a>
		</li>
		@endif--}}

		{{--@if(in_array(auth()->guard('admin')->user()->role_id,[1,2,3,4]))--}}
			{{--Call Center Customers--}}
			{{--<li>--}}
				{{--<a href="{{route('admin.get.customers.center')}}">--}}
					{{--<div class="parent-icon"><i class='bx bx-user-check'></i></div>--}}
					{{--<div class="menu-title">Customers</div>--}}
				{{--</a>--}}
			{{--</li>--}}
		{{--@endif--}}

		{{--Site--}}
		<li>
			<a href="{{env('APP_URL')}}" target="_blank">
				<div class="parent-icon"><i class='bx bx-world'></i></div>
				<div class="menu-title">Site</div>
			</a>
		</li>

		{{--Logout--}}
		<li>
			<a href="{{route('admin.logout.process')}}">
				<div class="parent-icon"><i class='bx bx-log-out'></i></div>
				<div class="menu-title">Logout</div>
			</a>
		</li>

	</ul>
</div>