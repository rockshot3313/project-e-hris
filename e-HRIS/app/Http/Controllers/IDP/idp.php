<?php

namespace App\Http\Controllers\IDP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\agency\agency_employees;
use App\Models\Hiring\tbl_position;

class idp extends Controller
{
    //

    public function index()
    {
        return view('IDP.IDP');
    }

    public function get_designation_get_position(Request $request)
    {
        $agency_id = $request->id;
        $pos_id = ' ';
        $designation_id = ' ';

        if($agency_id)
        {
              $get_pos = agency_employees::where('agency_id',$request->id)->where('active',true)->get();

                foreach($get_pos as $get_poss)
                {
                    $pos_id = $get_poss->position_id;
                    $designation_id = $get_poss->designation_id;

                    dd($this->get_position($pos_id));
                }
        }


    }

    private function get_position($pos_id)
    {
        if($pos_id)
        {
            $get_position = tbl_position::where('id',$pos_id)->get();

                foreach($get_position as $pos )
                {
                    return $pos->emp_position;
                }
        }
    }

}
