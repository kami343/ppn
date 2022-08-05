<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\NewLeague;
use App\Models\TeamsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\GeneralMethods;
use DataTables;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class NewLeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use GeneralMethods;

    public $controllerName = 'NewLeague';
    public $management;
    public $modelName = 'NewLeague';
    public $breadcrumb;
    public $routePrefix = 'admin';
    public $pageRoute = 'newLeague';
    public $createUrl = 'newLeague.create';
    public $listUrl = 'newLeague.list';

    public $listRequestUrl = 'newLeague.ajax-list-request';
    public $addUrl = 'newLeague.add';
    public $editUrl = 'newLeague.edit';
    public $teamsUrl = 'teams.list';
    public $updateUrl = 'newLeague.update';
    public $statusUrl = 'newLeague.change-status';
    public $deleteUrl = 'newLeague.delete';
    public $viewFolderPath = 'admin.newLeague';
    public $playerUrl = 'playerList.list';



    //    public $model           = 'Video';

    public function __construct($data = null)
    {
        parent::__construct();

        $this->management = trans('custom_admin.new_league_module');
        $this->model = new NewLeague();

        // Assign breadcrumb
        $this->assignBreadcrumb();

        // Variables assign for view page
        $this->assignShareVariables();
    }

    public function index()
    {
        $data = [
            'pageTitle' => trans('custom_admin.new_league_module'),
            'panelTitle' => trans('custom_admin.new_league_module'),
            'pageType' => 'CreatePage'
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

            return view($this->viewFolderPath . '.create', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix . '.dashboard');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix . '.dashboard');
        }
    }

    public function leagueList()
    {
        $data = [
            'pageTitle' => trans('custom_admin.label_league_list'),
            'panelTitle' => trans('custom_admin.label_league_list'),
            'pageType' => 'newLeagueList'
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
        $data['pageTitle'] = trans('custom_admin.label_league_list');
        $data['panelTitle'] = trans('custom_admin.label_league_list');

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
                    ->addColumn('league_name', function ($row) {
                        return $row->league_name;

                    })->addColumn('zip_code', function ($row) {
                        return $row->zip_code;

                    })->addColumn('city', function ($row) {
                        return $row->city;


                    })->addColumn('state', function ($row) {
                        return $row->state;
                     })->addColumn('gender', function ($row) {
                        return $row->gender;
                
                      })->addColumn('rating', function ($row) {
                        return $row->rating;
                

                    })->addColumn('status', function ($row) {
                        return $row->status;
                    })
                    ->addColumn('league_status', function ($row) use ($isAllow, $allowedRoutes) {
                       
                            if ($isAllow || in_array($this->statusUrl, $allowedRoutes)) {
                                if ($row->league_status == '1') {
                                    $league_status = ' <a href="javascript:void(0)" data-microtip-position="top" role="" aria-label="'.trans('Active').'" data-id="'.customEncryptionDecryption($row->leagueid).'" data-action-type="inactive" class="custom_font leauge_status"><span class="badge badge-pill badge-success">'.trans('Active').'</span></a>';
                                } else {
                                    $league_status = ' <a href="javascript:void(0)" data-microtip-position="top" role="" aria-label="'.trans('inactive').'" data-id="'.customEncryptionDecryption($row->leagueid).'" data-action-type="active" class="custom_font leauge_status"><span class="badge badge-pill badge-danger">'.trans('inactive').'</span></a>';
                                }
                            } else {
                                if ($row->league_status == '1') {
                                    $league_status = ' <a data-microtip-position="top" role="" aria-label="'.trans('cust').'" class="custom_font"><span class="badge badge-pill badge-success">'.trans('Active').'</span></a>';
                                } else {
                                    $league_status = ' <a data-microtip-position="top" role="" aria-label="'.trans('custom_admin.label_active').'" class="custom_font"><span class="badge badge-pill badge-danger">'.trans('Deactive').'</span></a>';
                                }
                            }
                            return $league_status;
                        })
                    ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes) {
                        $btn = '';
                        $teamsLink = route($this->routePrefix . '.' . $this->teamsUrl);

                        $playerLink = route($this->routePrefix . '.' . $this->playerUrl);

                        if ($isAllow || in_array($this->editUrl, $allowedRoutes)) {
                            $editLink = route($this->routePrefix . '.' . $this->editUrl, $row->leagueid);
                            $btn .= '<a href="' . $editLink . '" data-microtip-position="top" role="tooltip" class="btn btn-success btn-circle btn-circle-sm" aria-label="' . trans('custom_admin.label_edit') . '"><i class="fa fa-edit"></i></a>';

                        }
                        if ($isAllow || in_array($this->deleteUrl, $allowedRoutes)) {
                            $btn .= ' <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-danger delete btn-circle btn-circle-sm" aria-label="' . trans('custom_admin.label_league_team') . '"  data-id="' . $row->leagueid . '"><i class="fa fa-trash"></i></a>';

                        }
                        $btn .= ' <a href="' . $teamsLink."/".$row->leagueid . '" data-microtip-position="top" role="tooltip" class="badge badge-pill badge-info" aria-label="' . trans('custom_admin.label_league_team') . '"  data-id="' . $row->leagueid . '">Teams</a>';

                        $btn .= ' <a href="' . $playerLink."/".$row->leagueid . '" data-microtip-position="top" role="tooltip" class="badge badge-pill badge-info" aria-label="' . trans('custom_admin.label_league_team') . '"  data-id="' . $row->leagueid . '">Players List</a>';

                        return $btn;
                    })
                    ->rawColumns(['status', 'league_status','action'])
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        NewLeague::create([
            'league_name' => $request['league_name'],
            'zip_code' => $request['zip_code'],
            'play_type' => $request['play_type'],
            'gender' => $request['gender'],
            'rating' => $request['rating'],
            'todate' => $request['todate'],
            'fromdate' => $request['fromdate'],
            'age' => $request['age'],
            'max_team' => $request['max_team'],
            'status' => $request['status'],
            'amount' => $request['amount'],
            'city' => $request['city'],
            'state' => $request['state'],
        ]);

        return redirect()->back()->with('message', 'Record Added Successfully..');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\NewLeague $newLeague
     * @return \Illuminate\Http\Response
     */
    public function show(NewLeague $newLeague)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\NewLeague $newLeague
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fetchedRow = NewLeague::where('leagueid', $id)->first();

        $data = [
            'pageTitle' => trans('custom_admin.label_league_edit'),
            'panelTitle' => trans('custom_admin.label_league_edit'),
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\NewLeague $newLeague
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $toSave = NewLeague::find($id);
        $toSave->league_name = $request['league_name'];
        $toSave->zip_code = $request['zip_code'];
        $toSave->play_type = $request['play_type'];
        $toSave->gender = $request['gender'];
        $toSave->rating = $request['rating'];
        $toSave->fromdate = $request['fromdate'];
        $toSave->todate = $request['todate'];
        $toSave->age = $request['age'];
        $toSave->max_team = $request['max_team'];
        $toSave->status = $request['status'];
        $toSave->amount = $request['amount'];
        $toSave->city = $request['city'];
        $toSave->state = $request['state'];
        $toSave->save();
        $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
        return redirect()->route($this->routePrefix . '.' . $this->listUrl);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\NewLeague $newLeague
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flag = NewLeague::destroy($id);
        // $flag = NewLeague::where('leagueid', $id)
        //     ->update([
        //         'status' => '0'
        //     ]);

        $title = trans('custom_admin.message_error');
        $message = trans('custom_admin.error_something_went_wrong');
        $type = 'error';
        if ($flag) {
            $title = trans('custom_admin.message_success');
            $message = trans('custom_admin.success_data_deleted_successfully');
            $type = 'success';
        } else {
            $message = trans('custom_admin.error_took_place_while_deleting');
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type]);
    }


     public function status(Request $request, $id = null) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';

   
        try {
            if ($request->ajax()) {
          
                 $id = customEncryptionDecryption($id, 'decrypt');

                if ($id != null) {
                    $details = $this->model->where('leagueid', $id)->first();
                    if ($details != null) {
                        if ($details->league_status == '1') {
                            $details->league_status = '0';
                            $details->save();

                            $title      = trans('custom_admin.message_success');
                            $message    = trans('custom_admin.success_status_updated_successfully');
                            $type       = 'success';
                        } else if ($details->league_status == '0') {
                            $details->league_status = '1';

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
