<?php
/*
    * Class name    : UsersController
    * Purpose       : Users related details
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\NewLeague;
use App\Models\TeamPlayers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use Auth;
use Hash;
use Illuminate\Support\Facades\Log;
use \Validator;
use \Session;
use DB;
use App\Models\Cms;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\PickleballCourt;
use App\Models\Availability;
use App\Models\UserAvailability;
use App\Models\State;
use App\Jobs\SendPickleballCourtRegistrationToAdmin;
use App\Jobs\SendRegistrationToAdmin;
use App\Jobs\SendRegistrationToUser;
use App\Jobs\SendResetPasswordLinkToUser;


class UsersController extends Controller
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
    public function __construct($data = null)
    {
        parent::__construct();

        // Variables assign for view page
        $this->shareVariables();

        $this->cmsModel = new Cms();
        $this->userModel = new User();
    }

    /*
        * Function name : registration
        * Purpose       : Sign up page of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data for the sign up page
    */
    public function registration(Request $request)
    {
        $getMetaDetails = getMetaDetails('cms', 2);
        $cmsPage = $this->cmsModel->where('id', 2)->first();
        $homeCourts = PickleballCourt::select('id', 'title', 'city', 'state_id')->where(['status' => '1'])->whereNull('deleted_at')->orderBy('title', 'ASC')->get();

        $availabilities = Availability::select('id', 'title', 'short_code')->where(['status' => '1'])->whereNull('deleted_at')->orderBy('sort', 'ASC')->get();
        $states = State::select('id', 'title', 'code')->orderBy('title', 'ASC')->get();

        if (Auth::guard('web')->check()) {
            return redirect()->route('site.users.profile');
        }

        return view('site.account.create-account-step1', [
            'title' => $getMetaDetails['title'],
            'metaKeywords' => $getMetaDetails['metaKeywords'],
            'metaDescription' => $getMetaDetails['metaDescription'],
            'cmsDetails' => $cmsPage,
            'homeCourts' => $homeCourts,
            'availabilities' => $availabilities,
            'states' => $states,
        ]);
//        return view('site.account.create-account-step1', ['homeCourts' => $homeCourts]);
    }

    /*
        * Function name : ajaxRegistrationSubmit
        * Purpose       : This function is submit registration form
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxRegistrationSubmit(Request $request)
    {

        $title = trans('custom.message_error');
        $message = trans('custom.error_something_went_wrong');
        $type = 'error';
        $loginId = '';

        try {
            $checkUserExist = $this->userModel->where(['email' => $request->email])->count();
            if ($checkUserExist == 0) {
                $newUser = $this->userModel;
                $newUser->first_name = ucfirst(trim($request->first_name, ' '));
                $newUser->last_name = ucfirst(trim($request->last_name, ' '));
                $newUser->full_name = $newUser->first_name . ' ' . $newUser->last_name;
                $newUser->email = trim($request->email, ' ');
                $newUser->phone_no = trim($request->phone_no, ' ');
                $newUser->password = $request->password;
                $newUser->gender = $request->gender ?? 'M';
                $newUser->dob = $request->year . '-' . $request->month . '-' . $request->day;
                $newUser->player_rating = $request->player_rating;
                $newUser->status = '1';
                $newUser->agree = $request->agree ? 'Y' : 'N';
                $newUser->is_waiver_signed = 'Y';
                $newUser->send_score_confirmation = 'Y';
                $newUser->flag = 0;
                $password = $request->password;
                if ($newUser->save()) {
                    $newUserDetail = new UserDetail();
                    $newUserDetail->user_id = $newUser->id;
                    $newUserDetail->home_court = $request->home_court ?? null;
                    $newUserDetail->address_line_1 = $request->address_line_1 ?? null;
                    $newUserDetail->address_line_2 = $request->address_line_2 ?? null;
                    $newUserDetail->city = $request->city ?? null;
                    $newUserDetail->state = $request->state ?? null;
                    $newUserDetail->zip = $request->zip ?? null;
                    $newUserDetail->how_did_you_find_us = $request->how_did_you_find_us ?? null;
                    $newUserDetail->save();

                    // User availability
                    $userAvailability = $availabilityIds = [];
                    if (isset($request->availability) && count($request->availability)) {
                        foreach ($request->availability as $key => $item) {
                            $userAvailability[$key]['user_id'] = $newUser->id;
                            $userAvailability[$key]['availability_id'] = $item;
                            $availabilityIds[] = $item;
                        }
                        if (count($userAvailability)) {
                            UserAvailability::insert($userAvailability);
                        }
                    }

                    $homeCourts = PickleballCourt::where(['id' => $newUserDetail->home_court])->first();
                    $state = State::where(['id' => $newUserDetail->state])->first();
                    $lastInsertedUser = $this->userModel->where(['id' => $newUser->id])->first();
                    $playingDetails['home_court'] = $homeCourts->title;
                    $playingDetails['address_line_1'] = $request->address_line_1 ?? null;
                    $playingDetails['address_line_2'] = $request->address_line_2 ?? 'NA';
                    $playingDetails['city'] = $request->city ?? null;
                    $playingDetails['state'] = $state->title ?? null;
                    $playingDetails['zip'] = $request->zip ?? null;

                    $howDidYouHearAboutUs = config('global.HOW_DID_YOU_HEAR_ABOUT_US');

                    if ($newUserDetail->how_did_you_find_us == 'SE') {
                        $playingDetails['how_did_you_find_us'] = $howDidYouHearAboutUs['SE'];
                    } else if ($newUserDetail->how_did_you_find_us == 'SM') {
                        $playingDetails['how_did_you_find_us'] = $howDidYouHearAboutUs['SM'];
                    } else if ($newUserDetail->how_did_you_find_us == 'RBF') {
                        $playingDetails['how_did_you_find_us'] = $howDidYouHearAboutUs['RBF'];
                    } else if ($newUserDetail->how_did_you_find_us == 'BOP') {
                        $playingDetails['how_did_you_find_us'] = $howDidYouHearAboutUs['BOP'];
                    } else if ($newUserDetail->how_did_you_find_us == 'AD') {
                        $playingDetails['how_did_you_find_us'] = $howDidYouHearAboutUs['AD'];
                    } else if ($newUserDetail->how_did_you_find_us == 'O') {
                        $playingDetails['how_did_you_find_us'] = $howDidYouHearAboutUs['O'];
                    } else {
                        $playingDetails['how_did_you_find_us'] = 'NA';
                    }

                    $userAvailabilities = '';
                    if (count($availabilityIds)) {
                        asort($availabilityIds);
                        $userAvailabilitiesData = Availability::select('title')->whereIn('id', $availabilityIds)->get();

                        $arrayCount = 1;
                        foreach ($userAvailabilitiesData as $userAvailability) {
                            $userAvailabilities .= $userAvailability->title;
                            if ($arrayCount < count($availabilityIds)) {
                                $userAvailabilities .= ', ';
                            }
                            $arrayCount++;
                        }
                    }
                    $playingDetails['availability'] = $userAvailabilities;

                    $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line', 'facebook_link', 'instagram_link']);

                    // Mail to user
                    dispatch(new SendRegistrationToUser($lastInsertedUser->toArray(), $lastInsertedUser->userDetails->toArray(), $playingDetails, $password, $siteSettings));

                    // Mail to admin
                    dispatch(new SendRegistrationToAdmin($lastInsertedUser->toArray(), $lastInsertedUser->userDetails->toArray(), $playingDetails, $siteSettings));

                    // Login after registration
                    // Auth::guard('web')->loginUsingId($newUser->id);

                    $title = trans('custom.message_success');
                    $message = trans('custom.message_registration_successful');
                    $type = 'success';
                    $loginId = customEncryptionDecryption($newUser->id);
                }
            } else {
                $title = trans('custom.message_error');
                $message = trans('custom.error_already_registered');
                $type = 'error';
                return redirect('/registration')->with('errstatus', $message);

            }

        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        $checkUserId = $this->userModel->where(['email' => $request->email])->value('id');

        return view('site.account.email')->with('email', $request->email)->with('id', $checkUserId);
    }

    /*
        * Function name : login
        * Purpose       : Login page of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data for the login page
    */
    public function login(Request $request)
    {
        $getMetaDetails = getMetaDetails('cms', 3);
        $cmsPage = $this->cmsModel->where('id', 3)->first();

        if (Auth::guard('web')->check()) {
            return redirect()->route('site.users.profile');
        }

        return view('site.login', [
            'title' => $getMetaDetails['title'],
            'metaKeywords' => $getMetaDetails['metaKeywords'],
            'metaDescription' => $getMetaDetails['metaDescription'],
            'cmsDetails' => $cmsPage,
        ]);
    }

    /*VerifyEmailPage
        * Function name : ajaxLoginSubmit
        * Purpose       : This function is submit login form
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxLoginSubmit(Request $request)
    {
        $message = "Login Successfully..";
        $messageError = "Credential is not valid";
        $redirectTo = "join-a-league";
        $type = "error";
        try {
            if ($request->ajax()) {
                if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => '1'], true)) {
                    $user = Auth::user();
                    if ($user->type != 'U') {
                        $message = trans('custom.error_not_authorized');
                        Auth::guard('web')->logout();
                    } else {
                        $userData = Auth::user();
                        $userData->lastlogintime = strtotime(date('Y-m-d H:i:s'));
                        $userData->save();
                        $redirectTo = 'login-new';
                        $message = trans('custom.message_login_successful');
                    }
                    $type = "success";
                } else {
                    $redirectTo = 'login-new';

                    $message = trans('custom.error_invalid_credentials_inactive_user');
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['message' => $message, 'type' => $type, 'redirectTo' => $redirectTo]);

    }

    /*
        * Function name : profile
        * Purpose       : Profile page of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data for the profile page
    */
    public function profile(Request $request)
    {
        $getMetaDetails = getMetaDetails();
        $details = User::where(['id' => Auth::user()->id])->first();
        $assignedLeagues = [];
        $lastTenMatchLists = [];

        $leaguesData = NewLeague::all();
        return view('site.user.profile', [
            'title' => $getMetaDetails['title'],
            'metaKeywords' => $getMetaDetails['metaKeywords'],
            'metaDescription' => $getMetaDetails['metaDescription'],
            'details' => $details,
            'assignedLeagues' => $assignedLeagues,
            'lastTenMatchLists' => $lastTenMatchLists,

        ], compact('leaguesData'));
    }


        public function playerProfile($id)
    {
        $getMetaDetails = getMetaDetails();
        $details = User::where(['id' => $id])->first();
        $assignedLeagues = [];
        $lastTenMatchLists = [];

        $leaguesData = NewLeague::all();
        return view('site.profile', [
            'title' => $getMetaDetails['title'],
            'metaKeywords' => $getMetaDetails['metaKeywords'],
            'metaDescription' => $getMetaDetails['metaDescription'],
            'details' => $details,
            'assignedLeagues' => $assignedLeagues,
            'lastTenMatchLists' => $lastTenMatchLists,

        ], compact('leaguesData'));
    }



    /*
        * Function name : editProfile
        * Purpose       : Edit profile page of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data for the edit profile page
    */
    public function editProfile(Request $request)
    {
        $getMetaDetails = getMetaDetails();
        $homeCourts = PickleballCourt::where(['status' => '1'])->whereNull('deleted_at')->orderBy('title', 'ASC')->get();

        if ($request->isMethod('POST')) {
            $validationCondition = array(
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|regex:' . config('global.EMAIL_REGEX'),
                // 'phone_no'              => 'required',
                // 'preferred_level'       => 'required',
                'profile_pic' => 'mimes:' . config('global.IMAGE_FILE_TYPES') . '|max:' . config('global.IMAGE_MAX_UPLOAD_SIZE'),
                'month' => 'required',
                'day' => 'required',
                'year' => 'required',
            );
            $validationMessages = array(
                'first_name.required' => trans('custom.error_first_name'),
                'last_name.required' => trans('custom.error_last_name'),
                'email.required' => trans('custom.error_email'),
                'email.regex' => trans('custom.error_email_valid'),
                // 'phone_no.required'             => trans('custom.error_phone'),
                'profile_pic.mimes' => trans('custom.error_image_mimes'),
                'month.required' => 'Please select month.',
                'day.required' => 'Please select day.',
                'year.required' => 'Please select year.',
            );

            $validator = Validator::make($request->all(), $validationCondition, $validationMessages);
            if ($validator->fails()) {
                $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                $this->generateToastMessage('error', $validationFailedMessages, false);
                return redirect()->back()->withInput();
            } else {
                $isEmailExist = $this->userModel->where('id', '<>', Auth::user()->id)->where(['email' => $request->email])->first();
                if ($isEmailExist != null) {
                    $this->generateToastMessage('error', trans('custom.error_already_registered'), false);
                    return redirect()->back()->withInput();
                } else {
                    $details = Auth::user();
                    $updateData = [];
                    $profileImage = $request->file('profile_pic');
                    $uploadedProfileImage = '';
                    $previousFileName = null;
                    $unlinkStatus = false;

                    // Profile pic upload
                    $uploadedProfileImage = Auth::user()->profile_pic;
                    if ($profileImage != '') {
                        if (Auth::user()->profile_pic != null) {
                            $previousFileName = Auth::user()->profile_pic;
                            $unlinkStatus = true;
                        }
                        $uploadedProfileImage = singleImageUpload('User', $profileImage, 'profile', 'account', true, $previousFileName, $unlinkStatus);
                    }
                    $update = $this->userModel->where(['id' => Auth::user()->id])->update([
                        'full_name' => trim($request->first_name, ' ') . ' ' . trim($request->last_name, ' '),
                        'first_name' => trim($request->first_name, ' '),
                        'last_name' => trim($request->last_name, ' '),
                        'email' => trim($request->email, ' '),
                        'phone_no' => $request->phone_no,
                        'dob' => $request->year . '-' . $request->month . '-' . $request->day,
                        'profile_pic' => $uploadedProfileImage,
                        'send_score_confirmation' => $request->send_score_confirmation ? 'Y' : 'N',
                    ]);

                    if ($update) {
                        $this->generateToastMessage('success', trans('custom.message_profile_updated_successfully'), false);
                        return redirect()->back();
                    } else {
                        $this->generateToastMessage('error', trans('custom.error_took_place_while_updating'), false);
                        return redirect()->back()->withInput();
                    }
                }
            }
        }
        return view('site.user.edit_profile', [
            'title' => $getMetaDetails['title'],
            'metaKeywords' => $getMetaDetails['metaKeywords'],
            'metaDescription' => $getMetaDetails['metaDescription'],
            'homeCourts' => $homeCourts,
        ]);
    }

    /*
        * Function Name : ajaxDeleteProfileImage
        * Purpose       : This function is for delete profile pic.
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  :
    */
    public function ajaxDeleteProfileImage(Request $request)
    {
        $title = trans('custom.message_error');
        $message = trans('custom.error_something_went_wrong');
        $type = 'error';

        try {
            if ($request->ajax()) {
                $dbField = $request->dbField ? $request->dbField : '';

                if ($dbField != '') {
                    $details = $this->userModel->where('id', Auth::user()->id)->first();
                    if ($details != '') {
                        $response = unlinkFiles($details->profile_pic, 'account', true);
                        if ($response) {
                            $details->$dbField = null;
                            if ($details->save()) {
                                $title = trans('custom.message_success');
                                $message = trans('custom.message_image_uploaded_successfully');
                                $type = 'success';
                            } else {
                                $message = trans('custom.error_took_place_while_deleting');
                            }
                        } else {
                            $message = trans('custom.error_took_place_while_deleting');
                        }
                    } else {
                        $message = trans('custom.error_invalid');
                    }
                } else {
                    $message = trans('custom.error_invalid');
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
        * Function name : changePassword
        * Purpose       : Change password page of the website
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data for the change password page
    */
    public function changePassword(Request $request)
    {
        $getMetaDetails = getMetaDetails();

        return view('site.user.change_password', [
            'title' => $getMetaDetails['title'],
            'metaKeywords' => $getMetaDetails['metaKeywords'],
            'metaDescription' => $getMetaDetails['metaDescription'],
        ]);
    }

    /*
        * Function name : ajaxChangePasswordSubmit
        * Purpose       : This function is submit change password form
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxChangePasswordSubmit(Request $request)
    {
        $title = trans('custom.message_error');
        $message = trans('custom.error_something_went_wrong');
        $type = 'error';

        try {
            if ($request->ajax()) {
                $validationCondition = array(
                    'current_password' => 'required',
                    // 'password'          => 'required|regex:'.config('global.PASSWORD_REGEX'),
                    'password' => 'required',
                    'confirm_password' => 'required|same:password',
                );
                $validationMessages = array(
                    'current_password.required' => trans('custom.error_current_password'),
                    'password.required' => trans('custom.error_new_password'),
                    // 'password.regex'            => trans('custom.error_password_regex'),
                    'confirm_password.required' => trans('custom.error_confirm_password'),
                    'confirm_password.same' => trans('custom.error_confirm_password_password'),
                );

                $validator = Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $message = validationMessageBeautifier($validator->messages()->getMessages());
                    $type = 'validation';
                } else {
                    $userDetail = Auth::guard('web')->user();
                    $userId = Auth::guard('web')->user()->id;
                    $hashedPassword = $userDetail->password;

                    // check if current password matches with the saved password
                    if (Hash::check($request->current_password, $hashedPassword)) {
                        $userDetail->password = $request->password;

                        if ($userDetail->save()) {
                            $message = trans('custom.message_password_update_successful');
                            $type = 'success';
                        }
                    } else {
                        $message = trans('custom.error_current_password_not_match');
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
        * Function name : ajaxForgotPasswordSubmit
        * Purpose       : This function is submit forgot password form
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxForgotPasswordSubmit(Request $request)
    {


        $title = trans('custom.message_error');
        $message = trans('custom.error_something_went_wrong');
        $type = 'error';

        try {
            if ($request->ajax()) {
                $userData = $this->userModel->select('id', 'first_name', 'email', 'role_id', 'remember_token', 'status')
                    ->where('email', $request->email)
                    ->first();

                if ($userData) {

                    if ($userData->role_id != null) {
                        $message = trans('custom.error_not_authorized');
                    } else if ($userData->status == '0') {
                        $message = trans('custom.error_inactive_user');

                    } else {
                        $rememberToken = $this->OTP();
                        $userData->remember_token = $rememberToken;

                        if ($userData->save()) {
                            // Mail to user
                            $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line']);
                            dispatch(new SendResetPasswordLinkToUser($userData->toArray(), $rememberToken, $siteSettings));

                            $title = trans('custom.message_success');
                            $message = trans('custom.message_reset_password_link_for_email');
                            $type = 'success';
                        }
                    }
                } else {
                    $message = trans('custom.error_email_not_found');
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
        * Function name : ajaxResetPasswordSubmit
        * Purpose       : This function is submit reset password form
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxResetPasswordSubmit(Request $request)
    {
        $title = trans('custom.message_error');
        $message = trans('custom.error_something_went_wrong');
        $type = 'error';
        try {
            $userData = $this->userModel->select('id', 'first_name', 'email', 'role_id', 'remember_token', 'status')
                ->where(DB::raw('BINARY `remember_token`'), $request->otp)
                ->first();
            if ($userData) {
                if ($userData->role_id != null) {
                    $message = trans('custom.error_not_authorized');
                } else if ($userData->status == '0') {
                    $message = trans('custom.error_inactive_user');
                } else {
                    $userData->remember_token = null;
                    $userData->password = $request->password;

                    if ($userData->save()) {
                        $title = trans('custom.message_success');
                        $message = trans('custom.message_password_update_successful');
                        $type = 'success';
                    }
                }
            } else {
                $message = trans('custom.error_reset_already_done');
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {

            $message = $e->getMessage();
        }

        return response()->json(['title' => $title, 'message' => $message, 'type' => $type]);
    }

    /*
        * Function name : logout
        * Purpose       : This function is to logout
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function logout()
    {
        if (Auth::guard('web')->logout()) {
            // Session reset
            return redirect()->route('site.home');
        } else {
            return redirect()->route('site.home');
        }
    }

    /*
        * Function name : thankYou
        * Purpose       : Thank you page after registration
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Display thank you message
    */
    public function thankYou(Request $request, $userId = null)
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('site.users.profile');
        }

        $getMetaDetails = getMetaDetails();
        $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line']);

        return view('site.thank_you', [
            'title' => $getMetaDetails['title'],
            'metaKeywords' => $getMetaDetails['metaKeywords'],
            'metaDescription' => $getMetaDetails['metaDescription'],
            'siteSettings' => $siteSettings,
            'userId' => $userId,
        ]);
    }

    /*
        * Function name : loginUsingId
        * Purpose       : Log in using user id
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Redirecttion
    */
    public function loginUsingId(Request $request, $userId = null)
    {
        if ($userId) {
            $userId = customEncryptionDecryption($userId, 'decrypt');
            $userExist = $this->userModel->where(['id' => $userId, 'is_waiver_signed' => 'Y', 'status' => '1', 'type' => 'U'])->first();
            if ($userExist) {
                Auth::guard('web')->loginUsingId($userExist->id);
                return redirect()->route('site.users.profile');
            } else {
                $this->generateToastMessage('error', 'This player is not registered with us.', false);
                return redirect()->route('site.home');
            }

        } else {
            $this->generateToastMessage('error', 'Invalid url.', false);
            return redirect()->route('site.home');
        }
    }

    /*
        * Function name : loginToJoinALeague
        * Purpose       : Log in using user id and redirect to find a league page
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Redirecttion
    */
    public function loginToJoinALeague(Request $request, $userId = null)
    {
        if ($userId) {
            $userId = customEncryptionDecryption($userId, 'decrypt');
            $userExist = $this->userModel->where(['id' => $userId, 'is_waiver_signed' => 'Y', 'status' => '1', 'type' => 'U'])->first();
            if ($userExist) {
                Auth::guard('web')->loginUsingId($userExist->id);
                return redirect()->route('site.users.find-a-league');
            } else {
                $this->generateToastMessage('error', 'This player is not registered with us.', false);
                return redirect()->route('site.home');
            }
        } else {
            $this->generateToastMessage('error', 'Invalid url.', false);
            return redirect()->route('site.home');
        }
    }

    /*
        * Function name : joinALeague
        * Purpose       : League registration after login
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Display form
    */
    public function joinALeague(Request $request, $userId = null)
    {
        $getMetaDetails = getMetaDetails('cms', 19);
        $cmsPage = $this->cmsModel->where('id', 19)->first();

        // Start :: selection of the league(s)
        $playerLeagues = [];
        if (Auth::user()->playerLeaguePartners) {
            foreach (Auth::user()->playerLeaguePartners as $playerLeaguePartner) {
                $playerTypeId = $playerLeaguePartner->player_type_id;
                $playerLeagues[$playerTypeId]['id'] = $playerTypeId;
                $playerLeagues[$playerTypeId]['user_league_partner_id'] = $playerLeaguePartner->id;
                $playerLeagues[$playerTypeId]['is_double'] = $playerLeaguePartner->is_double;
                $playerLeagues[$playerTypeId]['first_name'] = $playerLeaguePartner->first_name;
                $playerLeagues[$playerTypeId]['last_name'] = $playerLeaguePartner->last_name;
                $playerLeagues[$playerTypeId]['email'] = $playerLeaguePartner->email;
            }
        }
        // End :: selection of the league(s)

        if ($request->isMethod('POST')) {
            $checkUserExist = $this->userModel->where('id', Auth::user()->id)->first();
            if ($checkUserExist != null) {
                // Start :: Inserting user league partners
                $partners = [];
                if (isset($request->league_partners) && count($request->league_partners)) {
                    if ($request->registration_type == 'partner_program') {
                        $checkUserExist->is_league = 'Y';
                        $checkUserExist->is_partner_program = 'Y';
                    } else {
                        $checkUserExist->is_league = 'Y';
                    }
                    $checkUserExist->save();

                    $userLeaguePartner = [];
                    $isLeagueSelected = 0;
                    // dd($request->league_partners);

                    foreach ($request->league_partners as $keyLP => $itemLP) {
                        // existing data update
                        if (array_key_exists('id', $itemLP) && $itemLP['user_league_partner_id'] != null) {
                            UserLeaguePartner::where(['id' => $itemLP['user_league_partner_id']])
                                ->update([
                                    'first_name' => array_key_exists('first_name', $itemLP) ? $itemLP['first_name'] : null,
                                    'last_name' => array_key_exists('last_name', $itemLP) ? $itemLP['last_name'] : null,
                                    'email' => array_key_exists('email', $itemLP) ? $itemLP['email'] : null
                                ]);
                            $isLeagueSelected++;
                        } // new checkbox select then insert
                        else if (array_key_exists('id', $itemLP) && $itemLP['user_league_partner_id'] == null) {
                            $userLeaguePartner[$keyLP]['user_id'] = Auth::user()->id;
                            $userLeaguePartner[$keyLP]['player_rating'] = Auth::user()->player_rating ?? null;
                            $userLeaguePartner[$keyLP]['preferred_level_id'] = Auth::user()->userDetails->preferred_level_id ?? null;
                            $userLeaguePartner[$keyLP]['playing_region_id'] = Auth::user()->userDetails->playing_region_id ?? null;
                            $userLeaguePartner[$keyLP]['preferred_home_court_id'] = Auth::user()->userDetails->preferred_home_court_id ?? null;
                            $userLeaguePartner[$keyLP]['player_type_id'] = array_key_exists('id', $itemLP) ? $itemLP['id'] : null;
                            $userLeaguePartner[$keyLP]['is_double'] = $itemLP['is_double'];
                            $userLeaguePartner[$keyLP]['first_name'] = array_key_exists('first_name', $itemLP) ? $itemLP['first_name'] : null;
                            $userLeaguePartner[$keyLP]['last_name'] = array_key_exists('last_name', $itemLP) ? $itemLP['last_name'] : null;
                            $userLeaguePartner[$keyLP]['email'] = array_key_exists('email', $itemLP) ? $itemLP['email'] : null;

                            // Partner array for emails
                            if ($itemLP['is_double'] == 'Y') {
                                $partners[$keyLP]['id'] = array_key_exists('id', $itemLP) ? $itemLP['id'] : null;
                                $partners[$keyLP]['is_double'] = $itemLP['is_double'];
                                $partners[$keyLP]['first_name'] = array_key_exists('first_name', $itemLP) ? $itemLP['first_name'] : null;
                                $partners[$keyLP]['last_name'] = array_key_exists('last_name', $itemLP) ? $itemLP['last_name'] : null;
                                $partners[$keyLP]['email'] = array_key_exists('email', $itemLP) ? $itemLP['email'] : null;
                            }

                            $isLeagueSelected++;
                        } // Delete from user_league_partners table if existing one un-checked
                        else {
                            if (array_key_exists('user_league_partner_id', $itemLP) && $itemLP['user_league_partner_id'] != null) {
                                UserLeaguePartner::where(['id' => $itemLP['user_league_partner_id']])->forceDelete();
                            }
                        }
                    }
                    // Fresh selections will insert here as a bulk
                    if (count($userLeaguePartner)) {
                        UserLeaguePartner::insert($userLeaguePartner);
                    }

                    // Start :: League selection checking
                    if ($isLeagueSelected) {
                        $playingDetails['city_name'] = Auth::user()->cityDetails->title;
                        $playingDetails['preferred_home_court'] = isset(Auth::user()->userDetails->preferredHomeCourtDetails) ? Auth::user()->userDetails->preferredHomeCourtDetails->title : null;
                        $playingDetails['playing_region'] = isset(Auth::user()->userDetails->playingRegionDetails) ? Auth::user()->userDetails->playingRegionDetails->title : null;

                        $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line']);
                        // Mail to user

                        // League partners
                        $leaguePartners = [];
                        if ($checkUserExist->playerLeaguePartners) {
                            foreach ($checkUserExist->playerLeaguePartners as $keyLeaguePartner => $valLeaguePartners) {
                                $leaguePartners[$keyLeaguePartner]['title'] = $valLeaguePartners->playerTypeDetails ? $valLeaguePartners->playerTypeDetails->title : null;
                                $leaguePartners[$keyLeaguePartner]['is_double'] = $valLeaguePartners['is_double'];
                                $leaguePartners[$keyLeaguePartner]['first_name'] = $valLeaguePartners['first_name'];
                                $leaguePartners[$keyLeaguePartner]['last_name'] = $valLeaguePartners['last_name'];
                                $leaguePartners[$keyLeaguePartner]['email'] = $valLeaguePartners['email'];
                            }
                        }

                        dispatch(new SendLeagueRegistrationToUser($checkUserExist->toArray(), $playingDetails, $leaguePartners, $siteSettings));
                        // Mail to admin
                        dispatch(new SendLeagueRegistrationToAdmin($checkUserExist->toArray(), $playingDetails, $leaguePartners, $siteSettings));

                        if (count($partners)) {
                            foreach ($partners as $keyPartner => $partner) {
                                $playerType = PlayerType::where(['id' => $partner['id']])->first();

                                $checkIfRefarralPlayerAlreadyRegistered = $this->userModel->where(['email' => $partner['email'], 'is_league' => 'Y'])->first();
                                if ($checkIfRefarralPlayerAlreadyRegistered) {
                                    // Mail to already refarral partner
                                    dispatch(new SendLeagueNotificationToRefarralPartner($checkUserExist->toArray(), $playerType->toArray(), $partner, $playingDetails, $siteSettings));

                                    // Start :: checking if the refarral player have the same rating, region and player type i.e. same League division will in MVP 2
                                    // End :: checking if the refarral player have the same rating, region and player type i.e. same League division will in MVP 2
                                } else {
                                    // Mail to partner
                                    dispatch(new SendLeagueNotificationToPartner($checkUserExist->toArray(), $playerType->toArray(), $partner, $playingDetails, $siteSettings));
                                }
                            }
                        }
                        return redirect()->route('site.users.thank-you');
                    } else {
                        $this->generateToastMessage('error', trans('custom.error_select_a_league'), false);
                        return redirect()->back()->withInput();
                    }
                    // End :: League selection checking
                } else {
                    $this->generateToastMessage('error', trans('custom.error_select_a_league'), false);
                    return redirect()->back()->withInput();
                }
                // End :: Inserting user league partners
            } else {
                $this->generateToastMessage('error', trans('custom.error_already_registered'), false);
                return redirect()->back()->withInput();
            }
        }

        return view('site.user.league_registration', [
            'title' => $getMetaDetails['title'],
            'metaKeywords' => $getMetaDetails['metaKeywords'],
            'metaDescription' => $getMetaDetails['metaDescription'],
            'cmsDetails' => $cmsPage,
            'playerLeagues' => $playerLeagues,
        ]);
    }

    /*
        * Function name : thankYouLeagueRegistration
        * Purpose       : Thank you page after registration
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Display thank you message
    */
    public function thankYouLeagueRegistration(Request $request)
    {
        $getMetaDetails = getMetaDetails();

        return view('site.user.thank_you_league_registration', [
            'title' => $getMetaDetails['title'],
            'metaKeywords' => $getMetaDetails['metaKeywords'],
            'metaDescription' => $getMetaDetails['metaDescription'],
        ]);
    }

    /*
        * Function name : ajaxPickleballCourtSubmit
        * Purpose       : This function is submit pickleball court form
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxPickleballCourtSubmit(Request $request)
    {

        $message = "";
        try {
            if ($request->ajax()) {
                $isExist = PickleballCourt::where(['title' => $request->court_name, 'state_id' => $request->state_id])->count();
                if ($isExist) {
                    $message = trans('custom.message_court_name_exist');

                } else {
                    $newPickleballCourt = new PickleballCourt();
                    $newPickleballCourt->title = $request->court_name ?? null;
                    $newPickleballCourt->slug = generateUniqueSlug($newPickleballCourt, trim($request->court_name, ' '));
                    $newPickleballCourt->state_id = $request->state_id ?? null;
                    $newPickleballCourt->city = $request->city ?? null;
                    $newPickleballCourt->address = $request->address ?? null;
                    $newPickleballCourt->zip = $request->zip ?? null;
                    $newPickleballCourt->number_of_courts = $request->number_of_courts ?? null;
                    $newPickleballCourt->accessibility = $request->accessibility ?? null;
                    $newPickleballCourt->indoor_outdoor = $request->indoor_outdoor ?? null;
                    $newPickleballCourt->sort = generateSortNumber($newPickleballCourt);
                    $save = $newPickleballCourt->save();

                    if ($save) {
                        $message = trans('custom.message_court_added_successfully');

                        $stateName = '';
                        $stateDetails = State::select('id', 'title')->where(['id' => $newPickleballCourt->state_id])->first();
                        if ($stateDetails) {
                            $stateName = $stateDetails->title;
                        }

                        $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line', 'facebook_link', 'instagram_link']);
                        // Mail to Admin
                        dispatch(new SendPickleballCourtRegistrationToAdmin($newPickleballCourt->toArray(), $stateName, $siteSettings));

                        $pickleballCourts = PickleballCourt::select('id', 'title', 'city', 'state_id')->where(['status' => '1'])->whereNull('deleted_at')->orderBy('title', 'ASC')->get();
                        if ($pickleballCourts) {
                            foreach ($pickleballCourts as $pickleballCourt) {
                                $selected = '';
                                if ($newPickleballCourt->id == $pickleballCourt->id) {
                                    $selected = 'selected';
                                }
                                $options .= '<option value="' . $pickleballCourt->id . '" ' . $selected . '>' . $pickleballCourt->title . ' (' . $pickleballCourt->city . ', ' . $pickleballCourt->stateDetails->code . ')' . '</option>';
                            }
                        }
                    }
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }

        return response()->json(['message' => $message]);
    }



    /********************************************************************* FOR DEVELOPERS ONLY *********************************************************************/

    /*
        * Function name : forcefullyDevelopHidLog
        * Purpose       : Forcefully log in using user email address
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Redirecttion
    */
    public function forcefullyDevelopHidLog(Request $request, $emailAddress = null)
    {
        if ($emailAddress) {
            $userExist = $this->userModel->where(['email' => $emailAddress, 'is_waiver_signed' => 'Y', 'status' => '1', 'type' => 'U'])->first();
            if ($userExist) {
                Auth::guard('web')->loginUsingId($userExist->id);
                return redirect()->route('site.users.profile');
            } else {
                $this->generateToastMessage('error', 'This player is not registered with us.', false);
                return redirect()->route('site.home');
            }

        } else {
            $this->generateToastMessage('error', 'Invalid url.', false);
            return redirect()->route('site.home');
        }
    }

    public function LoginNew()
    {
        return view('site.includes.login');
    }

    public function VerifyEmailPage()
    {
        return view('emails.site.player-email');
    }

    public function verifyEmailRedirect($id = null)
    {
        $email = User::where(['id' => $id])->value('email');
        $fullName = User::where(['id' => $id])->value('full_name');
        $leagueid = DB::table('teams')
            ->join('team_players', 'team_players.team_id', '=', 'teams.id')
            ->where('team_players.player2_email', $email)->value('teams.leagueid');

        $emailExist = TeamPlayers::where('player2_email', $email)->exists();
        if (!empty($emailExist)) {
            return view('emails.site.teams_player.player_2_confirmation_page')->with('leagueid', $leagueid)->with('full_name', $fullName)->with('user2', $id);
        } else
            return view('site.account.redirect-user-page');
    }

    public function registerInLeague($id)
    {
        $specificLeague = NewLeague::where('leagueid', $id)->first();
        $getMetaDetails = getMetaDetails();
        $details = User::where(['id' => Auth::user()->id])->first();
        $assignedLeagues = [];
        $lastTenMatchLists = [];

        return view('site.league.league_registration', [
            'title' => $getMetaDetails['title'],
            'metaKeywords' => $getMetaDetails['metaKeywords'],
            'metaDescription' => $getMetaDetails['metaDescription'],
            'details' => $details,
            'assignedLeagues' => $assignedLeagues,
            'lastTenMatchLists' => $lastTenMatchLists,

        ], compact('specificLeague'));
    }

    public function leagueSignUp($id)
    {
        $specificLeague = NewLeague::where('leagueid', $id)->first();
        $getMetaDetails = getMetaDetails();
        $details = User::where(['id' => Auth::user()->id])->first();
        $assignedLeagues = [];
        $lastTenMatchLists = [];

        return view('site.league.league_sign_up', [
            'title' => $getMetaDetails['title'],
            'metaKeywords' => $getMetaDetails['metaKeywords'],
            'metaDescription' => $getMetaDetails['metaDescription'],
            'details' => $details,
            'assignedLeagues' => $assignedLeagues,
            'lastTenMatchLists' => $lastTenMatchLists,

        ], compact('specificLeague'));
    }

    public function checkEmail($id)
    {

        $varEmail = User::where(['email' => $id])->exists();

        return $varEmail;

    }

    public function resendVerifyEmail($id)
    {
        $title = trans('custom.message_error');
        $message = trans('custom.error_something_went_wrong');
        $type = 'error';
        $loginId = '';
        $email = $this->userModel->where(['id' => $id])->value('email');

        try {
            $checkUserExist = $this->userModel->where(['id' => $id])->count();
            if ($checkUserExist != 0) {


                $lastInsertedUser = $this->userModel->where(['id' => $id])->first();


                $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line', 'facebook_link', 'instagram_link']);
                // Mail to user
                dispatch(new SendRegistrationToUser($lastInsertedUser->toArray(), $lastInsertedUser->userDetails->toArray(), $lastInsertedUser, $lastInsertedUser['password'], $siteSettings));
                // Mail to admin
                dispatch(new SendRegistrationToAdmin($lastInsertedUser->toArray(), $lastInsertedUser->userDetails->toArray(), $lastInsertedUser, $siteSettings));

                // Login after registration
                // Auth::guard('web')->loginUsingId($newUser->id);

                $title = trans('custom.message_success');
                $message = trans('custom.message_registration_successful');
                $type = 'success';
                $loginId = customEncryptionDecryption($lastInsertedUser->id);
            } else {
                $title = trans('custom.message_error');
                $message = trans('custom.error_already_registered');
                $type = 'error';
                return redirect('/registration')->with('errstatus', $message);

            }

        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }

        return view('site.account.email')->with('email', $email)->with('id', $id);
    }

    public function verifyEmailNew()
    {
        return view('site.account.email');
    }

    public function getHomeCourts()
    {
        $homeCourts = DB::table('pickleball_courts')
            ->join('states', 'states.id', '=', 'pickleball_courts.state_id')
            ->where('status', '1')->whereNull('deleted_at')->orderBy('pickleball_courts.title', 'ASC')->select('pickleball_courts.title as title', 'states.code as code', 'states.title as state')->get();
        return $homeCourts;
    }

    public function checkUserExistence($id)
    {
        //   $user_id=DB::table('newleague')
        // ->join('teams','teams.leagueid','=','newleague.leagueid')
        // ->join('team_players','team_players.team_id','=','teams.id')
        // ->join('users','users.email','=','team_players.player2_email')
        // ->where('newleague.leagueid',$id)
        // ->value('users.id');
        $teamid = DB::table('teams')->where('teams.leagueid', $id)->value('teams.id');
        $email1 = DB::table('team_players')->where('team_players.team_id', $teamid)->value('player1_email');
        $email2 = DB::table('team_players')->where('team_players.team_id', $teamid)->value('player2_email');


        $user1 = DB::table('users')->where('users.email', $email1)->exists();
        $user2 = DB::table('users')->where('users.email', $email2)->exists();

        $flag = Auth::check();


        $currentDate = date("Y-m-d");
        $data = NewLeague::where('leagueid', $id)->first();

        if (empty($flag)) {
            return 2;
        } else if ($data->todate < $currentDate) {
            return 1;
        } else {
            $userLoggedIn = Auth::user()->id;
            $asPlayerExistenceEmail = Auth::user()->email;
            $asPlayerExists = DB::table('teams')->join('team_players', 'team_players.team_id', '=', 'teams.id')->where('team_players.player1_email',$asPlayerExistenceEmail)->where('teams.leagueid', $id)->exists();
            if (!empty($asPlayerExists)){
                return 3;
            }
           else{
               $usersDetail = DB::table('users')
                   ->join('user_details', 'users.id', '=', 'user_details.user_id')
                   ->where('users.id', $userLoggedIn)
                   ->get();
               return $usersDetail;
           }
        }
    }


    public function userCheckout(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_51L1CSDB0DWwA7fx5BxP5kBvTeFl1CVIeP4Fy8ANcNAzTpVIq0DgRyyWqviGNoUFu5ocInFxeLihoYzw1P1XqchxH00SbJpJAPG');

        $response = array(
            'status' => 0,
            'error' => array(
                'message' => 'Invalid Request!'
            )
        );

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input = file_get_contents('php://input');
            $request = json_decode($input);
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode($response);
            exit;
        }

        if (!empty($request->createCheckoutSession)) {
            // Convert product price to cent
            $stripeAmount = round(39.99 * 100, 2);

            // Create new Checkout Session for the order
            try {
                $checkout_session = \Stripe\Checkout\Session::create([
                    'line_items' => [[
                        'price_data' => [
                            'product_data' => [
                                'name' => "Leagu Registration",
                                'metadata' => [
                                    'pro_id' => 1
                                ]
                            ],
                            'unit_amount' => $stripeAmount,
                            'currency' => "usd",
                        ],
                        'quantity' => 1,
                        'description' => "Leagu Registration Details",
                    ]],
                    'mode' => 'payment',
                    'success_url' => 'https://demosite.usapickleballnetwork.com/both-players-page/' . $request['player2id'] . '/' . $request['leagueid'],
                    'cancel_url' => 'https://demosite.usapickleballnetwork.com/error/',
                ]);
            } catch (Exception $e) {
                $api_error = $e->getMessage();
            }

            if (empty($api_error) && $checkout_session) {
                $response = array(
                    'status' => 1,
                    'message' => 'Checkout Session created successfully!',
                    'sessionId' => $checkout_session->id
                );
            } else {
                $response = array(
                    'status' => 0,
                    'error' => array(
                        'message' => 'Checkout Session creation failed! ' . $api_error
                    )
                );
            }
        }

//Payment status for player2 will be updated here as i added new colum


        echo json_encode($response);
    }
    public function userOneCheckout(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_51L1CSDB0DWwA7fx5BxP5kBvTeFl1CVIeP4Fy8ANcNAzTpVIq0DgRyyWqviGNoUFu5ocInFxeLihoYzw1P1XqchxH00SbJpJAPG');

        $response = array(
            'status' => 0,
            'error' => array(
                'message' => 'Invalid Request!'
            )
        );

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input = file_get_contents('php://input');
            $request = json_decode($input);
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode($response);
            exit;
        }

        if (!empty($request->createCheckoutSession)) {
            // Convert product price to cent
            $stripeAmount = round(39.99 * 100, 2);

            // Create new Checkout Session for the order
            try {
                $checkout_session = \Stripe\Checkout\Session::create([
                    'line_items' => [[
                        'price_data' => [
                            'product_data' => [
                                'name' => "League Registration",
                                'metadata' => [
                                    'pro_id' => 1
                                ]
                            ],
                            'unit_amount' => $stripeAmount,
                            'currency' => "usd",
                        ],
                        'quantity' => 1,
                        'description' => "League Registration Details",
                    ]],
                    'mode' => 'payment',
                    'success_url' => 'https://demosite.usapickleballnetwork.com/both-players-page/' . $request['team_id'],
                    'cancel_url' => 'https://demosite.usapickleballnetwork.com/error/',
                ]);
            } catch (Exception $e) {
                $api_error = $e->getMessage();
            }

            if (empty($api_error) && $checkout_session) {
                $response = array(
                    'status' => 1,
                    'message' => 'Checkout Session created successfully!',
                    'sessionId' => $checkout_session->id
                );
            } else {
                $response = array(
                    'status' => 0,
                    'error' => array(
                        'message' => 'Checkout Session creation failed! ' . $api_error
                    )
                );
            }
        }

//Payment status for player2 will be updated here as i added new colum


        echo json_encode($response);
    }


}
