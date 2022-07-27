@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')
    <div class="container">

        <table class="table mt-3">
            <thead class="thead text-dark" style="background-color: #c8fe0a">
            <tr>
                <th>League Name</th>
                <th>Location</th>
                <th>Play Type</th>
                <th>Gender</th>
                <th>Ratings</th>
                <th>Dates</th>
                <th>Teams Registered</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                    <td>{{$specificLeague->league_name}}</td>
                    <td>{{$specificLeague->city}}</td>
                    <td>{{$specificLeague->play_type}}</td>
                    <td>{{$specificLeague->gender}}</td>
                    <td>{{$specificLeague->rating}}</td>
                    <td>{{$specificLeague->fromdate}} to {{$specificLeague->todate}}</td>
                    <td>{{$specificLeague->max_team}}</td>
                    <td>{{$specificLeague->status}}</td>

            </tr>

            </tbody>
        </table>
        <table class="table mt-5">
            <thead class="thead text-dark" style="background-color: #c8fe0a">
            <tr>
                <th>Team Name</th>
                <th>Player 1</th>
                <th>Player 2</th>
                <th>Home Courts</th>
                <th>Player Availability</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                <td>{{$specificLeague->league_name}}</td>
                <td>{{$specificLeague->city}}</td>
                <td>{{$specificLeague->play_type}}</td>
                <td>{{$specificLeague->gender}}</td>
                <td>{{$specificLeague->rating}}</td>


            </tr>

            </tbody>
        </table>
        <div class="h4 text-primary py-auto my-auto">
            <u class="mt-3"><a href="javascript:void(0);" id="register-for-league"  data-bs-toggle="modal"
                               data-bs-target="#leagueSignupModal"> <i class="fa fa-solid fa-plus p-2 pr-3 rounded-circle text-white" style="background-color: #c8fe0a"></i> Register for this League Now</a></u>
             <p style="margin-left: 5%">Registration closes at mm/dd</p>
        </div>
        <div class="h4 mt-0 text-dark" style="margin-left: 3%">
            <div class="ml-5 pl-5"><u><b>Player who need a partner <i class="fa fa-solid fa-question"></i></b></u></div>
        </div>
        <!-- League Signup modal start -->
        <div class="modal fade leagueSignupModal" id="leagueSignupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">League Sign Up</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="loginForm">
                                <form id="checkout-form">
                                    <input type="hidden" name="token" />
                                    <div class="group">
                                        <label>
                                            <span>Card</span>
                                            <div id="card-element" class="field"></div>
                                        </label>
                                    </div>

                                    <div class="group">
                                        <label class="text-left">
                                            <span>Team</span>
                                            <input id="team_name" name="team_name" class="field">
                                        </label>

                                        <label>
                                            <span>Player 1 name</span>
                                            <input id="player_1_name" name="player_1_name" class="field" />
                                        </label>
                                        <label>
                                            <span>Player 2 name</span>
                                            <input id="player_2_name" name="player_2_name" class="field" />
                                        </label>
                                        <label>
                                            <span>Player 2 email</span>
                                            <input id="player_2_email" name="player_2_email" class="field" />
                                        </label>
                                    </div>

                                    <button type="submit">Register</button>
                                    <div class="outcome">
                                        <div class="error"></div>
                                        <div class="success">
                                            Success! Your Stripe token is <span class="token"></span>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        <div class="modal fade leagueSignupModal" id="leagueSignupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">--}}
{{--            <div class="modal-dialog modal-dialog-centered">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title" id="exampleModalLabel">League Sign Up</h5>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class="loginForm">--}}
{{--                            <form name="leagueSignupForm">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-12 form-group">--}}
{{--                                        <div class="holder-inner">--}}
{{--                                            <label class="placeholder-label-popup">Team Name<span class="text-red">*</span></label>--}}
{{--                                            <input type="text" id="team_name" name="team_name" class="form-control">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-6 form-group">--}}
{{--                                        <div class="holder-inner">--}}
{{--                                            <label class="placeholder-label-popup">Player 1 Name<span class="text-red">*</span></label>--}}

{{--                                            <input type="text" class="form-control" id="player_1_name" name="player_1_name">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-6 form-group">--}}
{{--                                        <div class="holder-inner">--}}
{{--                                            <label class="placeholder-label-popup">Player 2 Name<span class="text-red">*</span></label>--}}
{{--                                            <input type="text" class="form-control" id="player_2_name" name="player_2_name">--}}

{{--                                        </div>--}}
{{--                                        <div class="holder-inner">--}}
{{--                                            <label class="placeholder-label-popup">Player 2 Email<span class="text-red">*</span></label>--}}

{{--                                            <input type="email" class="email" name="player_2_email" id="player_2_email">--}}
{{--                                        </div>--}}
{{--                                        <label class="league-signup-message">Don't have a partner?<br />--}}
{{--                                            <a href="javascript: void(0);" id="need-partner"><u>Click here to add yourself to the players who need a partner list</u></a>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-12">--}}
{{--                                        <input type="hidden" name="token" />--}}
{{--                                        <div class="group">--}}
{{--                                            <label>--}}
{{--                                                <span>Card</span>--}}
{{--                                                <div id="card-element" class="field"></div>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-12 form-group">--}}
{{--                                        <div class="form-check" id="leagueSignupAgree">--}}
{{--                                            <input class="form-check-input popup-accept" type="checkbox" value="1" id="signup-agree" name="signup-agree">--}}
{{--                                            <label class="form-check-label" for="signup-agree">Accept <a href="{{ route('site.terms-of-use') }}" target="_blank"><u>Terms of Use</u></a><span class="text-red">*</span></label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-12 form-group">&nbsp;</div>--}}
{{--                                </div>--}}

{{--                                <button type="submit" id="register" name="register">Register</button>--}}


{{--                                <div class="required-fields-position">--}}
{{--                                    <span class="text-red">*</span> {{config('global.REQUIRED_FIELD')}}--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- League Signup modal end -->

    </div>

    @include('site.includes.footer')

@endsection

