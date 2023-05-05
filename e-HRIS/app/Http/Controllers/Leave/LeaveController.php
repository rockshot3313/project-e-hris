<?php

namespace App\Http\Controllers\Leave;
use App\Models\tblposition;
use App\Models\tblemployee;
use App\Models\Leave\leave_type;
use App\Models\Leave\employee_leave_available;
use App\Models\Leave\employee_hr_details;
use App\Models\Leave\agency_employees;
use App\Models\Leave\leave_submitted;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class LeaveController extends Controller
{


public function index(){
    $load_employee_hr_details = tblemployee::all();
    $tblemployee_count = tblemployee::count();
    $load_leave_type = leave_type::all();

    return view('leave.dashboard', compact('tblemployee_count','load_employee_hr_details','load_leave_type'));
    
}

public function my_leave(){

    $load_employee_hr_details = tblemployee::all();



   return view('leave.myleave', compact('load_employee_hr_details'));

    
}

//Start  load leave type function
public function load_leave_type(Request $request){
    
    $data = $request->all();
    
    $get_leave_type = [];

    $load_leave_type = leave_type::all();


    foreach ($load_leave_type as $dt) {

        $td = [

            "id" => $dt->id,
            "typename" => $dt->typename,
            "category" => $dt->category,
            "qualifygender" => $dt->qualifygender,
            "numberofleaves" => $dt->numberofleaves,
            "long_name" => $dt->long_name,
            "leave_cat" => $dt ->leave_cat,


        ];
        $get_leave_type[count($get_leave_type)] = $td;


    }
    
    echo json_encode($get_leave_type);
    

}
//End load leave type function


//Start store leave type function
public function store_leave_type(Request $request){
    
    $data = $request->all();

    $add_leave_type = [
       
        'username' => $request-> username,
        'typename' => $request-> typename,
        'category' => $request -> category,
        'qualifygender'=> $request-> qualifygender,
        'numberofleaves' => $request-> numberofleaves,
        'active' =>  1,
        'leave_cat' => $request-> leave_cat,
        'long_name' => $request -> long_name,
      
    
    ];

    leave_type::create($add_leave_type);
    __notification_set(1,'Success','Leave Type Successfuly Added!');
  
    return json_encode(array(
        "data"=>$data,
    ));
    
}
//End store leave type function


//Start edit leave type function
public function edit_leave_type($id){

    $data = leave_type::find($id);

    return response()->json($data);

    
}
//End update leave type function

public function update_leave_type(Request $request, $id){
   
    $data = $request->all();

    $leave_type=leave_type::find($id);
    $leave_type->username=$request->input('edit_username');
    $leave_type->typename=$request->input('edi_typename');
    $leave_type->category=$request->input('edit_category');
    $leave_type->qualifygender=$request->input('edit_qualifygender');
    $leave_type->numberofleaves=$request->input('edit_numberofleaves');
    $leave_type->leave_cat=$request->input('edit_leave_cat');
    $leave_type->long_name=$request->input('edit_long_name');
 
    $leave_type->save();
      
    __notification_set(1,'Success','Leave Type Successfuly Updated!');

    return redirect()->back();

}
//end update leave type function


//Start delete leave type function
public function delete_leave_type(Request $request, $id){
    
    $data = $request->all();

    $delete_leave_type = leave_type::findOrFail($request->id);
    
    $delete_leave_type->delete();


    return response()->json([
        'error' => false,
        'data'  => $delete_leave_type->id,
    
    ], 200);
    
}
//Start delete leave type function


//start load employee leave details
public function load_employee_leave_details(Request $request){
    
    $data = $request->all();
    
    $get_leave_type_details = [];

     $load_employee_hr_details = agency_employees::join('profile','profile.agencyid', '=', 'agency_employees.agency_id')
                                ->leftjoin('tblposition','tblposition.id', '=', 'agency_employees.position_id')
                                ->leftjoin('tbluserassignment','tbluserassignment.id', '=', 'agency_employees.designation_id')
                                ->leftjoin('employee_leave_available', 'employee_leave_available.employeeid', '=', 'agency_employees.agency_id')
                                ->leftjoin('leave_type', 'leave_type.id', '=', 'employee_leave_available.leave_type_id') 
                                ->get(['agency_employees.*','profile.firstname','profile.lastname','profile.mi','profile.extension','profile.sex','tblposition.emp_position', 'leave_type.typename','tbluserassignment.userauthority','employee_leave_available.active'])
                                ->unique('agency_id')
                                ->where('active', 1);   
                                                    
    foreach ($load_employee_hr_details  as $index => $dt ) {

        $designation="N/A";
        $typename="N/A";

        if($dt->userauthority)
        {
            
            $designation = $dt->userauthority;
        
        }
        if($dt->typename){

            $typename = $dt->typename;

        }


        $td = [
            "id" => $dt ->id,
            "firstname" =>$dt ->firstname,
            "mi" => mb_substr($dt->mi, 0, 1). '.',
            "lastname" => $dt->lastname,
            "extension"=> $dt->extension,
            "sex" => $dt->sex,
            "typename"=> $typename,
            "emp_position" => $dt->emp_position,
            "userauthority"=> $designation,
            "active"=>$dt->active,
     
  
        ];


        $get_leave_type_details[count($get_leave_type_details)] = $td;

    }
    
    echo json_encode($get_leave_type_details);


    } 
 
public function delete_leave_employee_details(Request $request, $agency_id){

    $data = $request->all();

    $delete_employee_details = agency_employees::findOrFail($request->agency_id)->with(
                'get_employee_profile', 'get_position','get_designation',
                'get_employment_status');

    $delete_employee_details->delete();


    return response()->json([
        'error' => false,
        'data'  => $delete_employee_details->agency_id,
    
    ], 200);

    }
    
public function load_applied_leave_submitted(Request $request){
    
    $data = $request->all();

    $get_submitted_leave_application = [];

  $load_applied_leave_submitted =leave_submitted::join('profile', 'profile.agencyid', '=', 'leave_submitted.employeeid')
                                ->join('leave_type', 'leave_type.id', '=', 'leave_submitted.type')
                                ->get(['leave_submitted.*','profile.firstname','profile.lastname','profile.mi','profile.extension','leave_type.typename','leave_submitted.entrydate'])
                                ->where('active', 1);

    foreach ($load_applied_leave_submitted  as $index => $dt ) {

        
        $swhere= "N/A";

        if ($dt->swhere)
        {
            $swhere = $dt->swhere;
        }
        
        $td = [
            "id" => $dt -> id,
            "firstname" =>$dt ->firstname,
            "mi" => mb_substr($dt->mi, 0, 1). '.',
            "lastname" => $dt->lastname,
            "extension"=> $dt->extension,
            "typename"=> $dt->typename,
            "swhere" => $swhere,
            "entrydate" => $dt->entrydate,
        
     
  
        ];

        $get_submitted_leave_application[count($get_submitted_leave_application)] = $td;

    }

    echo json_encode($get_submitted_leave_application);


    }
    
public function get_employee_details_set_leave(Request $request){

    $get_load_employee_hr_details = [];

    $load_employee_hr_details = agency_employees::join('profile','profile.agencyid', '=', 'agency_employees.agency_id')
                                ->leftjoin('tblposition','tblposition.id', '=', 'agency_employees.position_id')
                                ->leftjoin('tbluserassignment','tbluserassignment.id', '=', 'agency_employees.designation_id')
                                ->leftjoin('employee_leave_available', 'employee_leave_available.employeeid', '=', 'agency_employees.agency_id')
                                ->leftjoin('leave_type', 'leave_type.id', '=', 'employee_leave_available.leave_type_id') 
                                ->select(['agency_employees.*','profile.firstname','profile.lastname','profile.mi','profile.extension','profile.sex','tblposition.emp_position', 'leave_type.typename','tbluserassignment.userauthority','employee_leave_available.active'])
                                ->where('agency_employees.agency_id', $request->agency_id)
                                ->get();   

      
    foreach ($load_employee_hr_details  as $index => $dt ) {


                            $swhere= "N/A";
                    
                            if ($dt->swhere)
                           
                            {
                           
                                $swhere = $dt->swhere;
                           
                            }

                            if ($dt->firstname ||  $dt->mi || $dt->lastname )

                            {
                                $firstname = $dt->firstname;
                                $mi = mb_substr($dt->mi, 0, 1). '.';
                                $lastname = $dt->lastname;
                                $extension= $dt->extension;
                              
                                $fullname = $firstname . ' ' . $mi .' '. $lastname; 

                            }
                            
                            $td = [
                                "id" => $dt -> id,
                                "agency_id"=> $dt->agency_id,
                                "fullname"=>  $fullname,
                                "gender"=> $dt->sex,
                                "emp_position" => $dt->emp_position,
                                "userauthority"=> $dt->userauthority,
                                "typename"=> $dt->typename,
                                "swhere" => $swhere,
                                "entrydate" => $dt->entrydate,
                            
                            
                        
                            ];
                    
                            $get_load_employee_hr_details[count($get_load_employee_hr_details)] = $td;
                    
                        }

                                echo json_encode($get_load_employee_hr_details);


    }


}






