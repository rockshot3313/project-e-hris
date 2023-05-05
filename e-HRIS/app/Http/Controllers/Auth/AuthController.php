<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\doc_modules;
use App\Models\doc_user_privilege;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function postLogin(Request $request)
    {

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...

            $getModule = doc_modules::where('active',1)->where('important',1)->get();

            foreach ($getModule as $module) {
                $getUserpriv = doc_user_privilege::where('active',1)->where('user_id',Auth::user()->employee)->where('module_id',$module->id)->first();
                if(!$getUserpriv){
                    $add_priv = [
                        'module_id' =>  $module->id,
                        'user_id' =>  Auth::user()->employee
                    ];
                    $user_priv_id = doc_user_privilege::create($add_priv)->id;
                }
            }
            //dd($getModule);
            $active_date = '';
            $expire_date = '';
            $go_no_go = '';
            $load_account = User::where('id', Auth::user()->id)->first();

            $date_today = date('Y-m-d');
            $date_today=date('Y-m-d', strtotime($date_today));


            if($load_account->active_date){
                $active_date =  date('Y-m-d', strtotime($load_account->active_date));

            }
            if($load_account->expire_date){
                $expire_date = date('Y-m-d', strtotime($load_account->expire_date));

            }

            if($active_date && $expire_date){
                if (($date_today >= $active_date) && ($date_today <= $expire_date)){
                    $go_no_go = 'Active';

                    return redirect()->back();

                }else{
                    Auth::logout();
                    return redirect()->back()->with('message', 'Your account has been expired!');
                    $go_no_go = 'No Go!';
                }
            }else if(!$active_date && $expire_date){

                if($date_today <= $expire_date){
                    $go_no_go = 'Active';

                    return redirect()->back();

                }else{
                    Auth::logout();
                    return redirect()->back()->with('message', 'Your account has been expired!');
                    $go_no_go = 'No Go!';
                }

            }else if($active_date && !$expire_date){
                if($date_today >= $active_date){

                    $go_no_go = 'Active';

                    return redirect()->back();

                }else{
                    Auth::logout();
                    return redirect()->back()->with('message', 'Your account has been expired!');
                    $go_no_go = 'No Go!';
                }

            }else{

                return redirect()->back();
                $go_no_go = 'Infinite';

            }


        }

        return redirect()->back()->with('message', 'Incorrect Username or Password');
    }

    public function admin_manage_check_account_notif(Request $request){
        $data = $request->all();

        __notification_set(-1,'Notice','You dont have privilege to access this operation, Contact System Administrator.');

        return json_encode(array(
            "data"=>$data,
        ));
    }
}
