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
use App\DB\WithdrawRequests;
use App\Http\Requests\Admin\UserRequest;
use App\Commands\Admin\UserStoreCommand;

class WithdrawalController extends Controller
{
    public $view        = '';
    public function __construct() {
        $this->view     = 'admin.withdrawal.';        
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
            $data['title']          = 'Withdrawal';
            $data['page_title']     = 'Withdrawal';            
            $data['view']           = $this->view;
            return \View::make($this->view.'index', $data);
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
    public function approve(Request $request ,$id)
    {
        try {
            if(!empty($id))
            {        
                $admin_user = Sentinel::getUser();        
                $record         = WithdrawRequests::find($id);
                $user_master    = UserMaster::getUserMaster($record['user_master_id']);
                $user           = User::where('user_master_id', $user_master['id'])->first();                
                $wallet         = Wallet::addApproveWithdrawal($user_master, $user, $record);                             

                $record->withdraw_status         = 1;
                $record->withdraw_done_date      = date('Y-m-d');
                $record->request_accept_by_id    = $admin_user['id'];

                $result = $record->save();

                if ($result) {
                    Session::flash('success', 'Successfully approve the withdrawal request.');
                    return redirect(route('admin.withdrawal.index'));
                } else {
                    Session::flash('error', 'Fail to approve the withdrawal request.');
                    return \Redirect::back()->withInput();
                }
            } else {
                Session::flash('error', 'No Request found.');
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
    
    public function reject(Request $request, $id)
    {
        try {
            $data['id']     = $id; 
            $admin_user = Sentinel::getUser();        
            $record         = WithdrawRequests::find($id);
            if(!empty($record))
            {
                $record->withdraw_status         = 2;
                $record->request_accept_by_id    = $admin_user['id'];
                $result = $record->save(); 
            }  else {
                $result = false;
            }   
            

            if ($result) {
                return response()->json([
                    'delete-user'           => true,
                    'reqstatus'             => 'success', 
                    'message'               => 'Reject withdrawal request successfully.'
                ]);
            } else {
                return response()->json([
                    'delete-user'           => true,
                    'reqstatus'             => 'error', 
                    'message'               => 'Fail to reject withdrawal request.'
                ]);            
            }
        } catch (Exception $e) {
            return response()->json([
                'delete-user'           => true,
                'reqstatus'             => 'error', 
                'message'               => 'Fail to reject withdrawal request.'
            ]);            
        }
    }

    public function getList(Request $request)
    {
        try {
            $data           = WithdrawRequests::get();          

            return \DataTables::of($data)
                    ->addColumn('id', function($row) {
                        return $row->id;
                    })
                    ->addColumn('self_sponsor_key', function($row) {
                        if(!empty($row->usermaster->self_sponsor_key))
                        {
                            return $row->usermaster->self_sponsor_key;
                        } else {
                            return '-';
                        }
                    })
                    ->addColumn('usermaster', function($row) {
                        if(!empty($row->usermaster->name))
                        {
                            return $row->usermaster->name;
                        } else {
                            return '-';
                        }
                    })
                    ->addColumn('detail', function($row) {
                        return $row->withdraw_option.": &#8377;".$row->withdraw_amount;
                    })                    
                    ->addColumn('withdraw_amount', function($row) {
                        return  "&#8377; ". $row->withdraw_amount;
                    })
                    ->addColumn('withdraw_option', function($row) {
                        return $row->withdraw_option;
                    })
                    ->addColumn('withdraw_status', function($row) {
                        if($row->withdraw_status == 0)
                        {
                            return  'Pending';    
                        } elseif ($row->withdraw_status == 1) {
                            return 'Approved';
                        } else {
                            return 'Rejected';
                        }                        
                    })      
                    ->addColumn('action', function($row) {
                        if($row->withdraw_status == 0)
                        {
                            $edit_btn = '<a href="'.\URL::route('admin.withdrawal.approve', [ 'id' => $row->id ]).'"><button type="button" class="btn btn-primary waves-effect waves-light">Approve</button></a>';
                            $delete_btn = '<a href="javascript:deleteClient(\''.$row->id.'\')" id="delete_'.$row->id.'"  data-url="'.\URL::route('admin.withdrawal.reject', [ 'id' => $row->id ]).'" ><button type="button" class="btn btn-danger waves-effect waves-light">Reject</button></a>';
                        } else{
                             $edit_btn = '';
                             $delete_btn = '';
                        }  
                        // $delete_btn = '<a href="'.\URL::route('admin.activation.remove', [ 'id' => $row->id ]).'"><button type="button" class="btn btn-danger waves-effect waves-light" >Remove</button></a>';                      
                        

                        return $edit_btn." ".$delete_btn;
                    })
                    ->rawColumns(['action','withdraw_amount','detail'])
                    ->make(true);
        } catch (Exception $e) {
            
        }
    }




   
}
