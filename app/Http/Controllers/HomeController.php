<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use Mail;
use TrueBV\Punycode;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /* ------------------- Frontend Home ------------------------ */

    public function index()
    {

        $home_content = view('frontend.pages.home_master_content');

        return view('frontend.home_master')
            ->with('home_content',$home_content);

    }

      
    
    /* ------------------------ Category Product Detail ----------------------- */
    
    public function CategoryProductDetail($id) {
        $product_category = DB::table('tbl_categories')
                ->where('status',1)
                ->where('category_id',$id)
                ->first();
        $content = view('frontend.pages.category_details')
                ->with('product_category',$product_category);

        return view('frontend.home_master')
            ->with('home_content',$content);
    }
    
    
    /* ------------------------ Sub Category Product Detail ----------------------- */
    
    public function SubCategoryProductDetail($id) {
        $product_sub_category = DB::table('tbl_sub_categories')
                ->where('status',1)
                ->where('sub_category_id',$id)
                ->first();
        $sub_product_grid = DB::table('tbl_products')
                ->where('status',1)
                //->where('sub_category_id',$product_sub_category->sub_category_id)
                ->where('sub_category_id',$id)
                ->paginate(6);
                //->get();
        $content = view('frontend.pages.sub_category_details')
                ->with('product_sub_category',$product_sub_category)
                ->with('sub_product_grid',$sub_product_grid);

        return view('frontend.home_master')
            ->with('home_content',$content);
    }
    
    
    /* ------------------------ single Product Detail ----------------------- */
    
    public function singleProductDetail($id) {
        $product_details = DB::table('tbl_products')
                ->where('status',1)
                ->where('product_id',$id)
                ->first();
        $content = view('frontend.pages.product_details')
                ->with('product_details',$product_details);

        return view('frontend.home_master')
            ->with('home_content',$content);
    }
    
    
    /* ------------------------ About ----------------------- */

    public function about() {
        $view_about = DB::table('tbl_about')
                ->where('status',1)
                ->take(1)
                ->get();
        return view('frontend.pages.about')
                ->with('view_about',$view_about);
    }
    
    /* ------------------------ Contact ----------------------- */

    public function contact() {
        $contact_info = DB::table('tbl_contact_info')->first();
        return view('frontend.pages.contact')->with('contact_info',$contact_info);
    }

    /*---------------- Save Contact --------------------*/
    public function saveContact(Request $request) {
        try {
            $data = array();
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['subject'] = $request->subject;
            $data['message'] = $request->message;
            $data['created_at'] = date('Y-m-d h:i:s',((time()-6*3600)));
            $result = DB::table('tbl_contact')->insert($data);
            $data2 = array(
                'names' => $request->name,
                'emails' => $request->email,
                'phone' => $request->phone,
                'subjects' => $request->subject,
                'messages' => $request->message
            );
            Mail::send('frontend.pages.email', $data2, function($message) use ($data2) {
                $message->to('mazharul.islam@talhatraining.com'); //inbox address
                $message->subject($data2['subjects']);
            });

            if ($result) {
                return Redirect::to('/contact-us')->with('success', 'Your Message Send Successfully!!');
            } else {
                return Redirect::to('/contact-us')->with('error', 'We Can not Send Your Message Now!!');
            }
        } catch (\Exception $e) {
            $err_message = \Lang::get($e->getMessage());
            return Redirect::to('/contact-us')->with('error', $err_message);
        }
    }



    /*---------------- manageContact ------------------*/

    public function manageContact(){
        $this->AuthCheck();
        $contact=DB::table('tbl_contact')->get();
        $manage_contact=view('backend.contact_email.manage_contact')->with('contact',$contact);
        return view('backend.admin_master')
                            ->with('admin_content',$manage_contact);
    }
    
    /* ------------ Delete Contact ----------------- */

    public function deleteContact($id) {

        $result = DB::table('tbl_contact')->where('contact_id', $id)->delete();
        if ($result) {
            return Redirect::to('manage-contact')->with('success', 'Contact Deleted Successfully!!');
        } else {
            return Redirect::to('manage-contact')->with('error', 'There is a error Deleting Data!!');
        }
    }
    
    /* ------------ View Contact ----------------- */

    public function viewContact($id) {

        $this->AuthCheck();
        $contact_data = DB::table('tbl_contact')->where('contact_id',$id)->first();
        $manage_contact = view('backend.contact_email.view_contact')->with('contact_data', $contact_data);
        return view('backend.admin_master')
                        ->with('admin_content', $manage_contact);
    }
    
    /* ------------ Edit Contact Info ----------------- */

    public function editContactInfo() {
        $this->AuthCheck();
        $result = DB::table('tbl_contact_info')->first();
        return view('backend.contact_email.edit_contact_info')->with('result', $result);
    }
    
    /* ---------- Update Contact Info ---------------- */

    public function updateContactInfo(Request $request) {
        try {
            $data = array();
            $data['contact_info_id'] = $request->contact_info_id;
            $data['contact_info_address'] = $request->contact_info_address;
            $data['contact_info_message'] = $request->contact_info_message;
            $data['contact_info_phone'] = $request->contact_info_phone;
            $data['contact_info_email'] = $request->contact_info_email;
            $data['contact_info_lat'] = $request->contact_info_lat;
            $data['contact_info_lon'] = $request->contact_info_lon;
            $data['contact_info_facebook'] = $request->contact_info_facebook;
            $data['contact_info_linkedin'] = $request->contact_info_linkedin;
            $data['contact_info_googleplus'] = $request->contact_info_googleplus;
            $data['contact_info_twitter'] = $request->contact_info_twitter;
            
            //$data['updated_at'] = date('Y-m-d h:i:s', ((time() - 6 * 3600)));

            $result = DB::table('tbl_contact_info')->where('contact_info_id', $request->contact_info_id)->update($data);
            if ($result) {
                return Redirect::to('manage-contact-info')->with('success', 'Contact Info updated Successfully!!');
            } else {
                return Redirect::to('manage-contact-info')->with('error', 'There is a error Saving Data!!');
            }
        } catch (\Exception $e) {
            $err_message = \Lang::get($e->getMessage());
            return Redirect::to('manage-contact-info')->with('error', $err_message);
        }
    }

    /*---------------- Subscribe ------------------*/
    public function addSubscribe() {
        $sub_email = Input::get('subscribed_emails');
//        echo $sub_email;
        $data = array();
        $data['subscribe_email'] = $sub_email;
        

        $result = DB::table('tbl_subscribe')->insert($data);
        
        if($result){
            echo 'successfully subscribed';
        }else{
            echo 'failed subscription';
        }

    }
    
    /* ---------------- manage Subscribe ------------------ */

    public function manageSubscribe() {
        $this->AuthCheck();
        $subscribe = DB::table('tbl_subscribe')->get();
        $manage_subscribe = view('backend.manage_subscribe')->with('subscribe', $subscribe);
        return view('backend.admin_master')
                        ->with('admin_content', $manage_subscribe);
    }

    /* ------------ Delete Subscribe ----------------- */

    public function deleteSubscribe($id) {

        $result = DB::table('tbl_subscribe')->where('subscribe_id', $id)->delete();
        if ($result) {
            return Redirect::to('manage-subscribe')->with('success', 'Subscribe Deleted Successfully!!');
        } else {
            return Redirect::to('manage-subscribe')->with('error', 'There is a error Deleting Data!!');
        }
    }
    
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

}
