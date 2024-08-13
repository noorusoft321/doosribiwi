@extends('front.layouts.master')
@section('title',$title)
@section('description', $title)

@push('style')
@endpush

@section('content')

<main>
	<div class="dashboard">
		<div class="container">
			<div class="row">
				<div class="col-md-3 side-bar-dashboard">
                    @include('front.customer.partials.sidebar')
				</div>
				<div class="col-md-9 main-dashboard">
                    {{--Edit Personal Info - Office Use Only--}}
                    <div class="card">
                        <h5 class="card-header">Edit Personal Info - Office Use Only</h5>
                        <div class="card-body">
                            <div class="row">
                                {{--<div class="col-lg-3 col-md-3 col-sm-6 py-xl-10">--}}
                                    {{--<label class="fieldlabels">UserName</label>--}}
                                {{--</div>--}}
                                <div class="col-lg-9 col-md-9 col-sm-6 py-xl-10">
                                    <label class="fieldlabels">{{$customer->name}}</label>
                                </div>
                                <hr class="edit-profile-hr">
                                <div class="col-lg-3 col-md-3 col-sm-6 py-xl-10">
                                    <label class="fieldlabels">Email</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-6 py-xl-10">
                                    <label class="fieldlabels">{{$customer->email}}</label>
                                </div>
                                <hr class="edit-profile-hr">
                                <div class="col-lg-3 col-md-3 col-sm-6 py-xl-10">
                                    <label class="fieldlabels">City</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-6 py-xl-10">
                                    <label class="fieldlabels">{{(!empty($customer->getCitiesName)) ? $customer->getCitiesName->name : 'N/A'}}</label>
                                </div>
                                <hr class="edit-profile-hr">
                                <div class="col-lg-3 col-md-3 col-sm-6 py-xl-10">
                                    <label class="fieldlabels">County</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-6 py-xl-10">
                                    <label class="fieldlabels">{{(!empty($customer->getCountryName)) ? $customer->getCountryName->name : 'N/A'}}</label>
                                </div>
                                <hr class="edit-profile-hr">
                                <div class="col-lg-3 col-md-3 col-sm-6 py-xl-10">
                                    <label class="fieldlabels">Date of Birth</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-6 py-xl-10">
                                    <label class="fieldlabels"> {{(!empty($customer->customerOtherInfo)) ? date('d M Y', strtotime($customer->customerOtherInfo->DOB)) : 'N/A'}} ( age {{$customer->age}} )</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Update your Profile--}}
					<div class="card">
                        <h5 class="card-header">Update your Profile</h5>
                        <div class="card-body">
                            <form id="customerInfoForm">
                                <div class="row">
                                    <div class="col-md-6 m-tb-20">
                                        <div class="form-group">
                                            <div class="row mx-auto">
                                                <div class="col-md-4">
                                                    <label class="form-label" for="first_name">* First Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="first_name" id="first_name" value="{{$customer->first_name}}" class="form-control rounded-pill">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 m-tb-20">
                                        <div class="form-group">
                                            <div class="row mx-auto">
                                                <div class="col-md-4">
                                                    <label class="form-label" for="last_name">* Last Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="last_name" id="last_name" value="{{$customer->last_name}}" class="form-control rounded-pill">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 m-tb-20">
                                        <div class="form-group">
                                            <div class="row mx-auto">
                                                <div class="col-md-4">
                                                    <label class="fieldlabels" for="country_id">* Country?</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select onchange="getStates(this,'state_id')" name="country_id" id="country_id" class="form-select form-control rounded-pill">
                                                        <option value="">Select</option>
                                                        @foreach($countries as $val)
                                                            <option value="{{$val->id}}" {{(!empty($customer->customerOtherInfo) && $customer->customerOtherInfo->country_id==$val->id) ? 'selected' : ''}}>{{$val->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6 m-tb-20">
                                        <div class="form-group">
                                            <div class="row mx-auto">
                                                <div class="col-md-4">
                                                    <label class="fieldlabels" for="state_id">* State </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select onchange="getCities(this,'city_id')" name="state_id" id="state_id" class="form-select form-control rounded-pill" >
                                                        <option value="">Select</option>
                                                        @foreach($states as $val)
                                                            <option value="{{$val->id}}" {{(!empty($customer->customerOtherInfo) && $customer->customerOtherInfo->state_id==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 m-tb-20">
                                        <div class="form-group">
                                            <div class="row mx-auto">
                                                <div class="col-md-4">
                                                    <label class="fieldlabels" for="city_id">* City</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select onchange="getAreas(this,'area_id')" name="city_id" id="city_id" class="form-select form-control rounded-pill" >
                                                        <option value="">Select</option>
                                                        @foreach($cities as $val)
                                                            <option value="{{$val->id}}" {{(!empty($customer->customerOtherInfo) && $customer->customerOtherInfo->city_id==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 m-tb-20">
                                        <div class="form-group">
                                            <div class="row mx-auto">
                                                <div class="col-md-4">
                                                    <label class="fieldlabels" for="area_id">Area</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="area_id" id="area_id" class="form-select form-control rounded-pill" >
                                                        <option value="">Select</option>
                                                        @foreach($areas as $val)
                                                            <option value="{{$val->id}}" {{(!empty($customer->customerOtherInfo) && $customer->customerOtherInfo->area_id==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 m-tb-20">
                                        <div class="row mx-auto">
                                            <div class="col-md-4">
                                                <label class="form-label" for="post_zip_code">* Post/Zip Code</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="post_zip_code" id="post_zip_code" value="{{(!empty($customer->customerOtherInfo)) ? $customer->customerOtherInfo->post_zip_code : ''}}" class="form-control rounded-pill">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 m-tb-20">
                                        <div class="form-group">
                                            <div class="row mx-auto">
                                                <div class="col-md-4">
                                                    <label class="fieldlabels" for="MaritalStatusID">* Marital Status?</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="MaritalStatusID" id="MaritalStatusID" class="form-select form-control rounded-pill">
                                                        <option value="">Select</option>
                                                        @foreach($maritalStatuses as $val)
                                                            <option value="{{$val->id}}" {{(!empty($customer->customerOtherInfo) && $customer->customerOtherInfo->MaritalStatusID==$val->id) ? 'selected' : ''}}>{{$val->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 m-tb-20">
                                        <div class="form-group">
                                            <div class="row mx-auto">
                                                <div class="col-md-4">
                                                    <label class="fieldlabels" for="DOB">* Your Date of Birth</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="date" name="DOB" id="DOB" class="form-control rounded-pill" value="{{(!empty($customer->customerOtherInfo)) ? $customer->customerOtherInfo->DOB : ''}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-tb-20">
                                        <div class="form-group">
                                            <div class="row mx-auto">
                                                <div class="col-md-2">
                                                    <label class="fieldlabels" for="childrenQuantity">* Children Quantity</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="number" name="childrenQuantity" id="childrenQuantity" class="form-control rounded-pill" value="{{(!empty($customer->customerOtherInfo)) ? $customer->customerOtherInfo->childrenQuantity : ''}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-tb-20">
                                        <div class="form-group">
                                            <label class="form-label" for="address">* Address</label>
                                            <textarea class="form-control" rows="5" name="address" id="address">{{(!empty($customer->customerOtherInfo)) ? $customer->customerOtherInfo->address : ''}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-tb-20">
                                        <div class="form-group">
                                            <label class="fieldlabels" for="divorceReason">* Divorce Reason</label>
                                            <textarea class="form-control" rows="5" name="divorceReason" id="divorceReason">{{(!empty($customer->customerOtherInfo)) ? $customer->customerOtherInfo->divorceReason : ''}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 text-end">
                                        <button onclick="saveRecord(this)" type="button" class="button-theme-dark">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
				</div>		
			</div>
		</div>
	</div>
</main>

@endsection

@push('script')
    <script>
        function saveRecord(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('save.personal.info')}}", $('#customerInfoForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#customerInfoForm :input[name="' + k + '"]').addClass("has-error");
                        $('#customerInfoForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }
    </script>
@endpush