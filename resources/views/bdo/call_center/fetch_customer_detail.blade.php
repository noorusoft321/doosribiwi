<div class="row">
    <div class="col-auto my-auto">
        <div class="circle--image">
            @if(file_exists(public_path('customer-images/original_images/'.$customer->image)))
                <a href="{{asset('customer-images/original_images/'.$customer->image)}}" target="_blank"><img src="{{asset('customer-images/original_images/'.$customer->image)}}" class="rounded-circle" alt="{{$customer->full_name}}"></a>
                <a href="{{asset('customer-images/'.$customer->image)}}" target="_blank"><img src="{{asset('customer-images/'.$customer->image)}}" class="rounded-circle" alt="{{$customer->full_name}}"></a>
            @elseif(file_exists(public_path('customer-images/'.$customer->image)))
                <a href="{{asset('customer-images/'.$customer->image)}}" target="_blank"><img src="{{asset('customer-images/'.$customer->image)}}" class="rounded-circle" alt="{{$customer->full_name}}"></a>
            @else
                <a href="{{$customer->imageFullPath}}" target="_blank"><img src="{{$customer->imageFullPath}}" class="rounded-circle" alt="{{$customer->full_name}}"></a>
            @endif
        </div>
    </div>
    <input type="hidden" name="customer_id" value="{{$customer->id}}">
    <div class="col my-auto">
        <h4>{{$customer->full_name}}</h4>
        <p class="mt-2">{{$customer->email}}</p>
        <p class="mt-2">{{$customer->mobile}}</p>
        <p class="mt-2">{{$customer->name}}</p>
    </div>
</div>
<div class="form-group my-3">
    <label for="approved_by">Payment Approved By</label>
    <select name="approved_by" id="approved_by" class="form-control">
        <option value=""> -- Select -- </option>
        <option value="Madam">Madam</option>
        <option value="Sir">Sir</option>
        <option value="Both">Both</option>
    </select>
</div>
<div class="text-end">
    <button type="button" onclick="sendPackageRequest(this)" class="btn btn-outline-primary">Send Request</button>
</div>