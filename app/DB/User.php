<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;
use App\DB\RoleUser;
use App\DB\UserMaster;

/* 
Predefined Values:
status : 0-INACTIVE,1-ACTIVE

Foreign Keys:
create_by : FK FROM users Table
update_by : FK FROM users Table
delete_by : FK FROM users Table
artist_id : FK FROM artists_master Table
*/
class User extends Model
{
    protected $table = 'users';

    protected $fillable = [         
        'user_master_id', 
        'email', 
        'password',       
        'permissions',
        'last_login',
        'first_name',
        'last_name'
    ];

    public function usermaster() {
        return $this->hasOne('App\DB\UserMaster', 'id', 'user_master_id');
    }

    public static function checkUserIsAdmin($user_id)
    {
        $status = false;

        $count  = RoleUser::where('role_id', '=', 1)->where('user_id', '=', $user_id)->count();

        if($count > 0) {
            $status = true;
        }

        return $status;
    } 

    public static function checkUserIsFrontUser($user_id)
    {
        $status = false;

        $count  = RoleUser::where('role_id', '=', 3)->where('user_id', '=', $user_id)->count();

        if($count > 0) {
            $status = true;
        }

        return $status;
    } 

    public static function updateLoginTime($user_id) 
    {  
        $user   = User::find($user_id);

        // $last_login     = $user->last_login;

        $user->last_login    = date('Y-m-d H:i:s');
        // $user->last_login       = $last_login;
        $user->save();

        return true;
    } 

    public static function checkUserEmail($email)
    {
        $count = User::where('email', '=', $email)->count();

        if($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function adminCheckUserEmail2($email, $id)
    {
        $count = User::where('email', '=', $email)->where('id', '!=', $id)->count();   

        if($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function checkUserMobile($email)
    {
        $count = User::where('email', '=', $email)->count();

        if($count > 0) {
            return false;
        } else {
            return true;
        }
    }

     public static function generateSponserId($data)
    {
       $name_without_space = str_replace(' ', '', $data['user_name']);
       $phone_without_space = str_replace(' ', '', $data['user_mobile']);

       $name_5_letter = substr( $name_without_space, 0 , 5 );
       $phone_5_letter = substr( $phone_without_space, 0 , 5 );

       
       

       dd($data, 'test', $name_without_space, $name_5_letter, $phone_5_letter);

    }

    public static function getUserChildList($sponser_id, &$p)
    {

        $sponser_data = UserMaster::where('sponser_unique_id', $sponser_id)->get();
        // dd($sponser_data);

        if(!empty($sponser_data->toArray()))
        {
            foreach ($sponser_data as $key => $sponser) {
                if(!empty($sponser['self_sponsor_key']))
                {
                    $p[] = $sponser['self_sponsor_key'];
                    Self::getUserChildList($sponser['self_sponsor_key'], $p);
                }
            }
        }

        // $query = 'select * from mlm where id = ' . $id;
        // $result = mysqli_query($mysqli, $query);
        // if ($result->num_rows) {
        //     while($row = $result->fetch_array(MYSQLI_ASSOC)){
        //         if ($row['parent_id']!= 0)
        //             $p[] = $row['parent_id'];
        //         get_parents_loop($row['parent_id'], $p, $mysqli);
        //     }
        // }
        return $p;

    }



    public static function getAllChildFullDetailForTree($sponser_all_child_list)
    {
        foreach ($sponser_all_child_list as $key => $sponser_key) {           
           $sponser_data = UserMaster::where('self_sponsor_key', $sponser_key)->orderBy('id', 'ASC')->select('id','self_sponsor_key','sponser_unique_id','mlm_side')->first()->toArray();

           $data[$sponser_data['id']] = [
                'self_sponsor_key'=>$sponser_data['self_sponsor_key'],
                'sponser_unique_id'=>$sponser_data['sponser_unique_id'],
                'mlm_side'=>$sponser_data['mlm_side'],
                'id'=>$sponser_data['id']
            ];
            ksort($data);
        }
        
        return $data;
    }


    public static function getAllChildFullDetail($sponser_all_child_list)
    {
        
        foreach ($sponser_all_child_list as $key => $sponser_key) {           
           $sponser_data = UserMaster::where('self_sponsor_key', $sponser_key)->orderBy('id', 'ASC')->select('id','self_sponsor_key','sponser_unique_id','mlm_side')->first()->toArray();

           $data[$sponser_data['id']] = [
                'self_sponsor_key'=>$sponser_data['self_sponsor_key'],
                'sponser_unique_id'=>$sponser_data['sponser_unique_id'],
                'mlm_side'=>$sponser_data['mlm_side'],
                'id'=>$sponser_data['id']
            ];
            ksort($data);
        }
        
        // dd($data);
         

        foreach ($data as $key => $single_data) {
            $sponser_count = UserMaster::where('sponser_unique_id', $single_data['self_sponsor_key'])->count();
            if($sponser_count != 2)
            {
                $result = Self::updateSponserLevel($single_data);
                if(!empty($result['sponser_for_current_insert']))
                {
                    return $result;
                }
            }

        }

         // dd($data, $result, 'ET');     

    }

    public static function updateSponserLevel($data)
    {
        $sponser_count = UserMaster::where('sponser_unique_id', $data['self_sponsor_key'])->count();   
        $sponser_for_current_insert = UserMaster::where('self_sponsor_key', $data['self_sponsor_key'])->first();       
        // dd($data['self_sponsor_key'], $sponser_for_current_insert);
        // if($sponser_count == 0)
        // {
        //     $sponser_for_current_insert = UserMaster::where('self_sponsor_key', $data['self_sponsor_key'])->first(); 
        //     // dd($sponser_for_current_insert);
        //     $sponser_users_list = UserMaster::where('sponser_unique_id', $sponser_for_current_insert['self_sponsor_key'])->orderBy('id', 'ASC')->get(); 
        //     $sponser_users_list_id = UserMaster::where('sponser_unique_id', $sponser_for_current_insert['self_sponsor_key'])->orderBy('id', 'ASC')->pluck('id');
        // } else {

        //     $sponser_users_list = UserMaster::where('sponser_unique_id', $data['self_sponsor_key'])->orderBy('id', 'ASC')->get(); 
        //     $sponser_users_list_id = UserMaster::where('sponser_unique_id', $data['self_sponsor_key'])->orderBy('id', 'ASC')->pluck('id');
        // }

         



        // dd($sponser_users_list, $sponser_users_list_id, $sponser_count, $data['self_sponsor_key']);

        \Log::debug('An informational message.------------------------------------------------------------------------------');
        // \Log::debug($sponser_users_list_id->toArray());
        \Log::debug('An informational message.------------------------------------------------------------------------------');

        $sponser_child_array = NULL;
        $all_sponser_child_array = NULL;
        $left_insert = NULL;
        $right_insert = NULL;
        $join_under = NULL;
        // $sponser_for_current_insert = NULL;

        // \Log::debug('An informational message.------------------------------------------------------------------------------');
        // \Log::debug($sponser_users_list->toArray());
        // \Log::debug('An informational message.------------------------------------------------------------------------------');

        // foreach ($sponser_users_list as $key => $sponser_user) {
            // $sponser_count = UserMaster::where('sponser_unique_id', $sponser_for_current_insert['self_sponsor_key'])->count();   
                   // dd($sponser_for_current_insert);
            // $all_sponser_child_array[$sponser_for_current_insert['id']]['child_count'] = $sponser_count;
            // $all_sponser_child_array[$sponser_for_current_insert['id']]['mlm_side'] = $sponser_for_current_insert['mlm_side'];  

           

            // dd($sponser_for_current_insert['mlm_side'], $sponser_count);
            if($sponser_for_current_insert['mlm_side'] == 'L' && $sponser_count == 0)
            {
                \Log::debug($sponser_for_current_insert['id']."LLLL 0000");

                if(empty($left_insert))
                {
                    $left_insert = 1;
                    // dd('isit here', $sponser_for_current_insert);
                }

                if(empty($join_under))
                {
                    $join_under = $sponser_for_current_insert['id'];
                }

                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_for_current_insert['id']]['child_count'] = $sponser_count;
                    $sponser_child_array[$sponser_for_current_insert['id']]['mlm_side'] = $sponser_for_current_insert['mlm_side'];      
                }
                
            } elseif ($sponser_for_current_insert['mlm_side'] == 'L' && $sponser_count == 1) {
                \Log::debug($sponser_for_current_insert['id']."LLLL 1111");
                if(empty($right_insert))
                {
                    $right_insert = 1;
                }   

                if(empty($join_under))
                {
                    $join_under = $sponser_for_current_insert['id'];
                }
                
                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_for_current_insert['id']]['child_count'] = $sponser_count;
                    $sponser_child_array[$sponser_for_current_insert['id']]['mlm_side'] = $sponser_for_current_insert['mlm_side'];      
                }

            } elseif ($sponser_for_current_insert['mlm_side'] == 'R' && $sponser_count == 0) {
                \Log::debug($sponser_for_current_insert['id']."RRRR 0000");
                if(empty($left_insert))
                {
                    $left_insert = 1;
                    // dd('NO  here');
                }

                if(empty($join_under))
                {
                    $join_under = $sponser_for_current_insert['id'];
                }
                
                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_for_current_insert['id']]['child_count'] = $sponser_count;
                    $sponser_child_array[$sponser_for_current_insert['id']]['mlm_side'] = $sponser_for_current_insert['mlm_side'];      
                }

            } elseif ($sponser_for_current_insert['mlm_side'] == 'R' && $sponser_count == 1) {
                \Log::debug($sponser_for_current_insert['id']."LLLL 1111");
                if(empty($right_insert))
                {
                    $right_insert = 1;
                }   

                if(empty($join_under))
                {
                    $join_under = $sponser_for_current_insert['id'];
                }
                
                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_for_current_insert['id']]['child_count'] = $sponser_count;
                    $sponser_child_array[$sponser_for_current_insert['id']]['mlm_side'] = $sponser_for_current_insert['mlm_side'];      
                }

            } elseif ($sponser_for_current_insert['mlm_side'] == 'L' && $sponser_count == 2) {
                // dd($sponser_for_current_insert);
                 $sponser_for_current_insert_plus = UserMaster::where('sponser_unique_id', $sponser_for_current_insert['self_sponsor_key'])->first();    

                \Log::debug($sponser_for_current_insert['id']."LLLL 2222");
                \Log::debug($sponser_for_current_insert_plus['id']."LLLL 2222");
                // $sponser_for_current_insert['self_sponsor_key'] = $sponser_for_current_insert_plus['self_sponsor_key'];
                // Self::updateSponserLevel($sponser_for_current_insert);
               

            } elseif ($sponser_for_current_insert['mlm_side'] == 'R' && $sponser_count == 2) {
                \Log::debug($sponser_for_current_insert['id']."RRRR 2222");

                     // $sponser_for_current_insert['self_sponsor_key'] = $sponser_for_current_insert['self_sponsor_key'];
                // Self::updateSponserLevel($sponser_for_current_insert);
                

            } elseif (($sponser_for_current_insert['mlm_side'] == 'L' && $sponser_count == 0) && ($sponser_for_current_insert['mlm_side'] == 'R' && $sponser_count == 0)) {
                // dd($sponser_for_current_insert->toArray());
                 \Log::debug($sponser_for_current_insert['id']."LLLL RRRR 2222");
            } else {
                     \Log::debug($sponser_for_current_insert['id']."call admin");
                    // dd($sponser_for_current_insert->toArray());
                    // $sponser_for_current_insert['self_sponsor_key'] = $sponser_for_current_insert['self_sponsor_key'];
                    // Self::updateSponserLevel($sponser_for_current_insert);
            }

            

        // }
        
        $result_data['sponser_for_current_insert'] =  UserMaster::where('id', $join_under)->first(); 
        $result_data['result_data'] = $join_under;
        $result_data['left_insert'] = $left_insert;
        $result_data['right_insert'] = $right_insert;

        // dd($result_data,$all_sponser_child_array, 'S');

        return $result_data;
        
    }

    public static function checkAdminUserEmail($email,$id)
    {
        $count = User::where('email', '=', $email)->where('id', '!=', $id)->count();   
        if($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function getChildForTreeOneByOne($sponser_key, $child_array)
    {
        $next_level_user = UserMaster::whereIn('sponser_unique_id',[$sponser_key])->pluck('self_sponsor_key');
        // dd($sponser_key, $child_array, $next_level_user);
        if(!empty($next_level_user->toArray()))
        {
            foreach ($next_level_user as $key => $next_user) {
                // dd($next_user);
                $child_array[] = $next_user;
                implode("","",$child_array);
                Self::getChildForTreeOneByOne($next_user, $child_array);
            }
        }

        dd($child_array);
    }


}
