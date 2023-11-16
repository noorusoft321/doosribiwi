<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
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
    </style>
</head>
<body style="margin: 30px auto;">
<table style="width: 100%">
    <tbody>
    <tr>
        <td>
            <table style="background-color: #f6f7fb; width: 100%">
                <tbody>
                <tr>
                    <td>
                        <table style="width: 650px; margin: 0 auto; margin-bottom: 30px">
                            <tbody>
                            <tr>
                                <td><img src="{{asset('images/doosri-biwi-dark-logo.png')}}" alt="Doosri Biwi Logo"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                <tbody>
                <tr>
                    <td style="padding: 30px">
                        <h4 style="font-weight: 600">Password Reset</h4>
                        <p>
                            Forgot your password for DoosriBiwi.com? If this is true, click the 'Reset Password' button
                            to reset your password.
                        </p>
                        <p>If you have remembered your password now, you can safely ignore this email.</p>
                        <p style="text-align: center"><a href="{{Route('forget.password.confirm',[$code])}}" style="padding: 10px; background-color: #0c476e; color: #fff; display: inline-block; border-radius: 4px">Reset
                                Password</a></p>
                        <p>Good luck! Hope it works.</p>
                        <p style="margin-bottom: 0">
                            Regards,<br> DoosriBiwi.com</p>
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