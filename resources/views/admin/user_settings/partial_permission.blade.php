<div class="accordion" id="accordionExample">
    @foreach($routes as $key=>$route)
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading{{$route->id}}">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$route->id}}" aria-expanded="true" aria-controls="collapse{{$route->id}}">
                {{$route->route_name}}
            </button>
        </h2>
        <div id="collapse{{$route->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$route->id}}" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                @php $views = explode(',', $route->route_views) @endphp
                @foreach($views as $key2=>$val)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$val}}" name="modules[]" id="{{$val}}"
                                {{!empty($permissions)? (in_array($val, $permissions->decodedModules)? 'checked':'') : ''}} >
                        <label class="form-check-label" for="{{$val}}">
                            {{$val}}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>

<button type="button" onclick="saveAllPermission(this)" class="btn btn-primary ml-3 mt-3">Save Permission</button>