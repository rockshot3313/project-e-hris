<?php

namespace App\Http\Controllers\ProfileController;

use App\Http\Controllers\Controller;
use App\Models\applicant\applicants_academic_bg;
use App\Models\applicant\applicants_tempfiles;
use App\Models\employee_hr_details;
use App\Models\PDS\pds_address;
use App\Models\PDS\pds_child_list;
use App\Models\PDS\pds_cs_eligibility;
use App\Models\PDS\pds_educational_bg;
use App\Models\PDS\pds_family_bg;
use App\Models\PDS\pds_government_id;
use App\Models\PDS\pds_learning_development;
use App\Models\PDS\pds_other_information;
use App\Models\PDS\pds_references;
use App\Models\PDS\pds_special_skills;
use App\Models\PDS\pds_voluntary_work;
use App\Models\PDS\pds_work_exp;
use App\Models\ref_brgy;
use App\Models\system\default_setting;
use App\Models\tblemployee;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use PDF;
use Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('my_Profile.profile');
    }

    public function load_profile(Request $request)
    {
        $tres = [];
        $user_data = tblemployee::where('user_id', Auth::user()->id)
                                 ->orWhere('agencyid', Auth::user()->employee)
                                 ->get();

        foreach ($user_data as $td) {

            $last_name = $td->lastname;
            $first_name = $td->firstname;
            $mid_name = $td->mi;
            $name_ext = $td->extension;

            $username = Auth::user()->username;

            $dateofbirth = $td->dateofbirth;
            $placeofbirth = $td->placeofbirth;
            $sex = $td->sex;
            $citizenship = $td->citizenship;
            $dual_citizenship_type = $td->dual_citizenship_type;
            $dual_citizenship_country = $td->dual_citizenship_country;

            $civilstatus = $td->civilstatus;
            $height = $td->height;
            $weight = $td->weight;
            $bloodtype = $td->bloodtype;
            $gsis = $td->gsis;
            $pagibig = $td->pagibig;
            $philhealth = $td->philhealth;
            $tin = $td->tin;
            $govissueid = $td->govissueid;
            $telephone = $td->telephone;
            $mobile_number = $td->mobile_number;

            if($td->email)
            {
                $email = $td->email;
            }else
            {
                $email = '';
            }


            if (!$td->image == "")
            {
                $profile_pic = url('') . "/uploads/applicants/" . $td->image;
            }
            else {
                $query = default_setting::where('key', 'agency_logo')->where('active', true)->first();
                $get_image= $query->image;
                $profile_pic = url('') . "/uploads/settings/" . $get_image;

            }

            $td = [
                "last_name" => $last_name,
                "first_name" => $first_name,
                "mid_name" => $mid_name,
                "name_ext" => $name_ext,

                "profile_pic" => $profile_pic,

                "dateofbirth" => $dateofbirth,
                "placeofbirth" => $placeofbirth,
                "sex" => $sex,
                "citizenship" => $citizenship,
                "dual_citizenship_type" => $dual_citizenship_type,
                "dual_citizenship_country" => $dual_citizenship_country,

                "civilstatus" => $civilstatus,
                "height" => $height,
                "weight" => $weight,
                "bloodtype" => $bloodtype,
                "gsis" => $gsis,
                "pagibig" => $pagibig,
                "philhealth" => $philhealth,
                "tin" => $tin,
                "govissueid" => $govissueid,
                "telephone" => $telephone,
                "mobile_number" => $mobile_number,
                "email" => $email,
                "password" => Auth::user()->password,
            ];

            $tres[count($tres)] = $td;
        }
        echo json_encode($tres);
    }

    public function temp_upload_profile_picture(Request $request)
    {
        $get_profile = tblemployee::where('user_id', Auth::user()->id)->first();

        $last_name = $get_profile->lastname;

        if ($request->hasFile('up_profile_pic')) {

            foreach ($request->file('up_profile_pic')as $file )
            {

                $get_file_type = $file->getClientMimeType();
                $explode_file_type = explode("/", $get_file_type);
                $file_type = $explode_file_type[1];

                $fileName = $last_name.'-'.date("YmdHis").'.'.$file_type;
                $folder = $last_name.'-'.uniqid() . '-' . now()->timestamp;
                $file->storeAs('public/tmp/' . $folder,$fileName);

                $destinationPath = 'uploads/applicants/';
                $file->move(public_path($destinationPath), $fileName);

                applicants_tempfiles::create([
                    'folder' => $folder,
                    'filename' => $fileName]);

                return $folder;
            }
        }
        return '';
    }

    public function delete_profile_picture(Request $request){

        $get_doc_path = request()->getContent();

        $splitDocFilePath = explode("<", $get_doc_path);

        $filePath = $splitDocFilePath[0];

        $tmp_file = applicants_tempfiles::where('folder', $filePath)->first();
        if($tmp_file)
        {
            //Remove picture from public/uploads
            $fp = public_path("uploads/applicants") . "\\" . $tmp_file->filename;
            if(file_exists($fp)) {
                unlink($fp);
            }

            Storage::deleteDirectory('public/tmp/' . $tmp_file->folder);
            $tmp_file->delete();

            return response('');
        }
    }

    public function save_profile_picture(Request $request)
    {
        $old_profile_picture = $request->input('current_profile_picture_value');
        $profile_pic = $request->input('up_profile_pic');
        $applicant_id = Auth::user()->id;

        foreach ($profile_pic as $picture)
        {
            $splitDocFilePath = explode("<", $picture);

            $filePath = $splitDocFilePath[0];

            $get_profile_picture = applicants_tempfiles::where('folder', $filePath)->first();

            tblemployee::where('user_id', $applicant_id)->update([
                    'image' => $get_profile_picture->filename,
                ]);

            Storage::deleteDirectory('public/tmp/' . $get_profile_picture->folder);
            applicants_tempfiles::where('folder', $get_profile_picture->folder)->delete();

            //Remove picture from public/uploads
            $get_old_pic = tblemployee::where('user_id', $applicant_id)->where('image', $old_profile_picture)->first();
            if($get_old_pic)
            {
                $fp = public_path("uploads/applicants") . "\\" . $get_old_pic->image;
                if(file_exists($fp)) {
                    unlink($fp);
                }
            }
        }
        return response()->json([
            'status' => 200,
        ]);
    }

    public function load_personal_information(Request $request)
    {
        $hr_details = employee_hr_details::
                        with(['get_user_details'])
                        ->where('employeeid', Auth::user()->employee)
                        ->get();

        foreach ($hr_details as $hr_detail) {

            if($hr_detail->get_user_details)
            {
                $info = $hr_detail->get_user_details;

                $last_name = $info->lastname;
                $first_name = $info->firstname;
                $mid_name = $info->mi;
                $extension = $info->extension;
                $dateofbirth = $info->dateofbirth;
                $civilstatus = $info->civilstatus;
                $religion = $info->religion;
                $spouse = $info->spouse;
                $citizenship = $info->citizenship;
                $first_name = $info->firstname;
            }

        }
    }

    public function load_residential_address(Request $request)
    {
        $tres = [];
        $brgy_code = '';
        $barangay = '';
        $province_code = '';
        $province = '';
        $municipality = '';
        $mun_code = '';

        $residential_address = pds_address::with('get_province', 'get_city_mun', 'get_brgy')
                        ->where('user_id', Auth::user()->id)
                        ->where('address_type', 'RESIDENTIAL')
                        ->where('active',1)->get();

        foreach ($residential_address as $dt) {

            if($dt->get_province)
            {
                $prov = $dt->get_province;

                $province_code = $prov->provCode;
                $province = $prov->provDesc;
            }
            if($dt->get_city_mun)
            {
                $city_mun = $dt->get_city_mun;

                $mun_code = $city_mun->citymunCode;
                $municipality = $city_mun->citymunDesc;
            }
            if($dt->get_brgy)
            {
                $brgy = $dt->get_brgy;
                $brgy_id = $brgy->id;
                $brgy_code = $brgy->brgyCode;
                $barangay = $brgy->brgyDesc;
            }

            $td = [

                "id" => $dt->id,
                "address_type" => $dt->address_type,
                "house_block_no" => $dt->house_block_no,
                "street" => $dt->street,
                "subdivision_village" => $dt->subdivision_village,

                "brgy_code" => $brgy_code,
                "brgy_id" => $brgy_id,
                "brgy" => $barangay,

                "municipality" => $municipality,
                "municipality_code" => $mun_code,

                "province" => $province,
                "province_code" => $province_code,

                "zip_code" => $dt->zip_code,

            ];
            $tres[count($tres)] = $td;

        }

        echo json_encode($tres);
    }

    public function load_permanent_address(Request $request)
    {
        $tres = [];
        $per_brgy_code = '';
        $per_barangay = '';
        $per_province_code = '';
        $per_province = '';
        $per_mun_code = '';
        $per_municipality = '';

        $permanent_address = pds_address::with('get_province', 'get_city_mun', 'get_brgy')
                            ->where('user_id', Auth::user()->id)
                            ->where('address_type', 'PERMANENT')
                            ->where('active',1)->get();

        foreach ($permanent_address as $dt) {

            if($dt->get_province)
            {
                $prov = $dt->get_province;
                $per_province_code = $prov->provCode;
                $per_province = $prov->provDesc;
            }
            if($dt->get_city_mun)
            {
                $city_mun = $dt->get_city_mun;
                $per_mun_code = $city_mun->citymunCode;
                $per_municipality = $city_mun->citymunDesc;
            }
            if($dt->get_brgy)
            {
                $brgy = $dt->get_brgy;
                $per_brgy_code = $brgy->brgyCode;
                $per_barangay = $brgy->brgyDesc;
            }

            $td = [

                "id" => $dt->id,
                "address_type" => $dt->address_type,
                "house_block_no" => $dt->house_block_no,
                "street" => $dt->street,
                "subdivision_village" => $dt->subdivision_village,

                "per_brgy_code" => $per_brgy_code,
                "per_brgy" => $per_barangay,

                "per_municipality" => $per_municipality,
                "per_municipality_code" => $per_mun_code,

                "per_province" => $per_province,
                "per_province_code" => $per_province_code,

                "zip_code" => $dt->zip_code,

            ];
            $tres[count($tres)] = $td;

        }
        echo json_encode($tres);
    }

    public function load_educ_bg(Request $request)
    {
        $educational_list = '';

        $get_academic_bg = pds_educational_bg::where('user_id', Auth::user()->id)
                                            ->where('active', true)
                                            ->get();

        foreach ($get_academic_bg as $index => $acad_bg)
        {

            $acad_id = $acad_bg->id;
            $acad_level = $acad_bg->level;
            $acad_school_name = $acad_bg->school_name;
            $acad_degreee_course = $acad_bg->degreee_course;
            $acad_attendance_from = $acad_bg->attendance_from;
            $acad_attendance_to = $acad_bg->attendance_to;
            $acad_units_earned = $acad_bg->units_earned;
            $acad_year_graduated = $acad_bg->year_graduated;
            $acad_acad_honors = $acad_bg->acad_honors;

            $educational_list .= '<tr class="hover:bg-gray-200">
                                    <td class="hidden"><input type="text" style="display: none; " name="td_educ_bg_id[]" class="form-control" value="'.$acad_id.'">'.$acad_id.'</td>
                                    <td style="text-transform:uppercase"><input type="text" style="display: none; " name="td_educ_bg_level[]" class="form-control" value="'.$acad_level.'">'.$acad_level.'</td>
                                    <td style="text-transform:uppercase"><input type="text" style="display: none; text-transform:uppercase" name="td_educ_school_name[]" class="form-control flex text-center" value="'.$acad_school_name.'">'.$acad_school_name.'</td>
                                    <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_degree_course[]" class="form-control flex text-center" value="'.$acad_degreee_course.'">'.$acad_degreee_course.'</td>
                                    <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_school_from[]" class="form-control flex text-center" value="'.$acad_attendance_from.'">'.$acad_attendance_from.'</td>
                                    <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_school_to[]" class="form-control flex text-center" value="'.$acad_attendance_to.'">'.$acad_attendance_to.'</td>
                                    <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_highest_level_earned[]" class="form-control flex text-center" value="'.$acad_units_earned.'">'.$acad_units_earned.'</td>
                                    <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_educ_year_graduated[]" class="form-control flex text-center" value="'.$acad_year_graduated.'">'.$acad_year_graduated.'</td>
                                    <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_scholarship[]" class="form-control flex text-center" value="'.$acad_acad_honors.'">'.$acad_acad_honors.'</td>
                                    <td >
                                        <div class="flex justify-center items-center">
                                            <a href="javascript:void(0);" class=" text-theme-6 delete_saved_educ_bg text-center" data-acad-id="'.$acad_id.'"><i  class="w-4 h-4 text-danger fa-solid fa-trash">Remove</i></a>
                                        </div>
                                    </td>
                                </tr>';
        }

        return json_encode(array(

            "educational_list" => $educational_list,

        ));
    }

    public function add_educ_bg(Request $request)
    {
        $insert_academic_bg = [
            'applicant_id' => Auth::user()->id,
            'level' => $request->level,
            'school_name' =>  $request->school_name,
            'degree_course' => $request->educ_degree_course,
            'from' => $request->from,
            'to' =>  $request->to,
            'units_earned' => $request->units_earned,
            'year_graduate' =>  $request->year_grad,
            'honors_received' => $request->educ_scholarship,
            'active' => true,
        ];
        applicants_academic_bg::create($insert_academic_bg);

        return response()->json([
            'status' => 200,
        ]);
    }

    public function remove_educ_bg(Request $request)
    {
        applicants_academic_bg::where('applicant_id', $request->applicant_id)->where('id', $request->academic_bg_id)->update([
            'active' => false,
        ]);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function get_family_bg(Request $request)
    {
        $tres = [];
        $child_name = '';
        $child_bdate = '';
        $list_tr = '';
        $child_list_id = '';
        $spouse_surname = '';
        $spouse_firstname = '';
        $spouse_ext = '';
        $spouse_mi = '';
        $father_surname = '';
        $father_firstname = '';
        $father_ext = '';
        $father_mi = '';
        $mother_maidenname = '';
        $mother_surname = '';
        $mother_firstname = '';
        $mother_mi = '';
        $occupation = '';
        $employer_name = '';
        $business_address = '';
        $tel_no = '';

        $get_family_bg = pds_family_bg::with('get_employee_child')
            ->where('user_id', Auth::user()->id)
            ->where('active', true)
            ->get();

        foreach ($get_family_bg as $index => $bg)
        {
            if($bg->get_employee_child()->exists())
            {
                foreach ($bg->get_employee_child as $fam)
                {
                    $child_list_id = $fam->id;
                    $child_name = $fam->name;
                    $child_bdate = $fam->birth_date;

                    $list_tr .= '<tr class="hover:bg-gray-200">
                    <td > <input id="td_input_child_name" name="td_input_child_name[]" type="text" class="form-control" placeholder="Name of Children" value="'.$child_name.'"></td>
                    <td > <input id="td_input_child_bdate" name="td_input_child_bdate[]" type="date" class="form-control pl-12" value="'.$child_bdate.'" ></td>
                    <td><a href="javascript:void(0);" class="flex items-center justify-center text-theme-6 delete_child_list_from_db" data-list-id="'.$child_list_id.'"><i  class="w-4 h-4 mr-1 text-danger fa-solid fa-trash">Remove</i></a></td>
                    </tr>';
                }
            }

            $spouse_surname = $bg->spouse_surname;
            $spouse_firstname = $bg->spouse_firstname;
            $spouse_ext = $bg->spouse_ext;
            $spouse_mi = $bg->spouse_mi;

            $father_surname = $bg->father_surname;
            $father_firstname = $bg->father_firstname;
            $father_ext = $bg->father_ext;
            $father_mi = $bg->father_mi;

            $mother_maidenname = $bg->mother_maidenname;
            $mother_surname = $bg->mother_surname;
            $mother_firstname = $bg->mother_firstname;
            $mother_mi = $bg->mother_mi;

            $occupation = $bg->occupation;
            $employer_name = $bg->employer_name;
            $business_address = $bg->business_address;
            $tel_no = $bg->tel_no;

        }


        return json_encode(array(

            "spouse_surname" => $spouse_surname,
            "spouse_firstname" => $spouse_firstname,
            "spouse_ext" => $spouse_ext,
            "spouse_mi" => $spouse_mi,

            "father_surname" => $father_surname,
            "father_firstname" => $father_firstname,
            "father_ext" => $father_ext,
            "father_mi" =>$father_mi,

            "mother_maidenname" => $mother_maidenname,
            "mother_surname" => $mother_surname,
            "mother_firstname" => $mother_firstname,
            "mother_mi" => $mother_mi,

            "occupation" => $occupation,
            "employer_name" => $employer_name,
            "business_address" => $business_address,
            "tel_no" => $tel_no,

            "child_list_tr" => $list_tr,

        ));

    }

    public function load_civil_service_eligibility(Request $request)
    {
        $cs_eligibility_list = '';

        $get_cs_eligibility = pds_cs_eligibility::where('user_id', Auth::user()->id)
                                    ->where('active', true)
                                    ->get();

        if ($get_cs_eligibility) {
            foreach ($get_cs_eligibility as $index => $cs) {
                $cs_eligibility_id = $cs->id;
                $cs_eligibility_type = $cs->eligibility_type;
                $cs_eligibility_rating = $cs->rating;
                $cs_date_examination = $cs->date_examination;
                $cs_place_examination = $cs->place_examination;
                $cs_license_number = $cs->license_number;
                $cs_license_validity = $cs->license_validity;

                $cs_eligibility_list .= '<tr class="hover:bg-gray-200">
                                        <td style="text-transform:uppercase"><input type="text" style="display: none; " class="form-control" value="' . $cs_eligibility_type . '">' . $cs_eligibility_type . '</td>
                                        <td style="text-transform:uppercase"><input type="text" style="display: none; text-transform:uppercase" class="form-control flex text-center" value="' . $cs_eligibility_rating . '">' . $cs_eligibility_rating . '</td>
                                        <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_degree_course[]" class="form-control flex text-center" value="' . $cs_date_examination . '">' . $cs_date_examination . '</td>
                                        <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_school_from[]" class="form-control flex text-center" value="' . $cs_place_examination . '">' . $cs_place_examination . '</td>
                                        <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_school_to[]" class="form-control flex text-center" value="' . $cs_license_number . '">' . $cs_license_number . '</td>
                                        <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_highest_level_earned[]" class="form-control flex text-center" value="' . $cs_license_validity . '">' . $cs_license_validity . '</td>
                                        <td >
                                            <div class="flex justify-center items-center">

                                                <a href="javascript:void(0);" class=" text-theme-6 delete_saved_cs text-center" data-cs-id="' . $cs_eligibility_id . '"><i  class="w-4 h-4 text-danger fa-solid fa-trash">Remove</i></a>
                                            </div>
                                        </td>
                                    </tr>';
            }
        }

        return json_encode(array(

            "cs_eligibility_list" => $cs_eligibility_list,

        ));
    }

    public function remove_child_family_bg(Request $request)
    {
        $child_list_id = $request->child_list_id;

        pds_child_list::where('id',$child_list_id)->delete();

        return response()->json([
            'status' => 200,
        ]);
    }

    public function remove_academic_bg(Request $request)
    {
        $academic_id = $request->academic_id;

        pds_educational_bg::where('id',$academic_id)->delete();

        return response()->json([
            'status' => 200,
        ]);
    }

    public function update_academic_bg(Request $request)
    {
        pds_educational_bg::where('id', $request->academic_id)->update([

            'user_id'=> Auth::user()->id,
            'level' => $request->acad_level,
            'school_name' => strtoupper($request->school_name),
            'degreee_course' => strtoupper($request->acad_course),
            'attendance_from' => $request->acad_from,
            'attendance_to' => $request->acad_to,
            'units_earned' => strtoupper($request->acad_earned),
            'year_graduated' => $request->acad_graduated,
            'acad_honors' => strtoupper($request->acad_scholar),
            'active' => true,

        ]);
    }

    public function update_cs_eligibility(Request $request)
    {
        pds_cs_eligibility::where('id', $request->cs_id)->update([

            'user_id'=> Auth::user()->id,
            'eligibility_type' => $request->cs_eligibility_type,
            'rating' => strtoupper($request->cs_rating),
            'date_examination' => strtoupper($request->cs_date_exam),
            'place_examination' => $request->cs_place_exam,
            'license_number' => $request->cs_license_number,
            'license_validity' => strtoupper($request->cs_license_validity),
            'active' => true,

        ]);
    }

    public function remove_cs(Request $request)
    {
        $cs_id = $request->cs_id;

        pds_cs_eligibility::where('id',$cs_id)->delete();

        return response()->json([
            'status' => 200,
        ]);
    }

    public function load_work_experience(Request $request)
    {
        $work_exp_list = '';

        $get_work_exp = pds_work_exp::where('user_id', Auth::user()->id)
            ->where('active', true)
            ->get();

        if ($get_work_exp) {
            foreach ($get_work_exp as $index => $exp)
            {

                $exp_id = $exp->id;
                $exp_from = $exp->from;
                $exp_to = $exp->to;
                $exp_position_title = $exp->position_title;
                $exp_dept_agency_office = $exp->dept_agency_office;
                $exp_monthly_sal = $exp->monthly_sal;
                $exp_sal_grade = $exp->sal_grade;
                $exp_appointment_status = $exp->appointment_status;
                $exp_gvt_service = $exp->gvt_service;

                    $work_exp_list .= '<tr class="hover:bg-gray-200">
                                            <td style="text-transform:uppercase"><input type="text" style="display: none; " class="form-control" value="' . $exp_from . '">' . $exp_from . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none; text-transform:uppercase" class="form-control flex text-center" value="' . $exp_to . '">' . $exp_to . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_degree_course[]" class="form-control flex text-center" value="' . $exp_position_title . '">' . $exp_position_title . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_school_from[]" class="form-control flex text-center" value="' . $exp_dept_agency_office . '">' . $exp_dept_agency_office . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_school_to[]" class="form-control flex text-center" value="' . $exp_monthly_sal . '">' . $exp_monthly_sal . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_highest_level_earned[]" class="form-control flex text-center" value="' . $exp_sal_grade . '">' . $exp_sal_grade . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_highest_level_earned[]" class="form-control flex text-center" value="' . $exp_appointment_status . '">' . $exp_appointment_status . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_highest_level_earned[]" class="form-control flex text-center" value="' . $exp_gvt_service . '">' . $exp_gvt_service . '</td>
                                            <td >
                                                <div class="flex justify-center items-center">

                                                    <a href="javascript:void(0);" class=" text-theme-6 delete_work_exp text-center" data-exp-id="' . $exp_id . '"><i  class="w-4 h-4 text-danger fa-solid fa-trash">Remove</i></a>
                                                </div>
                                            </td>
                                        </tr>';
            }
        }

        return json_encode(array(

            "work_exp_list" => $work_exp_list,

        ));
    }

    public function update_work_experience(Request $request)
    {
         pds_work_exp::where('id', $request->work_exp_id)->update([
             'user_id'=> Auth::user()->id,
             'from' => $request->work_exp_date_from,
             'to' => $request->work_exp_date_to,
             'position_title' => strtoupper($request->work_exp_pos_title,),
             'dept_agency_office' => strtoupper($request->work_exp_dept_agency,),
             'monthly_sal' => $request->work_exp_sal,
             'sal_grade' => $request->work_exp_sg,
             'appointment_status' => strtoupper($request->work_exp_status,),
             'gvt_service' => strtoupper($request->work_exp_govt_service,),
             'active' => true,

         ]);
    }

    public function remove_work_exp(Request $request)
    {
        $work_exp_id = $request->work_exp_id;

        pds_work_exp::where('id',$work_exp_id)->delete();

        return response()->json([
            'status' => 200,
        ]);
    }

    public function load_voluntary_work(Request $request)
    {
        $vol_work_list = '';

        $get_vol_work = pds_voluntary_work::where('user_id', Auth::user()->id)
            ->where('active', true)
            ->get();

        if ($get_vol_work) {
            foreach ($get_vol_work as $index => $vol)
            {
                $vol_id = $vol->id;
                $vol_org_name = $vol->org_name_address;
                $vol_from = $vol->from;
                $vol_to = $vol->to;
                $vol_hours_number = $vol->hours_number;
                $vol_work_position_nature = $vol->work_position_nature;

                $vol_work_list .= '<tr class="hover:bg-gray-200">
                                            <td style="text-transform:uppercase"><input type="text" style="display: none; " class="form-control" value="' . $vol_org_name . '">' . $vol_org_name . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none; text-transform:uppercase" class="form-control flex text-center" value="' . $vol_from . '">' . $vol_from . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_degree_course[]" class="form-control flex text-center" value="' . $vol_to . '">' . $vol_to . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_school_from[]" class="form-control flex text-center" value="' . $vol_hours_number . '">' . $vol_hours_number . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none" name="td_educ_school_to[]" class="form-control flex text-center" value="' . $vol_work_position_nature . '">' . $vol_work_position_nature . '</td>
                                            <td >
                                                <div class="flex justify-center items-center">

                                                    <a href="javascript:void(0);" class=" text-theme-6 delete_vol_work text-center" data-vol-id="' . $vol_id . '"><i  class="w-4 h-4 text-danger fa-solid fa-trash">Remove</i></a>
                                                </div>
                                            </td>
                                        </tr>';
            }
        }

        return json_encode(array(

            "vol_work_list" => $vol_work_list,

        ));
    }

    public function update_vol_work(Request $request)
    {
        pds_voluntary_work::where('id', $request->vol_work_id)->update([

            'user_id'=> Auth::user()->id,
            'org_name_address' => strtoupper($request->vol_work_org_name),
            'from' => $request->vol_work_date_from,
            'to' => $request->vol_work_date_to,
            'hours_number' => $request->vol_work_hr_number,
            'work_position_nature' => strtoupper($request->vol_work_nature),
            'active' => true,

        ]);
    }

    public function remove_voluntary_work(Request $request)
    {
        $vol_work_id = $request->vol_work_id;

        pds_voluntary_work::where('id',$vol_work_id)->delete();

        return response()->json([
            'status' => 200,
        ]);
    }

    public function load_learning_development(Request $request)
    {
        $ld_list = '';

        $get_ld = pds_learning_development::where('user_id', Auth::user()->id)
            ->where('active', true)
            ->get();

        if ($get_ld) {
            foreach ($get_ld as $index => $ld)
            {
                $ld_id = $ld->id;
                $ld_learning_dev_title = $ld->learning_dev_title;
                $ld_from = $ld->from;
                $ld_to = $ld->to;
                $ld_hours_number = $ld->hours_number;
                $ld_learning_dev_type = $ld->learning_dev_type;
                $ld_conducted_sponsored = $ld->conducted_sponsored;


                $ld_list .= '<tr class="hover:bg-gray-200">
                                            <td style="text-transform:uppercase"><input type="text" style="display: none; " class="form-control" value="' . $ld_learning_dev_title . '">' . $ld_learning_dev_title . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none; text-transform:uppercase" class="form-control flex text-center" value="' . $ld_from . '">' . $ld_from . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none" class="form-control flex text-center" value="' . $ld_to . '">' . $ld_to . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none" class="form-control flex text-center" value="' . $ld_hours_number . '">' . $ld_hours_number . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none" class="form-control flex text-center" value="' . $ld_learning_dev_type . '">' . $ld_learning_dev_type . '</td>
                                              <td style="text-transform:uppercase"><input type="text" style="display: none" class="form-control flex text-center" value="' . $ld_conducted_sponsored . '">' . $ld_conducted_sponsored . '</td>
                                            <td >
                                                <div class="flex justify-center items-center">

                                                    <a href="javascript:void(0);" class=" text-theme-6 delete_ld text-center" data-ld-id="' . $ld_id . '"><i  class="w-4 h-4 text-danger fa-solid fa-trash">Remove</i></a>
                                                </div>
                                            </td>
                                        </tr>';
            }
        }

        return json_encode(array(

            "ld_list" => $ld_list,

        ));
    }

    public function remove_learning_development(Request $request)
    {
        $ld_id = $request->ld_id;

        pds_learning_development::where('id',$ld_id)->delete();

        return response()->json([
            'status' => 200,
        ]);
    }

    public function load_special_skills(Request $request)
    {
        $special_skill_list = '';

        $get_special_skills = pds_special_skills::where('user_id', Auth::user()->id)
            ->where('active', true)
            ->get();

        if ($get_special_skills) {
            foreach ($get_special_skills as $index => $skill)
            {
                $skill_id = $skill->id;
                $skill_special_skills = $skill->special_skills;
                $skill_distinctions = $skill->distinctions;
                $skill_org_membership = $skill->org_membership;

                $special_skill_list .= '<tr class="hover:bg-gray-200">
                                            <td style="text-transform:uppercase"><input type="text" style="display: none; " class="form-control" value="' . $skill_special_skills . '">' . $skill_special_skills . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none; text-transform:uppercase" class="form-control flex text-center" value="' . $skill_distinctions . '">' . $skill_distinctions . '</td>
                                            <td style="text-transform:uppercase"><input type="text" style="display: none" class="form-control flex text-center" value="' . $skill_org_membership . '">' . $skill_org_membership . '</td>
                                            <td >
                                                <div class="flex justify-center items-center">

                                                    <a href="javascript:void(0);" class=" text-theme-6 delete_special_skills text-center" data-skill-id="' . $skill_id . '"><i  class="w-4 h-4 text-danger fa-solid fa-trash">Remove</i></a>
                                                </div>
                                            </td>
                                        </tr>';
            }
        }

        return json_encode(array(

            "special_skill_list" => $special_skill_list,

        ));
    }

    public function remove_special_skills(Request $request)
    {
        $skill_id = $request->skill_id;

        pds_special_skills::where('id',$skill_id)->delete();

        return response()->json([
            'status' => 200,
        ]);
    }

    public function load_other_information(Request $request)
    {
        $tres = [];

        $other_infos = pds_other_information::where('user_id', Auth::user()->id)->where('active',1)->get();

        foreach ($other_infos as $dt) {

            $td = [

                "id" => $dt->id,
                "other_info_34_a" => $dt->other_info_34_a,
                "other_info_34_b" => $dt->other_info_34_b,
                "other_info_34_b_details" => $dt->other_info_34_b_details,

                "other_info_35_a" => $dt->other_info_35_a,
                "other_info_35_a_details" => $dt->other_info_35_a_details,
                "other_info_35_b" => $dt->other_info_35_b,
                "other_info_35_b_details" => $dt->other_info_35_b_details,
                "other_info_35_b_date_filed" => $dt->other_info_35_b_date_filed,
                "other_info_35_b_status" => $dt->other_info_35_b_status,

                "other_info_36" => $dt->other_info_36,
                "other_info_36_details" => $dt->other_info_36_details,

                "other_info_37" => $dt->other_info_37,
                "other_info_37_details" => $dt->other_info_37_details,

                "other_info_38_a" => $dt->other_info_38_a,
                "other_info_38_a_details" => $dt->other_info_38_a_details,

                "other_info_38_b" => $dt->other_info_38_b,
                "other_info_38_b_details" => $dt->other_info_38_b_details,

                "other_info_39" => $dt->other_info_39,
                "other_info_39_details" => $dt->other_info_39_details,

                "other_info_40_a" => $dt->other_info_40_a,
                "other_info_40_a_details" => $dt->other_info_40_a_details,

                "other_info_40_b" => $dt->other_info_40_b,
                "other_info_40_b_details" => $dt->other_info_40_b_details,

                "other_info_40_c" => $dt->other_info_40_c,
                "other_info_40_c_details" => $dt->other_info_40_c_details,

            ];
            $tres[count($tres)] = $td;

        }

        //dd($fullname);
        echo json_encode($tres);
    }

    public function load_reference_info(Request $request)
    {
        $reference_list = '';

        $references = pds_references::where('user_id', Auth::user()->id)->where('active',1)->get();

        foreach ($references as $dt) {

            $reference_id = $dt->id;
            $name = $dt->name;
            $address = $dt->address;
            $tel_no = $dt->tel_no;

            $reference_list .=
                '<tr class="hover:bg-gray-200">
                    <td style="text-transform:uppercase"><input type="text" style="display: none; " class="form-control" value="' . $name . '">' . $name . '</td>
                    <td style="text-transform:uppercase"><input type="text" style="display: none; text-transform:uppercase" class="form-control flex text-center" value="' . $address . '">' . $address . '</td>
                    <td style="text-transform:uppercase"><input type="text" style="display: none" class="form-control flex text-center" value="' . $tel_no . '">' . $tel_no . '</td>
                    <td >
                        <div class="flex justify-center items-center">
                            <a href="javascript:void(0);" class=" text-theme-6 delete_references text-center" data-ref-id="' . $reference_id . '"><i  class="w-4 h-4 text-danger fa-solid fa-trash">Remove</i></a>
                        </div>
                    </td>
                </tr>';

        }

        return json_encode(array(

            "reference_list" => $reference_list,

        ));
    }

    public function load_government_id(Request $request)
    {
        $tres = [];

        $government_id = pds_government_id::where('user_id', Auth::user()->id)->where('active', true)->get();

        foreach ($government_id as $id)
        {
            $td = [

                "gvt_issued_id" => $id->gvt_issued_id,
                "id_license_passport_no" => $id->id_license_passport_no,
                "date_place_issuance" => $id->date_place_issuance,
            ];

            $tres[count($tres)] = $td;
        }
        echo json_encode($tres);
    }

    public function remove_references(Request $request)
    {
        $reference_id = $request->reference_id;

        pds_references::where('id',$reference_id)->delete();

        return response()->json([
            'status' => 200,
        ]);
    }

    public function save_pds(Request $request)
    {

        /* BEGIN::  PERSONAL INFO HERE  */
        tblemployee::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'agencyid' => Auth::user()->employee,
            ],

            [
                'user_id' => Auth::user()->id,
                'agencyid' => Auth::user()->employee,
                'lastname' => strtoupper($request->profile_last_name),
                'firstname' => strtoupper($request->profile_first_name),
                'mi' => strtoupper($request->profile_mid_name),
                'extension' => strtoupper($request->profile_name_extension),
                'dateofbirth' => $request->profile_date_birth,
                'placeofbirth' => strtoupper($request->profile_place_birth),
                'sex' => $request->application_gender,
                'citizenship' => $request->citizenship_value,
                'dual_citizenship_type' => strtoupper($request->citizenship_type_value),
                'dual_citizenship_country' => strtoupper($request->citizenship_country),
                'civilstatus' => $request->profile_civil_status,
                'height' => $request->profile_height,
                'weight' => $request->profile_weight,
                'bloodtype' => strtoupper($request->profile_blood_type),
                'gsis' => strtoupper($request->profile_gsis),
                'pagibig' => strtoupper($request->profile_pagibig),
                'philhealth' => strtoupper($request->profile_philhealth),
                'tin' => strtoupper($request->profile_tin),
                'govissueid' => strtoupper($request->profile_agency),
                'telephone' => $request->profile_tel_number,
                'mobile_number' => $request->profile_mobile_number,
                'email' => $request->profile_email,
                'active' => true,
            ]
        );
        /* END::  PERSONAL INFO HERE  */


        /* BEGIN::  MY ADDRESS HERE  */
        if ($request->res_address_type) {
            pds_address::updateOrCreate(
                [
                    'user_id' => Auth::user()->id,
                    'address_type' => $request->res_address_type,
                ],

                [
                    'user_id' => Auth::user()->id,
                    'address_type' => strtoupper($request->res_address_type),
                    'house_block_no' => strtoupper($request->res_house_block),
                    'street' => strtoupper($request->res_street),
                    'subdivision_village' => strtoupper($request->res_sub),
                    'brgy' => strtoupper($request->res_bgry),
                    'city_mun' => strtoupper($request->res_city_mun),
                    'province' => strtoupper($request->res_province),
                    'zip_code' => $request->res_zip_code,
                    'active' => true,
                ]
            );
        }
        if ($request->per_address_type)
        {
            pds_address::updateOrCreate(
                [
                    'user_id'=> Auth::user()->id,
                    'address_type' => $request->per_address_type,
                ],

                [
                    'user_id'=> Auth::user()->id,
                    'address_type' => strtoupper($request->per_address_type),
                    'house_block_no' => strtoupper($request->per_house_block),
                    'street' => strtoupper($request->per_street),
                    'subdivision_village' => strtoupper($request->per_sub),
                    'brgy' => strtoupper($request->per_bgry),
                    'city_mun' => strtoupper($request->per_city_mun),
                    'province' => strtoupper($request->per_province),
                    'zip_code' => $request->per_zip_code,
                    'active' => true,
                ]
            );
        }
        /* END::  MY ADDRESS HERE  */

        /* BEGIN::  Family Background Here  */
        $family_bg_pk = [
            'user_id' => Auth::user()->id,
        ];

        pds_family_bg::query()->updateOrCreate($family_bg_pk,

            array_filter([
                'spouse_surname' => strtoupper($request->spouse_surname),
                'spouse_firstname' => strtoupper($request->spouse_firstname),
                'spouse_ext' => strtoupper($request->spouse_name_ext),
                'spouse_mi' => strtoupper($request->spouse_mid_name),

                'father_surname' => strtoupper($request->fam_father_surname),
                'father_firstname' =>  strtoupper($request->fam_father_first_name),
                'father_ext' =>  strtoupper($request->fam_father_name_ext),
                'father_mi' => strtoupper($request->fam_father_mid_name),

                'mother_maidenname' =>  strtoupper($request->fam_mother_maiden_name),
                'mother_surname' => strtoupper($request->fam_mother_surname),
                'mother_firstname' =>  strtoupper($request->fam_mother_first_name),
                'mother_mi' => strtoupper($request->fam_mother_mid_name),

                'occupation' =>  strtoupper($request->spouse_occupation),
                'employer_name' => strtoupper($request->occupation_employer),
                'business_address' =>  strtoupper($request->occupation_address),
                'tel_no' => $request->occupation_tel_no,
                'active' => true,
            ]));

        if ($request->td_input_child_name)
        {
            foreach ($request->td_input_child_name as $list_index => $child)
            {
                $child_name = strtoupper($child);

                $child_list = pds_child_list::updateOrCreate(
                    [
                        'name' => $child_name,
                        'user_id'=> Auth::user()->id,
                        'birth_date'=> $request->td_input_child_bdate[$list_index],
                    ],

                    [
                        'user_id'=> Auth::user()->id,
                        'name'=> $child_name,
                        'birth_date'=> $request->td_input_child_bdate[$list_index],
                        'active' => true,
                    ]
                );
            }
        }
        /* END:: Family Background Here  */


        /* BEGIN:: Educational Background Here  */
        if ($request->td_educ_bg_level)
        {
            foreach ($request->td_educ_bg_level as $list_index => $educ)
            {
                $educ_level = $educ;

                pds_educational_bg::updateOrCreate(
                    [
                        'user_id'=> Auth::user()->id,
                        'level' => strtoupper($educ_level),
                        'school_name' => strtoupper($request->td_educ_school_name[$list_index]),
                        'degreee_course' => strtoupper($request->td_educ_degree_course[$list_index]),
                        'attendance_from' => $request->td_educ_school_from[$list_index],
                        'attendance_to' => $request->td_educ_school_to[$list_index],
                        'units_earned' => strtoupper($request->td_educ_highest_level_earned[$list_index]),
                        'year_graduated' => $request->td_educ_educ_year_graduated[$list_index],
                        'acad_honors' => strtoupper($request->td_educ_scholarship[$list_index]),
                    ],

                    [
                        'user_id'=> Auth::user()->id,
                        'level' => strtoupper($educ_level),
                        'school_name' => strtoupper($request->td_educ_school_name[$list_index]),
                        'degreee_course' => strtoupper($request->td_educ_degree_course[$list_index]),
                        'attendance_from' => $request->td_educ_school_from[$list_index],
                        'attendance_to' => $request->td_educ_school_to[$list_index],
                        'units_earned' => strtoupper($request->td_educ_highest_level_earned[$list_index]),
                        'year_graduated' => $request->td_educ_educ_year_graduated[$list_index],
                        'acad_honors' => strtoupper($request->td_educ_scholarship[$list_index]),
                        'active' => true,
                    ]
                );
            }
        }
        /* END:: Educational Background Here  */

        /* BEGIN:: Civil Service Eligibility */
        if($request->td_cs_type)
        {
            foreach ($request->td_cs_type as $list_index => $cs)
            {
                $eligibility_type = strtoupper($cs);

                pds_cs_eligibility::updateOrCreate(
                    [
                        'user_id'=> Auth::user()->id,
                        'eligibility_type' => $eligibility_type,
                    ],

                    [
                        'user_id'=> Auth::user()->id,
                        'eligibility_type' => $eligibility_type,
                        'rating' => strtoupper($request->td_cs_rating[$list_index]),
                        'date_examination' => $request->td_cs_date_exam[$list_index],
                        'place_examination' => strtoupper($request->td_cs_place_exam[$list_index]),
                        'license_number' => strtoupper($request->td_cs_license_number[$list_index]),
                        'license_validity' => $request->td_cs_date_validity[$list_index],
                        'active' => true,
                    ]
                );
            }
        }
        /* END:: Civil Service Eligibility */

        /* BEGIN:: Work Experience */
        if($request->td_worK_exp_from)
        {
            foreach ($request->td_worK_exp_from as $list_index => $work_exp)
            {
                $work_exp_from = strtoupper($work_exp);

                pds_work_exp::updateOrCreate(
                    [
                        'user_id'=> Auth::user()->id,
                        'position_title' => $request->td_worK_exp_pos[$list_index],
                        'dept_agency_office' => strtoupper($request->td_worK_exp_agency[$list_index]),
                    ],

                    [
                        'user_id'=> Auth::user()->id,
                        'from' => $work_exp_from,
                        'to' => $request->td_worK_exp_to[$list_index],
                        'position_title' => strtoupper($request->td_worK_exp_pos[$list_index]),
                        'dept_agency_office' => strtoupper($request->td_worK_exp_agency[$list_index]),
                        'monthly_sal' => $request->td_worK_exp_sal[$list_index],
                        'sal_grade' => strtoupper($request->td_worK_exp_sg[$list_index]),
                        'appointment_status' => strtoupper($request->td_worK_exp_status[$list_index]),
                        'gvt_service' => strtoupper($request->td_worK_exp_service_type[$list_index]),
                        'active' => true,
                    ]
                );
            }
        }
        /* END:: Work Experience */

        /* BEGIN:: Voluntary Work or Involvement in Civic / Non-Government / People / Voluntary Organization/s */
        if($request->td_vol_work_name)
        {
            foreach ($request->td_vol_work_name as $list_index => $vol_work)
            {
                $vol_work_name = strtoupper($vol_work);

                pds_voluntary_work::updateOrCreate(
                    [
                        'user_id'=> Auth::user()->id,
                        'org_name_address' => $vol_work_name,
                    ],

                    [
                        'user_id'=> Auth::user()->id,
                        'org_name_address' => strtoupper($request->td_vol_work_name[$list_index]),
                        'from' => $request->td_vol_work_from[$list_index],
                        'to' => $request->td_vol_work_to[$list_index],
                        'hours_number' => $request->td_vol_work_hr_number[$list_index],
                        'work_position_nature' => strtoupper($request->td_vol_work_nature[$list_index]),
                        'active' => true,
                    ]
                );
            }
        }
        /* END::  Voluntary Work or Involvement in Civic / Non-Government / People / Voluntary Organization/s */

        /* BEGIN:: VII.  LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED */
        if($request->td_ld_title)
        {
            foreach ($request->td_ld_title as $list_index => $ld)
            {
                $ld_title = strtoupper($ld);

                pds_learning_development::updateOrCreate(
                    [
                        'user_id'=> Auth::user()->id,
                        'learning_dev_title' => $ld_title,
                        'from' => $request->td_ld_date_from[$list_index],
                        'to' => $request->td_ld_date_to[$list_index],
                    ],

                    [
                        'user_id'=> Auth::user()->id,
                        'learning_dev_title' => $ld_title,
                        'from' => $request->td_ld_date_from[$list_index],
                        'to' => $request->td_ld_date_to[$list_index],
                        'hours_number' => $request->td_ld_hr_number[$list_index],
                        'learning_dev_type' => strtoupper($request->td_ld_type[$list_index]),
                        'conducted_sponsored' => strtoupper($request->td_ld_sponsor[$list_index]),
                        'active' => true,
                    ]
                );
            }
        }
        /* END::  VII.  LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED */

        /* BEGIN:: VIII.  OTHER INFORMATION */
        if($request->td_special_skills)
        {
            foreach ($request->td_special_skills as $list_index => $skills)
            {
                $special_skills = strtoupper($skills);

                pds_special_skills::updateOrCreate(
                    [
                        'user_id'=> Auth::user()->id,
                        'special_skills' => $special_skills,
                        'org_membership' => $request->td_others_membership[$list_index],
                    ],

                    [
                        'user_id'=> Auth::user()->id,
                        'special_skills' => strtoupper($special_skills),
                        'distinctions' => strtoupper($request-> td_others_distinction[$list_index]),
                        'org_membership' => strtoupper($request->td_others_membership[$list_index]),
                        'active' => true,
                    ]
                );
            }
        }
        /* END::  VIII.  OTHER INFORMATION */

        /* BEGIN:: VIII.  OTHER INFORMATION NUMBER 34-40*/
        if($request->_token)
        {
            pds_other_information::updateOrCreate(
                [
                    'user_id'=> Auth::user()->id,
                ],

                [
                    'user_id'=> Auth::user()->id,
                    'other_info_34_a' => $request->cb_34_a,
                    'other_info_34_b' => $request->cb_34_b,
                    'other_info_34_b_details' => $request->others_34_b_yes,

                    'other_info_35_a' => $request->cb_35_a,
                    'other_info_35_a_details' => $request->others_35_a_yes,

                    'other_info_35_b' => $request->cb_35_b,
                    'other_info_35_b_details' => $request->others_35_b_yes,
                    'other_info_35_b_date_filed' => $request->others_35_b_date_filed,
                    'other_info_35_b_status' => $request->others_35_b_status_case,

                    'other_info_36' => $request->cb_36,
                    'other_info_36_details' => $request->others_36_yes,

                    'other_info_37' => $request->cb_37,
                    'other_info_37_details' => $request->others_37_yes,

                    'other_info_38_a' => $request->cb_38_a,
                    'other_info_38_a_details' => $request->others_38_a_yes,

                    'other_info_38_b' => $request->cb_38_b,
                    'other_info_38_b_details' => $request->others_38_b_yes,

                    'other_info_39' => $request->cb_39,
                    'other_info_39_details' => $request->others_39_yes,

                    'other_info_40_a' => $request->cb_40_a,
                    'other_info_40_a_details' => $request->others_40_a_yes,

                    'other_info_40_b' => $request->cb_40_b,
                    'other_info_40_b_details' => $request->others_40_b_yes,

                    'other_info_40_c' => $request->cb_40_c,
                    'other_info_40_c_details' => $request->others_40_c_yes,
                    'active'  => true,
                ]
            );
        }
        /* END::  VIII.  OTHER INFORMATION NUMBER 34-40*/

        /*BEGIN:: REFERENCES*/
        if($request->td_ref_full_name)
        {
            foreach ($request->td_ref_full_name as $list_index => $ref_name)
            {
                pds_references::updateOrCreate(
                    [
                        'user_id' => Auth::user()->id,
                        'name'=> strtoupper($ref_name),
                        'address'=> strtoupper($request->td_ref_address[$list_index]),
                    ],

                    [
                        'user_id' => Auth::user()->id,
                        'name'=> strtoupper($ref_name),
                        'address'=> strtoupper($request->td_ref_address[$list_index]),
                        'tel_no'=> $request->td_ref_tel_no[$list_index],
                        'active'  => true,
                    ]
                );
            }
        }
        /*BEGIN:: REFERENCES*/

        if($request->government_id)
        {
            pds_government_id::updateOrCreate(
                [
                    'user_id'=> Auth::user()->id,
                ],

                [
                    'user_id'=> Auth::user()->id,
                    'gvt_issued_id'=> $request->government_id,
                    'id_license_passport_no'=> strtoupper($request->government_license_no),
                    'date_place_issuance'=> strtoupper($request->government_license_issuance),
                    'active'  => true,
                ]
            );
        }

        return response()->json([
            'status' => 200,
        ]);
    }

    public function print_pds($user_id)
    {

        $_user_id = Crypt::decrypt($user_id);

        if ($user_id)
        {
            $pds = tblemployee::with(['res_address','per_address','family_bg'])
                ->where('user_id', $_user_id)
                ->orWhere('agencyid', $_user_id)
                ->first();
        }else
        {
            $pds = tblemployee::with(['res_address','per_address','family_bg'])
                ->where('user_id', Auth::user()->id)
                ->orWhere('agencyid', Auth::user()->employee)
                ->first();
        }

        $filename = $pds->lastname.'_'.$pds->firstname.'_'.'PDS';

        $res_address = pds_address::with(['get_brgy', 'get_province', 'get_city_mun'])->where('address_type', 'RESIDENTIAL')->where('user_id', $_user_id)->where('active', 1)->first();
        $per_address = pds_address::with(['get_brgy', 'get_province', 'get_city_mun'])->where('address_type', 'PERMANENT')->where('user_id', $_user_id)->where('active', 1)->first();

        $elementary = pds_educational_bg::where('user_id', $_user_id)->where('level', 'ELEMENTARY')->first();
        $secondary = pds_educational_bg::where('user_id', $_user_id)->where('level', 'SECONDARY')->first();
        $vocational = pds_educational_bg::where('user_id', $_user_id)->where('level', 'VOCATIONAL_TRADE_COURSE')->first();
        $college = pds_educational_bg::where('user_id', $_user_id)->where('level', 'COLLEGE')->first();
        $masters = pds_educational_bg::where('user_id', $_user_id)->where('level', 'GRADUATE_STUDIES')->first();


        $educational_background = pds_educational_bg::where('user_id', $_user_id)->where('active', true)->get();

        $civil_service = pds_cs_eligibility::where('user_id', $_user_id)->where('active', true)->skip(0)->take(7)->get();

        $work_experience = pds_work_exp::where('user_id', $_user_id)->where('active', true)->skip(0)->take(22)->get();

        $voluntary_work = pds_voluntary_work::where('user_id', $_user_id)->where('active', true)->skip(0)->take(5)->get();

        $learning_dev = pds_learning_development::where('user_id', $_user_id)->where('active', true)->skip(0)->take(21)->get();

        $special_skills = pds_special_skills::where('user_id', $_user_id)->where('active', true)->skip(0)->take(7)->get();

        $other_info = pds_other_information::where('user_id', $_user_id)->where('active', true)->first();

        $references = pds_references::where('user_id', $_user_id)->where('active', true)->skip(0)->take(3)->latest('id')->get();

        $child = pds_child_list::where('user_id', $_user_id)->where('active', true)->get();

        $government_id = pds_government_id::where('user_id', $_user_id)->where('active', true)->first();

        $image = url('') . "/uploads/applicants/" . $pds->image;

//        $profile_picture = 'src="'.$image.'"';

        $long_BondPaper =  array(0, 0, 612.00, 936.0);

        $pdf = PDF::loadView('my_Profile.PDS.print_pds',
            compact(
                'filename','pds',
                'child',
                'image',
                'res_address',
                'per_address',
                'educational_background',
                'elementary','secondary','vocational','college', 'masters',

                'civil_service',
                'work_experience',
                'voluntary_work',
                'learning_dev',
                'special_skills',
                'other_info',
                'references',
                'government_id',


            ))->setPaper($long_BondPaper);

        return $pdf->stream($filename . '.pdf');
    }

    public function get_ref_brgy(Request $request)
    {

        if($request->res_municipality_code)
        {
            $municipality_code = $request->res_municipality_code;
            $this->_query_ref_brgy($municipality_code);

        }elseif ($request->per_city_mun_code)
        {
            $municipality_code = $request->per_city_mun_code;
            $this->_query_ref_brgy($municipality_code);
        }
    }

    public function _query_ref_brgy($municipality_code)
    {

        $tres = [];
        $option_val = '';

        $get_brgy = ref_brgy::where('citymunCode', $municipality_code)->get();

        if($get_brgy)
        {
            foreach ($get_brgy as $brgy)
            {
                $brgy_id = $brgy->brgyCode;
                $brgy_ = $brgy->brgyDesc;

                $option_val .= '<option value="'.$brgy->brgyCode.'">'.$brgy->brgyDesc.'</option>';

                $td = [
                    "brgy_id" => $brgy_id,
                    "brgy_" => $brgy_,
                ];

                $tres[count($tres)] = $td;
            }
            echo json_encode($tres);
        }
    }
}
