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
                    })
                    ->addColumn('status', function ($row) {
                        return $row->status;
                    })
                    ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes) {
                        $btn = '';
                        $teamsLink = route($this->routePrefix . '.' . $this->teamsUrl);

                        if ($isAllow || in_array($this->editUrl, $allowedRoutes)) {
                            $editLink = route($this->routePrefix . '.' . $this->editUrl, $row->leagueid);
                            $btn .= '<a href="' . $editLink . '" data-microtip-position="top" role="tooltip" class="btn btn-success btn-circle btn-circle-sm" aria-label="' . trans('custom_admin.label_edit') . '"><i class="fa fa-edit"></i></a>';

                        }
                        if ($isAllow || in_array($this->deleteUrl, $allowedRoutes)) {
                            $btn .= ' <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-danger delete btn-circle btn-circle-sm" aria-label="' . trans('custom_admin.label_league_team') . '"  data-id="' . $row->leagueid . '"><i class="fa fa-trash"></i></a>';

                        }
                        $btn .= ' <a href="' . $teamsLink . '" data-microtip-position="top" role="tooltip" class="badge badge-pill badge-info" aria-label="' . trans('custom_admin.label_league_team') . '"  data-id="' . $row->leagueid . '">Teams</a>';

                        return $btn;
                    })
                    ->rawColumns(['status', 'action'])
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
        //        $validateDate = $request->validate([
        //            'league_name' => 'required',
        //            'zip_code' => 'required',
        //            'play_type' => 'required',
        //            'gender' => 'required',
        //            'rating' => 'required',
        //            'date' => 'required',
        //            'max_team' => 'required',
        //            'status' => 'required',
        //            'amount' => 'required',
        //            'city' => 'required',
        //            'state' => 'required',
        //        ]);
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
}
