<div class="row">
    @if(file_exists(public_path('customer_images/'.$customer->image)))
        <div class="col-2">
            <div class="custom-control custom-radio image-checkbox">
                <input type="radio" class="custom-control-input" id="image1" name="seo_image" value="{{asset('customer_images/'.$customer->image)}}">
                <label class="custom-control-label" for="image1">
                    <img src="{{asset('customer_images/'.$customer->image)}}" alt="Image 1" class="img-responsive" width="100%" height="180">
                </label>
            </div>
        </div>
    @endif
    @if(file_exists(public_path('customer_images/original_images/'.$customer->image)))
        <div class="col-2">
            <div class="custom-control custom-radio image-checkbox">
                <input type="radio" class="custom-control-input" id="image2" name="seo_image" value="{{asset('customer_images/original_images/'.$customer->image)}}">
                <label class="custom-control-label" for="image2">
                    <img src="{{asset('customer_images/original_images/'.$customer->image)}}" alt="Image 2" class="img-responsive" width="100%" height="180">
                </label>
            </div>
        </div>
    @endif
    @foreach($customer->customerImages as $key => $image)
        @if(file_exists(public_path('customer_images/'.$image->image)))
            <div class="col-2">
                <div class="custom-control custom-radio image-checkbox">
                    <input type="radio" class="custom-control-input" id="image{{$key+3}}" name="seo_image" value="{{asset('customer_images/'.$image->image)}}">
                    <label class="custom-control-label" for="image{{$key+3}}">
                        <img src="{{asset('customer_images/'.$image->image)}}" alt="Image {{$key+3}}" class="img-responsive" width="100%" height="180">
                    </label>
                </div>
            </div>
        @endif
    @endforeach
</div>