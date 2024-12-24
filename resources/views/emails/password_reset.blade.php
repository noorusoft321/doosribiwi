<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Doosri Biwi</title>
    <style type="text/css">
        body {
            width: 650px;
            font-family: work-Sans, sans-serif;
            background-color: #f6f7fb;
            display: block;
        }

        a {
            text-decoration: none;
        }

        span {
            font-size: 14px;
        }

        p {
            font-size: 13px;
            line-height: 1.7;
            letter-spacing: 0.7px;
            margin-top: 0;
        }

        .text-center {
            text-align: center
        }

        h6 {
            font-size: 16px;
            margin: 0 0 18px 0;
        }
        .company-logo {
            width: 590px;
            margin: 0 auto;
        }
        .company-logo img {
            width: 50%;
            background: #0c476e;
            border-radius: 10px;
            padding: 10px;
        }
    </style>
</head>
<body style="margin: 30px auto;">
<div class="company-logo">
    <img src="{{ asset('images/doosri-biwi-dark-logo.png') }}" alt="DoosriBiwi.com">
</div>
<table style="width: 100%">
    <tbody>
    <tr>
        <td>
            <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                <tbody>
                <tr>
                    <td style="padding: 30px">
                        <h3 style="font-weight: 600">Password Reset</h3>
                        <p style="margin-bottom: 0;">Forgot your password for DoosriBiwi.com? If this is true, click the 'Reset Password' button to reset your password.</p>
                        <p>If you have remembered your password, you can safely ignore this email.</p>
                        <p><a target="_blank" href="{{Route('forget.password.confirm',[$code])}}" style="padding: 10px; background-color: #0c476e; color: #fff; display: inline-block; border-radius: 4px">Reset Password</a></p>
                        <br>
                        <p style="margin-bottom: 0">Regards,<br><a style="color:#0c476e;font-weight: bold;" href="{{env('APP_URL')}}">DoosriBiwi.com</a></p>
                    </td>
                </tr>
                </tbody>
            </table>
            <table style="width: 650px; margin: 0 auto; margin-top: 30px">
                <tbody>
                <tr style="text-align: center">
                    <td>
                        <p style="color: #999; margin-bottom: 0">
                            Made with ♥ by <a style="color:#0c476e;font-weight: bold;" target="_blank" href="https://doosribiwi.com" class="font-weight-700 text-golden">Doosri Biwi</a>.
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>