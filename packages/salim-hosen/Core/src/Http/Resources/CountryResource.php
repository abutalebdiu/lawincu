<?php

namespace SalimHosen\Core\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            "name" => $this->name,
            "arabic_name" => $this->arabic_name,
            "iso_code_2" => $this->iso_code_2,
            "iso_code_3" => $this->iso_code_3,
            "country_code" => $this->country_code,
            "flag" => asset("uploads/flag/".$this->flag),
            "slug" => $this->slug,
        ];
    }
}
