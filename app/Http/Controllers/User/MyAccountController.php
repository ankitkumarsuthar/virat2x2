<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\Session;
use App\DB\UserMaster;
use App\DB\User;
use App\Commands\User\UserAccountStoreCommand;

class MyAccountController extends Controller
{
    public $view                = '';    

    public function __construct() {
        $this->view             = 'user.myaccount.';                  
    }

    public function index(Request $request)
    {
        try {
            $data = [];

            $data['title']          = 'My Account';
            $data['page_title']     = 'My Account';
            $data['user']           = Sentinel::getUser();
            $data['user_master']    = UserMaster::getUserMaster($data['user']['user_master_id']);    
            return \View::make($this->view.'index', $data); 

        } catch (Exception $e) {
                
        }
    }

    public function changePassword(Request $request)
    {
        try {

            $data                   = $request->all();            
            $data['user']           = Sentinel::getUser();

            $credentials = [
                'email'    => $data['user']['email'],
                'password' => $data['old_password'],
            ];

            $user = Sentinel::findUserById($data['user']['id']);

            $user = Sentinel::validateCredentials($user, $credentials);

            if($user == true)
            {
                $user2 = Sentinel::findById($data['user']['id']);

                $credentials2 = [
                    'password' => $data['new_password'],
                ];

                $user3 = Sentinel::update($user2, $credentials2);

                Session::flash('success','Success!! New Password details stored successfully.');
                return \Redirect::back()->withInput();

            } else {

                Session::flash('error', 'Incorrect Old Password.');
                return \Redirect::back()->withInput();
            }
            
        } catch (Exception $e) {
            
        }
    }

    public function saveBankDetail(Request $request)
    {
        try {

            $data                   = $request->all();   

            $result = $this->dispatch(new UserAccountStoreCommand($data, $request, 'update_bank_detail'));

            if ($result) {
                Session::flash('success','Success!! Bank details stored successfully.');
                return redirect(route('user.myaccount'));
            } else {
                Session::flash('error', 'Error!! Due to some unexpected error delete process not completed successfully. Please try again. If error persist then please contact our site administrator.');
                return \Redirect::back()->withInput();
            }
            
        } catch (Exception $e) {
            
        }
    }

    public function saveUpiDetail(Request $request)
    {
        try {

            $data                   = $request->all();   

            $result = $this->dispatch(new UserAccountStoreCommand($data, $request, 'save_upi'));

            if ($result) {
                Session::flash('success','Success!! UPI details stored successfully.');
                return redirect(route('user.myaccount'));
            } else {
                Session::flash('error', 'Error!! Due to some unexpected error delete process not completed successfully. Please try again. If error persist then please contact our site administrator.');
                return \Redirect::back()->withInput();
            }
            
        } catch (Exception $e) {
            
        }
    }

    public function savePaytmDetail(Request $request)
    {
        try {

            $data                   = $request->all();               
            $result = $this->dispatch(new UserAccountStoreCommand($data, $request, 'save_paytm'));

            if ($result) {
                Session::flash('success','Success!! PAYTM details stored successfully.');
                return redirect(route('user.myaccount'));
            } else {
                Session::flash('error', 'Error!! Due to some unexpected error delete process not completed successfully. Please try again. If error persist then please contact our site administrator.');
                return \Redirect::back()->withInput();
            }
            
        } catch (Exception $e) {
            
        }
    }
  

}
