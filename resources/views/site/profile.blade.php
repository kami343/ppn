@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')

    @php
    $profileImage = asset('images/site/'.config('global.PROFILE_NO_IMAGE'));
    if ($details->profile_pic != null) {
        if (file_exists(public_path('/images/uploads/account/'.$details->profile_pic))) {
            $profileImage = asset('/images/uploads/account/'.$details->profile_pic);
        }
    }
    @endphp

    <div class="innerContentArea">
        <div class="container">
           
            <div class="sec-title">
                <h2>{!! $details->full_name !!}'s profile </h2>            
            </div>
            <div class="pageContentArea">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profilePic">
                            <img src="{!! $profileImage !!}" alt="{!! $details->full_name !!}">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="profileTop">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="prifileTable responsiveProfileTable">
                                        <div class="table-responsive">
                                            <table class="profTable">
                                                <tr>
                                                    <td>Name:</td>
                                                    <td>{!! $details->full_name !!}</td>
                                                </tr>
                                               
                                               
                                                <tr>
                                                    <td>Gender:</td>
                                                    <td>@if ($details->gender == 'M')Male @elseif ($details->gender == 'F')Female @endif</td>
                                                </tr> 
                                             
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="prifileTable responsiveProfileTable">
                                        <div class="table-responsive">
                                            <table class="profTable">
                                                <tr>
                                                    <td>Player Rating:</td>
                                                    <td>{!! formatToTwoDecimalPlaces($details->player_rating) !!} @if ($details->player_rating == 5.50)+ @endif</td>
                                                </tr>
                                              
                                                <tr>
                                                    <td>Member Since:</td>
                                                    <td>{!! memberSince($details->created_at, 'F Y') !!}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profileBottom">
                            <div class="row">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h4 class="text-uppercase">My Leagues</h4>
                    <span>No records found.</span>
                    <ul class="league-profile-content">
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
    
    @include('site.includes.footer')
    
@endsection

@push('scripts')
   
@endpush