@if(!empty($customer->customerCareerInfo))
    <form id="careerInfoForm" class="row">
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Qualification</label>
                    </div>
                    <div class="col-md-8">
                        <select onchange="getMajorCourses(this,'major_course_id')" name="Qualification" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($educations as $val)
                                <option value="{{$val->id}}" {{($customer->customerCareerInfo->Qualification==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <label class="form-label">*Major Course</label>
                    </div>
                    <div class="col-md-8">
                        <select name="major_course_id" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($majorCourses as $val)
                                <option value="{{$val->id}}" {{($customer->customerCareerInfo->major_course_id==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <label class="form-label">*University</label>
                    </div>
                    <div class="col-md-8">
                        <select name="University" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($universities as $val)
                                <option value="{{$val->id}}" {{($customer->customerCareerInfo->University==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <select name="Profession" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($occupations as $val)
                                <option value="{{$val->id}}" {{($customer->customerCareerInfo->Profession==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <label class="form-label">*Job Post</label>
                    </div>
                    <div class="col-md-8">
                        <select name="JobPost" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($jobPosts as $val)
                                <option value="{{$val->id}}" {{($customer->customerCareerInfo->JobPost==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <label class="form-label">*Monthly Income</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MonthlyIncome" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($incomes as $val)
                                <option value="{{$val->id}}" {{($customer->customerCareerInfo->MonthlyIncome==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
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
                        <label class="form-label">*Future Plan</label>
                    </div>
                    <div class="col-md-8">
                        <select name="FuturePlans" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($futurePlans as $val)
                                <option value="{{$val->id}}" {{($customer->customerCareerInfo->FuturePlans==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@else
    <form id="careerInfoForm" class="row">
        <div class="col-md-6">
            <div class="form-group m-tb-20">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">*Qualification</label>
                    </div>
                    <div class="col-md-8">
                        <select onchange="getMajorCourses(this,'major_course_id')" name="Qualification" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($educations as $val)
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
                        <label class="form-label">*Major Course</label>
                    </div>
                    <div class="col-md-8">
                        <select name="major_course_id" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($majorCourses as $val)
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
                        <label class="form-label">*University</label>
                    </div>
                    <div class="col-md-8">
                        <select name="University" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($universities as $val)
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
                        <select name="Profession" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
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
                        <label class="form-label">*Job Post</label>
                    </div>
                    <div class="col-md-8">
                        <select name="JobPost" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($jobPosts as $val)
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
                        <label class="form-label">*Monthly Income</label>
                    </div>
                    <div class="col-md-8">
                        <select name="MonthlyIncome" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($incomes as $val)
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
                        <label class="form-label">*Future Plan</label>
                    </div>
                    <div class="col-md-8">
                        <select name="FuturePlans" class="form-select select-icon icon-mark form-select select-icon icon-mark form-control rounded-pill" >
                            <option value="">Select</option>
                            @foreach($futurePlans as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif