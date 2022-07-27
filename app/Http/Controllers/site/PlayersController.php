<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlayersController extends Controller
{
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
        $playertwoLeague=DB::table('teams')
            ->join('team_players', 'team_players.team_id', '=', 'teams.id')
            ->where('team_players.pending_status',0)->where('teams.leagueid',$leagueid)->where('team_players.player1_email',$email2)->get();
       return $playertwoLeague;
    }
}
