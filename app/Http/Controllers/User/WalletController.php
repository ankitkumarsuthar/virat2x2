<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\Session;
use App\DB\UserMaster;
use App\DB\User;
use App\DB\Wallet;
use App\DB\WithdrawRequests;
use App\Commands\User\WalletStoreCommand;

class WalletController extends Controller
{
    public $view                = '';    

    public function __construct() {
        $this->view             = 'user.wallet.';                  
    }

    public function index(Request $request)
    {
        try {
            $data = [];

            $data['title']          = 'My Wallet';
            $data['page_title']     = 'My Wallet';
            $data['user']           = Sentinel::getUser();
            $data['user_master']    = UserMaster::getUserMaster($data['user']['user_master_id']);    
            return \View::make($this->view.'index', $data); 

        } catch (Exception $e) {
                
        }
    }

    public function all_transactions(Request $request)
    {
        try {
            $data = [];

            $data['title']          = 'My MLM';
            $data['page_title']     = 'My MLM';
            $data['user']           = Sentinel::getUser();
            $data['user_master']    = UserMaster::getUserMaster($data['user']['user_master_id']);    
            // $data['transaction_list']         = Wallet::where('user_id', $data['user']['id'])->where('user_master_id', $data['user_master']['id'])->get();
            return \View::make($this->view.'all_transactions', $data); 
        } catch (Exception $e) {
                
        }
    }

    public function all_transactions_get_list(Request $request)
    {
        try {
            $user           = Sentinel::getUser();
            $user_master    = UserMaster::getUserMaster($user['user_master_id']);    
            $data           = Wallet::where('user_id', $user['id'])->where('user_master_id', $user_master['id'])->get();
            return \DataTables::of($data)
                    ->addColumn('id', function($row) {
                        return $row->id;
                    })
                    ->addColumn('entry_date', function($row) {
                        return $row->entry_date;
                    })
                    ->addColumn('payment_detail', function($row) {
                        return $row->payment_detail;
                    })
                    ->addColumn('sending_or_receiving', function($row) {
                        if($row->sending_or_receiving == 0)
                        {
                            return  'Debit';    
                        } else {
                            return 'Credit';
                        }                        
                    })
                    ->addColumn('pay_amount', function($row) {
                        return "&#8377; ". $row->pay_amount;
                    })
                    // ->addColumn('action', function($row) {
                        
                    //     $edit_btn = '<a href="'.\URL::route('admin.user.edit', [ 'id' => $row->id ]).'"><button type="button" class="btn btn-primary waves-effect waves-light">Edit</button></a>';

                    //     $delete_btn = '<a href="javascript:deleteClient(\''.$row->id.'\')" id="delete_'.$row->id.'"  data-url="'.\URL::route('admin.user.delete', [ 'id' => $row->id ]).'" ><button type="button" class="btn btn-danger waves-effect waves-light">Delete</button></a>';

                    //     return $edit_btn." ".$delete_btn;
                    // })
                    ->rawColumns(['pay_amount'])
                    ->make(true);


        } catch (Exception $e) {
            
        }
    }

      public function transferToAnother(Request $request)
      {        
        try {
            $data = [];

            $data['title']          = 'Transfer';
            $data['page_title']     = 'Transfer';
            $data['user']           = Sentinel::getUser();
            $data['user_master']    = UserMaster::getUserMaster($data['user']['user_master_id']);    
            // $data['transaction_list']         = Wallet::where('user_id', $data['user']['id'])->where('user_master_id', $data['user_master']['id'])->get();
            return \View::make($this->view.'transfer_to_another', $data); 
        } catch (Exception $e) {
                
        }
    }

    public function transferToAnotherSend(Request $request)
    {
         try {
            $user = Sentinel::getUser();
            $data = $request->all();
            $receiver_user_master  = UserMaster::where('self_sponsor_key', $data['receiver_unique_id'])->first(); 
            $sender_user_master    = UserMaster::getUserMaster($user['user_master_id']); 
            $data['sender_current_ballance'] = Wallet::currentBalance($sender_user_master);
            if($data['sender_current_ballance'] < $data['transfer_amount'])
            {
                Session::flash('error', 'Your account has insufficient balance to transfer.');
                return redirect(route('user.wallet.transfer.to.another'));
            }
            $result = false;
            if(!empty($receiver_user_master))
            {                
               $result = $this->dispatch(new WalletStoreCommand($data, $request, 'transfer')); 
            } else {
                Session::flash('error', 'Receiver id is not found in the system.');
                return redirect(route('user.wallet.transfer.to.another'));
            }
            
            if ($result) {
                Session::flash('success', 'Video link detail save successfully.');
                return redirect(route('user.wallet.transfer.to.another'));
            } else {
                Session::flash('error', 'Fail to store video link detail.');
                return redirect(route('user.wallet.transfer.to.another'));
            }
        } catch (Exception $e) {
            return \Redirect::back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    public function withdrawForm(Request $request)
    {
        try {
            $data = [];

            $data['title']          = 'Withdraw';
            $data['page_title']     = 'Withdraw';
            $data['user']           = Sentinel::getUser();
            $data['user_master']    = UserMaster::getUserMaster($data['user']['user_master_id']);    
            $data['current_balance']    = Wallet::currentBalance($data['user_master']);    
            // $data['transaction_list']         = Wallet::where('user_id', $data['user']['id'])->where('user_master_id', $data['user_master']['id'])->get();
            return \View::make($this->view.'withdraw_money', $data); 
        } catch (Exception $e) {
                
        }
    }

    public function withdrawRequest(Request $request)
    {
        try {
            $user = Sentinel::getUser();
            $data = $request->all();
            $user_master    = UserMaster::getUserMaster($user['user_master_id']); 
            $current_balance = Wallet::currentBalance($user_master);  

            if($current_balance < $data['withdraw_amount'])
            {
                Session::flash('error', 'Your account has insufficient balance to withdraw.');
                return redirect(route('user.wallet.withdraw.index'));
            } 

            $pending_request_count = WithdrawRequests::where('user_master_id', $user_master['id'])->where('withdraw_status',0)->count();
            if($pending_request_count == 0)
            {
                $result = $this->dispatch(new WalletStoreCommand($data, $request, 'withdraw_requests'));            
                if ($result) {
                    Session::flash('success', 'Withdraw request send successfully.');
                    return redirect(route('user.wallet.withdraw.index'));
                } else {
                    Session::flash('error', 'Fail to send withdraw request detail.');
                    return redirect(route('user.wallet.withdraw.index'));
                }
            } else {
                Session::flash('error', 'Already have one request pending. Please wait till that request get accepted or rejected.');
                return redirect(route('user.wallet.withdraw.index'));
            }            
        } catch (Exception $e) {
            return \Redirect::back()->withInput()->withErrors([$e->getMessage()]);
        }
    }
    public function withdrawRequestGetList(Request $request)
    {
        try {
            $user           = Sentinel::getUser();
            $user_master    = UserMaster::getUserMaster($user['user_master_id']);    
            $data           = WithdrawRequests::where('user_id', $user['id'])->where('user_master_id', $user_master['id'])->get();
            return \DataTables::of($data)
                    ->addColumn('withdraw_request_date', function($row) {
                        return $row->withdraw_request_date;
                    })
                    ->addColumn('withdraw_detail', function($row) {
                        return $row->withdraw_detail;
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
                    ->rawColumns(['withdraw_amount'])
                    ->make(true);
        } catch (Exception $e) {
            
        }
    }

    
  

}
