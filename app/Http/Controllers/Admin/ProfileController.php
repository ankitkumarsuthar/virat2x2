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

class ProfileController extends Controller
{
    public $view                = '';    
    public $index                = '';    

    public function __construct() {
        $this->view             = 'admin.profile.';                  
    }

     public function index(Request $request)
    {
        try {
            $data = [];
            $data['title']          = 'Admin Profile';
            $data['page_title']     = 'Admin Profile';
            $data['lang']           = $this->index;
            $data['user']           = Sentinel::getUser();
            $data['view']           = $this->view;
            return \View::make($this->view.'index', $data);
        } catch (Exception $e) {
            
        }
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $record                     = Sentinel::findUserById($data['id']);                       
            $record->email              = $data['email'];
            $record->first_name         = $data['first_name'];           
            $result = $record->save();

            if($data['password']){
                Sentinel::update($record, array('password' =>  $data['password']));
                $record->save();                      
            } 

            if ($result) {
                Session::flash('success', 'Admin detail save successfully.');
                return redirect(route('admin.profile.index'));
            } else {
                Session::flash('error', 'Fail to store admin detail.');
                return redirect(route('admin.profile.index'));
            }
        } catch (Exception $e) {
            return \Redirect::back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    public function checkEmail(Request $request)
    {
        try {

            $data = $request->all();           
            
            $email      = $data['email'];            
            $id      = $data['id'];            

            $result     = User::checkAdminUserEmail($email,$id);

            if($result) {
                echo "true";
            } else {
                echo "false";
            }

        } catch (Exception $e) {
            echo "false";            
        }
    }

  

}
