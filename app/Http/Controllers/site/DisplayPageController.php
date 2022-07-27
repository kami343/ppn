<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Jobs\SendToBothPlayers;
use App\Models\NewLeague;
use App\Models\TeamPlayers;
use App\Models\TeamsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth;
use App\Traits\GeneralMethods;

class DisplayPageController extends Controller
{
    use GeneralMethods;

    public function __construct($data = null)
    {
        parent::__construct();

        // Variables assign for view page
        $this->shareVariables();

        $this->userModel = new User();

    }

    public function playerTwoCheckout($id = null, $leagueid = null)
    {
        $player2email = User::where('id', $id)->value('email');
        $leagueDetails = NewLeague::where('leagueid', $leagueid)->first();
        $teamid = TeamsModel::where('leagueid', $leagueid)->value('id');
//        update player2 status of payment in table
        $toSave = TeamPlayers::where('team_id', $teamid)->find();

        $toSave->player2_payment_status = 'some session id here';

//        player 2 id is passed to the function
        if ($toSave->save()) {
            $data = DB::table('teams')
                ->join('team_players', 'team_players.team_id', '=', 'teams.id')
                ->where('team_players.player2_email', $player2email)->get();
            $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line', 'facebook_link', 'instagram_link']);
            dispatch(new SendToBothPlayers($data, $leagueDetails, $siteSettings));
        }
        return view('emails.site.teams_player.both-player-success');
    }
}
