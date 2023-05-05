<?php

namespace App\Http\Controllers\ratingController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rating\ratingtCriteria_model;
use App\Models\Hiring\tbl_position;
use App\Models\applicant\applicants_list;
use App\Models\rating\ratedAppcants_model;
use App\Models\rating\ratedCriteria_model;
use App\Models\rating\areas_model;
use App\Models\rating\ratedArea_model;
use App\Models\Hiring\tbl_positionType;
use App\Models\Hiring\tbl_hiringlist;
use App\Models\doc_user_privilege;
use App\Models\Hiring\tblpanels;
use App\Models\Hiring\tbljob_info;
use App\Models\User;
use App\Models\tblemployee;
use App\Models\status_codes;
use App\Models\Hiring\tbl_shortlisted;
use Carbon\Carbon;

use PDF;

class ratingContoller extends Controller
{

    // ---COTROLLER BEGIN FOR CRITERIA ---//
    public function criteria_page(){
        $positionCategories = tbl_positionType::where('active', 1)->get();
        // dd($applicants);
        return view('ratingCriteria.criteria_page', compact('positionCategories'));
    }

    private function user_profile($panel_id){
        $profile = '';
            $get_image = tblemployee::where('agencyid',$panel_id)->where('active',true)->first();


            if($get_image->image)
            {
                $get_image =$get_image->image;
                $profile = url('') . "/uploads/applicants/" . $get_image;

            }
            else
            {
                $get_image = "kataw-anan.jpg";

                $profile = url('') . "/uploads/applicants/" . $get_image;
            }
            return $profile;
    }

    public function fetchedCriteria(Request $request){

        $ratingCriteria ='';

        if($request->categoryID==null){

            $ratingCriteria = ratingtCriteria_model::with('getPosition_category')->where('active', 1)->get();
        }else{
            $ratingCriteria = ratingtCriteria_model::with('getPosition_category')->where('position',$request->categoryID)->where('active', 1)->get();
        }


        $output = '<table id="tbl_criteria" class="table table-report table-hover text-center align-middle">
        <thead>

                <tr>
                    <th class="text-center whitespace-nowrap ">Criteria</th>
                    <th class="text-center whitespace-nowrap ">Areas</th>
                    <th class="text-center whitespace-nowrap ">Position</th>
                    <th class="text-center whitespace-nowrap ">Max Rate</th>
                    <th class="text-center whitespace-nowrap ">Action</th>
                </tr>

        </thead>
        <tbody>';
        // $ratingCriteria = ratingtCriteria_model::with('getPosition_category')->where('active', 1)->get();

        // dd($ratingCriteria);
        if ($ratingCriteria->count() > 0) {

            foreach($ratingCriteria as $criteria){
                foreach($criteria->getPosition_category as $position_cat){

                //    dd($position);

                $output .= '<tr class="text-center">

                                <td>

                                    '.$criteria->creteria.'

                                </td>

                                <td>';

                                $ff = areas_model::whereHas('get_criteria')->where('criteria_id', $criteria->id)->first();

                                if ($ff) {
                                    // dd('kiko');
                                    $output .= '<div title="Criteria Areas">
                                                    <a id="'.$criteria->id.'" data-criteria-name = "'.$criteria->creteria.'" class="flex justify-center items-center show_areas" href="javascript:;" data-tw-toggle="modal" data-tw-target="#arias_modal">
                                                        <h5 class="underline decoration-dotted underline-offset-4 text-primary dark:text-slate-400">
                                                            Manage Areas
                                                        </h5>
                                                    </a>
                                                    <div class="dropdown-menu w-40">

                                                    </div>
                                                </div>';
                                }else{
                                    // dd('kokak');
                                    $output .= '<div title="Criteria Areas">
                                                    <a id="'.$criteria->id.'" data-criteria-name = "'.$criteria->creteria.'" class="flex justify-center items-center show_areas" href="javascript:;" data-tw-toggle="modal" data-tw-target="#arias_modal">
                                                        <h5 class="underline decoration-dotted underline-offset-4 text-primary dark:text-slate-400">
                                                            Manage Areas
                                                        </h5>
                                                    </a>
                                                    <div class="dropdown-menu w-40">

                                                    </div>
                                                </div>';
                                }
                                $output .= '</td>

                                <td>
                                    ' .$position_cat->positiontype. '
                                </td>
                                <td>
                                    ' .$criteria->maxrate. '
                                </td>

                               <td>

                                    <div class="flex justify-center items-center">';




                            $output .= '<div class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip dropdown" title="More Action">
                                            <a class="flex justify-center items-center" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa fa-ellipsis-h items-center text-center text-primary"></i> </a>
                                            <div class="dropdown-menu w-40">
                                                <div class="dropdown-content">
                                                    <a id="'.$criteria->id.'" data-criteria="'.$criteria->creteria.'" data-max-rate="'.$criteria->maxrate.'" data-position="'.$position_cat->id.'" href="javascript:;"
                                                        class="dropdown-item editCriteria_btn">
                                                            <i class="fa fa-edit w-4 h-4 mr-2 text-success"></i> Edit
                                                    </a>
                                                    <a id="'.$criteria->id.'" href="javascript:;" class="dropdown-item deleteCriteria_btn"> <i class="fa fa-trash-alt w-4 h-4 mr-2 text-danger"></i> Delete </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </td>
                            </tr>';
                }
            }


        }else{

        }
        $output .= '</tbody></table>';

        echo $output;
    }

    // public function filterCriteriaPosition_type($id){

        //     $output = '';
        //     $ratingCriteria = ratingtCriteria_model::with('getPosition_category')->where('position', $id)->where('active', 1)->get();

        //     // dd($ratingCriteria);
        //     if ($ratingCriteria->count() > 0) {
        //         $output .= ' <table id="tbl_criteria" class="table table-report table-hover text-center align-middle">
        //         <thead>

        //                 <tr>
        //                     <th class="text-center whitespace-nowrap ">Criteria</th>
        //                     <th class="text-center whitespace-nowrap ">Areas</th>
        //                     <th class="text-center whitespace-nowrap ">Position Type</th>
        //                     <th class="text-center whitespace-nowrap ">Max Rate</th>
        //                     <th class="text-center whitespace-nowrap ">Action</th>
        //                 </tr>

        //         </thead>
        //         <tbody>';
        //         foreach($ratingCriteria as $criteria){
        //             foreach($criteria->getPosition_category as $position_cat){

        //             //    dd($position);

        //             $output .= '<tr class="text-center">

        //                             <td>

        //                                 '.$criteria->creteria.'

        //                             </td>

        //                             <td>';

        //                             $ff = areas_model::whereHas('get_criteria')->where('criteria_id', $criteria->id)->first();

        //                             if ($ff) {
        //                                 // dd('kiko');
        //                                 $output .= '<div title="Criteria Areas">
        //                                                 <a id="'.$criteria->id.'" class="flex justify-center items-center show_areas" href="javascript:;" data-tw-toggle="modal" data-tw-target="#arias_modal">
        //                                                     <h5 class="underline decoration-dotted underline-offset-4 text-primary dark:text-slate-400">
        //                                                         Manage Areas
        //                                                     </h5>
        //                                                 </a>
        //                                                 <div class="dropdown-menu w-40">

        //                                                 </div>
        //                                             </div>';
        //                             }else{
        //                                 // dd('kokak');
        //                                 $output .= '<div title="Criteria Areas">
        //                                                 <a id="'.$criteria->id.'" class="flex justify-center items-center show_areas" href="javascript:;" data-tw-toggle="modal" data-tw-target="#arias_modal">
        //                                                     <h5 class="underline decoration-dotted underline-offset-4 text-primary dark:text-slate-400">
        //                                                         Manage Areas
        //                                                     </h5>
        //                                                 </a>
        //                                                 <div class="dropdown-menu w-40">

        //                                                 </div>
        //                                             </div>';
        //                             }
        //                             $output .= '</td>

        //                             <td>
        //                                 ' .$position_cat->positiontype. '
        //                             </td>
        //                             <td>
        //                                 ' .$criteria->maxrate. '
        //                             </td>

        //                            <td>

                                //         <div class="flex justify-center items-center">';




                                // $output .= '<div class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip dropdown" title="More Action">
                                //                 <a class="flex justify-center items-center" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa fa-ellipsis-h items-center text-center text-primary"></i> </a>
                                //                 <div class="dropdown-menu w-40">
                                //                     <div class="dropdown-content">
                                //                         <a id="'.$criteria->id.'" data-criteria="'.$criteria->creteria.'" data-max-rate="'.$criteria->maxrate.'" data-position="'.$position_cat->id.'" href="javascript:;"
                                //                             class="dropdown-item editCriteria_btn">
                                //                                 <i class="fa fa-edit w-4 h-4 mr-2 text-success"></i> Edit
                                //                         </a>
                                //                         <a id="'.$criteria->id.'" href="javascript:;" class="dropdown-item deleteCriteria_btn"> <i class="fa fa-trash-alt w-4 h-4 mr-2 text-danger"></i> Delete </a>
                                //                     </div>
                                //                 </div>
                                //             </div>

                                //         </div>

        //                             </td>
        //                         </tr>';
        //             }
        //         }
        //         $output .= '</tbody></table>';
        // 		echo $output;

        //     }
    // }

    public function addCriteria(Request $request){

        // dd($request->all());
        $savecriteria = new ratingtCriteria_model;
        $savecriteria->creteria = $request->crit;
        $savecriteria->position = $request->position_cat;
        $savecriteria->maxrate = $request->maxrate;
        $savecriteria->save();

        return response()->json(['status' => 200]);
        // dd($request->all());
    }

    public function updateCriteria(Request $request){
        // dd($request->all());
        $criteriaUpdate = ratingtCriteria_model::where('id', $request->critID)->first();

        $updateExist = [
            'creteria' => $request->crit,
            'position' => $request->position_cat,
            'maxrate' => $request->maxrate,
        ];
        $criteriaUpdate->update($updateExist);

        return response()->json(['status' => 200]);

    }

    public function deleteCriteria(Request $request){
        $criteria_id = ratingtCriteria_model::where('id', $request->criteria_id)->first();

        $removeToRow = [
            'active' => 0,
        ];
        $criteria_id->update($removeToRow);

        return response()->json(['status' => 200]);
    }
    // ---COTROLLER END FOR CRITERIA ---//

    // ---//-- CRITERIA AREAS--//----------//
    public function storeArea(Request $request){
        // dd($request->all());
        // $criters = ratingtCriteria_model::whereHas('get_areas')->where('id', $request->critID)->get();
        // dd($criters);

        foreach ($request->areaname as $key => $areaName) {

            $insert_area['area']  = $areaName;
            $insert_area['criteria_id']     = $request->critID;
            // $insert_area['rate']            = $request->arearate[$key];

            areas_model::updateOrCreate(['id' => $request->areasID[$key]], $insert_area);
        }
        return response()->json(['status' => 200]);

    }

    public function showAreas($id){
        $areas_all = [];
        $areas = areas_model::where('criteria_id', $id)->where('active', 1)->get();
        // dd($areas);
        foreach ($areas as $area) {

                    $td = [

                        "id" => $area->id,
                        "area" => $area->area,
                        "rate" => $area->rate,

                    ];
                    $areas_all[count($areas_all)] = $td;
        }
        // dd($areas_all);
        echo json_encode($areas_all);

    }

    public function deleteAreas($id){
        $area = areas_model::where('id', $id)->update(['active' => 0]);
    }

    // ---COTROLLER BEGIN FOR RATING ---//
    public function manageRating_page(){
        $positionCategory = tbl_positionType::where('active', 1)->get();


        return view('ratingCriteria.manageRating_page', compact('positionCategory'));
    }

    public function filterRatedApplicants(){

        $getApplicants = tbl_shortlisted::doesntHave('get_applicant_rated')->with(['get_profile', 'get_job_info.get_Position','get_job_info.getPanels', 'get_job_info.get_position_type', 'get_stat'])->where('stat', 10)->where('active', 1)->get();

        // if($getApplicants->rate_sched)
        // dd($getApplicants);
        $output = ' <table id="tbl_applicant_rated" class="table table-report table-hover text-center align-middle">
        <thead>

                <tr>
                    <th class="text-center whitespace-nowrap ">Applicant Name</th>
                    <th class="text-center whitespace-nowrap ">Position Applied</th>
                    <th class="text-center whitespace-nowrap ">Status</th>
                    <th class="text-center whitespace-nowrap ">Action</th>
                </tr>

        </thead>
        <tbody>';

        if($getApplicants->count() > 0){


            foreach ($getApplicants as $getApplicant) {
                
                // $sched_date = $getApplicant->rate_sched;

                // $dt = Carbon::parse($sched_date)->timezone('Asia/Manila');
                // $toDay = $dt->format('d');
                // $toMonth = $dt->format('m');
                // $toYear = $dt->format('Y');
                // $dateUTC = Carbon::createFromDate($toYear, $toMonth, $toDay, '+08:00');
                // $datePST = Carbon::createFromDate($toYear, $toMonth, $toDay, 'Asia/Manila');
                // $difference = $dateUTC->diffInHours($datePST);
                // $date = $dt->addHours($difference);

                // dd($date);
                    $clock_btn ='';
                    $rate_class = '';
                    $btnClass_status = '';
                    $status = '';
                    $stats_class = '';
                    $sched_date = $getApplicant->rate_sched;
                    $rate_datess = (new Carbon)->parse($sched_date);
                    // dd($rate_datess);

                    $hr =  $rate_datess->hour;
                    $min = $rate_datess->minute;
                    $sec = $rate_datess->second ;

                    $hr_to_min = 60 * $hr;
                    $hr_to_min_min = $hr_to_min + $min;
                    $sec_to_min = $sec / 60;
                    // dd($rate_datess, $sec_to_min, $sec);


                    $rate_date = $rate_datess->subMinutes($hr_to_min_min+$sec_to_min);
                    $date_today =  Carbon::now()->shiftTimezone('Asia/Manila'); // today
                    // dd($rate_date, $hr_to_min_min, $sec);

                    $diff_of_days = $date_today->diffInHours($rate_date);

                    // dd($rate_date->subMinutes(1440));
                    if($rate_date <= $date_today){
                        $rate_class = 'rate_Icon';
                        $btnClass_status = 'primary';
                        $stats_class = 'success';
                        $status_st = 'Ready to Rate';
                        $clock_btn = '';
                    }else{
                        $rate_class = 'pending';
                        $btnClass_status = '';
                        $stats_class = 'pending';
                        $status_st = $getApplicant->get_stat->name;
                        $clock_btn = '<i class="fa fa-solid fa-clock"></i>';
                    }
                    // dd($startTime);
                // dd($getApplicant->get_job_info->get_Position->emp_positiono);

                $output .= '<tr class="text-center">

                                <td>

                                    '.$getApplicant->get_profile->lastname.' '.$getApplicant->get_profile->lastname.' '.$getApplicant->get_profile->mi.'

                                </td>

                                <td>
                                    '.$getApplicant->get_job_info->get_Position->emp_position.'
                                </td>

                                <td>

                                    <div class="flex items-center">
                                        <div class="w-2 h-2 bg-'.$stats_class.' rounded-full mr-3"></div>
                                            <span class="truncate">'.$status_st.'</span>

                                            
                                        <div class="ml-auto cursor-pointer tooltip">
                                           <div> 
                                                <p id="timer" class = "timer text-xs ml-auto">
                                                    <span id="timer-days" class = "timer-days"></span>
                                                    <span id="timer-hours" class = "timer-hours"></span>
                                                    <span id="timer-mins" class = "timer-mins"></span>
                                                    <span id="timer-secs" class = "timer-secs"></span>
                                                </p>
                                            </div>
                                        
                                            <a class="flex justify-center items-center text-primary timer_btn" href="javascript:;"
                                                data-rate-date = "'.$rate_date.'" 
                                                data-date-today = "'.$date_today.'">
        
                                                '.$clock_btn.'
                                                    
                                            </a>
                                        </div>
                                    </div>

                                </td>

                               <td>
                                    <div class="flex justify-center items-center">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip dropdown" title="Rate">
                                                <a data-position-type="'.$getApplicant->get_job_info->get_position_type->id.'"
                                                data-position-id="'.$getApplicant->get_job_info->get_Position->id.'"
                                                data-applicant-id="'.$getApplicant->get_profile->user_id.'"
                                                data-applicant-list-id="'.$getApplicant->id.'"
                                                data-applicant-job-ref="'.$getApplicant->get_job_info->jobref_no.'"
                                                class="flex justify-center items-center text-'.$btnClass_status.' '.$rate_class.'"
                                                href="javascript:;">
                                                <i class="fa-solid fa-ranking-star"></i>
                                                </a>
                                            </div>
                                        </div>
                                </td>
                            </tr>';

            }
            $output .= '</tbody></table>';

        }

        echo $output;
    }


    public function filterPositionBy_applicant($id){
        $output = '';
        $appPosition = [];
        $applicantPost = tbl_hiringlist::with('get_job_info.getPos')->where('applicant_id', $id)->where('active', 1)->get();
        // dd($applicantPost);
        $output .= '<label for="position">Position Applied:</label>
                            <select id="ApplicantPosition_select" name="ApplicantPosition" class="select2 form-control"><option disabled selected>Please Select Position</option>';

                                foreach ($applicantPost as $getAvailPos) {

                                    foreach ($getAvailPos->get_job_info as $getPosit) {

                                        foreach($getPosit->getPos as $position){
                                            // dd($position->id);

                                           $output .= '<option value="'.$position->id.'">'. $position->emp_position.'</option>';

                                        }
                                    }

                                }

                            $output .= '</select>';

        // dd($output);
        echo $output;
    }

    public function filter_ratingCriteria(Request $request, $id){
        // dd($request->all(), $id);
        $position = [];

        $getType =  tbljob_info::where('pos_title', $id)->where('active', 1)->first();
        $filterCriteria =  ratingtCriteria_model::with('getPosition_category')->where('position', $getType->pos_type)->where('active', 1)->get();
        $totalSum =  ratingtCriteria_model::with('getPosition_category')->where('active', 1)->where('position', $getType->pos_type)->sum('maxrate');


        foreach ($filterCriteria as $criteria) {

            // dd($criteria);

            $ratedArea = ratedArea_model::where('criteria_id', $criteria->id)->where('position_id', $id)->where('applicant_id', $request->applicantid)->where('rated_by', auth()->user()->employee)->get();

            // foreach($ratedArea as $rArea){
                // dd($rArea);
                // dd($rArea->sum('rate'));
            // }
            // dd($ratedArea);
            // dd($ratedCriteria->sum('rate'));
            $area_sum_all = '';
            $sumOf_ratedArea = '';
            if($ratedArea){
               $sumOf_ratedAreass = ratedArea_model::where('criteria_id', $criteria->id)
                                            ->where('position_id', $id)
                                            ->where('applicant_id', $request->applicantid)
                                            ->where('rated_by', auth()->user()->employee)
                                            ->sum('rate');
               if($sumOf_ratedAreass == 0){
                    $sumOf_ratedArea = '';
               }
               else{
                $sumOf_ratedArea = $sumOf_ratedAreass;
               }
               $area_sum_all = ratedArea_model::where('position_id', $id)->where('applicant_id', $request->applicantid)->where('rated_by', auth()->user()->employee)->sum('rate');
            }
            // dd($sumOf_ratedArea);
            foreach ($criteria->getPosition_category as $p_category) {

                $td = [

                        "id" => $criteria->id,
                        "criteria" => $criteria->creteria,
                        "positionID" => $criteria->position,
                        "maxrate" => $criteria->maxrate,
                        "totalMax_rate" => $totalSum,
                        "p_category" => $p_category->positiontype,
                        "p_categoryID" => $p_category->id,
                        "areaSum" => $sumOf_ratedArea,
                        "area_sum_all" => $area_sum_all,

                ];
                    $position[count($position)] = $td;
            }

        }
        // dd($position);
        echo json_encode($position);
    }



    public function showRatingArea(Request $request, $id){
        // dd($request->all());
        $ar = [];
        $rated_areaID = '';
        $td = [];
        $rate = '';
        $ratedID = 0;
        $sumall ='';
        $areass = areas_model::where('criteria_id', $id)->where('active', 1)->get();
        // dd($areass);
        // $rated_id = ratedArea_model::where('criteria_id', $id)->where('position_id', $request->positionID)->where('applicant_id',$request->applicantID)->where('rated_by', auth()->user()->employee)
        $rated_id = ratedArea_model::where('criteria_id', $id)
                                    ->where('position_id', $request->positionID)
                                    ->where('applicant_id',$request->applicantID)
                                    ->where('rated_by', auth()->user()->employee)
                                    ->exists();
        // dd($rated_id);

        if($rated_id){
            // dd($rated_id);
            $rated_data = ratedArea_model::with('get_area')
                                            ->where('criteria_id', $id)
                                            ->where('position_id', $request->positionID)
                                            ->where('applicant_id',$request->applicantID)
                                            ->where('rated_by', auth()->user()->employee)
                                            ->get();
            // $rated_data = ratedArea_model::with('get_area')->where('criteria_id', $id)->where('position_id', $request->positionID)->where('applicant_id',$request->applicantID)->where('rated_by', auth()->user()->employee)->sum('rate');
            $sumall = ratedArea_model::with('get_area')
                                        ->where('criteria_id', $id)
                                        ->where('position_id', $request->positionID)
                                        ->where('applicant_id',$request->applicantID)
                                        ->where('rated_by', auth()->user()->employee)
                                        ->sum('rate');

            foreach ($rated_data as $key => $value) {
                $ratedID = $value->id;
                foreach ($value->get_area as $area) {


                    if($value->rate == 0){
                        $rate = '';
                    }else{
                        $rate = $value->rate;
                    }


                    $td = [
                            "rated_id" => $ratedID,
                            "id" => $area->id,
                            "area" => $area->area,
                            "rate" => $rate,
                            "sumAll" => $sumall,

                    ];
                    $ar[count($ar)] = $td;
                }
            }
        }

        else{

        foreach ($areass as $areas) {
            // dd($areas);
            $td = [
                    "rated_id" => $ratedID,
                    "id" => $areas->id,
                    "area" => $areas->area,
                    "rate" => $rate,
                    "sumAll" => $sumall,
            ];
                $ar[count($ar)] = $td;
        }

        }

        // dd($ar);
        echo json_encode($ar);

    }

    public function saveRating(Request $request){
        // dd($request->all());
            $total = 0;
            foreach( $request->rate as $key => $rate)
            {
                $total += $rate;
            }
            // dd($total);

            $saverated = new ratedAppcants_model;
            $saverated->applicantID = $request->input('applicant_ids');
            $saverated->position_type = $request->input('position_type');
            $saverated->positionID = $request->input('position');
            $saverated->applicant_listID = $request->input('applicant_list_id');
            $saverated->applicant_job_ref = $request->input('applicant_job_ref');
            $saverated->remarks = $request->input('remarks');
            $saverated->rate = $total;
            $saverated->rated_by   = auth()->user()->employee;
            $saverated->save();

            foreach( $request->rate as $key => $rate)
            {

                $saveRate['rated']        = $rate;
                $saveRate['applicant_id']  = $request->applicant_ids;
                $saveRate['criteria_id']   = $request->criteriaID[$key];
                $saveRate['position_id']   = $request->position;
                $saveRate['applicant_job_ref']  = $request->applicant_job_ref;
                $saveRate['rated_by']  = auth()->user()->employee;

                ratedCriteria_model::create($saveRate);
                // dd($saveRate);
            }

            return response()->json(['status' => 200]);


    }

    public function storeRated_areas(Request $request){
        // dd($request->all());

        foreach( $request->rate_area as $key => $area_rate)
        {

            $saveRate['rate']        = $area_rate;
            $saveRate['areas_id']   = $request->areas_id[$key];
            $saveRate['applicant_id']  = $request->applicant_id;
            $saveRate['criteria_id']  = $request->criteria_id;
            $saveRate['position_id']  = $request->position_id;
            $saveRate['rated_by']  = auth()->user()->employee;

            ratedArea_model::updateOrCreate(['id' => $request->ratedArea_id[$key]],$saveRate);
            // areas_model::updateOrCreate(['id' => $request->areasID[$key]], $insert_area);
            // dd($saveRate);
        }

        return response()->json(['status' => 200]);

    }

    // ---COTROLLER END FOR RATING ---//

    //===== SUMMARY OF RATING -----//
    public function summary_page(){
        $ratedApplicant = ratedAppcants_model::with(['get_applicant', 'get_position', 'get_ratedcriteria.get_criteria' ])->where('active', 1)->where('rated_by', auth()->user()->employee)->get();
        $criteria = ratingtCriteria_model::where('active', 1)->where('position', 2)->get();
        // dd($ratedApplicant);
        return view('ratingCriteria.summary_page', compact(['ratedApplicant','criteria'] ));
    }



    public function fetched_ratedApplicant($postype_id){
        // dd($postype_id);
        $ratedApplicants = '';
        $output = '<table id="tbl_summary" class="table table-report -mt-2 table-bordered">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap"> Applicant Name </th>
                        <th class="text-center whitespace-nowrap"> Position Applied </th>
                        <th class="text-center whitespace-nowrap"> Rating Status </th>
                        <th class="text-center whitespace-nowrap"> Action </th>
                    </tr>
                </thead>
                <tbody>';

        $checkUser = User::where('employee', auth()->user()->employee)->first();

        if($postype_id == "undefined" || $postype_id == "all"){
           if($checkUser->role_name == "Admin"){
                $ratedApplicants = ratedAppcants_model::with(['get_applicant_profile', 'get_positionee', 'get_panels'])->select(['applicantID', 'applicant_job_ref', 'positionID', 'position_type'])->distinct()->get();
           }else{
                $ratedApplicants = ratedAppcants_model::with(['get_applicant_profile', 'get_positionee', 'get_panels'])->where('rated_by', auth()->user()->employee)->get();
           }

        }else{
            if($checkUser->role_name == "Admin"){
                $ratedApplicants = ratedAppcants_model::with(['get_applicant_profile', 'get_positionee', 'get_panels'])->where('position_type', $postype_id)->select(['applicantID', 'applicant_job_ref', 'positionID', 'position_type'])->distinct()->get();
           }else{
                $ratedApplicants = ratedAppcants_model::with(['get_applicant_profile', 'get_positionee', 'get_panels'])->where('rated_by', auth()->user()->employee)->where('position_type', $postype_id)->get();
           }

        }

        if($ratedApplicants->count() > 0){

            foreach ($ratedApplicants as $applicants) {

                // dd($applicants);



                $_ratercount = '';
                $status = '';
                $status_class = '';
                $status_stag = '';
                $panels_count = '';
                $approval_btn = '';
                if($applicants->get_panels){

                    foreach($applicants->get_panels as $panels){
                        $pans = $panels->where('available_ref', $applicants->applicant_job_ref)->get();
                            $panels_count = $pans->count();

                    }

                }


                    $_count_rater = ratedAppcants_model::where('applicant_job_ref', $applicants->applicant_job_ref)->where('applicantID', $applicants->applicantID)->get();
                        $_ratercount = $_count_rater->count();
                        // dd($_ratercount);
                        // if($count_panels > 0){
                        //     $rater_count = $_ratercount;
                        // }else{
                        //     $rater_count = 'Not Rated Yet';
                        // }



                $applicantname = '';
                $applicantPosition = '';
                if($applicants->get_applicant_profile){
                    $applicantname = $applicants->get_applicant_profile->lastname.', '. $applicants->get_applicant_profile->firstname.' '. $applicants->get_applicant_profile->mi;

                }else{
                    $applicantname = ' Applicant Profile is No longger Exist!';
                }
                // dd($applicants->get_positionee);
                if($applicants->get_positionee){
                    $applicantPosition = $applicants->get_positionee->emp_position;
                }else{
                    $applicantPosition = 'Position is No longger Exist';
                }
                // $get_status = new status_codes;
                // dd($get_status);
                if($panels_count == $_ratercount){
                    $check_status = status_codes::where('code', 12)->first();
                    $status =  $check_status->name;
                    $status_class =  $check_status->class;
                    $status_stag =  $check_status->stag;
                    if($checkUser->role_name == "Admin"){
                        $approval_btn = '<div class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip dropdown" title="More Action">
                                            <a class="flex justify-center items-center" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa fa-ellipsis-h items-center text-center text-primary"></i> </a>
                                            <div class="dropdown-menu w-40">
                                                <div class="dropdown-content">
                                                    <a id="" data-criteria="" data-max-rate="" data-position="" href="javascript:;"
                                                        class="dropdown-item editCriteria_btn">
                                                        <i class="fa-solid fa-thumbs-up text-success"></i> <span class="mr-2">  Approve </span>
                                                    </a>
                                                    <a id="" href="javascript:;" class="dropdown-item">
                                                    <i class="fa-solid fa-thumbs-down text-danger"></i>
                                                    <span class="mr-2">  Disapproved </span>
                                                     </a>
                                                </div>
                                            </div>
                                        </div>';
                    }else{
                        $approval_btn = '';
                    }
                }else{
                    $check_status = status_codes::where('id', 15)->first();
                    $status =  $check_status->name;
                    $status_class =  $check_status->class;
                    $status_stag =  $check_status->stag;
                }


                $output .= '<tr>
                                <td>
                                    '.$applicantname.'
                                </td>

                                <td>
                                    '.$applicantPosition.'
                                </td>

                                <td>

                                    <div class="flex items-center">
                                    <div class="w-2 h-2 bg-'.$status_class.' rounded-full mr-3"></div>
                                            <span class="truncate">'.$status.'</span>

                                        <div class="ml-auto cursor-pointer tooltip" title="'.$status_stag.'">';

                                        // $get_panels = tblpanels::where('available_ref', $applicants->applicant_job_ref);

                                        $output .= '<a id="raterStatus"
                                                        data-job-ref="'.$applicants->applicant_job_ref.'"
                                                        data-applicant-id="'.$applicants->applicantID.'"
                                                        data-position-id="'.$applicants->positionID.'"
                                                        class="underline decoration-dotted underline-offset-4 text-primary dark:text-slate-400 cursor-pointer">
                                                rater
                                            </a>
                                            &nbsp; '.$_ratercount.'  /  '. $panels_count .'
                                        </div>
                                    </div>

                                </td>

                                <td>
                                    <div class="flex justify-center items-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip dropdown" title="Print">
                                            <a class="flex justify-center items-center text-primary"
                                                href="javascript:;">
                                            <i class="fa fa-print" aria-hidden="true"></i>
                                            </a>

                                        </div>

                                        <div class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip dropdown" title="Details">
                                            <a id="" data-job-ref="'.$applicants->applicant_job_ref.'"
                                                    data-applicant-id="'.$applicants->applicantID.'"
                                                    data-position-id="'.$applicants->positionID.'"
                                                    data-position-type="'.$applicants->position_type.'"
                                                    class="flex justify-center items-center text-success ratedDetails"
                                                    href="javascript:;">
                                                    <i class="fa-solid fa-list"></i>
                                            </a>

                                        </div>

                                        '.$approval_btn.'

                                    </div>

                                </td>
                            </tr>';
            }

        }

        $output .= '</tbody></table>';

        echo $output;
    }

    public function rater_details(Request $request){
        $get_panelss = tblpanels::where('available_ref', $request->job_ref)->with('get_employee')->get();
        if($get_panelss->count() > 0){
            $output ='';
            foreach($get_panelss as $panels){
                $panel_class = '';
                $panel_status = '';


            $check_rater = ratedAppcants_model::where('applicant_job_ref', $panels->available_ref)->where('applicantID', $request->applicant_id)->where('rated_by', $panels->panel_id)->first();
                // DD($check_rater);

                    if($check_rater){
                        $panel_class = 'success';
                        $panel_status = '<i class="fa-solid fa-check"></i>';
                    }else{
                        $panel_class = 'danger';
                        $panel_status = '<i class="fa-solid fa-xmark"></i>';
                    }

                    $panel_id = $panels->panel_id;
                    $profileee = $this->user_profile($panel_id);

                $output .= ' <div class="intro-x relative flex items-center mb-3">
                                <div class="before:block before:absolute before:w-20 before:h-px before:bg-slate-200 before:dark:bg-darkmode-400 before:mt-5 before:ml-5">
                                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                        <img alt="Midone - HTML Admin Template" src="'.$profileee.'">
                                    </div>
                                </div>
                                <div class="box px-5 py-3 ml-4 flex-1">
                                    <div class="flex items-center">
                                        <div class="text-slate-600 dark:text-slate-500 block">'.$panels->get_employee->lastname.', '.$panels->get_employee->firstname.' '.$panels->get_employee->mi.'</div>
                                        <div class="text-xs text-slate-500 ml-auto text-'.$panel_class.'">'.$panel_status.'</div>
                                    </div>

                                </div>
                            </div>';
            }
            echo $output;

        }


    }

    public function filterApplicants($postype_id){
        $output = '';
        $ratedApplicants = ratedAppcants_model::where('active', 1)->where('rated_by', auth()->user()->employee)->get();
        dd($ratedApplicants);
        // $ratedApplicants = ratedAppcants_model::with(['get_applicantee.get_profile', 'get_position', 'get_ratedcriteria.get_criteria' ])->where('pos_category_id', $postype_id)->where('active', 1)->where('rated_by', auth()->user()->employee)->get();
        // $criteria = ratingtCriteria_model::where('position', $postype_id)->where('active',1)->get();
        // // dd($ratedApplicants);
        // if ($ratedApplicants->count() > 0) {

        //     $output .= ' <table id="tbl_summary" class="table table-report -mt-2 table-bordered">
        //                     <thead>

        //                         <tr>
        //                             <th class="text-center whitespace-nowrap ">Applicants:</th>';
        //                                 foreach($ratedApplicants as $ratedApplicant){
        //                                     // dd($ratedApplicant);
        //                                     foreach($ratedApplicant->get_applicant as $applicant){
        //                                         // dd($applicant);
        //                  $output .= '<th class="text-center whitespace-nowrap ">'. $applicant->lastname.', ' .$applicant->firstname.' ' .$applicant->mi.'</th>';
        //                                     }
        //                                 }
        //             $output .= '</tr>

        //                         <tr>
        //                             <th class="text-center whitespace-nowrap ">Applied Position:</th>';
        //                             foreach($ratedApplicants as $ratedApplicant){
        //                                 // dd($ratedApplicant);
        //                                 foreach($ratedApplicant->get_position as $position){
        //                                     // dd($applicant);
        //                  $output .= '<td class="text-center whitespace-nowrap ">'. $position->emp_position.'</td>';
        //                                 }
        //                             }
        //             $output .= '</tr>

        //                     </thead>
        //                     <tbody>';
        //                     foreach($criteria as $criterianame){

        //             $output .= '<tr class="text-center">

        //                             <td>'.$criterianame->creteria.'</td>';

        //                                 foreach($ratedApplicants as $ratedApplicant){

        //                                     $ratedCriterias = ratedCriteria_model::where('position_id', $ratedApplicant->positionID)->where('criteria_id', $criterianame->id)->where('applicant_id', $ratedApplicant->applicantID)->where('rated_by', auth()->user()->employee)->where('active', 1)->get();
        //                                     foreach($ratedCriterias as $ratedCriteria){

        //                 $output .= '<td>'.$ratedCriteria->rated.'%</td>';
        //                                     }
        //                                 }

        //             $output .= '</tr>';

        //                     }
        //         $output .= '</tbody>
        //                         <tfoot>
        //                             <tr>
        //                                 <th class="text-center whitespace-nowrap ">Total:</th>';
        //                                 foreach($ratedApplicants as $ratedApplicant){
        //                     $output .= '<th class="text-center whitespace-nowrap ">'.$ratedApplicant->rate.'%</th>';
        //                                 }
        //                 $output .= '</tr>
        //                         </tfoot>
        //                 </table>';

		// 	echo $output;

        // }else{
        //    echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        // }
    }

    public function printSummary(){

        $filename = 'Summary of Rating';

        // $long_BondPaper = array(0, 0, 612.00, 936.0);

        $pdf = PDF::loadView('ratingCriteria.print_blade.print_rated_summary',compact('filename',))->setPaper('legal','landscape');
        return $pdf->stream($filename . '.pdf');
    }

    public function summary_details(Request $request){
        // dd($request->applicant_id);

        $output = '';
        $ratedApplicants = ratedAppcants_model::with(['get_position', 'get_ratedcriteria.get_criteria', 'get_rater_profile' ])
                                                    ->where('applicant_job_ref', $request->job_ref)
                                                    ->where('applicantID', $request->applicant_id)
                                                    ->get();

        // dd($ratedApplicants);
        $rated_applicant_length = $ratedApplicants->count();
        if ($rated_applicant_length > 0) {
            // $positionType = '';
            // $applicantID = '';
            // $ratedBy = '';
            // $job_ref = '';
            // $panelID = '';

            // foreach($ratedApplicants as $ratedApplicant){
            //     $output .= '<td>'.$ratedApplicant->rate.'%</td>';
            // }


                        $output .= ' <table id="tbl_summary" class="table table-report -mt-2 table-bordered">';

                            // dd($criteria);
                            $output .= '<tr>
                                            <td class="text-center whitespace-nowrap" colspan="2">Rater:</td>';
                                            foreach($ratedApplicants as $ratedApplicant){
                                            $check_panels = tblpanels::where('available_ref', $ratedApplicant->applicant_job_ref)
                                                ->where('panel_id', $ratedApplicant->rated_by);
                                            // dd($check_panels);
                                                $panel_name = '---';
                                                if($check_panels->exists()){
                                                //   dd("naaa.x");
                                                    foreach($check_panels as $panels){
                                                        if($panels != "" || $panels->active != 0){
                                                            $panel_name = $panels->get_employee->lastname.', ' .$panels->get_employee->firstname.' ' .$panels->get_employee->mi;
                                                        }else{
                                                            $panel_name = 'Rater is No longer a Panel';
                                                        }

                                                    }
                                                }else{
                                                    $panel_name = $ratedApplicant->get_rater_profile->lastname.', ' .$ratedApplicant->get_rater_profile->firstname.' ' .$ratedApplicant->get_rater_profile->mi;
                                                }
                                                // $get_panels = tblpanels::with('get_employee')
                                                //                         ->where('available_ref', $ratedApplicant->applicant_job_ref)
                                                //                         ->where('panel_id', $ratedApplicant->rated_by)
                                                //                         ->where('active', 1)
                                                //                         ->get();
                                                $output .= '<td>'.$panel_name.'</td>';

                                            }
                                            $output .= '<td rowspan = "2">Total</td>';

                                            // dd($ratedApplicant);
                            $output .= '</tr>';

                            $output .= '<tr class = "text-center text-bold">
                                            <td>CRITERIA/s</td>
                                            <td>Max Score</td>';
                                            foreach($ratedApplicants as $ratedApplicant){
                                                $output .= '<td> Rate </td>';
                                            }

                            $output .= '</tr>';

                                $criterias = ratingtCriteria_model::where('position', $request->position_type)->where('active', 1)->get();

                                $count_criteria = $criterias->count();

                                foreach($criterias as $criteria){

                                    $total_criteria_rates = ratedCriteria_model::where('criteria_id', $criteria->id)
                                            ->where('applicant_id', $request->applicant_id)
                                            ->where('applicant_job_ref',$request->job_ref)
                                            ->get();
                                    $total_criteria_rate = ratedCriteria_model::where('criteria_id', $criteria->id)
                                            ->where('applicant_id', $request->applicant_id)
                                            ->where('applicant_job_ref',$request->job_ref)
                                            ->sum('rated');

                                    $max_rate = number_format($criteria->maxrate);
                                    $max_percent = $max_rate / 100;
                                    $max_sum = $max_rate * $rated_applicant_length;
                                    // dd($max_percent);

                                    // $total_criteria_rate_length = $total_criteria_rates->count();

                                    $division_of_total = ($total_criteria_rate/$max_sum) * 100;
                                    // dd($division_of_total);
                            $t_percent = round((float) $division_of_total * $max_percent );
                            $total_percentages[] = $t_percent;

                            $total = 0;

                                    for($i = 0; $i < count($total_percentages); $i++){
                                        $total += $total_percentages[$i];
                                    }

                                $output .= '<tr class = "text-center">
                                                <td class="text-center whitespace-nowrap">'.$criteria->creteria.'</td>
                                                <td class="text-center whitespace-nowrap">'.$criteria->maxrate.'</td>';
                                                foreach($ratedApplicants as $ratedApplicant){

                                                    $criterias_rates = ratedCriteria_model::where('criteria_id', $criteria->id)
                                                                        ->where('applicant_id', $ratedApplicant->applicantID)
                                                                        ->where('rated_by', $ratedApplicant->rated_by)
                                                                        ->where('applicant_job_ref',$ratedApplicant->applicant_job_ref)
                                                                        ->get();


                                                    foreach($criterias_rates as $criterias_rate){

                                                        $rate = '';
                                                        if($criterias_rate){
                                                            $yourRate = $criterias_rate->rated;
                                                            if($yourRate == 0 || $yourRate =='' ){
                                                            $rate = '--';
                                                            }else{
                                                                $rate = $criterias_rate->rated;
                                                            }
                                                        }else{
                                                            $rate = '--';
                                                        }
                                                        $output .= '<td>'.$rate.'</td>';


                                                    }

                                                }
                                                $output .='<td class="text-center whitespace-nowrap">'.$t_percent.'%</td>';

                                $output .= '</tr>';

                            }

                            $output .= '<tr class = "text-center">
                                            <td>Total </td>
                                            <td>Total </td>';
                                                $array = [];
                                                $total_applicant_rate = '';
                                                foreach($ratedApplicants as $ratedApplicant){
                                                    // dd($total_applicant_rate);

                                                    $total_applicant_ratesss = ratedCriteria_model::where('applicant_id', $ratedApplicant->applicantID)
                                                        ->where('rated_by', $ratedApplicant->rated_by)
                                                        ->where('applicant_job_ref',$ratedApplicant->applicant_job_ref)
                                                        ->sum('rated');
                                                        if($total_applicant_ratesss != 0 || $total_applicant_ratesss != ''){
                                                            $total_applicant_rate = $total_applicant_ratesss/$count_criteria;
                                                        }

                                                        $output .= '<td>'.$total_applicant_rate.'</td>';

                                                    }


                            $output .= '<td>'.$total.'%</td></tr';

                                                // dd($total_criteria_rate);

                        }
                        $output .= '</table>';
                        echo  $output;


    }
}
