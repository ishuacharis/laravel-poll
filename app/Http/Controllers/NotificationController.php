<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\NotificationRepositoryInterface;

class NotificationController extends Controller
{
    protected $user;
    /**
     * Create instance of controller
     * 
     * @param \App\Repositories\UserRepositoryInterface
     * 
     * @return void
     */

    public function __construct(UserRepositoryInterface $userRepositoryInterface,)
    {
        $this->user = $userRepositoryInterface;
    }

    /**
     * Get all the notification for a  user
     * 
     * @param \App\Http\Request
     * @param int 
     * 
     * @return JsonResponse
     * 
     */

    public function index($id , Request $request)
    {
        $user  = $this->user->findOrFail($id);
        $notifications = $user->notifications;
        $response = [
            'response' => [
                'message' => "Notifications {$request->id}",
                'notifications' => $this->user->allNotification($notifications)
            ]
        ];
        return response($response,200);
    }
}
