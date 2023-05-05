<?php

namespace App\Http\Controllers\dtr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rr\Rewards;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Session;


class DTRController extends Controller
{


    /*  ============ */

    public function DB_SCHEMA() {

        return "primehrmo.";

    }

    public function DBTBL_DTR_FINGERPRINT() {
        $result = [
            "driver" => "e-hris",
            "table" => $this->DB_SCHEMA() . "dtr_fingerprint",
        ];
        return $result;
    }

    public function DBTBL_DTR_ATTENDANCE() {
        $result = [
            "driver" => "e-hris",
            "table" => $this->DB_SCHEMA() . "dtr_attendance",
        ];
        return $result;
    }

    public function DBTBL_EMPLOYEES() {
        $result = [
            "driver" => "e-hris",
            "table" => $this->DB_SCHEMA() . "agency_employees",
        ];
        return $result;
    }

    public function DBTBL_PROFILE() {
        $result = [
            "driver" => "e-hris",
            "table" => $this->DB_SCHEMA() . "profile",
        ];
        return $result;
    }

    /*  ============ */

    /* MANAGE BIO START ============ */


    public function manage_bio_load_view() {
        return view('dtr.manage_dtr_bio');
    }

    public function manage_bio_users_list(Request $request){
        $result = [];

        $DBDRIVER = $this->DBTBL_EMPLOYEES()['driver'];
        $DBTBL_EMP = $this->DBTBL_EMPLOYEES()['table'];
        $DBTBL_PROFILE = $this->DBTBL_PROFILE()['table'];

        $tn = 0;
        $qry = " SELECT profile.* FROM " . $DBTBL_EMP . " AS emp LEFT JOIN " . $DBTBL_PROFILE . " AS profile ON profile.agencyid=emp.agency_id WHERE emp.active='1' ORDER BY profile.lastname ASC, profile.firstname ASC, profile.mi ASC ";
        $data = DB::connection($DBDRIVER)->select($qry);
        if($data) {
            foreach ($data as $cd) {
                $tn++;
                /***/
                $result[count($result)] = $cd;
                /***/
            }
        }

        return $result;
    }

    public function manage_bio_check_employee(Request $request){
        $result = [];

        $DBDRIVER = $this->DBTBL_DTR_FINGERPRINT()['driver'];
        $DBTBL_FP = $this->DBTBL_DTR_FINGERPRINT()['table'];

        $emp = trim($request->employee);
        $emp = SQL_VALUE_CHECK($emp);

        $resn = 0;

        // CHECK : FINGERPRINT
        $tn = 0;
        $qry = " SELECT * FROM " . $DBTBL_FP . " WHERE active='1' AND ( TRIM(LOWER(agencyid))=TRIM(LOWER('" . $emp . "')) ) LIMIT 1 ";
        $data = DB::connection($DBDRIVER)->select($qry);
        if($data) {
            foreach ($data as $cd) {
                $tn++;
            }
        }
        if($tn <= 0) {
        	$resn++;
        	$cd = [
        		"type" => "danger",
        		"content" => "No fingerprint data detected.",
        	];
        	$result[count($result)] = $cd;
        }

        return $result;
    }


    /* MANAGE BIO END ============ */


}
