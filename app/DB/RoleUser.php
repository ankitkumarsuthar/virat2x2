<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;

/* 
Foreign Keys:
role_id : FK FROM roles Table
user_id : FK FROM users Table
*/
class RoleUser extends Model
{
    protected $table = 'role_users';

    protected $fillable = [ 
        'role_id', 
        'user_id'
    ];
}
