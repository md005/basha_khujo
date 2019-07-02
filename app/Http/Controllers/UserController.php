<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;

class UserController extends Controller {
    
    /**
     * for authentication
     */
    public function AuthCheck() {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return;
        } else {
            return Redirect::to('/admin-panel')->send();
        }
    }

    /* -------------- Add User --------------- */

    public function addUser() {
        $this->AuthCheck();
        $add_user = view('backend.user.add_user');
        return view('backend.admin_master')
                        ->with('admin_content', $add_user);
    }

    /* --------------- Manage User----------------- */

    public function manageUser() {
        $this->AuthCheck();
        $admin = DB::table('tbl_admin')->get();
        $manage_user = view('backend.user.manage_user')->with('admin', $admin);
        return view('backend.admin_master')
                        ->with('admin_content', $manage_user);
    }

    /* -------------- Save User ----------------------- */

    public function saveUser(Request $request) {
        try {
            $data = array();
            $data['admin_name'] = $request->user_name;
            $data['email_address'] = $request->user_email;
            $data['password'] = md5($request->user_password);
            $data['access_label'] = $request->access_label;
            $data['activation_status'] = $request->status;
//            $data['created_at'] = date('Y-m-d h:i:s');
            $data['created_at'] = date('Y-m-d h:i:s',((time()-6*3600)));
            $result = DB::table('tbl_admin')->insert($data);

            if ($result) {
                return Redirect::to('manage-user')->with('success', 'User Added Successfully!!');
            } else {
                return Redirect::to('add-user')->with('error', 'There is a error Saving Data!!');
            }
        } catch (\Exception $e) {
            $err_message = \Lang::get($e->getMessage());
            return Redirect::to('add-user')->with('error', $err_message);
        }
    }

    /* -------------- Unpublish User ------------------- */

    public function unpublishUser($id) {
        $unpublish = DB::table('tbl_admin')->where('admin_id', $id)->update(['activation_status' => '0']);
        return Redirect::to('manage-user')->with('success', 'Status Changed Successfully!!');
    }

    /* -------------- Publish User ------------------- */

    public function publishUser($id) {
        $publish = DB::table('tbl_admin')->where('admin_id', $id)->update(['activation_status' => '1']);
        return Redirect::to('manage-user')->with('success', 'Status Changed Successfully!!');
    }

    /* ------------ Delete User ----------------- */

    public function deleteUser($id) {
        $result = DB::table('tbl_admin')->where('admin_id', $id)->delete();
        if ($result) {
            return Redirect::to('manage-user')->with('success', 'User Deleted Successfully!!');
        } else {
            return Redirect::to('manage-user')->with('error', 'There is a error Deleting Data!!');
        }
    }

    /* ------------ Edit User ----------------- */

    public function editUser($id) {
        $this->AuthCheck();
        $result = DB::table('tbl_admin')->where('admin_id', $id)->first();
        return view('backend.user.edit_user')->with('result', $result);
    }

    /* -------------- Update User ----------------------- */

    public function updateUser(Request $request) {
        try {
            $admin_id = $request->admin_id;
            $data = array();
            $data['admin_name'] = $request->user_name;
            $data['email_address'] = $request->user_email;
            $data['password'] = md5($request->user_password);
            $data['access_label'] = $request->access_label;
            $data['activation_status'] = $request->status;
//            $data['updated_at'] = date('Y-m-d h:i:s');
            $data['updated_at'] = date('Y-m-d h:i:s',((time()-6*3600)));
//            date('Y/m/d H  ', ((time()-6*3600)));
            $result = DB::table('tbl_admin')->where('admin_id', $request->admin_id)->update($data);

            if ($result) {
                return Redirect::to('manage-user')->with('success', 'User Updated Successfully!!');
            } else {
                return Redirect::to('edit-user/'.$admin_id)->with('error', 'There is a error Saving Data!!');
            }
        } catch (\Exception $e) {
            $err_message = \Lang::get($e->getMessage());
            return Redirect::to('edit-user/'.$admin_id)->with('error', $err_message);
        }
    }

}
