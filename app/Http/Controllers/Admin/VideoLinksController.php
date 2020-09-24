<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\Session;
use App\DB\UserMaster;
use App\DB\Videos;
use App\DB\User;
use App\DB\Level;
use App\Commands\Admin\VideosStoreCommand;

class VideoLinksController extends Controller
{
    public $view                = '';    

    public function __construct() {
        $this->view             = 'admin.videos.';                  
    }

     public function index(Request $request)
    {
        try {
            $data = [];

            $data['title']          = 'Video Links';
            $data['page_title']     = 'Video Links';            
            $data['view']           = $this->view;
            $data['videos_link']    = Videos::get();
            // dd($data['videos_link']);
            return \View::make($this->view.'index', $data);
        } catch (Exception $e) {
            
        }
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $result = $this->dispatch(new VideosStoreCommand($data, $request, 'edit'));
            if ($result) {
                Session::flash('success', 'Video link detail save successfully.');
                return redirect(route('admin.videos.index'));
            } else {
                Session::flash('error', 'Fail to store video link detail.');
                return redirect(route('admin.videos.index'));
            }
        } catch (Exception $e) {
            return \Redirect::back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

  

}
