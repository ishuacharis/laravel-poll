<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\NotificationCollection;

class NotificationController extends Controller
{
    //

    public function index($id , Request $request)
    {
        $user  = User::findOrFail($id);
        $notifications = $user->notifications;
        $response = [
            'response' => [
                'message' => "Notifications {$request->id}",
                'notifications' => new NotificationCollection($notifications)
            ]
        ];
        return response($response,200);
    }
}
