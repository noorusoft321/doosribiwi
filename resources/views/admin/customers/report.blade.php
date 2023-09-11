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

			{{-- Customer with packages --}}
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h5 class="mb-0"> Report Customers List </h5>
						</div>
					</div>
					<form>
						<div class="row">
							<div class="col-5">
								<div class="form-group">
									<select onchange="checkCustom(this)" name="f_by" id="f_by" class="form-control">
										<option value="today" {{($fBy=='today') ? 'selected' : ''}}>Today</option>
										<option value="weekly" {{($fBy=='weekly') ? 'selected' : ''}}>Weekly</option>
										<option value="monthly" {{($fBy=='monthly') ? 'selected' : ''}}>Monthly</option>
										<option value="yearly" {{($fBy=='yearly') ? 'selected' : ''}}>Yearly</option>
										<option value="custom" {{($fBy=='custom') ? 'selected' : ''}}>Custom</option>
									</select>
								</div>
							</div>
							<div class="data--custom col" style="display: {{($fBy=='custom') ? 'report' : 'none'}};">
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<input type="date" name="f_sd" id="f_sd" class="form-control" value="{{(!empty($fSd)) ? date('Y-m-d',strtotime($fSd)) : ''}}">
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<input type="date" name="f_ed" id="f_ed" class="form-control" value="{{(!empty($fEd)) ? date('Y-m-d',strtotime($fEd)) : ''}}">
										</div>
									</div>
								</div>
							</div>
							<div class="col-auto text-end">
								<button type="submit" class="btn btn-primary">Search</button>
								<a href="{{route('admin.get.all.report.customers')}}" type="button" class="btn btn-success">Reset</a>
							</div>
						</div>
					</form>
					<hr>
					<div class="table-responsive">
						<table class="table table-hover align-middle mb-0">
							<thead class="table-light">
							<tr>
								<th>ID #</th>
								<th>Report By</th>
								<th>Report To</th>
								<th>Reason</th>
								<th>Created At</th>
							</tr>
							</thead>
							<tbody>
								@foreach($reportCustomers as $customer)
									<tr>
										<td>{{$customer->id}}</td>
										<td>
											<a href="{{route('admin.get.customer.detail',[$customer->faker_report_by])}}">{{$customer->report_by_name}}</a>
										</td>
										<td>
											<a href="{{route('admin.get.customer.detail',[$customer->faker_report_to])}}">{{$customer->report_to_name}}</a>
										</td>
										<td>{{$customer->desc}}</td>
										<td>{{date('d M Y h:i A', strtotime($customer->created_at))}}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@if ($reportCustomers->hasPages())
						<div class="pagination-wrapper">
							{{ $reportCustomers->links() }}
						</div>
					@endif

				</div>
			</div>
		</div>
	</div>
@endsection

@push('script')
	<script>
        function checkCustom(input) {
            $('.data--custom').hide();
            if ($(input).val()=='custom') { $('.data--custom').show('slow'); }
        }
	</script>
@endpush