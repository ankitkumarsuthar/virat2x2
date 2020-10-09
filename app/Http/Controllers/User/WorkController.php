<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\Session;
use App\DB\UserMaster;
use App\DB\User;
use App\DB\Level;
use App\DB\Videos;
use App\DB\UserVideo;
use App\DB\Wallet;
use Illuminate\Support\Facades\Http;

class WorkController extends Controller
{
    public $view                = '';    

    public function __construct() {
        $this->view             = 'user.work.';                  
    }

    public function index(Request $request)
    {
        try {
            $data = [];
            $data['title']          = 'Video watch work';
            $data['page_title']     = 'Video watch work';            
            $data['view']           = $this->view;
            $data['user']           = Sentinel::getUser();
            $data['user_master']    = UserMaster::getUserMaster($data['user']['user_master_id']);
            $data['video_count'] = UserVideo::getUserTodayVideoCount($data['user']);            
            if($data['video_count'] >= 10)
            {
                return redirect(route( 'user.work.done' )); 
            } 

            $data['current_video']  = Session::get('current_video');
            if(empty($data['current_video']))
            {
                $data['videos_link']    = Videos::find(1);   
            } else {
                $data['videos_link']    = Videos::find($data['current_video']);   
            }            
            $link_array = explode("v=",$data['videos_link']['video_link']);
            if(!empty($link_array) && !empty($link_array[1]))
            {
                $data['video_id'] = $link_array[1];
                // $link = "https://www.googleapis.com/youtube/v3/videos?id=".$link_array[1]."&part=contentDetails&key=AIzaSyAkRJ37vbQO7knd87S4YlYMLXBzoSihbeo";
                // $response = Http::get($link);
                // $response_json = $response->json();
                // dd($response_json['items'][0]['contentDetails']['duration']);                 
            } else {
                $data['video_id'] = NULL;
            }
            $data['videoStart']     = Session::get('videoStart');
            $data['videoEnd']     = Session::get('videoEnd');
            $data['current_video']  = Session::get('current_video');
            Session::get('variableName');
            return \View::make($this->view.'index', $data);
        } catch (Exception $e) {
            
        }
    }

    public function start(Request $request)
    {
        try {
            $data = [];            
            Session::put('videoStart', 1);
            Session::put('videoEnd', 0);
            Session::put('current_video', 1);
            return redirect(route('user.work.index'));
        } catch (Exception $e) {
            
        }
    }

    public function next(Request $request, $video)
    {
        try {
            $data = [];
            $data['current_video'] = Session::get('current_video');
            Session::put('videoStart', 1);
            Session::put('videoEnd', 0);
            if(!empty($data['current_video']))
            {
                $next_video = $data['current_video'] + 1;
            } else {
                $next_video = 1;
            }
            Session::put('current_video', $next_video);

            $video_data    = Videos::find($video); 
            $user          = Sentinel::getUser();
            $user_master   = UserMaster::getUserMaster($user['user_master_id']);

            $store_result = UserVideo::saveVideoConter($video_data, $user_master);

            return redirect(route('user.work.index'));
        } catch (Exception $e) {
            
        }
    }

    public function finish(Request $request, $video)
    {
        try {

            $video_data    = Videos::find($video); 
            $user          = Sentinel::getUser();
            $user_master   = UserMaster::getUserMaster($user['user_master_id']);
            $store_result = UserVideo::saveVideoConter($video_data, $user_master);
            $user_level_data = Level::getUserCurrentLevel($user);   
            $level_data = Level::where('level_title', $user_level_data['current_level'])->first();            
            $income_insert = Wallet::addVideoIncome($user_master, $level_data);

            Session::put('videoStart', 0);
            Session::put('videoEnd', 1);
            // Session::put('current_video', 1);
            Session::forget('current_video');
            return redirect(route('user.work.index'));
        } catch (Exception $e) {
            
        }
    }


    public function workFinish(Request $request){
        try {
             $data = [];
            $data['title']          = 'Video watch work';
            $data['page_title']     = 'Video watch work';            
            $data['view']           = $this->view;
            $data['user']           = Sentinel::getUser();
            $data['user_master']    = UserMaster::getUserMaster($data['user']['user_master_id']);

             Session::forget('videoStart');
            Session::forget('videoEnd');
            Session::forget('current_video');
            return \View::make($this->view.'done', $data);
        } catch (Exception $e) {
            
        }
    }

  

}
