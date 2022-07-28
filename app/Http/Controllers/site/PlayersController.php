<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Jobs\SendConfirmationToPlayerTwo;
use App\Models\Cms;
use App\Models\NewLeague;
use App\Models\TeamPlayers;
use App\Models\TeamsModel;
use App\Models\User;
use App\Traits\GeneralMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlayersController extends Controller
{
    use GeneralMethods;

    /*
        * Function Name : __construct
        * Purpose       : It sets some public variables for being accessed throughout this
        *                   controller and its related view pages
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Void
        * Return Value  : Mixed
    */
    public function __construct($data = null) {
        parent::__construct();

        // Variables assign for view page
        $this->shareVariables();

    }
    public function PlayerOnePartnerCheck($id){
        $email=Auth::user()->email;

        $playertwoExistence=DB::table('teams')
            ->join('team_players', 'team_players.team_id', '=', 'teams.id')
            ->where('teams.leagueid',$id)->where('team_players.pending_status',0)->where('team_players.player1_email',$email)->exists();

        return $playertwoExistence;
    }

    public function PlayerTwoDetails($id,$leagueid){
        $email1=Auth::user()->email;
        $email2=User::where('id',$id)->value('email');
        $selfExistence=TeamPlayers::where('player1_email',$email1)->exists();

        $playertwoLeague=DB::table('teams')
            ->join('team_players', 'team_players.team_id', '=', 'teams.id')
            ->where('team_players.pending_status',0)->where('teams.leagueid',$leagueid)->where('team_players.player1_email',$email2)->get();
        return $playertwoLeague;
    }
    public function ReplacePlayerTwo(Request $request){
        $email=Auth::user()->email;
        $id=Auth::user()->id;
        $selfExistence=DB::table('teams')
            ->join('team_players', 'team_players.team_id', '=', 'teams.id')
            ->where('teams.leagueid',$request['leagueid'])->where('team_players.pending_status',0)->where('team_players.player1_email',$email)->exists();
        if (!empty($selfExistence)){
            $record_to_edit=DB::table('teams')
                ->join('team_players', 'team_players.team_id', '=', 'teams.id')
                ->where('teams.leagueid',$request['leagueid'])->where('team_players.pending_status',0)->where('team_players.player1_email',$email)->get();


            $teamaffectedRow = TeamsModel::where("id", $record_to_edit[0]->team_id)->update(["title" => $request['team_name']]);
            $toSave=TeamPlayers::find($record_to_edit[0]->id);
            $toSave->player2_name=$request['player_2_name'];
            $toSave->player2_email=$request['player_2_email'];
            if ($toSave->save()){
                $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line', 'facebook_link', 'instagram_link']);
                $leagueDetails=NewLeague::where('leagueid',$request['leagueid'])->first();
                dispatch(new SendConfirmationToPlayerTwo($request->all(),$leagueDetails, $siteSettings));
                return response()->json(['success'=>true]);
            }
            else{
                return response()->json(['failed'=>true]);
            }

        }
        else{

            TeamsModel::create([
                'leagueid' => $request['leagueid'],
                'title' => $request['team_name'],
            ]);
            $team_id=TeamsModel::where('title',$request['team_name'])->where('leagueid', $request['leagueid'])->value('id');
            TeamPlayers::create([
               'team_id'=>$team_id,
               'player1_id'=>Auth::user()->id,
               'player1_name'=>$request['player_1_name'],
               'player2_name'=>$request['player_2_name'],
               'player2_email'=>$request['player_2_email'],
               'player1_payment_status'=>'pending',
               'player2_payment_status'=>'pending',
               'pending_status'=>0,
            ]);
            $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line', 'facebook_link', 'instagram_link']);
            $leagueDetails=NewLeague::where('leagueid',$request['leagueid'])->first();
            dispatch(new SendConfirmationToPlayerTwo($request->all(),$leagueDetails, $siteSettings));
            return response()->json(['success'=>true]);
        }


    }
}
