<?php

namespace App\Services;

use App\Notification;
use App\Repositories\NotificationRepository;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;

class NotificationService {

    private $auth;

    private $dispatcher;

    private $notificationRepository;

    public function __construct(Dispatcher $dispatcher, NotificationRepository $notificationRepository) {
        $this->dispatcher = $dispatcher;
        $this->notificationRepository = $notificationRepository;
    }

    public function getById($id, $options){
        $user = Auth::user();
        $notification = Notification::find($id);
        // Check if the user has permission to view the notification.
        if($notification->notifiable_id == $user->id) {
            return $this->notificationRepository->getById($id, $options);
        }else{
            return false;
        }
    }

    public function update($notification)
    {
        $user = Auth::user();
        // Check if the user has permission to update notification.
        // Will throw an exception if not.
        if($user->id == $notification->notifiable_id) {
            // Set the notification as read
            $readNotification = $this->notificationRepository->update($notification);

            return $readNotification;
        }else{
            return false;
        }
    }
}