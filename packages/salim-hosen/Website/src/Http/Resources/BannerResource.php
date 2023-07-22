<?php

namespace SalimHosen\Website\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'id' => $this->id,
            'image' => $this->image ? asset("images/banner/$this->image") : "",
            'url' => $this->url,
            'index' => $this->banner_index,
        ];
    }
}
