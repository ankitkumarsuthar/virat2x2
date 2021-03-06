<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use DataTables;
use Illuminate\Support\Facades\Session;

use App\DB\User;
use App\DB\Level;
use App\DB\Wallet;
use App\DB\UserMaster;
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

            $data['title']          = 'User List';
            $data['page_title']     = 'USer List';

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

            $data['title']          = 'Add User';
            $data['page_title']     = 'Add User';

            $data['lang']           = $this->add;
            $data['user']           = new User;
            $data['view']           = $this->view;
            $data['last_id']        = User::orderBy('id','desc')->limit(1)->pluck('id')->toArray();
            $data['dummy_id']       = $data['last_id'][0] + 1;
            // dd($data['dummy_id']);
            // $data['status_list']    = User::getStatusList();
            // $data['role_list']      = Role::getRoleList();
            // dd($this->view.'add');

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
                Session::flash('success', 'User save successfully.');
                return redirect(route('admin.user.create'));
            } else {
                Session::flash('error', 'Fail to save user.');
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
            $data['title']          = 'Edit User';
            $data['page_title']     = 'Edit User';
            $data['lang']           = $this->edit;
            $data['user']           = User::find($id);
            $data['user_level_data']            = Level::getUserCurrentLevel($data['user']); 
            $data['user_master']    = UserMaster::getUserMaster($data['user']['user_master_id']); 
            $data['view']           = $this->view;
            // dd($data['user_level_data']);
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
    public function update(Request $request)
    {
        try {
            $data = $request->all();                                    
            $data['user_data'] = User::where('user_master_id', $data['user_master_id'])->first();            
            $result = $this->dispatch(new UserStoreCommand($data, $request, 'edit'));

            if ($result) {
                Session::flash('success', 'Detail save successfully.');
                return redirect(route('admin.user.index'));
            } else {
                Session::flash('error', 'Fail to save details.');
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
                    'message'               => 'User deleted successfully.'
                ]);
            } else {
                return response()->json([
                    'delete-user'           => true,
                    'reqstatus'             => 'error', 
                    'message'               => 'Fail to delete user.'
                ]);            
            }
        } catch (Exception $e) {
            return response()->json([
                'delete-user'           => true,
                'reqstatus'             => 'error', 
                'message'               => 'Fail to delete user.'
            ]);            
        }
    }



    public function getList(Request $request)
    {
        try {            
            $user_id_list = RoleUser::where('role_id', '3')->pluck('user_id')->toArray();
            $data 	     = User::whereIn('id', $user_id_list)->get();
            // dd($data);
            return \DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('self_sponsor_key', function($row) {
                        return $row->usermaster->self_sponsor_key;
                    })
                    ->addColumn('name', function($row) {
                        return $row->usermaster->name;
                    })                   
                    ->addColumn('status', function($row) {
                        if($row->usermaster->account_status == 0)
                        {
                            return 'Not Active';
                        } else {
                            return 'Active';
                        }                        
                    })
                    ->addColumn('mobile', function($row) {
                        return $row->usermaster->mobile.'|| '.$row->usermaster->email;
                    }) 
                    // ->addColumn('level', function($row) {
                    //     $level_btn = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Click To See Level</button>';
                    //     return $level_btn;
                    // })                    
                    ->addColumn('wallet', function($row) {
                        if($row->usermaster->wallet_balance > 0)
                        {
                            return "&#8377; ". $row->usermaster->wallet_balance;
                        } else {
                            return "&#8377; 0";
                        }
                    })                      
                    ->addColumn('action', function($row) {                        
                        $edit_btn = '<a href="'.\URL::route('admin.user.edit', [ 'id' => $row->id ]).'"><button type="button" class="btn btn-primary waves-effect waves-light">Edit</button></a>';

                        // $delete_btn = '<a href="javascript:deleteClient(\''.$row->id.'\')" id="delete_'.$row->id.'" data-url="'.\URL::route('admin.user.delete', [ 'id' => $row->id ]).'" class="btn btn-outline-danger btn-elevate btn-circle btn-icon mt-1 mb-1 mr-2" title="'.\Lang::get($this->index.'delete_title').'"><i class="la la-trash"></i></a>';
                        $delete_btn = '<a href="javascript:deleteClient(\''.$row->id.'\')" id="delete_'.$row->id.'"  data-url="'.\URL::route('admin.user.delete', [ 'id' => $row->id ]).'" ><button type="button" class="btn btn-danger waves-effect waves-light">Delete</button></a>';

                        return $edit_btn." ".$delete_btn;
                    })
                    ->rawColumns(['action','wallet'])
                    ->make(true);


        } catch (Exception $e) {
            
        }
    }


    public function checkEmail2(Request $request)
    {
        try {
            $data = $request->all();          
            
            $email      = $data['user_email'];
            $user_id    = $data['id'];
            $result     = User::adminCheckUserEmail2($email, $user_id);

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
