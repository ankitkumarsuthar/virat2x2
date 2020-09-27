<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;
use App\DB\UserMaster;
use App\DB\User;
use App\DB\RoleUser;
use App\DB\RefferalBonusSetting;
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

    public static function addApproveWithdrawal($user_master, $user, $withdrawRequests)
     {  
        $admin_user = Sentinel::getUser();
        $record                   = new Wallet();
        $record->create_by        = $admin_user->id;
        $record->user_id          = $user->id;
        $record->user_master_id   = $user_master->id;        
        $record->paid_to_id       = $user->id;        
        $record->pay_amount       = $withdrawRequests->withdraw_amount;   
        $record->payment_detail   = 'Withdrawl Approved !!';
        $record->entry_date       = date('Y-m-d');
        $record->is_earning_money = 0;
        $record->sending_or_receiving = 0;
        $record->payment_status     = 4;
        $result                   = $record->save();
        

        $user_master_record = UserMaster::find($user_master->id);
        // $user_master_record->total_income =  $user_master->total_income + $level->level_payment;
        $user_master_record->wallet_balance =  $user_master->wallet_balance - $withdrawRequests->withdraw_amount;
        $user_master_record->save();

        return $result;
    }

     public static function addReferalPayment($user_master_id)
     {  
        $admin_user = Sentinel::getUser();
        $refferl = RefferalBonusSetting::first();
        $user_master_record = UserMaster::where('self_sponsor_key', $user_master_id)->first();
        $user_record = User::where('user_master_id',$user_master_record->id)->first();        
        // dd($user_record, $user_master_record->id);
        $record                             = new Wallet();
        $record->create_by                  = $admin_user->id;
        $record->user_id                    = $user_record->id;
        $record->user_master_id             = $user_master_record->id;        
        $record->paid_to_id                 = $user_record->id;        
        $record->receiving_money_user_id    = $user_record->id;        
        $record->pay_amount                 = $refferl->refferal_bonus_amount;   
        $record->payment_detail             = 'Refferal Bonus !!';
        $record->entry_date                 = date('Y-m-d');
        $record->is_earning_money           = 0;
        $record->sending_or_receiving       = 1;
        $record->is_it_reference_bonous     = 1;
        $record->payment_status             = 1;
        $result                             = $record->save();
        

        $user_master_record1 = UserMaster::find($user_master_record->id);
        $user_master_record1->total_income      =  $user_master_record->total_income + $refferl->refferal_bonus_amount;
        $user_master_record1->wallet_balance    =  $user_master_record->wallet_balance + $refferl->refferal_bonus_amount;
        $user_master_record1->save();

        return $result;
    }

     public static function currentBalance($user_master)
     {
        $income = Self::userIncome($user_master);   
        $expence = Self::userExpence($user_master);   
        if($income > $expence)
        {
            $final_total = $income - $expence;
            return $final_total;
        } else {
            return 0;
        }        
     }

     public static function userIncome($user_master)
     {
        $user_total_income = Wallet::where('sending_or_receiving', 1)->sum('pay_amount');   
        return $user_total_income;        
     }

     public static function userExpence($user_master)
     {
        $user_total_expence = Wallet::where('sending_or_receiving', 0)->sum('pay_amount');   
        return $user_total_expence;  
     }


}
