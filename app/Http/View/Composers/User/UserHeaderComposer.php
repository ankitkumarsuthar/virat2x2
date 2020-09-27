<?php

namespace App\Http\View\Composers\User;

use Illuminate\View\View;
use Sentinel;
use App\DB\Notification;
use App\DB\UserMaster;


class UserHeaderComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user           = Sentinel::getUser();
        $user_master    = UserMaster::where('id', $user->user_master_id)->first();
        $notification_count   = Notification::count();        
        if($notification_count > 0)
        {
            $notification   = Notification::get();        
        } else {
            $notification   = NULL;
        }
        $view->with('user', $user);
        $view->with('notification', $notification);
        $view->with('notification_count', $notification_count);
        $view->with('user_master', $user_master);
    }
}