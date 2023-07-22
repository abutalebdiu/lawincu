<?php

namespace SalimHosen\Core\Models;

use Illuminate\Database\Eloquent\Model;
use SalimHosen\Core\Models\Country;
use SalimHosen\Core\Models\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use SalimHosen\Core\Models\Company;
use SalimHosen\Shipping\Models\ShippingMethod;

class Zone extends Model
{

    use HasFactory;

	protected $fillable = [
        'name','country_id','is_active', 'company_id', 'cover_whole_world'
    ];

	public function country(){
        return $this->belongsTo(Country::class);
    }

    public function zone_locations(){
        return $this->hasMany(ZoneLocation::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function shipping_methods(){
        return $this->belongsToMany(ShippingMethod::class);
    }
}
