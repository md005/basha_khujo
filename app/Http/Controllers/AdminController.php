<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start(); //for back button protection

class AdminController extends Controller
{
    /**
     * Displays beautifullife login page.
     */
    public function index()
    {
       $this->adminAuthCheck();
        return view('backend.admin_login');
    }

    /**
     * beautifullife login process.
     */
    public function adminLogin(Request $request) {
        $email = $request->email;
        $password = $request->password;

        $result = DB::table('tbl_admin')
                ->where('email_address', $email)
                ->where('password', md5($password))
                ->first();
//        $check = $result->activation_status;
//        echo "<pre>";
//        print_r($result);
//        exit();
        
        if ($result) {
//            if ($check == "1") {
            if ($result->activation_status == "1") {
                Session::put('admin_name', $result->admin_name);
                Session::put('admin_id', $result->admin_id);
                Session::put('access_label', $result->access_label);
                return Redirect::to('/dashboard');
//            } elseif ($check == "0") {
            } elseif ($result->activation_status == "0") {
                Session::put('exception', 'Account Suspended, Please Contact Admin');
                return Redirect::to('/admin-panel');
            }
            
        } else {
            Session::put('exception', 'Invalid Login Detail...!!!');
            return Redirect::to('/admin-panel');
        }
    }

    /**
     * for authentication
     */
    public function adminAuthCheck() {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('/dashboard')->send();
        } else {
            return;
        }
    }

}
