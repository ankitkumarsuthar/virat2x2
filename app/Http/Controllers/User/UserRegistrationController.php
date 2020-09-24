<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\Session;

use App\DB\User;
use App\DB\RoleUser;
use App\Http\Requests\User\UserRegistrationRequest;
use App\Commands\User\UserRegistrationStoreCommand;

class UserRegistrationController extends Controller
{
    public $view                = '';

    public function __construct() {
        $this->view             = 'user.registration.';        
    }

    public function index(Request $request)
    {
        try {
            $data = [];

            $data['title']          = 'User Registration';
            $data['page_title']     = 'User Registration';                        

            return \View::make($this->view.'index', $data);

        } catch (Exception $e) {
            
        }
    }

    public function store(UserRegistrationRequest $request)
    {
        try {
            $data = $request->all();
   
            $result = $this->dispatch(new UserRegistrationStoreCommand($data, $request, 'new'));

            if ($result) {
                Session::flash('success','Success!! New User details stored successfully.');
                return redirect(route('user.login'));
            } else {
                Session::flash('error', 'Error!! Due to some unexpected error delete process not completed successfully. Please try again. If error persist then please contact our site administrator.');
                return \Redirect::back()->withInput();
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

            $result     = User::checkUserEmail($email);

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
