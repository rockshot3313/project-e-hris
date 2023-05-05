<?php

namespace App\Http\Controllers\TravelOrder;

use App\Exports\travel_order_export;
use App\Http\Controllers\Controller;
use App\Models\doc_notes;
use App\Models\global_signatories;
use App\Models\tblposition;
use App\Models\tbluserassignment;
use App\Models\travel_order\to_travel_orders;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class TravelOrderController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('auth',['except' => ['login','setup','setupSomethingElse']]);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function myto()
    {

        return view('travelorder.mytravelorder');
    }



    public function load_travel_order()
    {
        $userID = Auth::user()->employee;

        $tres = [];

        //$incomingDocs = doc_file_track::where('active',1)->where('user_id', $userID)->with(['getDocDetails.getDocType', 'getDocDetails.getDocLevel', 'getDocDetails.getDocTypeSubmitted', 'getDocDetails.getDocStatus'])->get();

        $travel_orders = to_travel_orders::
            where('active',1)
            ->where('created_by',Auth::user()->employee)
            ->orderBy('created_at', 'DESC')
            ->get();

        foreach ($travel_orders as $to) {

            $departure_dateform = new DateTime($to->departure_date);
            $return_dateform = new DateTime($to->return_date);

            $interval = $departure_dateform->diff($return_dateform);
            $days = $interval->format('%a');

            $td = [
                "id" => $to->id,
                "name_id" => $to->name_id,
                "name" => $to->name,
                "date" => $to->date,
                "departure_date" =>format_date_time(1,  Carbon::parse($to->departure_date)),
                "return_date" =>format_date_time(1,  Carbon::parse($to->return_date) ),
                "pos_des_id" => $to->pos_des_id,
                "pos_des_type" => $to->pos_des_type,
                "station" => $to->station,
                "destination" => $to->destination,
                "purpose" => $to->purpose,
                "created_at" =>format_date_time(0, $to->created_at),
                "interval" =>$interval,
                "days" =>$days,

            ];
            $tres[count($tres)] = $td;

        }
        echo json_encode($tres);

    }


    public function add_travel_order(Request $request)
    {
        $data = $request->all();


        if($request->save_or_update === 'Save'){
            //add

            $add_to = [
                'name_id' => $request->name_modal,
                'name' => $request->name_modal_text,
                'date' => $request->modal_date_now,
                'departure_date' => $request->modal_departure_date,
                'return_date' => $request->modal_return_date,
                'pos_des_id' => $request->pos_des,
                'pos_des_type' => $request->pos_des_type,
                'station' => $request->modal_station,
                'station_id' => $request->modal_station,
                'destination' => $request->modal_destination,
                'destination_id' => $request->modal_destination,
                'purpose' => $request->modal_purpose,
                'created_by' => Auth::user()->employee,

            ];

            $to_id = to_travel_orders::create($add_to)->id;

            if ($request->has('table_signatory_emp_id')) {
                foreach ($request->table_signatory_emp_id as $i => $emp_id) {

                    $add_sig = [
                        'name' => $request->name_modal_text,
                        'type' => 'to',
                        'type_id' => $to_id,
                        'employee_id' =>  $emp_id,
                        'for' => $request->table_signatory_description[$i],
                        'description' => $request->table_signatory_description[$i],
                        'created_by' =>Auth::user()->employee,
                    ];

                    $sig_id = global_signatories::create($add_sig)->id;
                }
            }

            __notification_set(1, "Travel Order Added!", "Travel Order added successfully!");
            add_log('to',$to_id,'Travel Order added Successfully!');

        }else{
            //update

            to_travel_orders::where('id', $request->to_id)->update([
                'name_id' => $request->name_modal,
                'name' => $request->name_modal_text,
                'date' => $request->modal_date_now,
                'departure_date' => $request->modal_departure_date,
                'return_date' => $request->modal_return_date,
                'pos_des_id' => $request->pos_des,
                'pos_des_type' => $request->pos_des_type,
                'station' => trim($request->modal_station),
                'station_id' => $request->modal_station,
                'destination' => trim($request->modal_destination),
                'destination_id' => $request->modal_destination,
                'purpose' => trim($request->modal_purpose),
                'created_by' => Auth::user()->employee,
            ]);


            $get_signatories = global_signatories::where('type', 'to')->where('type_id', $request->to_id)->get();
            foreach ($get_signatories as $sig_up) {
                global_signatories::where('id', $sig_up->id)->update([
                    'active' => false,
                ]);
            }

            if ($request->has('table_signatory_emp_id')) {
                foreach ($request->table_signatory_emp_id as $i => $emp_id) {

                    $add_sig = [
                        'name' => $request->name_modal_text,
                        'type' => 'to',
                        'type_id' => $request->to_id,
                        'employee_id' =>  $emp_id,
                        'for' => $request->table_signatory_description[$i],
                        'description' => $request->table_signatory_description[$i],
                        'created_by' =>Auth::user()->employee,
                    ];

                    $sig_id = global_signatories::create($add_sig)->id;
                }
            }

            __notification_set(1, "Travel order updated!", "Travel order updated successfully!");
            add_log('to',$request->to_id,'Travel order updated successfully!');

        }


        return json_encode(array(
            "data"=>$data,
        ));
    }


    public function remove_to(Request $request){
        $data = $request->all();

        if($request->has('to_id')){

            $update_remove = [
                'active' => '0',
            ];
            to_travel_orders::where(['id' =>  $request->to_id])->first()->update($update_remove);

        }

        __notification_set(1,'Success','Travel Order removed successfully!');

        add_log('to',$request->to_id,'Travel Order removed successfully!');

        return json_encode(array(
            "data"=>$data,
        ));
    }



    public function load_details(Request $request){
        $data = $request->all();

        if($request->has('to_id')){

            $get_to = to_travel_orders::with('get_signatories.getUserinfo.getHRdetails.getPosition',
            'get_signatories.getUserinfo.getHRdetails.getDesig',
            'get_desig',
            'get_position')
            ->where('active',1)
            ->where('id',$request->to_id)
            ->first();

        }

        $sig_for_table = '';

        if($get_to->get_signatories()->exists()){
            foreach ($get_to->get_signatories as $sig) {
                $fullname= '';
                if( $sig->getUserinfo()->exists()){
                    $fullname = $sig->getUserinfo->firstname .' '. $sig->getUserinfo->lastname;
                }

                $sig_for_table .= '<tr class="hover:bg-gray-200">
                <td>'.$sig->employee_id.'</td>
                <td><input type="text" style="display: none" name="table_signatory_emp_id[]" class="form-control "  value="'.$sig->employee_id.'">'.$fullname.'</td>
                <td><input type="text" style="display: none" name="table_signatory_description[]" class="form-control "  value="'.$sig->description.'">'.$sig->description.'</td>
                <td><a href="javascript:void(0);" class="flex items-center text-theme-6 delete"><i  class="w-4 h-4 mr-1 far fa-trash-alt">Remove</i></a></td>
                </tr>';

            }
        }

        return json_encode(array(
            "data"=>$data,
            "get_to"=>$get_to,
            "sig_for_table"=>$sig_for_table,
        ));
    }



    public function print($id, $type)
    {
        $now = date('m/d/Y g:ia');

        $datetime = Carbon::createFromFormat('m/d/Y g:ia', $now);
        $datetime->setTimezone('Asia/Manila');
        $current_date = $datetime->format('m-d-Y g:iA');

        $filename = 'pdf';


        $get_to = to_travel_orders::with('get_signatories.getUserinfo.getHRdetails.getPosition',
                                        'get_signatories.getUserinfo.getHRdetails.getDesig',
                                        'get_desig',
                                        'get_position')
                                        ->where('active',1)
                                        ->where('id',$id)
                                        ->first();

            $my_des_pos = 'N/A';
            if($get_to->pos_des_type === 'position'){
                    $pos = tblposition::where('id',$get_to->pos_des_id)->first();
                $my_des_pos = $pos->emp_position;
            }elseif($get_to->pos_des_type === 'desig'){
                $des = tbluserassignment::where('id',$get_to->pos_des_id)->first();
            $my_des_pos = $des->userauthority;
        }


            $filename = 'Travel_Order_'.$get_to->id;

        $sig_divs = '';
            if($get_to->get_signatories()->exists()){

                foreach($get_to->get_signatories as $i => $sig){
                    $name = '';
                    $description = $sig->description;
                    $pos_des = '';

                    if($sig->getUserinfo()->exists()){
                        $miden = '';
                        if($sig->getUserinfo->mi){
                            $miden = mb_substr($sig->getUserinfo->mi, 0, 1) .'. ';
                        }

                        $name = $sig->getUserinfo->firstname .' '.$miden.' '. $sig->getUserinfo->lastname.' '. $sig->getUserinfo->extension;

                        if($sig->getUserinfo->getHRdetails()->exists()){
                            if($sig->getUserinfo->getHRdetails->getDesig()->exists()){
                                $pos_des = $sig->getUserinfo->getHRdetails->getDesig->userauthority;

                            }elseif($sig->getUserinfo->getHRdetails->getPosition()->exists())
                            {
                                $pos_des = $sig->getUserinfo->getHRdetails->getPosition->emp_position;

                            }
                        }

                    }




                    if ($i % 2 == 0)
                        {
                            //echo "even";
                            $sig_divs .= '<div style="float: left; width: 50%; font-size:x-small ; padding-left:20px">
                            <div style="padding-bottom: 30px; "><strong>'.$description.'</strong></div>
                            <div><u class="block mt-1">'.strtoupper($name).'</u></div>
                            <div>'.$pos_des.'</div>
                        </div>';
                        }
                        else
                        {
                            //echo "odd";
                            $sig_divs .='<div style="float: right; margin-left: 35%; width: 50%;  font-size:x-small ">
                            <div>
                                <div style="padding-bottom: 30px;"><strong>'.$description.'</strong></div>
                                <div><u class="block mt-1">'.strtoupper($name).'</u></div>
                                <div>'.$pos_des.'</div>
                            </div>

                        </div>

                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>';
                        }

                }


        }
        //dd($sig_divs);
        $system_image_header ='';
        $system_image_footer ='';

        if(system_settings()){
            $system_image_header = system_settings()->where('key','image_header')->first();
            $system_image_footer = system_settings()->where('key','image_footer')->first();
        }



        $pdf = PDF::loadView('travelorder.print.print_to',compact('current_date','get_to','sig_divs','filename','my_des_pos','system_image_header','system_image_footer'))->setPaper('a4', 'portrait');

        if ($type == 'vw') {
            return $pdf->stream($filename . '.pdf');
        } elseif ($type == 'dl') {
            return $pdf->download($filename . '.pdf');
        }

    }



    function export_travel_order(){

        $excel = Excel::download(new travel_order_export, 'travel-order-collection.xlsx');
        return $excel;

    }
}
