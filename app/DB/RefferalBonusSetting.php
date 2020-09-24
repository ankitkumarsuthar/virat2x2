<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;
use App\DB\RoleUser;

/* 
Predefined Values:
status : 0-INACTIVE,1-ACTIVE

Foreign Keys:
create_by : FK FROM users Table
update_by : FK FROM users Table
delete_by : FK FROM users Table
artist_id : FK FROM artists_master Table
*/
class RefferalBonusSetting extends Model
{
    protected $table = 'refferal_bonus_setting';

    protected $fillable = [         
        'refferal_bonus_amount'
    ];

    


}
