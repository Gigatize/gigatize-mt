<?php

namespace App\Repositories;


use App\Notification;
use Optimus\Genie\Repository;

class NotificationRepository extends Repository
{
    protected function getModel()
    {
        return new Notification();
    }

    public function update($notification)
    {
        $notification->markAsRead();
        return $notification;
    }
}