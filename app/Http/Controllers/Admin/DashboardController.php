<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\Session;
use App\DB\UserMaster;
use App\DB\User;
use App\DB\Level;

class DashboardController extends Controller
{
    public $view                = '';    

    public function __construct() {
        $this->view             = 'admin.dashboard.';                  
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
  

}
