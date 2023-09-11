@if(!empty($customer->customerReligionInfo))
    <form id="religionInfoForm" class="row">
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels">*Religion</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Religions" onchange="getSects(this,'Sects')" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($religions as $val)
                                <option value="{{$val->id}}" {{($customer->customerReligionInfo->Religions==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <label class="fieldlabels">*Sect</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Sects" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($sects as $val)
                                <option value="{{$val->id}}" {{($customer->customerReligionInfo->Sects==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <label class="fieldlabels">*Do You Prefer Hijab</label>
                    </div>
                    <div class="col-md-8">
                        <select name="DoYouPreferHijabs" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($preferHijabs as $val)
                                <option value="{{$val->id}}" {{($customer->customerReligionInfo->DoYouPreferHijabs==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <label class="fieldlabels">*Do You Prefer Beard?</label>
                    </div>
                    <div class="col-md-8">
                        <select name="DoYouHaveBeards" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($beards as $val)
                                <option value="{{$val->id}}" {{($customer->customerReligionInfo->DoYouHaveBeards==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <label class="fieldlabels">* Are You Revert</label>
                    </div>
                    <div class="col-md-8">
                        <select name="AreYouReverts" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($reverts as $val)
                                <option value="{{$val->id}}" {{($customer->customerReligionInfo->AreYouReverts==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <label class="fieldlabels">* Do You Keep Halal</label>
                    </div>
                    <div class="col-md-8">
                        <select name="DoYouKeepHalal" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($halals as $val)
                                <option value="{{$val->id}}" {{($customer->customerReligionInfo->DoYouKeepHalal==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <label class="fieldlabels">*Do You Perform Salaah</label>
                    </div>
                    <div class="col-md-8">
                        <select name="DoYouPerformSalaah" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($performSalaahs as $val)
                                <option value="{{$val->id}}" {{($customer->customerReligionInfo->DoYouPerformSalaah==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@else
    <form id="religionInfoForm" class="row">
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="fieldlabels">*Religion</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Religions" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($religions as $val)
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
                        <label class="fieldlabels">*Sect</label>
                    </div>
                    <div class="col-md-8">
                        <select name="Sects" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($sects as $val)
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
                        <label class="fieldlabels">*Do You Prefer Hijab</label>
                    </div>
                    <div class="col-md-8">
                        <select name="DoYouPreferHijabs" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($preferHijabs as $val)
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
                        <label class="fieldlabels">*Do You Prefer Beard?</label>
                    </div>
                    <div class="col-md-8">
                        <select name="DoYouHaveBeards" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($beards as $val)
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
                        <label class="fieldlabels">* Are You Revert</label>
                    </div>
                    <div class="col-md-8">
                        <select name="AreYouReverts" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($reverts as $val)
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
                        <label class="fieldlabels">* Do You Keep Halal</label>
                    </div>
                    <div class="col-md-8">
                        <select name="DoYouKeepHalal" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($halals as $val)
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
                        <label class="fieldlabels">*Do You Perform Salaah</label>
                    </div>
                    <div class="col-md-8">
                        <select name="DoYouPerformSalaah" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($performSalaahs as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif