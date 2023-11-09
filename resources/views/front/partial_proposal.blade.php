@foreach($customers as $k => $val)
    @php
        $countryName = (!empty($val->getCountryName)?$val->getCountryName->name:'NA');
        $countrySlug = strtolower($countryName);
        $countrySlug = str_replace(' ', '-', $countrySlug);
        $countrySlug = str_replace('/', '-', $countrySlug);
        $cityName = (!empty($val->getCitiesName)?$val->getCitiesName->name:'NA');
        $citySlug = strtolower($cityName);
        $citySlug = str_replace(' ', '-', $citySlug);
        $citySlug = str_replace('/', '-', $citySlug);
        $uniqueProfileSlug = $val->gender_name.'-proposal-'.$countrySlug.'-'.$citySlug.'-'.$val->faker_id;
        $fadeSpeed = 3000;
        if($k==0 || $k==4) {
            $fadeSpeed = 1000;
        }
        if($k==1 || $k==3) {
            $fadeSpeed = 2000;
        }
    @endphp
    <div class="col-lg d-sm-block d-xs-block p-10 mx-auto my-auto">
        <div class="profile-boxes"  data-aos="fade-up" data-aos-duration="{{($fadeSpeed)}}">
            @if($val->email_verified==1 &&
                $val->mobile_verified==1 &&
                $val->profile_pic_status==1 &&
                $val->meeting_verification==1 &&
                $val->age_verification==1 &&
                $val->education_verification==1 &&
                $val->location_verification==1 &&
                $val->nationality_verification==1)
                <a class="badge-corner2 badge-corner-red">
                    <span style="-ms-transform: rotate(313deg);-webkit-transform: rotate(313deg);transform: rotate(313deg);font-size: 11px !important;margin-left: -13px;font-weight: 600;">
                        Verified
                    </span>
                </a>
            {{--@elseif($val->email_verified==1 &&--}}
                {{--$val->mobile_verified==1 &&--}}
                {{--$val->profile_pic_status==1 &&--}}
                {{--$val->meeting_verification==1)--}}
                {{--<a class="badge-corner2 badge-corner-yellow">--}}
                    {{--<span style="-ms-transform: rotate(313deg);-webkit-transform: rotate(313deg);transform: rotate(313deg);font-size: 10px !important;margin-left: -14px;font-weight: 600;">--}}
                        {{--Semi Verified--}}
                    {{--</span>--}}
                {{--</a>--}}
            @else
                <a class="badge-corner2 badge-corner-default">
                    <span style="-ms-transform: rotate(313deg);-webkit-transform: rotate(313deg);transform: rotate(313deg);font-size: 10px !important;margin-left: -14px;font-weight: 600;">
                        Not Verified
                    </span>
                </a>
            @endif

            @if(!empty($val->featuredProfile==1))
                <a class="badge-corner3" style="background: linear-gradient(0deg, rgb(64, 168, 230) 0%, rgb(54, 184, 230) 100%);">
                    <span class="text-white">Featured</span>
                </a>
            @endif

            <div class="image-boxes">

                <img loading="lazy" src="{{$val->imageFullPath}}" alt="{{$val->full_name}}" >

                @if(!empty($val->package_id))
                    @if(in_array($countryName,['Pakistan','NA']))
                        <img class="featured-ribbon" src="{{asset('images/premium-ribbon.svg')}}" alt="Premium Account" >
                    @else
                        <img class="featured-ribbon" src="{{asset('images/abroad-ribbon.svg')}}" alt="Abroad Account" >
                    @endif
                @endif

            </div>
            <div class="profile-details-boxes">
                <h3>{{$val->full_name}}</h3>
                @if($val->age > 0 && $val->age != 'N/A')
                    <div class="row">
                        <div class="col-4 mx-auto my-auto text-center p-1">
                            <span class="profile-boxes-icons">
                                <i class="fa fa-child"></i>
                            </span>
                        </div>
                        <div class="col-8 mx-auto my-auto p-1 fs-card-text">
                            {{$val->age}} Years
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-4 mx-auto my-auto text-center p-1">
                        <span class="profile-boxes-icons">
                            <i class="fa fa-briefcase"></i>
                        </span>
                    </div>
                    <div class="col-8 mx-auto my-auto p-1 fs-card-text">
                        {{(!empty($val->getOccupationName)) ? $val->getOccupationName->name : 'Profession'}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mx-auto my-auto text-center p-1">
                        <span class="profile-boxes-icons">
                            <i class="fa-sharp fa-solid fa-location-dot"></i>
                        </span>
                    </div>
                    <div class="col-8 mx-auto my-auto p-1 fs-card-text">
                        {{$cityName.', '.$countryName}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mx-auto my-auto text-center p-1">
                        <div class="image-boxes-icon"><a class="LoginToView" href="{{route('messenger',$val->faker_id)}}"><i class="fa fa-phone"></i></a></div>
                    </div>
                    <div class="col-8 mx-auto my-auto p-1 fs-card-text">
                        <button onclick="window.location.href = '{{route('search.by.slug',[$uniqueProfileSlug])}}'" class="custom-btn btn-view-profile" title="View Profile Detail">Profile Detail</button>
                    </div>
                </div>
                <div class="pb-1"></div>
            </div>
        </div>
    </div>
@endforeach

<script>
    AOS.init();
</script>