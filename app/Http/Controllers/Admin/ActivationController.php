<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use DataTables;
use Illuminate\Support\Facades\Session;
use App\DB\User;
use App\DB\UserMaster;
use App\DB\RoleUser;
use App\DB\Wallet;
use App\Http\Requests\Admin\UserRequest;
use App\Commands\Admin\UserStoreCommand;

class ActivationController extends Controller
{
    public $view        = '';
    public $index       = '';
    public $add         = '';
    public $edit        = '';
    public function __construct() {
        $this->view     = 'admin.activation.';
        $this->index    = 'admin/activation/index.';        
        $this->add      = 'admin/activation/add.';        
        $this->edit     = 'admin/activation/edit.';        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $data = [];             
            $data['title']          = \Lang::get($this->index.'meta_title_lbl');
            $data['page_title']     = \Lang::get($this->index.'page_title_lbl');
            $data['lang']           = $this->index;
            $data['view']           = $this->view;
            return \View::make($this->view.'index', $data);
    	} catch (Exception $e) {
    		
    	}
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request, $id)
    {
    	try {
            $data = [];
            $record                  = UserMaster::find($id);
            if(!empty($record))
            {
                if(!empty($record->referral_sponser_id))
                {
                    $referal_add = Wallet::addReferalPayment($record->referral_sponser_id);
                }
                $record->account_status   = 1;
                $result = $record->save();
            } else {
                $result = false;
            }
            if ($result) {
                Session::flash('success', 'Account activated successfully.');
                return redirect(route('admin.activation.index'));
            } else {
                Session::flash('error', 'Fail to activate the account.');
                return \Redirect::back()->withInput();
            }
            return \View::make($this->view.'edit', $data);
    	} catch (Exception $e) {
    		
    	}
    }

    public function remove(Request $request, $id)
    {
        // try {
        //     $data = [];
        //     $record     = UserMaster::find($id);
        //     $user_data  = User::where('user_master_id', $record->id)->first();

        //     $user = Sentinel::findById($user_data['id']);
        //     $user->delete();
        //     $result         = $record->delete();

        //     if ($result) {
        //         Session::flash('success', 'User Account removed successfully.');
        //         return redirect(route('admin.activation.index'));
        //     } else {
        //         Session::flash('error', 'Fail to removed the account.');
        //         return \Redirect::back()->withInput();
        //     }
        //     return \View::make($this->view.'edit', $data);
        // } catch (Exception $e) {
            
        // }
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

            $user_master_for_delete = UserMaster::find($id);
            $user_record             = User::where('user_master_id', $user_master_for_delete['id'])->first();            
            $user = Sentinel::findById($user_record['id']);
            $user->delete();

            $result             = $user_master_for_delete->delete();  
            if ($result) {
                return response()->json([
                    'delete-user'           => true,
                    'reqstatus'             => 'success', 
                    'message'               => 'User Account removed successfully.'
                ]);
            } else {
                return response()->json([
                    'delete-user'           => true,
                    'reqstatus'             => 'error', 
                    'message'               => 'Fail to removed the account.'
                ]);            
            }
        } catch (Exception $e) {
            return response()->json([
                'delete-user'           => true,
                'reqstatus'             => 'error', 
                'message'               => 'Fail to removed the account.'
            ]);            
        }
    }

    public function getList(Request $request)
    {
        try {
            
            $user_id_list = RoleUser::where('role_id', '3')->pluck('user_id')->toArray();
            $user_master_ids = User::whereIn('id', $user_id_list)->pluck('user_master_id')->toArray();

            $data = UserMaster::whereIn('id', $user_master_ids)->orderBy('id','DESC')->get();            
            return \DataTables::of($data)
                    ->addColumn('id', function($row) {
                        return $row->id;
                    })
                    ->addColumn('self_sponsor_key', function($row) {
                        return $row->self_sponsor_key;
                    })
                    ->addColumn('name', function($row) {
                        return $row->name;
                    })
                    ->addColumn('email', function($row) {
                        return $row->email;
                    })
                    ->addColumn('sponser', function($row) {
                        if(!empty($row->sponser))
                        {
                            return $row->sponser->name;
                        } else {
                            return 'NO SPONSER';
                        }
                    })
                    ->addColumn('mobile', function($row) {
                        return $row->mobile;
                    })
                    ->addColumn('action', function($row) {
                        if($row->account_status == 0)
                        {
                            $edit_btn = '<a href="'.\URL::route('admin.activation.activate', [ 'id' => $row->id ]).'"><button type="button" class="btn btn-primary waves-effect waves-light">Activate</button></a>';
                        } else{
                             $edit_btn = '';
                        }  
                        // $delete_btn = '<a href="'.\URL::route('admin.activation.remove', [ 'id' => $row->id ]).'"><button type="button" class="btn btn-danger waves-effect waves-light" >Remove</button></a>';                      
                        $delete_btn = '<a href="javascript:deleteClient(\''.$row->id.'\')" id="delete_'.$row->id.'"  data-url="'.\URL::route('admin.activation.delete', [ 'id' => $row->id ]).'" ><button type="button" class="btn btn-danger waves-effect waves-light">Remove</button></a>';

                        return $edit_btn." ".$delete_btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        } catch (Exception $e) {
            
        }
    }




   
}
