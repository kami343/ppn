<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>PPN</title>
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/green.css">
    <link rel="stylesheet" href="assets/fonts/stylesheet.css">
    <title>Create Account</title>
</head>

<body class="poppins">
<section class="container-fluid fullcontent email-height">
    <div class="row fullcontent">
        <div class="col-lg-3 blacksecpadd loginscr">
        </div>
        <div class="col-lg-9" style="margin-top: 5%">
            <div class="loginpage">
                <div class="row">
                    <div class="col-lg-7 text-center email-pl">
                        <h1 class="loginttlppns pb-3" style="font-family: 'Poppins', sans-serif;font-weight: 800; font-size:50px;">Success!</h1>
                        <span><i class="fa-4x fa-solid fa-circle-check" style="color:#B0E500"></i></span>
                        <p class="txtmail py-2">Your email has been verified and your account has been created.</p>
                        <p class="txtmail">Log in to register for leagues</p>
                        <a href="{{url('/login-new')}}" class="btn btn-next-step border-2 mt-5" style="border-color: black">Log in</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<div class="container-fluid email-fix">
    <div class="row">
        <div class="col-lg-9"><h5>© Pickleball Players Network</h5></div>
        <div class="col-lg-3"><ul class="footlink">
                <li class="list-inline-item"><a href="{{url('/terms-of-use')}}">Terms</a></li>
                <li class="list-inline-item"><a href="{{url('/privacy-policy')}}">Privacy</a></li>
            </ul></div>
    </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/plugins.js"></script>
<script src="assets/js/theme.js"></script>
<script>
    $(".reveal").on('click',function() {
        var $pwd = $(".pwd");
        if ($pwd.attr('type') === 'password') {
            $pwd.attr('type', 'text');
        } else {
            $pwd.attr('type', 'password');
        }
    });

</script>
</body>
</html>
