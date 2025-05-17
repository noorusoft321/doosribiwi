<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <title>DoosriBiwi.com</title>
    <style>
        table td {
            width: 50%;
        }
        tr {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<div class="row">
    @foreach($customers as $result)
        <div class="col-md-6">
            <table class="table table-bordered">
                <tbody>
                @foreach($result as $val)
                    <tr>
                        <td>{{$val['full_name']}}</td>
                        <td>{{($val['mobile_country_code'] > 0) ? "(+".$val['mobile_country_code'].") - " : ''}} {{$val['mobile']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>
</body>
</html>
