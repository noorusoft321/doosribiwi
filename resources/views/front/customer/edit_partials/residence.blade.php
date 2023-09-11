@if(!empty($customer->customerResidentialInfo))
    <form id="residenseInfoForm" class="row">
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Residence Status</label>
                    </div>
                    <div class="col-md-8">
                        <select name="ResidenceStatus" class="form-select form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($residenceStatuses as $val)
                                <option value="{{$val->id}}" {{($customer->customerResidentialInfo->ResidenceStatus==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <label class="form-label">*House Size</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control rounded-pill" name="HouseSize" value="{{$customer->customerResidentialInfo->HouseSize}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Residence Area</label>
                    </div>
                    <div class="col-md-8">
                        <select name="ResidenceArea" class="form-select form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($residenceAreas as $val)
                                <option value="{{$val->id}}" {{($customer->customerResidentialInfo->ResidenceArea==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <label class="form-label">*Family Status</label>
                    </div>
                    <div class="col-md-8">
                        <select name="FamilyValues" class="form-select form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($familyValues as $val)
                                <option value="{{$val->id}}" {{($customer->customerResidentialInfo->FamilyValues==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-2">
                        <label class="form-label">* Complete Address</label>
                    </div>
                    <div class="col-md-10">
                        <textarea name="CompleteAddress" class="form-control" rows="3">{{$customer->customerResidentialInfo->CompleteAddress}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
@else
    <form id="residenseInfoForm" class="row">
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Residence Status</label>
                    </div>
                    <div class="col-md-8">
                        <select name="ResidenceStatus" class="form-select form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($residenceStatuses as $val)
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
                        <label class="form-label">*House Size</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control rounded-pill" name="HouseSize" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Residence Area</label>
                    </div>
                    <div class="col-md-8">
                        <select name="ResidenceArea" class="form-select form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($residenceAreas as $val)
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
                        <label class="form-label">*Family Status</label>
                    </div>
                    <div class="col-md-8">
                        <select name="FamilyValues" class="form-select form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($familyValues as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-2">
                        <label class="form-label">* Complete Address</label>
                    </div>
                    <div class="col-md-10">
                        <textarea name="CompleteAddress" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif