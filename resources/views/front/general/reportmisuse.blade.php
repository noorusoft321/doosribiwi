@extends('front.layouts.master')

@section('title','Report Misuse')
@section('description', 'Our policy is to take immediate action if any misuse of information or illicit activities is reported by any member on our marriage site.')

@push('style')
	<style></style>
@endpush

@section('content')
	<br>
	<div class="container-xxl py-60">
		{{--<div class="d-grid w-md-50 w-xl-80 mb-60 mx-auto gap-12">--}}
		{{--<h2 class="heading-section-3 text-dark text-center mb-0">Report Misuse </h2>--}}

		{{--</div>--}}
		<div class="d-grid w-md-50 w-xl-80 mb-60 mx-auto gap-12">
			<h2 class="heading-section-3 text-dark text-center mb-0">Report Misuse</h2>
			<img src="{{asset('home_page/heading-border.png')}}" class="img-align-center heading-border">
		</div>
		<!-- /.heading-section -->
		<div class="row w-xl-85 mx-auto">
			<div class="col-12 col-md-12 col-lg-12 my-12">
				<div class="card">
					<div class="card-body">
						<p>
							DoosriBiwi.com strongly believes in the safeguard of the members of the site and so it vows to protect their information required to get rishta at the time of registration. Any sort of misuse or misconduct can be reported to the site admin at info@DoosriBiwi.com. The admin shall make sure to respond and remove any threats to its members instantly.
						</p>

						<p>
							The site DoosriBiwi.com is not held responsible for any misuse or threat on the information shared by the members themselves. The site only provides a platform to bring together families and individuals for the purpose of marriage and not any obscene activity. Thus, the site cannot be held responsible in such regards.
						</p>

						{{--<p>    <strong>Phone:</strong> 021 348 308 11</p>--}}
						<p>    <strong>WhatsApp:</strong> +92-345-2444262</p>
						<p>    <strong>Email:</strong> info@DoosriBiwi.com</p>
						{{--<p>    <strong>Skype:</strong> DoosriBiwi.com</p>--}}
					</div>
				</div>
				<!-- /.card-icon-component -->
			</div>
			<!-- /.col -->
			<!-- /.col -->
		</div>




	</div>

@endsection

@push('script')
	<script></script>
@endpush