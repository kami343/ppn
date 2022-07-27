@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')

    <div class="innerContentArea pt-5">
        <div class="container">
            <div class="sec-title text-center">
                <h2 class="text-uppercase" style="font-family: Poppins">Find A PickleBall League</h2>
            </div>
            <div class="mainContent">
                <div class="leaguesearchcontent">
                    <div class="totalleguarea">
                        <div class="leagueleft">
                            <div class="league-togglebutton"><span>Filter</span> <i class="fa fa-caret-right"
                                                                                    aria-hidden="true"></i></div>
                            <div class="leage-leftsec">
                                <h3>LOCATION</h3>
                                <div class="locationarea">
                                    <div class="locationtop">
                                        <div class="lft">
                                            <label class="cont">
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="rgt">
                                            <input type="text" name="" placeholder="Zip Code">
                                        </div>
                                    </div>
                                    <div class="locationbottom">
                                        <div class="lft">
                                            within
                                        </div>
                                        <div class="rgt">
                                            <select>
                                                <option value="10 mile">10 mile</option>
                                                <option value="20 miles">20 miles</option>
                                                <option value="40 miles">40 miles</option>
                                                <option value="50 miles">50 miles</option>
                                                <option value="100 miles">100 miles</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="left-side-bx">
                                    <h3>PLAY TYPE</h3>
                                    <div class="excls">
                                        <label class="cont">Doubles
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">Singles
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="left-side-bx">
                                    <h3>GENDER</h3>
                                    <div class="excls">
                                        <label class="cont">Male
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">Female
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">Mixed
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="left-side-bx">
                                    <h3>AGE</h3>
                                    <div class="excls">
                                        <label class="cont">18 +
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">50 +
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="left-side-bx">
                                    <h3>RATING</h3>
                                    <div class="excls">
                                        <label class="cont">2.0 – 3.0
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">3.0 – 4.0
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">4.0 – 5.0
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">5.0 +
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="left-side-bx">
                                    <h3>STATUS</h3>
                                    <div class="excls">
                                        <label class="cont">Open for registration
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">In – Progress
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">Complete
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="league-right">
                            <div class="rightleague">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th class="sticky-top" scope="col">League Name</th>
                                            <th class="sticky-top" scope="col">Location</th>
                                            <th class="sticky-top" scope="col">Play Type</th>
                                            <th class="sticky-top" scope="col">Gender</th>
                                            <th class="sticky-top" scope="col">Ratings</th>
                                            <th class="sticky-top" scope="col">Dates</th>
                                            <th class="sticky-top" scope="col">Teams Registered</th>
                                            <th class="sticky-top" scope="col">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        @foreach($leaguelist as $leaguelist)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('site.league-registration', $leaguelist->leagueid) }}">{{$leaguelist->league_name}}</a>
                                                </td>
                                                <td>{{$leaguelist->city}}</td>
                                                <td>{{$leaguelist->play_type}} </td>
                                                <td>{{$leaguelist->gender}}</td>
                                                <td>{{$leaguelist->rating}}</td>
                                                <td>{{$leaguelist->fromdate}}-{{$leaguelist->todate}}</td>
                                                <td>{{$leaguelist->max_team}}</td>
                                                <td>{{$leaguelist->status}}</td>
{{--                                                @if($leaguelist->status==1)--}}
{{--                                                    <td>open for registration</td>--}}
{{--                                                @else--}}
{{--                                                    <td>in progress</td>--}}
{{--                                                @endif--}}
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('site.includes.footer')

@endsection

@push('scripts')

@endpush
