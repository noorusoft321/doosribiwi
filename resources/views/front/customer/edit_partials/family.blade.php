@if(!empty($customer->customerFamilyInfo))
    <form id="familyInfoForm" class="row">
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Father Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="fatherName" class="form-control rounded-pill" value="{{$customer->customerFamilyInfo->fatherName}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Father Profession</label>
                    </div>
                    <div class="col-md-8">
                        <select name="fatherProfession" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($occupations as $val)
                                <option value="{{$val->id}}" {{($customer->customerFamilyInfo->fatherProfession==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <label class="form-label">*Mother Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="motherName" class="form-control rounded-pill" value="{{$customer->customerFamilyInfo->motherName}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Mother Profession</label>
                    </div>
                    <div class="col-md-8">
                        <select name="motherProfession" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($occupations as $val)
                                <option value="{{$val->id}}" {{($customer->customerFamilyInfo->motherProfession==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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

                        <label class="form-label">* Total No. of Sister</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" name="totalNoOfSisters" class="form-control rounded-pill" value="{{$customer->customerFamilyInfo->totalNoOfSisters}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">* Total No. of Brother</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" name="totalNoOfBrothers" class="form-control rounded-pill" value="{{$customer->customerFamilyInfo->totalNoOfBrothers}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Married Sisters</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="marriedSisters" class="form-control rounded-pill" value="{{$customer->customerFamilyInfo->marriedSisters}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Married Brothers</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="marriedBrothers" class="form-control rounded-pill" value="{{$customer->customerFamilyInfo->marriedBrothers}}">
                    </div>
                </div>
            </div>
        </div>
    </form>
@else
    <form id="familyInfoForm" class="row">
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Father Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="fatherName" class="form-control rounded-pill" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Father Profession</label>
                    </div>
                    <div class="col-md-8">
                        <select name="fatherProfession" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($occupations as $val)
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
                        <label class="form-label">*Mother Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="motherName" class="form-control rounded-pill" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Mother Profession</label>
                    </div>
                    <div class="col-md-8">
                        <select name="motherProfession" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($occupations as $val)
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

                        <label class="form-label">* Total No. of Sister</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" name="totalNoOfSisters" class="form-control rounded-pill" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">* Total No. of Brother</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" name="totalNoOfBrothers" class="form-control rounded-pill" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Married Sisters</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="marriedSisters" class="form-control rounded-pill" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Married Brothers</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="marriedBrothers" class="form-control rounded-pill" >
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif