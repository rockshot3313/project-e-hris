<?php

use App\Models\applicant\applicants;
use App\Models\applicant\applicants_civil_status;
use App\Models\applicant\applicants_gender;
use App\Models\applicant\applicants_list;
use App\Models\doc_file;
use App\Models\doc_file_track;
use App\Models\doc_groups;
use App\Models\doc_level;
use App\Models\doc_logs;
use App\Models\doc_modules;
use App\Models\doc_notes;
use App\Models\doc_notification;
use App\Models\doc_status;
use App\Models\doc_track;
use App\Models\doc_trail;
use App\Models\doc_type;
use App\Models\doc_type_submitted;
use App\Models\doc_user_privilege;
use App\Models\doc_user_rc_g;
use App\Models\employee_hr_details;
use App\Models\Hiring\tbl_hiringavailable;
use App\Models\Hiring\tbl_position;
use App\Models\Hiring\tbl_salarygrade;
use App\Models\Hiring\tbl_job_doc_requirements;
use App\Models\Hiring\tbl_competency_skills;
use App\Models\Hiring\tbl_step;
use App\Models\status_codes;
use App\Models\PDS\pds_cs_eligibility;
use App\Models\ref_brgy;
use App\Models\ref_citymun;
use App\Models\ref_country;
use App\Models\ref_province;
use App\Models\ref_region;
use App\Models\tbl_responsibilitycenter;
use App\Models\tblemployee;
use App\Models\Hiring\tbl_positionType;
use App\Models\Leave\agency_employees;
use App\Models\system\default_setting;
use App\Models\tblposition;
use App\Models\tbluserassignment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

    function BASEPATH($postStr = "") {
        return url('') . $postStr;
    }

    function GET_RES_TIMESTAMP($type = 0) {

            $ts = date("YmdHis");

            $ts = "?ts=" . $ts;

            echo $ts;

    }

    function getApplicants(){
        $getApplicants = applicants::doesntHave('get_applicant_rated')->whereHas('get_Hiring_List.get_job_info.getPanelist')->where('active', 1)->get();
        return $getApplicants;
    }

    function loaduser($id){
            if($id){
                $user = User::with('getUserinfo.getHRdetails.getPosition','getUserinfo.getHRdetails.getDesig')->where('employee',$id)->where('active',1)->first();
            }else{

                $user = User::with('getUserinfo.getHRdetails.getPosition','getUserinfo.getHRdetails.getDesig')->where('active',1)->get();
            }


            return $user;
    }

    function loadrc($id)
    {
        if($id){
            $rc = tbl_responsibilitycenter::where('responid',$id)->where('active',1)->first();
        }else{
            $rc = tbl_responsibilitycenter::where('active',1)->get();
        }

        return $rc;
    }

    function __notification_set($code = 0, $title = "", $content = "") {

        if(!is_numeric($code)) {
            $code = 0;
        }

        /*
        CODES:
                == 0  : normal
                > 0   : success
                == -1 : warning
                < -1  : danger
        */

        Session::put('__notif_code',$code);
        Session::put('__notif_title',trim($title));
        Session::put('__notif_content',trim($content));

    }

    function add_log($type,$type_id,$activity){

        $add_log = [
            'type' =>  $type,
            'type_id' =>  $type_id,
            'activity' =>  $activity ,
            'user_id' =>  Auth::user()->employee,
        ];

        doc_logs::create($add_log);

    }

    function auto_add_url(){
        $link = request()->path();
        //dd( $link);
        $getModules = doc_modules::where('link', 'like', '%'.$link.'%')->where('active',1)->first();
        if(!$getModules){
            $add_url = [
                'module_name' =>  '',
                'link' =>  $link,
            ];
            doc_modules::create($add_url);
        }
    }

    function getModule(){

        $getModule = doc_modules::where('active',1)->get();

        return $getModule;
    }

    function getUserPriv(){

        $getUserPriv = doc_user_privilege::where('active',1)->where('user_id',Auth::user()->employee)->get();

        return $getUserPriv;
    }

    function reloadAddUsers(){

        $getUser = User::where('active',1)->get();
        foreach($getUser as $user){
            $getModule = doc_modules::where('important',1)->where('active',1)->get();
                foreach($getModule as $module){
                    $getUserpriv = doc_user_privilege::where('active',1)->where('user_id',$user->employee)->where('module_id',$module->id)->first();
                if(!$getUserpriv){
                    $add_priv = [
                        'module_id' =>  $module->id,
                        'user_id' =>  $user->employee
                    ];
                    $user_priv_id = doc_user_privilege::create($add_priv)->id;
                }

                }

        }
        return $getModule;
    }


    function getAuthUser()
    {
        $return = Auth::user();
    }

    function loadGroups()
    {
        return doc_groups::where('active', 1)->get();
    }


    function createNotification($subject,$subject_id,$sender_type,$sender_id,$target_id,$target_type,$notif_content)
    {
        $add_members = [
            'subject' =>  $subject,
            'subject_id' =>  $subject_id,
            'sender_type' =>  $sender_type,
            'sender_id' =>  $sender_id,
            'target_id' =>  $target_id,
            'target_type' =>  $target_type,
            'notif_content' =>  $notif_content,
            'created_by' =>  Auth::user()->employee,
        ];
        doc_notification::create($add_members);
    }

    function loadNotification(){
        $getNotif = doc_notification::with(['getDocDetails','getGroupDetails', 'getUserDetails'])->where('seen', 0)->where('active',1)->get(); //
        return $getNotif->where('target_type','user')->where('target_id',Auth::user()->employee);
    }

    function loadNewNotification()
    {
        $getNotif = doc_notification::with('getUser_Details')->where('seen', 0)->where('active',1)->get(); //
        return $getNotif->where('target_type','user')->where('target_id',Auth::user()->employee);
    }

    //display the name in the notification
    function get_profile_name($name)
    {
        if($name)
        {
                    $get_name = tblemployee::where('agencyid',$name)->where('active',true)->first();
                    $fullname = $get_name->firstname . ' '.$get_name->lastname;
                    return $fullname;

        }

    }

    //display the image of the user
    function get_profile_image($id)
    {
        if($id)
        {
            $get_image = tblemployee::where('agencyid',$id)->where('active',true)->first();
            $img = '';

            if($get_image->image)
            {
                $get_image =$get_image->image;
                $profile = url('') . "/uploads/applicants/" . $get_image;
                $img = '<img alt="" src="'.$profile.'">';
            }

            return $img;
        }
    }


    function chekNotif(){
        $checkNotif = doc_notification::where('active',1)->where('seen', 0)->where('target_type','user')->where('target_id',Auth::user()->employee)->get();
        return $checkNotif;
    }

    function getAssignmets(){

        $getAssignmet  = doc_user_rc_g::with('getOffice','getGroup')->where('active',1)->where('user_id',Auth::user()->employee)->get();
        return  $getAssignmet;
    }

    function getAssignmetsHrdetails(){

        $getAssignmethr  = employee_hr_details::with('getPosition','getDesig')->where('active',1)->where('employeeid',Auth::user()->employee)->get();
        return  $getAssignmethr;
    }




    function encryptIt( $q ) {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }

    function decryptIt( $q ) {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( $qDecoded );
    }

    function getLoggedUserInfo(){

        $data = '';
//        $userInfo = tblemployee::has('getUsername')->where('agencyid', Auth::user()->employee)->where('active', true)->get();
        $userInfo = tblemployee::where('agencyid', Auth::user()->employee)->where('active', true)->get();


        foreach ($userInfo as $info)
        {
            $data = $info;
        }

        return ($data);
    }

    function getLoggedUserPosition(){

        $data = '';
        $userInfo = employee_hr_details::with(['getPosition', 'getDesig'])->where('employeeid', Auth::user()->employee)->where('active', true)->get();

        foreach ($userInfo as $info)
        {
           $data = $info->getPosition->emp_position;
        }

        return ($data);
    }



    function load_notes()
    {
        return doc_notes::where('active', 1)->where('dismiss', 1)->get();
    }

    function format_date_time($code, $date_time)
    {
        $format = '';

        if ($code == 0)
        {
            $format = $date_time->timezone('Asia/Manila')->toDayDateTimeString();
        }elseif($code == 1)
        {
            $format = $date_time->timezone('Asia/Manila')->toFormattedDateString();
        }elseif($code == 2)
        {
            $format = $date_time->timezone('Asia/Manila')->toDateTimeString();
        }

        return $format;
    }

    function GLOBAL_DATE_TIME_GENERATOR()
    {
        $tz_object = new DateTimeZone('Asia/Manila');
        $datetime = new DateTime();

        return $datetime->setTimezone($tz_object);;
    }

    function get_gender()
    {
        $genders = '';

        $genders = applicants_gender::where('active', 1)->get();
        return $genders;
    }

    //Montz ni diri
    function get_available_positions()
    {

        $get_available_pos = tbl_hiringavailable::with(['get_available_Position', 'get_h_list', 'get_sg'])
            ->where('active', true )
            ->get();

        return $get_available_pos;

    }

    function get_position_type()
    {
        $position_type = '';

        $position_type = tbl_positionType::where('active','1')->get();

        return $position_type;
    }


        //get the position
    function get_position()
    {
        $position = tbl_position::get();
        return  $position;
    }

    function get_salary_grade()
    {
        $salarygrade = tbl_salarygrade::get();
        return $salarygrade;
    }

    function get_employee()
    {
        $employee = tblemployee::orderBy('agencyid','ASC')->get();
        return $employee;
    }
//=============================================

    function get_province()
    {
        return ref_province::get();
    }

    function get_mun()
    {
        return ref_citymun::get();
    }

    function get_region()
    {
        return ref_region::get();
    }

    function get_country()
    {
        return ref_country::get();
    }

    function get_civil_status()
    {
        return applicants_civil_status::where('active', true)->get();
    }

    function applicant_id_generator()
    {

        //OLD ID GENERATOR
//        $month = \date('m');
//        $year = \date('Y');
//
//        $get_applicants = applicants::get();
//        $last_id = (int)$get_applicants->id;
//        $counter = $last_id;
//
//        $applicant_count = sprintf('%06u', $counter + 1);
//
//        return $year .'-'.$applicant_count;

        $last_id = '';

        $year = \date('Y');
        $get_applicants = User::get();


        foreach ($get_applicants as $applicants)
        {
            $last_id = $applicants->id;
        }

        $applicant_count = sprintf('%06u', $last_id);

        return $year .'-'.$applicant_count;
    }


    function SQL_VALUE_CHECK($sql, $empty = 1) {
        $result = $sql;
        /**/
        if(strpos(strtolower($result), strtolower("select")) !== false && strpos(strtolower($result), strtolower("from")) !== false) {
            if($empty > 0) {
                $result = "";
            }
        }
        if(strpos(strtolower($result), strtolower("create")) !== false && strpos(strtolower($result), strtolower("database")) !== false) {
            if($empty > 0) {
                $result = "";
            }
        }
        if(strpos(strtolower($result), strtolower("drop")) !== false && strpos(strtolower($result), strtolower("database")) !== false) {
            if($empty > 0) {
                $result = "";
            }
        }
        if(strpos(strtolower($result), strtolower("create")) !== false && strpos(strtolower($result), strtolower("table")) !== false) {
            if($empty > 0) {
                $result = "";
            }
        }
        if(strpos(strtolower($result), strtolower("drop")) !== false && strpos(strtolower($result), strtolower("table")) !== false) {
            if($empty > 0) {
                $result = "";
            }
        }
        if(strpos(strtolower($result), strtolower("alter")) !== false && strpos(strtolower($result), strtolower("table")) !== false) {
            if($empty > 0) {
                $result = "";
            }
        }
        if(strpos(strtolower($result), strtolower("insert")) !== false && strpos(strtolower($result), strtolower("into")) !== false) {
            if($empty > 0) {
                $result = "";
            }
        }
        if(strpos(strtolower($result), strtolower("delete")) !== false && strpos(strtolower($result), strtolower("from")) !== false) {
            if($empty > 0) {
                $result = "";
            }
        }
        if(strpos(strtolower($result), strtolower("update")) !== false && strpos(strtolower($result), strtolower("set")) !== false) {
            if($empty > 0) {
                $result = "";
            }
        }
        /**/
        if(
            (strpos(strtolower($result), strtolower("or")) !== false || strpos(strtolower($result), strtolower("and")) !== false) &&
            (strpos(strtolower($result), strtolower("=")) !== false || strpos(strtolower($result), strtolower("!=")) !== false ||
            strpos(strtolower($result), strtolower("<>")) !== false || strpos(strtolower($result), strtolower(">")) !== false ||
            strpos(strtolower($result), strtolower(">=")) !== false || strpos(strtolower($result), strtolower("<")) !== false ||
            strpos(strtolower($result), strtolower("<=")) !== false)
        ) {
            if($empty > 0) {
                $result = "";
            }
        }
        /**/
        return $result;
    }

//    function civil_service()
//    {
//        $data = '';
//        $cs = pds_cs_eligibility::where('user_id', Auth::user()->id)->where('eligibility_type', 'CAREER SERVICE')->where('active', true)->first();
//        if($cs)
//        {
//            $data = [
//                'cs_rating' => $cs->rating,
//                'cs_date_examination' => $cs->date_examination,
//                'cs_place_examination' => $cs->place_examination,
//                'cs_license_number' => $cs->license_number,
//                'cs_license_validity' => $cs->license_validity,
//            ];
//
//        }
//
//
//        return $data;
//    }
//
//    function driver_license()
//    {
//        $data = '';
//
//        $dl = pds_cs_eligibility::where('user_id', Auth::user()->id)->where('eligibility_type', 'DRIVERS LICENSE')->where('active', true)->first();
//        if ($dl)
//        {
//            $data = [
//                'eligibility_type' => $dl->eligibility_type,
//                'dl_rating' => $dl->rating,
//                'dl_date_examination' => $dl->date_examination,
//                'dl_place_examination' => $dl->place_examination,
//                'dl_license_number' => $dl->license_number,
//                'dl_license_validity' => $dl->license_validity,
//            ];
//        }
//
//
//        return $data;
//    }


function check_privileges(){
    if (Auth::check()) {
        $link = request()->path();
        $getModules = doc_modules::where('link', 'like', '%'.$link.'%')->where('active',1)->first();
        $getUser = User::where('employee',Auth::user()->employee)->first();
        if($getModules){

            $get_user_priv = doc_user_privilege::where('module_id',$getModules->id)->where('user_id',Auth::user()->employee)->first();
        if($get_user_priv){

            return $get_user_priv;
        }

        }

    }

}

    function getDocumentType()
    {
        return doc_type::where('active', 1)->get();
    }

    function getDocumentLevel()
    {
        return doc_level::where('active', 1)->get();
    }

    function getTypeOfSubmittedDocs()
    {
        return doc_type_submitted::where('active', 1)->get();
    }


    function get_option_for_release(){

        $option_1 = '';
        $userID = Auth::user()->employee;
        $userFullName = loaduser(Auth::user()->employee)->getUserinfo->firstname." ".loaduser(Auth::user()->employee)->getUserinfo->lastname;

        $option_1 .= '<option data-ass-type="user" value="'.$userID.'">'.$userFullName.'</option>';

        $getAssignmentHR  = employee_hr_details::with('getPosition','getDesig')->where('active',1)->where('employeeid',Auth::user()->employee)->get();

        foreach ($getAssignmentHR as $hr)
        if ($hr->getDesig)
        {
            $option_1 .= '<option data-ass-type="desig" value="'.$hr->getDesig->id.'">'.$hr->getDesig->userauthority.'</option>';
        }

        foreach (getAssignmets()->where('type','rc')->groupBy('type_id') as $id => $rc)
        {
            foreach ($rc as $rcdet)
            {
                $option_1 .= '<option data-ass-type="rc" value="'.$rcdet->getOffice->responid.'">'.$rcdet->getOffice->centername.'</option>';
            }
        }

        foreach (getAssignmets()->where('type','group')->groupBy('type_id') as $id => $group)
        {
            foreach ($group as $groupdet)
            {
                $option_1 .= '<option data-ass-type="group" value="'.$groupdet->getGroup->id.'">'.$groupdet->getGroup->name.'</option>';
            }
        }
        return $option_1;
    }

    function get_option_for_release_users(){

        $option_2 = '';

        foreach (loaduser('') as  $user) {


            if($user->getUserinfo()->exists()){
                $option_2 .= '<option value="'.$user->employee .'">'.$user->getUserinfo->firstname.' '.$user->getUserinfo->lastname.'</option>';
            }

        }

        return $option_2;
    }


    function sub_trail($get_trails,$track_number){
        $release_to = '';


        foreach ($get_trails as $trail) {
            $trail->sub_trail = doc_trail::where('trail_id',$trail->id)->get();



            if(!$trail->receive_date == null && !$trail->release_date == null){
                $image_status = '<img alt="done" src="../dist/images/QuaintLikelyFlyingfish-max-1mb.gif">';
            }else if(!$trail->receive_date == null && $trail->release_date == null){
                $image_status = '<img alt="file holder" src="../dist/images/sun-energy.gif">';
            }else{
                $image_status = '<img alt="to load" src="../dist/images/80ZN.gif">';
            }

                $release_to .= '<div class="intro-x relative flex items-center mb-3">
                <div class="before:block before:absolute before:w-20 before:h-px before:bg-slate-200 before:dark:bg-darkmode-400 before:mt-5 before:ml-5">
                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                        '. $image_status.'
                    </div>
                </div>
                <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                    <div class="flex items-center">
                        <div class="font-medium">'.$trail->get_user->firstname.' '.$trail->get_user->lastname.'</div>
                        <div class="text-xs text-slate-500 ml-auto">'.$trail->created_at.'</div>
                    </div>
                    <div class="text-slate-500 mt-1">Received: '.$trail->receive_date.'</div>
                    <div class="text-slate-500 mt-1">Released: '.$trail->release_date.'</div>
                </div>
            </div>
            ';


            if($trail->sub_trail->isNotEmpty()){
                $release_to .= sub_trail($trail->sub_trail,$track_number);
            }
        }
        //dd($get_trails );
        return $release_to;
    }

    function release_to($get_trails,$track_number){
        $release_to = '';

        foreach ($get_trails as $trail) {
            $trail->sub_trail = doc_trail::where('trail_id',$trail->id)->get();

                if($trail->receive_date == null && $trail->release_date == null){

                    $release_to .=  '<option value="'.$trail->target_user_id .'">'.$trail->get_user->firstname.' '.$trail->get_user->lastname.'</option>';

                }


            if($trail->sub_trail->isNotEmpty()){
                $release_to .= release_to($trail->sub_trail,$track_number);
            }
        }
        //dd($get_trails );
        return $release_to;
    }

    function system_settings(){


        return default_setting::where('active',1)->get();

    }

    function update_profile_id()
    {
//        $get_user_id = User::get();
//
//        if($get_user_id)
//        {
//            foreach ($get_user_id as $index => $user)
//            {
//                $user_id = $user->id;
//                $employee = $user->employee;
//
//                tblemployee::where('agencyid', $employee)->update([
//                    'user_id' => $user_id,
//                ]);
//
//            }
//        }
    }


    //====================================================================== for the position hiring and shortlisted
    function get_position_title($id)
    {
        $get_position_title = '';

        $get_position_title = tbl_position::where('id',$id)->first();
        return $get_position_title;
    }

    function get_SG($id)
    {
        $get_sg = '';

            $get_sg = tbl_salarygrade::where('id',$id)->where('active',1)->first();
            return $get_sg;

    }

    function get_HRMO($id)
    {
        $get_hrmo = '';

            $get_hrmo = tblemployee::where('agencyid',$id)->where('active',1)->first();
            return $get_hrmo;

    }

    function get_Documents_requirements($id)
    {
        $get_docs = '';

        $get_docs = tbl_job_doc_requirements::where('job_info_no',$id)->where('active',1)->get();
        return $get_docs;
    }

    //get the competency
    function get_competency($id)
    {
        $get_competency = '';
        if($id=='')
        {
            $get_competency = tbl_competency_skills::where('active',true)->get();
        } else if($id!='')
        {
            $get_competency = tbl_competency_skills::where('skillid',$id)->where('active',true)->first();
        }


        return $get_competency;
    }


    //get the step of the salary
    function get_step_salary()
    {
        $step = '';

        $step = tbl_step::get()->unique('stepname');

        return $step;
    }

    function get_status_codes()
    {
        $status_codes = '';

        $status_codes = status_codes::where('id','10')->orWhere('id','4')->where('active',true)->get();

        return $status_codes;
    }

    function get_pass_or_failed()
    {
        $status_code = '';

        $status_code = status_codes::where('id','16')->orWhere('id','17')->where('active',true)->get();

        return $status_code;
    }
//=============================================================================
     function GLOBAL_GENERATE_TOPBAR()
     {
         $img = '';

         if(Auth::check())
         {
             $query = tblemployee::where('user_id', Auth::user()->id)->where('active', true)->first();

             if($query->image)
             {
                 $get_image= $query->image;
                 $profile_pic = url('') . "/uploads/applicants/" . $get_image;
                 $img = '<img alt="" src="'.$profile_pic.'">';
             }else
             {
                 $query = default_setting::where('key', 'agency_logo')->where('active', true)->first();
                 $get_image= $query->image;
                 $profile_pic = url('') . "/uploads/settings/" . $get_image;
                 $img = '<img alt="" src="'.$profile_pic.'">';
             }
             return $img;
         }else
         {
             $query = default_setting::where('key', 'agency_logo')->where('active', true)->first();
             $get_image= $query->image;
             $profile_pic = url('') . "/uploads/settings/" . $get_image;
             $img = '<img alt="" src="'.$profile_pic.'">';

             return $img;
         }
     }

    function GLOBAL_GENERATE_LOGIN_LOGO()
    {
        $logo = '';

        $query_logo = default_setting::where('key', 'agency_logo')->where('active', true)->first();


        if($query_logo)
        {
            $get_image = $query_logo->image;
            $profile_pic = url('') . "/uploads/settings/" . $get_image;

            $logo = '<img alt="logo" class="w-10" src="'.$profile_pic.'">';
        }

        return $logo;
    }

    function GLOBAL_GENERATE_LOGIN_TITLE()
    {
        $title = '';

        $query_title = default_setting::where('key', 'system_title')->where('active', true)->first();

        if($query_title)
        {
            $system_title = $query_title->value;
            $title = '<span class="text-white text-lg ml-3">'.$system_title.'</span>';
        }
        return $title;
    }

    function load_position($position_id){

        if($position_id){

            return tblposition::where('id',$position_id)->get();

        }else{
            return tblposition::get();

        }

    }

    function load_designation($designation_id){

        if($designation_id){

            return tbluserassignment::where('id',$designation_id)->get();

        }else{
            return tbluserassignment::get();

        }

    }

    function load_responsibility_center($rc_id){

        if($rc_id){

            return tbl_responsibilitycenter::where('id',$rc_id)->where('active',1)->get();

        }else{
            return tbl_responsibilitycenter::where('active',1)->get();

        }

    }

    function load_status_codes($status_id){

        if($status_id){

            return doc_status::where('id',$status_id)->where('active',1)->get();

        }else{
            return doc_status::where('active',1)->get();

        }

    }

    function generate_agancy_id()
   {
        $date_year = Carbon::now()->format('Y');
        $count_emp_year = agency_employees::whereYear('created_at', $date_year)->get()->count();

        return sprintf($date_year.'-%05d',  $count_emp_year+1);
   }



   /*       Payroll Select2         */
    function payroll_Position()
    {
        return tbl_position::get();
    }

    function payroll_Salary_Grade()
    {
        return tbl_step::with('get_salary_grade')->get();
    }

    function payroll_Employee()
    {
        return agency_employees::with('get_user_profile')->where('active', 1)->get();
    }

    function payroll_Agency()
    {
        return default_setting::where('key', 'agency_location')->get();
    }
    /*       Payroll Select2         */

?>
