<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            $adminCount = Admin::where(['username' => $data['username'],'password'=>md5($data['password']),'status'=>1])->count();
            if($adminCount>0){
                Session::put('adminSession',$data['username']);
                return redirect('admin/dashboard');
            }else{
                return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
            }
        }
        return view('/admin.admin_login');
    }

    public function dashboard(){
        /*if(Session::has('adminSession')){
            //Perform all dashboard tasks
        }else{
            return redirect('/admin')->with('flash_message_error','Please login to access');
        }*/
        return view('admin.dashboard');
    }

    public function settings(){
        $adminDetails = Admin::where(['username'=>Session::get('adminSession')])->first();
        return view('admin.settings')->with(compact('adminDetails'));
    }

    public function chkPassword(Request $request){
        $data = $request->all();
        $adminCount = Admin::where(['username' => Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
        if($adminCount == 1){
            echo  "true"; die;
        }else{
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre";print_r($data); die;
            $adminCount = Admin::where(['username' => Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
            if($adminCount == 1){
                $password = md5($data['new_pwd']);
                Admin::where('username',Session::get('adminSession'))->update(['password'=>$password]);
                return redirect('/admin/settings')->with('flash_message_success','Password update Successfully!');
            }else{
                return redirect('/admin/settings')->with('flash_message_error','Incorrect Current Password!');
            }
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_success','Logged out Successfully');
    }
}
