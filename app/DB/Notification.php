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
class Notification extends Model
{
    protected $table = 'notification';

    protected $fillable = [         
        'user_id', 
        'title', 
        'details', 
        'insert_date', 
        'status'
    ];

     public function userdetail() {
        return $this->hasOne('App\DB\User', 'id', 'user_id');
    }

     public static function getTreeUlLi($parent_sponser_key)
	 {
	 		$parent_data  			= UserMaster::where('self_sponsor_key',$parent_sponser_key)->first();
	 		$tree_user_1st_level    = UserMaster::where('sponser_unique_id',$parent_sponser_key)->get();
	 		$left_user = [];
	 		$right_user = [];
	 		// dd($tree_user_1st_level, $parent_data);
	 		foreach ($tree_user_1st_level as $users) {	 			
	 			if($users->mlm_side == 'L')
	 			{
	 				$left_user = $users;
	 			}

	 			if($users->mlm_side == 'R')
	 			{
	 				$right_user = $users;
	 			}
	 		}
	 		
	 		$html = '<li>
                        <a href="#">'.$parent_data['name'].'</a>
                        <ul>
                            <li>
                                <a href="#">'.@$left_user['name'].'</a>
                            </li>
                            <li>
                                <a href="#">'.@$right_user['name'].'</a>
                            </li>
                        </ul>
                    </li>';
                    // dd($html);
	 }

   


}
