<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\Session;
use App\DB\UserMaster;
use App\DB\User;
use App\DB\Notification;
use App\DB\Level;
use App\Commands\Admin\LevelStoreCommand;

class NotificationController extends Controller
{
    public $view                = '';    

    public function __construct() {
        $this->view             = 'admin.notification.';                  
    }

     public function index(Request $request)
    {
        try {
            $data = [];
            $data['title']          = 'Notification';
            $data['page_title']     = 'Notification';
            $data['view']           = $this->view;

            return \View::make($this->view.'index', $data);
        } catch (Exception $e) {
            
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            if(!empty($data['title']) && $data['details'])
            {
                $record = new Notification();
                $record->title          = $data['title'];
                $record->details        = $data['details'];
                $record->insert_date    = date('Y-m-d');;
                $record->status         = 1;
                $result = $record->save();
            } else {
                $result = false;
            }            
            if ($result) {
                Session::flash('success', 'Notification detail save successfully.');
                return redirect(route('admin.notification.index'));
            } else {
                Session::flash('error', 'Fail to store notification detail.');
                return redirect(route('admin.notification.index'));
            }
        } catch (Exception $e) {
            return \Redirect::back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    public function delete(Request $request, $id)
    {
        try {

            $data['id']     = $id;
            $record         = Notification::find($id);
            $result         = $record->delete();

            if ($result) {
                return response()->json([
                    'delete-user'           => true,
                    'reqstatus'             => 'success', 
                    'message'               => 'Notification detail deleted successfully.'
                ]);
            } else {
                return response()->json([
                    'delete-user'           => true,
                    'reqstatus'             => 'error', 
                    'message'               => 'Fail to delete notification detail.'
                ]);            
            }
        } catch (Exception $e) {
            return response()->json([
                'delete-user'           => true,
                'reqstatus'             => 'error', 
                'message'               => 'Fail to delete notification detail.'
            ]);            
        }
    }

    public function getList(Request $request)
    {
        try {
            $data        = Notification::get();
            return \DataTables::of($data)
                    ->addColumn('title', function($row) {
                        return $row->title;
                    })
                    ->addColumn('details', function($row) {
                        return $row->details;
                    })
                    ->addColumn('action', function($row) {

                        $delete_btn = '<a href="javascript:deleteClient(\''.$row->id.'\')" id="delete_'.$row->id.'"  data-url="'.\URL::route('admin.notification.delete', [ 'id' => $row->id ]).'" ><button type="button" class="btn btn-danger waves-effect waves-light">Delete</button></a>';

                        return $delete_btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);


        } catch (Exception $e) {
            
        }
    }

  

}
