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
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/green.css">
    <link rel="stylesheet" href="assets/css/stylemodal.css">
    <link rel="stylesheet" href="assets/fonts/stylesheet.css">
    {{--    <!-- Custom styles for this template -->--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/site/style.css') }}" />--}}
    {{--    <!-- Development css -->--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/site/development.css') }}" />--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>

        div.error {
            color: red;
        }
    </style>
    <title>Create Account</title>
</head>

<body class="poppins">
<input type="hidden" name="website_link" id="website_link" value="{{ url('/') }}"/>

<section class="container-fluid fullcontent">
    <div class="row fullcontent">
        <div class="col-lg-3 blacksecpadd loginscr">
            <div class="acc-leftblacksec">
                <a href="{{url('/')}}" class="d-flex justify-content-left logo"><img src="assets/img/logo-white.png"
                                                                                       alt="" width="100%"></a>

                <div class="text-center" style="margin-top: 30%">
                    <h1 style="color: #fff;font-family: 'Poppins', sans-serif;font-weight: 900;">New Here?</h1>
                    <p class="py-4" style="font-size: 15px;font-family: 'Poppins';font-weight:bold;"><b>Sign up and
                            register for Pickleball leagues in your area!</b></p>


                    <a href="{{ route('site.registration') }}" class="btn btn-signacc">Sign Up</a>
                </div>
            </div>
        </div>
        <!-- Pre-loader end -->

        <input type="hidden" name="website_link" id="website_link" value="{{ url('/') }}"/>
        <input type="hidden" name="current_city" id="current_city" value="{{ Session::get('citySlug') }}"/>

        <div class="col-lg-9 position-relative">
            <div class="mainpadd loginpage">
                <div class="row">
                    <div class="col-lg-6 m-auto">



                        <h1 class="loginttl" style="font-family: 'Poppins', sans-serif;font-weight: 900;">Log in to Your
                            Account</h1>

                        <form class="frmgen" name="loginForm" id="loginForm">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email">Email<span class="text-red">*</span></label>
                                        <input type="text" id="email" name="email" class="form-control"
                                               placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Password<span class="text-red">*</span></label>

                                        <div class="input-group tgpass">
                                            <input type="password" class="form-control pwd" placeholder="Enter Password"
                                                   id="password" name="password">
                                            <span class="input-group-btn">
												<button class="btn-default reveal" type="button"><i
                                                        class="fa-solid fa-eye"></i></button>
											  </span>
                                        </div>
                                        <div id="password-message" class="alert d-none mt-2 alert-danger">

                                           The password you have entered is incorrect!

                                        </div>
                                        <div id="email-message" class="alert d-none mt-2 alert-danger">

                                           The email you have entered is incorrect!

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {{--                                        <input type="submit" name="submit" id="submit" class="btn-signacc" value="Sign In" />--}}

                                        <button type="submit" id="submit" class="btn btn-signacc">Sign In</button>
                                    </div>


                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                           data-bs-target="#forgotPasswordModal" class="lnklogin">Forgot your password?
                                            <i class="fa-solid fa-chevron-right"></i></a>

                                    </div>
                                </div>
                            </div>
                        </form>


                        <!-- Forgot Password modal start -->
                        <div class="modal fade" id="forgotPasswordModal" tabindex="-1"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
                                        <button type="button" class="btn-close-1" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            <i class="fa-solid fa-xmark"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="forgot-password-id" class="alert d-none alert-success">
                                            Email Sent Successfully..!
                                        </div>
                                        <form id="forgotPasswordForm" name="forgotPasswordForm" novalidate="novalidate"
                                              class="frmgen mt-3">

                                            <div class="form-group">
                                                <label>Email <span style="color: red;">*</span></label>
                                                <input type="text" id="email" name="email" class="form-control"
                                                       placeholder="Enter your email">
                                            </div>

                                            <div class="modal-footer" style="border-top: 1px solid #ddd;">
                                                <button type="button" class="btn-Close" data-bs-dismiss="modal">Close
                                                </button>
                                                <button type="submit" class="btn btn-signacc">Submit</button>
                                                <div
                                                    class="alert alert-success alert-dismissible d-none mt-2 fade show"
                                                    id="modal-alert" role="alert">
                                                    Record Stored <strong>Successfully..</strong> mail sent!!
                                                    <button type="button"
                                                            class="btn btn-sm btn-white text-black close"
                                                            data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="createHolder d-flex justify-content-between">
                                            <div class="createAcount"><a href="{{ route('site.registration') }}">Create
                                                    Account</a></div>
                                            <div class="forgetPass"><a id="openLoginModal"
                                                                       href="{{ route('site.login-new') }}">Login</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Forgot Password modal end -->

                        <!-- Reset Password modal start -->
                        <div class="modal fade loginModal" id="resetPasswordModal" tabindex="-1"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                                        <button type="button" class="btn-close-1" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            <i class="fa-solid fa-xmark"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="loginForm">
                                            <form name="resetPasswordForm" class="frmgen" id="resetPasswordForm">
                                                <div class="alert d-none" id="reset-password-alert">

                                                </div>
                                                <div class="form-group">
                                                    <label>OTP<span class="text-red">*</span></label>
                                                    <input type="text" id="otp" name="otp" class="form-control"
                                                           placeholder="Enter otp">
                                                </div>
                                                <div class="form-group">
                                                    <label>New Password<span class="text-red">*</span></label>
                                                    <div class="input-group tgpass">
                                                        <input type="password" id="reset_password" name="reset_password"
                                                               class="form-control pwd">
                                                        <span class="input-group-btn">
												<button class="btn-default reveal" type="button"><i
                                                        class="fa-solid fa-eye"></i></button>
											  </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password<span class="text-red">*</span></label>
                                                    <div class="input-group tgpass">
                                                        <input type="password" id="confirm_password"
                                                               name="confirm_password"
                                                               class="form-control pwd">
                                                        <span class="input-group-btn">
												<button class="btn-default reveal" type="button"><i
                                                        class="fa-solid fa-eye"></i></button>
											  </span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center mt-2">
                                                    <button class="btn btn-signacc" type="submit">Submit</button>
                                                </div>
                                            </form>
                                            <div class="createHolder d-flex justify-content-between">
                                                <div class="createAcount"><a href="{{ route('site.registration') }}">Create
                                                        Account</a></div>
                                                <div class="forgetPass"><a id="openLoginModal"
                                                                           href="{{ route('site.login-new') }}"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#loginModal">Login</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Reset Password modal end -->
                    </div>
                </div>
            </div>
            <div class="fixed-bottom">

                <div class="row mx-3">
                    <div class="offset-3 col-lg-4 col-md-4">
                        <p class="list-inline-item">© Pickleball Players Network</p>
                    </div>
                    <div class="offset-1 col-lg-4 col-md-4">
                        <ul class="footlink">
                            <li class="list-inline-item"><p><a href="{{url('/terms-of-use')}}">Terms</a></p></li>
                            <li class="list-inline-item"><p><a href="{{url('/privacy-policy')}}">Privacy</a></p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

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
                    url: loginSubmitUrl,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#loginForm').serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.type == "error" && response.flag=='1') {
                            $('#password-message').removeClass('d-none')

                            $('#password-message').addClass('d-block')

                            $('#email-message').removeClass('d-block')

                            $('#email-message').addClass('d-none')

                        }
                        else if (response.type == "error" && response.flag=='0'){
                            $('#password-message').removeClass('d-block')

                            $('#password-message').addClass('d-none')

                            $('#email-message').removeClass('d-none')

                            $('#email-message').addClass('d-block')
                        }
                        else {
                            window.location.href = websiteLink + '/users/profile';
                        }
                    }
                });
            }

        });


        $("#forgotPasswordForm").validate({
            rules: {
                email: "required",


            },
            messages: {
                email: "Please enter your Email",

            },
            errorPlacement: function (error, element) {
                if (element.is(":radio")) {
                    error.appendTo(element.parents('.form-group'));
                } else { // This is the default behavior
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                var websiteLink = $('#website_link').val();
                var forgotPasswordSubmitUrl = websiteLink + '/ajax-forgot-password-submit';
                $('.preloader').show();

                $.ajax({
                    url: forgotPasswordSubmitUrl,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#forgotPasswordForm').serialize(),
                    dataType: 'json',
                    success: function (response) {
                        $('.preloader').hide();
                        $('#forgotPasswordForm')[0].reset();

                        $('#forgotPasswordModal').modal('hide');
                        $('#resetPasswordModal').modal('show');

                        if (response.type == 'error') {
                            $('#forgot-password-id').removeClass('d-none')
                            $('#forgot-password-id').addClass('d-block')
                            // const str="<p>"+response.message+"</p>";
                            //
                            // $('#forgot-password-id').append(str)
                        }

                    }
                });

            }

        });

        $("#resetPasswordForm").validate({
            rules: {
                otp: {
                    required: true,
                },
                reset_password: {
                    required: true,
                    minLength: 6
                },
                confirm_password: {
                    required: true,
                    minLength: 6,
                    equalTo: "#reset_password"
                }
            },
            messages: {
                otp: {
                    required: "Please enter OTP.",
                },
                reset_password: {
                    required: "Please enter new password.",
                    minLength: "minimum 6 characters required",
                    equalTo: "Password should match in both fields."

                },
                confirm_password: {
                    required: "Please enter confirm password.",
                    minLength: "minimum 6 characters required",
                    equalTo: "Password should match in both fields.",
                },
            },
            errorClass: 'error',
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.appendTo(element.parents('.form-group'));

            },
            submitHandler: function (form) {
                $('.preloader').show();
                var websiteLink = $('#website_link').val();
                var changePasswordSubmitUrl = websiteLink + '/ajax-reset-password-submit';
                var toLogin = websiteLink + '/login-new';

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: changePasswordSubmitUrl,
                    method: 'POST',
                    data: $('#resetPasswordForm').serialize(),
                    dataType: 'json',
                    success: function (response) {
                        // $('.preloader').hide();
                        if (response.type == 'success') {
                            $('#resetPasswordForm')[0].reset();
                            $('#reset-password-alert').removeClass('d-none');
                            $('#reset-password-alert').addClass('d-block alert-success');
                            $('#reset-password-alert').html("<p>" + response.message + "</p>");
                            $('#reset-password-alert').removeClass('d-block alert-success');
                            $('#reset-password-alert').addClass('d-none');
                            $('#forgotPasswordModal').modal('hide');
                        } else {
                            $('#resetPasswordForm')[0].reset();
                            $('#reset-password-alert').removeClass('d-none');
                            $('#reset-password-alert').addClass('d-block alert-danger');
                            $('#reset-password-alert').html("<p>" + response.message + "</p>");
                        }
                    }
                });
            }
        });

    });
</script>
</body>
</html>
