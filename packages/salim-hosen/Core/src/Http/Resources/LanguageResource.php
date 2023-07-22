<?php

namespace SalimHosen\Core\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
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
            "country_id" => $this->country_id,
            "country_name" => $this->country->name ?? "",
            "name" => $this->name,
            "code" => $this->code,
            "direction" => $this->symbol,
        ];
    }
}
