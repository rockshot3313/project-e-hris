<?php

namespace App\Http\Controllers;

use App\Models\doc_file;
use App\Models\doc_level;
use App\Models\doc_notification;
use App\Models\doc_trail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommonController;

use Session;

class NotificationController extends Controller
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

    /*  ============ */

    public function DB_SCHEMA() {
        return "primehrmo.";
    }

    public function DBTBL_NOTIFICATION() {
        $result = [
            "driver" => "e-hris",
            "table" => $this->DB_SCHEMA() . "admin_notification",
        ];
        return $result;
    }

    /*  ============ */




    public function notification_create(Request $request) {

        $username = Auth::user()->id;

        if(trim($username) != ""){


            $res = NOTIFICATION_SET($request->status,$request->title,$request->details,$request->seen,$request->target,$request->targettype,$request->type,$request->typeid,$request->file,$request->islink,$request->link,$request->locallink,$request->locallinktype);

            echo json_encode($res);

        }

    }

    public function notification_load(Request $request) {

        $DBDRIVER = $this->DBTBL_NOTIFICATION()['driver'];
        $DBTBL = $this->DBTBL_NOTIFICATION()['table'];
        
        $username = Auth::user()->id;

        if(trim($username) != ""){

        	$result = [];

            $qry = " SELECT *,DATE_FORMAT(entrydate,'%h:%i %p') AS edate,DATE_FORMAT(entrydate,'%M %e, %Y  %h:%i %p') AS edate2 FROM " . $DBTBL . " WHERE active='1' AND ( ( TRIM(target_id)='' OR TRIM(target_type)='' ) OR ( TRIM(LOWER(target_type))=TRIM(LOWER('user')) AND TRIM(LOWER(target_id))=TRIM(LOWER('" . $username . "')) ) ) ORDER BY entrydate DESC LIMIT 5 ";
            $res = DB::connection($DBDRIVER)->select($qry);

            for($i=0; $i<count($res); $i++) {
            	$date1 = date("Y-m-d");
            	$date2 = date("Y-m-d",strtotime($res[$i]->entrydate));
            	$usedate2 = 0;
            	if($date2 < $date1) {
            		$usedate2 = 1;
            	}else{
            		$usedate2 = 0;
            	}
                /***/
                $img = "";
                if(trim($res[$i]->target_type) == "" && trim($res[$i]->locallinktype) == "") {
                    $img = url('') . "/img/notification.png";
                }else{
                    if(trim($res[$i]->locallinktype) != "") {
                        if(trim(strtolower($res[$i]->locallinktype)) == trim(strtolower('committee'))) {
                            $img = GLOBAL_GET_COMMITTEE_PHOTO(trim($res[$i]->locallink));
                        }
                        if(trim(strtolower($res[$i]->locallinktype)) == trim(strtolower('agency'))) {
                            $img = GLOBAL_GET_AGENCY_PHOTO(trim($res[$i]->locallink));
                        }
                    }
                }
                if(trim($img) == "") {
                    $img = url('') . "/img/notification.png";
                }
        		/***/
        		$td = [
        			"id" => $res[$i]->id,
        			"target_id" => $res[$i]->target_id,
        			"target_type" => $res[$i]->target_type,
        			"type" => $res[$i]->type,
        			"type_id" => $res[$i]->type_id,
        			"title" => $res[$i]->title,
        			"descriptions" => $res[$i]->descriptions,
        			"file_id" => $res[$i]->file_id,
        			"seen" => $res[$i]->seen,
        			"status" => $res[$i]->status,
        			"active" => $res[$i]->active,
        			"created_at" => $res[$i]->created_at,
        			"updated_at" => $res[$i]->updated_at,
        			"committee_id" => $res[$i]->committee_id,
        			"chat_group_id" => $res[$i]->chat_group_id,
        			"islink" => $res[$i]->islink,
                    "link" => $res[$i]->link,
                    "locallink" => $res[$i]->locallink,
        			"locallinktype" => $res[$i]->locallinktype,
        			"added_by" => $res[$i]->added_by,
        			"entrydate" => $res[$i]->entrydate,
        			"edate" => $res[$i]->edate,
        			"edate2" => $res[$i]->edate2,
                    "usedate2" => $usedate2,
        			"img" => $img,
        		];
        		/***/
        		$result[count($result)] = $td;
            }

            echo json_encode($result);

        }

    }

    public function update_incoming_notif(Request $request)
    {
        doc_notification::where('target_id', Auth::user()->employee)->where('subject', 'document')->where('target_type', 'user')->where('subject_id', $request->subject_id)->update([
            'seen' => 1,
        ]);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function notification_details_load(Request $request)
    {
        doc_notification::where('id', $request->notif_id)->update([
             'seen' => true,
         ]);

    }

    function clear_all_notif(Request $request)
    {
        $check_all_notification = doc_notification::where('target_id', Auth::user()->employee)->where('target_type', 'user')->get();

        if ($check_all_notification)
        {
            foreach ($check_all_notification as $notification)
            {
                doc_notification::where('seen', false)->update([
                    'seen' => true,
                ]);
            }
            return response()->json([
                'status' => 200,
            ]);
        }
    }
}

