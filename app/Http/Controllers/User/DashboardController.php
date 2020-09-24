<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\Session;
use App\DB\UserMaster;
use App\DB\User;

class DashboardController extends Controller
{
    public $view                = '';    

    public function __construct() {
        $this->view             = 'user.dashboard.';                  
    }

    public function index(Request $request)
    {
        try {
            $data = [];

            $data['title']          = 'User Dashboard';
            $data['page_title']     = 'User Dashboard';
            $data['user']           = Sentinel::getUser();
            $data['user_master']    = UserMaster::getUserMaster($data['user']['user_master_id']);            

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
