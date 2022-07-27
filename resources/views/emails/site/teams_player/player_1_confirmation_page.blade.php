<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>PPN</title>
    <link rel="shortcut icon" href="assets_new/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("assets_new/css/all.css")}}">
    <link rel="stylesheet" href="{{asset("assets_new/css/style.css")}}">
    <title>Create Account</title>
</head>

<body class="poppins">
<section class="container-fluid">
    <div class="row">
        <header class="wrapper bg-dark">
            <nav class="navbar navbar-expand-lg center-nav transparent navbar-dark">
                <div class="container flex-lg-row flex-nowrap align-items-center">
                    <div class="navbar-brand w-100">
                        <a href="index.html">
                            <img class="logo-dark" src="assets_new/img/logo-white.png" srcset="./assets_new/img/logo-dark@2x.png 2x" alt="">
                            <img class="logo-light" src="assets_new/img/logo-white.png" srcset="./assets_new/img/logo-light@2x.png 2x" alt="">
                        </a>
                    </div>
                    <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                        <div class="offcanvas-header d-lg-none">
                            <h3 class="text-white fs-30 mb-0"><img src="assets_new/img/logo-white.png" srcset="./assets_new/img/logo-dark@2x.png 2x" alt="" width="150px"></h3>
                            <a href="/" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></a>
                        </div>

                        <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown custmenu_ico">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">About <i class="fa-solid fa-chevron-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="dropdown-item" href="/what-is-ppn">About PPN</a></li>
                                        <li class="nav-item"><a class="dropdown-item" href="/contact-us">Contact</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown custmenu_ico">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Leagues <i class="fa-solid fa-chevron-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="dropdown-item" href="/find-a-league">Find League</a></li>
                                        <li class="nav-item"><a class="dropdown-item" href="/read-complete-rules">League Rule</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="/getcourts">Courts</a>
                                </li>
                                <li class="nav-item dropdown custmenu_ico">
                                    <a class="nav-link dropdown-toggle btn-head resdis custmenu_ico" href="#" data-bs-toggle="dropdown">Account <i class="fa-solid fa-chevron-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="dropdown-item" href="/profile">Profle</a></li>
                                        <li class="nav-item"><a class="dropdown-item" href="/change-password">Change Password</a></li>
                                        <li class="nav-item"><a class="dropdown-item" href="/logout">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- /.offcanvas-footer -->
                        </div>
                        <!-- /.offcanvas-body -->
                    </div>
                    <!-- /.navbar-collapse -->

                    <div class="navbar-other w-100 d-flex ms-auto">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item d-none d-md-block">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle btn-head custmenu_ico" data-toggle="dropdown">Account <i class="fa-solid fa-chevron-down"></i></a>
                                    <ul class="dropdown-menu proflnk" role="menu">
                                        <li><a href="/profile">Profile</a></li>
                                        <li><a href="/change-password">Change Password</a></li>
                                        <li><a href="/logout">Logout</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item d-lg-none">
                                <button class="hamburger offcanvas-nav-btn"><span></span></button>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-other -->
                </div>
                <!-- /.container -->
            </nav>
            <!-- /.navbar -->
            <div class="offcanvas offcanvas-top bg-light" id="offcanvas-search" data-bs-scroll="true">
                <div class="container d-flex flex-row py-6">
                    <form class="search-form w-100">
                        <input id="search-form" type="text" class="form-control" placeholder="Type keyword and hit enter">
                    </form>
                    <!-- /.search-form -->
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <!-- /.container -->
            </div>
            <!-- /.offcanvas -->
        </header>
    </div>
</section>
<section class="container-fluid email-height">
    <div class="row">
        <div class="col-lg-12 position-relative email-sec empl">
            <div class="loginpage">
                <div class="row">
                    <div class="col-lg-6 email-pl m-auto">
                        <h1 class="loginttl pb-5 mt-0">You’re almost there!</h1>
                        <p class="txtmail">An email with verification instructions was sent to <b>{{$user->player2_email}}</b>. <b>{{$user->player2_name}}</b> has <u>5 days</u> to confirm you as a partner and register for the league in order to secure your spot.</p>
                        <p class="txtmail">We recommend that you contact <b>{{$user->player2_name}}</b> to ensure they received the email and register in a timely manner.</p>
                        <p class="txtmail">Once <b>{{$user->player2_name}}</b> registers for the league, the team will receive an email, confirming your registration.</p>
                        <div class="didn-rec">
                            <p style="font-weight: 700; font-size: 18px;">Want to get prepared for your league?
                            </p>
                            <p class="txtmail">Read Our <a href="/faqs" class="lnklogin">FAQs</a></p>
                        </div>

                        <p class="txtmail">If you need any assistance, don’t hesitate to <a href="/contact-us" class="lnklogin">contact support.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="notfixedfooter">
        <div class="row">
            <div class="col-lg-9 col-md-7"><h5 class="copy-text">© Pickleball Players Network</h5></div>
            <div class="col-lg-3 col-md-5"><ul class="footlink">
                    <li class="list-inline-item"><a href="{{url("/terms-of-use")}}">Terms</a></li>
                    <li class="list-inline-item"><a href="{{url("/privacy-policy")}}">Privacy</a></li>
                </ul></div>
        </div>
    </div>
</section>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- <script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
<script src="assets_new/js/plugins.js"></script>
<script src="assets_new/js/theme.js"></script>
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
<!-- <script>
    $(document).ready(function(){
        $(".dropdown").hover(
            function() {
                $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
                $(this).toggleClass('open');
            },
            function() {
                $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
                $(this).toggleClass('open');
            }
        );
    });
</script> -->
</body>
</html>
