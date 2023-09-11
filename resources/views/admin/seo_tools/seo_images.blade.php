<div class="row">
    <div class="col">
        <input type="file" class="form-control" name="seo_images[]" id="seo_images" multiple>
    </div>
    <div class="col-auto text-end">
        <button onclick="saveSeoImages(this)" class="btn btn-outline-primary">Upload</button>
    </div>
</div>
<hr>
<div class="row">
    @foreach($files as $key => $file)
        @php $imageUrl = asset('gallery/'.$file->getFilename()); @endphp
        <div class="col-2">
            <div class="custom-control custom-radio image-checkbox">
                <input type="radio" class="custom-control-input" id="image{{$key+1}}" name="seo_image" value="{{$imageUrl}}">
                <label class="custom-control-label" for="image{{$key+1}}">
                    <img src="{{$imageUrl}}" alt="Image {{$key+1}}" class="img-responsive" width="100%" height="180">
                </label>
            </div>
        </div>
    @endforeach
</div>