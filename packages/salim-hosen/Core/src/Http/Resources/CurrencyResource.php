<?php

namespace SalimHosen\Core\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
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
            "code" => $this->code,
            "symbol" => $this->symbol,
            "position" => $this->position,
            "exchange_rate" => $this->exchange_rate,
        ];
    }
}
