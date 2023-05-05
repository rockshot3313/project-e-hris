<?php

namespace App\Http\Controllers\Hiring;

use App\Http\Controllers\Controller;
use App\Models\applicant\applicants_list;
use App\Models\Hiring\tbl_position;
use App\Models\Hiring\tbl_shortlisted;
use App\Models\tblemployee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Short_listed extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }
    //
    public function short_listed_index()
    {
        return view('applicant_short_listed.short_listed');
    }


    //retreive the position title
    public function get_applicants_details(Request $request)
    {
        $position =tbl_position::where('id',$request->ref_num)->get(['emp_position']);

        if($position)
        {
            return response()->json([
                'status' => true,
                'message' => $position
            ]);
        } else
        {
            return response()->json([
                'status' => true,
                'message' => 'Unable to find the positon applied'
            ]);
        }
    }

    //retrieve the image
    private  function get_image($id)
    {
        $get_image = tblemployee::where('user_id',$id)->where('active',true)->first();
        $profile = '';

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

    // display the shortlisted applicants
    public function short_listed_applicant(Request $request)
    {
        $status = $request->stat;
        $applicant_info = $this->get_applicant_info($request->stat);
        $full_name = '';
        $table = '<table id="tb_short_listed" class="table table-report table-hover my-8">
                        <thead class="">
                        <tr>
                         <th class="text-center whitespace-nowrap "><strong>ID</></th>
                         <th class="text-center whitespace-nowrap "><strong>Name</></th>
                         <th class="text-center whitespace-nowrap "><strong>Status</></th>
                         <th class="text-center whitespace-nowrap "><strong>Action</></th>
                     </tr>
                     </thead>
                     <tbody>';

        if($applicant_info)
        {
            if($status == '11' || $status == null)
                {
                    foreach($applicant_info as $info)
                    {
                        $applicant_profile = $this->get_profile($info,$status);
                        $applicant_fullname = $applicant_profile->firstname.' '.$applicant_profile->mi.' '.$applicant_profile->lastname;
                        $job = $this->get_job_positions($info,$status);
                        $status_code = $this->status_code($info,$status);
                        $approved = $this->approved_by($info->approved_by);
                        $approved_by = $approved->firstname.' '.$approved->mi.' '.$approved->lastname;
                        $image = $this->get_image($info->applicant_id);

                        foreach($job as $jobs )
                        {
                            if($status_code->name == 'Approved')
                            {
                                $color = "text-success";
                            }

                                        $table .= '<tr>
                                        <td><a href"" class="underline decoration-dotted whitespace-nowrap">#' .$applicant_profile->user_id. '</a></td>
                                        <td>' .$applicant_fullname. '  <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5 "> <strong>'. $applicant_profile->email.'</strong></div></td>
                                        <td class="'.$color.'">' .$status_code->name. '</td>
                                        <td class="text-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip dropdown" title="More Action">
                                        <a class="flex justify-center items-center" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa fa-ellipsis-h items-center text-center text-primary"></i> </a>
                                        <div class="dropdown-menu w-40 zoom-in tooltip">
                                            <div class="dropdown-content">
                                            <button id="' .$info->id. '" type="button" class="w-full dropdown-item btn_details_data" data-applicant_id="' .$info->applicant_id. '" data-name="' .$applicant_fullname. '" data-ref-num="' .$info->jobref_no. '" data-job="' .$jobs->pos_title. '" data-agency="' .$jobs->assign_agency. '" data-comments="' .$info->application_note. '" data-status="'.$status_code->name.'"
                                            data-date-approved="'.substr($info->approval_date,0,-8).'" data-date-applied="'.substr($info->created_at,0,-8).'" data-approved="'.$approved_by.'" data-image="'.$image.'"> <i class="fa fa-circle-info text-success"></i><span class="ml-2">Details</span></button>
                                            </div>
                                        </div>
                                    </div>
                                    </td>
                                </tr>';
                        }

                    }
                }
            else if($status == '10')
            {
                foreach($applicant_info as $info)
                {

                    $applicant_profile = $this->get_profile($info,$status);
                     $applicant_fullname = $applicant_profile->firstname.' '.$applicant_profile->mi.' '.$applicant_profile->lastname;
                    $job = $this->get_job_positions($info,$status);
                    $status_code = $this->status_code($info,$status);
                    $approved = $this->approved_by($info->approved_by);
                    $approved_by = $approved->firstname.' '.$approved->mi.' '.$approved->lastname;
                    $image = $this->get_image($info->applicant_id);

                    foreach($job as $jobs )
                    {
                         if($status_code->name == 'Waiting')
                        {
                            $color = "text-pending";
                        }

                        $date = Carbon::createFromFormat('j M, Y',$info->rate_sched)->format('Y-m-d');

                                    $table .= '<tr>
                                    <td><a href"" class="underline decoration-dotted whitespace-nowrap">#' .$applicant_profile->user_id. '</a></td>
                                    <td>' .$applicant_fullname. '  <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5 "> <strong>'. $applicant_profile->email.'</strong></div></td>
                                    <td class="'.$color.'">' .$status_code->name. '</td>
                                    <td class="text-center">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip dropdown" title="More Action">
                                    <a class="flex justify-center items-center" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa fa-ellipsis-h items-center text-center text-primary"></i> </a>
                                    <div class="dropdown-menu w-40 zoom-in tooltip">
                                        <div class="dropdown-content">
                                        <button id="' .$info->id. '" type="button" class="w-full dropdown-item btn_details_data" data-applicant_id="' .$info->applicant_id. '" data-name="' .$applicant_fullname. '" data-ref-num="' .$info->jobref_no. '" data-job="' .$jobs->pos_title. '" data-agency="' .$jobs->assign_agency. '" data-comments="' .$info->notes. '" data-status="'.$status_code->name.'"
                                        data-date-approved="'.substr($info->created_at,0,-8).'" data-date-applied="'.$info->date_applied.'" data-approved="'.$approved_by .'" data-image="'.$image.'" data-rate-sched="'.$info->rate_sched.'" data-stat="'.$info->stat.'" data-shortlisted-id="'.$info->id.'" data-exam="'.$info->exam_result.'"> <i class="fa fa-circle-info text-success"></i><span class="ml-2">Details</span></button>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>';
                    }

                }
            }

            $table.=  '</tbody></table>';
        }

       echo $table;

    }

    private function get_applicant_info($stat)
    {
        if($stat == 10)
        {
            $applicant_info = tbl_shortlisted::with('get_profile_infos','get_job')->where('stat',10)->where('active',true)->orderBy("rate_sched","ASC")->get();
            //  $applicant_info = applicants_list::with('get_profile','get_status_code')->where('applicant_status',10)->where('active',true)->orderBy("approval_date","ASC")->get();
        }
        else if($stat == 11)
        {
            $applicant_info = applicants_list::with('get_profile','get_status_code')->where('applicant_status',11)->where('active',true)->orderBy("approval_date","ASC")->get();
        }
        else
        {
            $applicant_info = applicants_list::with('get_profile','get_status_code')->where('applicant_status',11)->where('active',true)->orderBy("approval_date","ASC")->get();
        }


        return $applicant_info;
    }

    //get the information regarding regarding on the available status
    private function get_profile($get_profile,$status)
    {
        if($status == '11' || $status == null)
        {
            return $get_profile -> get_profile;
        }
        else if($status == '10')
        {
            return $get_profile -> get_profile_infos;
        }
    }

    private function status_code($get_code,$status)
    {
        if($status == '11' || $status == null)
        {
            return $get_code -> get_status_code;
        }
        else if($status == '10')
        {
            return $get_code -> get_stat;
        }

    }

    private function get_job_positions($get_position,$status)
    {
        if($status == '11' || $status == null)
        {
            return $get_position -> get_job_infos;
        }
        else if($status == '10')
        {
            return $get_position -> get_job;
        }
    }

    private function approved_by($id)
    {
        $approved_by = tblemployee::where('user_id',$id)->orWhere('agencyid',$id)->where('active',true)->first();

        return $approved_by;
    }


    // saved the applicant info
    public function appoint_sched(Request $request)
    {
        try
        {
            if($request->isMethod('post'))
            {
                $data = '';
                $id = auth()->user()->employee;

                $data = [
                    "ref_num" => $request->ref_num,
                    "exam_result" => $request->exam,
                    "applicant_id" => $request->ids,
                    "notes" => $request->notes,
                    "date_applied" => $request->applied_date,
                    "rate_sched" => $request->date,
                    "approved_by" => $id,
                    "stat" => $request->stat
                ];

                $saved = tbl_shortlisted::create($data);

                if($saved)
                {
                    return response()->json([
                        'status' => true,
                        'message' => 'Successfully set a schedule for the applicant rating'
                    ]);
                } else
                {
                    return response()->json([
                        'status' => false,
                        'message' => 'Error please try again'
                    ]);
                }
            }
        }
        catch(Exception $e)
        {
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }
    }

    //update the shortlisted applicant
    public function update_shortlisted_applicant(Request $request)
    {
        try
        {
            if($request->isMethod('post'))
            {
                $data = '';

                $data = [
                    "notes" => $request->notes,
                    "rate_sched" => $request->date,
                    "stat" => $request->stat,
                ];

                $update = tbl_shortlisted::where('id',$request->id)->update($data);

                if($update)
                {
                    return response()->json([
                        "status" => true,
                        "message" => "Successfully Updated"
                    ]);
                } else
                {
                    return response()->json([
                        "status" => false,
                        "message" => "Unable to update try again"
                    ]);
                }
            }

        }
        catch(Exception $e)
        {
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);
        }
        $data = '';


    }

    //update the status in the applicant list
    public function update_stat(Request $request)
    {
        try
        {
            if($request->isMethod('post'))
            {
                $data = '';
                $update_stat = '';

                 $data = [
                    'applicant_status' => $request->stat
                ];

                $update_stat = applicants_list::where('id',$request->id)->where('applicant_status','11')->update($data);

                if($update_stat)
                {
                    return response()->json([
                        'status' => true,
                    ]);
                }
            }

        }
        catch(Exception $e)
        {
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);
        }
    }
}
