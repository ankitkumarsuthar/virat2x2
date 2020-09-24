<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Illuminate\Support\Facades\Session;

class CheckUserAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //return $next($request);
        $user = Sentinel::getUser();
        if($user) {
            $roles = Sentinel::findById($user->id)->roles()->get();
            $status = false;

            foreach($roles AS $role) {
                if($role->id == '3') {
                    $status = true;
                }
            }

            if($status) {
                return $next($request);
            } else {
                Sentinel::logout();

                Session::flash('error', 'Your session is time-out. Please login again.');
                return redirect(route( 'user.login' ));
            }
        } else {
            Sentinel::logout();
            
            Session::flash('error', 'Your session is time-out. Please login again.');
            return redirect(route( 'user.login' ));
        }
    }
}
