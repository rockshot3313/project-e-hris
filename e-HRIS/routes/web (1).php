<?php

use App\Http\Controllers\__Payroll\PayrollController as __PayrollPayrollController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Leave\LeaveController;
use App\Http\Controllers\analytic\AnalyticsController;
use App\Http\Controllers\ApplicationController\ApplicationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentPreviewController;
use App\Http\Controllers\DocumentTrashController;
use App\Http\Controllers\ForwardDocsController;
use App\Http\Controllers\HoldController;
use App\Http\Controllers\IncomingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OutgoingController;
use App\Http\Controllers\PrintQRController;
use App\Http\Controllers\ProfileController\ProfileController;
use App\Http\Controllers\PublicFilesController;
use App\Http\Controllers\ReceiveController;
use App\Http\Controllers\ReturnedController;
use App\Http\Controllers\ScannerController;
use App\Http\Controllers\Schedule\ScheduleController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\RR\AwardsController;
use App\Http\Controllers\RR\RewardController;
use App\Http\Controllers\RR\EventsController;
use App\Http\Controllers\competency\CompetencyController;
use App\Http\Controllers\dtr\DTRController;
use App\Http\Controllers\Hiring\Hiring_Controller;
use App\Http\Controllers\Hiring\Position_Hiring_Controller;
use App\Http\Controllers\Hiring\Short_listed;
use App\Http\Controllers\Interview\CriteriaController;
use App\Http\Controllers\Payroll\HolidayController;
use App\Http\Controllers\Testing\testingContoller;
use App\Http\Controllers\ratingController\ratingContoller;
use App\Http\Controllers\Saln\SalnController;
use App\Http\Controllers\TravelOrder\TravelOrderController;
use App\Http\Middleware\handleUserPriv;
use App\Http\Middleware\updateProfile;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payroll\OvertimeController;
use App\Http\Controllers\Payroll\NightDiffController;
use App\Http\Controllers\Payroll\PayrollController;
use App\Http\Controllers\system\SettingController;
use Sabberworm\CSS\Settings;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('user.ScheduleofActivities');
});

Route::post('/public-files', [PublicFilesController::class, 'load_publicFiles']);
Route::post('/docs-view/load', [PublicFilesController::class, 'docView']);
Route::post('/docs-details/load', [PublicFilesController::class, 'docDetails']);
Route::post('/count/docs/view', [PublicFilesController::class, 'count_doc_view']);

Auth::routes();

Route::post('post-login', [App\Http\Controllers\Auth\AuthController::class, 'postLogin'])->name('post-login');
Route::post('admin/manage/check/account/notif', [AdminController::class, 'admin_manage_check_account_notif']);
Route::get('admin/manage/check/account/notif', [AdminController::class, 'admin_manage_check_account_notif']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/getnotif', [App\Http\Controllers\CommonController::class, 'GetNotificationData']);
Route::get('/notification/core/create', [App\Http\Controllers\NotificationController::class, 'notification_create']);
Route::get('/notification/core/load', [App\Http\Controllers\NotificationController::class, 'notification_load']);
Route::post('/incoming-update-notification', [NotificationController::class, 'update_incoming_notif']);
Route::post('/notification/details/load', [NotificationController::class, 'notification_details_load']);
Route::post('/notification/clear/all', [NotificationController::class, 'clear_all_notif']);



Route::prefix("admin")->group(function(){

    //rc
    Route::get('/rc', [AdminController::class, 'rescen'])->name('rc')->middleware(handleUserPriv::class);
    Route::post('/rc/add/members', [AdminController::class, 'add_rcmembers']);
    Route::post('/rc/load/members', [AdminController::class, 'load_rcmembers']);
    Route::post('/rc/load', [AdminController::class, 'load_rc']);
    Route::post('/rc/member/remove', [AdminController::class, 'rc_remove_member_group']);

    //groups
    Route::get('/group', [AdminController::class, 'group'])->name('group')->middleware(handleUserPriv::class);
    Route::post('/group/load', [AdminController::class, 'load_group']);
    Route::post('/group/add', [AdminController::class, 'create_group']);
    Route::post('/group/load/members', [AdminController::class, 'load_groupmembers']);
    Route::post('/group/add/update/members', [AdminController::class, 'add_update_groupmembers']);
    Route::post('/group/remove', [AdminController::class, 'remove_group']);
    Route::post('/group/member/remove', [AdminController::class, 'group_remove_member_group']);
    //user privs
    Route::get('/user-privileges', [AdminController::class, 'user_privileges'])->name('user_privileges')->middleware(handleUserPriv::class);
    Route::post('/user/load', [AdminController::class, 'load_employee']);
    Route::get('/user/load', [AdminController::class, 'load_employee']);
    Route::get('/user/priv/load', [AdminController::class, 'load_user_priv']);
    Route::post('/user/priv/load', [AdminController::class, 'load_user_priv']);
    Route::post('/user/priv/update', [AdminController::class, 'update_user_priv']);


    Route::post('/user/priv/update/reload', [AdminController::class, 'update_user_priv_reload']);
    Route::get('/user/priv/update/reload', [AdminController::class, 'update_user_priv_reload']);


    //Link List
    Route::get('/link-list', [AdminController::class, 'link_lists'])->name('link_lists');
    Route::post('/get-list', [AdminController::class, 'get_link_list']);
    Route::post('/update-list', [AdminController::class, 'update_link_list']);


    //Account Management
    Route::get('/ac', [AdminController::class, 'acmn'])->name('ac')->middleware(handleUserPriv::class);
    Route::post('/manage/user/load/id', [AdminController::class, 'load_user_id']);
    Route::get('/manage/user/load/id', [AdminController::class, 'load_user_id']);
    Route::post('/manage/user/load', [AdminController::class, 'load_accounts']);
    Route::get('/manage/sync/account/profile/employee', [AdminController::class, 'sync_data_account_profile_employee']);
    Route::post('/manage/sync/account/profile/employee', [AdminController::class, 'sync_data_account_profile_employee']);
    Route::post('/manage/load/edit/account/id', [AdminController::class, 'manage_load_edit_account_id']);
    Route::post('/manage/load/edit/profile/id', [AdminController::class, 'manage_load_edit_profile_id']);
    Route::post('/manage/load/edit/employee/id', [AdminController::class, 'manage_load_edit_employee_id']);

    Route::get('/manage/sync/account/profile/employee/temp', [AdminController::class, 'sync_data_account_profile_employee_temp']);
    Route::post('/manage/sync/account/profile/employee/temp', [AdminController::class, 'sync_data_account_profile_employee_temp']);


    Route::post('/manage/load/save/account', [AdminController::class, 'manage_load_save_account']);
    Route::post('/manage/load/save/profile', [AdminController::class, 'manage_load_save_profile']);
    Route::post('/manage/load/save/employee', [AdminController::class, 'manage_load_save_employee']);
    Route::post('/manage/load/priv/notif', [AdminController::class, 'manage_load_priv_notif']);


    //System Settings
    Route::get('/ss', [SettingController::class, 'system_setting'])->name('ss')->middleware(handleUserPriv::class);
    Route::post('/add/setting', [SettingController::class, 'add_setting'])->name('add_setting');
    Route::post('/load/system/settings', [SettingController::class, 'load_system_setting']);
    Route::post('/remove/ss', [SettingController::class, 'remove_ss']);
    Route::post('/load/ss/details', [SettingController::class, 'load_details']);

    Route::post('/temp/system/image/upload', [SettingController::class, '_tmp_system_Upload']);
    Route::delete('/temp/delete', [SettingController::class, '_tmp_system_Delete' ]);

});

Route::get('logout', [App\Http\Controllers\OneLogin\OneLoginController::class, 'logout']);

Route::prefix("onelogin")->group(function(){
    Route::get('/settings/get', [App\Http\Controllers\OneLogin\OneLoginController::class, 'get_settings'])->middleware(handleUserPriv::class);
    Route::post('/settings/get', [App\Http\Controllers\OneLogin\OneLoginController::class, 'get_settings']);
    Route::get('/login/post/check', [App\Http\Controllers\OneLogin\OneLoginController::class, 'post_login_check']);
    Route::post('/login/save', [App\Http\Controllers\OneLogin\OneLoginController::class, 'save_login']);
});

Route::prefix("hiring")->group(function(){

    Route::get('/hire-position',[Position_Hiring_Controller::class, 'index'])->name('index')->middleware(handleUserPriv::class);
    //save the position hiring data
    Route::post('/save-position',[Position_Hiring_Controller::class,'position_hiring']);
    //get the monthly salary
    Route::post('/get-salaries',[Position_Hiring_Controller::class, 'get_monthly_salaries']);
    //load all the position hiring in the data table
    Route::get('/load-position',[Position_Hiring_Controller::class, 'load_hiring_data'])->name('load_data');
    //get the different panels
    Route::get('/get-panel',[Position_Hiring_Controller::class, 'get_panels']);
    //get the competency
    Route::get('/get-competency',[Position_Hiring_Controller::class, 'get_competencies']);
    //update the data
    Route::post('/update-hiring-position',[Position_Hiring_Controller::class,'update_data']);
    //delete the data change the active state
    Route::post('/delete-position-hiring',[Position_Hiring_Controller::class, 'delete_data']);
    //change the status of the hiring position
    Route::post('/delete-hiring-status',[Position_Hiring_Controller::class, 'change_status']);
    //print the file
    Route::get('/print-position-hiring/{id}',[Position_Hiring_Controller::class, 'print_pdf']);

    //applicant short listed
    Route::get('/applicant-short-listed',[Short_listed::class, 'short_listed_index'])->name('short_index');
    Route::get('/short-listed-list',[Short_listed::class,'short_listed_applicant']);
    Route::post('/get-applicant-position',[Short_listed::class, 'get_applicants_details']);
    Route::post('/applicant-rating-sched',[Short_listed::class, 'appoint_sched']);
    Route::post('/update-applicant-status',[Short_listed::class, 'update_stat']);
    //update the shorlisted applicant
    Route::post('/update-shortlisted-applicant',[Short_listed::class, 'update_shortlisted_applicant']);

    //position type Page
    Route::get('/position-type',[Hiring_Controller::class,'positionType_page']);
    Route::post('/save-update/positoin-type',[Hiring_Controller::class,'save_update_positionType']);
    Route::get('/fetched/position-type',[Hiring_Controller::class,'fetchedPosition_type']);
    Route::post('/delete-position-category',[Hiring_Controller::class,'deletePosition_category']);

    //Added by Montz
    Route::post('/load/job/document/requirements',[Position_Hiring_Controller::class,'load_job_doc_requirements']);
    Route::post('/delete/job/document/requirements',[Position_Hiring_Controller::class,'delete_job_doc_requirements']);
});


Route::prefix('application')->group(function (){

    //Application Form
    Route::get('/form', [ApplicationController::class,'application'])->name('application');
    Route::post('/apply', [ApplicationController::class, 'apply_job']);
    Route::post('/submit/attachments', [ApplicationController::class, 'submit_application']);

    //Application List
    Route::get('/list', [ApplicationController::class,'applicant_list'])->name('applicant_list')->middleware('auth', handleUserPriv::class);
    Route::post('/get/applicants', [ApplicationController::class, 'load_applicants'])->middleware('auth');

    Route::post('/get/applicant/profile', [ApplicationController::class, 'get_applicant_profile']);
    Route::post('/get/job/attachments', [ApplicationController::class, 'get_job_attachments']);
    Route::get('/view/attachments/{path}', [ApplicationController::class, 'view_attachments']);
    Route::get('/download/attachments/{path}', [ApplicationController::class, 'download_attachments']);

    Route::post('/approve', [ApplicationController::class, 'approve_application']);
    Route::post('/disapprove', [ApplicationController::class, 'disapprove_application']);
    Route::post('/get/application/data', [ApplicationController::class, 'get_application_data']);

    //TOR Upload
    Route::post('/temp/tor/upload', [ApplicationController::class, '_tmp_Upload']);
    Route::delete('/temp/delete', [ApplicationController::class, '_tmp_Delete' ]);

    //Diploma Upload
    Route::post('/temp/diploma/upload', [ApplicationController::class, '_tmp_diploma_Upload']);

    //Certificate Upload
    Route::post('/temp/certificate/upload', [ApplicationController::class, '_tmp_certificate_Upload']);

    //Load all Address
    Route::post('/get/address/region', [ApplicationController::class, 'get_address_via_region']);
    Route::post('/get/address/province', [ApplicationController::class, 'get_address_via_province']);
    Route::post('/get/address/municipality', [ApplicationController::class, 'get_address_via_municipality']);

    //Load available Positions
    Route::post('/get/available/positions', [ApplicationController::class, 'get_available_positions']);

    //UPLOAD FILE ATTACHMENTS
    Route::post('/tmp/file/upload', [ApplicationController::class, '_tmp_file_upload']);
    Route::delete('/tmp/file/delete', [ApplicationController::class, '_tmp_file_delete' ]);



    Route::post('/tmp/pds/upload', [ApplicationController::class, '_tmp_Upload_pds']);
    Route::post('/tmp/prs/upload', [ApplicationController::class, '_tmp_Upload_prs']);
    Route::post('/tmp/cs/upload', [ApplicationController::class, '_tmp_Upload_cs']);
    Route::post('/tmp/tor/upload', [ApplicationController::class, '_tmp_Upload_tor']);

    //DELETE FILE ATTACHMENTS
    Route::delete('/tmp/delete/applicants/files', [ApplicationController::class, '_tmp_Delete_applicant_files' ]);

});

Route::prefix("my")->group(function (){

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/load/profile', [ProfileController::class, 'load_profile']);

    //Profile Picture Upload
//    Route::post('/temp/profile/upload', [ApplicationController::class, '_tmp_profile_pic_Upload']);
    Route::post('/temp/profile/upload', [ProfileController::class, 'temp_upload_profile_picture']);
    Route::post('/save/profile/picture', [ProfileController::class, 'save_profile_picture']);

    //DELETE Profile Picture
    Route::delete('/temp/profile/delete', [ProfileController::class, 'delete_profile_picture']);


    Route::post('/load/personal/information', [ProfileController::class, 'load_personal_information']);
    Route::post('/load/educational/background', [ProfileController::class, 'load_educ_bg']);
    Route::post('/add/educational/background', [ProfileController::class, 'add_educ_bg']);
    Route::post('/remove/educational/background', [ProfileController::class, 'remove_educ_bg']);

    Route::post('/load/residential/address', [ProfileController::class, 'load_residential_address']);
    Route::post('/load/permanent/address', [ProfileController::class, 'load_permanent_address']);

    Route::post('/load/family/background', [ProfileController::class, 'get_family_bg']);
    Route::post('/load/civil/service/eligibility', [ProfileController::class, 'load_civil_service_eligibility']);
    Route::post('/update/academic/background', [ProfileController::class, 'update_academic_bg']);

    Route::post('/remove/child/family/background', [ProfileController::class, 'remove_child_family_bg']);
    Route::post('/remove/academic/background', [ProfileController::class, 'remove_academic_bg']);

    Route::post('/update/cs/eligibility', [ProfileController::class, 'update_cs_eligibility']);
    Route::post('/remove/cs', [ProfileController::class, 'remove_cs']);

    Route::post('/load/work/experience', [ProfileController::class, 'load_work_experience']);
    Route::post('/update/work/exp', [ProfileController::class, 'update_work_experience']);
    Route::post('/remove/work/exp', [ProfileController::class, 'remove_work_exp']);

    Route::post('/load/voluntary/work', [ProfileController::class, 'load_voluntary_work']);
    Route::post('/update/voluntary/work', [ProfileController::class, 'update_vol_work']);
    Route::post('/remove/voluntary/work', [ProfileController::class, 'remove_voluntary_work']);

    Route::post('/load/learning/development', [ProfileController::class, 'load_learning_development']);
    Route::post('/remove/learning/development', [ProfileController::class, 'remove_learning_development']);

    Route::post('/load/special/skills', [ProfileController::class, 'load_special_skills']);
    Route::post('/remove/special/skills', [ProfileController::class, 'remove_special_skills']);

    Route::post('/load/other/information', [ProfileController::class, 'load_other_information']);
    Route::post('/load/reference/info', [ProfileController::class, 'load_reference_info']);
    Route::post('/remove/references', [ProfileController::class, 'remove_references']);

    Route::post('/load/government/id', [ProfileController::class, 'load_government_id']);

    Route::post('/save/pds', [ProfileController::class, 'save_pds']);

    Route::get('/print/pds/{user_id}', [ProfileController::class, 'print_pds']);

    Route::post('/get/ref/brgy', [ProfileController::class, 'get_ref_brgy']);


});

Route::prefix('schedule')->group(function (){

    Route::get('/', [ScheduleController::class,'index'])->name('schedule')->middleware(handleUserPriv::class);

});



Route::prefix("rr")->group(function(){
    Route::get('/overview', [RewardController::class, 'load_view'])->name('rr_rewards');
    Route::post('/data/load', [RewardController::class, 'load_data']);

    Route::get('/awards', [AwardsController::class, 'awards_load_view'])->name('rr_awards');
    Route::get('/awards/data/get', [AwardsController::class, 'awards_data_get']);
    Route::post('/awards/data/get', [AwardsController::class, 'awards_data_get']);
    Route::get('/awards/data/info', [AwardsController::class, 'awards_data_info']);
    Route::post('/awards/data/info', [AwardsController::class, 'awards_data_info']);
    Route::post('/awards/data/add', [AwardsController::class, 'awards_data_add']);
    Route::post('/awards/data/update', [AwardsController::class, 'awards_data_update']);
    Route::post('/awards/data/delete', [AwardsController::class, 'awards_data_delete']);
    Route::get('/awards/option/types/get', [AwardsController::class, 'awards_option_awards_type_get']);
    Route::post('/awards/option/types/get', [AwardsController::class, 'awards_option_awards_type_get']);

    Route::get('/events', [EventsController::class, 'events_load_view'])->name('rr_events');
    Route::get('/events/data/get', [EventsController::class, 'events_data_get']);
    Route::post('/events/data/get', [EventsController::class, 'events_data_get']);
    Route::get('/events/data/info', [EventsController::class, 'events_data_info']);
    Route::post('/events/data/info', [EventsController::class, 'events_data_info']);
    Route::post('/events/data/add', [EventsController::class, 'events_data_add']);
    Route::post('/events/data/update', [EventsController::class, 'events_data_update']);
    Route::post('/events/data/delete', [EventsController::class, 'events_data_delete']);
});

//Payroll
Route::prefix("payroll")->group(function(){
    Route::get('/overtime', [OvertimeController::class, 'index'])->name('overtime_setup');
    Route::post('/overtime/loadsetup', [OvertimeController::class, 'loadsetup'])->name('overtime_setup_load');

    Route::get('/nightdiff', [NightDiffController::class, 'index'])->name('nightdiff_setup');
    Route::post('/nightdiff/loadsetup', [NightDiffController::class, 'loadsetup'])->name('nightdiff_setup_load');

    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll_index');
    Route::post('/payroll/load', [PayrollController::class, 'loadpayroll'])->name('payroll_load');


    //Created by Ladbu

    Route::get('/holiday', [HolidayController::class, 'index'])->name('holiday_setup');
});

Route::prefix("competency")->group(function(){
    Route::get('/overview', [CompetencyController::class, 'load_view'])->name('competency');
    Route::post('/data/load', [CompetencyController::class, 'load_data']);

    Route::get('/skills', [CompetencyController::class, 'skills_load_view'])->name('competency_skills');
    Route::get('/skills/data/get', [CompetencyController::class, 'skills_data_get']);
    Route::post('/skills/data/get', [CompetencyController::class, 'skills_data_get']);
    Route::get('/skills/data/info', [CompetencyController::class, 'skills_data_info']);
    Route::post('/skills/data/info', [CompetencyController::class, 'skills_data_info']);
    Route::post('/skills/data/add', [CompetencyController::class, 'skills_data_add']);
    Route::post('/skills/data/update', [CompetencyController::class, 'skills_data_update']);
    Route::post('/skills/data/delete', [CompetencyController::class, 'skills_data_delete']);

    Route::get('/dictionary', [CompetencyController::class, 'dictionary_load_view'])->name('competency_dictionary');
    Route::get('/dictionary/data/get', [CompetencyController::class, 'dictionary_data_get']);
    Route::post('/dictionary/data/get', [CompetencyController::class, 'dictionary_data_get']);
    Route::get('/dictionary/data/info', [CompetencyController::class, 'dictionary_data_info']);
    Route::post('/dictionary/data/info', [CompetencyController::class, 'dictionary_data_info']);
    Route::post('/dictionary/data/add', [CompetencyController::class, 'dictionary_data_add']);
    Route::post('/dictionary/data/update', [CompetencyController::class, 'dictionary_data_update']);
    Route::post('/dictionary/data/delete', [CompetencyController::class, 'dictionary_data_delete']);
    Route::get('/dictionary/option/groups/get', [CompetencyController::class, 'dictionary_option_groups_get']);
    Route::post('/dictionary/option/groups/get', [CompetencyController::class, 'dictionary_option_groups_get']);
    Route::get('/dictionary/skills/data/get', [CompetencyController::class, 'dictionary_skills_data_get']);
    Route::post('/dictionary/skills/data/get', [CompetencyController::class, 'dictionary_skills_data_get']);
    Route::post('/dictionary/skills/data/add', [CompetencyController::class, 'dictionary_skills_data_add']);
    Route::post('/dictionary/skills/data/update', [CompetencyController::class, 'dictionary_skills_data_update']);
    Route::post('/dictionary/skills/data/delete', [CompetencyController::class, 'dictionary_skills_data_delete']);
    Route::get('/dictionary/reqs/data/get', [CompetencyController::class, 'dictionary_reqs_data_get']);
    Route::post('/dictionary/reqs/data/get', [CompetencyController::class, 'dictionary_reqs_data_get']);
    Route::post('/dictionary/reqs/data/add', [CompetencyController::class, 'dictionary_reqs_data_add']);
    Route::post('/dictionary/reqs/data/update', [CompetencyController::class, 'dictionary_reqs_data_update']);
    Route::post('/dictionary/reqs/data/delete', [CompetencyController::class, 'dictionary_reqs_data_delete']);

    Route::get('/groups', [CompetencyController::class, 'groups_load_view'])->name('competency_groups');
    Route::get('/groups/data/get', [CompetencyController::class, 'groups_data_get']);
    Route::post('/groups/data/get', [CompetencyController::class, 'groups_data_get']);
    Route::get('/groups/data/info', [CompetencyController::class, 'groups_data_info']);
    Route::post('/groups/data/info', [CompetencyController::class, 'groups_data_info']);
    Route::post('/groups/data/add', [CompetencyController::class, 'groups_data_add']);
    Route::post('/groups/data/update', [CompetencyController::class, 'groups_data_update']);
    Route::post('/groups/data/delete', [CompetencyController::class, 'groups_data_delete']);

});

Route::prefix("dtr")->group(function(){
    Route::get('/overview', [DTRController::class, 'load_view'])->name('dtr');
    Route::post('/data/load', [DTRController::class, 'load_data']);

    Route::get('/manage/bio', [DTRController::class, 'manage_bio_load_view'])->name('dtr_manage_bio');
    Route::get('/manage/bio/data/get', [DTRController::class, 'manage_bio_data_get']);
    Route::post('/manage/bio/data/get', [DTRController::class, 'manage_bio_data_get']);
    Route::get('/manage/bio/data/info', [DTRController::class, 'manage_bio_data_info']);
    Route::post('/manage/bio/data/info', [DTRController::class, 'manage_bio_data_info']);
    Route::post('/manage/bio/data/add', [DTRController::class, 'manage_bio_data_add']);
    Route::post('/manage/bio/data/update', [DTRController::class, 'manage_bio_data_update']);
    Route::post('/manage/bio/data/delete', [DTRController::class, 'manage_bio_data_delete']);
    Route::post('/manage/bio/users/list', [DTRController::class, 'manage_bio_users_list']);
    Route::get('/manage/bio/users/list', [DTRController::class, 'manage_bio_users_list']);
    Route::post('/manage/bio/check/employee', [DTRController::class, 'manage_bio_check_employee']);
    Route::get('/manage/bio/check/employee', [DTRController::class, 'manage_bio_check_employee']);

});

Route::prefix("bioengine")->group(function(){
    Route::get('/settings/get', [App\Http\Controllers\bioengine\BioEngineController::class, 'get_settings']);
    Route::post('/settings/get', [App\Http\Controllers\bioengine\BioEngineController::class, 'get_settings']);

});

Route::prefix("interview")->group(function(){
    Route::get('/criteria', [CriteriaController::class, 'index'])->name('criteria');
    Route::post('/criteria/load', [CriteriaController::class, 'load'])->name('load_criteria');
//    Route::get('/criteria/load', [CriteriaController::class, 'load'])->name('load_criteria');
});

//Employment Testing
Route::prefix("testing")->group(function(){

    Route::get('/page', [testingContoller::class, 'testing_page']);
    Route::get('/test-part', [testingContoller::class, 'testPart']);
    Route::get('/test-question-types', [testingContoller::class, 'testQuestion_types']);
    Route::get('/test-question', [testingContoller::class, 'testQuestion']);
    Route::get('/test-choices', [testingContoller::class, 'testChoise']);

});

//Rating
Route::prefix("rating")->group(function(){
    //Criteria URL view
    Route::get('/criteria-page', [ratingContoller::class, 'criteria_page']);
    Route::get('/fetch-criteria', [ratingContoller::class, 'fetchedCriteria']);
    Route::post('/add-criteria', [ratingContoller::class, 'addCriteria']);
    Route::post('/update-criteria', [ratingContoller::class, 'updateCriteria']);
    Route::post('/delete-criteria', [ratingContoller::class, 'deleteCriteria']);
    // Route::get('/criteria/filter-by-position-type/{id}', [ratingContoller::class, 'filterCriteriaPosition_type']);
    Route::get('/filter-position-applicant/{id}', [ratingContoller::class, 'filterPositionBy_applicant']);

    Route::post('/add-criteria-area', [ratingContoller::class, 'storeArea']);
    Route::get('/show-criteria-areas/{id}', [ratingContoller::class, 'showAreas']);
    Route::get('/delete-criteria-area/{id}', [ratingContoller::class, 'deleteAreas']);

    //Manage Rating URL view
    Route::get('/manage-rating-page', [ratingContoller::class, 'manageRating_page']);
    Route::get('/filter-by-position/{id}', [ratingContoller::class, 'filterByPosition']);
    Route::post('/save-rating', [ratingContoller::class, 'saveRating']);
    Route::get('/show-rate-criteria-area/{id}', [ratingContoller::class, 'showRatingArea']);
    Route::post('/store/rated-areas', [ratingContoller::class, 'storeRated_areas']);
    Route::get('/filter-rated-applicants', [ratingContoller::class, 'filterRatedApplicants']);

    //Summary of rating
    Route::get('/summary', [ratingContoller::class, 'summary_page']);
    Route::get('/print-summary', [ratingContoller::class, 'printSummary']);
    Route::get('/fetched/rated-applicant/{id}', [ratingContoller::class, 'fetched_ratedApplicant']);
    Route::get('/rater-details', [ratingContoller::class, 'rater_details']);
    Route::get('/summary-details', [ratingContoller::class, 'summary_details']);
});





Route::prefix('travel/order')->group(function () {

    Route::get('/', [TravelOrderController::class, 'myto'])->name('myto')->middleware(handleUserPriv::class);
    Route::post('/load/travel/order', [TravelOrderController::class, 'load_travel_order']);
    Route::get('/load/travel/order', [TravelOrderController::class, 'load_travel_order']);
    Route::post('/add/travel/order', [TravelOrderController::class, 'add_travel_order']);
    Route::get('/add/travel/order', [TravelOrderController::class, 'add_travel_order']);
    Route::post('/remove', [TravelOrderController::class, 'remove_to']);
    Route::post('/load/details', [TravelOrderController::class, 'load_details']);
    Route::get('/print/to/{id}/{type}', [TravelOrderController::class, 'print']);

    Route::get('/travelorder-export',[TravelOrderController::class, 'export_travel_order'])->name('export_travel_order');

});

Route::prefix('saln')->group(function () {

    Route::get('/', [SalnController::class, 'mysaln'])->name('mysaln')->middleware(handleUserPriv::class);
    Route::post('/load/saln', [SalnController::class, 'load_saln']);
    Route::get('/load/saln', [SalnController::class, 'load_saln']);
    Route::post('/load/details', [SalnController::class, 'load_details']);
    Route::post('/remove', [SalnController::class, 'remove_saln']);
    Route::post('/remove/data/from/table', [SalnController::class, 'remove_data_from_table']);
    Route::post('/add/saln', [SalnController::class, 'add_saln']);
    Route::get('/add/saln', [SalnController::class, 'add_saln']);
    Route::get('/print/saln/{id}/{type}', [SalnController::class, 'print']);

});

Route::prefix('documents')->group(function (){

    //My-Documents
    Route::get('/my-documents',[DocumentController::class, 'my_documents'])->name('my_documents')->middleware(handleUserPriv::class);
    Route::get('/outgoing',[DocumentController::class, 'outgoing'    ])->name('outgoing');
    Route::get('/returned',[DocumentController::class, 'returned'    ])->name('returned');
    //    Route::post('/docs-details/load', [DocumentController::class, 'docDetails']);
    //    Route::post('/docs-view/load', [DocumentController::class, 'docView']);
    Route::post('/employee-list/load', [DocumentController::class, 'employee_List']);
    Route::post('/created-docs/load', [DocumentController::class, 'created_docs']);
    Route::get('/created-docs/load', [DocumentController::class, 'created_docs']);
    Route::post('/group-list/load', [DocumentController::class, 'group_List']);
    Route::get('/group-list/load', [DocumentController::class, 'group_List']);
    Route::post('/rc-list/load', [DocumentController::class, 'rc_List']);
    Route::post('/docs-insert', [DocumentController::class, 'create_documents']);
    Route::post('/docs-update', [DocumentController::class, 'update_documents']);
    Route::post('/docs-delete', [DocumentController::class, 'delete_documents']);
    Route::post('/tmp-upload', [DocumentController::class, 'tmpUpload'   ])->name('tmpUpload');
    Route::delete('/tmp-delete', [DocumentController::class, 'tmpDelete' ])->name('tmpDelete');
    Route::post('/tmp/attachments/upload', [DocumentController::class, 'attachments_tmpUpload'   ]);
    Route::post('/docs-fast-send', [DocumentController::class, 'FastSend_Docs']);
    Route::post('/docs-trail-send', [DocumentController::class, 'TrailSend_Docs']);
    Route::post('/docs-updateDocStats', [DocumentController::class, 'sendCompleted']);
    Route::get('/download-documents/{path}', [DocumentPreviewController::class, 'Download_Documents']);
    Route::post('/docs-mark-as-complete', [DocumentController::class, 'markAsComplete']);
    Route::post('/tmp-delete-canceled', [DocumentController::class, 'tmpDeleteIfCanceled' ]);

});

Route::prefix('documents/attachments')->group(function () {

    Route::post('/insert/attachments', [DocumentAttachmentController::class, 'attach_documents']);
    Route::post('/delete/attachments', [DocumentAttachmentController::class, 'delete_attached_documents']);
    Route::post('/load', [DocumentPreviewController::class, 'docView']);

});

Route::prefix("documents/incoming")->group(function(){

    //Incoming Documents
    Route::get('/', [IncomingController::class, 'incoming'])->name('incoming')->middleware(handleUserPriv::class);
    Route::post('/incoming-docs-details/load', [IncomingController::class, 'incoming_docDetails']);
    Route::post('/incoming-docs/load', [IncomingController::class, 'incoming_Docs']);
    Route::get('/incoming-docs/load', [IncomingController::class, 'incoming_Docs']);
    Route::post('/take/action', [IncomingController::class, 'take_action']);
    Route::get('/take/action', [IncomingController::class, 'take_action']);
    Route::post('/doc/details', [IncomingController::class, 'load_document_details']);
    Route::get('/doc/details', [IncomingController::class, 'load_document_details']);

});

Route::prefix("documents/received")->group(function(){

    //Receive Documents
    Route::get('/', [ReceiveController::class, 'received'])->name('received')->middleware(handleUserPriv::class);
    Route::post('/received-docs/load', [ReceiveController::class, 'received_Docs']);
    Route::get('/received-docs/load', [ReceiveController::class, 'received_Docs']);
    Route::post('/release/action', [ReceiveController::class, 'release_action']);
    Route::post('/load/trail', [ReceiveController::class, 'load_trail']);
    Route::get('/load/trail', [ReceiveController::class, 'load_trail']);
    Route::post('/add/trail', [ReceiveController::class, 'add_trail']);
    Route::get('/add/trail', [ReceiveController::class, 'add_trail']);

});

Route::prefix("documents/hold")->group(function(){

    Route::get('/', [HoldController::class, 'hold'])->name('hold')->middleware(handleUserPriv::class);
    Route::post('/hold-docs/load', [HoldController::class, 'hold_Docs']);
});

Route::prefix("documents/returned")->group(function(){
    Route::get('/', [ReturnedController::class, 'returned'])->name('returned')->middleware(handleUserPriv::class);
    Route::post('/returned-docs/load', [ReturnedController::class, 'returned_Docs']);
    Route::get('/returned-docs/load', [ReturnedController::class, 'returned_Docs']);
});

Route::prefix("track")->group(function(){

    Route::get('/', [TrackingController::class, 'dockTracks']);
    Route::get('/doctrack/{doccode}', [TrackingController::class, 'dockTracks'])->name('dockTracks');
    Route::post('/track-users/load', [TrackingController::class, 'track_Docs']);
    Route::get('/track-users/load', [TrackingController::class, 'track_Docs']);
    Route::post('/load/recipients', [TrackingController::class, 'load_recipient']);
    Route::post('/load/sender', [TrackingController::class, 'get_sender']);
    Route::post('/add/note', [TrackingController::class, 'add_document_notes']);
    Route::post('/remove/note', [TrackingController::class, 'remove_document_notes']);
});

Route::prefix("documents/outgoing")->group(function(){
    Route::get('/', [OutgoingController::class, 'outgoing'])->name('outgoing')->middleware(handleUserPriv::class);
    Route::post('/outgoing-docs/load', [OutgoingController::class, 'outgoing_Docs']);
    Route::get('/outgoing-docs/load', [OutgoingController::class, 'outgoing_Docs']);
});

Route::prefix("documents/trashBin")->group(function(){
    Route::get('/', [DocumentTrashController::class, 'docTrashIndex'])->name('trash')->middleware(handleUserPriv::class);
    Route::post('/docs-trash', [DocumentTrashController::class, 'getTrash']);
});

Route::prefix("documents/scanner")->group(function(){

    Route::get('/', [ScannerController::class, 'scanner'])->name('scanner')->middleware(handleUserPriv::class);
    Route::post('/take/action/viaqr', [ScannerController::class, 'take_action_viaqr']);
    Route::get('/take/action/viaqr', [ScannerController::class, 'take_action_viaqr']);
    Route::get('/add/note', [ScannerController::class, 'add_note']);
    Route::post('/add/note', [ScannerController::class, 'add_note']);
    Route::post('/remove/note', [ScannerController::class, 'remove_note']);
    Route::get('/remove/note', [ScannerController::class, 'remove_note']);
    Route::get('/receive/details/{status}', [ScannerController::class, 'receive_details']);
    Route::post('/receive/details/{status}', [ScannerController::class, 'receive_details']);
    Route::post('/receive/action', [ScannerController::class, 'receive_action']);
    Route::get('/receive/action', [ScannerController::class, 'receive_action']);
    Route::get('/release/action', [ScannerController::class, 'release_action']);
    Route::post('/release/action', [ScannerController::class, 'release_action']);
    //Route::post('/scanner-docs/load', [HoldController::class, 'scanner_Docs']);
    Route::get('/hold/action', [ScannerController::class, 'hold_action']);
    Route::post('/hold/action', [ScannerController::class, 'hold_action']);
    Route::get('/return/action', [ScannerController::class, 'return_action']);
    Route::post('/return/action', [ScannerController::class, 'return_action']);
    Route::get('/multiple/action', [ScannerController::class, 'multiple_action']);
    Route::post('/multiple/action', [ScannerController::class, 'multiple_action']);
});

Route::get('/print-qr/{docID}', [PrintQRController::class, 'Print_QR'])->name('print_QR');
Route::get('/print-qr/{docID}', [PrintQRController::class, 'Print_QR'])->name('print_QR');
Route::post('/forward-docs', [ForwardDocsController::class, 'forwardDocuments']);





//Leave Application Route

Route::prefix("Leave")->group(function(){
    Route::get('/Leave-Dashboard',[LeaveController::class, 'index'])->name('leave_dashboard');
    Route::get('/My-Leave-Dashboard', [LeaveController::class, 'my_leave'])->name('my_leave_emp');
    Route::post('/load_leave_type', [LeaveController::class, 'load_leave_type'])->name('load_leave_type');
    Route::post('/store_leave_type', [LeaveController::class, 'store_leave_type'])->name('store_leave_type');
    Route::get('/edit_leave_type/{id}/edit',[LeaveController::class, 'edit_leave_type'])->name('edit_leave_type');
    Route::put('/update_leave_type/{id}', [LeaveController::class, 'update_leave_type'])->name('update_leave_type');
    Route::get('/delete_leave_type/{id}/delete',[LeaveController::class, 'delete_leave_type'])->name('delete_leave_type');
    Route::post('/load_employee_leave_details',[LeaveController::class, 'load_employee_leave_details'])->name('load_employee_leave_details');
    Route::get('/load_employee_leave_details', [LeaveController::class, 'load_employee_leave_details'])->name('load_employee_leave_details');
    Route::get('/delete_leave_employee_details/agency_id/delete', [LeaveController::class, 'delete_leave_employee_details'])->name('delete_leave_employee_details');
    Route::post('/load_applied_leave_submitted', [LeaveController::class, 'load_applied_leave_submitted'])->name('load_applied_leave_submitted');
    Route::get('/load_applied_leave_submitted', [LeaveController::class, 'load_applied_leave_submitted'])->name('load_applied_leave_submitted');

});

// End Leave Application Route



Route::prefix('dashboard')->group(function () {

    Route::get('/', [AnalyticsController::class, 'dashboard_analytics'])->name('dashboard_analytics')->middleware(handleUserPriv::class);

});


Route::prefix('payroll')->group(function () {

    Route::get('/', [__PayrollPayrollController::class, 'payroll_mng'])->name('payroll_mng')->middleware(handleUserPriv::class);
    Route::get('/set/payroll', [__PayrollPayrollController::class, 'payroll_set'])->name('payroll_set')->middleware(handleUserPriv::class);

});
