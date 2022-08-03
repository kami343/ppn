<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>PPN Email</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body{font-family: 'Poppins', sans-serif;padding: 0px;margin: 0px;}
        .main{background-color: #fff;margin: auto;width: 600px;}
        .btn-reg{
            background-image: linear-gradient(to right,#B0E500,#C3FA02,#B5EB01);
            padding: 10px 27px;
            color: #000;
            border-radius: 100px;
            font-weight: 800;
            font-size: 22px;
            text-decoration: none;
            margin: 20px 0px;
            display: inline-block;
        }
        .btn-reg:hover{opacity: 0.8;}
        .lnklogin{color: #057EDC;}
        .lnklogin:hover{color: #87DF10;}
    </style>
</head>
<body style="background-color: #f7f7f7;">

<div class="main">
    <div style="padding: 15px;">
        <table>
            <tr>
                <td><a href="/"><img src="https://i.ibb.co/9G7tmpD/logo.png" alt="" width="200px"></a></td>
            </tr>
            <tr><td><hr style="border-color: #fff;margin: 25px 0px;"></td></tr>
            <tr>
                <td><b>Dear {{ $userDetails['first_name'] }},</b></td>
            </tr>
            <tr>
                <td><p style="margin-bottom: 0px;margin-top: 0px;">Please use the OTP below in your web browser to reset your password.</p></td>
            </tr>
            <tr>
                <td><a href="#" class="btn-reg">{{ $rememberToken }}</a></td>
            </tr>

            <tr>
                <td><p style="margin: 0px 0px;">If you need additional help, please <a href="#" class="lnklogin">contact us</a>.</p></td>
            </tr>
            <tr>
                <td><p style="margin-top: 65px;margin-bottom: 5px;">Thank you,</p></td>
            </tr>
            <tr>
                <td><p style="margin: 0px 0px;">The PPN Team</p></td>
            </tr>
            <tr>
                <td style="padding-top: 10px;"><a href="{!! $settingData['facebook_link'] !!}"><img src="https://i.ibb.co/D1qq2jr/facebook.png" alt="" width="50px"></a><a href="{!! $settingData['instagram_link'] !!}" style="margin-left: 10px;"><img src="https://i.ibb.co/7bvv2qK/instagram.png" alt="" width="50px"></a></td>
            </tr>
        </table>
    </div>
    <table style="background-color: #f7f7f7;padding: 15px;">
        <tr>
            <td><p style="margin: 0px 0px;text-align: center;font-size: 13px;">To unsubscribe from getting emails from PPN, you must request to close your account. To close your account please <a href="{{url('/contact-us')}}" class="lnklogin">contact our Cutomer Care Department</a> via email, telephone, or live chat. For more information please visit us at <a href="https://pickleballplayersnetwork.com" class="lnklogin">www.ppn.com</a>.</p></td>
        </tr>
    </table>
</div>

</body>
</html>
