<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAllRead()
    {
        $notis = Notification::where([
            ['user_id', Auth::user()->id],
            ['read', 0]
        ])->get();

        foreach ($notis as $noti) {
            $noti->read = true;
            $noti->save();
        }

        return 'ok';
    }

    public function read($id)
    {
        $noti = Notification::find($id);
        $noti->read = true;
        $noti->save();

        return 'ok';
    }
}
