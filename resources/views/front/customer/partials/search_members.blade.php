@if(count($customers) > 0)
    <style>
        table.table-bordered table tr td {
            border: 1px solid #ccc !important;
        }
        .search-box b, .search-box strong {
            color: #ccc !important;
        }
    </style>
    @php $ifCustomerAuth = auth()->guard('customer')->check(); @endphp
@endif
@foreach($customers as $customer)
    @php $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'na').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'na').'-'.$customer->id; @endphp

    <strong class="search-box bg-blast">
        @php
            $customerMatchesPercentage = (!empty($ifCustomerAuth)) ? customerMatchesPercentage($customer) : 0;
            $verificationStatus = 'Not Verified';
            $verificationStatusColor = 'darkgrey';
            if (
                $customer->email_verified==1 &&
                $customer->mobile_verified==1 &&
                $customer->profile_pic_status==1 &&
                $customer->meeting_verification==1 &&
                $customer->age_verification==1 &&
                $customer->education_verification==1 &&
                $customer->location_verification==1 &&
                $customer->nationality_verification==1
            ) {
                $verificationStatus = 'Verified';
                $verificationStatusColor = 'green';
            }
        $profileComplete = checkProfileCompletePercent($customer);
        @endphp
        {{--@if($customer->featuredProfile==1)--}}
            {{--<a class="badge-corner1 badge-corner-yellow">--}}
                {{--<span>Featured</span>--}}
            {{--</a>--}}
        {{--@endif--}}

        @if($customer->featuredProfile==1)
            <a class="badge-corner1 badge-corner-blue">
                <span>Featured</span>
            </a>
        @endif

        {{--<a class="badge-corner2 badge-corner-yellow">--}}
            {{--<span>Premium</span>--}}
        {{--</a>--}}

        <div class="block block--style-3 list z-depth-1-top bg-blast" id="block_393" style="margin-bottom: 2rem;">
            <div class="block-image">
                <a class="LoginToView c-base-1" href="{{route('search.by.slug',[$uniqueProfileSlug])}}" style="cursor:pointer; ">
                    <div class="listing-image" style="background-image: url({{$customer->imageFullPath}});background-position: top;"></div>
                </a>
                @if(!empty($customer->package_id))
                    @if(!empty($customer->getCountryName) && in_array($customer->getCountryName->name,['Pakistan','NA']))
                        <div class="premium-button">Premium</div>
                    @else
                        <div class="premium-button">Abroad</div>
                    @endif
                @endif
            </div>
            <div class="block-title-wrapper">
                {{-- Profile Match % --}}
                {{--@if(!empty($ifCustomerAuth) && $customerMatchesPercentage > 0)--}}
                    {{--<span class="matchprofile">{{$customerMatchesPercentage}}% <br> <strong> Match </strong></span>--}}
                {{--@endif--}}
                {{-- Profile Complete % --}}
                {{--<span class="completeprofile">{{checkProfileCompletePercent($customer)}}%<br><strong>Complete</strong></span>--}}
                <strong>
                    <h3 class="heading heading-5 strong-500 mt-1">
                        <a class="LoginToView" href="{{route('search.by.slug',[$uniqueProfileSlug])}}" class="c-base-1 text-white" style="cursor:pointer;font-weight: 600;color: #fff;">{{$customer->full_name}}</a>
                    </h3>
                    {{-- Profile Complete % --}}
                    <div class="row">
                        <div class="col-auto mx-auto my-auto">
                            <span class="text-white" style="font-size: 14px;font-weight: 500;">Profile Complete</span>
                        </div>
                        <div class="col mx-auto my-auto">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-label="Success striped example" style="width: {{$profileComplete}}%;font-weight: 600;" aria-valuenow="{{$profileComplete}}" aria-valuemin="0" aria-valuemax="100">
                                    {{$profileComplete}}%
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="heading heading-xs c-gray-light text-uppercase strong-400"></h4>
                    <table class="table-striped table-bordered mb-2" style="font-size: 12px;">
                        <tbody>
                        <tr data-auth-user-type="">
                            <td width="120" height="30" style="padding-left: 5px;"><b>Age</b></td>
                            <td width="120" height="30" style="padding-left: 5px;" class="text-white">{{$customer->age}} Years old</td>
                            <td width="120" height="30" style="padding-left: 5px;"><b>Height</b></td>
                            <td width="120" height="30" style="padding-left: 5px;" class="text-white">
                                {{(!empty($customer->getHeightName)) ? $customer->getHeightName->name : 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td width="120" height="30" style="padding-left: 5px;"><b>Religion</b></td>
                            <td width="120" height="30" style="padding-left: 5px;" class="text-white">
                                {{(!empty($customer->getReligionName)) ? $customer->getReligionName->name : 'N/A'}}
                            </td>
                            <td width="120" height="30" style="padding-left: 5px;"><b>Caste / Sect</b></td>
                            <td width="120" height="30" data-sect-id="0" style="padding-left: 5px;" class="text-white">
                                {{(!empty($customer->getCasteName)) ? $customer->getCasteName->name : 'N/A'}} /
                                {{(!empty($customer->getSectName)) ? $customer->getSectName->name : 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td width="120" height="30" style="padding-left: 5px;"><b>Mother Tongue</b></td>
                            <td width="120" height="30" style="padding-left: 5px;" class="text-white">
                                {{(!empty($customer->getMotherTongueName)) ? $customer->getMotherTongueName->name : 'N/A'}}
                            </td>
                            <td width="120" height="30" style="padding-left: 5px;"><b>Marital Status</b></td>
                            <td width="120" height="30" style="padding-left: 5px;" class="text-white">
                                {{(!empty($customer->getMaritalStatusName)) ? $customer->getMaritalStatusName->name : 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td width="120" height="30" style="padding-left: 5px;"><b>Location</b></td>
                            <td height="30" style="padding-left: 5px;" class="text-white">
                                {{(!empty($customer->getCitiesName)) ? $customer->getCitiesName->name : 'N/A'}},
                                {{(!empty($customer->getCountryName)) ? $customer->getCountryName->name : 'N/A'}}
                            </td>
                            <td width="120" height="30" style="padding-left: 5px;"><b>Verification Status</b></td>
                            <td width="120" height="30" style="padding-left: 5px;" class="text-white">
                                <strong style="color:{{$verificationStatusColor}};font-weight: 600;font-size: 1rem;">{{$verificationStatus}}</strong>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </strong>
                <div class="row mb-2">
                    {{-- Profile Match % --}}
                    @if(!empty($ifCustomerAuth) && $customerMatchesPercentage > 0)
                        <div class="col my-auto text-center">
                            <button onclick="showProfileMatch(this,'{{$customerMatchesPercentage}}','{{route('search.by.slug',[$uniqueProfileSlug])}}','{{$customer->full_name}}')" class="custom-btn btn-match" title="Profile Match to You">{{$customerMatchesPercentage}}% Match</button>
                        </div>
                    @endif
                    <div class="col my-auto text-center">
                        <button onclick="window.location.href = '{{route('search.by.slug',[$uniqueProfileSlug])}}'" class="custom-btn btn-view-profile" title="View Profile Detail">View Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </strong>
@endforeach