<?php

namespace SalimHosen\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SalimHosen\Core\Models\Country;

class Language extends Model
{
    use HasFactory;


    protected $fillable = [
        "name",
        "code",
        "country_id",
        "direction",
        "is_active"
    ];


    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function seo_content(){
        return $this->hasOne(SeoPageContent::class);
    }

}
