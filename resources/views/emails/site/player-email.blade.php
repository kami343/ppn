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
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/green.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/stylesheet.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/stylemodal.css')}}">

    <title>Create Account</title>
</head>

<body class="poppins">
<section class="container-fluid fullcontent email-height ">
    <div class="row fullcontent">
        <div class="col-lg-3 blacksecpadd loginscr">
            <div class="email-acc-leftblacksec">
                <a href="/" class="logo"><img src="assets/img/logo-black.png" alt=""
                                              width="100%"></a>

            </div>
        </div>
        <div class="col-lg-9 position-relative email-sec">
            <div class="loginpage">
                <div class="row">
                    <div class="col-lg-7 email-pl">
                        <h1 class="loginttlppns pb-5"
                            style="font-family: 'Poppins', sans-serif;font-weight: 800; font-size:50px;">Check your
                            email!</h1>
                        <p class="txtmail">An email with verification instructions was sent to <b class="text-info">
                                @isset($email)
                                    {{$email}}
                                @endisset
                            </b>. If you don’t see the email in your inbox, try looking in your spam folder. Once you
                            verify your email address, you will be all set.</p>

                        <div class="didn-rec">
                            <p style="font-weight: 900; font-size: 18px;">Didn’t receive an email?</p>
                            {{--                            <a href="{{url('/resend-verify-email/bsrkhan8@gmail.com')}}" class="lnklogin"--}}
                            {{--                               style="font-weight: 600; font-size: 18px; color:#2E93E1;">Resend verification email</a>--}}

                            @isset($id)
                                <a href="{{url('/resend-verify-email/'.$id)}}" class="lnklogin"
                                   style="font-weight: 600; font-size: 18px; color:#2E93E1;">Resend verification
                                    email</a>
                            @endisset
                        </div>
                        <div class="didn-rec text-black">
                            <p>If you aren’t receiving the email, don’t hesitate to <a href="{{url('/contact-us')}}"
                                                                                       class="lnklogin"
                                                                                       style="color:#2E93E1;cursor: pointer;font-weight: 600; font-size: 18px;">contact
                                    support.</a></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<div class="container-fluid email-fix">
    <div class="row">
        <div class="col-lg-9"><p class="list-inline-item">© Pickleball Players Network</p>
        </div>
        <div class="col-lg-3">
            <ul class="footlink">
                <li class="list-inline-item"><p><a href="{{url('/terms-of-use')}}">Terms</a></p></li>
                <li class="list-inline-item"><p><a href="{{url('/privacy-policy')}}">Privacy</a></p></li>
            </ul>
        </div>
    </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/theme.js"></script>
<script>
    $(".reveal").on('click', function () {
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
