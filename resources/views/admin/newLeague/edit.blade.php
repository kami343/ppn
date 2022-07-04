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
                                    'route' => [$routePrefix.'.'.$updateUrl, $fetchedRow->leagueid],
                                    'name'  => 'updateLeagueForm',
                                    'id'    => 'updateLeagueForm',
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
                                        <input type="text" class="form-control"
                                               value="@isset($fetchedRow->league_name){{$fetchedRow->league_name}}@endisset"
                                               id="league_name" name="league_name"
                                               placeholder="League Name">
                                        <!-- <small id="league_name_help" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                </div>
                                <div class="col-6">

                                    <div class="form-group">
                                        <label for="zip_code">Zip Code</label>
                                        <input type="text" class="form-control"
                                               value="@isset($fetchedRow->zip_code){{$fetchedRow->zip_code}}@endisset"
                                               id="zip_code" name="zip_code"
                                               placeholder="Zip Code">
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control"
                                               value="@isset($fetchedRow->city){{$fetchedRow->city}}@endisset" id="city"
                                               name="city"
                                               placeholder="City Name">
                                        <!-- <small id="league_name_help" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control"
                                               value="@isset($fetchedRow->state){{$fetchedRow->state}}@endisset"
                                               id="state" name="state"
                                               placeholder="State">
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select id="play_type" name="play_type" class="form-select form-control">
                                            @if($fetchedRow->play_type==='')
                                                <option value="">Play Type</option>
                                            @elseif($fetchedRow->play_type==='singles')
                                                <option value="singles" selected>Singles</option>
                                            @else
                                                <option value="doubles" selected>Doubles</option>
                                            @endif
                                        </select>
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <select id="gender" name="gender" class="form-select form-control">
                                            @if($fetchedRow->gender==='')
                                                <option value="" selected>Gender</option>
                                            @elseif($fetchedRow->gender==='male')
                                                <option value="male" selected>Male</option>
                                                <option value="female">Female</option>
                                                <option value="mixed">Mixed</option>
                                            @elseif($fetchedRow->gender==='female')
                                                <option value="female" selected>Female</option>
                                                <option value="male">Male</option>
                                                <option value="mixed">Mixed</option>
                                            @else
                                                <option value="mixed" selected>Mixed</option>
                                                <option value="female">Female</option>
                                                <option value="male">Male</option>
                                            @endif
                                        </select>
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->

                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">

                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="fromdate" name="fromdate"
                                               value="@isset($fetchedRow->fromdate){{$fetchedRow->fromdate}}@endisset"
                                               class="form-control" value="<?= date('Y-m-d') ?>"
                                               id="fromdate">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="todate" name="todate"
                                               value="@isset($fetchedRow->todate){{$fetchedRow->todate}}@endisset"
                                               class="form-control" value="<?= date('Y-m-d') ?>"
                                               id="todate">
                                    </div>
                                </div>


                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="max_team">Maximum team can register</label>
                                        <input type="text" class="form-control"
                                               value="@isset($fetchedRow->max_team){{$fetchedRow->max_team}}@endisset"
                                               id="max_team" name="max_team"
                                               placeholder="Register team">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">status</label>
                                        <select id="status" name="status" class="form-select form-control">
                                            @if($fetchedRow->status==='')
                                                <option value="Registration Open" selected>Registration Open</option>
                                            @elseif($fetchedRow->status==='In-Progress')

                                                <option value="In-Progress" selected>In-Progress</option>
                                                <option value="Playoffs">Playoffs</option>

                                                <option value="Complete">Complete</option>

                                            @elseif($fetchedRow->status==='Playoffs')

                                                <option value="Playoffs" selected>Playoffs</option>
                                                <option value="In-Progress">In-Progress</option>
                                                <option value="Complete">Complete</option>
                                            @else
                                                <option value="Playoffs">Playoffs</option>
                                                <option value="In-Progress">In-Progress</option>
                                                <option value="Complete" selected>Complete</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control"
                                               value="@isset($fetchedRow->amount){{$fetchedRow->amount}}@endisset"
                                               name="amount" id="amount"
                                               placeholder="Amount">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <select id="age" name="age" class="form-select form-control">
                                            @if($fetchedRow->age==='18+')
                                                <option value="18+" selected>18+</option>
                                                <option value="35+">35+</option>
                                                <option value="50+">50+</option>
                                            @elseif(($fetchedRow->age==='35+'))
                                                <option value="18+" selected>18+</option>
                                                <option value="35+">35+</option>
                                                <option value="50+">50+</option>
                                            @elseif(($fetchedRow->age==='50+'))
                                                <option value="18+" selected>18+</option>
                                                <option value="35+">35+</option>
                                                <option value="50+">50+</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select id="rating" name="rating" class="form-select form-control">
                                            @if($fetchedRow->rating==='')
                                                <option value="" selected>Rating</option>
                                            @elseif($fetchedRow->rating==='2')
                                                <option value="2" selected>2.0</option>
                                            @elseif($fetchedRow->rating==='2')

                                                <option value="2.5" selected>2.5</option>
                                            @elseif($fetchedRow->rating==='2.5')

                                                <option value="3" selected>3.0</option>
                                            @elseif($fetchedRow->rating==='3')

                                                <option value="3.5" selected>3.5</option>
                                            @elseif($fetchedRow->rating==='3.5')

                                                <option value="4" selected>4.0</option>
                                            @elseif($fetchedRow->rating==='4')

                                                <option value="4.5" selected>4.5</option>
                                            @elseif($fetchedRow->rating==='4.5')

                                                <option value="5" selected>5.0</option>
                                            @else
                                                <option value="5.5+" selected>5.5+</option>
                                            @endif

                                        </select>
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->

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
