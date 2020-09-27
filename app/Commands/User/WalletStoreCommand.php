<?php

namespace App\Commands\User;

use Illuminate\Console\Command;
use App\DB\User;
use App\DB\UserMaster;
use App\DB\Wallet;
use App\DB\WithdrawRequests;
use Carbon\Carbon;
use Sentinel;

class WalletStoreCommand extends Command
{
    public $data;
    public $request;
    public $operation = 'new';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($data, $request, $operation = 'new')
    {
        $this->data = $data;
        $this->request = $request;
        $this->operation = $operation;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = Sentinel::getUser();
        if ($this->operation == 'transfer') {                       
            $sender_user_master    = UserMaster::getUserMaster($user['user_master_id']); 
            $receiver_user_master  = UserMaster::where('self_sponsor_key', $this->data['receiver_unique_id'])->first(); 
            $receiver_user = User::where('user_master_id', $receiver_user_master['id'])->first();

            $record                                 = new Wallet();
            $record->create_by                      = $user->id;
            $record->user_id                        = $user->id;
            $record->user_master_id                 = $sender_user_master->id;            
            $record->transfer_to_id                 = $receiver_user->id;            
            $record->sending_money_user_id          = $user->id;            
            $record->receiving_money_user_id        = $receiver_user->id;            
            $record->paid_to_id                     = $receiver_user->id;            
            $record->pay_amount                     = $this->data['transfer_amount'];        
            $record->payment_detail                 = 'Transfer to '.$receiver_user_master->name.'. || Transfer Message:'.$this->data['transfer_message'];
            $record->entry_date                     = date('Y-m-d');
            $record->is_earning_money               = 0;
            $record->sending_or_receiving           = 0;
            $record->is_transfer_money              = 1;
            $record->payment_status                 = 3;
            $result                                 = $record->save();

            $user_master_record = UserMaster::find($sender_user_master->id);
            $user_master_record->total_expense =  $sender_user_master->total_expense + $this->data['transfer_amount'];
            $user_master_record->wallet_balance =  $sender_user_master->wallet_balance - $this->data['transfer_amount'];
            $user_master_record->save();

            $receiver_user_master_record = UserMaster::find($receiver_user_master->id);
            $receiver_user_master_record->total_income =  $receiver_user_master->total_income + $this->data['transfer_amount'];
            $receiver_user_master_record->wallet_balance =  $receiver_user_master->wallet_balance + $this->data['transfer_amount'];
            $receiver_user_master_record->save();

            return $result;

        } else if ($this->operation == 'withdraw_requests') {            
            $user_master    = UserMaster::getUserMaster($user['user_master_id']); 
            $record                               = new WithdrawRequests();
            $record->user_id                      = $user->id;
            $record->user_master_id               = $user_master->id;
            $record->withdraw_option              = $this->data['withdraw_option'];
            $record->withdraw_amount              = $this->data['withdraw_amount'];
            $record->withdraw_detail              = "Request sent !!!";
            $record->withdraw_request_date        = date('Y-m-d');
            $record->withdraw_status              = 0;
            $result =$record->save();
            return $result;            
        } else if ($this->operation == 'delete') {            
        }
    }
}
