@if(!empty($customer->customerSearch) && $customer->customerSearch->title)
    @php $customerSearch = json_decode($customer->customerSearch->title) @endphp
    <form id="expectationForm" class="row">
        <div class="col-md-12 m-tb-20">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="fieldlabels"> Gender </label>
                            </div>
                            <div class="col-md-8">
                                <fieldset>
                                    <input id="male" class="radio-inline__input" type="radio" name="gender" value="1"
                                            {{(isset($customerSearch->gender) && $customerSearch->gender==1) ? 'checked' : ''}}
                                            {{($customer->gender_name=='Male') ? 'disabled' : ''}}
                                    >
                                    <label class="radio-inline__label" for="male">
                                        Male
                                    </label>

                                    <input id="female" class="radio-inline__input" type="radio" name="gender" value="2"
                                            {{(isset($customerSearch->gender) && $customerSearch->gender==2) ? 'checked' : ''}}
                                            {{($customer->gender_name=='Female') ? 'disabled' : ''}}
                                    >
                                    <label class="radio-inline__label" for="female">
                                        Female
                                    </label>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Age From </label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="ageFrom" >
                            <option value="">Select</option>
                            @for($i=18; $i<=100; $i++)
                                <option value="{{$i}}" {{(isset($customerSearch->ageFrom) && $customerSearch->ageFrom==$i) ? 'selected' : ''}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Age To </label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="ageTo" >
                            <option value="">Select</option>
                            @for($i=18; $i<=100; $i++)
                                <option value="{{$i}}" {{(isset($customerSearch->ageTo) && $customerSearch->ageTo==$i) ? 'selected' : ''}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Country </label>
                    </div>
                    <div class="col-md-8">
                        <select onchange="getStates(this,'state_id','Any')" class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="country_id" >
                            <option value="">Select</option>
                            @foreach($countries as $val)
                                <option value="{{$val->id}}" {{(isset($customerSearch->country_id) && $customerSearch->country_id==$val->id) ? 'selected' : ''}}>{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> State </label>
                    </div>
                    <div class="col-md-8">
                        <select onchange="getCities(this,'city_id','Any')" class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="state_id" >
                            <option value="0">Any</option>
                            @foreach($expStates as $val)
                                <option value="{{$val->id}}" {{(isset($customerSearch->state_id) && $customerSearch->state_id==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> City </label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="city_id" >
                            <option value="0">Any</option>
                            @foreach($expCities as $val)
                                <option value="{{$val->id}}" {{(isset($customerSearch->city_id) && $customerSearch->city_id==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Tongue</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Tongue" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="0">Any</option>
                            @foreach($tongues as $val)
                                <option value="{{$val->id}}" {{(isset($customerSearch->Tongue) && $customerSearch->Tongue==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Religiousness </label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="Religions" >
                            <option value=""> Select</option>
                            @foreach($religions as $val)
                                <option value="{{$val->id}}" {{(isset($customerSearch->Religions) && $customerSearch->Religions==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Sect </label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="Sects" >
                            <option value="0">Any</option>
                            @foreach($sects as $val)
                                <option value="{{$val->id}}" {{(isset($customerSearch->Sects) && $customerSearch->Sects==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Qualification </label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="EducationID" >
                            <option value="0">Any</option>
                            @foreach($educations as $val)
                                <option value="{{$val->id}}" {{(isset($customerSearch->EducationID) && $customerSearch->EducationID==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Profession</label>
                    </div>
                    <div class="col-md-8">
                        <select name="OccupationID" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="0">Any</option>
                            @foreach($occupations as $val)
                                <option value="{{$val->id}}" {{(isset($customerSearch->OccupationID) && $customerSearch->OccupationID==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{--<div class="col-md-6 m-tb-20">--}}
            {{--<div class="form-group">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-4">--}}
                        {{--<label class="fieldlabels"> Willing To Relocate</label>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-8">--}}
                        {{--<select name="WillingToRelocate" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >--}}
                            {{--<option value=""> Select</option>--}}
                            {{--@foreach($willingToRelocate as $val)--}}
                                {{--<option value="{{$val->id}}" {{(isset($customerSearch->WillingToRelocate) && $customerSearch->WillingToRelocate==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Income</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MyIncome" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="0">Any</option>
                            @foreach($incomes as $val)
                                <option value="{{$val->id}}" {{(isset($customerSearch->MyIncome) && $customerSearch->MyIncome==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Marital Status</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MaritalStatus" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="0">Any</option>
                            @foreach($maritalStatuses as $val)
                                <option value="{{$val->id}}" {{(isset($customerSearch->MaritalStatus) && $customerSearch->MaritalStatus==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Living Arrangements</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MyLivingArrangements" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="">Select</option>
                            @foreach($livingArrangement as $val)
                                <option value="{{$val->id}}" {{(isset($customerSearch->MyLivingArrangements) && $customerSearch->MyLivingArrangements==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Heights</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Heights" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="0">Any</option>
                            @foreach($heights as $val)
                                <option value="{{$val->id}}" {{(isset($customerSearch->Heights) && $customerSearch->Heights==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{--<div class="col-md-6 m-tb-20">--}}
            {{--<div class="form-group">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-4">--}}
                        {{--<label class="fieldlabels"> Builds</label>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-8">--}}
                        {{--<select name="MyBuilds" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >--}}
                            {{--<option value="">Select</option>--}}
                            {{--@foreach($myBuilds as $val)--}}
                                {{--<option value="{{$val->id}}" {{(isset($customerSearch->MyBuilds) && $customerSearch->MyBuilds==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Disabilities</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Disabilities" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="">Select</option>
                            @foreach($disabilities as $val)
                                <option value="{{$val->id}}" {{(isset($customerSearch->Disabilities) && $customerSearch->Disabilities==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Caste</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Castes" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="0">Any</option>
                            @foreach($castes as $val)
                                <option value="{{$val->id}}" {{(isset($customerSearch->Castes) && $customerSearch->Castes==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@else
    <form id="expectationForm" class="row">
        <div class="col-md-12 m-tb-20">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="fieldlabels"> Gender </label>
                            </div>
                            <div class="col-md-8">
                                <fieldset>
                                    <input id="male" class="radio-inline__input" type="radio" name="gender" value="1"
                                            {{($customer->gender_name=='Male') ? 'disabled' : ''}}
                                    >
                                    <label class="radio-inline__label" for="male">
                                        Male
                                    </label>

                                    <input id="female" class="radio-inline__input" type="radio" name="gender" value="2"
                                            {{($customer->gender_name=='Female') ? 'disabled' : ''}}
                                    >
                                    <label class="radio-inline__label" for="female">
                                        Female
                                    </label>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Age From </label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="ageFrom" >
                            <option value="">Select</option>
                            @for($i=18; $i<=100; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Age To </label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="ageTo" >
                            <option value="">Select</option>
                            @for($i=18; $i<=100; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Country </label>
                    </div>
                    <div class="col-md-8">
                        <select onchange="getStates(this,'state_id')" class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="country_id" >
                            <option value="">Select</option>
                            @foreach($countries as $val)
                                <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> State </label>
                    </div>
                    <div class="col-md-8">
                        <select onchange="getCities(this,'city_id')" class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="state_id" >
                            <option value="0">Any</option>
                            @foreach($expStates as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> City </label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="city_id" >
                            <option value="0">Any</option>
                            @foreach($expCities as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Tongue</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Tongue" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="0">Any</option>
                            @foreach($tongues as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Religiousness </label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="Religions" >
                            <option value=""> Select</option>
                            @foreach($religions as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Sect </label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="Sects" >
                            <option value="0">Any</option>
                            @foreach($sects as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Qualification </label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-select select-icon icon-mark form-control from-tab rounded-pill" name="EducationID" >
                            <option value="0">Any</option>
                            @foreach($educations as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Profession</label>
                    </div>
                    <div class="col-md-8">
                        <select name="OccupationID" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="0">Any</option>
                            @foreach($occupations as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{--<div class="col-md-6 m-tb-20">--}}
            {{--<div class="form-group">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-4">--}}
                        {{--<label class="fieldlabels"> Willing To Relocate</label>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-8">--}}
                        {{--<select name="WillingToRelocate" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >--}}
                            {{--<option value=""> Select</option>--}}
                            {{--@foreach($willingToRelocate as $val)--}}
                                {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Income</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MyIncome" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="0">Any</option>
                            @foreach($incomes as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Marital Status</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MaritalStatus" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="0">Any</option>
                            @foreach($maritalStatuses as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Living Arrangements</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MyLivingArrangements" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="">Select</option>
                            @foreach($livingArrangement as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Heights</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Heights" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="0">Any</option>
                            @foreach($heights as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{--<div class="col-md-6 m-tb-20">--}}
            {{--<div class="form-group">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-4">--}}
                        {{--<label class="fieldlabels"> Builds</label>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-8">--}}
                        {{--<select name="MyBuilds" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >--}}
                            {{--<option value="">Select</option>--}}
                            {{--@foreach($myBuilds as $val)--}}
                                {{--<option value="{{$val->id}}">{{$val->title}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Disabilities</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Disabilities" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="">Select</option>
                            @foreach($disabilities as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 m-tb-20">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels"> Caste</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Castes" class="form-select select-icon icon-mark form-control from-tab rounded-pill" >
                            <option value="0">Any</option>
                            @foreach($castes as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif