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


    public function teamsList()
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

        try {
            if ($request->ajax()) {
                $data = $this->model->get();
                // Start :: Manage restriction
                $isAllow = false;
                $restrictions = checkingAllowRouteToUser($this->pageRoute . '.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes = $restrictions['allow_routes'];
                // End :: Manage restriction


                return Datatables::of($data, $isAllow, $allowedRoutes)
                    ->addIndexColumn()
                    ->addColumn('title', function ($row) {
                        return $row->title;

                    })
                    ->addColumn('status', function ($row) {
                        return $row->status;
                    })
                    ->rawColumns(['status'])
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
        //
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
        //
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
}
