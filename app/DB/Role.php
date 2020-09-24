<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [ 
        'slug', 
        'name', 
        'permissions'
    ];
}
