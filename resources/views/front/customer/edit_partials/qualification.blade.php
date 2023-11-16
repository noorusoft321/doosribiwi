@if(!empty($customer->customerOtherInfo))
    <form id="educationInfoForm" class="row">
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">* Qualification</label>
                    </div>
                    <div class="col-md-8">
                        <select name="EducationID" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($educations as $val)
                                <option value="{{$val->id}}" {{($customer->customerOtherInfo->EducationID==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
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
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Profession</label>
                    </div>
                    <div class="col-md-8">
                        <select name="OccupationID" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($occupations as $val)
                                <option value="{{$val->id}}" {{($customer->customerOtherInfo->OccupationID==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Father Tongue</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MySecondLanguageMotherTonguesID" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($tongues as $val)
                                <option value="{{$val->id}}" {{($customer->customerOtherInfo->MySecondLanguageMotherTonguesID==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@else
    <form id="educationInfoForm" class="row">
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">* Qualification</label>
                    </div>
                    <div class="col-md-8">
                        <select name="EducationID" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($educations as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
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
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Profession</label>
                    </div>
                    <div class="col-md-8">
                        <select name="OccupationID" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($occupations as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Father Tongue</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MySecondLanguageMotherTonguesID" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
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