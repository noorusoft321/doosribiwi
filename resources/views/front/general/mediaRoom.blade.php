@extends('front.layouts.master')
@section('title','Media Room - Updates on Second Marriages')
@section('description', 'Stay updated on our endeavors promoting Islamic second marriages. Explore media coverage and resources in our dedicated media room.')

@push('style')
	{{--Style--}}
@endpush

@section('content')

<main>
	<div class="container-xxl">
		<br>
        <h2 class="align-center font-weight-600"> Media Room </h2>
       	<img class="img-align-center heading-border" src="{{asset('images/doosri-biwi-thin-border.png')}}">
       	<br>
		<div class="row justify-content-center">
			@foreach($mediaVideos as $val)
				<div class="col-md-4 mb-3">
					{!! $val !!}
				</div>
			@endforeach
		</div>
		<br>
	</div>
</main>

@endsection
@push('script')
@endpush