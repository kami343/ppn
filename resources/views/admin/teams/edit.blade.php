@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                    <div class="container mt-4">

                        {{ Form::open([
                                    'method'=> 'POST',
                                    'class' => '',
                                    'route' => [$routePrefix.'.'.$updateUrl, $fetchedRow->id],
                                    'name'  => 'updateteamForm',
                                    'id'    => 'updateteamForm',
                                    'files' => true,
                                    'novalidate' => true ]) }}
                        <div class="form-body">
                            @csrf

                            @if (session('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{session('message')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="league_name">Team Name</label>
                                        <input type="hidden" class="form-control"
                                               value="@isset($fetchedRow->team_id){{$fetchedRow->team_id}}@endisset"
                                               id="team_id" name="team_id"
                                               >
                                        <input type="hidden" class="form-control"
                                               value="@isset($fetchedRow->leagueid){{$fetchedRow->leagueid}}@endisset"
                                               id="leagueid" name="leagueid"
                                               >
                                        <input type="hidden" class="form-control"
                                               value="@isset($fetchedRow->id){{$fetchedRow->id}}@endisset"
                                               id="team_playerid" name="team_playerid"
                                               >

                                        <input type="text" class="form-control"
                                               value="@isset($fetchedRow->title){{$fetchedRow->title}}@endisset"
                                               id="team_name" name="team_name"
                                               placeholder="League Name">
                                       
                                        <!-- <small id="league_name_help" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="league_name">Player 1</label>
                                        
                                        <select class="form-control" id="player1_name" name="player1_name">
 >
                                               @php

                        $id=request()->route('id');
                         $teams=DB::table('users')->where('role_id',null)->get();

                         foreach ($teams as $i =>$value) {

                            if( $value->email == $fetchedRow->player1_email){
                                 echo '<option selected>'.$value->full_name." (".$value->email. ')</option>';
                            }elseif( $value->email == $fetchedRow->player2_email){
                                
                            }else{
                                 echo '<option>'.$value->full_name." (".$value->email.')</option>';
                            }
                       

                         }
                    @endphp
                                </select>

                                        <!-- <small id="league_name_help" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="league_name">Player 2</label>
                                         <select class="form-control" id="player2_name" name="player2_name">
 >
                                               @php

                        $id=request()->route('id');
                         $teams=DB::table('users')->where('role_id',null)->get();

                         foreach ($teams as $i =>$value) {

                            if( $value->email == $fetchedRow->player2_email){
                                 echo '<option selected>'.$value->full_name." (".$value->email. ')</option>';
                            }elseif( $value->email == $fetchedRow->player1_email){
                                
                            }else{
                                 echo '<option>'.$value->full_name." (".$value->email.')</option>';
                            }
                       

                         }
                    @endphp
                                </select>
                                        <!-- <small id="league_name_help" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                </div>
                             
                            </div>
                           
                         

                            <div class="form-actions mt-4">
                                <div class="float-left">
                                    <a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3"
                                       href="{{ route($routePrefix.'.'.$listUrl) }}">
                                        <i class="far fa-arrow-alt-circle-left"></i> @lang('custom_admin.btn_cancel')
                                    </a>
                                </div>
                                <div class="float-right">
                                    <button type="submit" id="btn-processing"
                                            class="btn btn-primary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3">
                                        <i class="far fa-save" aria-hidden="true"></i> @lang('custom_admin.btn_update')
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{ Form::close() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

{{--@push('scripts')--}}
{{--        @include($routePrefix.'.'.$pageRoute.'.scripts')--}}
{{--@endpush--}}
