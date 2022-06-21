<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    </head>
    <body dir="rtl" style="text-align: center;font-family: 'Cairo', sans-serif;background-color: #f5f5f5;padding: 20px;font-size: 14px; line-height: 1.43;">
        <div style="max-width: 600px; margin: 0px auto; background-color: #fff; box-shadow: 0px 20px 50px rgba(0,0,0,0.05);">
            <table style="width: 100%; background-color:#00e573">
                <tbody>
                    <tr style="text-align:center">
                        <h3>{{ setting('project_name') }}</h3>
                    </tr>
                </tbody>
            </table>
            <div style="padding: 30px 70px; border-top: 1px solid rgba(0,0,0,0.05);">
                <h1 style="margin-top: 0px;">
                    ردا على  {{ $reply->contact->title }}
                </h1>
                <h4>قام بالرد  {{ $reply->contact->fullname }}</h4>
                <div style="color: #636363; font-size: 14px;">
                    {!! $reply->reply !!}
                </div>
            </div>
            <div style="background-color: #00e573; padding: 40px; text-align: center;">
                <div style="color: #fff; font-size: 10px;">جميع الحقوق الملكية محفوظة لموقع {{ setting('project_name') }}
                </div>
            </div>
        </div>
    </body>
</html>
