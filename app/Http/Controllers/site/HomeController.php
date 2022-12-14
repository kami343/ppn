<?php
/*
    * Class name    : HomeController
    * Purpose       : Home page of the website
    * Author        :
    * Created Date  :
    * Modified date :
*/
namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Jobs\SendConfirmationToPlayerTwo;
use App\Jobs\SendRegistrationToUser;
use App\Models\NewLeague;
use App\Models\TeamPlayers;
use App\Models\TeamsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth;
use App\Traits\GeneralMethods;
use App\Models\Cms;
use App\Models\Banner;
use App\Models\Video;
use App\Models\PickleballCourt;
use App\Models\Contact;
use App\Jobs\SendContactUs;

class HomeController extends Controller
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

        $this->cmsModel = new Cms();
    }

    /*
        * Function name : index
        * Purpose       : Home page of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data for the home page
    */
    public function index(Request $request) {
        $getMetaDetails = getMetaDetails('cms', 1);
        $cmsPages       = $this->cmsModel->where('id', 1)->first();
        $banners        = Banner::where(['status' => '1'])->orderBy('sort', 'ASC')->get();
        $leaguePage     = $this->cmsModel->where('id', 6)->first();
        $partnerPage    = $this->cmsModel->where('id', 7)->first();
        $siteSettings   = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line']);

        return view('site.home', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsPages'          => $cmsPages,
            'banners'           => $banners,
            'leaguePage'        => $leaguePage,
            'partnerPage'       => $partnerPage,
            'siteSettings'      => $siteSettings
        ]);
    }

    /*
        * Function name : whatIsPpn
        * Purpose       : What is ppn page of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data
    */
    public function whatIsPpn(Request $request) {
        $getMetaDetails = getMetaDetails('cms', 21);
        $cmsPage        = $this->cmsModel->where('id', 21)->first();

        return view('site.what_is_ppn', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
        ]);
    }

    /*
        * Function name : leagues
        * Purpose       : Leagues page of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data for the leagues
    */
    public function leagues(Request $request) {
        $getMetaDetails = getMetaDetails('cms', 6);
        $cmsPage        = $this->cmsModel->where('id', 6)->first();
        $video          = Video::where(['cms_id' => 6, 'status' => '1'])->first();

        return view('site.leagues', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
            'video'             => $video
        ]);
    }

    /*
        * Function name : readCompleteRules
        * Purpose       : Read complete rules page of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data
    */
    public function readCompleteRules(Request $request) {
        $getMetaDetails = getMetaDetails('cms', 12);
        $cmsPage        = $this->cmsModel->where('id', 12)->first();

        return view('site.read_complete_rules', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
        ]);
    }

    /*
        * Function name : partnerProgram
        * Purpose       : Partner program page of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data for the Partner program
    */
    public function partnerProgram(Request $request) {
        $getMetaDetails = getMetaDetails('cms', 7);
        $cmsPage        = $this->cmsModel->where('id', 7)->first();
        $video          = Video::where(['cms_id' => 7, 'status' => '1'])->first();

        return view('site.partner_program', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
            'video'             => $video
        ]);
    }

    /*
        * Function name : faqs
        * Purpose       : FAQs of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data for the Partner program
    */
    public function faqs(Request $request) {
        $getMetaDetails = getMetaDetails('cms', 22);
        $cmsPage        = $this->cmsModel->where('id', 22)->first();

        return view('site.faqs', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
        ]);
    }

    /*
        * Function name : contact us
        * Purpose       : contact us page of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data for the contact us
    */
    public function contactUs(Request $request) {
        $getMetaDetails = getMetaDetails('cms', 8);
        $cmsPage        = $this->cmsModel->where('id', 8)->first();

        return view('site.contact_us', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
        ]);
    }

    /*
        * Function name : ajaxContactSubmit
        * Purpose       : This function is submit contact form
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxContactSubmit(Request $request) {
        $title      = trans('custom.message_error');
        $message    = trans('custom.error_something_went_wrong');
        $type       = 'error';

        try {
            if ($request->ajax()) {
                if ($request->name != '' && $request->email != '' && $request->message != '') {
                    $newContact = new Contact;
                    $newContact->name       = trim($request->name, ' ');
                    $newContact->email      = trim($request->email, ' ');
                    $newContact->message    = trim($request->message, ' ');
                    if ($newContact->save()) {
                        $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line']);
                        dispatch(new SendContactUs($newContact->toArray(), $siteSettings));

                        $title      = trans('custom.message_success');
                        $message    = trans('custom.message_form_success_submit');
                        $type       = 'success';
                    }
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type]);
    }

    /*
        * Function name : privacyPolicy
        * Purpose       : Privacy policy page of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data for the privacy policy
    */
    public function privacyPolicy(Request $request) {
        $getMetaDetails = getMetaDetails('cms', 9);
        $cmsPage        = $this->cmsModel->where('id', 9)->first();

        return view('site.privacy_policy', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
        ]);
    }

    /*
        * Function name : termsOfUse
        * Purpose       : Terms of use page of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data for the terms of use
    */
    public function termsOfUse(Request $request) {
        $getMetaDetails = getMetaDetails('cms', 10);
        $cmsPage        = $this->cmsModel->where('id', 10)->first();

        return view('site.terms_of_use', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
        ]);
    }

    /*
        * Function name : copyrightPolicy
        * Purpose       : Copyright policy page of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data for the Copyright policy
    */
    public function copyrightPolicy(Request $request) {
        $getMetaDetails = getMetaDetails('cms', 11);
        $cmsPage        = $this->cmsModel->where('id', 11)->first();

        return view('site.copyright_policy', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
        ]);
    }

    /*
        * Function Name : rateYourGame
        * Purpose       : This function is get details for rate your game
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  :
    */
    public function rateYourGame(Request $request) {
        $getMetaDetails = getMetaDetails('cms', 13);
        $cmsPage        = $this->cmsModel->where('id', 13)->first();

        return view('site.rate_your_game', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage
        ]);
    }

    /*
        * Function Name : localCourt
        * Purpose       : This function is get local court
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  :
    */
    public function localCourt(Request $request) {
        $getMetaDetails = getMetaDetails('cms', 14);
        $cmsPage        = $this->cmsModel->where('id', 14)->first();
        $homeCourts     = PickleballCourt::select('id','title','address','city')->where(['status' => '1'])->whereNull('deleted_at')->orderBy('title', 'ASC')->get();

        return view('site.local_court', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
            'homeCourts'        => $homeCourts,
        ]);
    }

    /*
        * Function Name : playoffPage
        * Purpose       : This function is get details for playoff page
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  :
    */
    public function playoffsPage(Request $request) {
        if (!Auth::user()) {
            return redirect()->route('site.home');
        }

        $getMetaDetails = getMetaDetails('cms', 20);
        $cmsPage        = $this->cmsModel->where('id', 20)->first();
        $siteSettings   = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line']);

        return view('site.city_playoffs', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
            'siteSettings'      => $siteSettings,
        ]);
    }

    /*
        * Function Name : findALeague
        * Purpose       : This function is show find a league page
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  :
    */
    public function findALeague(Request $request,$id=null) {

        $getMetaDetails = getMetaDetails('cms', 1);
        $cmsPage        = $this->cmsModel->where('id', 1)->first();
        $leagueList=NewLeague::all();
        if (empty($id))
        {
            return view('site.find_a_league', [
                'title'             => $getMetaDetails['title'],
                'metaKeywords'      => $getMetaDetails['metaKeywords'],
                'metaDescription'   => $getMetaDetails['metaDescription'],
                'cmsDetails'        => $cmsPage,
                'leaguelist'        => $leagueList,

            ]);
        }
        else{
            $usersDetail= DB::table('users')
                ->join('user_details', 'users.id', '=', 'user_details.user_id')
                ->where('users.id',$id)
                ->get();
            return view('site.find_a_league', [
                'title'             => $getMetaDetails['title'],
                'metaKeywords'      => $getMetaDetails['metaKeywords'],
                'metaDescription'   => $getMetaDetails['metaDescription'],
                'cmsDetails'        => $cmsPage,
                'leaguelist'        => $leagueList,
                'userDetail'=>$usersDetail
            ]);
        }
    }


    public function findALeague2(Request $request,$id=null) {

        $getMetaDetails = getMetaDetails('cms', 1);
        $cmsPage        = $this->cmsModel->where('id', 1)->first();
        $leagueList=NewLeague::all();
        if (empty($id))
        {
            return view('site.findleague1', [
                'title'             => $getMetaDetails['title'],
                'metaKeywords'      => $getMetaDetails['metaKeywords'],
                'metaDescription'   => $getMetaDetails['metaDescription'],
                'cmsDetails'        => $cmsPage,
                'leaguelist'        => $leagueList,

            ]);
        }
        else{
            $usersDetail= DB::table('users')
                ->join('user_details', 'users.id', '=', 'user_details.user_id')
                ->where('users.id',$id)
                ->get();
            return view('site.find_a_league', [
                'title'             => $getMetaDetails['title'],
                'metaKeywords'      => $getMetaDetails['metaKeywords'],
                'metaDescription'   => $getMetaDetails['metaDescription'],
                'cmsDetails'        => $cmsPage,
                'leaguelist'        => $leagueList,
                'userDetail'=>$usersDetail
            ]);
        }
    }




    /*
        * Function Name : leagueRegistration
        * Purpose       : This function is show find a league registration page
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  :
    */
    public function leagueRegistration(Request $request, $id = null,$userid=null) {
        $getMetaDetails = getMetaDetails('cms', 1);
        $cmsPage        = $this->cmsModel->where('id', 1)->first();
        $leagueRow=NewLeague::where('leagueid',$id)->first();

        $teams=DB::table('league_player_list')
            ->join('users', 'users.id', '=', 'league_player_list.player_id')->where('league_player_list.status',0)->get();

        $loggedInPlayer=DB::table('league_player_list')
            ->join('users', 'users.id', '=', 'league_player_list.player_id')->where('league_player_list.status',0)->where('users.id',Auth::user()->id)->get();

        //        Log::info($teams);
        return view('site.league_registration', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
            'leagueRow'=>$leagueRow,
            'teamsPending'=>$teams,
            'playertwo_id'=>$userid,
            'loggedInPlayer'=>$loggedInPlayer
        ]);
    }

    public function checkPlayerTwo($id,$playertwoid)
    {
//        $teamid = DB::table('teams')->where('teams.leagueid', $id)->value('teams.id');
        $player2Email=User::where('id',$playertwoid)->value('email');

        $teamid = DB::table('teams')
            ->join('team_players', 'team_players.team_id', '=', 'teams.id')
            ->where('team_players.player2_email', $player2Email)->where('teams.leagueid', $id)->value('teams.id');

        $email1 = DB::table('team_players')->where('team_players.team_id', $teamid)->value('player1_email');
        $email2 = DB::table('team_players')->where('team_players.team_id', $teamid)->value('player2_email');


        $user1 = DB::table('users')->where('users.email', $email1)->exists();
        $user2 = DB::table('users')->where('users.email', $email2)->exists();


        $emailExist = TeamPlayers::where('player2_email', $email1)->exists();
        $emailExist = TeamPlayers::where('player2_email', $email2)->exists();

        if (!empty($user1) && !empty($user2)) {
            $currentDate = date("Y-m-d");
            $data = NewLeague::where('leagueid', $id)->first();
            $user = DB::table('users')
                ->join('user_details', 'users.id', '=', 'user_details.user_id')
                ->where('users.id', $playertwoid)
                ->get();

            $players = DB::table('teams')
                ->join('team_players', 'team_players.team_id', '=', 'teams.id')
                ->where('teams.id', $teamid)->first();
            if ($data->todate < $currentDate) {
                return 1;
            } else if (empty($user2)) {
                return 2;
            } else {
                return response()->json(['user' => $user, 'players' => $players]);
            }
        }
        else {
            return response()->json(['failed' => true]);
        }
    }

    public function addTeamsInLeague(Request $request){
        $user=Auth::user();
        $teams = new TeamsModel();
        $teams->leagueid = $request->leagueid;
        $teams->player_type_id = Auth::user()->id;
        $teams->title = $request->team_name;
        $tosendid=0;
        if($teams->save()){
            $id=TeamsModel::where('title',$request->team_name)->where('leagueid',$request['leagueid'])->value('id');
            $tosendid=$id;
            $players=new TeamPlayers();
            $players->team_id=$id;
            $players->player1_id=$user->id;
            $players->player1_name=$request->player_1_name;
            $players->player1_email=$user->email;
            $players->player2_name=$request->player_2_name;
            $players->player2_email=$request->player_2_email;
            $players->player1_payment_status="pending";
            $players->player2_payment_status="pending";
            $players->pending_status=0;
            $players->save();

            $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line', 'facebook_link', 'instagram_link']);
            $leagueDetails=NewLeague::where('leagueid',$request['leagueid'])->first();
            dispatch(new SendConfirmationToPlayerTwo($request->all(),$id,$leagueDetails, $siteSettings));
        }
        return response()->json(['success' => true, 'teamid' => $tosendid]);
    }

    public function checkPage()
    {
        return view('emails.site.both-player-success');
    }
    public function PlayerOnePage($id)
    {
        $players=TeamPlayers::where('team_id',$id)->first();
        return view('emails.site.teams_player.player_1_confirmation_page')->with('user',$players);
    }

}
