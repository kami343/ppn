<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendConfirmationToPlayerTwo;
use App\Jobs\SendPlayerOneDenyEmail;
use App\Models\NewLeague;
use App\Models\TeamPlayers;
use App\Models\TeamsModel;
use App\Traits\GeneralMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DataTables;
use DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
class TeamsController extends Controller
{


    use GeneralMethods;

    public $controllerName = 'teams';
    public $management;
    public $modelName = 'TeamsModel';
    public $breadcrumb;
    public $routePrefix = 'admin';
    public $pageRoute = 'teams';
    public $createUrl = 'teams.create';
    public $listUrl = 'teams.list';
    public $listRequestUrl = 'teams.ajax-list-request';

    public $addUrl = 'teams.add';
    public $editUrl = 'teams.edit';
    public $updateUrl = 'teams.update';
    public $statusUrl = 'teams.change-status';
    public $deleteUrl = 'teams.delete';
    public $viewFolderPath = 'admin.teams';

    //    public $model           = 'Video';

    public function __construct($data = null)
    {
        parent::__construct();

        $this->management = trans('custom_admin.new_league_module');
        $this->model = new TeamsModel();

        // Assign breadcrumb
        $this->assignBreadcrumb();

        // Variables assign for view page
        $this->assignShareVariables();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }


    public function teamsList($id)
    {
     

        $data = [
            'pageTitle' => trans('custom_admin.label_league_team'),
            'panelTitle' => trans('custom_admin.label_league_team'),
            'pageType' => 'newTeamList'
        ];

        try {
            // Start :: Manage restriction
            $data['isAllow'] = false;
            $restrictions = checkingAllowRouteToUser($this->pageRoute . '.');
            if ($restrictions['is_super_admin']) {
                $data['isAllow'] = true;
            }

            $data['allowedRoutes'] = $restrictions['allow_routes'];
            $data['id'] = $id;
            // End :: Manage restriction
            return view($this->viewFolderPath . '.list', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix . '.dashboard');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix . '.dashboard');
        }
    }



    public function ajaxListRequest(Request $request)
    {
        $data['pageTitle'] = trans('custom_admin.label_league_team');
        $data['panelTitle'] = trans('custom_admin.label_league_team');

        $id = $request['columns'][0]['data'];



        try {
            if ($request->ajax()) {
                //$data = $this->model->where('leagueid',$id)->get();

                $data =  $this->model->join('team_players', 'team_players.team_id', '=', 'teams.id')
                ->select('teams.*', 'team_players.*',  'teams.id as team_id')
                ->where('leagueid',$id)->get();
               

                // Start :: Manage restriction
                 $isAllow = false;
                $restrictions = checkingAllowRouteToUser($this->pageRoute . '.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes = $restrictions['allow_routes'];


                return Datatables::of($data, $isAllow, $allowedRoutes)
                    ->addIndexColumn()
                    ->addColumn('title', function ($row) {
                        return $row->title;
                    })
                    ->addColumn('player1_name', function ($row) {
                        return $row->player1_name;
                    })
                     ->addColumn('player1_email', function ($row) {
                        return $row->player1_email;
                    })

                    ->addColumn('player2_name', function ($row) {
                        return $row->player2_name;
                    })
                     ->addColumn('player2_email', function ($row) {
                        return $row->player2_email;
                    })

                    ->addColumn('status',  function ($row) use ($isAllow, $allowedRoutes) {

                         if ($isAllow || in_array($this->statusUrl, $allowedRoutes)) {
                                if ($row->status == '1') {
                                    $status = ' <a href="javascript:void(0)" data-microtip-position="top" role="" aria-label="'.trans('Active').'" data-id="'.customEncryptionDecryption($row->team_id).'" data-action-type="inactive" class="custom_font team_status"><span class="badge badge-pill badge-success">'.trans('Active').'</span></a>';
                                } else {
                                    $status = ' <a href="javascript:void(0)" data-microtip-position="top" role="" aria-label="'.trans('inactive').'" data-id="'.customEncryptionDecryption($row->team_id).'" data-action-type="active" class="custom_font team_status"><span class="badge badge-pill badge-danger">'.trans('inactive').'</span></a>';
                                }
                            } else {
                                if ($row->status == '1') {
                                    $status = ' <a data-microtip-position="top" role="" aria-label="'.trans('active').'" class="custom_font"><span class="badge badge-pill badge-success">'.trans('Active').'</span></a>';
                                } else {
                                    $status = ' <a data-microtip-position="top" role="" aria-label="'.trans('custom_admin.label_active').'" class="custom_font"><span class="badge badge-pill badge-danger">'.trans('Deactive').'</span></a>';
                                }
                            }
                            return $status;
                    })

                     ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes) {
                        $btn = '';
                       
                        if ($isAllow || in_array($this->editUrl, $allowedRoutes)) {
                            $editLink = route($this->routePrefix . '.' . $this->editUrl, $row->team_id);
                            $btn .= '<a href="' . $editLink . '" data-microtip-position="top" role="tooltip" class="btn btn-success btn-circle btn-circle-sm" aria-label="' . trans('Edit') . '"><i class="fa fa-edit"></i></a>';

                        }
                     
                      
                        return $btn;
                    })

                    ->rawColumns(['status','action'])
                    ->make(true);
            }
            return view($this->viewFolderPath . '.list');
        } catch (Exception $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        }
    }

    public function SendPlayerOneDenyRequest($teamid){

        $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line', 'facebook_link', 'instagram_link']);
        $leagueid=TeamsModel::where('id',$teamid)->value('leagueid');
        $leagueDetails=NewLeague::where('leagueid',$leagueid)->first();
        $data=TeamPlayers::where('team_id',$teamid)->first();
        $teamsDeleteflag=TeamsModel::destroy($teamid);
        $teamPlayersDeletFlag=TeamPlayers::where('team_id', $teamid)->delete();
        if ($teamsDeleteflag && $teamPlayersDeletFlag){
            dispatch(new SendPlayerOneDenyEmail($data,$leagueDetails, $siteSettings));

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 public function edit($id)
    {
        $fetchedRow = $this->model->where('id', $id)->first();

       $fetchedRow = $this->model->join('team_players', 'team_players.team_id', '=', 'teams.id')
                ->select('teams.*', 'team_players.*',  'teams.id as team_id')
                ->where('teams.id',$id)->first();

    

        $data = [
            'pageTitle' => trans('Edit Team Record'),
            'panelTitle' => trans('Edit Team Record'),
            'pageType' => 'EditPage'
        ];

        try {
            // Start :: Manage restriction
            $data['isAllow'] = false;
            $restrictions = checkingAllowRouteToUser($this->pageRoute . '.');
            if ($restrictions['is_super_admin']) {
                $data['isAllow'] = true;
            }
            $data['allowedRoutes'] = $restrictions['allow_routes'];
            // End :: Manage restriction

            return view($this->viewFolderPath . '.edit', $data, compact('fetchedRow'));
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix . '.dashboard');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix . '.dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      

        $player1 = explode("(",$request['player1_name']);
        $player2 = explode("(",$request['player2_name']);


       $update = DB::table('teams')
        ->where('id', $request['team_id'])  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('title' => $request['team_name']));  // update the record in the DB. 

          $update = DB::table('team_players')
        ->where('id', $request['team_playerid'])  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('player1_name' => $player1[0],'player1_email' => str_replace(")","",$player1[1]),'player2_name' => $player2[0],'player2_email' => str_replace(")","",$player2[1]),));  // update the record in the DB. 

        //   $toSave = NewLeague::find($id);
        // $toSave->league_name = $request['league_name'];
        // $toSave->zip_code = $request['zip_code'];
        // $toSave->play_type = $request['play_type'];
        // $toSave->gender = $request['gender'];
        // $toSave->rating = $request['rating'];
        // $toSave->fromdate = $request['fromdate'];
        // $toSave->todate = $request['todate'];
        // $toSave->age = $request['age'];
        // $toSave->max_team = $request['max_team'];
        // $toSave->status = $request['status'];
        // $toSave->amount = $request['amount'];
        // $toSave->city = $request['city'];
        // $toSave->state = $request['state'];
        // $toSave->save();
        // $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);

       
         return redirect()->route($this->routePrefix . '.' . $this->listUrl,$request['leagueid']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


     public function status(Request $request, $id = null) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';

   
        try {
            if ($request->ajax()) {
          
                 $id = customEncryptionDecryption($id, 'decrypt');
                  
                if ($id != null) {
                    $details = $this->model->where('id', $id)->first();
                    if ($details != null) {
                        if ($details->status == '1') {
                            $details->status = '0';
                            $details->save();

                            $title      = trans('custom_admin.message_success');
                            $message    = trans('custom_admin.success_status_updated_successfully');
                            $type       = 'success';
                        } else if ($details->status == '0') {
                            $details->status = '1';

                            $details->save();

                            $title      = trans('custom_admin.message_success');
                            $message    = trans('custom_admin.success_status_updated_successfully');
                            $type       = 'success';
                        }
                    } else {
                        $message = trans('custom_admin.error_invalid');
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



}
