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
class Videos extends Model
{
    protected $table = 'video_master';

    protected $fillable = [         
        'create_by', 
        'update_by', 
        'video_link', 
        'video_title', 
        'video_earning_amount', 
        'video_status', 
        'video_detail'
    ];
}
