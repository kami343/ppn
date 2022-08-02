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
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/stylemodal.css">
    <link rel="stylesheet" href="assets/css/green.css">
    <link rel="stylesheet" href="assets/fonts/stylesheet.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    {{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}
    <link rel="stylesheet" href="{{asset('css/admin/plugins/selectpicker/bootstrap-select.css')}}">
    <!-- Custom -->
    <script src="{{asset('js/site/custom.js')}}"></script>
    <!-- Sweetalert -->
    <script src="{{ asset('js/admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    {{--    Toastr--}}
    <link href="{{ asset('css/admin/plugins/toastr/toastr.min.css') }}" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        label.error {
            color: red;
        }

        :hover {
            color: var(--hover-color);
        }

        .fa-circle-arrow-left {
            color: #B0E500;
            cursor: pointer;

        }


    </style>
    <title>Create Account</title>
</head>

<body>
<section class="container-fluid fullcontent">
    <input type="hidden" name="website_link" id="website_link" value="{{ url('/') }}"/>
    <div class="row fullcontent">
        <div class="col-lg-3 blacksecpadd">
            <div class="acc-leftblacksec">
                <a href="/" class="logo"><img src="assets/img/logo-white.png" alt="" width="100%"></a>

                <h3 class="leftmaintttl">Get started today!</h3>
                <p class="p-font-size">Join PPN to register for leagues</p>

                <ul class="accpointsec list-unstyled">
                    <li>
                        <div class="accleftpoint"><i class="fa-solid fa-check"></i></div>
                        <h4>Get started fast with our free tier</h4>
                        <p>Every product has a meaningful free tier so you can build without friction.</p>
                    </li>
                    <li>
                        <div class="accleftpoint"><i class="fa-solid fa-check"></i></div>
                        <h4>Access all Mapbox services</h4>
                        <p>Use our design and development tools for apps, navigation, AR, data visualization, and
                            more!</p>
                    </li>
                    <li>
                        <div class="accleftpoint"><i class="fa-solid fa-check"></i></div>
                        <h4>Trusted by top industry leaders</h4>
                        <p>Join over 2.7 million registered developers building with Mapbox SDKs and APIs</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 position-relative">
            <div class="mainpadd">
                <div class="row">
                    <div class="col-lg-8 m-auto">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(session('errstatus'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('errstatus') }}
                            </div>
                        @endif
                        <div class="stepsec mt-1">
                            <div class="stepline"></div>

                            <ul class="nav nav-pills nav-fill navtop cust-step">
                                <li class="nav-item">
                                    <a class="nav-link active" id="one-tab" data-toggle="tab">1</a>
                                    <p>Login Details</p>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="two-tab" data-toggle="tab">2</a>
                                    <p>Account Details</p>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="three-tab" data-toggle="tab">3</a>
                                    <p>Player Details</p>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="four-tab" data-toggle="tab">4</a>
                                    <p>Waiver</p>
                                </li>
                            </ul>
                        </div>

                        <h1 class="loginttl">Create your PPN account</h1>
                        <p>Already have an account? <a href="{{url('/login-new')}}"
                                                                              class="lnklogin">Log in <i
                                    class="fa-solid fa-chevron-right"></i></a></p>
                        {{ Form::open([
                             'method'=> 'POST',
                             'class' => 'frmgen',
                             'route' => ['site.ajax-registration-submit'],
                             'name'  => 'createNewLeagueForm',
                             'id'    => 'createNewLeagueForm',
                             'files' => true,
                             'novalidate' => true ]) }}

                        <form class="frmgen" action="site.ajax-registration-submit" method="post" id="register-form"
                              novalidate="novalidate">

                            <div id="step1">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>First Name <span style="color: red;">*</span></label>
                                            <input type="text" id="first_name" name="first_name" class="form-control"
                                                   placeholder="Enter first name">
                                            <small id="first_name_error" class="d-none text-danger">first name is
                                                required</small>


                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Last Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name"
                                                   placeholder="Enter last name">
                                            <small id="last_name_error" class="d-none text-danger">last name is
                                                required</small>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Email <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                   placeholder="Enter email">
                                            <small id="email_error" class="d-none text-danger">email is required</small>

                                        </div>
                                        <div id="email_error_alert" class="d-none alert alert-danger">
                                            It looks like you already have an account. <a href="{{url('/login-new')}}"
                                                                                          class="lnklogin">Log in</a> to
                                            your account.
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Password <span style="color: red;">*</span></label>
                                            <div class="input-group tgpass">
                                                <input type="password" id="password" name="password"
                                                       class="form-control pwd"
                                                       placeholder="Enter password" value="" autocomplete="off">
                                                <span class="input-group-btn">
												<button class="btn-default reveal" type="button"><i
                                                        class="fa-solid fa-eye"></i></button>
											  </span>
                                            </div>
                                            <small id="password_error" class="d-none text-danger">Password must be at
                                                least 6 characters</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Confirm Password <span style="color: red;">*</span></label>
                                            <div class="input-group tgpass">
                                                <input type="password" id="confirm_password" name="confirm_password"
                                                       class="form-control pwd"
                                                       placeholder="Enter confirm password" value="" autocomplete="off">
                                                <span class="input-group-btn">
												<button class="btn-default reveal" type="button"><i
                                                        class="fa-solid fa-eye"></i></button>
											  </span>
                                            </div>
                                            <small id="confirm_password_error" class="d-none text-danger">Password must
                                                be at least 6 characters</small>
                                            <small id="both_password_error" class="d-none text-danger">Both passwords must be the same</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group d-flex justify-content-between mt-3">
                                            <a id="btn-2" class="btn btn-next-step">Next Step</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-none" id="step2">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Address Line 1 <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="address_line_1"
                                                   name="address_line_1" placeholder="Enter Address Line 1">
                                            <small id="address_line_1_error" class="d-none text-danger">address 1 is
                                                required</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" id="address_line_2"
                                                   name="address_line_2" placeholder="Enter Address Line 2">
                                            <small id="address_line_2_error" class="d-none text-danger">address 2 is
                                                required</small>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>City <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="city" name="city"
                                                   placeholder="Enter City">
                                            <small id="city_error" class="d-none text-danger">city is required</small>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>State <span style="color: red;">*</span></label>
                                            <div class="selectgroup">
                                                <i class="fa-solid fa-chevron-down"></i>
                                                <select id="state" name="state" class="form-control">
                                                    <option value="" selected>Select State</option>
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}">{!! $state->title !!}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <small id="state_error" class="d-none text-danger">state is required</small>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Phone <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="phone_no" name="phone_no"
                                                   placeholder="Enter Phone">
                                            <small id="phone_no_error" class="d-none text-danger">Phone is required</small>
                                            <small id="phone_no_error1" class="d-none text-danger">Format is not valid</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <label class="form-group-date">Date Of Birth <span
                                                    style="color: red;">*</span></label>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <div class="selectgroup">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                        <select id="month" name="month" class="form-control">
                                                            <option value="" selected>MM</option>
                                                            @for ($month = 1; $month <= 12; $month++)
                                                                <option
                                                                    value="{{ sprintf("%02d", $month) }}">{{ sprintf("%02d", $month) }}</option>
                                                            @endfor
                                                        </select>
                                                        <small id="month_error" class="d-none text-danger">month is
                                                            required</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <div class="selectgroup">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                        <select id="day" name="day" class="form-control">
                                                            <option value="" selected>DD</option>
                                                            @for ($day = 1; $day <= 31; $day++)
                                                                <option
                                                                    value="{{sprintf("%02d", $day)}}">{{sprintf("%02d", $day)}}</option>
                                                            @endfor
                                                        </select>
                                                        <small id="day_error" class="d-none text-danger">day is
                                                            required</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <div class="selectgroup">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                        <select id="year" name="year" class="form-control">
                                                            <option value="" selected>YYYY</option>
                                                            @for ($year = (date('Y') - 18); $year >= 1900; $year--)
                                                                <option value="{{ $year }}">{{ $year }}</option>
                                                            @endfor
                                                        </select>
                                                        <small id="year_error" class="d-none text-danger">year is
                                                            required</small>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Gender <span style="color: red;">*</span></label>

                                            <div>
                                                <div class="form-check-inline radio">
                                                    <ul style="padding-left: 0px;margin-bottom: 0px;">
                                                        <li class="list-inline-item">
                                                            <label class="customradio"><span
                                                                    class="radiotextsty">Female</span>
                                                                <input type="radio" value="F"
                                                                       name="gender" id="gender">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <label class="customradio"><span
                                                                    class="radiotextsty">Male</span>
                                                                <input type="radio" value="M"
                                                                       name="gender" id="gender">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <label class="customradio"><span
                                                                    class="radiotextsty">Other</span>
                                                                <input type="radio" value="U"
                                                                       name="gender" id="gender">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                    <small id="gender_error" class="d-none text-danger">gender is
                                                        required</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group d-flex justify-content-between mt-1">
                                               <a id="one-back" class="btn mt-5" style="width: 0.5px;height: 0.2px;border: 1px solid #B0E500;">
                                                   <i class="fa-3x fa-solid fa-circle-arrow-left" style="background-color:black;border-radius: 80%;border: 1px solid #B0E500;"></i>
                                               </a>
                                            <a id="btn-3" class="btn btn-next-step">Next Step</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-none" id="step3">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Player Rating <span style="color: red;">*</span></label>
                                            <div class="selectgroup">
                                                <i class="fa-solid fa-chevron-down"></i>
                                                <select id="player_rating" name="player_rating" class="form-control">
                                                    <option value="">Select</option>
                                                    @for ($playerRating = 2.0; $playerRating <= 5.5; $playerRating += 0.25)
                                                        <option
                                                            value="{{ formatToTwoDecimalPlaces($playerRating) }}">{{ formatToTwoDecimalPlaces($playerRating)}}@if ($playerRating == 5.50)
                                                                + @endif</option>
                                                    @endfor
                                                </select>
                                                <small id="player_rating_error" class="d-none text-danger">player rating
                                                    is required</small>
                                            </div>
                                            <label><a
                                                    href="{{ asset('images/uploads/USAPA-Skill-Rating-Definitions-2020.pdf') }}"
                                                    class="inpt-lnk" target="_blank">Help Me Choose My
                                                    Rating</a></label>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div id="home-court-div-up">
                                                <div class="holder-inner">

                                                    <label class="placeholder-label-selectpicker" id="pref-home-court">Preferred
                                                        Home Court<span class="text-red">*</span></label>
                                                   <div id="home_court_div">
                                                       <select name="home_court" id="home_court"
                                                               class="selectpicker text-dark form-control"
                                                               data-live-search="true"
                                                               {{--                                                            data-live-search-placeholder="Search"--}}
                                                               data-actions-box="true" data-placeholder="Search">


                                                       </select>
                                                   </div>

                                                    <small id="home_court_error" class="d-none text-danger">home court
                                                        is required</small>

                                                    {{--                                                    <a href="javascript:void(0);" data-bs-toggle="modal"--}}
                                                    {{--                                                       data-bs-target="#pickleballCourtModal"><img--}}
                                                    {{--                                                            src="{{ asset("images/site/plus-circle.png") }}"--}}
                                                    {{--                                                            style="width: 18px;"/> Can’t find your court, click here to--}}
                                                    {{--                                                        add it</a>--}}

                                                </div>
                                            </div>
                                            <label><a class="inpt-lnk" href="{{ route('site.local-court') }}"
                                                      target="_blank">@lang('custom.label_find_a_local_court')</a></label>

                                        </div>

                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            @if ($availabilities && $availabilities->count())
                                                <div class="col-lg-12 form-group">
                                                    <label class="tooltip_cls pb-0 mb-0"><strong>Playing Time Availability<span
                                                                class="text-red">*</span></strong> <i
                                                            id="question_mark_tooltip"
                                                            class="fa-2xs fa fa-question-circle cursor-pointer"
                                                            aria-hidden="true" data-toggle="tooltip"
                                                            title="To best facilitate league play, please specify your playing time availability. You will have the opportunity to change this as needed"></i>
                                                        </label>
                                                    <small class="text-small"><i>(Select all that apply)</i></small>

                                                    <div class="row mt-3" id="availability">
                                                        @foreach ($availabilities as $availability)
                                                            <div>
                                                                <div class="form-check display-inline-block">
                                                                    <input
                                                                        class="form-check-input available error-checkbox"
                                                                        type="checkbox"
                                                                        value="{!! $availability->id !!}"
                                                                        id="availability_{{ $availability->id }}"
                                                                        name="availability[]">
                                                                    <p for="availability_{{ $availability->id }}">{!! $availability->title !!}</p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <small id="availability_error" class="d-none text-danger">availability
                                                        is required</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>How Did You Hear About Us?</label>
                                            <div class="selectgroup">
                                                <i class="fa-solid fa-chevron-down"></i>
                                                <select id="how_did_you_find_us" name="how_did_you_find_us"
                                                        class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach (config('global.HOW_DID_YOU_HEAR_ABOUT_US') as $key => $item)
                                                        <option value="{!! $key !!}">{!! $item !!}</option>
                                                    @endforeach
                                                </select>
                                                <small id="how_did_you_find_us_error" class="d-none text-danger">field
                                                    is required</small>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group d-flex justify-content-between mt-1">

                                            <a id="two-back" class="btn mt-5" style="width: 0.5px;height: 0.2px;border: 1px solid #B0E500;">
                                                <i class="fa-3x fa-solid fa-circle-arrow-left" style="background-color:black;border-radius: 80%;border: 1px solid #B0E500;"></i>
                                            </a>
                                            <a id="btn-4" class="btn btn-next-step">Proceed
                                                to Waiver</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-none" id="step4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Waiver</label>
                                            <div id="scroll-section" class="terms-scroll">
                                                <p>Lorem Ipsum is simply dummy text of the printing and
                                                    typesetting industry. Lorem Ipsum has been the
                                                    industry's standard dummy text ever since the 1500s,
                                                    when an unknown printer took a galley of type and
                                                    scrambled it to make a type specimen book Lorem Ipsum is
                                                    simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has</p>
                                                <p>Been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and
                                                    scrambled it to make a type specimen book Lorem Ipsum is
                                                    simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has</p>
                                                <p>Been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and
                                                    scrambled it to make a type specimen book</p>
                                                <p>Lorem Ipsum is simply dummy text of the printing and
                                                    typesetting industry. Lorem Ipsum has been the
                                                    industry's standard dummy text ever since the 1500s,
                                                    when an unknown printer took a galley of type and
                                                    scrambled it to make a type specimen book Lorem Ipsum is
                                                    simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has</p>
                                                <p>Been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and
                                                    scrambled it to make a type specimen book Lorem Ipsum is
                                                    simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has</p>
                                                <p>Been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and
                                                    scrambled it to make a type specimen book</p>
                                            </div>
                                            <label id="checkbox-id" class="customcheck text-muted"
                                                   style="font-weight: 400;">By clicking
                                                this checkbox, I acknowledge that I have read, understand
                                                and agree to the above waiver and <a href="/terms-of-use"
                                                                                     class="lnklogin">Terms
                                                    of Use</a>.<span style="color: red;">*</span>
                                                <input type="checkbox" disabled id="agree" name="agree" value="1"
                                                >
                                                <span class="checkmark"></span>
                                            </label>
                                            <small id="agree_error" class="text-danger d-none">Please scroll to the bottom of the waiver before clicking this checkbox</small>
                                            <small id="agree_error1" class="text-danger d-none">Please click on the checkbox</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group d-flex justify-content-between">
                                            <a id="three-back" class="btn mt-5" style="width: 0.5px;height: 0.2px;border: 1px solid #B0E500;">
                                                <i class="fa-3x fa-solid fa-circle-arrow-left" style="background-color:black;border-radius: 80%;border: 1px solid #B0E500;"></i>
                                            </a>
                                            <button type="submit" id="submit" name="submit" class="btn btn-next-step">
                                                Complete Registration
                                            </button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </form>


                        {{ Form::close() }}


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
                                        <form id="modal-form" name="modal-form" novalidate="novalidate"
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

                        <div class="container">
                            <div class="row">
                                <div class="well col-md-offset-3 col-md-6">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row footer">
                <div class="col-lg-6 col-md-6">
                    <p>© Pickleball Players Network</p>
                </div>
                <div class="col-lg-6 col-md-6">
                    <p>
                    <ul class="footlink">
                        <li class="list-inline-item"><a href="{{url('/terms-of-use')}}">Terms</a></li>
                        <li class="list-inline-item"><a href="{{url('/privacy-policy')}}">Privacy</a></li>
                    </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="js/site/jquery-input-mask-phone-number.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/theme.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('js/site/bootstrap-select.min.js')}}"></script>

<script src="{{asset('js/admin/plugins/selectpicker/bootstrap-select.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
    $('#phone_no').usPhoneFormat({
        format: '(xxx) xxx-xxxx',
    });
    $('#scroll-section').bind('scroll', function () {
        var element = document.getElementById('scroll-section');
        if (element.scrollHeight - element.scrollTop === element.clientHeight) {
            // $('#agree').prop('checked', true);
            $('#checkbox-id').removeClass('text-muted')
            $('#agree').removeAttr('Disabled');

        }
        // } else {
        //     $('#agree').prop('checked', false);
        // }

    });
    $(document).ready(function () {
        $('#checkbox-id').click(function () {
            if($('#checkbox-id').hasClass('text-muted')){
                $('#agree_error').removeClass('d-none');
                $('#agree_error').addClass('d-block');
                $('#agree_error1').removeClass('d-block');
                $('#agree_error1').addClass('d-none');
            }
        })

        $('#submit').click(function (e) {
            const active = $('#agree').prop("checked") ? 1 : 0 ;

            if (active==0 && !$('#checkbox-id').hasClass('text-muted')){
                e.preventDefault()
                $('#agree_error').removeClass('d-block');
                $('#agree_error').addClass('d-none');
                $('#agree_error1').removeClass('d-none');
                $('#agree_error1').addClass('d-block');
            }
        })

        $('#pickleballCourtModal').modal({
            backdrop: 'static',
            keyboard: false
        })
        $('#home_court').change(function () {
            const modalShow = $('#home_court').val();
            if (modalShow == 'modal')
            $('#pickleballCourtModal').modal({backdrop: 'static', keyboard: false}, 'show');
        });


        // $('#email').change(function () {
        //     const email = $('#email').val();
        //
        //
        //     var websiteLink = $('#website_link').val();
        //      var checkEmailUrl = websiteLink + '/ajax-check-email/'+email;
        //      checkEmailExistence(checkEmailUrl)
        //      // setTimeout(function () {
        //      //     checkEmailExistence(checkEmailUrl)
        //      // }, 15000);
        //
        // })
        $('#email').keyup(function (e) {
            const email = e.target.value;


            var websiteLink = $('#website_link').val();
            var checkEmailUrl = 'https://demosite.usapickleballnetwork.com/ajax-check-email/' + email;

            if (email.includes(".")) {
                // console.log(checkEmailUrl+"/")
                checkEmailExistence(checkEmailUrl + "}")
            }
            // setTimeout(function () {
            //     checkEmailExistence(checkEmailUrl)
            // }, 15000);

        })


        function checkEmailExistence(checkEmailUrl) {
            $.ajax({
                url: checkEmailUrl,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response == 1) {
                        $('#email_error_alert').removeClass('d-none');
                        $('#email_error_alert').addClass('d-block');
                    } else {
                        $('#email_error_alert').removeClass('d-block');
                        $('#email_error_alert').addClass('d-none');
                    }
                }
            });

        }

        $(".reveal").on('click', function () {
            var $pwd = $(".pwd");
            if ($pwd.attr('type') === 'password') {
                $pwd.attr('type', 'text');
            } else {
                $pwd.attr('type', 'password');
            }
        });


        $('#phone_no').keyup(function () {
            // ^(\([0-9]{3}\) |[0-9]{3}-)[0-9]{3}-[0-9]{4}$
            var reg = /^(\([0-9]{3}\) |[0-9]{3}-)[0-9]{3}-[0-9]{4}$/;
            if (reg.test($('#phone_no').val())) {
                $('#phone_no_error').removeClass('d-block')
                $('#phone_no_error').addClass('d-none')
                $('#phone_no_error1').removeClass('d-block')
                $('#phone_no_error1').addClass('d-none')
            }
        })

        $('#one-tab,#one-back').click(function () {
            $('#one-tab').addClass("active");
            $('#two-tab').removeClass("active");
            $('#three-tab').removeClass("active");
            $('#four-tab').removeClass("active");


            $('#step1').removeClass("d-none");
            $('#step1').addClass("d-block");

            $('#step2').addClass("d-none");
            $('#step2').removeClass("d-block");

            $('#step3').addClass("d-none");
            $('#step3').removeClass("d-block");

            $('#step4').addClass("d-none");
            $('#step4').removeClass("d-block");
        })
        $('#first_name').keyup(function () {
            if ($('#first_name').val().length > 0) {
                $('#first_name_error').removeClass('d-block');
                $('#first_name_error').addClass('d-none');
            }
        })
        $('#last_name').keyup(function () {
            if ($('#last_name').val().length > 0) {
                $('#last_name_error').removeClass('d-block');
                $('#last_name_error').addClass('d-none');
            }
        })
        $('#email').keyup(function () {
            if ($('#email').val().length > 0) {
                $('#email_error').removeClass('d-block');
                $('#email_error').addClass('d-none');
            }
        })
        $('#password').keyup(function () {
            if ($('#password').val().length >= 6) {
                $('#password_error').removeClass('d-block');
                $('#password_error').addClass('d-none');
            } else {
                $('#password_error').removeClass('d-none');
                $('#password_error').addClass('d-block');
            }
        })
        $('#confirm_password').keyup(function () {
            if ($('#confirm_password').val().length >= 6) {
                $('#confirm_password_error').removeClass('d-block');
                $('#confirm_password_error').addClass('d-none');
                if ($('#confirm_password').val()===$('#password').val()){
                    $('#both_password_error').removeClass('d-block');
                    $('#both_password_error').addClass('d-none');
                }
            } else {
                $('#confirm_password_error').removeClass('d-none');
                $('#confirm_password_error').addClass('d-block');
            }
        })

        $('#two-tab,#btn-2,#two-back').click(function () {
            if ($('#first_name').val() == '' && $('#last_name').val() == '' && $('#email').val() == '' && $('#password').val() == '' && $('#confirm_password').val() == '') {
                $('#first_name_error').removeClass('d-none');
                $('#first_name_error').addClass('d-block');
                $('#last_name_error').removeClass('d-none');
                $('#last_name_error').addClass('d-block');
                $('#email_error').removeClass('d-none');
                $('#email_error').addClass('d-block');
                $('#password_error').removeClass('d-none');
                $('#password_error').addClass('d-block');
                $('#confirm_password_error').removeClass('d-none');
                $('#confirm_password_error').addClass('d-block');
            } else if ($('#first_name').val() == '') {
                $('#first_name_error').removeClass('d-none');
                $('#first_name_error').addClass('d-block');
            } else if ($('#last_name').val() == '') {
                $('#last_name_error').removeClass('d-none');
                $('#last_name_error').addClass('d-block');
            } else if ($('#email').val() == '') {
                $('#email_error').removeClass('d-none');
                $('#email_error').addClass('d-block');
            } else if ($('#password').val() == '') {
                $('#password_error').removeClass('d-none');
                $('#password_error').addClass('d-block');
            } else if ($('#confirm_password').val() == '') {
                $('#confirm_password_error').removeClass('d-none');
                $('#confirm_password_error').addClass('d-block');
            }
            else if(($('#password').val() !== $('#confirm_password').val())){
                $('#both_password_error').removeClass('d-none');
                $('#both_password_error').addClass('d-block');
            }
            else if($('#password').val().length<6 || $('#confirm_password').val().length<6){

            }
            else {
                $('#two-tab').addClass("active");
                $('#one-tab').removeClass("active");
                $('#three-tab').removeClass("active");
                $('#four-tab').removeClass("active");

                $('#step1').removeClass("d-block");
                $('#step1').addClass("d-none");

                $('#step2').addClass("d-block");
                $('#step2').removeClass("d-none");

                $('#step3').addClass("d-none");
                $('#step3').removeClass("d-block");

                $('#step4').addClass("d-none");
                $('#step4').removeClass("d-block");

            }
        })

        $('#address_line_1').keyup(function () {
            if ($('#address_line_1').val().length > 0) {
                $('#address_line_1_error').removeClass('d-block');
                $('#address_line_1_error').addClass('d-none');
            } else {
                $('#address_line_1_error').removeClass('d-none');
                $('#address_line_1_error').addClass('d-block');
            }
        })
        $('#city').keyup(function () {
            if ($('#city').val().length > 0) {
                $('#city_error').removeClass('d-block');
                $('#city_error').addClass('d-none');
            } else {
                $('#city_error').removeClass('d-none');
                $('#city_error').addClass('d-block');
            }
        })
        $('#state').change(function () {
            if ($('#state').val().length > 0) {
                $('#state_error').removeClass('d-block');
                $('#state_error').addClass('d-none');
            } else {
                $('#state_error').removeClass('d-none');
                $('#state_error').addClass('d-block');
            }
        })

        $('#month').change(function () {
            if ($('#month').val().length > 0) {
                $('#month_error').removeClass('d-block');
                $('#month_error').addClass('d-none');
            } else {
                $('#month_error').removeClass('d-none');
                $('#month_error').addClass('d-block');
            }
        })
        $('#day').change(function () {
            if ($('#day').val().length > 0) {
                $('#day_error').removeClass('d-block');
                $('#day_error').addClass('d-none');
            } else {
                $('#day_error').removeClass('d-none');
                $('#day_error').addClass('d-block');
            }
        })
        $('#year').change(function () {
            if ($('#year').val().length > 0) {
                $('#year_error').removeClass('d-block');
                $('#year_error').addClass('d-none');
            } else {
                $('#year_error').removeClass('d-none');
                $('#year_error').addClass('d-block');
            }
        })
        $('input[type=radio][name=gender]').change(function () {
            if ($('input[type=radio][name=gender]').is(':checked')) {
                $('#gender_error').removeClass('d-block');
                $('#gender_error').addClass('d-none');
            } else {
                $('#gender_error').removeClass('d-none');
                $('#gender_error').addClass('d-block');
            }
        })

        $('#three-tab,#btn-3,#three-back').click(function (e) {
            var reg = /^(\([0-9]{3}\) |[0-9]{3}-)[0-9]{3}-[0-9]{4}$/;
            if ($('#address_line_1').val() == '' &&
                $('#city').val() == '' &&
                $('#state').val() == '' &&
                $('#phone_no').val() == '' &&
                $('#month').val() == '' &&
                $('#day').val() == '' &&
                $('#year').val() == '' && !$('input[type=radio][name=gender]').is(':checked')) {
                $('#address_line_1_error').removeClass('d-none');
                $('#address_line_1_error').addClass('d-block');
                $('#city_error').removeClass('d-none');
                $('#city_error').addClass('d-block');
                $('#state_error').removeClass('d-none');
                $('#state_error').addClass('d-block');
                $('#phone_no_error').removeClass('d-none');
                $('#phone_no_error').addClass('d-block');
                $('#phone_no_error1').removeClass('d-block');
                $('#phone_no_error1').addClass('d-none');
                $('#month_error').removeClass('d-none');
                $('#month_error').addClass('d-block');
                $('#day_error').removeClass('d-none');
                $('#day_error').addClass('d-block');
                $('#year_error').removeClass('d-none');
                $('#year_error').addClass('d-block');
                $('#gender_error').removeClass('d-none');
                $('#gender_error').addClass('d-block');
            } else if ($('#address_line_1').val() == '') {
                $('#address_line_1_error').removeClass('d-none');
                $('#address_line_1_error').addClass('d-block');
            } else if ($('#city').val() == '') {
                $('#city_error').removeClass('d-none');
                $('#city_error').addClass('d-block');
            } else if ($('#state').val() == '') {
                $('#state_error').removeClass('d-none');
                $('#state_error').addClass('d-block');
            } else if ($('#phone_no').val() == '') {
                $('#phone_no_error').removeClass('d-none');
                $('#phone_no_error').addClass('d-block');
                $('#phone_no_error1').removeClass('d-block');
                $('#phone_no_error1').addClass('d-none');
            }
            else if (!reg.test($('#phone_no').val())){
                $('#phone_no_error').removeClass('d-block');
                $('#phone_no_error').addClass('d-none');
                $('#phone_no_error1').removeClass('d-none');
                $('#phone_no_error1').addClass('d-block');
            }
            else if ($('#month').val() == '') {
                $('#month_error').removeClass('d-none');
                $('#month_error').addClass('d-block');
            } else if ($('#day').val() == '') {
                $('#day_error').removeClass('d-none');
                $('#day_error').addClass('d-block');
            } else if ($('#year').val() == '') {
                $('#year_error').removeClass('d-none');
                $('#year_error').addClass('d-block');
            } else if (!$('input[type=radio][name=gender]').is(':checked')) {
                $('#gender_error').removeClass('d-none');
                $('#gender_error').addClass('d-block');
            } else {
                $('#three-tab').addClass("active");
                $('#two-tab').removeClass("active");
                $('#one-tab').removeClass("active");
                $('#four-tab').removeClass("active");


                $('#step1').removeClass("d-block");
                $('#step1').addClass("d-none");

                $('#step2').addClass("d-none");
                $('#step2').removeClass("d-block");

                $('#step3').addClass("d-block");
                $('#step3').removeClass("d-none");

                $('#step4').addClass("d-none");
                $('#step4').removeClass("d-block");
            }

        })

        $('#player_rating').change(function () {
            if ($('#player_rating').val().length > 0) {
                $('#player_rating_error').removeClass('d-block');
                $('#player_rating_error').addClass('d-none');
            } else {
                $('#player_rating_error').removeClass('d-none');
                $('#player_rating_error').addClass('d-block');
            }
        })

        $('#home_court').change(function () {
            if ($('#home_court').val().length > 0) {
                $('#home_court_error').removeClass('d-block');
                $('#home_court_error').addClass('d-none');
            } else {
                $('#home_court_error').removeClass('d-none');
                $('#home_court_error').addClass('d-block');
            }
        })

        $('#availability_1,#availability_2,#availability_3,#availability_4').change(function () {
            if ($('#availability_1').is(':checked') || $('#availability_2').is(':checked') || $('#availability_3').is(':checked') || $('#availability_4').is(':checked')) {
                $('#availability_error').removeClass('d-block');
                $('#availability_error').addClass('d-none');
            } else {
                $('#availability_error').removeClass('d-none');
                $('#availability_error').addClass('d-block');
            }
        })

        $('#four-tab,#btn-4').click(function () {

            if ($('#player_rating').val() == '' && $('#home_court').val() == '' && !$('#availability_1').is(':checked') && !$('#availability_2').is(':checked') && !$('#availability_3').is(':checked') && !$('#availability_4').is(':checked')) {
                $('#player_rating_error').removeClass('d-none');
                $('#player_rating_error').addClass('d-block');
                $('#home_court_error').removeClass('d-none');
                $('#home_court_error').addClass('d-block');
                $('#availability_error').removeClass('d-none');
                $('#availability_error').addClass('d-block');

            } else if ($('#player_rating').val() == '') {
                $('#player_rating_error').removeClass('d-none');
                $('#player_rating_error').addClass('d-block');
            } else if ($('#home_court').val() == '') {
                $('#home_court_error').removeClass('d-none');
                $('#home_court_error').addClass('d-block');
            } else if (!$('#availability_1').is(':checked') && !$('#availability_2').is(':checked') && !$('#availability_3').is(':checked') && !$('#availability_4').is(':checked')) {
                $('#availability_error').removeClass('d-none');
                $('#availability_error').addClass('d-block');
            } else {
                $('#four-tab').addClass("active");
                $('#two-tab').removeClass("active");
                $('#three-tab').removeClass("active");
                $('#one-tab').removeClass("active");

                $('#step1').removeClass("d-block");
                $('#step1').addClass("d-none");

                $('#step2').addClass("d-none");
                $('#step2').removeClass("d-block");

                $('#step3').addClass("d-none");
                $('#step3').removeClass("d-block");

                $('#step4').addClass("d-block");
                $('#step4').removeClass("d-none");
            }
        })

        // $('#submit').click(function (e) {
        //     if (!$('input[name="agree"]').is(':checked')) {
        //         e.preventDefault()
        //         $('#agree_error').removeClass('d-none');
        //         $('#agree_error').addClass('d-block');
        //     }
        // })
    })

    $(document).ready(function ($) {
        populateNewHomeCourt();


        $(function () {
            $('#question_mark_tooltip').tooltip().on("mouseenter", function () {
                var $this = $(this),
                    tooltip = $this.next(".tooltip");
                tooltip.find(".tooltip-inner").css({
                    width: "500px",
                });
            });
        });
        $("#modal-form").validate({
            rules: {
                court_name: "required",
                city: "required",
                state_id: "required"

            },
            messages: {
                court_name: "Please enter your court name",
                city: "Please enter your city",
                state_id: "Please enter your state",

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
                var pickleballCourtSubmitUrl = websiteLink + '/ajax-pickleball-court-submit';

                $.ajax({
                    url: pickleballCourtSubmitUrl,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#modal-form').serialize(),
                    dataType: 'json',
                    success: function (response) {
                        populateNewHomeCourt();
                        // $('#modal-alert').removeClass('d-none');
                        // $('#modal-alert').addClass('d-block');
                        // $('#pickleballCourtModal').modal('hide');
                    }
                });
            }

        });

        function populateNewHomeCourt(){
            // $("#bs-select-1").empty()
            $.get( "/getcourts", function( data ) {

                $('.selectpicker').html('');
                $('.selectpicker').empty();
                console.log(data)
                $.each(data , function (key, value) {
                    if (value.title!=="Private Residence / At Home Court")
                    $('.selectpicker').append(`<option value="${value.id}">${value.title} (${value.state},${value.code})</option>`);
                });
                $.each(data , function (key, value) {
                    if (value.title=="Private Residence / At Home Court")
                    $('.selectpicker').append(`<option style="color:black; border: 2px solid lightslategray;border-radius: 5px;--hover-color: #B0E500;background-color: #E7E6E1" value="${value.id}">${value.title}</option>`);
                });
                $('#bs-select-1').append('<div style="color:black;padding:2px;margin-top:2px;border: 2px solid lightslategray;border-radius: 5px;--hover-color: #B0E500;background-color: #E7E6E1"><i class="fa-1x fa fa-plus-circle" style="color:#B0E500;border-radius: 55%;margin-left: 3.5%;--hover-color: #B0E500;background-color: black"></i><strong><a style="color: black" \n' +
                    '        href="javascript:void(0);"\n' +
                    '        class="text-dark"\n' +
                    '        data-bs-toggle="modal"\n' +
                    '        data-bs-target="#pickleballCourtModal">\n' +
                    '            Can’t find your court, click\n' +
                    '        here to\n' +
                    '        add it</a></strong><div>');
                 $('.selectpicker').selectpicker('refresh');

                $('#modal-form')[0].reset();

                $('#pickleballCourtModal').modal('hide');

            });
        }
        function populateNewHomeCourtAfter(){
            // $("#bs-select-1").empty()
            $.get( "/getcourts", function( data ) {
                $.each(data , function (key, value) {
                    var groupFilter = $('#home_court');
                    groupFilter.selectpicker('val', value.id);
                    groupFilter.find('option').remove();
                    groupFilter.selectpicker("refresh");
                });
                // teamPositionFilter.selectpicker('refresh');

                $('#modal-form')[0].reset();

                $('#pickleballCourtModal').modal('hide');

            });
        }
    });

</script>
</body>
</html>
