<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\Session;
use App\DB\UserMaster;
use App\DB\User;
use App\DB\Level;
use App\DB\RefferalBonusSetting;

class DashboardController extends Controller
{
    public $view                = '';    
    public $ref                = '';    

    public function __construct() {
        $this->view             = 'admin.dashboard.';                  
        $this->ref             = 'admin.refferal.';                  
    }

    public function index(Request $request)
    {
        try {
            $data = [];

            $data['title']          = 'Admin Dashboard';
            $data['page_title']     = 'Admin Dashboard';
            $data['user']           = Sentinel::getUser();
            $data['all_level']      = Level::get();
            // $data['user_master']    = UserMaster::getUserMaster($data['user']['user_master_id']);            

            if (Sentinel::check() !== false)
    		{
    		    // User is logged in and assigned to the `$user` variable.
    		}
    		else
    		{
    		    Sentinel::logout();                   
                Session::flash('error', 'You are un-authorize to access this panel. Please try again with valid credentials.');
                return redirect(route( 'admin.login' )); 
    		}          

                return \View::make($this->view.'index', $data); 
            } catch (Exception $e) {
                
            }
    }

    public function RefferalBonusSave()
    {
        try {
            $data = [];
            $data['title']          = 'Admin Dashboard';
            $data['page_title']     = 'Admin Dashboard';
            $data['user']           = Sentinel::getUser();
            $data['refferal_bonus'] = RefferalBonusSetting::first();
             return \View::make($this->ref.'index', $data); 
        } catch (Exception $e) {
            
        }
    }

    public function RefferalBonusUpdate(Request $request)
    {
        try {
            $data = $request->all();       
            if(!empty($data['refferal_bonus_amount']))
            {
                $record = RefferalBonusSetting::first();
                $record->refferal_bonus_amount = $data['refferal_bonus_amount'];
                $result = $record->save();                
                if ($result) {
                    Session::flash('success', 'Refferal Bonus save successfully.');
                    return redirect(route('admin.refferal.index'));
                } else {
                    Session::flash('error', 'Fail to store Refferal Bonus detail.');
                    return redirect(route('admin.refferal.index'));
                }
            } else {
                Session::flash('error', 'Fail to store Refferal Bonus detail.');
                return redirect(route('admin.refferal.index'));
            }

                
        } catch (Exception $e) {
            
        }
    }
  

}
