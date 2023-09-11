@extends('admin.layouts.master')

@section('title',$title)

@push('style')
	<style>
		.pagination-wrapper {
			padding: 12px 25px !important;
		}
		.pagination-wrapper svg {
			width: 20px;
			cursor: pointer;
		}
		.pagination-wrapper .flex.justify-between.flex-1 {
			display: none;
		}
		.pagination-wrapper .hidden {
			display: flex !important;
			justify-content: space-between !important;
			align-items: center !important;
		}
		.pagination-wrapper .hidden div p {
			margin: 0 !important;
		}
		.pagination-wrapper .hidden div {
			width: auto !important;
		}
		.pagination-wrapper span.cursor-default {
			background: #5468DA !important;
			color: #fff !important;
		}
	</style>
@endpush

@section('content')
	<div class="page-wrapper">
		<div class="page-content">
            @if(auth()->guard('admin')->user()->role_id==1)
				<div class="row">
					{{--Today--}}
					<div class="col">
						<div class="card radius-10 bg-gradient-ibiza">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white">Today</h5>
									<h5 class="mb-0 text-white ms-auto">{{$todayCustomers}}</h5>
								</div>
							</div>
						</div>
					</div>
					{{--Weekly--}}
					<div class="col">
						<div class="card radius-10 bg-gradient-deepblue">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white">Weekly</h5>
									<h5 class="mb-0 text-white ms-auto">{{$weeklyCustomers}}</h5>
								</div>
							</div>
						</div>
					</div>
					{{--Monthly--}}
					<div class="col">
						<div class="card radius-10 bg-gradient-ohhappiness">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white">Monthly</h5>
									<h5 class="mb-0 text-white ms-auto">{{$monthlyCustomers}}</h5>
								</div>
							</div>
						</div>
					</div>
					{{--Yearly--}}
					<div class="col">
						<div class="card radius-10 bg-gradient-moonlit">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white">Yearly</h5>
									<h5 class="mb-0 text-white ms-auto">{{$yearlyCustomers}}</h5>
								</div>
							</div>
						</div>
					</div>
					{{--Total--}}
					<div class="col">
						<div class="card radius-10 bg-gradient-ibiza">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white">Total</h5>
									<h5 class="mb-0 text-white ms-auto">{{$totalCustomers}}</h5>
								</div>
							</div>
						</div>
					</div>
				</div>

				{{-- Customer with packages --}}
				<div class="card radius-10">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h5 class="mb-0"> Customers by Filer: </h5>
							</div>
							<div class="dropdown options ms-auto">
								<div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
									<i class='bx bx-dots-horizontal-rounded'></i>
								</div>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="{{route('admin.get.customers')}}"> Customers List </a></li>
								</ul>
							</div>
						</div>
						<form class="row">
							<div class="col-3">
								<div class="form-group">
									<label for="start_date">From</label>
									<input type="date" name="start_date" class="form-control" value="{{$startDate}}">
								</div>
							</div>
							<div class="col-3">
								<div class="form-group">
									<label for="end_date">From</label>
									<input type="date" name="end_date" class="form-control" value="{{$endDate}}">
								</div>
							</div>
							<div class="col-3">
								<div class="form-group">
									<label for="type">From</label>
									<select name="type" class="form-control">
										<option value=""> -- All -- </option>
										<option value="web" {{($type=="web") ? 'selected' : ''}}>Website Registration</option>
										<option value="cms" {{($type=="cms") ? 'selected' : ''}}>CMS Portal</option>
									</select>
								</div>
							</div>
							<div class="col-3 text-end">
								<button type="submit" class="btn btn-primary mt-4">Search</button>
							</div>
						</form>
						<hr>
						<div class="table-responsive">
							<table class="table align-middle mb-0">
								<thead class="table-light">
								<tr>
									<th>ID #</th>
									<th>Image</th>
									<th>Fullname</th>
									<th>Username</th>
									<th>Gender</th>
									<th>Age</th>
									<th>Created At</th>
								</tr>
								</thead>
								<tbody>
								@foreach($customers as $customer)
									<tr>
										<td>
											<a class="fs-3" href="{{route('admin.get.customer.detail',[$customer->faker_id])}}">{{$customer->id}}</a>
										</td>
										<td>
											<a href="{{$customer->imageFullPath}}" target="_blank"><img src="{{$customer->imageFullPath}}" class="rounded-circle" width="100" height="100" alt="{{$customer->full_name}}"></a>
										</td>
										<td>{{$customer->full_name}}</td>
										<td>{{$customer->name}}</td>
										<td>{{$customer->gender_name}}</td>
										<td>{{$customer->age}}</td>
										<td>{{date('d M Y h:i A', strtotime($customer->created_at))}}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						@if ($customers->hasPages())
							<div class="pagination-wrapper">
								{{ $customers->links() }}
							</div>
						@endif

					</div>
				</div>
			@elseif(in_array('admin.dashboard', session()->get('permission')))
                <div class="row">
                    {{--Today--}}
                    <div class="col">
                        <div class="card radius-10 bg-gradient-ibiza">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h5 class="mb-0 text-white">Today Created</h5>
                                    <h5 class="mb-0 text-white ms-auto">{{$todayCustomers}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Weekly--}}
                    <div class="col">
                        <div class="card radius-10 bg-gradient-deepblue">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h5 class="mb-0 text-white">Weekly Created</h5>
                                    <h5 class="mb-0 text-white ms-auto">{{$weeklyCustomers}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Monthly--}}
                    <div class="col">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h5 class="mb-0 text-white">Monthly Created</h5>
                                    <h5 class="mb-0 text-white ms-auto">{{$monthlyCustomers}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Yearly--}}
                    <div class="col">
                        <div class="card radius-10 bg-gradient-moonlit">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h5 class="mb-0 text-white">Yearly Created</h5>
                                    <h5 class="mb-0 text-white ms-auto">{{$yearlyCustomers}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Total--}}
                    <div class="col">
                        <div class="card radius-10 bg-gradient-ibiza">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h5 class="mb-0 text-white">Total Created</h5>
                                    <h5 class="mb-0 text-white ms-auto">{{$totalCustomers}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
					{{--Total Assigned--}}
					<div class="col">
						<div class="card radius-10 bg-gradient-ibiza">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white">Total Assigned</h5>
									<h5 class="mb-0 text-white ms-auto">{{$totalAssignedCustomers}}</h5>
								</div>
							</div>
						</div>
					</div>
                </div>
			@endif
		</div>
	</div>
@endsection