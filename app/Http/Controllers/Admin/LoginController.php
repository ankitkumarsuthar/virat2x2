<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;

use App\DB\User;
use App\DB\RoleUser;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Admin\LoginCheckRequest;

class LoginController extends Controller
{
    public $view                = '';    

    public function __construct() {
        $this->view             = 'admin.login.';           
    }

    public function index(Request $request)
    {
        try {
            $data = [];

            $data['title']          = 'Login';
            $data['page_title']     = 'Login';            
            
            // if(Sentinel::check() !== false) {
            //     return redirect(route( 'admin.dashboard' ));                
            // } else {
            //     return \View::make($this->view.'login', $data);
            // }
            return \View::make($this->view.'index', $data);

        } catch (Exception $e) {
            
        }
    }

    public function checkLogin(LoginCheckRequest $request)
    {
        try {

            $data = $request->all();

            $email      = $data['email'];
            $password   = $data['password'];
            $credentials = $request->only('email', 'password');


            if( Sentinel::authenticate($credentials) ) {

                $user       = Sentinel::getUser();
                $is_admin   = User::checkUserIsAdmin($user->id);                                         

                if($is_admin) {
                    User::updateLoginTime($user->id);                    

                    Session::flash('success', 'Successfully Logged in to your acccount.');
                    return redirect(route('admin.dashboard'));

                } else {
                    Sentinel::logout();                   
                    Session::flash('error', 'You are un-authorize to access this panel. Please try again with valid credentials.');
                    return \Redirect::back()->withInput();
                }
            } else {                
                Sentinel::logout();   
                Session::flash('error', 'Invalid Credentials. Please enter valid credentials for login to account.');
                return \Redirect::back()->withInput();
            }
        
        } catch (Exception $e) {
            
        }
    }

    public function logout(Request $request)
    {
        try {
            
            Sentinel::logout();       
            Session::flash('success', 'You are successfully logged out from your account.');
            return redirect(route('admin.login'));            

        } catch (Exception $e) {
            
        }
    }

    public function forogtPassword(Request $request)
    {
         try {
            $data = [];

            $data['title']          = 'Forgot Password';
            $data['page_title']     = 'Forgot Password';            
          
            return \View::make($this->view.'forgot-pass-index', $data);

        } catch (Exception $e) {
            
        }
    }

    public function sendResetPasswordLink(Request $request)
    {
       try {
            $data = [];

            $data['title']          = 'Reset Password';
            $data['page_title']     = 'Reset Password'; 

            dd("working");           
          
            return \View::make($this->view.'forgot-pass-index', $data);

        } catch (Exception $e) {
            
        }
    }

  
   

}
