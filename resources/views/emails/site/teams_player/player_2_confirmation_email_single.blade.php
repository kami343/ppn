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
        .league-title{background-color: #000;padding: 8px 15px;color: #fff;}
        .league-desc{background-color: #f0f0f0;padding: 8px 15px;}
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
                <td><b>Dear {{$data['player_2_name']}},</b></td>
            </tr>
            <tr>
                <td><p style="margin-bottom: 0px;margin-top: 0px;">{{$data['player_1_name']}} has registered for a PPN Doubles Leagues and listed you as a partner.</p></td>
            </tr>
            <tr>
                <td>
                    <table style="margin-top: 20px;">
                        <tbody>

                        <tr>
                            <td class="league-title"><b>Name</b></td>
                            <td class="league-desc"><a href="{{url('/league-registration/'.$league->leagueid.'/'.$userid)}}" class="lnklogin">  {{$league->league_name}}</a></td>
                        </tr>
                        <tr>
                            <td class="league-title"><b>Start Date</b></td>
                            <td class="league-desc"> {{$league->fromdate}}</td>
                        </tr>
                        <tr>
                            <td class="league-title"><b>End Date</b></td>
                            <td class="league-desc"> {{$league->todate}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td><p style="margin-bottom: 5px;">You have <u>5 days</u> to register and secure your spot.</p></td>
            </tr>
            <tr>
                <td><p style="margin: 0px 0px;">If you believe that you received this email by mistake or wish to deny the request, <a href="{{url('/deny/')}}{{$teamid}}" class="lnklogin">click here</a>.</p></td>
            </tr>
            <tr>
                <td><p style="margin-top: 65px;margin-bottom: 5px;">Thank you,</p></td>
            </tr>
            <tr>
                <td><p style="margin: 0px 0px;">The PPN Team</p></td>
            </tr>
            <tr>
                <td style="padding-top: 10px;"><a href="{!! $settingData['facebook_link'] !!}" target="_blank"><img src="https://i.ibb.co/D1qq2jr/facebook.png" alt="" width="50px"></a><a href="{!! $settingData['instagram_link'] !!}" target="_blank" style="margin-left: 10px;"><img src="https://i.ibb.co/7bvv2qK/instagram.png" alt="" width="50px"></a></td>
            </tr>
        </table>
    </div>
    <table style="background-color: #f7f7f7;padding: 15px;width: 100%;">
        <tr>
            <td><p style="margin: 0px 0px;text-align: center;font-size: 13px;">© 2022 Pickball Players Network, all rights reserved.</p></td>
        </tr>
    </table>
</div>

</body>
</html>
