<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use App\Admin;
use Closure;
use Illuminate\Support\Facades\Session;

class Adminlogin
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
        if(empty(Session::has('adminSession'))){
            return redirect('/admin');
        }else{
            //Get Admin/Sub Admin Details
            $adminDetails = Admin::where('username',Session::get('adminSession'))->first();
            $adminDetails = json_decode(json_encode($adminDetails),true);
            if($adminDetails['type']=="Admin"){
                $adminDetails['categories_full_access']=1;
                $adminDetails['products_access']=1;
                $adminDetails['orders_access']=1;
                $adminDetails['users_access']=1;
            }
            Session::put('adminDetails',$adminDetails);

            //Get Current Path
            $currentPath = Route::getFacadeRoot()->current()->uri();

            if($currentPath=="admin/view-categories" && Session::get('adminDetails')['categories_view_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
            }

            if($currentPath=="admin/view-products" && Session::get('adminDetails')['products_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
            }

            if($currentPath=="admin/add-product" && Session::get('adminDetails')['products_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
            }
        }
        return $next($request);
    }
}
