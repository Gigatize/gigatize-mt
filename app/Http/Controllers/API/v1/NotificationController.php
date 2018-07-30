<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Resources\NotificationResource;
use App\Notification;
use App\Services\NotificationService;
use App\Traits\EloquentBuilderTrait;
use Illuminate\Http\Request;
use Optimus\Bruno\LaravelController;

class NotificationController extends LaravelController
{
    use EloquentBuilderTrait;

    private $notificationService;

    public function __construct(NotificationService $notificationService) {
        $this->notificationService = $notificationService;
    }

    /**
     * Display the specified resource.
     *
     * @param  Notification $notification
     * @return NotificationResource
     */
    public function show(Notification $notification)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->notificationService->getById($notification->id, $resourceOptions);
        if($data) {
            $parsedData = $this->parseData($data, $resourceOptions, 'notification');
            // Create JSON response of parsed data
            return new NotificationResource($parsedData['notification']);
        }else{
            return response()->json(['message' => 'Unauthorized action','error' => 403], 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Notification $notification
     * @return NotificationResource
     */
    public function update(Notification $notification)
    {
        $notification = $this->notificationService->update($notification);

        if($notification) {
            return new NotificationResource($notification);
        }else{
            return response()->json(['message' => 'Unauthorized action','error' => 403], 403);
        }
    }

}
