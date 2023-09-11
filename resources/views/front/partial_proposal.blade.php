@foreach($customers as $val)
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
    @endphp
    <div class="col-md-4 p-10">
        <div class="profile-boxes">
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
            @elseif($val->email_verified==1 &&
                $val->mobile_verified==1 &&
                $val->profile_pic_status==1 &&
                $val->meeting_verification==1)
                <a class="badge-corner2 badge-corner-yellow">
                    <span style="-ms-transform: rotate(313deg);-webkit-transform: rotate(313deg);transform: rotate(313deg);font-size: 10px !important;margin-left: -14px;font-weight: 600;">
                        Semi Verified
                    </span>
                </a>
            @else
                <a class="badge-corner2 badge-corner-default">
                    <span style="-ms-transform: rotate(313deg);-webkit-transform: rotate(313deg);transform: rotate(313deg);font-size: 10px !important;margin-left: -14px;font-weight: 600;">
                        Not Verified
                    </span>
                </a>
            @endif

            @if(!empty($val->package_id))
                <a class="badge-corner3" style="background: {{$val->user_package_color}};">
                    <span>{{$val->user_package}}</span>
                </a>
            @else
                <a class="badge-corner3" style="background: #040F2E;">
                    <span>Free</span>
                </a>
            @endif

            <div class="row">
                <div class="col-5 my-auto">
                    <div class="image-boxes">
                        <img loading="lazy" src="{{$val->imageFullPath}}" alt="{{$val->full_name}}" >
                        <span><a class="LoginToView" href="{{route('messenger',$val->name)}}"><i class="fa fa-phone"></i></a></span>
                    </div>
                </div>
                <div class="col-7 my-auto">
                    <div class="profile-details-boxes">
                        <h3 class="text-theme">{{$val->full_name}}</h3>
                        @if($val->age > 0 && $val->age != 'N/A')
                            <div class="row">
                                <div class="col-2 text-center">
                                    <span class="profile-boxes-icons">
                                        <i class="fa fa-child"></i>
                                    </span>
                                </div>
                                <div class="col-10" style="padding-left: 0;color: #343434;font-weight: 500;font-size: 15px;">
                                    {{$val->age}} Years
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-2 text-center">
                                <span class="profile-boxes-icons">
                                    <i class="fa fa-briefcase"></i>
                                </span>
                            </div>
                            <div class="col-10" style="padding-left: 0;color: #343434;font-weight: 500;font-size: 15px;">
                                {{(!empty($val->getOccupationName)) ? $val->getOccupationName->name : 'Profession'}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-center">
                                <span class="profile-boxes-icons">
                                    <i class="fa-sharp fa-solid fa-location-dot"></i>
                                </span>
                            </div>
                            <div class="col-10" style="padding-left: 0;color: #343434;font-weight: 500;font-size: 15px;">
                                {{$cityName.', '.$countryName}}
                            </div>
                        </div>
                        <div class="text-start pt-2">
                            <button onclick="window.location.href = '{{route('search.by.slug',[$uniqueProfileSlug])}}'" class="custom-btn btn-view-profile" title="View Profile Detail">Profile Detail</button>
                            {{--<a href="{{route('search.by.slug',[$uniqueProfileSlug])}}" class="btn btn-outline-primary font-weight-600 font-size14">Profile Detail</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach