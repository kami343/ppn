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
{{--    <!-- Custom styles for this template -->--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/site/style.css') }}" />--}}
{{--    <!-- Development css -->--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/site/development.css') }}" />--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>

        .error{
            color: red;
        }
    </style>
    <title>Create Account</title>
</head>

<body class="poppins">
<section class="container-fluid fullcontent">
    <div class="row fullcontent">
        <div class="col-lg-3 blacksecpadd loginscr">
            <div class="acc-leftblacksec">
                <a href="#" class="logo"><img src="assets/img/logo-white.png" alt="" width="100%"></a>

                <div class="loginttlsec text-center">
                    <h1 class="loginttl" style="color: #fff;font-family: 'Poppins', sans-serif;font-weight: 900;">New Here?</h1>
                    <p class="mt-3 mb-5">Sign up and register for Pickleball leagues in your area!</p>

                    <a href="{{ route('site.registration') }}" class="btn-signacc">Sign Up</a>
                </div>
            </div>
        </div>
        <!-- Pre-loader end -->

        <input type="hidden" name="website_link" id="website_link" value="{{ url('/') }}" />
        <input type="hidden" name="current_city" id="current_city" value="{{ Session::get('citySlug') }}" />

        <div class="col-lg-9 position-relative">
            <div class="mainpadd loginpage">
                <div class="row">
                    <div class="col-lg-6 m-auto">

                        <div id="login-message" class="alert d-none alert-danger">

                           Login <strong>Failed!!</strong>please check the credentials..!

                        </div>

                        <h1 class="loginttl" style="font-family: 'Poppins', sans-serif;font-weight: 900;">Log in to Your Account</h1>

                        <form class="frmgen" name="loginForm" id="loginForm">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email">Email<span class="text-red">*</span></label>
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Password<span class="text-red">*</span></label>

                                        <div class="input-group tgpass">
                                            <input type="password" class="form-control pwd" placeholder="Enter Password" id="password" name="password">
                                            <span class="input-group-btn">
												<button class="btn-default reveal" type="button"><i class="fa-solid fa-eye"></i></button>
											  </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {{--                                        <input type="submit" name="submit" id="submit" class="btn-signacc" value="Sign In" />--}}

                                        <button type="submit" id="submit" class="btn-signacc">Sign In</button>
                                    </div>


                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                           data-bs-target="#forgotPasswordModal" class="lnklogin">Forgot your password? <i class="fa-solid fa-chevron-right"></i></a>

                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Forgot Password modal start -->
                        <div class="modal fade loginModal" id="forgotPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header py-1">
                                        <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
                                        <button type="button" class="btn btn-danger btn-danger" data-bs-dismiss="modal" aria-label="Close">X</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="loginForm">
                                            <div id="forgot-password-id" class="alert d-none alert-success">

                                            </div>


                                            <form action="" method="post" id="register-form" novalidate="novalidate">

                                                <h2>Registration form</h2>

                                                <div id="form-content">


                                                    <div class="form-group">
                                                        <label for="name">Email</label>
                                                        <input class="form-control" type="text" name="email">
                                                    </div>






                                                    <div class="form-group">
                                                        <input class="btn btn-primary mt-2" type="submit" name="submit">
                                                    </div>
                                                </div>

                                            </form>




                                            <div class="createHolder d-flex justify-content-between">
                                                <div class="createAcount"><a href="{{ route('site.registration') }}">Create Account</a></div>
                                                <div class="forgetPass"><a id="openLoginModal" href="{{ route('site.login-new') }}">Login</a></div>
                                            </div>
                                            <div class="required-fields-position">
                                                <span class="text-red">*</span> {{config('global.REQUIRED_FIELD')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Forgot Password modal end -->
                    </div>
                </div>
            </div>
            <div class="row footer">
                <div class="col-lg-6 col-md-6">
                    <h5>© Pickleball Players Network</h5>
                </div>
                <div class="col-lg-6 col-md-6">
                    <ul class="footlink">
                        <li class="list-inline-item"><a href="#">Terms</a></li>
                        <li class="list-inline-item"><a href="#">Privacy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

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


    $(document).ready(function ($) {

        $("#loginForm").validate({
            rules: {
                email: "required",
                password: "required",
            },
            messages: {
                email: "Please enter your email",
                password: "Please enter your password"
            },
            errorPlacement: function (error, element) {
                error.appendTo(element.parents('.form-group'));

            },
            submitHandler: function (form) {
                var websiteLink = $('#website_link').val();
                var loginSubmitUrl = websiteLink + '/ajax-login-submit';
                $.ajax({
                    url:  loginSubmitUrl,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#loginForm').serialize(),
                    dataType: 'json',
                    success: function (response) {
                       if(response.type=="error"){
                           $('#login-message').removeClass('d-none')

                           $('#login-message').addClass('d-block')

                       }
                       else{
                           window.location.href = websiteLink+'/users/profile';
                       }
                    }
                });
            }

        });

        // $("#forgotPasswordForm").validate({
        //     rules: {
        //         email: {
        //             required: true,
        //             valid_email: true,
        //         },
        //     },
        //     messages: {
        //         email: {
        //             required: "Please enter email.",
        //             valid_email: "Please enter valid email."
        //         },
        //     },
        //     errorPlacement: function (error, element) {
        //         error.appendTo(element.parents('.form-group'));
        //
        //     },
        //     submitHandler: function (form) {
        //         var websiteLink = $('#website_link').val();
        //         var forgotPasswordSubmitUrl = websiteLink + '/ajax-forgot-password-submit';
        //         $.ajax({
        //             url:  forgotPasswordSubmitUrl,
        //             method: 'POST',
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             data: $('#forgotPasswordForm').serialize(),
        //             dataType: 'json',
        //             success: function (response) {
        //                 console.log(response.data)
        //                 $('#forgot-password-id').removeClass('d-none')
        //                 $('#forgot-password-id').addClass('d-block')
        //             }
        //         });
        //     }
        //
        // });

        $("#register-form").validate({
            rules: {
                email: "required",


            },
            messages: {
                email: "Please enter your Email",

            },
            errorPlacement: function(error, element)
            {
                if ( element.is(":radio") )
                {
                    error.appendTo( element.parents('.form-group') );
                }
                else
                { // This is the default behavior
                    error.insertAfter( element );
                }
            },
            submitHandler: function(form) {
                var websiteLink = $('#website_link').val();
                var forgotPasswordSubmitUrl = websiteLink + '/ajax-forgot-password-submit';

                $.ajax({
                    url:  forgotPasswordSubmitUrl,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#register-form').serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.type=='error'){
                            $('#forgot-password-id').removeClass('d-none')
                            $('#forgot-password-id').addClass('d-block')
                            const str="<p>"+response.message+"</p>";

                            $('#forgot-password-id').append(str)
                        }

                    }
                });

            }

        });


    });
</script>
</body>
</html>
