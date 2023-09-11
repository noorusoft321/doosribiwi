@extends('front.layouts.master')

@section('title','Public Notices')
@section('description', 'Public Notices')

@push('style')
    <style></style>
@endpush

@section('content')
    <div class="mt-xl-43"></div>

    <div class="container-xxl">
        <div class="d-grid w-md-80 w-xl-54 mb-10 mx-auto gap-12 mg-30">
            <h1 class="heading-section-3 text-center mb-0">Public Notices</h1>
            <img src="{{asset('home_page/heading-border.png')}}" class="img-align-center heading-border">
        </div>
    </div>
    <!-- /.heading-section -->
    <div class="container-xxl py-60 overflow-hidden overflow-xxl-visible">
        <div class="row">
            <div class="col-md-4 mg-30">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
        						<span class="ms-auto">
        							<a class="btn btn-outline-primary font-weight-600 mobile-width-49"
                                       href="#Urdu">Guide in Urdu</a>
        						</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mg-30">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
        						<span class="ms-auto">
        							<a class="btn btn-outline-primary font-weight-600 mobile-width-49"
                                       href="#English">Guide in English</a>
        						</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mg-30">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
        						<span class="ms-auto">
        							<a class="btn btn-outline-primary font-weight-600 mobile-width-49"
                                       href="#Careful">Very Careful from Such People</a>
        						</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl w-md-50 w-xl-54 py-60 overflow-hidden overflow-xxl-visible" id="Urdu">
        <div class="d-grid w-md-80 w-xl-54 mb-10 mx-auto gap-12">
            <h1 class="heading-section-3 text-center mb-0">Guide in Urdu</h1>
            <img src="{{asset('home_page/heading-border.png')}}" class="img-align-center heading-border">
        </div>
        <div class="row">
            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Shaadi-organization-paksitan-alert-warning-small.jpg"
                     alt="" class="c-img">
            </div>

            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Shaadi-Organization-Pakistan-Matchmaker-Guide-1.jpg"
                     alt="" class="c-img">
            </div>
            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Shaadi-Organization-Pakistan-Matchmaker-Guide-2.jpg"
                     alt="" class="c-img">
            </div>
            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Shaadi-Organization-Pakistan-Matchmaker-Guide-3.jpg"
                     alt="" class="c-img">
            </div>
            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Shaadi-Organization-Pakistan-Matchmaker-Guide-4.jpg"
                     alt="" class="c-img">
            </div>
            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Marriage-Bureau-Rishta-Pakistan-Alert.jpg"
                     alt="" class="c-img">
            </div>
        </div>
    </div>

    <div class="container-xxl w-md-50 w-xl-54 py-60 overflow-hidden overflow-xxl-visible" id="English">
        <div class="d-grid w-md-80 w-xl-54 mb-10 mx-auto gap-12">
            <h1 class="heading-section-3 text-center mb-0">Guide in English</h1>
            <img src="{{asset('home_page/heading-border.png')}}" class="img-align-center heading-border">
        </div>
        <div class="row">

            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Shaadi-organization-paksitan-alert-warning-eng-small.jpg"
                     alt="" class="c-img">
            </div>


            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Shaadi-Matchmakers-Guide-English-1.png"
                     alt="" class="c-img">
            </div>

            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Shaadi-Matchmakers-Guide-English-2.png"
                     alt="" class="c-img">
            </div>

            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Shaadi-Matchmakers-Guide-English-3.png"
                     alt="" class="c-img">
            </div>
            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Shaadi-Matchmakers-Guide-English-4.png"
                     alt="" class="c-img">
            </div>
            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Shaadi-Matchmakers-Guide-English-5.png"
                     alt="" class="c-img">
            </div>
            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Shaadi-Matchmakers-Guide-English-6.png"
                     alt="" class="c-img">
            </div>
            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Shaadi-Matchmakers-Guide-English-7.png"
                     alt="" class="c-img">
            </div>

        </div>
    </div>


    <div class="container-xxl w-md-50 w-xl-54 py-60 overflow-hidden overflow-xxl-visible" id="Careful">
        <div class="d-grid w-md-80 w-xl-54 mb-10 mx-auto gap-12">
            <h1 class="heading-section-3 text-center mb-0">Be Careful Such a Peoples</h1>
            <img src="{{asset('home_page/heading-border.png')}}" class="img-align-center heading-border">
        </div>
        <div class="row">
            <div class="col-md-12">
                <img src="{{asset('web_images')}}/Shaadi-Matchmakers-Public-Notice-Against-Fake-ID.jpg"
                     alt="" class="c-img">
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script></script>
@endpush