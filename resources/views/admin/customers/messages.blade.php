@extends('admin.layouts.master')

@section('title',$title)

@push('style')
	<style>
		.call-his-height{
			height: 75vh;
			overflow-y: auto;
		}
	</style>
@endpush

@section('content')
	<div class="page-wrapper">
		<div class="page-content">
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h5 class="mb-0"> All Customers Messages </h5>
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
							<div class="data--custom col" style="display: {{($fBy=='custom') ? 'block' : 'none'}};">
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
								<a href="{{route('admin.get.all.customers.messages')}}" type="button" class="btn btn-success">Reset</a>
							</div>
						</div>
					</form>
					{{--$messages--}}
					{{--Hellow--}}
				</div>
			</div>

			<div class="row justify-content-center">
				<div class="col-7">
					<div class="card radius-10">
						<div class="card-body call-his-height" id="callHisHeight">
							@forelse($messages as $val)
								<div class="chat-message-right mb-4">
									<div class="flex-shrink-1 bg-light rounded border border-1 border-info py-1 px-3 mr-3">
										<div class="row border-bottom border-info my-2">
											@if(!empty($val->getSenderCustomer))
												<div class="col mb-1 font-18">
													<a href="{{route('admin.get.customer.detail',[$val->getSenderCustomer->faker_id])}}">{{$val->getSenderCustomer->full_name}}</a>
												</div>
											@else
												<div class="col mb-1 font-18">Sender {{$val->sender_id}}</div>
											@endif
											<div class="col mb-1 font-18 text-center">{{date('d M Y h:i A', strtotime($val->created_at))}}</div>
											@if(!empty($val->getReceiverCustomer))
												<div class="col mb-1 font-18 text-end">
													<a href="{{route('admin.get.customer.detail',[$val->getReceiverCustomer->faker_id])}}">{{$val->getReceiverCustomer->full_name}}</a>
												</div>
											@else
												<div class="col mb-1 font-18 text-end">Sender {{$val->receiver_id}}</div>
											@endif
										</div>
										{{$val->message}}
									</div>
								</div>
							@empty
								<div class="alert alert-danger">Info! No messages found*</div>
							@endforelse
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script')
	<script>
		$(function () {
            var objDiv = document.getElementById("callHisHeight");
            objDiv.scrollTop = objDiv.scrollHeight;
        });
        function checkCustom(input) {
            $('.data--custom').hide();
            if ($(input).val()=='custom') { $('.data--custom').show('slow'); }
        }
	</script>
@endpush