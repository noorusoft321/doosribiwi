@if(!empty($customer->customerOtherInfo))
    <form id="personalInfoForm" class="row">
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Country Of Origin</label>
                    </div>
                    <div class="col-md-8">
                        <select name="CountryOfOrigin" onchange="getStates(this,'StateOfOrigin')" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($countries as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->CountryOfOrigin==$val->id) ? 'selected' : ''}}>{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels">*State Of Origin</label>
                    </div>
                    <div class="col-md-8">
                        <select name="StateOfOrigin" onchange="getCities(this,'CityOfOrigin')" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value=""> Select</option>
                            @foreach($states as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->StateOfOrigin==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels">*City Of Origin</label>
                    </div>
                    <div class="col-md-8">
                        <select name="CityOfOrigin" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value=""> Select</option>
                            @foreach($cities as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->CityOfOrigin==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Willing To Relocate</label>
                    </div>
                    <div class="col-md-8">
                        <select name="WillingToRelocate" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($willingToRelocate as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->WillingToRelocate==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*I Am Looking To Marry</label>
                    </div>
                    <div class="col-md-8">
                        <select name="IAmLookingToMarry" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($lookingToMarry as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->IAmLookingToMarry==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*My Living Arrangement</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MyLivingArrangements" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($livingArrangement as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->MyLivingArrangements==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Height</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Heights" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($heights as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->Heights==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Weight</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Weights" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($weights as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->Weights==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Complexion</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Complexions" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($complexions as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->Complexions==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*My Build</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MyBuilds" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($myBuilds as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->MyBuilds==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Hair Color</label>
                    </div>
                    <div class="col-md-8">
                        <select name="HairColors" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($hairColors as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->HairColors==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Eye Color</label>
                    </div>
                    <div class="col-md-8">
                        <select name="EyeColors" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($eyeColors as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->EyeColors==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Smoke</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Smokes" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($smokes as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->Smokes==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Disability</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Disabilities" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($disabilities as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->Disabilities==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Caste</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Caste" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($castes as $val)
                                <option value="{{$val->id}}" {{($customer->customerPersonalInfo->Caste==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Mother Tongue</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MyFirstLanguageMotherTonguesID" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($tongues as $val)
                                <option value="{{$val->id}}" {{($customer->customerOtherInfo->MyFirstLanguageMotherTonguesID==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@else
    <form id="personalInfoForm" class="row">
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Country Of Origin</label>
                    </div>
                    <div class="col-md-8">
                        <select onchange="getStates(this,'StateOfOrigin')" name="CountryOfOrigin" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($countries as $val)
                                <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels">*State Of Origin</label>
                    </div>
                    <div class="col-md-8">
                        <select onchange="getCities(this,'CityOfOrigin')" name="StateOfOrigin" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value=""> Select</option>
                            @foreach($states as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels">*City Of Origin</label>
                    </div>
                    <div class="col-md-8">
                        <select name="CityOfOrigin" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value=""> Select</option>
                            @foreach($cities as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Willing To Relocate</label>
                    </div>
                    <div class="col-md-8">
                        <select name="WillingToRelocate" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($willingToRelocate as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*I Am Looking To Marry</label>
                    </div>
                    <div class="col-md-8">
                        <select name="IAmLookingToMarry" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($lookingToMarry as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*My Living Arrangement</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MyLivingArrangements" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($livingArrangement as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Height</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Heights" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($heights as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Weight</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Weights" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($weights as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Complexion</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Complexions" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($complexions as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*My Build</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MyBuilds" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($myBuilds as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Hair Color</label>
                    </div>
                    <div class="col-md-8">
                        <select name="HairColors" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($hairColors as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Eye Color</label>
                    </div>
                    <div class="col-md-8">
                        <select name="EyeColors" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($eyeColors as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Smoke</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Smokes" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($smokes as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Disability</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Disabilities" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($disabilities as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Caste</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Caste" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($castes as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Mother Tongue</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MyFirstLanguageMotherTonguesID" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($tongues as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif