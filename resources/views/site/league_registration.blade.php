@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')

    <div class="innerContentArea registration">
        <div class="container-fluid">
            <div class="sec-title text-center" style="font-family: Poppins">
                @if($leagueRow)
                    <h2>{{$leagueRow->league_name}}</h2>
                @endif
            </div>

            <div>
                <div class="row">
                    <div class="col-3">
                        <label>
                            Location <span id="label_location"
                                           class="p-1 ms-2 border-2 borderClr rounded-1">{{$leagueRow->city}}</span>
                        </label>
                    </div>
                    <div class="col-3">
                        <label>
                            Gender <span id="label_gender"
                                         class="p-1 ms-2 border-2 borderClr rounded-1">{{$leagueRow->gender}}</span>
                        </label>
                    </div>
                    <div class="col-3">
                        <label>
                            Rating <span id="label_rating"
                                         class="p-1 ms-2 border-2 borderClr rounded-1">{{$leagueRow->rating}}</span>
                        </label>
                    </div>
                    <div class="col-3">
                        <label>
                            Status <span class="p-1 ms-2 border-2 borderClr rounded-1">{{$leagueRow->status}}</span>
                        </label>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-3">
                        <label>
                            Register Until <span
                                class="p-1 ms-2 border-2 borderClr rounded-1">{{date("m/d/y",strtotime($leagueRow->todate))}}</span>
                        </label>
                    </div>
                    <div class="col-6">
                        <label>
                            League Dates <span
                                class="p-1 ms-2 border-2 borderClr rounded-1">{{  date("m/d/y",strtotime($leagueRow->fromdate)) }} to {{ date("m/d/y",strtotime($leagueRow->todate))}}</span>
                        </label>
                    </div>
                    <div class="col-3">
                        <label>
                            Cost <span
                                class="p-1 ms-2 border-2 borderClr rounded-1">${{$leagueRow->amount}} per player</span>
                        </label>
                        <label class="d-none">age <span id="label_age">{{$leagueRow->age}}</span></label>
                        <label class="d-none">league <span id="league_id">{{$leagueRow->leagueid}}</span></label>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Team Name</th>
                        <th scope="col">Player 1</th>
                        <th scope="col">Player 2</th>
                        <th scope="col">Home Courts</th>
                        <th scope="col">Availability <span
                                title="WE=Weekends,WM=Weekend Mornings,WF=Weekend afternoon,WEV=Weekend Evening"
                                data-toggle="tooltip" data-placement="bottom"
                            ><i
                                    class="fa-solid pl-5 fa-circle-question"></i></span></th>
                    </tr>
                    </thead>

                    <tbody>

                    @php

                        $id=request()->route('id');
                         $teams=DB::table('teams')
             ->join('team_players', 'team_players.team_id', '=', 'teams.id')
             ->where('teams.leagueid',$id)->where('team_players.pending_status',1)->get();

                         foreach ($teams as $i =>$value) {

                                   $p1Availability=DB::table('users')
            ->join('user_availabilities', 'user_availabilities.user_id', '=', 'users.id')
            ->join('availabilities','availabilities.id','=','user_availabilities.availability_id')
            ->where('users.email',$value->player1_email)->value('availabilities.short_code');
                                   $p2Availability=DB::table('users')
            ->join('user_availabilities', 'user_availabilities.user_id', '=', 'users.id')
            ->join('availabilities','availabilities.id','=','user_availabilities.availability_id')
            ->where('users.email',$value->player2_email)->value('availabilities.short_code');

                                   $p1homeCourt=DB::table('users')
            ->join('user_details', 'user_details.user_id', '=', 'users.id')
            ->join('pickleball_courts','pickleball_courts.id','=','user_details.home_court')
            ->where('users.email',$value->player1_email)->value('pickleball_courts.title');
                                   $p2homeCourt=DB::table('users')
            ->join('user_details', 'user_details.user_id', '=', 'users.id')
            ->join('pickleball_courts','pickleball_courts.id','=','user_details.home_court')
            ->where('users.email',$value->player2_email)->value('pickleball_courts.title');

                        echo '<tr><td>'.++$i.'</td><td>'.$value->title.'</td><td>'.$value->player1_name.'</td><td>'.$value->player2_name.'</td><td>'.$p1homeCourt.'/'.$p2homeCourt.'</td><td>'.$p1Availability.','.$p2Availability.'</td></tr>';

                         }
                    @endphp
                    </tbody>
                </table>
            </div>
            <div class="registerfor">
                <div class="plusign"><a href="javascript:void(0);" class=""><i class="fa fa-plus-circle"
                                                                               aria-hidden="true"></i></a></div>
                <div class="registersec">
                    <a href="javascript:void(0);" id="register-for-league"
                    >Register for this League Now</a>
                    <h6>Registration Closes {{ date("m/d/y",strtotime($leagueRow->todate))}}</h6>
                </div>
            </div>
            <div class="partnerarea">
                <h3><span>Players who need a partner</span> <a href="javascript:void(0);" data-toggle="tooltip"
                                                               title="These are players who do not have a partner but are interested in playing in this league.  You must partner up and pay for the league prior to officially being considered registered"><i
                            class="fa fa-question-circle" aria-hidden="true"></i></a></h3>
                <input type="hidden" id="user-login-check" value="{{Auth::check() }}" class="d-none">
                <input type="hidden" id="selected-player-flag" value="" class="d-none">
                <ul>
                    @if(!empty($loggedInPlayer[0]))
                        <li>
                            <span class="name">{{$loggedInPlayer[0]->full_name}}</span>
                            <span class="minus" id="player-one-red-minus"><a href="javscript:void(0);"><i
                                        class="fa fa-minus-circle"
                                        aria-hidden="true"></i></a></span>
                            <span class="user"><a href="/player-profile/{{$loggedInPlayer[0]->player_id}}"><i
                                        class="fa fa-user"
                                        aria-hidden="true"></i></a></span>
                            <span class="mail"><a href="mailto:{{$loggedInPlayer[0]->email}}"><i
                                        class="fa fa-envelope-open"
                                        aria-hidden="true"
                                        data-toggle="tooltip"
                                        title="{{$loggedInPlayer[0]->email}}"></i></a></span>
                        </li>
                    @endif

                    @foreach($teamsPending as $key=>$teamsPending)

                        @if($teamsPending->player_id!=auth()->user()->id)

                            <li>

                                <span class="name">{{$teamsPending->full_name}}</span>
                                <span class="plus" data-id="playertwo_{{$key}}" value="{{$teamsPending->player_id}}"
                                      onclick="checkUserAuth(this)"><a><i class="fa fa-plus-circle"
                                                                          aria-hidden="true"></i></a></span>
                                <span class="user" onclick="checkUserAuth()"><a
                                        href="/player-profile/{{$teamsPending->player_id}}"><i class="fa fa-user"
                                                                                               aria-hidden="true"></i></a></span>
                                <span class="mail" onclick="checkUserAuth()"><a
                                        href="mailto:{{$teamsPending->email}}"><i class="fa fa-envelope-open"
                                                                                  aria-hidden="true"
                                                                                  data-toggle="tooltip"
                                                                                  title="{{$teamsPending->email}}"></i></a></span>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <!-- League Signup modal start -->
            <div class="modal fade" id="leagueSignupModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true"
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
                            <form class="frmgen mt-0" id="leagueSignupForm" name="leagueSignupForm">
                                <div class="row d-none">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>League id <span style="color: red;">*</span></label>
                                            <input type="text" id="leagueid" name="leagueid"
                                                   class="form-control" value="{{$leagueRow->leagueid}}"
                                                   placeholder="League id hiden">
                                        </div>
                                        <div class="form-group">
                                            <label>player 2 id passed from request-from-user/23<span
                                                    style="color: red;">*</span></label>
                                            <input type="text" id="player2id" name="player2id"
                                                   class="form-control" value="{{$playertwo_id}}"
                                                   placeholder="player2 hidden">
                                        </div>
                                    </div>
                                </div>
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
                                            <input type="text" id="player_1_name"
                                                   value="{{empty(auth()->user()->full_name)?"":auth()->user()->full_name}}"
                                                   name="player_1_name"
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

                                        <div class="d-block" id="need-partner-hide">
                                            <label class="league-signup-message">Don't have a partner?<br/>
                                                <a href="javascript: void(0);" id="need-partner"><u>Click here to add
                                                        yourself to
                                                        the players who need a partner list</u></a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{--                                <div class="row mt-2">--}}
                                {{--                                    <div class="col-lg-12">--}}
                                {{--                                        <input type="text" id="promo_code" name="promo_code"--}}
                                {{--                                               class="form-control" placeholder="Enter Promo Code">--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="d-flex justify-content-between">--}}

                                {{--                                        <div class="col-lg-3 col-4 form-group">--}}
                                {{--                                            <button type="button" class="apply-promo-code">Apply</button>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="col-lg-2 form-group">--}}
                                {{--                                            <span class="text-red registration-amount"><strong>$39.99</strong></span>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-check-input popup-accept" type="checkbox" value="1"
                                                   id="signup_agree" name="signup_agree">
                                            <label class="form-check-label" for="signup-agree">Accept <a
                                                    href="{{ route('site.terms-of-use') }}" target="_blank"><u>Terms of
                                                        Use</u></a><span
                                                    class="text-red">*</span></label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-Close" data-bs-dismiss="modal">Close
                                            </button>
                                            <button type="submit" id="regBtn" class="btn btn-signacc">Register</button>
                                            <button id="checkoutBtn" class="btn btn-signacc">Checkout</button>

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
            <div class="modal fade needPartnerModal" id="needPartnerModal" tabindex="-1"
                 aria-labelledby="exampleModalLabel"
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
                                <p>You have been added to the <strong>Players who need a partner</strong> list for the
                                    <strong>League
                                        Name</strong>.</p>
                                <p>Other solo players interested in this league will be able to reach out to you via
                                    email to
                                    see if you are a good partner match.</p>
                                <p>Good Luck!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Need partner modal end -->

        </div>
    </div>

    @include('site.includes.footer')

@endsection

{{--@push('scripts')--}}

{{--@endpush--}}
