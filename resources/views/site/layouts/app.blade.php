<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="{!! $metaKeywords !!}"/>
    <meta name="description" content="{!! $metaDescription !!}"/>
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}"/>
    <title>{!! $title !!}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/stylemodal.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/green.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/stylesheet.css')}}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/site/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>


    <!-- DataTables -->
    <link href="{{ asset('css/admin/plugins/datatables.net-bs4/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/plugins/datatables-responsive/responsive.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/site/style.css') }}"/>

    <!-- Datepicker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
          rel="stylesheet"/>
    <!-- Sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Toastr css -->
    <link href="{{ asset('css/admin/plugins/toastr/toastr.min.css') }}" rel="stylesheet"/>
    <!-- Development css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/site/development.css') }}"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{--        stripe payment gateway--}}
    <script src="https://js.stripe.com/v3/"></script>

    <style>
        label.error {
            color: red;
        }
        .swal2-popup {
            font-size: 0.8rem !important;
            font-family: Poppins
        }
        :hover {
            color: var(--hover-color);
        }

        .btn-signacc {
            background-image: linear-gradient(to right, #B0E500, #C3FA02, #B5EB01);
            padding: 10px 43.5px;
            color: #000;
            border-radius: 100px;

            font-weight: 800;
            font-size: 22px;
        }

        .btn-signacc:hover {
            color: #000;
            opacity: 0.8;
        }

        .btn-Close {
            background-color: transparent;
            border: transparent;
            padding: 10px 20px;
            color: #000;
            font-weight: 800;
            font-size: 22px;
        }

        .apply-promo-code {
            position: relative;
            padding: 10px 20px 10px;
            line-height: 17px;
            background: #000000;
            color: #ffffff;
            font-size: 13px;
            font-weight: 800;
            border-radius: 2px;
            letter-spacing: 1px;
            border: 2px solid #000000;
            text-transform: uppercase;
            display: inline-block;
            border-radius: 30px;
            box-shadow: 0 4px 6px -1px #00000059, 0 2px 4px -1px #00000059;
            height: 40px;
            margin-top: 8px;
        }

        .apply-promo-code:hover {
            background: none;
            color: #000000;
            border: 2px solid #fff;
            line-height: 17px;
        }

        span.borderClr {
            border-style: solid;
            border-color: #C3FA02;
        }

    </style>
</head>
<body>
<div class="header_take_place"></div>
@yield('content')

<!-- Pre-loader start -->
<div class="preloader" style="display: none;">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- Pre-loader end -->

<input type="hidden" name="website_link" id="website_link" value="{{ url('/') }}"/>
<input type="hidden" name="current_city" id="current_city" value="{{ Session::get('citySlug') }}"/>

@if(!Auth::user())
    @php
        $redirectTo = '';
        if (isset($_GET['popup']) && isset($_GET['redirect']) && $_GET['popup'] == 'login' && $_GET['redirect'] == 'join-a-league') {
            $redirectTo = 'join-a-league';
        }
        $states = getStates();
    @endphp
    <!-- Login modal start -->
    <div class="modal fade loginModal" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <div class="loginForm">
                        <form name="loginForm" id="loginForm">
                            {{ Form::hidden('redirect_to', $redirectTo, [
                                            'id' => 'redirect_to',
                                        ]) }}
                            <div class="holder-inner">
                                <label class="placeholder-label-popup">Email<span class="text-red">*</span></label>
                                {{ Form::text('email', null, [
                                                'placeholder' => '',
                                                'class' => 'placeholder-input',
                                                'required' => true,
                                            ]) }}
                            </div>
                            <div class="show-password">
                                <div class="holder-inner">
                                    <label class="placeholder-label-popup">Password<span
                                            class="text-red">*</span></label>
                                    <input type="password" name="password" value="" placeholder=""
                                           class="togglePassword placeholder-input" required>
                                    <span toggle=".togglePassword"
                                          class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                            </div>
                            <button type="submit">Login</button>
                        </form>
                        <div class="createHolder">
                            <div class="createAcount"><a href="{{ route('site.registration') }}">Create Account</a>
                            </div>
                            <div class="forgetPass"><a id="openForgotPasswordModal" href="javascript:void(0);"
                                                       data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot
                                    Password?</a></div>
                        </div>
                        <div class="required-fields-position">
                            <span class="text-red">*</span> {{config('global.REQUIRED_FIELD')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login modal end -->


    <!-- Forgot Password modal start -->
    <div class="modal fade loginModal" id="forgotPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <div class="loginForm">
                        <form name="forgotPasswordForm" id="forgotPasswordForm">
                            <div class="holder-inner">
                                <label class="placeholder-label-popup">Email<span class="text-red">*</span></label>
                                {{ Form::text('email', null, [
                                                'placeholder' => '',
                                                'class' => 'placeholder-input',
                                                'required' => true,
                                            ]) }}
                            </div>
                            <button type="submit">Submit</button>
                        </form>
                        <div class="createHolder">
                            <div class="createAcount"><a href="{{ route('site.registration') }}">Create Account</a>
                            </div>
                            <div class="forgetPass"><a id="openLoginModal" href="javascript:void(0);"
                                                       data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                            </div>
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
    <!-- Reset Password modal start -->
    <div class="modal fade loginModal" id="resetPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <div class="loginForm">
                        <form name="resetPasswordForm" id="resetPasswordForm">
                            <div class="holder-inner">
                                <label class="placeholder-label-popup">OTP<span class="text-red">*</span></label>
                                {{ Form::password('otp', [
                                                    'id'    => 'otp',
                                                    'placeholder' => '',
                                                    'class' => 'placeholder-input',
                                                    'required' => true,
                                                ]) }}
                            </div>
                            <div class="holder-inner">
                                <label class="placeholder-label-popup">New Password<span
                                        class="text-red">*</span></label>
                                {{ Form::password('password', [
                                                    'id'    => 'reset_password',
                                                    'placeholder' => '',
                                                    'class' => 'placeholder-input',
                                                    'required' => true,
                                                ]) }}
                            </div>
                            <div class="holder-inner">
                                <label class="placeholder-label-popup">Confirm Password<span
                                        class="text-red">*</span></label>
                                {{ Form::password('confirm_password', [
                                                    'placeholder' => '',
                                                    'class' => 'placeholder-input',
                                                    'required' => true,
                                                ]) }}
                            </div>
                            <button type="submit">Submit</button>
                        </form>
                        <div class="createHolder">
                            <div class="createAcount"><a href="{{ route('site.registration') }}">Create Account</a>
                            </div>
                            <div class="forgetPass"><a id="openLoginModal" href="javascript:void(0);"
                                                       data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                            </div>
                        </div>
                        <div class="required-fields-position">
                            <span class="text-red">*</span> {{config('global.REQUIRED_FIELD')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reset Password modal end -->
    <!-- Pickleball Court modal start -->
    <div class="modal fade" id="pickleballCourtModal" tabindex="-1"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">LEAGUE SIGN UP</h5>
                    <button type="button" class="btn-close-1" data-bs-dismiss="modal"
                            aria-label="Close">
                        <i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form id="pickleballCourtForm" name="pickleballCourtForm" novalidate="novalidate"
                          class="frmgen mt-3">

                        <div class="form-group">
                            <label>Court Name <span style="color: red;">*</span></label>
                            <input type="text" id="court_name" name="court_name"
                                   class="form-control" placeholder="Enter Court Name">
                        </div>
                        <div class="form-group">
                            <label>City<span style="color: red;">*</span></label>
                            <input type="text" id="city" name="city" class="form-control"
                                   placeholder="Enter City">
                        </div>

                        <div class="form-group">
                            <label>State<span style="color: red;">*</span></label>

                            <div class="selectgroup">

                                <i class="fa-solid fa-chevron-down"></i>
                                <select id="state_id" name="state_id" class="form-control">
                                    <option value="">Select</option>

                                    @foreach ($states as $item)
                                        <option
                                            value="{{ $item->id }}">{!! $item->title !!}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" id="address" name="address" class="form-control"
                                   placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <label>Zip</label>
                            <input type="text" id="zip" name="zip" class="form-control"
                                   placeholder="Enter Zip Code">
                        </div>

                        <div class="form-group">
                            <label>Number of courts</label>

                            <div class="selectgroup">

                                <i class="fa-solid fa-chevron-down"></i>
                                <select name="number_of_courts" id="number_of_courts"
                                        class="form-control">
                                    <option value=""></option>
                                    @for ($courts = 1; $courts <= 30; $courts++)
                                        <option value="{{$courts}}">{{$courts}}</option>
                                    @endfor
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Accessibility</label>

                            <div class="selectgroup">

                                <i class="fa-solid fa-chevron-down"></i>
                                <select name="accessibility"
                                        class="form-control">
                                    <option value=""></option>
                                    <option value="PR">Private</option>
                                    <option value="PL">Public</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Indoor/Outdoor</label>

                            <div class="selectgroup">

                                <i class="fa-solid fa-chevron-down"></i>
                                <select name="indoor_outdoor"
                                        class="form-control">
                                    <option value=""></option>
                                    <option value="ID">Indoor</option>
                                    <option value="OD">Outdoor</option>
                                    <option value="B">Both</option>
                                </select>

                            </div>
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
                </div>

            </div>
        </div>
    </div>
    <!-- Pickleball Court modal end -->
    <!-- League Signup modal start -->
    <div class="modal fade" id="leagueSignupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
         data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">League Sign Up</h5>
                    <button type="button" class="btn-Close text-white" data-bs-dismiss="modal"
                            aria-label="Close">
                        <i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form class="frmgen mt-0" name="leagueSignupForm">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Team Name <span style="color: red;">*</span></label>
                                    <input type="text" id="team_name" name="team_name"
                                           class="form-control" placeholder="Enter Team Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Player 1 Name <span style="color: red;">*</span></label>
                                    <input type="text" id="player_1_name" name="player_1_name"
                                           class="form-control" placeholder="Player 1 Name">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Player 2 Name <span style="color: red;">*</span></label>
                                    <input type="text" id="player_2_name" name="player_2_name"
                                           class="form-control" placeholder="Player 2 Name">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label>Player 2 Email <span style="color: red;">*</span></label>
                                <input type="text" id="player_2_email" name="player_2_email"
                                       class="form-control" placeholder="Player 2 Email">

                                <label class="league-signup-message">Don't have a partner?<br/>
                                    <a href="javascript: void(0);" id="need-partner"><u>Click here to add yourself to
                                            the players who need a partner list</u></a>
                                </label>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <input type="text" id="promo_code" name="promo_code"
                                       class="form-control" placeholder="Enter Promo Code">
                            </div>
                            <div class="col-lg-3 col-4 form-group">
                                <button type="button" class="apply-promo-code">Apply</button>
                            </div>
                            <div class="col-lg-2 form-group">
                                <span class="text-red registration-amount"><strong>$39.99</strong></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <div>
                                    <input class="form-check-input popup-accept" type="checkbox" value="1"
                                           id="signup-agree" name="signup-agree">
                                    <label class="form-check-label" for="signup-agree">Accept <a
                                            href="{{ route('site.terms-of-use') }}" target="_blank"><u>Terms of Use</u></a><span
                                            class="text-red">*</span></label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-Close" data-bs-dismiss="modal">Close
                                    </button>
                                    <button type="submit" class="btn btn-signacc">Submit</button>
                                </div>

                            </div>
                        </div>

                        {{--                        <div class="required-fields-position">--}}
                        {{--                            <span class="text-red">*</span> {{config('global.REQUIRED_FIELD')}}--}}
                        {{--                        </div>--}}
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- League Signup modal end -->
    <!-- Need partner modal start -->
    <div class="modal fade needPartnerModal" id="needPartnerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-3">
                    <button type="button" class="btn-Close text-white" style="position: absolute;right: 0"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                        <i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="loginForm">
                        <p>You have been added to the <strong>Players who need a partner</strong> list for the <strong>League
                                Name</strong>.</p>
                        <p>Other solo players interested in this league will be able to reach out to you via email to
                            see if you are a good partner match.</p>
                        <p>Good Luck!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Need partner modal end -->
@endif

<!-- Bootstrap core JavaScript
        ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="{{ asset('js/site/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://use.fontawesome.com/4b1a371264.js"></script>
{{-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> --}}
{{-- <script src="/path/to/dist/js/a11yAccordion.js"></script> --}}

<link href="{{ asset('css/admin/plugins/datatables.net-bs4/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/plugins/datatables-responsive/responsive.bootstrap4.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/admin/dist/jquery/jquery.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/site/jquery.validate.min.js') }}"></script>

@if (Route::currentRouteName() == 'site.registration')
    <!-- Selectpicker -->
    {{-- <link href="{{ asset('css/site/bootstrap-select.min.css') }}" rel="stylesheet">
    <script src="{{asset('js/site/bootstrap-select.min.js')}}"></script> --}}
    <link rel="stylesheet" href="{{asset('css/admin/plugins/selectpicker/bootstrap-select.css')}}">
    <script src="{{asset('js/admin/plugins/selectpicker/bootstrap-select.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('.selectpicker').select2({}).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
                $(".select2-results:not(:has(a))").append('<div class="dropdown_devider"></div>' +
                    '<div class="fixed_dropdown">' +
                    '<a href="javascript: void(0);" class="link-text-black padding_left_6">Private Residence / At Home Court</a><br>' +
                    '<div class="dropdown_separator"></div>' +
                    '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#pickleballCourtModal" class="add_new_pickleball_court">' +
                    // '<i class="fa fa-plus-circle green-plus" aria-hidden="true"></i> Can’t find your court, click here to add it</a>'+
                    '<img src="{{ asset("images/site/plus-circle.png") }}" style="width: 18px;" /> Can’t find your court, click here to add it</a>' +
                    '</div>');
                $('.select2-search__field').attr('placeholder', 'Start Typing Here...');
            });
        });
    </script>
    <style>
        .select2-container {
            width: 100% !important;
            z-index: 9;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #e7e6e6 !important;
            border-radius: 0px !important;
        }

        .select2-container .select2-selection--single {
            height: 58px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
            font-size: 14px;
            padding: 10px 22px;
            background: none;
            color: #000000;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 17px;
        }

        .select2-container--open .select2-dropdown--above {
            z-index: 10 !important;
        }

        .select2-dropdown {
            z-index: 9 !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            outline: none !important;
        }
    </style>
@endif

<!-- date-range-picker -->
<!-- Bootstrap Date-Picker Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

<script type="text/javascript">
    // var jsWebsiteUrl = $('#website_link').val();
    var jsWebsiteUrl = "{{ getBaseUrl() }}";
    $(document).ready(function () {
        // Tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Stripe checkout payments
        var stripe = Stripe('pk_test_51L1CSDB0DWwA7fx5BZRf6IfBsT3DJNqPshIxaomud8Jm3TiQSm5rguqylGxEPrWey5VCnUrpuCdHDyYIyQpDgs1y00Ua3gmIhW');
        var elements = stripe.elements();

        var card = elements.create('card', {
            hidePostalCode: true,
            style: {
                base: {
                    iconColor: '#666EE8',
                    color: '#31325F',
                    lineHeight: '40px',
                    fontWeight: 300,
                    fontFamily: 'Helvetica Neue',
                    fontSize: '15px',

                    '::placeholder': {
                        color: '#CFD7E0',
                    },
                },
            }
        });
        card.mount('#card-element');

        function setOutcome(result) {
            var successElement = document.querySelector('.success');
            var errorElement = document.querySelector('.error');
            successElement.classList.remove('visible');
            errorElement.classList.remove('visible');

            if (result.token) {
                // In this example, we're simply displaying the token
                successElement.querySelector('.token').textContent = result.token.id;
                successElement.classList.add('visible');

                // In a real integration, you'd submit the form with the token to your backend server
                //var form = document.querySelector('form');
                //form.querySelector('input[name="token"]').setAttribute('value', result.token.id);
                //form.submit();
            } else if (result.error) {
                errorElement.textContent = result.error.message;
                errorElement.classList.add('visible');
            }
        }

        card.on('change', function (event) {
            setOutcome(event);
        });

        document.querySelector('form').addEventListener('submit', function (e) {
            e.preventDefault();

            var options = {
                team_name: $('#team_name').val(),
                player_1_name: $('#player_1_name').val(),
                player_2_name: $('#player_2_name').val(),
                player_1_email: $('#player_1_email').val(),
            };
            stripe.createToken(card, options).then(setOutcome);
            $('#checkout-form').reset();
        });


    });


</script>

<!-- Custom -->
<script src="{{asset('js/site/custom.js')}}"></script>

<!-- Sweetalert -->
<script src="{{ asset('js/admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<!-- Fancybox -->
<link href="{{ asset('css/admin/plugins/fancybox/jquery.fancybox.min.css') }}" rel="stylesheet">
<!-- Fancybox -->
<script src="{{ asset('js/admin/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
<!-- Toastr js & rendering -->
<script src="{{ asset('js/admin/plugins/toastr/toastr.min.js') }}"></script>
@toastr_render
<script src="{{asset('js/site/development.js')}}"></script>

<!-- DataTables -->
<script src="{{ asset('js/admin/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/admin/dist/pages/datatable/datatable-basic.init.js') }}"></script>
<script src="{{ asset('js/admin/plugins/datatables-responsive/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/admin/plugins/datatables-responsive/responsive.bootstrap4.min.js') }}"></script>

{{--        stripe payment gateway--}}
<!--<script src="https://js.stripe.com/v3/"></script>-->

@stack('scripts')
<script type="text/javascript">
    @if(!Auth::user())
    @if (isset($_GET['popup']) && $_GET['popup'] == 'login')
    $(document).ready(function () {
        $('#loginModal').modal('show');
    });
    @endif
        @else
        @if (isset($_GET['popup']) && isset($_GET['redirect']) && $_GET['popup'] == 'login' && $_GET['redirect'] == 'join-a-league')
        window.location.href = $('#website_link').val() + '/users/join-a-league';
    @elseif (isset($_GET['popup']) && $_GET['popup'] == 'login')
        window.location.href = $('#website_link').val() + '/users/profile';
    @endif

    @endif
</script>

@stack('stripe-payment')





<script src="https://js.stripe.com/v3/"></script>

<script>
    // Set Stripe publishable key to initialize Stripe.js
    const stripe = Stripe('pk_test_51L1CSDB0DWwA7fx5BZRf6IfBsT3DJNqPshIxaomud8Jm3TiQSm5rguqylGxEPrWey5VCnUrpuCdHDyYIyQpDgs1y00Ua3gmIhW');

    // Select payment button
    const payBtn = document.querySelector("#checkoutBtn");

    // Payment request handler
    payBtn.addEventListener("click", function (evt) {

        setLoading(true);

        createCheckoutSession().then(function (data) {
            if(data.sessionId){
                stripe.redirectToCheckout({
                    sessionId: data.sessionId,
                }).then(handleResult);
            }else{
                handleResult(data);
            }
        });
    });

    // Create a Checkout Session with the selected product
    const createCheckoutSession = function (stripe) {
        const data =$('#leagueSignupForm').serialize();

        return fetch("/checkout", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            body: JSON.stringify({
                createCheckoutSession: 1,
                data:data
            }),
        }).then(function (result) {
            return result.json();
        });
    };

    // Handle any errors returned from Checkout
    const handleResult = function (result) {
        if (result.error) {
            showMessage(result.error.message);
        }

        setLoading(false);
    };

    // Show a spinner on payment processing
    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            payBtn.disabled = true;
            // document.querySelector("#spinner").classList.remove("hidden");
            // document.querySelector("#buttonText").classList.add("hidden");
        } else {
            // Enable the button and hide spinner
            payBtn.disabled = false;
            // document.querySelector("#spinner").classList.add("hidden");
            //  document.querySelector("#buttonText").classList.remove("hidden");
        }
    }

    // Display message
    function showMessage(messageText) {
        const messageContainer = document.querySelector("#paymentResponse");

        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;

        setTimeout(function () {
            messageContainer.classList.add("hidden");
            messageText.textContent = "";
        }, 5000);
    }
</script>





<script>
    // Using the module pattern for a jQuery feature
    $(function() {
        var app = (function() {
            var checkboxInput = ' input[type="checkbox"]',
                filters = {},rowData = [],values = [],key, value, show, length, divId;

            var init = function() {
                app.table = $('#example').DataTable({
                    "dom": "lrtip", // hide default DataTable search box
                    "bPaginate": false,
                    "bInfo" : false
                });

                $("#textSearch").on('keyup change', function() {
                    console.log('text search for: ' + $(this).val());
                    app.table.search($(this).val()).draw();
                });

                //$(checkboxInput).prop('checked', true);

                $(checkboxInput).change(function() {
                    var that = $(this);
                    if(that.hasClass('all')) {
                        $('#' + getFilterCategoryId(that) + checkboxInput).prop('checked', that.prop('checked'));
                    } else {
                        var allInput = $('#' + getFilterCategoryId(that) + checkboxInput + ':first');
                        console.log(allInput)
                        if(allInput.is(':checked')) {
                            allInput.prop('checked', false);
                        }
                    }
                    poulateAndApplyFilters();
                });
            };

            var poulateAndApplyFilters = function() {
                populateFilterValues();
                applyFiltersToTable();
            };

            var getFilterCategoryId = function(elem) {
                console.log(elem)
                divId = elem.parent().parent().parent()[0].id;
                console.log('divId is: ' + divId);
                return divId;
            };

            var trimAndLower = function(elem) {
                return elem.toLowerCase().trim();
            };

            var populateFilterValues = function() {
                console.log('Populating filter values');
                $(checkboxInput).each(function() {
                    if ($(this).is(":checked") && $(this).val() !== "all") {
                        value = trimAndLower($(this).val());
                        key = getFilterCategoryId($(this));
                        console.log('key: ' + key + ', value: ' + value);
                        if (filters[key] === undefined) {
                            console.log('Filter category is missing from object. Now creating new filter');
                            values.push(value);
                            filters[key] = values;
                        } else {
                            console.log('Filter category is already existing in object');
                            filters[key].push(value);
                        }
                        values = [];
                    }
                });
                console.log('Filter population complete');
            };

            var populateRowData = function(row) {
                row.find('td').each(function() {
                    console.log('Populating row data with ' + $(this).text());
                    rowData.push(trimAndLower($(this).text()));
                });
            };

            var applyFiltersToTable = function() {
                console.log('Applying filters to table');
                if (filters[key] === undefined) {
                    // show all table rows when no checkboxes are selected
                    $("table tbody tr").show();
                } else {
                    $("table tr").each(function() {
                        // initialize 'show' variable to false for each table row
                        show = false;
                        populateRowData($(this));
                        // make sure 'rowData' array has elements
                        if (rowData.length > 0) {
                            // loop through each key in 'filters' object
                            for (var k in filters) {
                                if (filters.hasOwnProperty(k)) {
                                    console.log('filter key: ' + k);
                                    length = filters[k].length;
                                    // loop through each array value at index 'i'
                                    for (var i = 0; i < length; i++) {
                                        value = filters[k][i];
                                        if (rowData.indexOf(value) !== -1) {
                                            show = true;
                                            break;
                                        }
                                    }
                                    if (show) {
                                        $(this).show();
                                    } else {
                                        $(this).hide();
                                        break;
                                    }
                                    show = false;
                                }
                            }
                        }
                        rowData = [];
                    });
                    filters = {};
                }
            };

            return {
                init: init
            };
        })();

        app.init();
    });


// $(".fa-circle-question").mouseover(function(){

// $('.availability').tooltip('show')
// })
</script>





</body>
</html>
