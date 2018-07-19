<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'          => 'notification',
            'id'            => (string)$this->id,
            'attributes'    => [
                'message' => (string)$this->data['message'],
                'notification_type' => (string)$this->data['notification_type'],
                'link' => (string)$this->data['link'],
                'read' => (boolean)$this->read(),
                'created_at' => (string)$this->created_at->toDateTimeString(),
                'updated_at' => (string)$this->updated_at->toDateTimeString(),
            ],
            'relationships' => $this->when($this->getRelations(), function() {
                return new CommentRelationshipResource($this);
            }),
            'links'         => [
                'self' => route('notifications.show', ['notification' => $this->id]),
            ],
        ];
    }
}
