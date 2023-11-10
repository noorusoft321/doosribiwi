<div class="card">
    <h5 class="card-header">{{$pageTitle}}</h5>
    <div class="card-body">
        @forelse($customers as $val)
            @php $uniqueProfileSlug = $val->gender_name.'-proposal-'.(!empty($val->getCitySlug)?$val->getCitySlug->slug:'na').'-'.(!empty($val->getCountrySlug)?$val->getCountrySlug->slug:'na').'-'.$val->faker_id; @endphp
            <a target="_blank" href="{{route('search.by.slug',[$uniqueProfileSlug])}}" class="container-image">
                <img src="{{$val->imageFullPath}}" alt="{{$val->full_name}}">
                <div class="overlay"><div class="text">{{$val->full_name}}</div></div>
            </a>
        @empty
            <div class="alert alert-danger">Info! No profiles found</div>
        @endforelse
    </div>
</div>