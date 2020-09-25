<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;
use App\DB\RoleUser;
use App\DB\Level;


/* 
Predefined Values:
status : 0-INACTIVE,1-ACTIVE

Foreign Keys:
create_by : FK FROM users Table
update_by : FK FROM users Table
delete_by : FK FROM users Table
artist_id : FK FROM artists_master Table
*/
class UserMaster extends Model
{
    protected $table = 'user_master';

    protected $fillable = [         
        'create_by', 
        'update_by', 
        'sponsor_id',       
        'mlm_side',       
        'self_sponsor_key',
        'name',
        'email',
        'mobile',
        'parent_level',
        'current_level',
        'sponsor_email',
        'address',
        'account_status',
        'has_sponsor',
        'bank_beneficiary_name',
        'account_mumber',
        'ifsc_code',
        'upi_id',
        'sponser_mobile',
        'sponser_unique_id',
        'total_income',
        'total_expense',
        'wallet_balance',
        'paytm_phone'
    ];

    public function sponser() {
        return $this->hasOne('App\DB\UserMaster', 'id', 'sponsor_id');
    }

    public static function getUserMaster($id)
    {
        $data = UserMaster::where('id', '=', $id)->first();

        if(!empty($data)) {
            return $data;
        } else {
            return false;
        }
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

    public static function checkUserMobile($email)
    {
        $count = User::where('email', '=', $email)->count();

        if($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function getSponserDetail($data)
    {
        $sponser_detail = UserMaster::where('self_sponsor_key', $data['user_sponser_id'])->first(); 
        
        if(!empty($sponser_detail))
        {
            return $sponser_detail;
        } else {
            return NULL;
        }
        
    }

    public static function updateSponserLevel($data)
    {
        $sponser_count = UserMaster::where('sponser_unique_id', $data['user_sponser_id'])->count(); 

        // $re = Self::updateSponserLevel($data);

        // dd($sponser_count);

        // dd($sponser_count);
        if($sponser_count == 0)
        {
            $sponser_for_current_insert = UserMaster::where('sponser_unique_id', $data['user_sponser_id'])->first(); 
        } else {
            // dd($sponser_count);
        }

        $sponser_users_list = UserMaster::where('sponser_unique_id', $data['user_sponser_id'])->orderBy('id', 'ASC')->get(); 
        $sponser_users_list_id = UserMaster::where('sponser_unique_id', $data['user_sponser_id'])->orderBy('id', 'ASC')->pluck('id'); 

         \Log::debug('An informational message.------------------------------------------------------------------------------');
            \Log::debug($sponser_users_list_id->toArray());
            \Log::debug('An informational message.------------------------------------------------------------------------------');

        $sponser_child_array = NULL;
        $all_sponser_child_array = NULL;
        $left_insert = NULL;
        $right_insert = NULL;
        $join_under = NULL;
        $sponser_for_current_insert = NULL;

        // \Log::debug('An informational message.------------------------------------------------------------------------------');
        // \Log::debug($sponser_users_list->toArray());
        // \Log::debug('An informational message.------------------------------------------------------------------------------');

        foreach ($sponser_users_list as $key => $sponser_user) {
            $child_users = UserMaster::where('sponser_unique_id', $sponser_user['self_sponsor_key'])->count();   
                   
            $all_sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
            $all_sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];  

           

            // dd($sponser_user['mlm_side'], $child_users);
            if($sponser_user['mlm_side'] == 'L' && $child_users == 0)
            {
                \Log::debug($sponser_user['id']."LLLL 0000");

                if(empty($left_insert))
                {
                    $left_insert = 1;
                    // dd('isit here', $sponser_user);
                }

                if(empty($join_under))
                {
                    $join_under = $sponser_user['id'];
                }

                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
                    $sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];      
                }
                
            } elseif ($sponser_user['mlm_side'] == 'L' && $child_users == 1) {
                \Log::debug($sponser_user['id']."LLLL 1111");
                if(empty($right_insert))
                {
                    $right_insert = 1;
                }   

                if(empty($join_under))
                {
                    $join_under = $sponser_user['id'];
                }
                
                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
                    $sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];      
                }

            } elseif ($sponser_user['mlm_side'] == 'R' && $child_users == 0) {
                \Log::debug($sponser_user['id']."RRRR 0000");
                if(empty($left_insert))
                {
                    $left_insert = 1;
                    // dd('NO  here');
                }

                if(empty($join_under))
                {
                    $join_under = $sponser_user['id'];
                }
                
                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
                    $sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];      
                }

            } elseif ($sponser_user['mlm_side'] == 'R' && $child_users == 1) {
                \Log::debug($sponser_user['id']."LLLL 1111");
                if(empty($right_insert))
                {
                    $right_insert = 1;
                }   

                if(empty($join_under))
                {
                    $join_under = $sponser_user['id'];
                }
                
                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
                    $sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];      
                }

            } elseif ($sponser_user['mlm_side'] == 'L' && $child_users == 2) {
                // $new_spo_id = $sponser_user['id'] + 1;
                 $sponser_for_current_insert_plus = UserMaster::where('sponser_unique_id', $new_spo_id)->first();    

                \Log::debug($sponser_user['id']."LLLL 2222");
                \Log::debug($sponser_for_current_insert_plus['id']."LLLL 2222");
                $sponser_user['user_sponser_id'] = $sponser_for_current_insert_plus['self_sponsor_key'];
                Self::updateSponserLevel($sponser_user);
                // if(empty($right_insert))
                // {
                //     $right_insert = 1;
                //     // dd('NO  here');
                // }else {
                //    $left_insert = 0; 
                // }

                // if(empty($join_under))
                // {
                //     $join_under = $sponser_user['id'];
                // }
                
                // if(empty($sponser_child_array))
                // {
                //     $sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
                //     $sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];      
                // }

            } elseif ($sponser_user['mlm_side'] == 'R' && $child_users == 2) {
                \Log::debug($sponser_user['id']."RRRR 2222");

                     $sponser_user['user_sponser_id'] = $sponser_user['self_sponsor_key'];
                Self::updateSponserLevel($sponser_user);
                

            } elseif (($sponser_user['mlm_side'] == 'L' && $child_users == 0) && ($sponser_user['mlm_side'] == 'R' && $child_users == 0)) {
                // dd($sponser_user->toArray());
                 \Log::debug($sponser_user['id']."LLLL RRRR 2222");
            } else {
                     \Log::debug($sponser_user['id']."CUNT else");
                    dd($sponser_user->toArray());
                    $sponser_user['user_sponser_id'] = $sponser_user['self_sponsor_key'];
                    Self::updateSponserLevel($sponser_user);
            }

            

        }
        // dd($sponser_child_array,$left_insert,$right_insert, $all_sponser_child_array, $join_under);
        // dd($sponser_for_current_insert);
// dd($child_users);
        $result_data['sponser_for_current_insert'] =  UserMaster::where('id', $join_under)->first(); 
        $result_data['result_data'] = $join_under;
        $result_data['left_insert'] = $left_insert;
        $result_data['right_insert'] = $right_insert;

        dd($result_data,$all_sponser_child_array, 'S');

        // if($sponser_count > 0 && $sponser_count <= 2)
        // {
        //     $level = 'LEVEL1';
        // } elseif ($sponser_count > 2 && $sponser_count <= 4) {
        //     $level = 'LEVEL2';
        // } elseif ($sponser_count > 4 && $sponser_count <= 8) {
        //     $level = 'LEVEL3';
        // } elseif ($sponser_count > 8 && $sponser_count <= 16) {
        //     $level = 'LEVEL4';
        // } elseif ($sponser_count > 16 && $sponser_count <= 32) {
        //     $level = 'LEVEL5';
        // } else {
        //     $leevl = "F***ENDGAME";
        // }
        // dd($level); 
        return $result_data;
        
    }

    public static function getTheCorrectSponser($sponser_user)
    {
        // dd($sponser_users_list);

        $sponser_child_array = NULL;
        $all_sponser_child_array = NULL;
        $left_insert = NULL;
        $right_insert = NULL;
        $join_under = NULL;
        $sponser_for_current_insert = NULL;

        // foreach ($sponser_users_list as $key => $sponser_user) {
            if(!empty($sponser_user))
            {
                return 'FUCKING EMPTY';
            }
            $child_users = UserMaster::where('sponser_unique_id', $sponser_user['self_sponsor_key'])->count();   
            // dd($child_users);         
            $all_sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
            $all_sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];  

            // dd($sponser_user['mlm_side'], $child_users);
            if($sponser_user['mlm_side'] == 'L' && $child_users == 0)
            {
                if(empty($left_insert))
                {
                    $left_insert = 1;
                }

                if(empty($join_under))
                {
                    $join_under = $sponser_user['id'];
                }

                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
                    $sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];      
                }

                $result_data['sponser_for_current_insert'] = $sponser_detail = UserMaster::where('id', $join_under)->first(); 
                $result_data['result_data'] = $join_under;
                $result_data['left_insert'] = $left_insert;
                $result_data['right_insert'] = $right_insert;

                return $result_data;
                
            } elseif ($sponser_user['mlm_side'] == 'L' && $child_users == 1) {
                
                if(empty($right_insert))
                {
                    $right_insert = 1;
                } else {
                    $left_insert = 0;
                }   

                if(empty($join_under))
                {
                    $join_under = $sponser_user['id'];
                }
                
                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
                    $sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];      
                }

                $result_data['sponser_for_current_insert'] = $sponser_detail = UserMaster::where('id', $join_under)->first(); 
                $result_data['result_data'] = $join_under;
                $result_data['left_insert'] = $left_insert;
                $result_data['right_insert'] = $right_insert;

                return $result_data;

            } elseif ($sponser_user['mlm_side'] == 'R' && $child_users == 0) {

                if(empty($left_insert))
                {
                    $left_insert = 1;
                } else {
                   $right_insert = 0; 
                }

                if(empty($join_under))
                {
                    $join_under = $sponser_user['id'];
                }
                
                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
                    $sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];      
                }

                $result_data['sponser_for_current_insert'] = $sponser_detail = UserMaster::where('id', $join_under)->first(); 
                $result_data['result_data'] = $join_under;
                $result_data['left_insert'] = $left_insert;
                $result_data['right_insert'] = $right_insert;

                return $result_data;

                // dd($right_insert, $left_insert, $join_under, $sponser_child_array, $sponser_user, 'TEST');

            } elseif ($sponser_user['mlm_side'] == 'R' && $child_users == 1) {
                if(empty($right_insert))
                {
                    $right_insert = 1;
                }   

                if(empty($join_under))
                {
                    $join_under = $sponser_user['id'];
                }
                
                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
                    $sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];      
                }

                $result_data['sponser_for_current_insert'] = $sponser_detail = UserMaster::where('id', $join_under)->first(); 
                $result_data['result_data'] = $join_under;
                $result_data['left_insert'] = $left_insert;
                $result_data['right_insert'] = $right_insert;

                return $result_data;

            } elseif ($sponser_user['mlm_side'] == 'L' && $child_users == 2) {
                
                $sponser_users_list = UserMaster::where('sponser_unique_id', $sponser_user['self_sponsor_key'])->orderBy('id', 'ASC')->get(); 
                dd($sponser_users_list->toArray(), 'TE', $all_sponser_child_array, $sponser_user['self_sponsor_key']);
                $resultLeft = Self::getTheCorrectSponser($sponser_users_list);
                // dd($resultLeft, 'LEFT');
                if(!empty($resultLeft))
                {
                    return $resultLeft;
                } else {
                    // dd($sponser_user['mlm_side'],  $child_users);
                }

            } elseif ($sponser_user['mlm_side'] == 'R' && $child_users == 2) {

                // dd($sponser_user['mlm_side'] , $child_users , 'From');

                // getTheCorrectSponser
                $sponser_users_list = UserMaster::where('sponser_unique_id', $sponser_user['self_sponsor_key'])->orderBy('id', 'ASC')->get(); 
                // dd($sponser_users_list->toArray());
                $resultRight = Self::getTheCorrectSponser($sponser_users_list);
                // dd($resultRight, 'RIG');
                if(!empty($resultRight))
                {
                    return $resultRight;
                }
                // dd($resultLeft, 'TES');

            }  else {
                // dd('test','ELSE');
            }

        // }


        $result_data['sponser_for_current_insert'] = $sponser_detail = UserMaster::where('id', $join_under)->first(); 
        $result_data['result_data'] = $join_under;
        $result_data['left_insert'] = $left_insert;
        $result_data['right_insert'] = $right_insert;

        dd($result_data,$all_sponser_child_array, 'S');

       
    }


    public static function getThirdLevelSponser($sponser_users_list)
    {
        // dd($sponser_users_list);

        $sponser_child_array = NULL;
        $all_sponser_child_array = NULL;
        $left_insert = NULL;
        $right_insert = NULL;
        $join_under = NULL;
        $sponser_for_current_insert = NULL;

        foreach ($sponser_users_list as $key => $sponser_user) {
            $child_users = UserMaster::where('sponser_unique_id', $sponser_user['self_sponsor_key'])->count();   
            // dd($child_users);         
            $all_sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
            $all_sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];  

            // dd($sponser_user['mlm_side'], $child_users);
            if($sponser_user['mlm_side'] == 'L' && $child_users == 0)
            {
                if(empty($left_insert))
                {
                    $left_insert = 1;
                }

                if(empty($join_under))
                {
                    $join_under = $sponser_user['id'];
                }

                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
                    $sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];      
                }

                $result_data['sponser_for_current_insert'] = $sponser_detail = UserMaster::where('id', $join_under)->first(); 
                $result_data['result_data'] = $join_under;
                $result_data['left_insert'] = $left_insert;
                $result_data['right_insert'] = $right_insert;

                return $result_data;
                
            } elseif ($sponser_user['mlm_side'] == 'L' && $child_users == 1) {
                
                if(empty($right_insert))
                {
                    $right_insert = 1;
                } else {
                    $left_insert = 0;
                }   

                if(empty($join_under))
                {
                    $join_under = $sponser_user['id'];
                }
                
                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
                    $sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];      
                }

                $result_data['sponser_for_current_insert'] = $sponser_detail = UserMaster::where('id', $join_under)->first(); 
                $result_data['result_data'] = $join_under;
                $result_data['left_insert'] = $left_insert;
                $result_data['right_insert'] = $right_insert;

                return $result_data;

            } elseif ($sponser_user['mlm_side'] == 'R' && $child_users == 0) {

                if(empty($left_insert))
                {
                    $left_insert = 1;
                } else {
                   $right_insert = 0; 
                }

                if(empty($join_under))
                {
                    $join_under = $sponser_user['id'];
                }
                
                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
                    $sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];      
                }

                $result_data['sponser_for_current_insert'] = $sponser_detail = UserMaster::where('id', $join_under)->first(); 
                $result_data['result_data'] = $join_under;
                $result_data['left_insert'] = $left_insert;
                $result_data['right_insert'] = $right_insert;

                return $result_data;

                // dd($right_insert, $left_insert, $join_under, $sponser_child_array, $sponser_user, 'TEST');

            } elseif ($sponser_user['mlm_side'] == 'R' && $child_users == 1) {
                if(empty($right_insert))
                {
                    $right_insert = 1;
                }   

                if(empty($join_under))
                {
                    $join_under = $sponser_user['id'];
                }
                
                if(empty($sponser_child_array))
                {
                    $sponser_child_array[$sponser_user['id']]['child_count'] = $child_users;
                    $sponser_child_array[$sponser_user['id']]['mlm_side'] = $sponser_user['mlm_side'];      
                }

                $result_data['sponser_for_current_insert'] = $sponser_detail = UserMaster::where('id', $join_under)->first(); 
                $result_data['result_data'] = $join_under;
                $result_data['left_insert'] = $left_insert;
                $result_data['right_insert'] = $right_insert;

                return $result_data;

            }   elseif ($sponser_user['mlm_side'] == 'L' && $child_users == 2) {
                
                $sponser_users_list = UserMaster::where('sponser_unique_id', $sponser_user['self_sponsor_key'])->orderBy('id', 'ASC')->get(); 
                // dd($sponser_users_list->toArray());
                $resultLeft = Self::getThirdLevelSponser($sponser_users_list);
                // dd($resultLeft, 'LEFT');
                if(!empty($resultLeft))
                {
                    return $resultLeft;
                } else {
                    // dd($sponser_user['mlm_side'],  $child_users);
                }

            } elseif ($sponser_user['mlm_side'] == 'R' && $child_users == 2) {

                // dd($sponser_user['mlm_side'] , $child_users , 'From');

                // getTheCorrectSponser
                $sponser_users_list = UserMaster::where('sponser_unique_id', $sponser_user['self_sponsor_key'])->orderBy('id', 'ASC')->get(); 
                // dd($sponser_users_list->toArray());
                $resultRight = Self::getThirdLevelSponser($sponser_users_list);
                // dd($resultRight, 'RIG');
                if(!empty($resultRight))
                {
                    return $resultRight;
                }
                // dd($resultLeft, 'TES');

            }  else {
                dd('test','ELSE' , '3rd');
            }

        }
       
    }


}
