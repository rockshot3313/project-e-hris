<?php

namespace App\Http\Middleware;

use App\Models\doc_modules;
use App\Models\doc_user_privilege;
use App\Models\User;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Session;

class handleUserPriv
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::check()) {
            auto_add_url();

            $link = request()->path();
            $getModules = doc_modules::where('link', 'like', '%'.$link.'%')->where('important',1)->where('active',1)->first();
            $getUser = User::where('employee',Auth::user()->employee)->first();
            $request->session()->forget('get_user_priv');

            if($getModules){

                $get_user_priv = doc_user_privilege::where('module_id',$getModules->id)->where('user_id',Auth::user()->employee)->where('active',1)->first();
            if($get_user_priv){
                if($get_user_priv->read == 1 || $getUser->role_name == 'Admin'){
                    //dd($get_user_priv);

                    Session::push('get_user_priv', $get_user_priv);
                }else{
                    __notification_set(-1,'Notice','You dont have privilege to access this module, Contact System Administrator.');
                    return redirect('/home');
                }
            }

            }
        }

        return $next($request);
    }
}
