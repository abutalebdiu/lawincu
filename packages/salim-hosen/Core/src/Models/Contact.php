<?php

namespace SalimHosen\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SalimHosen\EmailMarketing\Models\MailingList;
use SalimHosen\Core\Models\Country;
use SalimHosen\Core\Models\State;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "contact_type",
        "title",
        "name",
        "email",
        "phone",
        "mobile",
        "gender",
        "person_in_charge",
        "address",
        "address_2",
        "nationality",
        "website",
        "country_id",
        "state_id",
        "city",
        "tags",
        "job_position",
        "tax_id",
        "contact_source",
        "notes",
        "image",
        "contact_id",
        "company_id",
        "fax",
        "zip_code",
        "assign_to",
        "is_default_contact"
    ];


    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function mailinglists(){
        return $this->belongsToMany(MailingList::class);
    }

}
