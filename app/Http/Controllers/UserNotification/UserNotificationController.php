<?php

namespace App\Http\Controllers\UserNotification;

use App\Http\Controllers\Controller;
use App\Models\AdminMessage;
use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    public function mynotif($id){
        $notifications = AdminMessage::where('user_id','=',$id)
                        ->orderBy('created_at','desc')->paginate(4);
        
        return view('user.notificationFolder.notification',compact('notifications'));

    }
}
