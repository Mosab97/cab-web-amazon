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
                    <img alt="" style="background-image: url('{{ setting('logo') }}');background-size:100% 100%;width: 100px; height:50px; padding: 20px">
                </tr>
            </tbody>
        </table>
        <div style="padding: 30px 70px; border-top: 1px solid rgba(0,0,0,0.05);">
            <h1 style="margin-top: 0px;">
                أهلا بك {{ $notifiable->fullname }}
            </h1>
            <h4> استعادة الحساب لتطبيق {{ setting('project_name') }}</h4>
            <div style="position: relative;margin: 20px 0;">
                <h3>كود التفعيل</h3>
                <h3 style="border: 1px; color: #0091d7">{{ $notifiable->reset_code }}</h3>
                {{-- <h3 style="border: 1px; color: #0091d7"><a href="{{ url('/password/reset', $notifiable->reset_code).'?email='.urlencode($notifiable->email) }}" class="btn btn-info">اعادة تعيين</a></h3> --}}
            </div>
        </div>
        <div style="background-color: #00e573; padding: 40px; text-align: center;">
            <div style="color: #fff; font-size: 10px;">جميع الحقوق الملكية محفوظة لتطبيق {{ setting('project_name') }}
            </div>
        </div>
    </div>
</body>

</html>
