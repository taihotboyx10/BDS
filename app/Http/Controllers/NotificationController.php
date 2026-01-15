<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        return inertia('Notification/Index', [
            'notifications' => $request->user()->notifications()->get(),
        ]);
    }

    public function update(string $notificationId)
    {
        $notification = Auth::user()->notifications()->where('id', $notificationId)->firstOrFail();
        $notification->markAsRead();

        return redirect()->back();
    }
}
