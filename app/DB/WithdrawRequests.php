<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;
use App\DB\UserMaster;
use App\DB\RoleUser;
use Sentinel;

/* 
Predefined Values:
is_earning_money : 			0-no,1-yes
sending_or_receiving : 		0-sending,1-receiving
is_transfer_money : 	0-no,1-yes
is_it_reference_bonous : 	0-no,1-yes
payment_status : 1-referal, 2-video earning, 3-transfer

Foreign Keys:
create_by : FK FROM users Table
update_by : FK FROM users Table
delete_by : FK FROM users Table
artist_id : FK FROM artists_master Table
*/
class WithdrawRequests extends Model
{
    protected $table = 'withdraw_requests';

    protected $fillable = [         
        'user_id', 
        'request_accept_by_id', 
        'user_master_id', 
        'withdraw_amount', 
        'withdraw_option', 
       	'withdraw_detail', 
        'withdraw_request_date', 
        'withdraw_done_date', 
        'withdraw_status'
    ];

     public function usermaster() {
        return $this->hasOne('App\DB\UserMaster', 'id', 'user_master_id');
    }

     public static function addVideoIncome($user_master, $level)
	 {
	 	$todayVideoIncome = Wallet::where('entry_date', date('Y-m-d'))->first();
	 	if(empty($todayVideoIncome))
	 	{
	 		$user = Sentinel::getUser();
	        $record                   = new Wallet();
	        $record->create_by        = $user->id;
	        $record->user_id          = $user->id;
	        $record->user_master_id   = $user_master->id;
	        $record->level_id   	  = $level->id;
	        $record->pay_amount   	  = $level->level_payment;        
	        $record->payment_detail   = 'Video earning of '.date('d-m-Y');
	        $record->entry_date       = date('Y-m-d');
	        $record->is_earning_money = 1;
	        $record->sending_or_receiving = 1;
	        $record->payment_status = 2;
	        $result                   = $record->save();
        	

            $user_master_record = UserMaster::find($user_master->id);
            $user_master_record->total_income =  $user_master->total_income + $level->level_payment;
            $user_master_record->wallet_balance =  $user_master->wallet_balance + $level->level_payment;
            $user_master_record->save();

            return $result;

	 	}	else {
	 		return true;
	 	} 	
	 }

   


}
