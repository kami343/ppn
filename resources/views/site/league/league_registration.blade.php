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
        <div class="h4 text-primary">
            <u class="mt-3"><a href="{{url('/users/league-sign-up/'.$specificLeague->leagueid)}}"> <i class="fa fa-solid fa-plus p-2 pr-3 rounded-circle text-white" style="background-color: #c8fe0a"></i> Register for this League Now</a></u>
        </div>
        <div class="h4 mt-3 text-dark">
            <div class="ml-5 pl-5"><u><b>Player who need a partner <i class="fa fa-solid fa-question"></i></b></u></div>
        </div>


    </div>

    @include('site.includes.footer')

@endsection

@push('scripts')

@endpush
