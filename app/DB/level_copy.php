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
    	$user_master = UserMaster::where('id', '87')->first();
    	$level_text  = 'LEVEL 1';
    	$tree_user_1st_level           = UserMaster::where('sponser_unique_id',$user_master['self_sponsor_key'])->pluck('self_sponsor_key','id');
    	$level['level2_user']     		= UserMaster::where('sponser_unique_id',$user_master['self_sponsor_key'])->count();
    	$level1_user = Level::where('id',1)->pluck('level_user_count')->toArray();
        
        if($level['level2_user'] == 0)
        {
            $level_text = 'LEVEL 1';
        } elseif (condition) {
            # code...
        }
    	
		$level_text = 'LEVEL 1';    	
		$tree_user_2st_level    = UserMaster::whereIn('sponser_unique_id',$tree_user_1st_level)->pluck('self_sponsor_key','id');
        $level['level2_user']   = UserMaster::whereIn('sponser_unique_id',$tree_user_1st_level)->count();
        $level2_user 			= Level::where('id',2)->pluck('level_user_count')->toArray();
        if($level['level2_user'] >= (int)$level1_user[0])
    	{
    		$level_text = 'LEVEL 2';
    	}	

        dd($level['level2_user']);   

    	$tree_user_3st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_2st_level)->pluck('self_sponsor_key','id');
        $level['level3_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_2st_level)->count();
        $level3_user 			= Level::where('id',3)->pluck('level_user_count')->toArray();
        if($level['level3_user'] >= (int)$level2_user[0])
    	{            
    		$level_text = 'LEVEL 3';
    	}
        // dd($tree_user_3st_level, $level['level3_user']);
    	$tree_user_4st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_3st_level)->pluck('self_sponsor_key','id');
        $level['level4_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_3st_level)->count();
        $level4_user 			= Level::where('id',4)->pluck('level_user_count')->toArray();
        if($level['level4_user'] >= (int)$level3_user[0])
    	{
    		$level_text = 'LEVEL 4';
    	}

  
    	$tree_user_5st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_4st_level)->pluck('self_sponsor_key','id');
        $level['level5_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_4st_level)->count();
        $level5_user 			= Level::where('id',5)->pluck('level_user_count')->toArray();
        if($level['level5_user'] >= (int)$level4_user[0])
    	{
    		$level_text = 'LEVEL 5';
    	}
        
  
    	$tree_user_6st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_5st_level)->pluck('self_sponsor_key','id');
        $level['level6_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_5st_level)->count();
        $level6_user 			= Level::where('id',6)->pluck('level_user_count')->toArray();
        if($level['level6_user'] >= (int)$level5_user[0])
    	{
    		$level_text = 'LEVEL 6';
    	}
    // dd($level['level6_user']);
    	$tree_user_7st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_6st_level)->pluck('self_sponsor_key','id');
        $level['level7_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_6st_level)->count();
        $level7_user 			= Level::where('id',7)->pluck('level_user_count')->toArray();
        if($level['level7_user'] >= (int)$level6_user[0])
    	{
    		$level_text = 'LEVEL 7';
    	}
  
    	$tree_user_8st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_7st_level)->pluck('self_sponsor_key','id');
        $level['level8_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_7st_level)->count();
        $level8_user 			= Level::where('id',8)->pluck('level_user_count')->toArray();
        if($level['level8_user'] >= (int)$level7_user[0])
    	{
    		$level_text = 'LEVEL 8';
    	}
            	
    	$tree_user_9st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_8st_level)->pluck('self_sponsor_key','id');
        $level['level9_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_8st_level)->count();
        $level9_user 			= Level::where('id',8)->pluck('level_user_count')->toArray();
        if($level['level9_user'] >= (int)$level8_user[0])
    	{
    		$level_text = 'LEVEL 9';
    	}
    
        
         	
    	$tree_user_10st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_9st_level)->pluck('self_sponsor_key','id');
        $level['level10_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_9st_level)->count();
        $level10_user 			= Level::where('id',8)->pluck('level_user_count')->toArray();
        if($level['level10_user'] >= (int)$level9_user[0])
    	{
    		$level_text = 'LEVEL 10';
    	}
   		
   		$return_data = [
   			'current_level'=>$level_text,
   			'all_level_array'=>$level
   		];
    	// dd($level_text, $level);
     //    dd($level);
       
     //   	 dd($tree_user_1st_level, $tree_user_2st_level, $tree_user_3st_level, $tree_user_4st_level, $tree_user_5st_level, $tree_user_6st_level, $tree_user_7st_level);


        return $return_data;
    } 

     public static function all_level_user_count($user_master, $level)
    {
    	// $level_array = [];
    	// if($level == 21)
    	// {
    	// 	return $level_array;
    	// }    
    	// if(empty($level))
    	// {
    	// 	$level_count = "Level_1";
    	// } else {
    	// 	$level_count = 'Level_'.$level;
    	// }
    	// $user_master = UserMaster::where('id', $user_master['id'])->first();
    	// $tree_user_1st_level           = UserMaster::whereIn('sponser_unique_id',[$user_master['self_sponsor_key']])->count();
    	// $level_array[$level_count] = $tree_user_1st_level;

    	// Self::all_level_user_count();


    	// $tree_user_1st_level           = UserMaster::where('sponser_unique_id',$user_master['self_sponsor_key'])->pluck('self_sponsor_key','id');
     //    $tree_user_2st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_1st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_3st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_2st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_4st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_3st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_5st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_4st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_6st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_5st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_7st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_6st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_8st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_7st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_9st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_8st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_10st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_9st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_11st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_10st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_12st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_11st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_13st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_12st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_14st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_13st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_15st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_14st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_16st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_15st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_17st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_16st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_18st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_17st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_19st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_18st_level)->pluck('self_sponsor_key','id');
     //    $tree_user_20st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_19st_level)->pluck('self_sponsor_key','id');


        // $tree_user_11st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_10st_level)->pluck('self_sponsor_key','id');
        // $level['level12_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_10st_level)->count();

        // $tree_user_12st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_11st_level)->pluck('self_sponsor_key','id');
        // $level['level12_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_11st_level)->count();

        // $tree_user_13st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_12st_level)->pluck('self_sponsor_key','id');
        // $level['level13_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_12st_level)->count();

        // $tree_user_14st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_13st_level)->pluck('self_sponsor_key','id');
        // $level['level14_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_13st_level)->count();

        // $tree_user_15st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_14st_level)->pluck('self_sponsor_key','id');
        // $level['level15_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_14st_level)->count();

        // $tree_user_16st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_15st_level)->pluck('self_sponsor_key','id');
        // $level['level16_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_15st_level)->count();

        // $tree_user_17st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_16st_level)->pluck('self_sponsor_key','id');
        // $level['level17_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_16st_level)->count();

        // $tree_user_18st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_17st_level)->pluck('self_sponsor_key','id');
        // $level['level18_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_17st_level)->count();

        // $tree_user_19st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_18st_level)->pluck('self_sponsor_key','id');
        // $level['level19_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_18st_level)->count();

        // $tree_user_20st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_19st_level)->pluck('self_sponsor_key','id');
        // $level['level20_user']     = UserMaster::whereIn('sponser_unique_id',$tree_user_19st_level)->count();

    }


    // public static function all_level_user_count($user)
    // {
    // 	$user_master = UserMaster::where('id', $user['user_master_id'])->first();

    // 	$tree_user_1st_level           = UserMaster::where('sponser_unique_id',$user_master['self_sponsor_key'])->pluck('self_sponsor_key','id');
    //     $tree_user_2st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_1st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_3st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_2st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_4st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_3st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_5st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_4st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_6st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_5st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_7st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_6st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_8st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_7st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_9st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_8st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_10st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_9st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_11st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_10st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_12st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_11st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_13st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_12st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_14st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_13st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_15st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_14st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_16st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_15st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_17st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_16st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_18st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_17st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_19st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_18st_level)->pluck('self_sponsor_key','id');
    //     $tree_user_20st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_19st_level)->pluck('self_sponsor_key','id');

    // }


    


}
