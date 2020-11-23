<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function userLoginRegister(){
        return view('users.login_register');
    }

    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        $countries = Country::get();

        if($request->isMethod('post')){
            $data = $request->all();
            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->mobile = $data['mobile'];
            $user->save();
            return redirect()->back()->with('flash_message_success','Il tuoi dati sono stati aggiornati con successo!');
        }

        return view('users.account')->with(compact('countries','userDetails'));
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                Session::put('frontSession',$data['email']);
                return redirect('/');
            }else{
                return redirect()->back()->with('flash_message_error', 'Email o Password errate!');
            }
        }
    }

    public function register(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            //Check if User Already exist
            $usersCount = User::where('email', $data['email'])->count();
            if ($usersCount > 0) {
                return redirect()->back()->with('flash_message_error', 'Email già registrata!');
            } else {
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();
                if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    Session::put('frontSession',$data['email']);
                    return redirect('/')->with('flash_message_success','Account creato correttamente!');
                }
            }
        }
    }

    public function chkUserPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id',$user_id)->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $old_pwd = User::where('id',Auth::User()->id)->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd,$old_pwd->password)){
                //Update password
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with('flash_message_success','La password è stata modificata correttamente');
            }else{
                return redirect()->back()->with('flash_message_error','La password corrente è errata!');
            }
        }
    }

    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        return redirect('/');
    }

    public function checkEmail(Request $request)
    {
        $data = $request->all();
        $usersCount = User::where('email', $data['email'])->count();
        if ($usersCount > 0) {
            echo "false";
        } else {
            echo "true"; die;
        }
    }
}
