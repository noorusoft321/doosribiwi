@php
    $hobbiesArr = [];
    if(!empty($customer->customerOtherInfo) && !empty($customer->customerOtherInfo->hobbiesAndInterest)) {
        $hobbiesArr = explode(",",$customer->customerOtherInfo->hobbiesAndInterest);
    }
@endphp
<form id="interestForm" class="row">
    <div class="col-md-12 py-xl-10">
        <div class="row">
            @foreach($hobbies->chunk(4) as $result)
                @foreach($result as $val)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{$val->id}}" name="hobbiesAndInterest[]" id="hobbiesAndInterest{{$val->id}}"
                                    {{(in_array($val->id,$hobbiesArr)) ? 'checked' : ''}} >
                            <label class="form-check-label" for="hobbiesAndInterest{{$val->id}}">
                                {{$val->title}}
                            </label>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</form>