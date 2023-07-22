<?php

namespace SalimHosen\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "arabic_name",
        "iso_code_2",
        "iso_code_3",
        "country_code",
        "flag",
        "slug",
        "is_active"
    ];

    public function states(){
        return $this->hasMany(State::class);
    }

}
