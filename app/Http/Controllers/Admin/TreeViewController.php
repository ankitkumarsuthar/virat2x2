<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\Session;
use App\DB\UserMaster;
use App\DB\User;
use App\DB\Notification;

class TreeViewController extends Controller
{
    public $view                = '';    

    public function __construct() {
        $this->view             = 'admin.tree.';                  
    }
    public function baseUser($baseUser)
    {
      
      $parent = array();
      $parent[] = array(
          'self_sponsor_key' => $baseUser->self_sponsor_key,
          'sponser_unique_id' => $baseUser->sponser_unique_id,
          'id' => $baseUser->id,
          'name' => $baseUser->name,
          'child' => $this->childs($baseUser->self_sponsor_key),
        );
      return $parent;
    }

    public function childs($self_sponsor_key)
    { 
     
        $childUsers = \DB::table('user_master')->whereNotNull('self_sponsor_key')->where('sponser_unique_id',$self_sponsor_key)->get()->toArray();
        $childs = array();
      
      foreach ($childUsers as $key => $value) {
        $childs[] = array(
          'self_sponsor_key' => $value->self_sponsor_key,
          'sponser_unique_id' => $value->sponser_unique_id,
          'id' => $value->id,
          'name' => $value->name,
          'child' => $this->childs($value->self_sponsor_key),
        );
      }
      return $childs;
    }

    public static function subChilds($categories)
    {
      $html = '<ul>';
      
      foreach($categories as $category){
        $html .= '<li><a href="#">'.$category['name'].'</a>';
            if( ! empty($category['child'])){
                $html .= Self::subChilds($category['child']).'</li>';
            }
      }
      $html .= '</ul>';
      return $html;
    }

    public function index(Request $request)
    {
        try {
            $data = [];
            $spnser_d = [];
            $spnser_f = [];
            $data['title']          = 'Admin TREE';
            $data['page_title']     = 'Admin TREE';
            $data['user']           = Sentinel::getUser();
            $data['tree_user']           = UserMaster::whereNull('mlm_side')->whereNotNull('self_sponsor_key')->first();
            $data['tree_user_all']           = UserMaster::whereNull('mlm_side')->whereNotNull('self_sponsor_key')->get();

            $all_children = User::getUserChildList($data['tree_user']['self_sponsor_key'],$spnser_d);       
        
            
            $tree_user_1st_level           = UserMaster::where('sponser_unique_id',$data['tree_user']['self_sponsor_key'])->pluck('self_sponsor_key');

            $tree_user_2st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_1st_level)->pluck('self_sponsor_key');

            $tree_user_3st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_2st_level)->pluck('self_sponsor_key');

            $tree_user_4st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_3st_level)->pluck('self_sponsor_key');

            $tree_user_5st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_4st_level)->pluck('self_sponsor_key');

            $tree_user_6st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_5st_level)->pluck('self_sponsor_key');

            $tree_user_7st_level           = UserMaster::whereIn('sponser_unique_id',$tree_user_6st_level)->pluck('self_sponsor_key');


            $data['level1'] = $tree_user_1st_level;
            $data['level2'] = $tree_user_2st_level;
            $data['level3'] = $tree_user_3st_level;
            $data['level4'] = $tree_user_4st_level;
            $data['level5'] = $tree_user_5st_level;
  
            //  $users = \DB::table('user_master')->whereNotNull('self_sponsor_key')->get()->toArray();
            // // $baseUser = \DB::table('user_master')->whereNull('mlm_side')->whereNotNull('self_sponsor_key')->first();
            // $baseUser = UserMaster::whereNull('mlm_side')->whereNotNull('self_sponsor_key')->first();
            // dd($baseUser);
            // $tree = $this->baseUser($baseUser);
            // $data['tree_v'] = $tree;

            return \View::make($this->view.'index', $data); 
              // return \View::make($this->view.'view', $data); 

            } catch (Exception $e) {
                
            }
    }

    public function view(Request $request, $id)
    {
        try {
            
            $data = [];
            $spnser_d = [];
            $spnser_f = [];
            $data['title']          = 'VIEW TREE';
            $data['page_title']     = 'VIEW TREE';
            $data['user']           = Sentinel::getUser();
            $data['tree_user']           = UserMaster::where('id', $id)->first();
            
            $users = \DB::table('user_master')->whereNotNull('self_sponsor_key')->get()->toArray();            
            // $baseUser = \DB::table('user_master')->whereNull('mlm_side')->whereNotNull('self_sponsor_key')->first();
            $baseUser = UserMaster::whereNull('mlm_side')->whereNotNull('self_sponsor_key')->where('id',$data['tree_user']['id'])->first();
            // dd($baseUser);
            $tree = $this->baseUser($baseUser);
            $data['tree_v'] = $tree;

            return \View::make($this->view.'view', $data); 
   

        } catch (Exception $e) {
            
        }
    }

    public static function getTree()
    {

    }


    public function getList(Request $request)
    {
        try {
            
            // $user_id_list = RoleUser::where('role_id', '3')->pluck('user_id')->toArray();
            $data        = UserMaster::whereNull('mlm_side')->whereNotNull('self_sponsor_key')->get();

            return \DataTables::of($data)
                    ->addColumn('user_name', function($row) {
                        return $row->name;
                    })
                    ->addColumn('email', function($row) {
                        return $row->email;
                    })
                    // ->addColumn('sponser', function($row) {
                    //     return $row->sponsor_id;
                    // })
                    // ->addColumn('side', function($row) {
                    //     return $row->mlm_side;
                    // })
                    ->addColumn('action', function($row) {
                        // $edit_btn = '<a href="'.\URL::route('admin.user.edit', [ 'id' => $row->id ]).'" class="btn btn-outline-info btn-elevate btn-circle btn-icon mt-1 mb-1 mr-2" title="'.\Lang::get($this->index.'edit_title').'"><i class="la la-edit"></i></a>';
                        $view_tree = '<a href="'.\URL::route('admin.mlm_tree_view.view', [ 'id' => $row->id ]).'"><button type="button" class="btn btn-primary waves-effect waves-light">View Downline</button></a>';

                        // $delete_btn = '<a href="javascript:deleteClient(\''.$row->id.'\')" id="delete_'.$row->id.'" data-url="'.\URL::route('admin.user.delete', [ 'id' => $row->id ]).'" class="btn btn-outline-danger btn-elevate btn-circle btn-icon mt-1 mb-1 mr-2" title="'.\Lang::get($this->index.'delete_title').'"><i class="la la-trash"></i></a>';
                        // $delete_btn = '<a href="javascript:deleteClient(\''.$row->id.'\')" id="delete_'.$row->id.'"  data-url="'.\URL::route('admin.user.delete', [ 'id' => $row->id ]).'" ><button type="button" class="btn btn-danger waves-effect waves-light">Delete</button></a>';

                        return $view_tree;
                    })
                    ->rawColumns(['action'])
                    ->make(true);


        } catch (Exception $e) {
            
        }
    }
  

}
