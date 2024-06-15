<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    //
    public function index()
    {
        // Fetch notifications based on your conditions
        $notifications = Notification::where('create_id', auth()->id())
                                     ->orderByDesc('created_at')
                                     ->get();
    
        return view('notifications.index', ['notifications' => $notifications, ]);
    }
}
