<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shaadi.org.pk</title>
</head>
<body>
<select name="country_name" id="country_name">
    <option value="">Select</option>
    @foreach($countries as $key => $val)
        <option value="{{$val}}" {{($key==0) ? 'selected' : ''}}>{{$val}}</option>
    @endforeach
</select>

<script type="text/javascript">
    function checkCountries() {
        let countryName = document.getElementById("country_name").value;
        if (countryName) {
            countryName = encodeURI(countryName);
            window.location.href = `{{route('fetch.states.and.cities')}}/${countryName}`;
        }
    }
    document.addEventListener("DOMContentLoaded", () => {
        setTimeout(function () {
            checkCountries();
        },5000);
    });
</script>
</body>
</html>