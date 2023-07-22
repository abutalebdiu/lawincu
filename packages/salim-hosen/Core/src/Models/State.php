<?php

namespace SalimHosen\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plusemon\Uploader\HasUploader;

class State extends Model
{
    use HasFactory,HasUploader;

    protected $fillable = [
        "name",
        "arabic_name",
        "country_id",
        "image"
    ];

    public function cities(){
        return $this->hasMany(City::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
