<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Jobs\SendPlayerOneNotification;
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
        if ($id!=null && $leagueid==null){
            $leagueid=TeamsModel::where('id',$id)->value('leagueid');
            $leagueDetails=NewLeague::where('leagueid',$leagueid)->first();
            $data=TeamPlayers::where('team_id',$id)->get();
            $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line', 'facebook_link', 'instagram_link']);
            dispatch(new SendToBothPlayers($data, $leagueDetails, $siteSettings));
        }
        else{
            $player2email = User::where('id', $id)->value('email');
            $leagueDetails = NewLeague::where('leagueid', $leagueid)->first();
            $teamid = DB::table('teams')
                ->join('team_players', 'team_players.team_id', '=', 'teams.id')
                ->where('team_players.player2_email', $player2email)->where('teams.leagueid', $leagueid)->value('teams.id');
            $playersTableId=TeamPlayers::where('team_id',$teamid)->value('id');
//        update player2 status of payment in table
            $toSave = TeamPlayers::find($playersTableId);

            $toSave->pending_status = 1;

//        player 2 id is passed to the function

            if ($toSave->save()) {

                $data = DB::table('teams')
                    ->join('team_players', 'team_players.team_id', '=', 'teams.id')
                    ->where('team_players.player2_email', $player2email)->get();

                $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line', 'facebook_link', 'instagram_link']);
                dispatch(new SendPlayerOneNotification($data, $leagueDetails, $siteSettings));
                return view('emails.site.teams_player.both-player-success')->with('playertwo',$data[0]->player2_name);
            }

        }
    }

    public function afterPlayeroneCheckout($teamid){
        $playerTableId=TeamPlayers::where('team_id',$teamid)->value('id');
        $playerOne=TeamPlayers::where('team_id',$teamid)->value('player1_name');
        $toSave=TeamPlayers::find($playerTableId);
        $toSave->player1_payment_status=1;
        $toSave->player2_payment_status=1;
        $toSave->save();
        $data = DB::table('teams')
            ->join('team_players', 'team_players.team_id', '=', 'teams.id')
            ->where('team_players.id', $playerTableId)->get();

        $leagueDetails = NewLeague::where('leagueid', $data[0]->leagueid)->first();

        $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line', 'facebook_link', 'instagram_link']);
        dispatch(new SendToBothPlayers($data, $leagueDetails, $siteSettings));
        return view('emails.site.teams_player.player_1_checkout_page')->with('playerOne',$playerOne);

    }

}
