<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;
use App\DB\UserMaster;
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
class Level extends Model
{
    protected $table = 'level';

    protected $fillable = [         
        'level_title', 
        'level_payment', 
        'level_user_count', 
        'level_gift', 
        'level_date'
    ];


    public static function getUserCurrentLevel($user)
    {
        // dd($user['user_master_id']); 49
    	$user_master = UserMaster::where('id', $user['user_master_id'])->first();
        // $user_master = UserMaster::where('id', '52')->first();
        // dd($user_master->toArray());
    	
    	$tree_user_2st_level           = UserMaster::where('sponser_unique_id',$user_master['self_sponsor_key'])->pluck('self_sponsor_key','id');
    	$level['level2_user']     		= UserMaster::where('sponser_unique_id',$user_master['self_sponsor_key'])->count();
    	$level1_user = Level::where('id',1)->pluck('level_user_count')->toArray();
        
        if($level['level2_user'] == 0)
        {
            $level_text = 'LEVEL 1';
        } elseif ($level['level2_user'] >= 2) {
            $level_text = 'LEVEL 2';
        } else {
            $level_text = 'LEVEL 2';
        }
    	  

		  	
		$tree_user_3st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_2st_level)->pluck('self_sponsor_key','id');
        $level['level3_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_2st_level)->count();
        $level3_user 			= Level::where('id',2)->pluck('level_user_count')->toArray();
        if($level['level3_user'] >= 4)
    	{
    		$level_text = 'LEVEL 3';
    	}

        // dd($level_text);
        
        $tree_user_4st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_3st_level)->pluck('self_sponsor_key','id');
        $level['level4_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_3st_level)->count();
        $level4_user            = Level::where('id',3)->pluck('level_user_count')->toArray();
        if($level['level4_user'] >= 8)
        {
            $level_text = 'LEVEL 4';
        }	

           
        $tree_user_5st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_4st_level)->pluck('self_sponsor_key','id');
        $level['level5_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_4st_level)->count();
        $level5_user            = Level::where('id',4)->pluck('level_user_count')->toArray();
        if($level['level5_user'] >= 16)
        {
            $level_text = 'LEVEL 5';
        } 

        $tree_user_6st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_5st_level)->pluck('self_sponsor_key','id');
        $level['level6_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_5st_level)->count();
        $level6_user            = Level::where('id',5)->pluck('level_user_count')->toArray();
        if($level['level6_user'] >= 32)
        {
            $level_text = 'LEVEL 6';
        } 

        $tree_user_7st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_6st_level)->pluck('self_sponsor_key','id');
        $level['level7_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_6st_level)->count();
        $level7_user            = Level::where('id',6)->pluck('level_user_count')->toArray();
        if($level['level7_user'] >= 64)
        {
            $level_text = 'LEVEL 7';
        } 

        $tree_user_8st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_7st_level)->pluck('self_sponsor_key','id');
        $level['level8_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_7st_level)->count();
        $level8_user            = Level::where('id',7)->pluck('level_user_count')->toArray();
        if($level['level8_user'] >= 128)
        {
            $level_text = 'LEVEL 8';
        }

        $tree_user_9st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_8st_level)->pluck('self_sponsor_key','id');
        $level['level9_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_8st_level)->count();
        $level9_user            = Level::where('id',8)->pluck('level_user_count')->toArray();
        if($level['level9_user'] >= 256)
        {
            $level_text = 'LEVEL 9';
        }

        $tree_user_10st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_9st_level)->pluck('self_sponsor_key','id');
        $level['level10_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_9st_level)->count();
        $level10_user            = Level::where('id',9)->pluck('level_user_count')->toArray();
        if($level['level10_user'] >= 512)
        {
            $level_text = 'LEVEL 10';
        }

        $tree_user_11st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_10st_level)->pluck('self_sponsor_key','id');
        $level['level11_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_10st_level)->count();
        $level11_user            = Level::where('id',10)->pluck('level_user_count')->toArray();
        if($level['level11_user'] >= 1024)
        {
            $level_text = 'LEVEL 11';
        }

        $tree_user_12st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_11st_level)->pluck('self_sponsor_key','id');
        $level['level12_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_11st_level)->count();
        $level12_user            = Level::where('id',11)->pluck('level_user_count')->toArray();
        if($level['level12_user'] >= 2058)
        {
            $level_text = 'LEVEL 12';
        }  

        $tree_user_13st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_12st_level)->pluck('self_sponsor_key','id');
        $level['level13_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_12st_level)->count();
        $level13_user            = Level::where('id',12)->pluck('level_user_count')->toArray();
        if($level['level13_user'] >= 4096)
        {
            $level_text = 'LEVEL 13';
        } 

        $tree_user_14st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_13st_level)->pluck('self_sponsor_key','id');
        $level['level14_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_13st_level)->count();
        $level14_user            = Level::where('id',13)->pluck('level_user_count')->toArray();
        if($level['level14_user'] >= 8192)
        {
            $level_text = 'LEVEL 14';
        }   

        $tree_user_15st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_14st_level)->pluck('self_sponsor_key','id');
        $level['level15_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_14st_level)->count();
        $level15_user            = Level::where('id',14)->pluck('level_user_count')->toArray();
        if($level['level15_user'] >= 16384)
        {
            $level_text = 'LEVEL 15';
        } 

        $tree_user_16st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_15st_level)->pluck('self_sponsor_key','id');
        $level['level16_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_15st_level)->count();
        $level16_user            = Level::where('id',15)->pluck('level_user_count')->toArray();
        if($level['level16_user'] >= 32768)
        {
            $level_text = 'LEVEL 16';
        } 

        $tree_user_17st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_16st_level)->pluck('self_sponsor_key','id');
        $level['level17_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_16st_level)->count();
        $level17_user            = Level::where('id',16)->pluck('level_user_count')->toArray();
        if($level['level17_user'] >= 65536)
        {
            $level_text = 'LEVEL 17';
        } 

        $tree_user_18st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_17st_level)->pluck('self_sponsor_key','id');
        $level['level18_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_17st_level)->count();
        $level18_user            = Level::where('id',17)->pluck('level_user_count')->toArray();
        if($level['level18_user'] >= 131072)
        {
            $level_text = 'LEVEL 18';
        } 

        $tree_user_19st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_18st_level)->pluck('self_sponsor_key','id');
        $level['level19_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_18st_level)->count();
        $level19_user            = Level::where('id',18)->pluck('level_user_count')->toArray();
        if($level['level19_user'] >= 262144)
        {
            $level_text = 'LEVEL 19';
        } 

        $tree_user_20st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_19st_level)->pluck('self_sponsor_key','id');
        $level['level20_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_19st_level)->count();
        $level20_user            = Level::where('id',19)->pluck('level_user_count')->toArray();
        if($level['level20_user'] >= 524288)
        {
            $level_text = 'LEVEL 20';
        }  

        $tree_user_21st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_20st_level)->pluck('self_sponsor_key','id');
        $level['level21_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_20st_level)->count();
        $level21_user            = Level::where('id',20)->pluck('level_user_count')->toArray();
        if($level['level21_user'] >= 1048576)
        {
            $level_text = 'LEVEL 21';
        }  

        $tree_user_22st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_21st_level)->pluck('self_sponsor_key','id');
        $level['level22_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_21st_level)->count();
        $level22_user            = Level::where('id',21)->pluck('level_user_count')->toArray();
        if($level['level22_user'] >= 2097152)
        {
            $level_text = 'LEVEL 22';
        } 

        $tree_user_23st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_22st_level)->pluck('self_sponsor_key','id');
        $level['level23_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_22st_level)->count();
        $level23_user            = Level::where('id',22)->pluck('level_user_count')->toArray();
        if($level['level23_user'] >= 2097152)
        {
            $level_text = 'LEVEL 23';
        }

        $tree_user_24st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_23st_level)->pluck('self_sponsor_key','id');
        $level['level24_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_23st_level)->count();
        $level24_user            = Level::where('id',23)->pluck('level_user_count')->toArray();
        if($level['level24_user'] >= 8388608)
        {
            $level_text = 'LEVEL 24';
        }

        $tree_user_25st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_24st_level)->pluck('self_sponsor_key','id');
        $level['level25_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_24st_level)->count();
        $level25_user            = Level::where('id',24)->pluck('level_user_count')->toArray();
        if($level['level25_user'] >= 16777216)
        {
            $level_text = 'LEVEL 25';
        }

        $tree_user_26level    = UserMaster::whereIn('sponser_unique_id',$tree_user_25st_level)->pluck('self_sponsor_key','id');
        $level['level26_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_25st_level)->count();
        $level26_user            = Level::where('id',25)->pluck('level_user_count')->toArray();
        if($level['level26_user'] >= 33554432)
        {
            $level_text = 'LEVEL 26';
        } 

        $tree_user_27level    = UserMaster::whereIn('sponser_unique_id',$tree_user_26level)->pluck('self_sponsor_key','id');
        $level['level27_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_26level)->count();
        $level27_user            = Level::where('id',26)->pluck('level_user_count')->toArray();
        if($level['level27_user'] >= 67108864)
        {
            $level_text = 'LEVEL 27';
        } 

        $tree_user_28level    = UserMaster::whereIn('sponser_unique_id',$tree_user_27level)->pluck('self_sponsor_key','id');
        $level['level28_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_27level)->count();
        $level28_user            = Level::where('id',27)->pluck('level_user_count')->toArray();
        if($level['level28_user'] >= 134217728)
        {
            $level_text = 'LEVEL 28';
        }  

        $tree_user_29level    = UserMaster::whereIn('sponser_unique_id',$tree_user_28level)->pluck('self_sponsor_key','id');
        $level['level29_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_28level)->count();
        $level29_user            = Level::where('id',28)->pluck('level_user_count')->toArray();
        if($level['level29_user'] >= 268435456)
        {
            $level_text = 'LEVEL 29';
        }

        $tree_user_30level    = UserMaster::whereIn('sponser_unique_id',$tree_user_29level)->pluck('self_sponsor_key','id');
        $level['level30_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_29level)->count();
        $level30_user            = Level::where('id',29)->pluck('level_user_count')->toArray();
        if($level['level30_user'] >= 536870912)
        {
            $level_text = 'LEVEL 30';
        }   

        if(empty($level_text))
        {
            $level_text = 'CONTACT ADMIN FOR LEVEL INFO';
            // dd('tas', $user->toArray(), $level['level2_user']);
        }

   		$return_data = [
   			'current_level'=>$level_text,
   			'all_level_array'=>$level
   		];


        return $return_data;
    } 


    public static function getUserCurrentLevel2($user)
    {
        // dd($user['user_master_id']); 49
        $user_master = UserMaster::where('id', $user['user_master_id'])->first();
        // $user_master = UserMaster::where('id', '52')->first();
        // dd($user_master->toArray());
        
        $tree_user_2st_level           = UserMaster::where('sponser_unique_id',$user_master['self_sponsor_key'])->pluck('self_sponsor_key','id');
        $level['level2_user']           = UserMaster::where('sponser_unique_id',$user_master['self_sponsor_key'])->count();
        $level1_user = Level::where('id',1)->pluck('level_user_count')->toArray();
        
        if($level['level2_user'] == 0)
        {
            $level_text = 'LEVEL 1';
        } elseif ($level['level2_user'] >= 2) {
            $level_text = 'LEVEL 2';
        } else {
            $level_text = 'LEVEL 2';
        }
          

            
        $tree_user_3st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_2st_level)->pluck('self_sponsor_key','id');
        $level['level3_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_2st_level)->count();
        $level3_user            = Level::where('id',2)->pluck('level_user_count')->toArray();
        if($level['level3_user'] >= 4)
        {
            $level_text = 'LEVEL 3';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        // dd($level_text);
        
        $tree_user_4st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_3st_level)->pluck('self_sponsor_key','id');
        $level['level4_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_3st_level)->count();
        $level4_user            = Level::where('id',3)->pluck('level_user_count')->toArray();
        if($level['level4_user'] >= 8)
        {
            $level_text = 'LEVEL 4';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }  

           
        $tree_user_5st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_4st_level)->pluck('self_sponsor_key','id');
        $level['level5_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_4st_level)->count();
        $level5_user            = Level::where('id',4)->pluck('level_user_count')->toArray();
        if($level['level5_user'] >= 16)
        {
            $level_text = 'LEVEL 5';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_6st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_5st_level)->pluck('self_sponsor_key','id');
        $level['level6_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_5st_level)->count();
        $level6_user            = Level::where('id',5)->pluck('level_user_count')->toArray();
        if($level['level6_user'] >= 32)
        {
            $level_text = 'LEVEL 6';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_7st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_6st_level)->pluck('self_sponsor_key','id');
        $level['level7_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_6st_level)->count();
        $level7_user            = Level::where('id',6)->pluck('level_user_count')->toArray();
        if($level['level7_user'] >= 64)
        {
            $level_text = 'LEVEL 7';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        } 

        $tree_user_8st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_7st_level)->pluck('self_sponsor_key','id');
        $level['level8_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_7st_level)->count();
        $level8_user            = Level::where('id',7)->pluck('level_user_count')->toArray();
        if($level['level8_user'] >= 128)
        {
            $level_text = 'LEVEL 8';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_9st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_8st_level)->pluck('self_sponsor_key','id');
        $level['level9_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_8st_level)->count();
        $level9_user            = Level::where('id',8)->pluck('level_user_count')->toArray();
        if($level['level9_user'] >= 256)
        {
            $level_text = 'LEVEL 9';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_10st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_9st_level)->pluck('self_sponsor_key','id');
        $level['level10_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_9st_level)->count();
        $level10_user            = Level::where('id',9)->pluck('level_user_count')->toArray();
        if($level['level10_user'] >= 512)
        {
            $level_text = 'LEVEL 10';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_11st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_10st_level)->pluck('self_sponsor_key','id');
        $level['level11_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_10st_level)->count();
        $level11_user            = Level::where('id',10)->pluck('level_user_count')->toArray();
        if($level['level11_user'] >= 1024)
        {
            $level_text = 'LEVEL 11';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_12st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_11st_level)->pluck('self_sponsor_key','id');
        $level['level12_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_11st_level)->count();
        $level12_user            = Level::where('id',11)->pluck('level_user_count')->toArray();
        if($level['level12_user'] >= 2058)
        {
            $level_text = 'LEVEL 12';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }   

        $tree_user_13st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_12st_level)->pluck('self_sponsor_key','id');
        $level['level13_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_12st_level)->count();
        $level13_user            = Level::where('id',12)->pluck('level_user_count')->toArray();
        if($level['level13_user'] >= 4096)
        {
            $level_text = 'LEVEL 13';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        } 

        $tree_user_14st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_13st_level)->pluck('self_sponsor_key','id');
        $level['level14_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_13st_level)->count();
        $level14_user            = Level::where('id',13)->pluck('level_user_count')->toArray();
        if($level['level14_user'] >= 8192)
        {
            $level_text = 'LEVEL 14';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }  

        $tree_user_15st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_14st_level)->pluck('self_sponsor_key','id');
        $level['level15_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_14st_level)->count();
        $level15_user            = Level::where('id',14)->pluck('level_user_count')->toArray();
        if($level['level15_user'] >= 16384)
        {
            $level_text = 'LEVEL 15';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_16st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_15st_level)->pluck('self_sponsor_key','id');
        $level['level16_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_15st_level)->count();
        $level16_user            = Level::where('id',15)->pluck('level_user_count')->toArray();
        if($level['level16_user'] >= 32768)
        {
            $level_text = 'LEVEL 16';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_17st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_16st_level)->pluck('self_sponsor_key','id');
        $level['level17_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_16st_level)->count();
        $level17_user            = Level::where('id',16)->pluck('level_user_count')->toArray();
        if($level['level17_user'] >= 65536)
        {
            $level_text = 'LEVEL 17';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_18st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_17st_level)->pluck('self_sponsor_key','id');
        $level['level18_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_17st_level)->count();
        $level18_user            = Level::where('id',17)->pluck('level_user_count')->toArray();
        if($level['level18_user'] >= 131072)
        {
            $level_text = 'LEVEL 18';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_19st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_18st_level)->pluck('self_sponsor_key','id');
        $level['level19_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_18st_level)->count();
        $level19_user            = Level::where('id',18)->pluck('level_user_count')->toArray();
        if($level['level19_user'] >= 262144)
        {
            $level_text = 'LEVEL 19';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_20st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_19st_level)->pluck('self_sponsor_key','id');
        $level['level20_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_19st_level)->count();
        $level20_user            = Level::where('id',19)->pluck('level_user_count')->toArray();
        if($level['level20_user'] >= 524288)
        {
            $level_text = 'LEVEL 20';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        } 

        $tree_user_21st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_20st_level)->pluck('self_sponsor_key','id');
        $level['level21_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_20st_level)->count();
        $level21_user            = Level::where('id',20)->pluck('level_user_count')->toArray();
        if($level['level21_user'] >= 1048576)
        {
            $level_text = 'LEVEL 21';
        }  else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_22st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_21st_level)->pluck('self_sponsor_key','id');
        $level['level22_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_21st_level)->count();
        $level22_user            = Level::where('id',21)->pluck('level_user_count')->toArray();
        if($level['level22_user'] >= 2097152)
        {
            $level_text = 'LEVEL 22';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_23st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_22st_level)->pluck('self_sponsor_key','id');
        $level['level23_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_22st_level)->count();
        $level23_user            = Level::where('id',22)->pluck('level_user_count')->toArray();
        if($level['level23_user'] >= 2097152)
        {
            $level_text = 'LEVEL 23';
        }else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_24st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_23st_level)->pluck('self_sponsor_key','id');
        $level['level24_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_23st_level)->count();
        $level24_user            = Level::where('id',23)->pluck('level_user_count')->toArray();
        if($level['level24_user'] >= 8388608)
        {
            $level_text = 'LEVEL 24';
        }else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_25st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_24st_level)->pluck('self_sponsor_key','id');
        $level['level25_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_24st_level)->count();
        $level25_user            = Level::where('id',24)->pluck('level_user_count')->toArray();
        if($level['level25_user'] >= 16777216)
        {
            $level_text = 'LEVEL 25';
        }else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_26level    = UserMaster::whereIn('sponser_unique_id',$tree_user_25st_level)->pluck('self_sponsor_key','id');
        $level['level26_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_25st_level)->count();
        $level26_user            = Level::where('id',25)->pluck('level_user_count')->toArray();
        if($level['level26_user'] >= 33554432)
        {
            $level_text = 'LEVEL 26';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_27level    = UserMaster::whereIn('sponser_unique_id',$tree_user_26level)->pluck('self_sponsor_key','id');
        $level['level27_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_26level)->count();
        $level27_user            = Level::where('id',26)->pluck('level_user_count')->toArray();
        if($level['level27_user'] >= 67108864)
        {
            $level_text = 'LEVEL 27';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_28level    = UserMaster::whereIn('sponser_unique_id',$tree_user_27level)->pluck('self_sponsor_key','id');
        $level['level28_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_27level)->count();
        $level28_user            = Level::where('id',27)->pluck('level_user_count')->toArray();
        if($level['level28_user'] >= 134217728)
        {
            $level_text = 'LEVEL 28';
        }else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        } 

        $tree_user_29level    = UserMaster::whereIn('sponser_unique_id',$tree_user_28level)->pluck('self_sponsor_key','id');
        $level['level29_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_28level)->count();
        $level29_user            = Level::where('id',28)->pluck('level_user_count')->toArray();
        if($level['level29_user'] >= 268435456)
        {
            $level_text = 'LEVEL 29';
        }else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }

        $tree_user_30level    = UserMaster::whereIn('sponser_unique_id',$tree_user_29level)->pluck('self_sponsor_key','id');
        $level['level30_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_29level)->count();
        $level30_user            = Level::where('id',29)->pluck('level_user_count')->toArray();
        if($level['level30_user'] >= 536870912)
        {
            $level_text = 'LEVEL 30';
        } else {
             $return_data = [
                'current_level'=>$level_text,
                'all_level_array'=>$level
            ];
            return $return_data;
        }  

        if(empty($level_text))
        {
            $level_text = 'CONTACT ADMIN FOR LEVEL INFO';
            // dd('tas', $user->toArray(), $level['level2_user']);
        }

       
    } 

    //  public static function all_level_user_count($user_master, $level)
    // {
    
        // INSERT INTO `level` (`id`, `level_title`, `level_payment`, `level_user_count`, `level_gift`, `level_date`, `created_at`, `updated_at`) VALUES
        // (null, 'LEVEL 1', 100, '2', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 2', 150, '4', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 3', 200, '8', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 4', 250, '16', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 5', 350, '32', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 6', 500, '64', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 7', 750, '128', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 8', 1000, '256', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 9', 1500, '512', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 10', 2000, '1024', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 11', 2500, '2048', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 12', 3600, '4096', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 13', 4200, '8192', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 14', 5000, '16384', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 15', 6000, '32768', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 16', 7000, '65536', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 17', 8000, '131072', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 18', 9200, '262144', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 19', 10400, '524288', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 20', 11400, '1048576', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 21', 12500, '2097152', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 22', 13500, '4194304', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 23', 14800, '8388608', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 24', 16000, '16777216', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 25', 17500, '33554432', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 26', 18500, '67108864', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 27', 20000, '134217728', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 28', 21500, '268435456', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 29', 22500, '536870912', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27'),
        // (null, 'LEVEL 30', 25000, '1073741824', 'NO OFFER', NULL, NULL, '2020-10-08 14:54:27');

    // }

    


}
