<?php
namespace App\DB;
use Illuminate\Database\Eloquent\Model;
use App\DB\UserMaster;
use App\DB\RoleUser;
use Sentinel;

/* 
Predefined Values:
status : 0-INACTIVE,1-ACTIVE

Foreign Keys:
create_by : FK FROM users Table
update_by : FK FROM users Table
delete_by : FK FROM users Table
artist_id : FK FROM artists_master Table
*/
class UserVideo extends Model
{
    protected $table = 'user_video';

    protected $fillable = [         
        'user_id', 
        'user_master_id', 
        'video_id', 
        'watch_date', 
        'complete_watch', 
        'is_watched'
    ];

    public function usermaster() {
        return $this->hasOne('App\DB\UserMaster', 'id', 'user_id');
    }
    public function video() {
        return $this->hasOne('App\DB\Videos', 'id', 'video_id');
    }

     public static function saveVideoConter($video, $user_master)
	 {
	 	$user = Sentinel::getUser();
        $record                   = new UserVideo();
        $record->user_id          = $user->id;
        $record->user_master_id   = $user_master->id;
        $record->video_id         = $video->id;
        $record->watch_date       = date('Y-m-d');
        $record->is_watched       = 1;
        $result                   = $record->save();
	 }

	 public static function getUserTodayVideoCount($user_master)
	 {
        $record = UserVideo::where('user_id', $user_master['id'])->where('watch_date', date('Y-m-d'))->count();        
        return $record;
	 }


}
