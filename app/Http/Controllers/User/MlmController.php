<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\Session;
use App\DB\UserMaster;
use App\DB\User;
use App\Commands\User\UserAccountStoreCommand;

class MlmController extends Controller
{
    public $view                = '';    

    public function __construct() {
        $this->view             = 'user.mlm.';                  
    }

    public function index(Request $request)
    {
        try {
            $data = [];

            $data['title']          = 'My MLM';
            $data['page_title']     = 'My MLM';
            $data['user']           = Sentinel::getUser();
            $data['user_master']    = UserMaster::getUserMaster($data['user']['user_master_id']);    
            return \View::make($this->view.'index', $data); 

        } catch (Exception $e) {
                
        }
    }

    public function create(Request $request)
    {
        try {
            $data = [];

            $data['title']          = 'My MLM';
            $data['page_title']     = 'My MLM';
            $data['user']           = Sentinel::getUser();
            $data['user_master']    = UserMaster::getUserMaster($data['user']['user_master_id']);    
            return \View::make($this->view.'create', $data); 

        } catch (Exception $e) {
                
        }
    }

    
  

}
