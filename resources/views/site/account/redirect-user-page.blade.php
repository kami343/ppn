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
    <link rel="stylesheet" href="{{asset('assets_new/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('assets_new/css/style.css')}}">
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
                            <a href="{{url("/")}}" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></a>
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
<section class="container-fluid fullcontent email-height">
    <div class="row fullcontent">
        <div class="col-lg-3 blacksecpadd loginscr">
        </div>
        <div class="col-lg-9" style="margin-top: 5%">
            <div class="loginpage">
                <div class="row">
                    <div class="col-lg-7 text-center email-pl">
                        <h1 class="loginttlppns pb-1" style="font-family: 'Poppins', sans-serif;font-weight: 800; font-size:50px;">Success!</h1>
                        <span><i class="fa-6x fa-solid fa-circle-check" style="color:green"></i></span>
                        <p class="txtmail mt-2">Your email has been verified and your account has been created.</p>
                        <p class="txtmail">Log in to register for leagues</p>
                        <a href="{{url('/login-new')}}" class="btn btn-next-step">Log in</a>
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
