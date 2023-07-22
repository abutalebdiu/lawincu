<?php

namespace SalimHosen\Core\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaLibraryResource extends JsonResource
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
            "file_name" => $this->file_name,
            "original_name" => $this->original_name,
            "url" => asset("uploads/all/".$this->file_name),
            "size" => formatBytes($this->file_size)
        ];
    }
}
