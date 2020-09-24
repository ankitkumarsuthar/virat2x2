<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\Session;
use App\DB\UserMaster;
use App\DB\User;
use App\DB\Level;
use App\Commands\Admin\LevelStoreCommand;

class LevelController extends Controller
{
    public $view                = '';    

    public function __construct() {
        $this->view             = 'admin.dashboard.';                  
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $result = $this->dispatch(new LevelStoreCommand($data, $request, 'edit'));
            if ($result) {
                Session::flash('success', 'Level detail save successfully.');
                return redirect(route('admin.dashboard'));
            } else {
                Session::flash('error', 'Fail to store level detail.');
                return redirect(route('admin.dashboard'));
            }
        } catch (Exception $e) {
            return \Redirect::back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

  

}
