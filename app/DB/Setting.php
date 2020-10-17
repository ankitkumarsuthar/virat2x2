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

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [         
        'user_access'
    ];



}
