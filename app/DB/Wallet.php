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
class Wallet extends Model
{
    protected $table = 'wallet_master';

    protected $fillable = [         
        'create_by', 
        'update_by', 
        'user_id', 
        'user_master_id', 
       	'level_id', 
        'transfer_to_id', 
        'paid_to_id', 
        'referal_id', 
        'sending_money_user_id', 
        'receiving_money_user_id', 
        'payment_mobile', 
        'pay_amount', 
        'payment_detail', 
        'is_earning_money', 
        'sending_or_receiving', 
        'is_transfer_money', 
        'is_it_reference_bonous', 
        'entry_date', 
        'payment_status'
    ];

     public static function addVideoIncome($user_master, $level)
	 {
	 	$todayVideoIncome = Wallet::where('entry_date', date('Y-m-d'))->first();
	 	if(empty($todayVideoIncome->toArray()))
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
        	return $result;
	 	}	else {
	 		return true;
	 	} 	
	 }


}
