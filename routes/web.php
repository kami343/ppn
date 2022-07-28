<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

include('admin.php');

Route::group(['namespace' => 'site', 'as' => 'site.'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/what-is-ppn', 'HomeController@whatIsPpajax-login-submitn')->name('what-is-ppn');
    Route::get('/leagues', 'HomeController@leagues')->name('leagues');
    Route::get('/partner-program', 'HomeController@partnerProgram')->name('partner-program');
    Route::get('/read-complete-rules', 'HomeController@readCompleteRules')->name('read-complete-rules');
    Route::get('/faqs', 'HomeController@faqs')->name('faqs');
    Route::get('/contact-us', 'HomeController@contactUs')->name('contact-us');
    Route::any('/ajax-contact-submit', 'HomeController@ajaxContactSubmit')->name('ajax-contact-submit');
    Route::get('/privacy-policy', 'HomeController@privacyPolicy')->name('privacy-policy');
    Route::get('/terms-of-use', 'HomeController@termsOfUse')->name('terms-of-use');
    Route::get('/copyright-policy', 'HomeController@copyrightPolicy')->name('copyright-policy');
    Route::get('/rate-your-game', 'HomeController@rateYourGame')->name('rate-your-game');
    Route::get('/local-court', 'HomeController@localCourt')->name('local-court');

    Route::POST('/checkout','UsersController@userCheckout')->name('user-checkout');
    Route::POST('/playerone-checkout','UsersController@userOneCheckout')->name('playerone-checkout');
    Route::get('/both-players-page/{id?}/{leagueid?}','DisplayPageController@playerTwoCheckout')->name('both-players-page');




    Route::get('/verify-email-new', 'UsersController@verifyEmailNew')->name('verify-email-new');
    Route::get('/checkpage', 'HomeController@checkPage')->name('checkpage');
    Route::get('/player-one-confirmation/{id}', 'HomeController@PlayerOnePage')->name('player-one-confirmation');
    Route::get('/getcourts', 'UsersController@getHomeCourts')->name('getcourts');
    Route::get('/check-user/{id}', 'UsersController@checkUserExistence')->name('check-user');

    Route::any('/request-from-user/{id?}', 'UsersController@verifyEmailRedirect')->name('request-from-user');
    Route::get('/resend-verify-email/{id}', 'UsersController@resendVerifyEmail')->name('resend-verify-email');

    Route::any('/ajax-check-email/{id}', 'UsersController@checkEmail')->name('ajax-check-email');
    Route::any('/login-new', 'UsersController@LoginNew')->name('login-new');
    Route::any('/verify-email-page', 'UsersController@VerifyEmailPage')->name('verify-email-page');
    Route::any('/registration', 'UsersController@registration')->name('registration');
    Route::post('/ajax-pickleball-court-submit', 'UsersController@ajaxPickleballCourtSubmit')->name('ajax-pickleball-court-submit');
    Route::any('/ajax-registration-submit', 'UsersController@ajaxRegistrationSubmit')->name('ajax-registration-submit');
    Route::any('/thank-you/{id}', 'UsersController@thankYou')->name('thank-you');

    Route::any('/login-to-join-a-league/{id}', 'UsersController@loginToJoinALeague')->name('login-to-join-a-league');
    Route::any('/login/{id}', 'UsersController@loginUsingId')->name('login');
    Route::any('/ajax-login-submit', 'UsersController@ajaxLoginSubmit')->name('ajax-login-submit');
    Route::any('/forcefully-develop-hidlog/{emailaddress}', 'UsersController@forcefullyDevelopHidLog')->name('forcefully-develop-hidlog');

    Route::any('/ajax-forgot-password-submit', 'UsersController@ajaxForgotPasswordSubmit')->name('ajax-forgot-password-submit');
    Route::any('/reset-password/{token}', 'UsersController@resetPassword')->name('reset-password');
    Route::any('/ajax-reset-password-submit', 'UsersController@ajaxResetPasswordSubmit')->name('ajax-reset-password-submit');

    Route::get('/find-a-league/{id?}', 'HomeController@findALeague')->name('find-a-league');
    Route::get('/league-registration/{id}/{userid?}', 'HomeController@leagueRegistration')->name('league-registration');
    Route::get('/check-player2/{id}/{playertwoid}', 'HomeController@checkPlayerTwo')->name('check-player2');
    Route::get('/check-partner/{id}', 'PlayersController@PlayerOnePartnerCheck')->name('check-partner');
    Route::get('/add_selected_player/{id}/{leagueid}', 'PlayersController@PlayerTwoDetails')->name('add_selected_player');
    Route::post('/replace_player_two', 'PlayersController@ReplacePlayerTwo')->name('replace_player_two');
    Route::post('/add-teams', 'HomeController@addTeamsInLeague')->name('add-teams');

    Route::any('/player-profile/{id}', 'UsersController@playerProfile')->name('player-profile');

    /* User */
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        /* Authenticated sections */
        Route::group(['middleware' => 'guest:web'], function () {
            Route::any('/profile', 'UsersController@profile')->name('profile');
            Route::any('/league-sign-up/{id}', 'UsersController@leagueSignUp')->name('league-sign-up');
            Route::any('/register-in-league/{id}', 'UsersController@registerInLeague')->name('register-in-league');
            Route::any('/edit-profile', 'UsersController@editProfile')->name('edit-profile');
            Route::post('/ajax-delete-profile-image', 'UsersController@ajaxDeleteProfileImage')->name('ajax-delete-profile-image');
            Route::get('/change-password', 'UsersController@changePassword')->name('change-password');
            Route::post('/ajax-change-password-submit', 'UsersController@ajaxChangePasswordSubmit')->name('ajax-change-password-submit');
            // Route::any('/find-a-league', 'LeaguesController@findALeague')->name('find-a-league');
            Route::any('/join-a-league', 'UsersController@joinALeague')->name('join-a-league');
            Route::post('/ajax-city-region-wise-leagues', 'UsersController@ajaxCityRegionWiseLeague')->name('ajax-city-region-wise-leagues');
            Route::get('/thank-you', 'UsersController@thankYouLeagueRegistration')->name('thank-you');
            Route::any('/logout', 'UsersController@logout')->name('logout');
        });
    });

});
