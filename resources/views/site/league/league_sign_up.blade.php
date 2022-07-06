@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')
    <div class="container">
        <div class="card text-center my-3">
            <div class="card-header h5" style="background-color: #c8fe0a">
                League Sign Up Form
            </div>
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group text-left">
                                <label for="team_name">
                                    <b><u>Team Name</u> <span class="text-danger">*</span></b>
                                </label>
                                <input type="text" id="team_name" name="team_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group text-left">
                                <label for="team_name">
                                    <b><u>Player 1 Name</u> <span class="text-danger">*</span></b>
                                </label>
                                <input type="text" id="player1" name="player1" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group text-left">
                                <label for="team_name">
                                    <b><u>Player 2 Name</u> <span class="text-danger">*</span></b>
                                </label>
                                <input type="text" id="player2" name="player2" class="form-control">
                            </div>
                            <div class="form-group text-left">
                                <label for="player_two_email">
                                    <b><u>Player 2 Email</u> <span class="text-danger">*</span></b>
                                </label>
                                <input type="text" id="player_two_email" name="player_two_email" class="form-control">
                            </div>
                            <div class="form-group text-left">
                                <span>Don't have a partner?</span>
                                <div class="pt-0"><a href="#">Click here to add yourself to the players who need a
                                        partner list</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="text-left">
                        <u class="h5">Payment Information</u>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="border border-3 border-dark p-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group text-left">
                                                <label for="team_name">
                                                    <b>Credit Card <span class="text-danger">*</span></b>
                                                </label>
                                                <input type="text" id="credit_card" name="credit_card"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group text-left">
                                                <label for="team_name">
                                                    <b>CSV <span class="text-danger">*</span></b>
                                                </label>
                                                <input type="text" id="csv" name="csv"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group text-left">
                                                <label for="zip">
                                                    <b>ZIP <span class="text-danger">*</span></b>
                                                </label>
                                                <input type="text" id="zip" name="zip"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group d-flex justify-content-end">
                                    <div class="p-2"><label for="promo_code">
                                            Promo Code
                                        </label></div>
                                    <div class="p-2"><input type="text" id="promo_code" name="promo_code"
                                                            class="form-control"></div>
                                    <div class="p-2">
                                        <button class="btn btn-sm text-dark" style="background-color: #bfc0c0">
                                            <b>Apply</b></button>
                                    </div>
                                </div>

                                <div class="form-group d-flex justify-content-start">
                                    <div class="p-2"><input type="checkbox" id="accept" name="accept"></div>
                                    <div class="p-2"><label for="accept">Accept <u class="text-info">Terms of
                                                use</u></label></div>
                                </div>
                                <div class="form-group d-flex justify-content-end">
                                    <button class="btn" style="background-color: #c8fe0a"><b>Register</b></button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer h5 text-muted">
                Footer Information
            </div>
        </div>


    </div>

    @include('site.includes.footer')

@endsection

@push('scripts')

@endpush
