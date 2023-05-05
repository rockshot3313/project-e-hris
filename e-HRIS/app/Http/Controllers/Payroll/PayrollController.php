<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payroll\Payroll;

class PayrollController extends Controller
{
    public function index(){
        return view('payroll.payroll');
    }
    public function createpayroll(){
        return view('payroll.create');
    }

    public function loadpayroll(Request $request){
        $data = $request->all();
        $tres = [];
        $name = '';


        $overtime = Payroll::get();
        foreach ($overtime as $dt) {

            $td = [
                "id" => $dt->id,
                "group_name" => $dt->group_name,
                "date_desc"=> $dt->date_desc,
                "date_month"=> $dt->date_month,
                "date_year"=>$dt->date_year,
                "employee"=>$dt->employee->count(),
                "processed_by"=>getProfile($dt->processed_by)->firstname,
                "status"=>$dt->status
            ];
            $tres[count($tres)] = $td;
        }

        echo json_encode($tres);
    }
}
