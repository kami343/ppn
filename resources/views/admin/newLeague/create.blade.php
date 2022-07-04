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
                                'route' => ['admin.newLeague.storedata'],
                                'name'  => 'createNewLeagueForm',
                                'id'    => 'createNewLeagueForm',
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="league_name">League Name</label>
                                        <input type="text" class="form-control" id="league_name" name="league_name"
                                               placeholder="League Name">
                                        <!-- <small id="league_name_help" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                </div>
                                <div class="col-6">

                                    <div class="form-group">
                                        <label for="zip_code">Zip Code</label>
                                        <input type="text" class="form-control" id="zip_code" name="zip_code"
                                               placeholder="Zip Code">
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city"
                                               placeholder="City Name">
                                        <!-- <small id="league_name_help" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" id="state" name="state"
                                               placeholder="State">
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select id="play_type" name="play_type" class="form-select form-control">
                                            <option value="" selected>Play Type</option>
                                            <option value="singles">Singles</option>
                                            <option value="doubles">Doubles</option>
                                        </select>
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <select id="gender" name="gender" class="form-select form-control">
                                            <option value="" selected>Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="mixed">Mixed</option>
                                        </select>
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->

                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="fromdate">From date</label>

                                        <input type="date" name="fromdate" class="form-control"
                                               value="<?= date('Y-m-d') ?>" id="fromdate">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="todate">To date</label>
                                        <input type="date" name="todate" class="form-control"
                                               value="<?= date('Y-m-d') ?>" id="todate">

                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->

                                    </div>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="max_team">Maximum Teams Can Register</label>
                                        <input type="text" class="form-control" id="max_team" name="max_team"
                                               placeholder="Register team">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select id="status" name="status" class="form-select form-control">
                                            <option value="Registration Open" selected>Registration Open</option>
                                            <option value="In-Progress">In-Progress</option>
                                            <option value="Playoffs">Playoffs</option>
                                            <option value="Complete">Complete</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" name="amount" id="amount"
                                               placeholder="Amount">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="age">Age</label>
                                    <select id="age" name="age" class="form-select form-control">
                                        <option value="18+" selected>18+</option>
                                        <option value="35+">35+</option>
                                        <option value="50+">50+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">

                                        <select id="rating" name="rating" class="form-select form-control">
                                            <option value="" selected>Rating</option>
                                            <option value="2">2.0</option>
                                            <option value="2.5">2.5</option>
                                            <option value="3">3.0</option>
                                            <option value="3.5">3.5</option>
                                            <option value="4">4.0</option>
                                            <option value="4.5">4.5</option>
                                            <option value="5">5.0</option>
                                            <option value="5.5+">5.5+</option>
                                        </select>
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->

                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit"
                                        class="btn btn-primary waves-effect waves-light btn-rounded shadow-md"><i
                                        class="far fa-save" aria-hidden="true"></i> @lang('custom_admin.btn_submit')
                                </button>
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
{{-- @include($routePrefix.'.'.$pageRoute.'.scripts')--}}
{{--@endpush--}}
