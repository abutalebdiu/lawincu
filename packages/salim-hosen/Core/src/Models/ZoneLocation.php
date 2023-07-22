<?php

namespace SalimHosen\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ZoneLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        "zone_id",
        "country_id",
        "state_id",
    ];

    public function zone(){
        return $this->belongsTo(Zone::class);
    }
}
