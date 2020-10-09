<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Activation;
use Reminder;
use Mail; 
use Sentinel;
use App\DB\SendMailModel;
use App\DB\UserMaster;
use App\DB\User;
use App\DB\RoleUser;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\User\LoginCheckRequest;

class LoginController extends Controller
{
    public $view                = '';    

    public function __construct() {
        $this->view             = 'user.login.';           
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
                $is_user   = User::checkUserIsFrontUser($user->id);                                         

                if($is_user) {
                    User::updateLoginTime($user->id); 
                    $user_master = UserMaster::where('id', $user['user_master_id'])->first();
                    if(!empty($user_master))
                    {
                       if($user_master->account_status == 0)
                       {
                            Sentinel::logout();  
                            Session::flash('error', 'Hello, User Please Contact site admin to activate the your account.');
                            return \Redirect::back()->withInput(); 
                       } else {
                            Session::forget('videoStart');
                            Session::forget('videoEnd');
                            Session::forget('current_video');
                            Session::flash('success', 'Successfully Logged in to your acccount.');
                            return redirect(route('user.dashboard')); 
                       }
                    }  else {
                        Sentinel::logout();   
                        Session::flash('error', 'No user found in the system login again.');
                        return \Redirect::back()->withInput();
                    }   
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
            return redirect(route('user.login'));            

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
            $data           = $request->all();
            $email          = $data['email'];
            $userData     = User::where('email', $email)->first();

            if(!$userData) {
                Session::flash('error', 'Sorry!! Your email is not registered with this webinar. Please try to register with us first');
                return \Redirect::back();
            }
            $user         = Sentinel::findById($userData->id);
            if(!$user){                     
                Session::flash('error', 'Sorry!! Your email is not registered with this webinar. Please try to register with us first');
                return \Redirect::back();
            } else {
                $roles = Sentinel::findById($user->id)->roles()->first();
                // $is_front   = User::checkUserIsFrontUser($user->id);
                // if(!$is_front) {
                //     Session::flash('error', 'You are not authorize to use this feature. Please try again with valid email.');
                //     return \Redirect::back();
                // }     
                if($user) {
                    \DB::table('reminders')->where('user_id', $user->id)->delete(); 
                    $reminder = Reminder::create($user);
                    $reset_link = \URL::route('front.reset.password', [ 'user_id' => $user->id, 'code' => $reminder->code ]);
                    $params = [ 
                        '{resetlink}'   => $reset_link,
                        '{name}'        => $user->first_name.' '.$user->first_name,   
                    ]; 
                    
                    $extra          = [ 'user' => $user ];
                    $mail           = SendMailModel::sendMail('password-forgotten', $params, $user->company_id, $user->email, $extra);
                    dd($params);
                }
            }
            dd("working", $data, $userData);           
          
            return \View::make($this->view.'forgot-pass-index', $data);

        } catch (Exception $e) {
            
        }
    }

    public function getResetPassword(Request $request, $code)
    {

    }

  
   

}
