<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use DataTables;
use Illuminate\Support\Facades\Session;

use App\DB\User;
use App\DB\RoleUser;
use App\Http\Requests\Admin\UserRequest;
use App\Commands\Admin\UserStoreCommand;

class UsersController extends Controller
{
    public $view        = '';
    public $index       = '';
    public $add         = '';
    public $edit        = '';


    public function __construct() {
        $this->view     = 'admin.user.';
        $this->index    = 'admin/user/index.';        
        $this->add      = 'admin/user/add.';        
        $this->edit     = 'admin/user/edit.';        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return "index of user";
        try {
            $data = [];

            // dd('$daa');

            $data['title']          = \Lang::get($this->index.'meta_title_lbl');
            $data['page_title']     = \Lang::get($this->index.'page_title_lbl');

            $data['lang']           = $this->index;
            $data['view']           = $this->view;

            return \View::make($this->view.'index', $data);
    	} catch (Exception $e) {
    		
    	}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        try {
            $data = [];

            $data['title']          = \Lang::get($this->add.'meta_title_lbl');
            $data['page_title']     = \Lang::get($this->add.'page_title_lbl');

            $data['lang']           = $this->add;
            $data['user']           = new User;
            $data['view']           = $this->view;
            // $data['status_list']    = User::getStatusList();
            // $data['role_list']      = Role::getRoleList();
            // dd('test');

            return \View::make($this->view.'add', $data);
    	} catch (Exception $e) {
    		
    	}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
       
    	try {
            $data = $request->all();

            // dd($data);
            
            $result = $this->dispatch(new UserStoreCommand($data, $request, 'new'));

            if ($result) {
                Session::flash('success', \Lang::get($this->index.'add_success_msg'));
                return redirect(route('admin.user.create'));
            } else {
                Session::flash('error', \Lang::get($this->index.'add_error_msg'));
                return \Redirect::back()->withInput();
            }

        } catch (Exception $e) {
            return \Redirect::back()->withInput()->withErrors([$e->getMessage()]);
    	}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
    	try {
            $data = [];

            $data['title']          = \Lang::get($this->edit.'meta_title_lbl');
            $data['page_title']     = \Lang::get($this->edit.'page_title_lbl');

            $data['lang']           = $this->edit;
            $data['user']           = User::find($id);
            $data['view']           = $this->view;
            $data['status_list']    = User::getStatusList();

            return \View::make($this->view.'edit', $data);
    	} catch (Exception $e) {
    		
    	}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        try {
            $data = $request->all();

            $result = $this->dispatch(new UserStoreCommand($data, $request, 'edit'));

            if ($result) {
                Session::flash('success', \Lang::get($this->index.'edit_success_msg'));
                return redirect(route('admin.user.index'));
            } else {
                Session::flash('error', \Lang::get($this->index.'edit_error_msg'));
                return \Redirect::back()->withInput();
            }

        } catch (Exception $e) {
            return \Redirect::back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function delete(Request $request, $id)
    {
        try {

            $data['id']     = $id;
            $result         = $this->dispatch(new UserStoreCommand($data, $request, 'delete'));

            if ($result) {
                return response()->json([
                    'delete-user'           => true,
                    'reqstatus'             => 'success', 
                    'message'               => \Lang::get($this->index.'delete_success_msg')
                ]);
            } else {
                return response()->json([
                    'delete-user'           => true,
                    'reqstatus'             => 'error', 
                    'message'               => \Lang::get($this->index.'delete_error_msg')
                ]);            
            }
        } catch (Exception $e) {
            return response()->json([
                'delete-user'           => true,
                'reqstatus'             => 'error', 
                'message'               => \Lang::get($this->index.'delete_error_msg')
            ]);            
        }
    }



    public function getList(Request $request)
    {
        try {
            
            $user_id_list = RoleUser::where('role_id', '3')->pluck('user_id')->toArray();
            $data 	     = User::whereIn('id', $user_id_list)->get();

            return \DataTables::of($data)
                    ->addColumn('user_name', function($row) {
                        return $row->first_name;
                    })
                    ->addColumn('email', function($row) {
                        return $row->email;
                    })
                    ->addColumn('action', function($row) {
                        // $edit_btn = '<a href="'.\URL::route('admin.user.edit', [ 'id' => $row->id ]).'" class="btn btn-outline-info btn-elevate btn-circle btn-icon mt-1 mb-1 mr-2" title="'.\Lang::get($this->index.'edit_title').'"><i class="la la-edit"></i></a>';
                        $edit_btn = '<a href="'.\URL::route('admin.user.edit', [ 'id' => $row->id ]).'"><button type="button" class="btn btn-primary waves-effect waves-light">Edit</button></a>';

                        // $delete_btn = '<a href="javascript:deleteClient(\''.$row->id.'\')" id="delete_'.$row->id.'" data-url="'.\URL::route('admin.user.delete', [ 'id' => $row->id ]).'" class="btn btn-outline-danger btn-elevate btn-circle btn-icon mt-1 mb-1 mr-2" title="'.\Lang::get($this->index.'delete_title').'"><i class="la la-trash"></i></a>';
                        $delete_btn = '<a href="javascript:deleteClient(\''.$row->id.'\')" id="delete_'.$row->id.'"  data-url="'.\URL::route('admin.user.delete', [ 'id' => $row->id ]).'" ><button type="button" class="btn btn-danger waves-effect waves-light">Delete</button></a>';

                        return $edit_btn." ".$delete_btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);


        } catch (Exception $e) {
            
        }
    }


    public function checkEmail(Request $request)
    {
        try {

            $data = $request->all();
            
            $email      = $data['email'];
            $user_id    = $data['id'];

            $result     = User::checkUserEmail($email, $user_id);

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
