<?php

namespace SalimHosen\Core\Http\Resources;

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
            "id" => $this->id,
            "user_id" => $this->user_id,
            "title" => $this->title,
            "description" => $this->description,
            "url" => $this->url,
            "is_seen" => $this->is_seen,
            "created_at" => $this->created_at->diffForHumans()
        ];
    }
}
