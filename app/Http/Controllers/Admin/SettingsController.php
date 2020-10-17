<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\Session;
use App\DB\UserMaster;
use App\DB\User;
use App\DB\Setting;

class SettingsController extends Controller
{
    public $view                = '';    

    public function __construct() {
        $this->view             = 'admin.setting.';                  
    }

     public function index(Request $request)
    {
        try {
            $data = [];
            $data['title']          = 'Setttings';
            $data['page_title']     = 'Setttings';
            $data['setting']     = Setting::find(1);
            $data['view']           = $this->view;

            return \View::make($this->view.'index', $data);
        } catch (Exception $e) {
            
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            if($data['user_access'] == 1)
            {
                \DB::table('settings')
                    ->update(
                        ['user_access' => 1]
                    );
            } else {
                \DB::table('settings')
                    ->update(
                        ['user_access' => 0]
                    ); 
            }
            // dd($data);
            

            if (1 == 1) {
                Session::flash('success', 'Setting detail save successfully.');
                return redirect(route('admin.setting.index'));
            } else {
                Session::flash('error', 'Fail to store setting detail.');
                return redirect(route('admin.setting.index'));
            }
        } catch (Exception $e) {
            return \Redirect::back()->withInput()->withErrors([$e->getMessage()]);
        }
    }
}
